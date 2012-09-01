                <form id="searchform" method="get" action="<?php echo home_url(); ?>/" role="search">
                    <label for="s">Search: </label>
                    <input type="text" id="s" name="s" value="<?php the_search_query(); ?>">
                    <input id="searchsubmit" type="submit" value="Search">
                </form>