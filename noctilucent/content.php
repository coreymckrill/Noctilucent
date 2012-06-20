                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header>
                        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                        <p>Posted on <time datetime="<?php the_time( 'c' ); ?>" pubdate="pubdate"><?php the_time('F j, Y'); ?></time> by <?php echo noctilucent_author_link(); ?><?php echo ( comments_open() ) ? ' | ' : ''; ( comments_open() ) ? comments_popup_link( 'No comments', '1 comment', '% comments', 'comments-link' ) : ''; ?><?php edit_post_link( 'Edit', ' | ', ''); ?></p>
                    </header>
                    <?php the_content( 'Continue reading &ldquo;' . the_title( '', '', false ) . '&rdquo; &raquo;' ); ?>
                    <footer>
                        <?php
                        //Post pagination
                        noctilucent_pagination( 'single' );
                        
                        // Post Meta
                        if ( has_category() || has_tag() ) : ?>

                        <p class="postmetadata">
                            <?php echo ( has_category() ) ? 'Posted in: ' : ''; the_category( ', ' ); ?><br />
                            <?php the_tags(); ?>

                        </p>
                        <?php endif; ?>

                    </footer>
                </article>

<?php if ( is_single() || is_attachment() ) comments_template(); ?>