<?php

function scuba_countries( $tpl = '%title%', $echo = false ) {
	global $post;

	$qry = new WP_Query( [
		'post_type' => 'location',
		'post_parent__in' => [ 0, 7576 ],
		'post__not_in' => [ 7576 ],
		'order' => 'ASC',
		'orderby' => 'ID',
	] );

	$countries = [];
	while ( $qry->have_posts() ) {
		$qry->the_post();
		$countries[ $post->ID ] = str_replace(
			[ '%title%', '%id%', '%slug%', '%parent%', '%permalink%' ],
			[ get_the_title(), $post->ID, $post->post_name, $post->post_parent, get_the_permalink() ], $tpl );
	}

	if ( $echo ) {
		echo implode( '', $countries );
	}
	return $countries;
}

function scuba_locations( $tpl = '%title%', $echo = false ) {
	global $post;

	$qry = new WP_Query( [
		'post_type' => 'location',
		'post_parent__not_in' => [ 0, 7576 ],
		'order' => 'ASC',
		'orderby' => 'ID',
	] );

	$countries = [];
	while ( $qry->have_posts() ) {
		$qry->the_post();
		$countries[ $post->ID ] = str_replace(
			[ '%title%', '%id%', '%slug%', '%parent%', '%permalink%' ],
			[ get_the_title(), $post->ID, $post->post_name, $post->post_parent, get_the_permalink() ], $tpl );
	}

	if ( $echo ) {
		echo implode( '', $countries );
	}
	return $countries;
}

/**
 * @param array $atts Attributes
 * @param string $content Content
 * @param string $shortcode Shortcode
 *
 * @return string
 */
function scuba_shortcode_from_template(  $atts = [], $content, $shortcode ) {
	ob_start();
	get_template_part( "tpl/$shortcode" );
	return ob_get_clean();
}

add_shortcode( 'location-loop', 'scuba_shortcode_from_template' );

add_shortcode( 'location-dropdown', 'scuba_shortcode_from_template' );