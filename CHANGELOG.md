# Changelog

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

## Initial release - 1.0.0

Initial setup

Release Date: Jan 14th, 2022