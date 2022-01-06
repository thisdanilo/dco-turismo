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

//Geral
mix.combine(
    [
        "node_modules/admin-lte/plugins/fontawesome-free/css/all.css",
        "node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css",
        "node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.css",
        "node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.css",
        "node_modules/admin-lte/plugins/select2/css/select2.css",
        "node_modules/admin-lte/dist/css/adminlte.css",
        "node_modules/admin-lte/plugins/summernote/summernote-bs4.min.css",
        "resources/css/style.css",
    ],
    "public/css/adminlte.css"
);

//Theme CSS
mix.combine(
    [
        "themes/turismo/turismo/public/css/style.css",
        "themes/turismo/turismo/public/css/responsive.css",
        "themes/turismo/turismo/public/css/reset.css",
    ],
    "public/css/theme.css"
);

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management JS
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//Geral
mix.combine(
    [
        "node_modules/admin-lte/plugins/jquery/jquery.js",
        "node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js",
        "node_modules/admin-lte/dist/js/adminlte.js",
        "node_modules/admin-lte/plugins/datatables/jquery.dataTables.js",
        "node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js",
        "node_modules/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.js",
        "node_modules/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.js",
        "node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.js",
        "node_modules/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.js",
        "node_modules/admin-lte/plugins/select2/js/select2.full.js",
        "node_modules/admin-lte/plugins/summernote/summernote-bs4.js",
        "node_modules/jquery-mask-plugin/dist/jquery.mask.js",
    ],
    "public/js/adminlte.js"
);

// Marcas JS
mix.scripts("Modules/Bland/Resources/assets/js/bland.js", "public/js/bland.js");

// Aviões JS
mix.scripts("Modules/Plane/Resources/assets/js/plane.js", "public/js/plane.js");

// Aeroportos JS
mix.scripts(
    "Modules/Airport/Resources/assets/js/airport.js",
    "public/js/airport.js"
);

// Voos JS
mix.scripts(
    "Modules/Flight/Resources/assets/js/flight.js",
    "public/js/flight.js"
);

// Reservas JS
mix.scripts(
    "Modules/Reserve/Resources/assets/js/reserve.js",
    "public/js/reserve.js"
);

// Usuário JS
mix.scripts("Modules/User/Resources/assets/js/user.js", "public/js/user.js");
