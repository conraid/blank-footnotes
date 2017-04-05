<?php
/**
 * Convert footnotes Markdown in html
 *
 * PHP version 5
 *
 * @category  Wordpress_Plugin
 * @package   Blank_Footnotes
 * @author    Corrado Franco <conraid@linux.it>
 * @copyright 2016 Corrado Franco
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GPL-2
 * @link      https://github.com/conraid/blank-footnotes
 */

/*
Plugin Name: Blank_Footnotes
Plugin URI: https://github.com/conraid/blank-footnotes
Description: Footnotes in Markdown mode
Version: 1.6
Author: Corrado Franco <conraid@linux.it>
Author URI: http://conraid.net
License: GPL-2
Text Domain: blank-footnotes
Domain Path: /langs
*/

/**
 * Copyright 2016 Corrado Franco <conraid@linux.it>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load a plugin’s translated strings.
 *
 * @return void
 */
function bfn_init() {

	// Load file .mo from subdirectory "langs".
	load_plugin_textdomain( 'blank-footnotes', false, dirname( plugin_basename( __FILE__ ) ) . '/langs' );

}
add_action( 'plugins_loaded', 'bfn_init' );

/**
 *  Filter the post content.
 *
 *  Return content with footnotes markdown converted in HTML.
 *
 * @param string $content Content of the current post.
 * @return string Content converted.
 */
function bfn_markdown_convert( $content ) {

	// Get Post ID from database.
	$post_id = intval( get_the_ID() );

	// Regex to convert markdown footnotes to HTML.
	$content = preg_replace( '/\[\^(\d+)\]:/' , "<span class='footnote' id='fn-$post_id-$1'><a href='#fnref-$post_id-$1'>$1</a>.</span>" , $content );

	// Regex to convert markdown reference notes to HTML.
	$content = preg_replace( '/\[\^(\d+)\]/' , "<sup class='footnote' id='fnref-$post_id-$1'><a href='#fn-$post_id-$1' rel='footnote'>$1</a></sup>" , $content );

	return($content);

}
/**
 * Add action blank_fn_markdown_convert if jetpack markdown is not loaded
 *
 * Classic method does not work in all occasions.
 *
 *    if ( ! class_exists( 'Jetpack' ) || ! Jetpack::is_module_active( 'photon' ) ) {
 *      add_action( 'the_content', 'bfn_markdown_convert', 1 );
 *    }
 */
if ( get_option('jetpack_active_modules')) {
	if ( ! in_array( 'markdown', get_option( 'jetpack_active_modules' ), true ) ) {
		add_action( 'the_content', 'bfn_markdown_convert', 1 );
	}
} else {
	add_action( 'the_content', 'bfn_markdown_convert', 1 );
}

/**
 * Add script to footer
 *
 * Add script appthemes_add_quicktags to footer
 * for add more buttons to the text editor
 *
 * @return void
 */
function appthemes_add_quicktags() {

	if ( wp_script_is( 'quicktags' ) ) {
		?>
<script type="text/javascript">

	QTags.addButton(
		"bfn_note",
		"<?php esc_html_e( 'Reference note', 'blank-footnotes' ); ?>",
		bfn_callback
	);

	function bfn_callback() {
		var id = prompt("<?php esc_html_e( 'Enter note number', 'blank-footnotes' ); ?>");

		if (id != null) {
			QTags.insertContent('[^' + id +'] ');
		}
	}

	QTags.addButton(
			"bfn_footnote",
			"<?php esc_html_e( 'Note:', 'blank-footnotes' ); ?>",
			bfn_foot_callback
		);

	function bfn_foot_callback() {
		var id = prompt("<?php esc_html_e( 'Enter note number', 'blank-footnotes' ); ?>");

		if (id != null) {
			QTags.insertContent('[^' + id +']: ');
		}
	}
</script>
<?php
	}
}
add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );

/**
 * Add plugin to the Visual Editor TimyMCE plugins.
 *
 * @param array $plugin_array TinyMCE Plugins.
 * @return array
 */
function bfn_enqueue_mce_plugin_scripts( $plugin_array ) {

	$plugin_array['bfn_button_plugin'] = plugin_dir_url( __FILE__ ) . 'bfn.js';

	return $plugin_array;

}

/**
 * Add more buttons to the Visual Editor TimyMCE
 *
 * @param array $buttons TinyMCE buttons.
 * @return array
 */
function bfn_register_mce_buttons( $buttons ) {

	array_push( $buttons, 'bfn' );
	array_push( $buttons, 'bfn_note' );

	return $buttons;
}

/**
 * Add two buttons to TinyMCE
 *
 * Action bfn_add_mce_button to add two buttons to TinyMCE
 * if WYSIWYG is enabled and user have permissions right
 *
 * @return void
 */
function bfn_add_mce_button() {

	// Check user permissions.
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	// Add filter if WYSIWYG is enabled.
	if ( 'true' === get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'bfn_enqueue_mce_plugin_scripts' );
		add_filter( 'mce_buttons', 'bfn_register_mce_buttons' );
	}

}
add_action( 'admin_head', 'bfn_add_mce_button' );


