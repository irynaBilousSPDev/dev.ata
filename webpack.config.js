const path = require('path');

module.exports = {
    mode: 'production', // Can be 'development' for easier debugging
    entry: {
        main: './assets/src/js/main.js',
        ajaxFilter: './assets/src/js/ajax-filter.js', // ✅ Add AJAX filter script
    },
    output: {
        filename: '[name].js', // Output as main.js & ajaxFilter.js
        path: path.resolve(__dirname, 'assets/dist/js'),
        clean: true,
    },
    module: {
        rules: [
            {
                test: /\.js$/, // Transpile modern JS to ES5
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
            {
                test: /\.(sa|sc|c)ss$/, // ✅ Support SCSS, SASS, and CSS
                use: [
                    'style-loader', // Inject styles into DOM
                    'css-loader', // Resolves CSS imports
                    'postcss-loader', // Post-process CSS (autoprefixing, etc.)
                    'sass-loader', // Compile SCSS to CSS
                ],
            }
        ],
    },
    resolve: {
        alias: {
            slick: path.resolve(__dirname, 'node_modules/slick-carousel/slick/slick.js'), // ✅ Ensure Slick loads correctly
            // bootstrap: path.resolve(__dirname, 'node_modules/bootstrap/dist/js/bootstrap.bundle.js'), // ✅ Bootstrap JS
        },
    },
    devtool: 'source-map', // Generate source maps for debugging
};

