            <section id="sidebar-main" class="sidebar" role="complementary">
                <ul>
            <?php if ( ! dynamic_sidebar( 'sidebar-main' ) ) : ?>

                            <?php
                            $args = array(
                                'before_widget' => '<li class="widget widget_search">',
                                'after_widget'  => '</li>',
                                'before_title'  => '<h3 class="widgettitle">',
                                'after_title'   => '</h3>'
                            );
                            the_widget( 'WP_Widget_Search', array( 'title' => null ), $args ); ?>

                            <?php
                            $args = array(
                                'before_widget' => '<li class="widget widget_meta">',
                                'after_widget'  => '</li>',
                                'before_title'  => '<h3 class="widgettitle">',
                                'after_title'   => '</h3>'
                            );
                            the_widget( 'WP_Widget_Meta', array( 'title' => __( 'Meta' ) ), $args ); ?>

            <?php endif; ?>

                </ul>
            </section>