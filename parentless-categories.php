<?php
/**
 * Plugin Name: Parentless Categories
 * Version:     2.2.1
 * Plugin URI:  https://coffee2code.com/wp-plugins/parentless-categories/
 * Author:      Scott Reilly
 * Author URI:  https://coffee2code.com/
 * Text Domain: parentless-categories
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Description: Provides a template tag like <code>the_category()</code> that lists categories assigned to a post, but excludes assigned categories that have a child category also assigned to the post.
 *
 * Compatible with WordPress 4.6 through 6.6+.
 *
 * =>> Read the accompanying readme.txt file for instructions and documentation.
 * =>> Also, visit the plugin's homepage for additional information and updates.
 * =>> Or visit: https://wordpress.org/plugins/parentless-categories/
 *
 * @package Parentless_Categories
 * @author  Scott Reilly
 * @version 2.2.1
 */

/*
	Copyright (c) 2008-2024 by Scott Reilly (aka coffee2code)

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die();

if ( ! function_exists( 'c2c_parentless_categories' ) ) :

/**
 * Outputs the parentless categories.
 *
 * For use in the loop
 *
 * @since 2.0
 *
 * @param  string    $separator Optional. String to use as the separator.
 *                              Default ''.
 * @param  int|false $post_id   Optional. Post ID. If false, then the current
 *                              post is assumed. Default false.
*/
function c2c_parentless_categories( $separator = '', $post_id = false ) {
	echo wp_kses(
		c2c_get_parentless_categories_list( $separator, $post_id ),
		array( 'ul' => array( 'class' => array() ), 'li' => array(), 'a' => array( 'href' => array(), 'title' => array(), 'rel' => array() ) )
	);
}

add_action( 'c2c_parentless_categories', 'c2c_parentless_categories', 10, 2 );

endif;


if ( ! function_exists( 'c2c_get_parentless_categories_list' ) ) :

/**
 * Gets the list of parentless categories.
 *
 * @since 2.0
 *
 * @see get_the_category_list() The WP core function this was originally based on.
 *
 * @param  string    $separator Optional. String to use as the separator.
 *                              Default ''.
 * @param  int|false $post_id   Optional. Post ID. If 'false', then the current
 *                              post is assumed. Default false.
 * @return string    The HTML formatted list of parentless categories
 */
function c2c_get_parentless_categories_list( $separator = '', $post_id = false ) {
	global $wp_rewrite;

	// Check if post's post ype supports categories.
	if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
		/**
		 * Filters the HTML formatted list of parentless categories.
		 *
		 * @since 2.0
		 *
		 * @param string $thelist   The HTML-formatted list of categories, or
		 *                          `__( 'Uncategorized' )` if the post didn't have
		 *                          any categories, or an empty string if the post's
		 *                          post type doesn't support categories.
		 * @param string $separator String to use as the separator.
		 * @param int    $post_id   Post ID.
		 */
		return apply_filters( 'c2c_parentless_categories_list', '', $separator, $post_id );
	}

	$categories = c2c_get_parentless_categories( $post_id );

	if ( ! $categories ) {
		/** This filter is documented in parentless-categories.php */
		return apply_filters(
			'c2c_parentless_categories_list',
			apply_filters_deprecated( 'parentless_categories', array( __( 'Uncategorized', 'parentless-categories' ), $separator ), '2.0', 'c2c_parentless_categories_list' ),
			$separator,
			$post_id
		);
	}

	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? ' tag' : '';

	$thelist = '';

	if ( ! $separator ) {
		$thelist .= '<ul class="post-categories">';
	}

	foreach ( $categories as $i => $category ) {
		if ( $separator ) {
			if ( 0 < $i ) {
				$thelist .= $separator;
			}
		} else {
			$thelist .= "\n\t<li>";
		}

		$thelist .= sprintf(
			'<a href="%s" title="%s" rel="category%s">%s</a>',
			esc_url( get_category_link( $category->term_id ) ),
			/* translators: %s: Category name. */
			esc_attr( sprintf( __( 'View all posts in %s', 'parentless-categories' ), $category->name ) ),
			esc_html( $rel ),
			esc_html( $category->name )
		);

		if ( ! $separator ) {
			$thelist .= '</li>';
		}
	}

	if ( ! $separator ) {
		$thelist .= '</ul>';
	}

	/** This filter is documented in parentless-categories.php */
	return apply_filters(
		'c2c_parentless_categories_list',
		apply_filters_deprecated( 'parentless_categories', array( $thelist, $separator ), '2.0', 'c2c_parentless_categories_list' ),
		$separator,
		$post_id
	);
}

add_filter( 'c2c_get_parentless_categories_list', 'c2c_get_parentless_categories_list', 10, 2 );

endif;


if ( ! function_exists( 'c2c_get_parentless_categories' ) ) :

/**
 * Returns the list of parentless categories for the specified (or current) post.
 *
 * @since 2.0
 *
 * @param  int|false $post_id        Optional. Post ID. If 'false', then the
 *                                   current post is assumed. Default false.
 * @param  bool      $omit_ancestors Optional. Prevent any ancestors from also
 *                                   being listed, not just immediate parents?
 *                                   Default true.
 * @return array     The array of parentless categories for the given category.
 *                   If false, then assumes a top-level category.
 */
function c2c_get_parentless_categories( $post_id = false, $omit_ancestors = true ) {
	$categories = get_the_category( $post_id );

	$cats = $parents = array();

	if ( ! $categories ) {
		return $cats;
	}

	/**
	 * Filters if ancestor categories of all directly assigned categories (even if
	 * directly assigned themselves) should be omitted from the return list of
	 * categories.
	 *
	 * @since 2.0
	 *
	 * @param bool $omit_ancestors Prevent any ancestors from also being listed,
	 *                             not just immediate parents? Default true.
	 */
	$omit_ancestors = (bool) apply_filters( 'c2c_get_parentless_categories_omit_ancestors', $omit_ancestors );

	// Go through all categories and get, then filter out, parents.
	foreach ( $categories as $c ) {
		if ( $c->parent && ! in_array( $c->parent, $parents ) ) {
			if ( $omit_ancestors ) {
				$parents = array_merge( $parents, get_ancestors( $c->term_id, 'category' ) );
			} else {
				$parents[] = $c->parent;
			}
		}
	}
	$parents = array_unique( $parents );

	foreach ( $categories as $c ) {
		if ( ! in_array( $c->term_id, $parents ) ) {
			$cats[] = $c;
		}
	}
	
	// Order categories by name.
	if ( function_exists( 'wp_list_sort' ) ) { // Introduced in WP 4.7
		$cats = wp_list_sort( $cats, 'name' );
	} else {
		usort( $cats, '_usort_terms_by_name' );
	}

	return $cats;
}

add_filter( 'c2c_get_parentless_categories', 'c2c_get_parentless_categories', 10, 2 );

endif;
