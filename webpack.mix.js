/* jshint esversion:6 */
const mix = require('laravel-mix');

mix.postCss('inc/src/css/tailwind.css', 'inc/dist/css/', [
    require('tailwindcss'),
    require('postcss-nested')
]).options({
    processCssUrls: false
});