let mix = require('laravel-mix');

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
  .styles([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        // 'resources/assets/css/bootstrap-3-3-7.css',
        'resources/assets/css/fontawesome-all.css',
        'resources/assets/css/defaultAdmin.css',
        'resources/assets/css/animate.css',
        'resources/assets/css/toastr.css',
        'resources/assets/css/default.css',
        'resources/assets/css/dropzone.min.css',
        'resources/assets/css/plugins/image/blueimp-gallery.css',
        // 'resources/assets/css/plugins/imageblueimp-gallery-indicator.css'
      ], 'public/css/app.css')
