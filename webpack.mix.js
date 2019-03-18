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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

   mix.babel([
      'resources/js/vue.js',
      'resources/js/jquery.min.js',
      'resources/js/jquery.dataTables.min.js',
      'resources/js/dataTables.bootstrap4.min.js',
      'resources/js/popper.min.js',
      'resources/js/bootstrap.min.js',
      'resources/js/sweetalert.min.js',
      'resources/js/usuario.js',
      
   ], 'public/js/usuario.min.js')
   .babel([
      'resources/sass/dataTables.bootstrap4.min.css',
   ], 'public/css/usuario.min.css')

   mix.babel([
      'resources/js/vue.js',
      'resources/js/jquery.min.js',
      'resources/js/jquery.dataTables.min.js',
      'resources/js/dataTables.bootstrap4.min.js',
      'resources/js/popper.min.js',
      'resources/js/bootstrap.min.js',
      'resources/js/sweetalert.min.js',
      'resources/js/rol.js',
      
   ], 'public/js/rol.min.js')
   .babel([
      'resources/sass/dataTables.bootstrap4.min.css',
   ], 'public/css/rol.min.css')
