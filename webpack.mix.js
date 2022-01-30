require('dotenv').config();

const fs  = require('fs')
const mix = require('laravel-mix');

require('laravel-mix-clean');

/**
 * --------------------------------------------------------------------------
 * Theme constants
 * --------------------------------------------------------------------------
 *
 * Set general theme information
 */
const publicDir    = 'public/';
const themePath    = 'web/app/themes/brocooly/';
const publicPath   = themePath + publicDir;
const resourcePath = themePath + 'resources/';

const { WP_HOME: proxy } = process.env;

mix

	/**
	 * --------------------------------------------------------------------------
	 * Javascript files
	 * --------------------------------------------------------------------------
	 *
	 * {@link https://laravel-mix.com/docs/6.0/mixjs}
	 */
	.js(resourcePath + 'js/app.js', 'js')

	/**
	 * --------------------------------------------------------------------------
	 * Styles
	 * --------------------------------------------------------------------------
	 *
	 * {@link https://laravel-mix.com/docs/6.0/sass}
	 * {@link https://laravel-mix.com/docs/6.0/postcss}
	 */
	.sass(resourcePath + 'sass/app.scss', 'css/app.css')

	/**
	 * --------------------------------------------------------------------------
	 * Other options
	 * --------------------------------------------------------------------------
	 */
	.options({
		processCssUrls: false
	})
	.sourceMaps()
	.disableSuccessNotifications()
	.clean();

/**
 * --------------------------------------------------------------------------
 * Copying Images
 * --------------------------------------------------------------------------
 *
 * If images exists in a resource folder copy it to public
 * Otherwise error will be thrown so skip it
 *
 * {@link https://laravel-mix.com/docs/6.0/copying-files}
 */
if (fs.existsSync(resourcePath + 'images')) {
	mix.copyDirectory(resourcePath + 'images', publicPath + 'images');
}

/**
 * --------------------------------------------------------------------------
 * Set public path
 * --------------------------------------------------------------------------
 *
 * {@link https://laravel-mix.com/docs/6.0/api}
 */
mix.setPublicPath(publicPath);

/**
 * --------------------------------------------------------------------------
 * Browsersync settings
 * --------------------------------------------------------------------------
 *
 * Without `files` enabled HMR will work, but no live-reload for `twig` files.
 *
 * {@link https://laravel-mix.com/docs/6.0/browsersync}
 */
mix.browserSync({
	proxy,
	// files: [
		// resourcePath + 'views/**/*.twig',
		// resourcePath + 'js/**/*.js',
		// resourcePath + 'sass/**/*.scss',
		// themePath + 'src/**/*.php',
	// ]
});

/**
 * --------------------------------------------------------------------------
 * Set file version for production
 * --------------------------------------------------------------------------
 *
 * The `?id=` query will be used as file version for `wp_enqueue_` functions
 */
if (mix.inProduction()) {
	mix.version();
}
