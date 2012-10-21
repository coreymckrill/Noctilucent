                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="post-header">
                        <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    </header>
                    <?php the_content(); ?>

                    <footer class="post-footer">
                        <?php noctilucent_pagination( 'single' ); ?>

                    </footer>
                </article>