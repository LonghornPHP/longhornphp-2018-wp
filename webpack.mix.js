let mix = require('laravel-mix');
require('dotenv').config();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

// You can set up a `.env` file in your project root (see `.env.sample`) or just override the default proxy URL here.
let proxy_url = process.env.BROWSERSYNC_PROXY_URL || 'local.wordpress.dev';

mix.setPublicPath(path.resolve('./'))
    .webpackConfig({
        externals: {
            'jquery': 'jQuery'
        }
    })
    .autoload({
        'popper.js/dist/umd/popper.js': ['Popper']
    })
    .options({
        processCssUrls: false
    })
    .js(
        [
            'node_modules/@cmyee/pushy/js/pushy.js',
            'js/main.js'
        ],
        'js/build/bundle.js'
    )
    .sass('sass/style.scss', 'css/')
    .sourceMaps()
    .browserSync({
        proxy: proxy_url,
        files: [
            './*.php',
            'template-parts/*.php',
            'page-templates/*.php',
            'js/build/*.js',
            'css/style.css'
        ]
    });
