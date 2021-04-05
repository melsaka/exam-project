const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
	resolve: {
	    alias: {
	        "@": path.resolve(__dirname, "resources/js/")
      	}
  	}
});

mix.js([
	'public/dist/js/tabler.min.js',
	'resources/js/app.js'
], 'public/js/app.js')
.vue()
.styles([
	'public/dist/css/tabler.min.css',
	'public/dist/css/tabler-flags.min.css',
	'public/dist/css/tabler-payments.min.css',
	'public/dist/css/tabler-vendors.min.css',
	'public/dist/css/demo.min.css'
], 'public/css/app.css');
