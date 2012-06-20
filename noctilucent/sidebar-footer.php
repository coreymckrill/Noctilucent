        <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
            <section id="sidebar-footer" class="sidebar">
                <ul>
                    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                </ul>
            </section>
        <?php endif; ?>