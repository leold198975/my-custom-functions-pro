<?php
/**
 * Plugin Name: My Custom Functions Pro
 * Plugin URI: http://mycyberuniverse.com/my_programs/wp-plugin-my-custom-functions-pro.html
 * Description: EASILY and SAFELY add your own functions, snippets or any custom codes directly out of your WordPress Dashboard without need of an external editor.
 * Author: Arthur "Berserkr" Gareginyan
 * Author URI: http://mycyberuniverse.com/author.html
 * Version: 0.1
 * License: GPL3
 * Text Domain: mcfunctions_pro
 * Domain Path: /languages/
 *
 * Copyright 2015  Arthur "Berserkr" Gareginyan  (email : arthurgareginyan@gmail.com)
 *
 * This file is part of "My Custom Functions Pro".
 *
 * "My Custom Functions Pro" is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * "My Custom Functions Pro" is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with "My Custom Functions Pro".  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * Prevent Direct Access
 */
defined('ABSPATH') or die("Restricted access!");

/**
 * Register text domain
 *
 * @since 0.1
 */
function mcfunctions_pro_textdomain() {
	load_plugin_textdomain( 'mcfunctions_pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'mcfunctions_pro_textdomain' );

/**
 * Print direct link to Custom Functions admin page
 *
 * Fetches array of links generated by WP Plugin admin page ( Deactivate | Edit )
 * and inserts a link to the Custom Functions admin page
 *
 * @since  0.1
 * @param  array $links Array of links generated by WP in Plugin Admin page.
 * @return array        Array of links to be output on Plugin Admin page.
 */
function mcfunctions_pro_settings_link( $links ) {
	$settings_page = '<a href="' . admin_url( 'options-general.php?page=my-custom-functions-pro.php' ) .'">' . __( 'Settings', 'mcfunctions_pro' ) . '</a>';
	array_unshift( $links, $settings_page );
	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'mcfunctions_pro_settings_link' );

/**
 * Register "Custom Functions" submenu in "Settings" Admin Menu
 *
 * @since 0.1
 */
function mcfunctions_pro_register_submenu_page() {
	add_options_page( __( 'My Custom Functions Pro', 'mcfunctions_pro' ), __( 'Custom Functions', 'mcfunctions_pro' ), 'manage_options', basename( __FILE__ ), 'mcfunctions_pro_render_submenu_page' );
}
add_action( 'admin_menu', 'mcfunctions_pro_register_submenu_page' );

/**
 * Attach Settings Page
 *
 * @since 0.1
 */
require_once( plugin_dir_path( __FILE__ ) . 'inc/settings_page.php' );

/**
 *  Enqueue jQuery library, Repeater script, CodeMirror scripts and style sheet for setting's page
 *
 * @since 0.1
 */
function mcfunctions_pro_load_scripts($hook) {

    // Return if the page is not a settings page of this plugin
    if ( 'settings_page_my-custom-functions-pro' != $hook ) {
        return;
    }

    // JQuery library
    wp_enqueue_script('jquery');

    // Repeater
    wp_enqueue_script('anarcho-repeater-field', plugin_dir_url(__FILE__) . 'inc/repeater.js');

    // CodeMirror
    wp_enqueue_script('codemirror', plugin_dir_url(__FILE__) . 'inc/codemirror/codemirror-compressed.js');
    wp_enqueue_style('codemirror_style', plugin_dir_url(__FILE__) . 'inc/codemirror/codemirror.css');
    wp_enqueue_script('codemirror-setting', plugin_dir_url(__FILE__) . 'inc/editor.js', array(), false, true);

    // Style sheet
    wp_enqueue_style('styles', plugin_dir_url(__FILE__) . 'inc/style.css');
}
add_action('admin_enqueue_scripts', 'mcfunctions_pro_load_scripts');

/**
 * Register settings
 *
 * @since 0.1
 */
function mcfunctions_pro_register_settings() {
    register_setting( 'mcfunctions_pro_settings_group', 'mcfunctions_pro' );
    register_setting( 'mcfunctions_pro_settings_group', 'mcfunctions_pro_error' );
}
add_action( 'admin_init', 'mcfunctions_pro_register_settings' );

/**
 * Execute My Custom Functions Pro
 *
 * @since 0.1
 */
function mcfunctions_pro_exec() {
     // Read from BD
     $functions = get_option( 'mcfunctions_pro' );
    
     //$functions = $options[@];

     // Cleaning
     $functions = trim( $functions );
     $functions = trim( $functions, '<?php' );

     // Parsing and execute safe
     if ( !empty($functions) ) {
        if( false === @eval( $functions ) ) {
            //ERROR
            update_option( 'mcfunctions_pro_error', '1' );
        } else {
            // Reset error value
            update_option( 'mcfunctions_pro_error', '0' );
        }
     }
}
//mcfunctions_pro_exec();


/**
 * Delete Options on Uninstall
 *
 * @since 0.1
 */
function mcfunctions_pro_uninstall() {
    delete_option( 'mcfunctions_pro' );
    delete_option( 'mcfunctions_pro_error' );
}
register_uninstall_hook( __FILE__, 'mcfunctions_pro_uninstall' );


/* That's all folks! */
?>