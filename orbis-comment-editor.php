<?php
/*
Plugin Name: Orbis Comment Editor
Plugin URI: http://www.orbiswp.com/
Description: The Orbis Comment Editor plugin convert the comments textarea to a WordPress editor.

Version: 1.0.0
Requires at least: 3.5

Author: Pronamic
Author URI: http://www.pronamic.eu/

Text Domain: orbis-comment-editor
Domain Path: /languages/

License: Copyright (c) Pronamic

GitHub URI: https://github.com/pronamic/wp-orbis-comment-editor
*/

/**
 * Proper way to enqueue scripts and styles.
 */
function orbis_comment_form_enqueue_scripts() {
	wp_register_script(
		'orbis-comment-editor',
		plugins_url( 'script.js', __FILE__ ),
		array( 'jquery', 'editor' ),
		'1.0.0',
		true
	);
}

add_action( 'wp_enqueue_scripts', 'orbis_comment_form_enqueue_scripts' );

/**
 * Comment form field comment.
 *
 * @see https://github.com/WordPress/WordPress/blob/4.5.2/wp-includes/comment-template.php#L2295-L2302
 * @see https://github.com/WordPress/WordPress/blob/4.5.2/wp-includes/js/comment-reply.js
 * @see http://bechster.com/add-tinymce-visual-editor-comment-form-wordpress/
 * @see http://stackoverflow.com/questions/10095696/remove-tinymce-control-and-re-add
 * @see https://www.tinymce.com/docs/api/class/tinymce/#get
 * @param string $field
 * @return string
 */
function orbis_comment_form_field_comment( $field ) {
	wp_enqueue_script( 'orbis-comment-editor' );

	ob_start();

	wp_editor( '', 'comment', array(
		'teeny'         => true,
		'textarea_rows' => '7',
	) );

	$field = ob_get_clean();

	return $field;
}

add_filter( 'comment_form_field_comment', 'orbis_comment_form_field_comment' );
