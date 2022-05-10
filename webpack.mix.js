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

mix.js('resources/js/site/app.js', 'public/js/site')
    .js('resources/js/crm/crm.js', 'public/js/crm')
    .vue()
    .sass('resources/sass/site/app.scss', 'public/css/site')
    .sass('resources/sass/crm/crm.scss', 'public/css/crm');
