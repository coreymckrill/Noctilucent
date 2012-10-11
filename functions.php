<?php

/**
 * Includes
 */
get_template_part( 'class', 'pagination' );
get_template_part( 'class', 'breadcrumbs' );
if ( is_admin() ) {
    get_template_part( 'class', 'admin' );
}


/**
 * Determine HTTP protocol
 */
function noctilucent_get_protocol() {
    $protocol = ( is_ssl() ? 'https:' : 'http:' );
    return $protocol;
}


/**
 * Enqueue stylesheets
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_enqueue_styles' ) ) {
    function noctilucent_enqueue_styles() {
		
		// Main stylesheet
		wp_register_style( 'style', get_stylesheet_directory_uri() . '/css/style.css', array() );
		wp_enqueue_style( 'style' );
		
    }
    add_action( 'wp_enqueue_scripts', 'noctilucent_enqueue_styles' );
}


/**
 * Re-register jQuery
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_load_jquery' ) ) {
    function noctilucent_load_jquery() {
		
		$jquery_version = '1.8.2';
		
		if ( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', noctilucent_get_protocol() . '//ajax.googleapis.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js', array(), $jquery_version, true );
			wp_enqueue_script( 'jquery' );
		}
		
    }
    add_action( 'wp_enqueue_scripts', 'noctilucent_load_jquery' );
}


/**
 * Enqueue script files
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_enqueue_scripts' ) ) {
    function noctilucent_enqueue_scripts() {
		
		// Modernizr
		$modernizr_version = '2.6.1';
		wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-' . $modernizr_version . '.min.js', array(), $modernizr_version );
		wp_enqueue_script( 'modernizr' );
		
		// Comment reply functions
		if ( ! is_admin() && is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		
		// Plugins
		wp_register_script( 'plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'plugins' );
		wp_localize_script( 'plugins', 'plugins_js_vars', array(
			'ajax'           => admin_url( 'admin-ajax.php', noctilucent_get_protocol() . '//' ),
			'home_url'       => home_url(),
			'jquery'         => home_url() . '/' . WPINC . '/js/jquery/jquery.js'
		) );
		
		// Custom scripts
		wp_register_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'plugins' ), '', true );
		wp_enqueue_script( 'main' );

    }
    add_action( 'wp_enqueue_scripts', 'noctilucent_enqueue_scripts' );
}


/**
 * Clean up <head>
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_head_cleanup' ) ) {
    function noctilucent_head_cleanup() {
		
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'start_post_rel_link' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link' );
		//remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		add_action( 'wp_head', 'noctilucent_add_pingback', 3 );
		
    }
    add_action( 'init', 'noctilucent_head_cleanup' );
}

	/**
	 * Add pingback link
	 */
	function noctilucent_add_pingback() {
		echo "<link rel='pingback' href='" . get_bloginfo( 'pingback_url' ) . "' />\n";
	}


/**
 * Disable RSS Feeds
 * Pluggable
 * 
 * From https://github.com/wycks/WP-Skeleton-Theme/
 */
if ( ! function_exists( 'noctilucent_disable_feed' ) ) {
	function noctilucent_disable_feed() {
		wp_die( 'No feed available, please visit our <a href="' . home_url() . '">home page</a>.' );
	}
	//add_action( 'do_feed', 'noctilucent_disable_feed', 1 );
	//add_action( 'do_feed_rdf', 'noctilucent_disable_feed', 1 );
	//add_action( 'do_feed_rss', 'noctilucent_disable_feed', 1 );
	//add_action( 'do_feed_rss2', 'noctilucent_disable_feed', 1 );
	//add_action( 'do_feed_atom', 'noctilucent_disable_feed', 1 );
}


/**
 * Theme support
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_theme_support' ) ) {
    function noctilucent_theme_support() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		/* add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		) ); */
		//add_editor_style( '/css/layout-style.css' );
    }
    add_action( 'after_setup_theme', 'noctilucent_theme_support' );
}


/**
 * Menus
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_menus' ) ) {
    function noctilucent_menus() {
		register_nav_menus( array(
			'primary' => 'Primary Menu'
		) );
    }
    add_action( 'after_setup_theme', 'noctilucent_menus' );
}


/**
 * Sidebars
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_sidebars' ) ) {
    function noctilucent_sidebars() {
		register_sidebar( array(
			'id'            => 'sidebar-main',
			'name'          => 'Main Widget Area',
			'description'   => 'Widgets placed here will appear in the side column.',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
		register_sidebar( array(
			'id'            => 'sidebar-footer',
			'name'          => 'Footer Widget Area',
			'description'   => 'Widgets placed here will appear in the footer.',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>'
		) );
    }
    add_action( 'widgets_init', 'noctilucent_sidebars' );
}


/**
 * Content width
 * Pluggable
 *
 * $content_width is used to determine the intermediate image sizes in image_send_to_editor. The "large" image size will be set to the value of $content_width.
 * http://wordpress.stackexchange.com/questions/6499/how-to-create-a-conditional-content-width-for-a-wordpress-theme
 */
if ( ! isset( $content_width ) )
	$content_width = 640;


/**
 * Theme setup wrapper to allow child themes to change/remove actions and filters
 */
if ( ! function_exists( 'noctilucent_theme_setup' ) ) {
	function noctilucent_theme_setup() {
		
		// Modify contents of title tag
		add_filter( 'wp_title', 'noctilucent_title_tag', 10, 3 );
		
		// Body classes
		add_filter( 'body_class', 'noctilucent_body_classes' );
		
		// Insert primary nav after header
		add_action( 'noctilucent_after_header', 'noctilucent_insert_primary_nav' );
		
		// Insert copyright string and credit string after footer
		add_action( 'noctilucent_after_footer', 'noctilucent_insert_copyright' );
		add_action( 'noctilucent_after_footer', 'noctilucent_insert_credit' );
		
		// Unsuck gallery styling
		add_filter( 'gallery_style', 'noctilucent_edit_gallery_style' );
		
	}
	add_action( 'after_setup_theme', 'noctilucent_theme_setup', 10 );
}

	/**
	 * Filter the title tag to add site info
	 * Pluggable
	 */
	if ( ! function_exists( 'noctilucent_title_tag' ) ) {
		function noctilucent_title_tag( $title, $sep, $seplocation ) {
			
			global $page, $paged;
			$site_label = get_bloginfo( 'name' );
			
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				$site_label .= " $sep $site_description";
			
			if ( ! $title )
				return $site_label;
			
			if ( $seplocation == 'right' ) {
				$output = "$title $site_label";
			} else {
				$output = "$site_label $title";
			}
			
			if ( $paged >= 2 || $page >= 2 )
				$output .= " $sep " . sprintf( 'Page %s', max( $paged, $page ) );
			
			return $output;
		
		}
	}

	/**
	 * Custom body classes
	 * Pluggable
	 */
	if ( ! function_exists( 'noctilucent_body_classes' ) ) {
		function noctilucent_body_classes( $classes ) {
			if ( is_singular() )
				$classes[] = 'singular';
			if ( is_page() ) {
				global $post;
				$slug = $post->post_name;
				$classes[] = 'page-' . $slug;
			}
			return $classes;
		}
	}

	/**
	 * Insert primary nav
	 * Pluggable
	 */
	if ( ! function_exists( 'noctilucent_insert_primary_nav' ) ) {
		function noctilucent_insert_primary_nav() {
			wp_nav_menu( array(
				'container'         => 'nav',
				'container_id'      => 'nav-primary',
				'theme_location'    => 'primary',
				'fallback_cb'       => 'noctilucent_page_menu'
			) );
		}
	}
	
	/**
	 * Insert copyright string
	 * Pluggable
	 */
	if ( ! function_exists( 'noctilucent_insert_copyright' ) ) {
		function noctilucent_insert_copyright() { ?>
			<p class="site-copyright">&copy; <?php echo noctilucent_copyright_date(); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
		<?php }
	}
	
	/**
	 * Insert credit string
	 * Pluggable
	 */
	if ( ! function_exists( 'noctilucent_insert_credit' ) ) {
		function noctilucent_insert_credit() { ?>
			<p class="site-credit">Site by <a href="http://jupiterwise.com">Jupiterwise Design</a>.</p>
		<?php }
	}

	/**
	 * Pare down the inline gallery CSS to allow for more flexibility in the
	 * stylesheets
	 *
	 * Pluggable
	 */
	if ( ! function_exists( 'noctilucent_edit_gallery_style' ) ) {
		function noctilucent_edit_gallery_style( $input ) {
			$match = preg_match( '/\#(.*) {\n/', $input, $selector );
			$match = preg_match( '/float: (.*);\n/', $input, $float );
			$match = preg_match( '/width: (.*)%;\n/', $input, $itemwidth );
			$match = preg_match( '/\n\t\t<div(.*)$/', $input, $div );
			$output = "
			<style type='text/css'>
				#{$selector[1]} .gallery-item {
					float: {$float[1]};
					width: {$itemwidth[1]}%;
				}
			</style>
			";
			$output .= '<div' . $div[1];
			echo $output;
		}
	}


/**
 * Link to author archive 
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_author_link' ) ) {
    function noctilucent_author_link() {
		
		$current_author_url = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );
		$current_author_link = '<a href="' . $current_author_url . '" title="Posts written by ' . get_the_author_meta( 'display_name' ) . '">' . get_the_author_meta( 'display_name' ) . '</a>';
		
		return $current_author_link;
	
    }
}


/**
 * Generates a year or a range of years
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_copyright_date' ) ) {
	function noctilucent_copyright_date( $firstyear = '', $sep = ' &ndash; ' ) {
		
		try {
			$firstyear = new DateTime( $firstyear );
		} catch ( Exception $e ) {
			$firstyear = new DateTime();
		}
		
		if ( ! is_string( $sep ) )
			$sep = ' &ndash; ';
		
		( $firstyear->format( 'Y' ) == date( 'Y' ) ) ? $copyright = date( 'Y' ) : $copyright = $firstyear->format( 'Y' ) . $sep . date( 'Y' );
		
		return $copyright;
		
	}
}


/**
 * Custom comment markup
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_comments' ) ) {
    function noctilucent_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch( $comment->comment_type ) :
			case '' :
	?>

	<li>
	    <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<header>
				<?php echo get_avatar( $comment, $size = '48', $default = '<path_to_url>' ); ?>
		
				<time datetime="<?php comment_time( 'c' ); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php comment_date(); ?> at <?php comment_time(); ?></a></time><?php edit_comment_link( 'Edit', ' | ', '' ) ?><br />
				<cite class="comment-author"><?php comment_author_link(); ?></cite> <span class="says">says:</span>
			</header>
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
		
			<p class="comment-moderation">Your comment is awaiting moderation.</p>
			<?php endif; ?>
		
			<?php comment_text() ?>
		
			<footer>
				<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		
			</footer>
	    </article>
    <?php
				break;
			case 'pingback' :
			case 'trackback' : 
	?>

	<li>
		<article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<?php echo get_avatar( $comment, $size = '48', $default = '<path_to_url>' ); ?>
	
			<time datetime="<?php comment_time( 'c' ); ?>"><?php comment_date(); ?> at <?php comment_time(); ?></time><?php edit_comment_link( 'Edit', ' | ', '' ) ?><br />
			<cite class="comment-author"><?php comment_author_link(); ?></cite>
		</article>
	<?php
				break;
		endswitch;
    // </li> is added by wordpress automatically
    }
}


/**
 * Modification of wp_page_menu to allow for custom container.
 * Emulates wp_nav_menu.
 * Added arguments:
 * - container
 * - container_id
 * - container_class
 */
if ( ! function_exists( 'noctilucent_page_menu' ) ) {
	function noctilucent_page_menu( $args = array() ) {
			$defaults = array(
				'sort_column'     => 'menu_order, post_title',
				'menu_class'      => 'menu',
				'echo'            => true,
				'link_before'     => '',
				'link_after'      => '',
				'container'       => 'div',
				'container_id'    => '',
				'container_class' => ''
			);
			$args = wp_parse_args( $args, $defaults );
			$args = apply_filters( 'wp_page_menu_args', $args );
			
			$menu = '';
	
			$list_args = $args;
	
			// Show Home in the menu
			if ( ! empty($args['show_home']) ) {
					if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
							$text = __('Home');
					else
							$text = $args['show_home'];
					$class = '';
					if ( is_front_page() && !is_paged() )
							$class = 'class="current_page_item"';
					$menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
					// If the front page is a page, add it to the exclude list
					if (get_option('show_on_front') == 'page') {
							if ( !empty( $list_args['exclude'] ) ) {
									$list_args['exclude'] .= ',';
							} else {
									$list_args['exclude'] = '';
							}
							$list_args['exclude'] .= get_option('page_on_front');
					}
			}
	
			$list_args['echo'] = false;
			$list_args['title_li'] = '';
			$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
			
			$menu_class = '';
			if ( $args['menu_class'] )
				$menu_class = ' class="' . esc_attr( $args['menu_class'] ) . '"';
			
			if ( $menu )
				$menu = "<ul{$menu_class}>{$menu}</ul>";
	
			$container = '';
			if ( $args['container'] )
				$container = ( $args['container'] == 'nav' ) ? 'nav' : 'div';
			
			$container_id = '';
			if ( $args['container_id'] )
				$container_id = ' id="' . esc_attr( $args['container_id'] ) . '"';
				
			$container_class = '';
			if ( $args['container_class'] )
				$container_class = ' class="' . esc_attr( $args['container_class'] ) . '"';
	
			if ( $container && $menu )
				$menu = "<{$container}{$container_id}{$container_class}>{$menu}</{$container}>\n";
			
			$menu = apply_filters( 'wp_page_menu', $menu, $args );
			if ( $args['echo'] )
				echo $menu;
			else
				return $menu;
	}
}


/**
 * Generate section header based on the type of archive page
 */
if ( ! function_exists( 'noctilucent_section_header' ) ) {
	function noctilucent_section_header() {
		
		global $wp_query;
		
		$section_header = '';
		
		if ( is_category() ) {
			$section_header = 'Archive for &ldquo;' . single_cat_title( '', false ) . '&rdquo;';
		} elseif ( is_tag() ) {
			$section_header = 'Posts tagged &ldquo;' . single_tag_title( '', false ) . '&rdquo;';
		} elseif ( is_day() ) {
			$section_header = 'Archive for ' . get_the_time('F jS, Y');
		} elseif ( is_month() ) {
			$section_header = 'Archive for ' . get_the_time('F, Y');
		} elseif ( is_year() ) {
			$section_header = 'Archive for ' . get_the_time('Y');
		} elseif ( is_author() ) {
			$curauth = get_user_by( 'slug', get_query_var('author_name') );
			$section_header = 'Posts by ' . $curauth->display_name;
		} elseif ( is_search() ) {
			$search_count = $wp_query->found_posts;
			$search_label = ( $search_count == 1 ) ? 'result' : 'results';
			$section_header = $search_count . ' search ' . $search_label . ' for &ldquo;' . get_search_query() . '&rdquo;';
		}
		
		return $section_header;
	
	}
}


/**
* Returns true if a blog has more than 1 category
*
* From https://github.com/Automattic/_s/
*/
if ( ! function_exists( 'noctilucent_categorized_blog' ) ) {
	function noctilucent_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
			// Create an array of all the categories that are attached to posts
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );
			
			// Count the number of categories that are attached to the posts
			$all_the_cool_cats = count( $all_the_cool_cats );
			
			set_transient( 'all_the_cool_cats', $all_the_cool_cats );
		}
		
		if ( '1' != $all_the_cool_cats ) {
			// This blog has more than 1 category so _s_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so _s_categorized_blog should return false
			return false;
		}
	}
}


/**
 * Add nextpage button to TinyMCE
 */
if ( ! function_exists( 'noctilucent_tinymce_nextpage' ) ) {
	function noctilucent_tinymce_nextpage( $mce_buttons ) {
		$pos = array_search( 'wp_more', $mce_buttons, true );
		if ( $pos !== false ) {
			$tmp_buttons = array_slice( $mce_buttons, 0, $pos + 1 );
			$tmp_buttons[] = 'wp_page';
			$mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos + 1 ) );
		}
		return $mce_buttons; 
	}
	add_filter( 'mce_buttons', 'noctilucent_tinymce_nextpage' );
}
