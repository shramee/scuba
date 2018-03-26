<?php
add_filter( 'the_title', 'scuba_home_location_titles' );

function scuba_home_location_titles( $title ) {
	global $post;
	if ( $post->post_type === 'location' ) {
		if ( Scubahive::$home && $post->post_parent ) {
			$ancestors = get_post_ancestors( $post->ID );
			$parent = get_post( $ancestors[ count( $ancestors ) - 1 ] );
			$title .= ", $parent->post_title";
		}
	}

	return $title;
}