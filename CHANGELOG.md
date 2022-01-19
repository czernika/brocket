# Changelog

## Release 1.4.3

- [Fix] Fixed WPEmerge custom resource path for PrettyPageHandler as it cause error
- [Style] Added `screenshot.png` file
- [Style] Added PHP version badge into repository

Release Date: Jan 20th, 2022

## Release 1.4.2

- [Fix] Fixed pagination issue
- [Feat] Added new query methods
- [Refactor] Refactored Query builders
- [Refactor] Refactored posts Collections to allow any [Collection](https://laravel.com/docs/8.x/collections) method
- [Refactor] `Timber::get_posts()` refactored to `new \Timber\PostQuery()` as it was needed for pagination
- [Refactor] Refactored `query.php` configuration file - added `limit` option which set `posts_per_page` ONLY within all method
- [Docs] Changed return type for `Route` facade to help IDE

Release Date: Jan 20th, 2022

## Release 1.4.1

- [Feat] `new:model` commands are now supports `-m` flag which will create methods to register metaboxes within generated class

Release Date: Jan 19th, 2022

## Release 1.4.0

- [Fix] Added `notAllowedInProduction()` method for `cache:flush` object as it caused error for any command
- [Feat] Added support for theme options with customizer settings
- [Feat] Added `new:customizer:panel` console command
- [Feat] Added `new:customizer:section --panel` console command
- [Feat] Added `CustomizerServiceProvider` provider
- [Docs] Minor description changes across all files 
- [Docs] Added conditional methods for `Mod` facade to help IDE to understand it
- [Docs] Updated `README.md`, added some badges and link to documentation

Release Date: Jan 19th, 2022

## Release 1.3.0

- [Feat] Added support for post types and terms metaboxes
- [Feat] Added `cache:flush` console command
- [Refactor] Removed `QM_DARK_MODE` constant 
- [Refactor] Removed duplicated `timber.limit` options as it was doing nothing
- [Refactor] Refactored `QueryBuilder` class
- [Refactor] Changed `wp-cli.yml` file to be more secure by default. Use `wp-cli.local.yml` file to override it for local development
- [Refactor] Removed "trash" code from testing
- [Docs] Minor description changes across all files 
- [Docs] Added conditional methods for `Route` facade to help IDE to understand it

Release Date: Jan 18th, 2022

## Release 1.2.0

- [Fix] **Breaking**: Timber` lib added as a main dependency of a `Bootstrapper` as not declared TImber caused issues
- [Fix] Removed duplicated `query()` method from `QueryBuilder` 
- [Feat] Added `query.php` configuration file for defining default query params
- [Feat] Added `withStatus()`, `withTrashed()` and `withDrafts()` query methods
- [Feat] Added `withStatus()`, `withTrashed()` and `withDrafts()` query methods
- [Refactor] Refactored `QueryBuilder` class
- [Docs] Added IDE helpers for model objects
- [Docs] Changed theme description

Release Date: Jan 17th, 2022

## Release 1.1.0

- [Feat] Added support for registering custom post types and taxonomies via `models` configuration file
- [Feat] Added `PostType` and `Taxonomy` models with simple query builders
- [Feat] Added `ModelServiceProvider` provider
- [Feat] Console commands for creating Controllers, Providers and some Models
- [Fix] Removed `filp/whoops` package as it was already set within WPEmerge

Release Date: Jan 15th, 2022

## Initial release 1.0.0

Initial setup

Release Date: Jan 14th, 2022