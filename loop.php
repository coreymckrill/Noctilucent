            <section class="content">
<?php
// Section header for archive pages
$nocti_archive_title = noctilucent_section_header();
if ( $nocti_archive_title != '' ) : ?>

                <header class="content-header">
                    <h3><?php echo $nocti_archive_title; ?></h3>
                </header>
<?php endif;

if ( is_search() ) : ?>

                <p><?php get_search_form(); ?></p>
<?php endif;
do_action( 'noctilucent_before_loop' );

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

// Pagination for blog archives
if ( ! is_singular() && 1 != noctilucent_pagination( 'count', false ) ) : ?>
                <footer class="content-footer">
                    <?php noctilucent_pagination( 'archive' ); ?>

                </footer>
<?php endif;

// No posts
else :

    if ( is_404() ) {
        get_template_part( 'content', '404' );
    } else {
        get_template_part( 'content', 'none' );
    }

endif;

do_action( 'noctilucent_after_loop' );
?>
            </section>