                <form class="search" method="get" action="<?php echo trailingslashit( home_url() ); ?>" role="search">
                    <label for="s">Search: </label>
                    <input type="text" name="s" value="<?php the_search_query(); ?>">
                    <input type="submit" value="Search">
                </form>