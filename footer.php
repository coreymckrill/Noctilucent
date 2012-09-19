	</div> <!-- end of #main -->
	
	<?php do_action( 'noctilucent_before_footer' ); ?>
	
	<footer id="footer-site">
		<?php get_sidebar( 'footer' ); ?>
		
		<?php
		$firstyear = new DateTime( '2012-01-01' );
		( $firstyear->format( 'Y' ) == date( 'Y' ) ) ? $copyright = date( 'Y' ) : $copyright = $firstyear->format( 'Y' ) . ' &ndash; ' . date( 'Y' );
		?>

		<p>&copy; <?php echo $copyright; ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
		<p>Site by <a href="http://jupiterwise.com">Jupiterwise Design</a></p>
	</footer>
	
	<?php do_action( 'noctilucent_after_footer' ); ?>

    <?php wp_footer(); ?>

</body>
</html>