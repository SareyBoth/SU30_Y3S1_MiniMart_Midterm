const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/scss/app.scss', 'public/css') // this handles .scss correctly
   .options({
       postCss: [require('tailwindcss')],
       processCssUrls: false
   });
