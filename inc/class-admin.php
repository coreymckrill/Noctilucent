<?php
/**
 * Modify various aspects of the admin interface for all users
 */

if ( ! class_exists( 'Noctilucent_Admin' ) ) {

    class Noctilucent_Admin {
        
        function __construct() {
			global $user_login;
			get_currentuserinfo();
            
			// Customize top level menu order
			//add_filter( 'custom_menu_order', array( &$this, 'custom_menu_order' ) );
			//add_filter( 'menu_order', array( &$this, 'custom_menu_order' ) );
			
			// Remove top level menu items
            add_action( 'admin_menu', array( &$this, 'remove_menu_items' ) );
            
			// Remove submenu items
            add_action( 'admin_init', array( &$this, 'remove_submenu_items' ) );
            
			// Remove dashboard widgets
            //add_action( 'wp_dashboard_setup', array( &$this, 'remove_dashboard_widgets' ) );
            
			// Remove standard widgets
            //add_action( 'widgets_init', array( &$this, 'remove_standard_widgets' ), 1 );
            
			// Remove meta boxes from built-in post types
            //add_action( 'admin_menu', array( &$this, 'remove_builtin_meta_boxes' ) );

	        // Suppress update notifications for non-admins
	        if ( ! current_user_can( 'update_plugins' ) ) {
		        add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
		        add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
	        }

	        // Edit first row of Visual Editor buttons
	        add_filter( 'mce_buttons', array( &$this, 'tinymce_nextpage' ) );

			// Set visual editor's image link default to none
			add_action( 'admin_init', array( &$this, 'imglink_default' ), 10 );

	        // Visual editor styling
	        add_editor_style( noctilucent_theme_url( 'css/editor-style.css' ) );

        } // End function __construct
        
		function custom_menu_order( $menu_ord ) {
			if ( ! $menu_ord ) return true;
			return array(
				'index.php', 				// Dashboard
				'edit.php?post_type=page', 	// Pages
				'edit.php', 				// Posts
			);
		}
		
        function remove_menu_items() {
            $menu_items = array(
	            'Dashboard'  => 'index.php',
	            'Posts'      => 'edit.php',
	            'Media'      => 'upload.php',
	            'Links'      => 'link-manager.php',
	            'Pages'      => 'edit.php?post_type=page',
	            'Comments'   => 'edit-comments.php',
	            'Appearance' => 'themes.php',
	            'Plugins'    => 'plugins.php',
	            'Users'      => 'users.php',
	            'Tools'      => 'tools.php',
	            'Settings'   => 'options-general.php'
            );

	        $remove = apply_filters( 'noctilucent_admin_remove_menu_items', array(
				'Links'
		    ) );

	        foreach ( $remove as $name ) {
		        if ( isset( $menu_items[$name] ) )
		            remove_menu_page( $menu_items[$name] );
	        }
        } // End function remove_menu_items
        
        function remove_submenu_items() {
            //remove_submenu_page( 'index.php', 'update-core.php' );
            remove_submenu_page( 'themes.php', 'theme-editor.php' );
            remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
            //remove_submenu_page( 'options-general.php', 'options-discussion.php' );
        } // End function remove_submenu_items

        function remove_dashboard_widgets(){
            global $wp_meta_boxes;
            //unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
            //unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
            //unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
            //unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
            unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
            unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
            //unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
            //unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
        } // End function remove_dashboard_widgets

        function remove_standard_widgets(){
            //unregister_widget( 'WP_Widget_Pages' );
            //unregister_widget( 'WP_Widget_Links' );
            //unregister_widget( 'WP_Widget_Search' );
            //unregister_widget( 'WP_Widget_Archives' );
            //unregister_widget( 'WP_Widget_Meta' );
            //unregister_widget( 'WP_Widget_Calendar' );
            //unregister_widget( 'WP_Widget_Text' );
            //unregister_widget( 'WP_Widget_Categories' );
            //unregister_widget( 'WP_Widget_Recent_Posts' );
            //unregister_widget( 'WP_Widget_Recent_Comments' );
            //unregister_widget( 'WP_Widget_RSS' );
            //unregister_widget( 'WP_Widget_Tag_Cloud' );
            //unregister_widget( 'WP_Nav_Menu_Widget' );
        } // End function remove_standard_widgets

        function remove_builtin_meta_boxes() {
            //remove_meta_box( 'postcustom', 'page', 'normal' );
            //remove_meta_box( 'postexcerpt', 'page', 'normal' );
            //remove_meta_box( 'commentstatusdiv', 'page', 'normal' );
            //remove_meta_box( 'commentsdiv', 'page', 'normal' );
            //remove_meta_box( 'authordiv', 'page', 'normal' );
        } // End function remove_builtin_meta_boxes

	    // Add nextpage button to TinyMCE
	    function tinymce_nextpage( $mce_buttons ) {
		    $pos = array_search( 'wp_more', $mce_buttons, true );
		    if ( $pos !== false ) {
			    $tmp_buttons = array_slice( $mce_buttons, 0, $pos + 1 );
			    $tmp_buttons[] = 'wp_page';
			    $mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos + 1 ) );
		    }
		    return $mce_buttons;
	    }

		// Set image link default to none
		// http://andrewnorcross.com/tutorials/functions-file/stop-hyperlinking-images/
		function imglink_default() {
			$image_set = get_site_option( 'image_default_link_type' );
			if ( $image_set !== 'none' ) {
				update_site_option( 'image_default_link_type', 'none' );
			}
		}
		
    } // End class Noctilucent_Admin
    
} // End if

$nocti_admin = new Noctilucent_Admin();