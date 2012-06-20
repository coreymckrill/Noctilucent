        </div> <!-- end of #main -->
        <footer>
            <?php get_sidebar( 'footer' ); ?>
            
            <?php
            $firstyear = new DateTime( '2011-01-01' );
            ( $firstyear->format( 'Y' ) == date( 'Y' ) ) ? $copyright = date( 'Y' ) : $copyright = $firstyear->format( 'Y' ) . ' &ndash; ' . date( 'Y' );
            ?>

            <p>&copy; <?php echo $copyright; ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
            <p>Site by <a href="http://jupiterwise.com">Jupiterwise Design</a></p>
        </footer>
    </div> <!-- end of #container -->

    <?php wp_footer(); ?>

</body>
</html>