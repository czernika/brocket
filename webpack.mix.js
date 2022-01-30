require('dotenv').config();

const fs   = require('fs');
const path = require('path');
const mix  = require('laravel-mix');

/**
 * --------------------------------------------------------------------------
 * Extensions
 * --------------------------------------------------------------------------
 *
 * {@link https://laravel-mix.com/extensions}
 */
require('laravel-mix-clean');
require('laravel-mix-versionhash');

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
const imagesDir    = 'images';
const imagesPath   = resourcePath + imagesDir;
const iconsPath    = resourcePath + 'icons';

const finalize = m => m.inProduction() ? m.versionHash() : m.sourceMaps();

const { WP_HOME: proxy } = process.env;

const aliases = {
	'@js': path.join(resourcePath, 'js'),
	'@sass': path.join(resourcePath, 'sass'),
};

/**
 * --------------------------------------------------------------------------
 * Browsersync settings
 * --------------------------------------------------------------------------
 *
 * {@link https://laravel-mix.com/docs/6.0/browsersync}
 */
const browserSyncSettings = { proxy };
const browserSyncFiles = {
	watch: false, // set to `true` to enable live-reload (will disable `hmr`)
	files: [
		resourcePath + 'views/**/*.twig',
		resourcePath + 'js/**/*.js',
		resourcePath + 'sass/**/*.scss',
		themePath + 'src/**/*.php',
	],
};

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
	.sass(resourcePath + 'sass/app.scss', 'css')

	/**
	 * --------------------------------------------------------------------------
	 * Configuration options
	 * --------------------------------------------------------------------------
	 *
	 * {@link https://laravel-mix.com/docs/6.0/api#optionsoptions}
	 */
	.options({
		processCssUrls: false,
	})

	/**
	 * --------------------------------------------------------------------------
	 * Disable notifications on success
	 * --------------------------------------------------------------------------
	 *
	 * {@link https://laravel-mix.com/docs/6.0/os-notifications}
	 */
	.disableSuccessNotifications()

	/**
	 * --------------------------------------------------------------------------
	 * Clean output directory in a production mode
	 * --------------------------------------------------------------------------
	 *
	 * {@link https://laravel-mix.com/extensions/clean}
	 */
	.clean({
		dry: ! mix.inProduction(),
	});

/**
 * --------------------------------------------------------------------------
 * Custom webpack configuration
 * --------------------------------------------------------------------------
 *
 * {@link https://laravel-mix.com/docs/6.0/quick-webpack-configuration}
 */
const ESLintPlugin = require('eslint-webpack-plugin');

const plugins = [
	new ESLintPlugin({
		formatter: 'stylish'
	}),
];

/**
 * --------------------------------------------------------------------------
 * Add spritemap svg plugin
 * --------------------------------------------------------------------------
 *
 * {@link https://github.com/cascornelissen/svg-spritemap-webpack-plugin}
 */
const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');

if (fs.existsSync(iconsPath)) {
	plugins.push(
		new SVGSpritemapPlugin(
			iconsPath + '/**/*.svg',
			{
				output: {
					filename: 'spritemap.svg',
				},
				sprite: {
					prefix: 'brocket-',
					generate: {
						title: false,
					},
				},
			},
		),
	);
}

mix.webpackConfig(webpack => {
	return {
		plugins,
	};
});

/**
 * --------------------------------------------------------------------------
 * Aliases
 * --------------------------------------------------------------------------
 *
 * {@link https://laravel-mix.com/docs/6.0/aliases}
 */
mix.alias({...aliases});

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
if (fs.existsSync(imagesPath)) {
	mix.copyDirectory(imagesPath, publicPath + imagesDir);
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
 * Enable browsersync
 * --------------------------------------------------------------------------
 */
if (browserSyncFiles.watch) {
	browserSyncSettings.files = browserSyncFiles.files;
}
mix.browserSync(browserSyncSettings);

/**
 * --------------------------------------------------------------------------
 * Environment dependencies
 * --------------------------------------------------------------------------
 */
finalize(mix);
