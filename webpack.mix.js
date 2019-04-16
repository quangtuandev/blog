const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
const ASSETS_PATH = 'resources/assets/';
const NODE_PATH = 'node_modules/';

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    // .js(ASSETS_PATH + 'js', 'public/js')
    .sass(ASSETS_PATH + 'css/auth.scss', 'public/css')
    .sass(NODE_PATH + 'font-awesome/scss/font-awesome.scss', 'public/css/font.css')
    .copyDirectory(ASSETS_PATH + 'img', 'public/images')
    .js(ASSETS_PATH + 'js/mo.min.js', 'public/js');