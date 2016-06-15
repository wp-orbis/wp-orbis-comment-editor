var fixCommentEditor = function() {
	var settings = tinymce.get( 'comment' ).settings;

	tinymce.remove( '#comment' );

	tinymce.init( settings );

	var editor = tinymce.get( 'comment' );

	editor.focus();

	editor.selection.select( editor.getBody(), true );
	editor.selection.collapse( false );
};

jQuery( function( $ ) {
	$( '.comment-reply-link' ).click( function( e ) {
		fixCommentEditor();

		$( '#cancel-comment-reply-link' ).one( 'click', fixCommentEditor );
	} );
} );
