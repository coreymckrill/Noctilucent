<?php
/**
 * Required
 */
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
    die( 'Please do not load this page directly. Thanks!' );
if ( post_password_required() ) : ?>
            <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
    return;
endif; ?>

            <aside id="comments">
                <header>
                    <p><?php comments_number('No responses', 'One response', '% responses' ); ?> to &ldquo;<?php the_title(); ?>&rdquo;</p>
                </header>
                
                <?php comment_form(); ?>

<?php if ( have_comments() ) : ?>

<?php if ( get_option( 'page_comments' ) ) :
global $cpage; if ( $cpage == '' ) $cpage = 1;
$nocti_listcounter = ( $cpage - 1 ) * get_option( 'comments_per_page' ); ?>
                <style type="text/css">
                #commentlist { list-style-type: none; counter-reset: item <?php echo $nocti_listcounter; ?>; position: relative; }
                #commentlist > li { counter-increment: item; }
                #commentlist > li:before { content: counter(item) ". "; position: absolute; left: 0; }
                .ie6 #commentlist, .ie7 #commentlist { list-style-type: decimal; }
                </style>
<?php endif; ?>

                <ol id="commentlist">
                    <?php wp_list_comments( array(
                        'type' => 'comment',
                        'callback' => 'noctilucent_comment_markup'
                    ) ); ?>
                </ol>
    <?php if ( get_option( 'page_comments' ) && get_comment_pages_count() > 1 ) : ?>

                <nav><?php paginate_comments_links( array( 'prev_text' => '&lsaquo; Previous', 'next_text' => 'Next &rsaquo;' ) ); ?></nav>
    <?php endif; ?>

<?php else : ?>

            <?php if ( comments_open() ) : ?>
            <?php else : // comments are closed ?>
                <p class="nocomments">Comments are closed.</p>
            <?php endif; ?>

<?php endif; ?>

            </aside>