const mix = require('./config/mix.base');

/**
 * --------------------------------------------------------------------------
 * Theme constants
 * --------------------------------------------------------------------------
 *
 * Set general theme information
 */
const themePath    = 'web/app/themes/brocooly/';
const resourcePath = themePath + 'resources/';

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
	.sass(resourcePath + 'sass/app.scss', 'css');
