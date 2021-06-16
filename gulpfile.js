const { src, dest, series, parallel, watch } = require('gulp');
const touch = require('gulp-touch-fd');

const sass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');

const rename = require('gulp-rename');
const del = require('delete');
const plumber = require('gulp-plumber');

const browserSync = require('browser-sync').create();

const eslint = require('gulp-eslint');
const webpack = require('webpack-stream');
const webpackBundler = require('webpack');

const settings = require('./settings.json');
const pkg = require('./package.json');

const newer = require('gulp-newer');
const imagemin = require('gulp-imagemin');
const imgSrc = 'assets/images/**';
const imgDest = 'dist/images';

const ftp = require('vinyl-ftp');
const ftpsettings = require('./ftp-settings.json');
const log = require('fancy-log');


/*
    Css Tasks
*/
function cssDev() {
    return src(settings.css.sassMainFiles)
        .pipe(sourcemaps.init())
        .pipe(sassGlob())
        .pipe(sass({
            'outputStyle': 'compressed',
            'precision': 8,
            'includePaths': ['./node_modules']
        }).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write())
        .pipe(rename({ extname: '.min.css' }))
        .pipe(dest(settings.css.buildDir))
        .pipe(browserSync.stream());
}


function cssProd() {
    return src(settings.css.sassMainFiles)
        .pipe(sassGlob())
        .pipe(sass({
            'outputStyle': 'compressed',
            'precision': 8,
            'includePaths': ['./node_modules']
        }).on('error', sass.logError))
        .pipe(autoprefixer({ grid: 'no-autoplace' }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(dest(settings.css.buildDir))
        .pipe(touch());
}



/*
    js tasks
*/
function jsLint() {
    return src(settings.js.jsFiles)
        .pipe(eslint({
            "quiet": true,
            "configFilePath": "./.eslintrc.json"
        }))
        .pipe(eslint.format())
        .pipe(eslint.failAfterError());
}

function jsDev() {
    return src(settings.js.entry)
        .pipe(webpack(require('./webpack-dev.config.js'), webpackBundler))
        .pipe(dest(settings.js.buildDir))
        .pipe(browserSync.stream());
}

function jsProd() {
    return src(settings.js.entry)
        .pipe(webpack(require('./webpack-prod.config.js'), webpackBundler))
        .pipe(dest(settings.js.buildDir));
}


// Optimize Images
function images() {
    return src("./assets/images/**/*")
        .pipe(newer("./dist/images/"))
        .pipe(
            imagemin([
                imagemin.gifsicle({ interlaced: true }),
                imagemin.mozjpeg({ quality: 75, progressive: true }),
                imagemin.optipng({ optimizationLevel: 5 }),
                imagemin.svgo({
                    plugins: [
                        { removeViewBox: true },
                        { cleanupIDs: false }
                    ]
                })
            ])
        )
        .pipe(dest("./dist/images/"));
}



/*
    Watch tasks
*/
// BrowserSync: init
function browserSyncInit(done) {
    browserSync.init({
        proxy: settings.devSiteName
    });

    done();
}

// BrowserSync: reload
function browserSyncReload(done) {
    browserSync.reload();
    console.log("reload"),
    
    done();
}



/*
    Watch files
*/
function watchFiles(done) {
    watch(settings.css.sassFiles, cssDev);
    watch(settings.js.jsFiles, jsDevTask);
    watch("./**/*.php", browserSyncReload);
    watch("./templates/**/*.twig", browserSyncReload);

    // watch("./assets/scripts/**/*", series(jsLint, jsBundle, browserSyncReload));
    watch("./assets/images/**/*", images);
}



/*
    Utility tasks: clean dist directory
*/
function cleanDist(done) {
    del(['./dist/js/**', './dist/css/**'], { force: true }, done);
}

/*
    FTP Files
*/

function upload() {

    var deployFiles = [
        './dist/**/*',
        './include/**/*',
        './template-parts/**/*.php',
        './woocommerce/**/*.php',
        './*.php',
        './style.css',
        './screenshot.png',
    ];

    let mode = (process.argv[4] && process.argv[4] == 'public') ? 'public' : 'staging';

    var ftpHost = ftpsettings[mode].host;
    var ftpUsername = ftpsettings[mode].username;
    var ftpPassword = ftpsettings[mode].password;
    var ftpBasedir = ftpsettings[mode].basedir;

    log(`[deploy] Starting "${mode}" deploy via FTP to server "${ftpHost}" in "${ftpBasedir}"`);

    var conn = ftp.create({
        host: ftpHost,
        user: ftpUsername,
        password: ftpPassword,
        parallel: 3,
        log: log,
    });

    return src(deployFiles, { base: '.', buffer: false })
        .pipe(conn.newer(ftpBasedir))
        .pipe(conn.dest(ftpBasedir));

}



/*
    Compose tasks
*/
// const jsTask = series(jsLint, jsBundle);
// const build = series(clean, gulp.parallel(css, js));
const jsDevTask = series(jsLint, jsDev);
const jsProdTask = series(jsLint, jsProd);
const watchTask = series(cleanDist, cssDev, jsDevTask, images, browserSyncInit, watchFiles);
const buildTask = series(cleanDist, cssProd, jsProdTask, images);
const deployTask = series(buildTask, upload);


/*
    Exports public tasks
*/
exports.cssDev = cssDev;
exports.cssProd = cssProd;
exports.jsLint = jsLint;
exports.jsDev = jsDevTask;
exports.jsProd = jsProdTask;
exports.cleanDist = cleanDist;
exports.watch = watchTask;
exports.build = buildTask;
exports.default = watchTask;
exports.images = images;
exports.deploy = deployTask;