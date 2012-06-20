                <article>
                    <header>
                        <h1>Error 404: Not Found</h1>
                    </header>
                    <p>Unfortunately, nothing exists at this address: <em><?php echo noctilucent_get_protocol() . '//' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?></em></p>
                    <p><?php get_search_form(); ?></p>
                    <p><?php wp_tag_cloud(); ?></p>
                </article>