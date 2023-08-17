<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/Azure/Wordpress-on-Linux-App-Service-plugins/tree/main/azure_app_service_migration
 * @since             1.0.0
 * @package           Azure_app_service_migration
 *
 * @wordpress-plugin
 * Plugin Name:       Azure App Service Migration (Preview)
 * Plugin URI:        https://github.com/Azure/Wordpress-on-Linux-App-Service-plugins/tree/main/azure_app_service_migration
 * Description:       Azure Migration plugin is a free tool for migrating the WordPress sites running anywhere to WordPress hosted on Azure App Service created from Azure Marketplace (Create WordPress on App Service - Microsoft Azure). The tool supports various integrations where your site content can be exported to or imported from for your migration operations. 
 * Version:           1.0.0
 * Requires PHP: 	  7.4
 * Author:            Microsoft
 * Author URI:        https://www.microsoft.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       azure app service migration
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
define( 'AZURE_APP_SERVICE_MIGRATION_VERSION', '1.0.0' );
define( 'AZURE_APP_SERVICE_MIGRATION_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define( 'AZURE_APP_SERVICE_MIGRATION_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-azure_app_service_migration-activator.php
 */
function activate_azure_app_service_migration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-azure_app_service_migration-activator.php';
	Azure_app_service_migration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-azure_app_service_migration-deactivator.php
 */
function deactivate_azure_app_service_migration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-azure_app_service_migration-deactivator.php';
	Azure_app_service_migration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_azure_app_service_migration' );
register_deactivation_hook( __FILE__, 'deactivate_azure_app_service_migration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-azure_app_service_migration.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_azure_app_service_migration() {

	$plugin = new Azure_app_service_migration();
	$plugin->run();

}
run_azure_app_service_migration();
