<?php
/**
 * This file runs when the plugin in uninstalled (deleted).
 *
 * @package Blank_Footnotes
 *
 * This will not run when the plugin is deactivated.
 * For now is void.
 */

/**
 * If plugin is not being uninstalled, exit (do nothing).
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
