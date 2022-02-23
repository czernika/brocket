/* eslint-disable */

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
require('laravel-mix-simple-image-processing');

/**
 * --------------------------------------------------------------------------
 * Theme constants
 * --------------------------------------------------------------------------
 *
 * Set general theme information
 */
const themePath    = 'web/app/themes/brocooly/';
const publicDir    = 'public/';
const publicPath   = themePath + publicDir;
const resourcePath = themePath + 'resources/assets/';
const imagesDir    = 'images';
const imagesPath   = resourcePath + imagesDir;
const fontsDir     = 'fonts';
const fontsPath    = resourcePath + fontsDir;
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
const browserSyncSettings = {
	proxy,
};
const browserSyncFiles = {
	watch: false, // set to `true` to enable live-reload (will disable `hmr`)
	files: [
		resourcePath + 'views/**/*.twig',
		resourcePath + 'js/**/*.js',
		resourcePath + 'sass/**/*.scss',
		themePath + 'src/**/*.php',
	],
};

/**
 * --------------------------------------------------------------------------
 * Image handler settings
 * --------------------------------------------------------------------------
 *
 * {@link https://www.npmjs.com/package/laravel-mix-simple-image-processing}
 */
const imageConverter = {
	apply: true,
	options: {
		source: imagesPath,
		destination: publicPath + imagesDir,
		imageminPngquantOptions: { quality: [0.75, 0.8] },
		webp: true,
		imageminWebpOptions: { quality: 80 },
	},
};

mix

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
		formatter: 'stylish',
		failOnError: mix.inProduction(),
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
 * Copying Images and Fonts
 * --------------------------------------------------------------------------
 *
 * If images exists in a resource folder copy it to public
 * Otherwise error will be thrown so skip it
 *
 * {@link https://laravel-mix.com/docs/6.0/copying-files}
 */
if (fs.existsSync(imagesPath)) {
	if (imageConverter.apply) {
		mix.imgs(imageConverter.options);
	} else {
		mix.copyDirectory(imagesPath, publicPath + imagesDir);
	}
}

if (fs.existsSync(fontsPath)) {
	mix.copyDirectory(fontsPath, publicPath + fontsDir);
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

module.exports = mix;
