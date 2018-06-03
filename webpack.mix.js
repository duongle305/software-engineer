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
    .js('resources/assets/js/create-product.js', 'public/js')
    .js('resources/assets/js/orders.js', 'public/js')
    .js('resources/assets/js/create-user.js', 'public/js')
    .js('resources/assets/js/permission.js', 'public/js')
    .js('resources/assets/js/products.js', 'public/js')
    .js('resources/assets/js/edit-product.js', 'public/js')
    .js('resources/assets/js/show-product.js', 'public/js')
    .js('resources/assets/js/create-suppliers.js', 'public/js')
    .js('resources/assets/js/create-brand.js', 'public/js')
    .js('resources/assets/js/edit-brand.js', 'public/js')
    .js('resources/assets/js/brand.js', 'public/js')
    .js('resources/assets/js/create-categories.js', 'public/js')
    .js('resources/assets/js/edit-categories.js', 'public/js')
    .js('resources/assets/js/categories.js', 'public/js')
    .js('resources/assets/js/create-permission.js', 'public/js')
    .js('resources/assets/js/create-role.js', 'public/js')
    .js('resources/assets/js/role.js', 'public/js')
    .js('resources/assets/js/edit-suppliers.js', 'public/js')
    .js('resources/assets/js/suppliers.js', 'public/js')
    .js('resources/assets/js/show-suppliers.js', 'public/js')
    .js('resources/assets/js/user.js', 'public/js')
    .js('resources/assets/js/show-user.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');