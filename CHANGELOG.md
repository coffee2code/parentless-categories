# Changelog

## 2.3.1 _(2025-04-20)_
* Change: Note compatibility through WP 6.8+
* Change: Note compatibility through PHP 8.3+
* Change: Update copyright date (2025)
* Unit tests:
    * Change: Explicitly define return type for overridden method

## 2.3 _(2024-08-28)_

### Highlights:

This minor release prevents translations from containing unintended markup, notes compatibility through WP 6.6+, removes unit tests from release packaging, and updates copyright date (2024).

### Details:

* Change: Prevent translations from containing unintended markup
* Change: Add missing inline comment for translators
* Change: Note compatibility through WP 6.6+
* Change: Shorten plugin description
* Change: Update copyright date (2024)
* Change: Remove development and testing-related files from release packaging
* New: Add `.gitignore` file
* Unit tests:
    * Allow tests to run against current versions of WordPress
    * New: Add `composer.json` for PHPUnit Polyfill dependency
    * Hardening: Prevent direct web access to `bootstrap.php`
    * Change: In bootstrap, store path to plugin directory in a constant
    * New: Add tests for `c2c_parentless_categories()`
    * New: Add tests for function invocation filters
    * Change: Tweak some inline comment formatting

## 2.2.1 _(2023-05-20)_
* Change: Note compatibility through WP 6.3+
* Change: Update copyright date (2023)

## 2.2 _(2021-10-22)_

### Highlights:

This minor release removes support for long-deprecated functions (`parentless_categories()`, `get_parentless_categories_list()`, `get_parentless_categories()`), adds DEVELOPER-DOCS.md, notes compatibility through WP 5.8+, and minor reorganization and tweaks to unit tests.

### Details:

* Change: Remove long-deprecated functions `parentless_categories()`, `get_parentless_categories_list()`, and `get_parentless_categories()`
* New: Add DEVELOPER-DOCS.md and move template tag and hooks documentation into it
* Change: Tweak installation instruction
* Change: Note compatibility through WP 5.8+
* Unit tests:
    * Change: Restructure unit test directories
        * Change: Move `phpunit/` into `tests/phpunit/`
        * Change: Move `phpunit/bin/` into `tests/`
    * Change: Remove 'test-' prefix from unit test file
    * Change: In bootstrap, store path to plugin file constant
    * Change: In bootstrap, add backcompat for PHPUnit pre-v6.0

## 2.1.5 _(2021-04-16)_
* Change: Note compatibility through WP 5.7+
* Change: Update copyright date (2021)

## 2.1.4 _(2020-09-04)_
* Change: Restructure unit test file structure
    * New: Create new subdirectory `phpunit/` to house all files related to unit testing
    * Change: Move `bin/` to `phpunit/bin/`
    * Change: Move `tests/bootstrap.php` to `phpunit/`
    * Change: Move `tests/` to `phpunit/tests/`
    * Change: Rename `phpunit.xml` to `phpunit.xml.dist` per best practices
* Change: Note compatibility through WP 5.5+
* New: Add a few more possible TODO items

## 2.1.3 _(2020-05-28)_
* New: Add TODO.md and move existing TODO list from top of main plugin file into it
* Change: Use HTTPS for link to WP SVN repository in bin script for configuring unit tests
* Change: Note compatibility through WP 5.4+
* Change: Reword plugin description
* Change: Update links to coffee2code.com to be HTTPS
* Change: Fix typo (missing word) in documentation in readme.txt
* Change: Unit tests: Remove unnecessary unregistering of hooks and thusly delete `tearDown()`

## 2.1.2 _(2019-11-23)_
* Change: Note compatibility through WP 5.3+
* Change: Update copyright date (2020)

## 2.1.1_(2019-06-23)_
* Change: Update unit test install script and bootstrap to use latest WP unit test repo
* Change: Note compatibility through WP 5.2+
* Change: Make minor code formatting tweaks
* Change: Update readme.txt documentation for `c2c_parentless_categories_list` hook to reflect potential for first argument to be empty string

## 2.1 _(2019-03-24)_
* New: Check that the post's post type supports categories before attempting to list any (and if it doesn't, apply `c2c_parentless_categories_list` filter against empty string)
* New: Add CHANGELOG.md file and move all but most recent changelog entries into it
* New: Add inline documentation for hooks
* Change: Use `apply_filters_deprecated()` to formally deprecate the 'parentless_categories' filter
* Change: Specify plugin's textdomain to translation calls for strings
* Change: Cast return value of `c2c_get_parentless_categories_omit_ancestors` filter as boolean
* Change: Use `sprintf()` to produce markup rather than concatenating various strings, function calls, and variables
* Change: Minor refactor to reduce duplication of code
* Change: Split paragraph in README.md's "Support" section into two
* Change: Note compatibility through WP 5.1+
* Change: Drop compatibility with versions of WP older than 4.6
* Change: Update copyright date (2019)
* Change: Update License URI to be HTTPS

## 2.0.5 _(2018-05-20)_
* New: Add README.md
* New: Add GitHub link to readme
* Change: Minor whitespace tweaks to unit test bootstrap
* Change: Rename readme.txt section from 'Filters' to 'Hooks'
* Change: Modify formatting of hook name in readme to prevent being uppercased when shown in the Plugin Directory
* Change: Tweaks installation instructions
* Change: Note compatibility through WP 4.9+
* Change: Update copyright date (2018)

## 2.0.4 _(2017-02-13)_
* Fix: Replace use of deprecated (in WP 4.7) `_usort_terms_by_name()` with `wp_list_sort()` for WP 4.7+
* Change: Update unit test bootstrap
    * Default `WP_TESTS_DIR` to `/tmp/wordpress-tests-lib` rather than erroring out if not defined via environment variable
    * Enable more error output for unit tests
* Change: Note compatibility through WP 4.7+
* Change: Minor readme.txt content and formatting tweaks
* Change: Update copyright date (2017)
* New: Add LICENSE file

## 2.0.3 _(2016-02-02)_
* New: Define 'Text Domain' plugin header attribute.
* New: Create empty index.php to prevent files from being listed if web server has enabled directory listings.
* Change: Explicitly declare methods in unit tests as public.
* Change: Minor reformatting and improvements to internal code documentation.
* Change: Note compatibility through WP 4.4+.
* Change: Update copyright date (2016).

## 2.0.2 _(2015-02-11)_
* Note compatibility through WP 4.1+
* Update copyright date (2015)

## 2.0.1 _(2014-08-30)_
* Minor plugin header reformatting
* Add check to prevent execution of code if file is directly accessed
* Change documentation links to wp.org to be https
* Note compatibility through WP 4.0+
* Add plugin icon

## 2.0 _(2014-01-09)_
* Add `c2c_parentless_categories()`
* Deprecate `parentless_categories()` in favor of `c2c_parentless_categories()`
* Change default behavior of `c2c_parentless_categories()` to omit all ancestor categories by default, instead of just directly assigned categories
* Add optional arg `$omit_ancestors` to `c2c_parentless_categories()` only omitting direct parent categories and not all ancestor categories
* Add filter `c2c_get_parentless_categories_omit_ancestors`
* Add filter `c2c_parentless_categories` to support filter invocation method `c2c_parentless_categories()`
* Add `c2c_get_parentless_categories_list()`
* Deprecate `get_parentless_categories_list()` in favor of `c2c_get_parentless_categories_list()`
* Add filter `c2c_get_parentless_categories_list` to support filter invocation method `c2c_get_parentless_categories_list()`
* Add `c2c_get_parentless_categories()`
* Deprecate `get_parentless_categories()` in favor of `c2c_get_parentless_categories()`
* Add filter `c2c_get_parentless_categories` to support filter invocation method `c2c_get_parentless_categories()`
* Add filter `c2c_parentless_categories_list` (which also passed `$post_id` to the hook)
* Deprecate `parentless_categories` in favor of `c2c_parentless_categories_list`
* Remove harcoded space added after custom separator in `c2c_get_parentless_categories_list()`
* Add unit tests
* Add Filters section to readme.txt to document all filters
* Note compatibility through WP 3.8+
* Drop compatibility with versions of WP older than 3.6
* Update copyright date (2014)
* Code and documentation reformatting (spacing, bracing)
* Change donate link
* Add banner image

## 1.1.5
* Change description in plugin header to make it shorter
* Note compatibility through WP 3.5+
* Update copyright date (2013)

## 1.1.4
* Re-license as GPLv2 or later (from X11)
* Add 'License' and 'License URI' header tags to readme.txt and plugin file
* Remove ending PHP close tag
* Note compatibility through WP 3.4+

## 1.1.3
* Note compatibility through WP 3.3+
* Add link to plugin directory page to readme.txt
* Update copyright date (2012)

## 1.1.2
* Note compatibility through WP 3.2+
* Minor documentation reformatting in readme.txt
* Fix plugin homepage and author links in description in readme.txt

## 1.1.1
* Documentation tweaks
* Note compatibility with WP 3.1+
* Update copyright date (2011)

## 1.1
* Wrap all functions in `if(!function_exists())` check
* Remove docs from top of plugin file (all that and more are in readme.txt)
* Note compatibility with WP 2.9+, 3.0+
* Add PHPDoc documentation
* Minor tweaks to code formatting (spacing)
* Add package info to top of plugin file
* Add Changelog, Template Tags, and Upgrade Notice sections to readme.txt
* Update copyright date
* Remove trailing whitespace

## 1.0
* Initial release
