<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function dessertstorm_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'dessertstorm' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function dessertstorm_entry_tags() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {		
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'dessertstorm' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( '%1$s', 'dessertstorm' ) . '</span>', $tags_list );
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit Post', 'dessertstorm' )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function dessertstorm_categorized_blog() {

	if ( false === ( $all_the_cool_cats = get_transient( 'dessertstorm_categories' ) ) ) {

		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'dessertstorm_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so dessertstorm_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so dessertstorm_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in dessertstorm_categorized_blog.
 */
function dessertstorm_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'dessertstorm_categories' );
}
add_action( 'edit_category', 'dessertstorm_category_transient_flusher' );
add_action( 'save_post',     'dessertstorm_category_transient_flusher' );
