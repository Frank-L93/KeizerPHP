const path = require('path')
const mix = require('laravel-mix')
const cssImport = require('postcss-import')
const cssNesting = require('postcss-nesting')

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

mix
    .js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        // prettier-ignore
        cssImport(),
        cssNesting(),
        require('tailwindcss'),
    ])
    .webpackConfig({
        output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
        resolve: {
            extensions: [ '.tsx', '.ts', '.js', '.vue' ],
            alias: {
                'Vue': 'vue/dist/vue.esm-bundler.js',
                '@': path.resolve('resources/js'),
            },
        },
    })
    .version()
    .sourceMaps();
