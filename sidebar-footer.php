        <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
            <section class="sidebar sidebar-footer">
                <ul>
                    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
                </ul>
            </section>
        <?php endif; ?>