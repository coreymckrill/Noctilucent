<?php
/**
 * 
 */

if ( ! class_exists( 'Noctilucent_HomePage' ) ) {
    
    class Noctilucent_HomePage {
        
		/**
		 * Variables
		 */
		public $active = false;
		public $options;
		private $defaults = array(
			'supports'          => array( 'title', 'editor', 'revisions' ),
			'slideshow'         => false,
			'image_size'        => array(
				'slide' => array(
					'width'   => 400,
					'height'  => 300,
					'cropped' => true
				)
			)
		);
		private $prefix = 'noctilucent';
		private $tag    = 'homepage';
		public $label = array(
			'single'    => 'Home Page',
			'single_lc' => 'home page',
			'multi'     => 'Home Pages',
			'multi_lc'  => 'home pages',
			'url'       => 'homepage'
		);
		
		/**
		 * Hook into WordPress
		 */
		function __construct() {
			
			// Actions
			add_action( 'after_setup_theme', array( &$this, 'activate' ), 99 );
			add_action( 'init', array( &$this, 'content_config' ) );
			add_action( 'init', array( &$this, 'image_config' ) );
			add_action( 'init', array( &$this, 'slideshow_config' ) );
			
			// Filters
			add_filter( "current_theme_supports-{$this->prefix}_{$this->tag}", array( &$this, 'theme_support_check' ), 10, 3 );
			
        }
		
		/**
		 * Filter to enable current_theme_supports to return values other
		 * than boolean
		 */
		function theme_support_check( $val, $args, $features ) {
			return $features ? $features : $val;
		}
		
		/**
		 * Enable functions if current theme has support, merge options with defaults
		 */
		function activate() {
			$args = '';
			if ( $args = current_theme_supports( "{$this->prefix}_{$this->tag}", true ) ) {
				$this->active = true;
				$this->options = $this->defaults;
				if ( is_array( $args ) ) {
					$this->options = wp_parse_args( $args[0], $this->options );
				}
			}
		}
		
		/**
		 * Home Page custom post type
		 */
		function content_config() {
			
			if ( ! $this->active )
				return;
			
			extract( $this->label );
			
			// Custom post type.
			register_post_type(
				$this->prefix . '_' . $this->tag,
				array(
					'labels'          => array(
						'name'               => __( $single ),
						'singular_name'      => __( $single ),
						'all_items'          => __( 'All ' . $multi ),
						'add_new'            => _x( 'Add New', $single ),
						'add_new_item'       => __( 'Add New ' . $single ),
						'edit_item'          => __( 'Edit ' . $single ),
						'new_item'           => __( 'New ' . $single ),
						'view_item'          => __( 'View ' . $single ),
						'search_items'       => __( 'Search ' . $multi ),
						'not_found'          => __( 'No ' . $single_lc . ' found' ),
						'not_found_in_trash' => __( 'No ' . $single_lc . ' found in Trash' ),
						'parent_item_colon'  => __( 'Parent ' . $single . ':' ),
						'menu_name'          => __( $single )
					),
					'description'     => '',
					'public'          => true,
					'menu_position'   => 20,
					'menu_icon'       => 'custom',
					'publicly_queryable' => false,
					'capability_type' => 'post',
					'hierarchical'    => false,
					'has_archive'     => false,
					'supports'        => $this->options['supports']
				)
			);
			
			add_action( 'admin_head', array( &$this, 'admin_head_style' ) );
			
		}
		
		/**
		 * Style block for admin header
		 */
		function admin_head_style() {
			$url = admin_url( 'images/menu.png' );
			echo "
			<!-- Begin Noctilucent Home Page styles -->
			<style type=\"text/css\" media=\"screen\">
			#adminmenu .menu-icon-noctilucent_homepage div.wp-menu-image {
				background-image: url('$url');
				background-position: -59px -33px;
			}
			#adminmenu .menu-icon-noctilucent_homepage:hover div.wp-menu-image, #adminmenu .menu-icon-noctilucent_homepage.wp-has-current-submenu div.wp-menu-image, #adminmenu .menu-icon-noctilucent_homepage.current div.wp-menu-image {
				background-position: -59px -1px;
			}
			</style>
			<!-- End Noctilucent Home Page styles -->
			";
		}
		
		/**
		 * Set custom image sizes
		 */
		function image_config() {
			
			if ( ! $this->active )
				return;
			
			$images = $this->options['image_size'];
			
			if ( ! $images )
				return;
			
			add_theme_support( 'post-thumbnails' );
			
			foreach( $images as $image => $size ) {
				add_image_size( "{$this->prefix}_{$this->tag}_{$image}", $size['width'], $size['height'], $size['cropped'] );
			}
			
		}
		
		/**
		 * Activate slideshow functionality
		 */
		function slideshow_config() {
			
			if ( ! $this->active )
				return;
			
			if ( ! $this->options['slideshow'] )
				return;
			
			wp_register_script( 'noctilucent-homepage-slideshow', noctilucent_theme_url( 'js/homepage.js' ), array( 'jquery' ) );
			add_action( 'wp_enqueue_scripts', array( &$this, 'slideshow_enqueue_script' ) );
			
		}
		
		/**
		 * Enqueue script for home page only
		 */
		function slideshow_enqueue_script() {
			if ( is_front_page() )
				wp_enqueue_script( 'noctilucent-homepage-slideshow' );
		}
    
    } // End class Noctilucent_HomePage

	$nocti_homepage = new Noctilucent_HomePage();

} // End if