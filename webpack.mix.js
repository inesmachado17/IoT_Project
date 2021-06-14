const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").postCss(
    "resources/css/app.css",
    "public/css",
    [
        //
    ]
);

mix.js("__server/app/index.jsx", "public/demo/app.js").react();

mix.js("resources/js/fire-alarm.js", "public/js/fire-alarm.js");
