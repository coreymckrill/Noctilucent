<?php do_action( 'noctilucent_before_loop' ); ?>

            <section class="content">
<?php
do_action( 'noctilucent_prepend_to_content' );
	// noctilucent_insert_section_header
	// noctilucent_insert_search_header

// The Loop
if ( have_posts() ) :

do_action( 'noctilucent_prepend_to_content' );

while ( have_posts() ) : the_post();
	
	get_template_part( 'content', apply_filters( 'noctilucent_content_template', get_post_format() ) );
		// noctilucent_load_page
		// noctilucent_load_archive
		// noctilucent_load_cpt

endwhile;

do_action( 'noctilucent_append_to_content' );
	// noctilucent_load_comments
	// noctilucent_insert_archive_pagination

// No posts
else :

    if ( is_404() ) {
        get_template_part( 'content', '404' );
    } else {
        get_template_part( 'content', 'none' );
    }

endif;

do_action( 'noctilucent_append_to_content' );
	// noctilucent_load_comments
	// noctilucent_insert_archive_pagination
?>
            </section>

<?php do_action( 'noctilucent_after_loop' );
	// noctilucent_insert_default_sidebar
?>