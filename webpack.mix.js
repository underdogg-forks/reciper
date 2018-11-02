let mix = require("laravel-mix");

let css = 1;
let js = 0;
let server = 1;

if (css == 1) {
    mix.sass("resources/sass/app.scss", "public/css/app.css").options({
        processCssUrls: false
    });
}

if (js == 1) {
    mix.js("resources/js/vue/vue.js", "public/vendor/js")
        .babel(
            [
                "resources/js/vanilla/modules.js",
                "resources/js/vanilla/materialize.js",
                "resources/js/vanilla/functions/_*.js",
                "resources/js/vanilla/components/_*.js"
            ],
            "public/vendor/js/vanilla.js"
        )
        .combine(
            ["public/vendor/js/vue.js", "public/vendor/js/vanilla.js"],
            "public/js/app.js"
        );
}

if (server == 1) {
    mix.browserSync({
        proxy: "localhost:8000",
        files: ["public/css/*.css", "public/js/*.js"],
        notify: false
    });
}
