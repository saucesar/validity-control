const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts('node_modules/bootstrap/js/dist/util.js', 'public/bootstrap/js/util.js')
   .scripts('node_modules/bootstrap/dist/js/bootstrap.js', 'public/bootstrap/js/bootstrap.js')
   .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/bootstrap/css/bootstrap.css')
   .minify([
       'public/bootstrap/js/util.js',
       'public/bootstrap/js/bootstrap.js',
       'public/bootstrap/css/bootstrap.css',
   ]);