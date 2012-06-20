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
            //add_action( 'admin_menu', array( &$this, 'remove_menu_items' ) );
            
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
            //remove_menu_page( 'index.php' );                // Dashboard
			//remove_menu_page( 'edit.php' );                 // Posts
            //remove_menu_page( 'upload.php' );               // Media
            //remove_menu_page( 'link-manager.php' );         // Links
            //remove_menu_page( 'edit.php?post_type=page' );  // Pages
            //remove_menu_page( 'edit-comments.php' );        // Comments
            //remove_menu_page( 'themes.php' );               // Appearance
            //remove_menu_page( 'plugins.php' );              // Plugins
            //remove_menu_page( 'users.php' );                // Users
            //remove_menu_page( 'tools.php' );                // Tools
            //remove_menu_page( 'options-general.php' );      // Settings
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
            //unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
            //unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
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
		
    } // End class Noctilucent_Admin
    
} // End if

$nocti_admin = new Noctilucent_Admin();

?>