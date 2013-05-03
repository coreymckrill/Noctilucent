                <article>
                    <header class="post-header">
                        <h1 class="post-title">Error 404: Not Found</h1>
                    </header>
	                <div class="post-content">
	                    <p>Unfortunately, nothing exists at this address: <em><?php echo noctilucent_get_protocol() . '//' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?></em></p>
	                    <?php get_search_form(); ?>
	                    <div class="tagcloud"><?php wp_tag_cloud(); ?></div>
		            </div>
                </article>