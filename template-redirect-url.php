<?php
/*
Template Name: Redirect To URL
*/

global $wp_query;
$orig_page = get_post( get_the_ID() );
$url = filter_var( $orig_page->post_content, FILTER_VALIDATE_URL );
if ( $url ) {
	wp_redirect( $url );
} else {
	$wp_query->set_404();
	$wp_query->post_count = 0;
	status_header( 404 );
	get_template_part( 'index' );
}