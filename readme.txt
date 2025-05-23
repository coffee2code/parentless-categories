=== Parentless Categories ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: categories, category, list, the_category, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 4.6
Tested up to: 6.8
Stable tag: 2.3.1

Provides a template tag like the_category() to list categories assigned to a post except those that have a child category also assigned to the post.

== Description ==

This plugin provides a template tag which acts as a modified version of WordPress's built-in template tag, `the_category()`. `the_category()` lists all categories directly assigned to the specified post. `c2c_parentless_categories()` lists those categories, except for categories that are parents to other assigned categories.

For example, assume your category structure is hierarchical and looks like this:

`
Vegetables
|-- Leafy
|   |-- Broccoli
|   |-- Bok Choy
|   |-- Celery
|-- Fruiting
|   |-- Bell Pepper
|   |-- Cucumber
|   |-- Pumpkin
|-- Podded
|   |-- Chickpea
|   |-- Lentil
|   |-- Soybean
`

If you directly assigned the categories "Fruiting", "Cucumber", and "Pumpkin" to a post, `c2c_parentless_categories()` would return a list that consists of: "Cucumber", and "Pumpkin". Notice that since "Fruiting" was a parent to a directly assigned category, it is not included in the list.

By default, categories are listed as an HTML list. The first argument to the template tag allows you to define a custom separator, e.g. to have a simple comma-separated list of categories: `<?php c2c_parentless_categories( ',' ); ?>`.

As with categories listed via `the_category()`, categories that are listed are presented as links to the respective category's archive page.

Example usage (based on preceding example):

* `<?php c2c_parentless_categories(); ?>`

Outputs something like:

`<ul><li><a href="http://yourblog.com/category/fruiting/cucumber">Cucumber</a></li>
<li><a href="http://yourblog.com/category/fruiting/pumpkin">Pumpkin</a></li></ul>`

* `<?php c2c_parentless_categories( ',' ); ?></ul>`

Outputs something like:

`<a href="http://yourblog.com/category/fruiting/cucumber">Cucumber</a>, <a href="http://yourblog.com/category/fruiting/pumpkin">Pumpkin</a>`

Links: [Plugin Homepage](https://coffee2code.com/wp-plugins/parentless-categories/) | [Plugin Directory Page](https://wordpress.org/plugins/parentless-categories/) | [GitHub](https://github.com/coffee2code/parentless-categories/) | [Author Homepage](https://coffee2code.com)


== Installation ==

1. Install via the built-in WordPress plugin installer. Or install the plugin code inside the plugins directory for your site (typically `/wp-content/plugins/`).
2. Activate the plugin through the 'Plugins' admin menu in WordPress
3. Optional: Add filters for 'c2c_parentless_categories_list' to filter parentless category listing
4. Use the template tag `<?php c2c_parentless_categories(); ?>` in a theme template somewhere inside "the loop"


== Frequently Asked Questions ==

= Why isn't an assigned category for the post showing up in the `c2c_parentless_categories()` listing? =

If an assigned category is the parent for one or more other assigned categories for the post, then the category parent is not included in the listing.

= Does this plugin have unit tests? =

Yes. The tests are not packaged in the release .zip file or included in plugins.svn.wordpress.org, but can be found in the [plugin's GitHub repository](https://github.com/coffee2code/parentless-categories/).


== Developer Documentation ==

Developer documentation can be found in [DEVELOPER-DOCS.md](https://github.com/coffee2code/parentless-categories/blob/master/DEVELOPER-DOCS.md). That documentation covers the template tags and hooks provided by the plugin.

As an overview, these are the template tags provided by the plugin:

* `c2c_parentless_categories()`          : Outputs the parentless categories.
* `c2c_get_parentless_categories_list()` : Returns the list of parentless categories.
* `c2c_get_parentless_categories()`      : Returns the list of parentless categories for the specified post.

These are the hooks provided by the plugin:

* `c2c_parentless_categories` _(action)_, `c2c_get_parentless_categories_list`, `c2c_get_parentless_categories` _(filters)_ :
Allows for an alternative approach to safely invoke each of the identically named functions in such a way that if the plugin were deactivated or deleted, then your calls to the functions won't cause errors on your site.
* `c2c_parentless_categories_list` _(filter)_ :
Customizes the return value of the `c2c_parentless_categories_list()` function.
* `c2c_get_parentless_categories_omit_ancestors` _(filter)_ :
Customizes the function argument indicating if ancestor categories of all directly assigned categories (even if directly assigned themselves) should be omitted from the return list of categories.


== Changelog ==

= 2.3.1 (2025-04-20) =
* Change: Note compatibility through WP 6.8+
* Change: Note compatibility through PHP 8.3+
* Change: Update copyright date (2025)
* Unit tests:
    * Change: Explicitly define return type for overridden method

= 2.3 (2024-08-28) =
Highlights:

This minor release prevents translations from containing unintended markup, notes compatibility through WP 6.6+, removes unit tests from release packaging, and updates copyright date (2024).

Details:

* Change: Prevent translations from containing unintended markup
* Change: Add missing inline comment for translators
* Change: Note compatibility through WP 6.6+
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

= 2.2.1 (2023-05-20) =
* Change: Note compatibility through WP 6.3+
* Change: Update copyright date (2023)

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/parentless-categories/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

= 2.3.1 =
Trivial update: noted compatibility through WP 6.8+ and PHP 8.3+, and updated copyright date (2025)

= 2.3 =
Minor update: prevented translations from containing unintended markup, noted compatibility through WP 6.6+, removed unit tests from release packaging, and updated copyright date (2024)

= 2.2.1 =
Trivial update: noted compatibility through WP 6.3+ and updated copyright date (2023)

= 2.2 =
Minor update: removed support for long-deprecated functions (`parentless_categories()`, `get_parentless_categories_list()`, `get_parentless_categories()`), added DEVELOPER-DOCS.md, noted compatibility through WP 5.8+, and minor reorganization and tweaks to unit tests

= 2.1.5 =
Trivial update: noted compatibility through WP 5.7+ and updated copyright date (2021)

= 2.1.4 =
Trivial update: Restructured unit test file structure and noted compatibility through WP 5.5+.

= 2.1.3 =
Trivial update: Reworded plugin description, added TODO.md file, fixed some documentation typos, updated a few URLs to be HTTPS, and noted compatibility through WP 5.4+

= 2.1.2 =
Trivial update: noted compatibility through WP 5.3+ and updated copyright date (2020)

= 2.1.1 =
Trivial update: modernized unit tests and noted compatibility through WP 5.2+

= 2.1 =
Minor update: checked for post type's support of categories, created CHANGELOG.md to store historical changelog outside of readme.txt, noted compatibility through WP 5.1+, updated copyright date (2019), and minor code improvements

= 2.0.5 =
Trivial update: noted compatibility through WP 4.9+, added README.md for GitHub, updated copyright date (2018), and other minor changes

= 2.0.4 =
Recommended minor update: fixed PHP warning in WP 4.7 due to function deprecation, noted compatibility through WP 4.7+, updated copyright date

= 2.0.3 =
Trivial update: noted compatibility through WP 4.4+ and updated copyright date (2016)

= 2.0.2 =
Trivial update: noted compatibility through WP 4.1+ and updated copyright date

= 2.0.1 =
Trivial update: noted compatibility through WP 4.0+; added plugin icon.

= 2.0 =
Major update: deprecated all existing functions and filters in favor of 'c2c_' prepended versions; added unit tests; noted compatibility is now only for WP 3.6-3.8+

= 1.1.5 =
Trivial update: noted compatibility through WP 3.5+

= 1.1.4 =
Trivial update: noted compatibility through WP 3.4+; explicitly stated license

= 1.1.3 =
Trivial update: noted compatibility through WP 3.3+

= 1.1.2 =
Trivial update: noted compatibility through WP 3.2+

= 1.1.1 =
Trivial update: documentation tweaks; noted compatibility with WP 3.1+ and updated copyright date.

= 1.1 =
Minor update. Highlights: miscellaneous non-functionality tweaks; verified WP 3.0 compatibility.
