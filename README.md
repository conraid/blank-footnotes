# Blank Footnotes

Wordpress Plugin to show footnotes using markdown notation.

## Description 

This plugin allows one to create footnotes by using markdown notation.
It is for footnotes only. No other markdown tag is taken into account

Example:

    I have more [^1] to say up here.

    [^1]: To say down here.

If used with jetpack and enabled markdown, it only shows the buttons without modifying the text content.
Unlike jetpack-markdown, footnotes will appear in the exact point where they have been inserted. To go back to text mode click on the footnote number.

N.B
This plugin also works with Gutenberg. But the button only appears in the Classic Editor.
For now with Gutenberg enter the codes directly.

## Installation

1. Upload the plugin files to the '/wp-content/plugins/plugin-name' directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

## Configuration

No configuration is necessary.

Considering that this plugin, like others working with "markdown", parsing the page every time I load it, I highly recommend using a caching plugin..
