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
    .sass('resources/assets/sass/app.scss', 'public/css')
    .browserSync({
        proxy: 'http://social.test',
        browser: 'google chrome',
        port: 3012,
    })
    .webpackConfig({
        resolve: {
            alias: {
                'styles': path.resolve(__dirname, 'resources/assets/sass'),
                '~js': path.resolve(__dirname, 'resources/assets/js'),
            }
        },
    });
