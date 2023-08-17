<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wordpress.org/plugins/azure-app-service-migration/
 * @since      1.0.0
 *
 * @package    Azure_app_service_migration
 * @subpackage Azure_app_service_migration/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Azure_app_service_migration
 * @subpackage Azure_app_service_migration/includes
 * @author     Microsoft <wordpressdev@microsoft.com>
 */
class Azure_app_service_migration_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'azure_app_service_migration',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
