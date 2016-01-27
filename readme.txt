=== Plugin Name ===
Contributors: conraid
Donate link: http://conraid.net
Tags: footnotes
Requires at least: 4.4
Tested up to: 4.4
Stable tag: 4.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin to show footnotes using markdown notation.

== Description ==

This plugin allows one to create footnotes by using markdown notation.
It only uses footnotes. No other markdown tag is taken into account

Use in this way:

    I have more [^1] to say up here.

    [^1]: To say down here.

If used with jetpack and enabled markdown, it only shows the buttons without modifying the text content.
Unlike jetpack-markdown, footnotes will appear in the exact point where they have been inserted. To go back to text mode click on the footnote number.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the '/wp-content/plugins/plugin-name' directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Configuration ==

No configuration is necessary.

== Changelog ==

= 0.3 =

* Add localization (in /langs)
* Add italian language

= 0.2 =

* Add button for TinyMCE

= 0.1 =

* Initial release
* Markdown footnotes regex
* Add button for text editor