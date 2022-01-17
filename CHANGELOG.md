# Changelog

## Release 1.3.0

- [Feat] Added support for post types and terms metaboxes
- [Feat] Added `cache:flush` console command
- [Refactor] Removed `QM_DARK_MODE` constant 
- [Refactor] Removed duplicated `timber.limit` options as it was doing nothing
- [Refactor] Refactored `QueryBuilder` class
- [Refactor] Changed `wp-cli.yml` file to be more secure by default. Use `wp-cli.local.yml` file to override it for local development
- [Refactor] Removed "trash" code
- [Docs] Minor description changes across all files 

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