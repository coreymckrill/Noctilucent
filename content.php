                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="post-header">
                        <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						
						<p class="post-meta">
							<span class="post-time"><time datetime="<?php the_time( 'c' ); ?>" pubdate><?php the_time('F j, Y'); ?></time></span>
							<span class="post-author"><?php echo noctilucent_author_link(); ?></span>
							<span class="post-comment-status"><?php ( comments_open() ) ? comments_popup_link( 'No comments', '1 comment', '% comments', 'comments-link' ) : ''; ?></span>
							<?php edit_post_link( 'Edit', ' | ', ''); ?>
						</p>
                    </header>
                    <?php if ( is_search() ) {
						the_excerpt();
					} else {
						the_content( 'Continue reading &ldquo;' . the_title( '', '', false ) . '&rdquo; &raquo;' );
					} ?>
                    <footer class="post-footer">
                        <?php //Post pagination
                        noctilucent_pagination( 'single' );
                        ?>
						
						<?php // Post Meta
						if ( has_category() || has_tag() ) : ?>
						<p class="post-meta">
							<?php if ( has_category() && noctilucent_categorized_blog() ) : ?>
							<span class="post-categories">Categories: <?php the_category( ', ' ); ?></span>
							<?php endif; ?>
							<?php if ( has_tag() ) : ?>
							<span class="post-tags"><?php the_tags(); ?></span>
							<?php endif; ?>
						</p>
						<?php endif; ?>
                    </footer>
                </article>