const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();
mix.copyDirectory("node_modules/tinymce/skins", "public/vendor/tinymce/skins");
mix.copyDirectory(
    "node_modules/tinymce/themes",
    "public/vendor/tinymce/themes"
);
mix.copyDirectory(
    "node_modules/tinymce/plugins",
    "public/vendor/tinymce/plugins"
);
mix.copyDirectory("node_modules/tinymce/icons", "public/vendor/tinymce/icons");
mix.copy("node_modules/tinymce/tinymce.js", "public/vendor/tinymce/tinymce.js");
mix.copy(
    "node_modules/tinymce/tinymce.min.js",
    "public/vendor/tinymce/tinymce.min.js"
);

mix.copy(
    "node_modules/jquery/dist/jquery.min.js",
    "public/js/jquery"
);

mix.copyDirectory(
    "node_modules/tinymce/models",
    "public/vendor/tinymce/models"
);

mix.js("resources/js/tagify.js", "public/js")
    .sass("resources/sass/tagify.scss", "public/css")
    .sourceMaps();

