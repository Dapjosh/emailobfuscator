<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpcloud.cc
 * @since             1.0.0
 * @package           Encrypt_Email
 *
 * @wordpress-plugin
 * Plugin Name:       EncryptEmail
 * Plugin URI:        https://cloudpitcher.com
 * Description:       This is the plugin that allows you to obfuscate email addresses placed on your site such that it is not crawled by bots and spammed.
 * Version:           1.0.0
 * Author:            Oladapo Shiyanbola
 * Author URI:        https://wpcloud.cc
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       encrypt-email
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ENCRYPT_EMAIL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-encrypt-email-activator.php
 */
function activate_encrypt_email() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-encrypt-email-activator.php';
	Encrypt_Email_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-encrypt-email-deactivator.php
 */
function deactivate_encrypt_email() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-encrypt-email-deactivator.php';
	Encrypt_Email_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_encrypt_email' );
register_deactivation_hook( __FILE__, 'deactivate_encrypt_email' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-encrypt-email.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function encrypt_emailCC_hide_email_addresses_sc($atts) {
	$emailaddress_fields = shortcode_atts(array( 'id' => '','email' => ''),$atts);
	$userid = $emailaddress_fields['id'];
	$e_mail = $emailaddress_fields['email'];
	
	if ($e_mail !=='') {
		return '<a href="mailto:'.antispambot($e_mail).'"> '.antispambot($e_mail).'</a>';
	}
	else {
		return '';
	}
}
add_shortcode('email_encryptCC','encrypt_emailCC_hide_email_addresses_sc');

// function run_encrypt_email() {
	
// 	$plugin = new Encrypt_Email();
// 	$plugin->run();

// }
// run_encrypt_email();
