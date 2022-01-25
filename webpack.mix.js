require('dotenv').config();

const fs  = require('fs')
const mix = require('laravel-mix');

require('laravel-mix-clean');

const publicDir    = 'public/';
const themePath    = 'web/app/themes/brocooly/';
const publicPath   = themePath + publicDir;
const resourcePath = themePath + 'resources/';

const { WP_HOME: proxy } = process.env;

mix

	.js(resourcePath + 'js/app.js', 'js')

	.sass(resourcePath + 'sass/app.scss', 'css/app.css')


	.options({
		processCssUrls: false
	})
	.sourceMaps()
	.disableSuccessNotifications()
	.clean();

if (fs.existsSync(resourcePath + 'images')) {
	mix.copyDirectory(resourcePath + 'images', publicPath + 'images');
}

mix.setPublicPath(publicPath);

mix.browserSync({
	proxy,
	// files: [
		// resourcePath + 'views/**/*.twig',
		// resourcePath + 'js/**/*.js',
		// resourcePath + 'sass/**/*.scss',
		// themePath + 'src/**/*.php',
	// ]
});

if (mix.inProduction()) {
	mix.version();
}
