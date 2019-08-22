<?php
/**
 * Filter the image editor & gallery output
 *
 * @package Mercury Makes Pix
 * @since 1.0.0
 */

// Security.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Sorry, you are not allowed to access this page directly.' );
}

/**
 * Make lazy load default when inserting images in a post
 * To override just edit the contents of the shortcode
 */
function mmp_lazy( $html ) {
	$html = preg_replace( '/(class=".*") \/>/', '$1" loading="lazy" />', $html );
	return $html;
}
add_filter( 'image_send_to_editor', 'mmp_lazy', 10 );

/**
 * Filter attributes for the current gallery image tag to add a 'load="lazy"'
 * attribute
 *
 * @param array   $atts       Gallery image tag attributes.
 * @param WP_Post $attachment WP_Post object for the attachment.
 * @return array (maybe) filtered gallery image tag attributes.
 */
function mmp_filter_gallery_img_atts( $atts, $attachment ) {
	$atts['loading'] = "lazy";

	return $atts;
}

add_filter( 'wp_get_attachment_image_attributes', 'mmp_filter_gallery_img_atts', 10, 2 );