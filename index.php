<?php get_header(); ?>

<?php get_template_part( 'loop', apply_filters( 'noctilucent_loop_template', 'index' ) ); ?>

<?php
if( apply_filters( 'noctilucent_sidebar_switch', true ) )
	get_sidebar( apply_filters( 'noctilucent_sidebar_template', null ) );
?>

<?php get_footer(); ?>