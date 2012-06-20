            <section id="sidebar-main" class="sidebar">
                <ul>
            <?php if ( ! dynamic_sidebar( 'sidebar-main' ) ) : ?>

                            <?php
                            $args = array(
                                'before_widget' => '<li class="widget widget_search">',
                                'after_widget'  => '</li>',
                                'before_title'  => '<h2>',
                                'after_title'   => '</h2>'
                            );
                            the_widget( 'WP_Widget_Search', array( 'title' => null ), $args ); ?>

                            <?php
                            $args = array(
                                'before_widget' => '<li class="widget widget_meta">',
                                'after_widget'  => '</li>',
                                'before_title'  => '<h2>',
                                'after_title'   => '</h2>'
                            );
                            the_widget( 'WP_Widget_Meta', array( 'title' => __( 'Meta' ) ), $args ); ?>

            <?php endif; ?>

                </ul>
            </section>