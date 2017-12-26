<?php

/**
 * @param array $atts Attributes
 * @param string $content Content
 * @param string $shortcode Shortcode
 *
 * @return string
 */
function scuba_shortcode_from_template(  $atts, $content, $shortcode ) {
	ob_start();
	get_template_part( "tpl/$shortcode" );
	return ob_get_clean();
}

add_shortcode( 'location-loop', 'scuba_shortcode_from_template' );