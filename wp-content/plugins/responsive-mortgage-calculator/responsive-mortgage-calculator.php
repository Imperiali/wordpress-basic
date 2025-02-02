<?php
/*
Plugin Name: Responsive Mortgage Calculator
Plugin URI: https://www.amortization-calc.com/mortgage-calculator/
Description: Add a responsive mortgage calculator widget or use the shortcode [mortgagecalculator] or [rmc]. Plenty of options to customize it to your preference.
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: responsive-mortgage-calculator
Author: amortization-calc.com
Author URI: https://www.amortization-calc.com/mortgage-calculator/
Version: 2.5.1
*/
defined( 'LIDD_MC_VERSION' ) || define( 'LIDD_MC_VERSION', '2.5.0' );


// Make sure the plugin is accessed through the appropriate channels
defined('ABSPATH') || die;


// -----------------------------------
// Constants
defined( 'LIDD_MC_OPTIONS' ) or define( 'LIDD_MC_OPTIONS', 'lidd_mc_options' );
defined( 'LIDD_MC_ROOT' ) or define( 'LIDD_MC_ROOT', plugin_dir_path( __FILE__ ) );

function lidd_mc_url() {
    $url = plugin_dir_url( __FILE__ );
    if ( is_ssl() ) $url = str_replace( 'http://', 'https://', $url );
    return $url;
}
defined( 'LIDD_MC_URL' ) or define( 'LIDD_MC_URL', lidd_mc_url() );


// -----------------------------------
// Languages / Internationalization


function lidd_mc_load_plugin_textdomain() {
	load_plugin_textdomain( 'responsive-mortgage-calculator', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'lidd_mc_load_plugin_textdomain' );


// -----------------------------------
// Activation


register_activation_hook( __FILE__, 'lidd_mc_install' );
function lidd_mc_install() {
	// Only add the options if they don't already exist.
	if ( ! get_option( LIDD_MC_OPTIONS ) ) {
		lidd_mc_load_plugin_textdomain(); // Load text domain
		$defaults = include( 'includes/defaults.php' ); // Get defaults
		update_option( LIDD_MC_OPTIONS, $defaults ); // Insert defaults into the options table
	}
}


// -----------------------------------
// Initialization


include ( LIDD_MC_ROOT . 'includes/init.php' );


// -----------------------------------
// That's all, folks!
