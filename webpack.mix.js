const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')

    //Admin LTE
    .copy('node_modules/admin-lte/dist/css/AdminLTE.css', 'public/css')
    .copy('node_modules/admin-lte/dist/css/skins/skin-purple.css', 'public/css');
