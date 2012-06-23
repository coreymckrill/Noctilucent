<?php

function noctilucent_enqueue_styles() {
	
	// Fonts
	wp_register_style( 'googlefont', noctilucent_get_protocol() . '//fonts.googleapis.com/css?family=Calligraffitti', array() );
	wp_enqueue_style( 'googlefont' );
	
	// Main stylesheet, compiled from Sass
	wp_register_style( 'parent-style', get_template_directory_uri() . '/css/style.css', array( 'googlefont' ) );
	wp_enqueue_style( 'parent-style' );
	
	// Custom stylesheet, for minor edits
	wp_register_style( 'child-style', get_stylesheet_directory_uri() . '/css/style.css', array( 'style' ) );
	wp_enqueue_style( 'child-style' );
	
}
add_action( 'wp_enqueue_scripts', 'noctilucent_enqueue_styles' );