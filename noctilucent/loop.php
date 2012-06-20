            <section class="content">
<?php
// Section header for archive pages
$nocti_archive_title = '';
if ( is_category() ) {
    $nocti_archive_title = 'Archive for &ldquo;' . single_cat_title( '', false ) . '&rdquo;';
} elseif ( is_tag() ) {
    $nocti_archive_title = 'Posts tagged &ldquo;' . single_tag_title( '', false ) . '&rdquo;';
} elseif ( is_day() ) {
    $nocti_archive_title = 'Archive for ' . get_the_time('F jS, Y');
} elseif ( is_month() ) {
    $nocti_archive_title = 'Archive for ' . get_the_time('F, Y');
} elseif ( is_year() ) {
    $nocti_archive_title = 'Archive for ' . get_the_time('Y');
} elseif ( is_author() ) {
    $nocti_curauth = get_user_by( 'slug', get_query_var('author_name') );
    $nocti_archive_title = 'Posts by ' . $nocti_curauth->display_name;
} elseif ( is_search() ) {
    global $wp_query;
    $nocti_search_count = $wp_query->found_posts;
    $nocti_search_label = ( $nocti_search_count == 1 ) ? 'result' : 'results';
    $nocti_archive_title = $nocti_search_count . ' search ' . $nocti_search_label . ' for &ldquo;' . get_search_query() . '&rdquo;';
}
if ( $nocti_archive_title !== '' ) : ?>

                <header>
                    <h1><?php echo $nocti_archive_title; ?></h1>
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
                    <?php noctilucent_pagination( 'multi' ); ?>

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