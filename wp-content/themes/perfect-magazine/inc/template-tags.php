<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package perfect-magazine
 */

if ( ! function_exists( 'perfect_magazine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function perfect_magazine_posted_on() {
	global $post;
	$author_id=$post->post_author;
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
		__( 'Published on : %s', 'perfect-magazine' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		__( 'Published by : %s', 'perfect-magazine' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;
function perfect_magazine_posted_author_only()
{
    global $post;
    $author_id=$post->post_author;

    $byline = sprintf(
        __( 'By : %s', 'perfect-magazine' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
    );
    echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}


function perfect_magazine_posted_date_only(){
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
        __( ' %s', 'perfect-magazine' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );
    echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}


function perfect_magazine_posted_category_only(){
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ' ', 'perfect-magazine' ) );
        if ( $categories_list && perfect_magazine_categorized_blog() ) {
            printf( '<span class="item-metadata post-category-label">' .'<span class="item-tablecell">'. esc_html__( ' ', 'perfect-magazine' ).'</span> <span="post-category-label">' .' %1$s'. '</span></span>', $categories_list ); // WPCS: XSS OK.
        }
    }
}
if ( ! function_exists( 'perfect_magazine_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function perfect_magazine_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' ', 'perfect-magazine' ) );
		if ( $categories_list && perfect_magazine_categorized_blog() ) {
			printf( '<span class="item-metadata post-category-label">' .'<span class="item-tablecell">'. esc_html__( 'Categorized in :', 'perfect-magazine' ).'</span> <span="post-category-label">' .' %1$s'. '</span></span>', $categories_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_search() && ! is_archive() && ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'perfect-magazine' ), esc_html__( '1 Comment', 'perfect-magazine' ), esc_html__( '% Comments', 'perfect-magazine' ) );
		echo '</span>';
	}
	if (! is_search() && ! is_archive()){
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( '(Edit This Post) %s', 'perfect-magazine' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}
endif;

if ( ! function_exists( 'perfect_magazine_entry_tags' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
	function perfect_magazine_entry_tags() {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'perfect-magazine' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links item-metadata post-category-label">' .'<span class="item-tablecell">'. esc_html__( 'Tagged in :', 'perfect-magazine' ).'</span> <span="post-category-label">' .' %1$s'. '</span></span>', $tags_list ); // WPCS: XSS OK.
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function perfect_magazine_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'perfect_magazine_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'perfect_magazine_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so perfect_magazine_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so perfect_magazine_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in perfect_magazine_categorized_blog.
 */
function perfect_magazine_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'perfect_magazine_categories' );
}
add_action( 'edit_category', 'perfect_magazine_category_transient_flusher' );
add_action( 'save_post',     'perfect_magazine_category_transient_flusher' );
