const settings = require('./settings.json');

module.exports = {

    mode: 'production',

    output: {
        filename: 'app.min.js',
    },

    /*
    watch: true,
    watchOptions: {
        ignored: /node_modules/
    },
    */
    externals: {
        jquery: 'jQuery',
    },

    module: {
        rules: [{
            test: /\.js$/,
            // exclude: /(node_modules|bower_components)/,
            exclude: [/node_modules\/(?!(swiper|dom7)\/).*/],
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env']
                }
            }
        }]
    }
};
