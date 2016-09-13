<?php
/**
 * WP-WayBackMachine-API
 *
 * @package WP-WayBackMachine-API
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WayBackMachineAPI' ) ) {

	class WayBackMachineAPI {
	
			// Set up Wayback Machine API endpoints.
			$this->wayback_machine_url_save           = 'https://web.archive.org/save/';
			$this->wayback_machine_url_fetch_archives = 'https://web.archive.org/cdx/';
			$this->wayback_machine_url_view           = 'https://web.archive.org/web/';

	
		 /**
		 * Trigger a URL to be archived on the Wayback Machine.
		 *
		 * @param string $url The URL to archive.
		 *
		 * @return string The link to the newly created archive, if it exists.
		 */
		protected function trigger_url_snapshot( $url ) {

			// Ping archive machine.
			$wayback_machine_save_url = $this->wayback_machine_url_save . $url;
			$response = wp_remote_get( $wayback_machine_save_url );

			$archive_link = '';

			if ( is_wp_error( $response ) ) {
				return $response;
			} elseif ( ! empty( $response['headers']['x-archive-wayback-runtime-error'] ) ) {
				return new WP_Error( 'wayback_machine_error', $response['headers']['x-archive-wayback-runtime-error'], $response );
			} elseif ( ! empty( $response['headers']['content-location'] ) ) {
				return $response['headers']['content-location'];
			}

		}
	
	}

}
