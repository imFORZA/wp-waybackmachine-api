<?php
/**
 * WP-WayBackMachine-API (https://blog.archive.org/developers/)
 *
 * https://archive.org/help/wayback_api.php
 * http://timetravel.mementoweb.org/guide/api/
 * https://blog.archive.org/developers/
 * @package WP-WayBackMachine-API
 */

/*
* Plugin Name: WP WayBackMachine API
* Plugin URI: https://github.com/wp-api-libraries/wp-waybackmachine-api
* Description: Perform API requests to WayBackMachine in WordPress.
* Author: WP API Libraries
* Version: 1.0.0
* Author URI: https://wp-api-libraries.com
* GitHub Plugin URI: https://github.com/wp-api-libraries/wp-waybackmachine-api
* GitHub Branch: master
*/

/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Check if Class Exists. */
if ( ! class_exists( 'WayBackMachineAPI' ) ) {

	/**
	 * WayBackMachineAPI class.
	 */
	class WayBackMachineAPI {

		/**
		 * Save URL Endpoint
		 *
		 * @var string
		 * @access protected
		 */
		protected $save_uri = 'https://web.archive.org/save/';

		/**
		 * Fetch Archives Endpoint
		 *
		 * @var string
		 * @access protected
		 */
		protected $archives_uri = 'https://web.archive.org/cdx/';

		/**
		 * View Archives Endpoint
		 *
		 * @var string
		 * @access protected
		 */
		protected $view_uri = 'https://web.archive.org/web/';

		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
		}

		/**
		 * Trigger a URL to be archived on the Wayback Machine.
		 *
		 * @param string $url The URL to archive.
		 *
		 * @return string The link to the newly created archive, if it exists.
		 */
		protected function trigger_url_snapshot( $url ) {

			// Ping archive machine.
			$wayback_machine_save_url = $this->save_uri . $url;
			$response = wp_remote_get( $this->save_uri );

			$archive_link = '';

			if ( is_wp_error( $response ) ) {
				return $response;
			} elseif ( ! empty( $response['headers']['x-archive-wayback-runtime-error'] ) ) {
				return new WP_Error( 'wayback_machine_error', $response['headers']['x-archive-wayback-runtime-error'], $response );
			} elseif ( ! empty( $response['headers']['content-location'] ) ) {
				return $response['headers']['content-location'];
			}

		}


		/**
		 * get_archived_snapshots function.
		 *
		 * @access public
		 * @param mixed $url
		 * @param string $timestamp (default: '')
		 * @param string $callback (default: '')
		 * @return void
		 */
		public function get_archived_snapshots( $url, $timestamp = '', $callback = '' ) {
			// http://archive.org/wayback/available?url=example.com
		}

	}

} // Endif().
