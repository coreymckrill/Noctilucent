            <section class="content">
<?php
// Section header for archive pages
$nocti_archive_title = noctilucent_section_header();
if ( $nocti_archive_title != '' ) : ?>

                <header>
                    <h3><?php echo $nocti_archive_title; ?></h3>
                </header>
<?php endif;

if ( is_search() ) : ?>

                <p><?php get_search_form(); ?></p>
<?php endif;

// The Loop
if ( have_posts() ) : while ( have_posts() ) : the_post();

    if ( is_page() ) {
        get_template_part( 'content', 'page' );
    } else {
        get_template_part( 'content', get_post_format() );
    }

endwhile;

// Pagination for blog archives
if ( ! is_singular() && 1 != noctilucent_pagination( 'count', false ) ) : ?>
                <footer>
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

endif; ?>

            </section>