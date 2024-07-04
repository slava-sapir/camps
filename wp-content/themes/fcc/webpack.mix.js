const mix = require("laravel-mix");

// mix.autoload({
//     'jquery': ['$', 'window.jQuery', 'jQuery']
// });

mix.options({
    processCssUrls: false,
});


mix
  .js("resources/js/theme.js", "public/js")
  .sass("resources/sass/theme.scss", "public/css");

mix.minify(["public/js/theme.js", "public/css/theme.css"]);
