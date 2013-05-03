	</div> <!-- end of #main -->
	
	<?php do_action( 'noctilucent_before_footer' ); ?>
	
	<footer class="site-footer">
		<?php do_action( 'noctilucent_prepend_to_footer' ); ?>
		<?php get_sidebar( 'footer' ); ?>
		<?php do_action( 'noctilucent_append_to_footer' ); ?>
	</footer>
	
	<?php do_action( 'noctilucent_after_footer' );
	   // noctilucent_insert_copyright
	   // noctilucent_insert_credit
	?>

    <?php wp_footer(); ?>

</body>
</html>