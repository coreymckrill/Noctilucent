<?php

get_template_part( 'class', 'pagination' );
if ( is_admin() )
    get_template_part( 'class', 'admin' );


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
		
		// Fonts
		wp_register_style( 'googlefont', noctilucent_get_protocol() . '//fonts.googleapis.com/css?family=Calligraffitti', array(), '' );
		wp_enqueue_style( 'googlefont' );
		
		// Main stylesheet, compiled from Sass
		wp_register_style( 'style', get_stylesheet_directory_uri() . '/css/style.css', array( 'googlefont' ), '' );
		wp_enqueue_style( 'style' );
		
		// Custom stylesheet, for minor edits
		wp_register_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css', array( 'style' ), '' );
		wp_enqueue_style( 'custom' );
		
    }
    add_action( 'wp_enqueue_scripts', 'noctilucent_enqueue_styles' );
}


/**
 * Re-register jQuery
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_load_jquery' ) ) {
    function noctilucent_load_jquery() {
		
		$jquery_version = '1.7.1';
		
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
		$modernizr_version = '2.5.3';
		wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.min.js', array(), $modernizr_version );
		wp_enqueue_script( 'modernizr' );
		
		// Comment reply functions
		if ( ! is_admin() && is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		
		// Plugins
		wp_register_script( 'plugins', get_stylesheet_directory_uri() . '/js/plugins.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'plugins' );
		wp_localize_script( 'plugins', 'plugins_js_vars', array(
			'jquery' => home_url() . '/' . WPINC . '/js/jquery/jquery.js'
		) );
		
		// Custom scripts
		wp_register_script( 'script', get_stylesheet_directory_uri() . '/js/script.js', array( 'plugins' ), '', true );
		wp_enqueue_script( 'script' );

    }
    add_action( 'wp_enqueue_scripts', 'noctilucent_enqueue_scripts' );
}


/**
 * Add pingback link
 */
function noctilucent_add_pingback() {
    echo "<link rel='pingback' href='" . get_bloginfo( 'pingback_url' ) . "' />\n";
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
 * Disable RSS Feeds
 * Pluggable
 * 
 * From https://github.com/wycks/WP-Skeleton-Theme/
 */
if ( ! function_exists( 'noctilucent_disable_feed' ) ) {
	function noctilucent_disable_feed() {
		wp_die( 'No feed available, please visit our <a href="' . get_bloginfo( 'url' ) . '">home page</a>.' );
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
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		) );
		register_sidebar( array(
			'id'            => 'sidebar-footer',
			'name'          => 'Footer Widget Area',
			'description'   => 'Widgets placed here will appear in the footer.',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
		) );
    }
    add_action( 'widgets_init', 'noctilucent_sidebars' );
}


/**
 * Custom body classes
 * Pluggable
 */
if ( ! function_exists( 'noctilucent_body_classes' ) ) {
    function noctilucent_body_classes( $classes ) {
        if ( is_singular() )
            $classes[] = 'singular';
        return $classes;
    }
    add_filter( 'body_class', 'noctilucent_body_classes' );
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
 * Custom author link
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

?>