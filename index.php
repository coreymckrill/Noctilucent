<?php
global $is_IE;
if ( is_404() && $is_IE ) {
	ob_start();
	header( "HTTP/1.1 404 Not Found" );
}
?>

<?php get_header( apply_filters( 'noctilucent_header_template', null ) ); ?>

<?php get_template_part( 'loop', apply_filters( 'noctilucent_loop_template', 'index' ) ); ?>

<?php get_footer( apply_filters( 'noctilucent_footer_template', null ) ); ?>