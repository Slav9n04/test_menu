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

mix.js('web/frontend/resources/js/app.js', 'web/frontend/web/js')
    .sass('web/frontend/resources/sass/app.scss', 'web/frontend/web/css');
