<?php
/*
Plugin Name: Blank Markdown Footnotes
Plugin URI: https://github.com/conraid/blank-footnotes
Description: Footnotes in Markdown mode
Version: 0.2
Author: Corrado Franco
Author URI: http://conraid.net
License: GPL-2
Text Domain: footnotes
*/

/*
Copyright (C) 2016 Corrado Franco <conraid (at) linux (dot) it>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 3
of the License, or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function blank_footnotes_init() {
	load_plugin_textdomain( 'blank-footnotes', false, dirname( plugin_basename( __FILE__ ) ) . '/langs' );
}
add_action('plugins_loaded', 'blank_footnotes_init');


function blank_fn_markdown_convert( $content ) {
	
	$post_id = intval(get_the_ID());
	
	$content = preg_replace('/\[\^(\d+)\]:/', "<span class='footnote' id='fn-$post_id-$1'><a href='#fnref-$post_id-$1'>$1</a>.</span>", $content);
	$content = preg_replace('/\[\^(\d+)\]/', "<sup class='footnote' id='fnref-$post_id-$1'><a href='#fn-$post_id-$1' rel='footnote'>$1</a></sup>", $content);
	
	return($content);
}

// Classic method does not work in all occasions
// if ( ! class_exists( 'Jetpack' ) || ! Jetpack::is_module_active( 'photon' ) ) {
if (!in_array("markdown", get_option( 'jetpack_active_modules' ) ) ) {
	add_action('the_content', 'blank_fn_markdown_convert', 1); 
}

// Add more buttons to the text editor
function appthemes_add_quicktags() {
	if ( wp_script_is( 'quicktags' ) ) {
		?>
<script type="text/javascript">
	
	QTags.addButton(
		"bfn_note",
		"<?php esc_html_e( 'Note number', 'blank-footnotes' ); ?>",
		bfn_callback
	);
	
	function bfn_callback() {
		var id = prompt("<?php esc_html_e( 'Enter number note', 'blank-footnotes' ); ?>");
		
		if (id != null) {
			QTags.insertContent('[^' + id +']');
		}
	}
	
	QTags.addButton(
			"bfn_footnote",
			"<?php esc_html_e( 'Note:', 'blank-footnotes' ); ?>",
			bfn_foot_callback
		);
	
	function bfn_foot_callback() {
		var id = prompt("<?php esc_html_e( 'Enter number note', 'blank-footnotes' ); ?>");
		
		if (id != null) {
			QTags.insertContent('[^' + id +']:');
		}
	}

</script>
<?php
	}
}
add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );

// Add more buttons to the Visual editor
function enqueue_mce_plugin_scripts($plugin_array) {
	$plugin_array["bfn_button_plugin"] =  plugin_dir_url(__FILE__) . "bfn.js";
	return $plugin_array;
}

function register_mce_buttons_editor($buttons) {
	array_push($buttons, "bfn");
	array_push($buttons, "bfn_note");
	return $buttons;
}

function bfn_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'enqueue_mce_plugin_scripts' );
		add_filter( 'mce_buttons', 'register_mce_buttons_editor' );
	}
}
add_action('admin_head', 'bfn_add_mce_button');

 
