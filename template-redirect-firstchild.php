<?php
/*
Template Name: Redirect To First Child
*/

$args = array(
	'child_of' => get_the_ID(),
	'sort_column' => 'menu_order'
);
$child_pages = get_pages( $args );

$url = '';
if ( is_array( $child_pages ) && ! empty( $child_pages ) )
	$url = get_permalink( $child_pages[0]->ID );

if ( $url ) {
	wp_redirect( $url );
} else {
	get_template_part( 'index' );
}