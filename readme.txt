=== Parentless Categories ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: categories, category, list, the_category, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 4.6
Tested up to: 5.4
Stable tag: 2.1.2

Like the_category(), list categories assigned to a post, but excluding assigned categories that have a child category also assigned to the post.


== Description ==

This plugin provides a template tag which acts a modified version of WordPress's built-in template tag, `the_category()`. `the_category()` lists all categories directly assigned to the specified post. `c2c_parentless_categories()` lists those categories, except for categories that are parents to other assigned categories.

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

1. Install via the built-in WordPress plugin installer. Or download and unzip `parentless-categories.zip` inside the plugins directory for your site (typically `wp-content/plugins/`)
2. Activate the plugin through the 'Plugins' admin menu in WordPress
3. Optional: Add filters for 'c2c_parentless_categories_list' to filter parentless category listing
4. Use the template tag `<?php c2c_parentless_categories(); ?>` in a theme template somewhere inside "the loop"


== Frequently Asked Questions ==

= Why isn't an assigned category for the post showing up in the `c2c_parentless_categories()` listing? =

If an assigned category is the parent for one or more other assigned categories for the post, then the category parent is not included in the listing.

= Does this plugin include unit tests? =

Yes.


== Template Tags ==

The plugin provides three optional template tags for use in your theme templates.

= Functions =

* `<?php function c2c_parentless_categories( $separator = '', $post_id = false ) ?>`
Outputs the parentless categories.

* `<?php function c2c_get_parentless_categories_list( $separator = '', $post_id = false ) ?>`
Gets the list of parentless categories.

* `<?php function c2c_get_parentless_categories( $post_id = false, $omit_ancestors = true ) ?>`
Returns the list of parentless categories for the specified post.

= Arguments =

* `$separator`
Optional argument. (string) String to use as the separator. Default is '', which indicates unordered list markup should be used.

* `$post_id`
Optional argument. (int) Post ID. If 'false', then the current post is assumed. Default is 'false'.

* `$omit_ancestors`
Optional argument. (bool) Should any ancestor categories be omitted from being listed? If false, then only categories that are directly assigned to another directly assigned category are omitted. Default is 'true'.

= Examples =

* (See Description section)


== Hooks ==

The plugin is further customizable via five hooks. Code using these filters should ideally be put into a mu-plugin or site-specific plugin (which is beyond the scope of this readme to explain). Less ideally, you could put them in your active theme's functions.php file.

**c2c_parentless_categories (action), c2c_get_parentless_categories_list, c2c_get_parentless_categories (filters)**

These actions and filters allow you to use an alternative approach to safely invoke each of the identically named function in such a way that if the plugin were deactivated or deleted, then your calls to the functions won't cause errors on your site.

Arguments:

* (see respective functions)

Example:

Instead of:

`<?php c2c_parentless_categories( ',' ); ?>`

Do:

`<?php do_action( 'c2c_parentless_categories', ',' ); ?>`

**c2c_parentless_categories_list (filter)**

The 'c2c_parentless_categories_list' filter allows you to customize or override the return value of the `c2c_parentless_categories_list()` function.

Arguments:

* string    $thelist   : the HTML-formatted list of categories, or `__( 'Uncategorized' )` if the post didn't have any categories, or an empty string if the post's post type doesn't support categories
* string    $separator : the separator specified by the user, or '' if not specified
* int|false $post_id   : the ID of the post, or false to indicate the current post

Example:

`
/**
 * Amend comma-separated parentless categories listing with a special string.
 *
 * @param  string $thelist The parentless categories list.
 * @param  string $separator Optional. String to use as the separator.
 * @return string
 */
function c2c_parentless_categories_list( $thelist, $separator ) {
	// If not categorized, do nothing
	if ( __( 'Uncategorized' ) == $thelist ) {
		return $thelist;
	}

	// Add a message after a comma separated listing.
	if ( ',' == $separator ) {
		$thelist .= " (* not all assigned categories are being listed)";
	}

	return $thelist;
}
add_filter( 'c2c_parentless_categories_list', 'customize_c2c_parentless_categories_list' );
`

**c2c_get_parentless_categories_omit_ancestors (filter)**

The 'c2c_get_parentless_categories_omit_ancestors' filter allows you to customize or override the function argument indicating if ancestor categories of all directly assigned categories (even if directly assigned themselves) should be omitted from the return list of categories. By default, this argument is true.

Arguments:

* bool $omit_ancestors : the $omit_categories argument sent to the function, otherwise implicitly assumed to be the default

Example:

`
// Don't omit ancestors unless they are the immediate parent of an assigned category
add_filter( 'c2c_get_parentless_categories_omit_ancestors', '__return_false' );
`


== Changelog ==

= 2.1.2 (2019-11-23) =
* Change: Note compatibility through WP 5.3+
* Change: Update copyright date (2020)

= 2.1.1 (2019-06-23) =
* Change: Update unit test install script and bootstrap to use latest WP unit test repo
* Change: Note compatibility through WP 5.2+
* Change: Make minor code formatting tweaks
* Change: Update readme.txt documentation for `c2c_parentless_categories_list` hook to reflect potential for first argument to be empty string

= 2.1 (2019-03-24) =
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

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/parentless-categories/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

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
