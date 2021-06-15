const settings = require('./settings.json');

module.exports = {
    mode: 'production',
    output: {
        filename: 'app.min.js',
    },
    devtool: "eval-source-map",
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
            exclude: /(node_modules|bower_components)/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: ['@babel/preset-env']
                }
            }
        }]
    }
};