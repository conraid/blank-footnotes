=== Blank Footnotes ===
Contributors: conraid
Donate link: http://conraid.net
Tags: footnotes, footnote, notes, reference, endnotes, formatting
Requires at least: 4.4
Tested up to: 4.8
Stable tag: 1.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple plugin to show footnotes using markdown notation.

== Description ==

This plugin allows one to create footnotes by using markdown notation.
It is for footnotes only. No other markdown tag is taken into account

Example:

    I have more [^1] to say up here.

    [^1]: To say down here.

If used with jetpack and enabled markdown, it only shows the buttons without modifying the text content.
Unlike jetpack-markdown, footnotes will appear in the exact point where they have been inserted. To go back to text mode click on the footnote number.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the '/wp-content/plugins/plugin-name' directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Configuration ==

No configuration is necessary.

== Screenshots ==

1. Visual Editor TinyMCE with plugin actived
2. Popup where you can enter note number
3. Example with the footnotes display

== Changelog ==

= 1.6 =

* Add domain path

= 1.5 =

* Fix typo

= 1.4 =

* Fix translation

= 1.3 =

* Fix jetpack detection

= 1.1 =

* Fix english language
* Fix text editor string
* Fix syntax for Wordpress coding standard

= 1.0 =

* First version in Wordpress plugins directory

= 0.4 =

* Added Documentation in PHPDoc format.
* Renamed some function with bfn_ preposition

= 0.3 =

* Added localization (in langs)
* Added italian language

= 0.2 =

* Added button for text editor
* Added button for TinyMCE

= 0.1 =

* Initial release
* Regex to convert Markdown footnotes to HTML
