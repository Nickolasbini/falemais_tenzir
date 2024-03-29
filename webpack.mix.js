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
mix.sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/externalfeatures/bootstrap.css')
   .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/externalfeatures/bootstrap.js')
   .scripts('node_modules/jquery/dist/jquery.js', 'public/externalfeatures/jquery.js')
mix.js('resources/js/app.ts', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
