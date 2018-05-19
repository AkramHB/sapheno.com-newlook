( function( $ ) { 
	// we create a copy of the WP inline edit post function
	var $wp_inline_edit = inlineEditPost.edit;
	
	// and then we overwrite the function with our own code
	inlineEditPost.edit = function( id ) {
	
		// "call" the original WP edit function
		$wp_inline_edit.apply( this, arguments );

		// get the post ID
		var $post_id = 0;
		if ( typeof( id ) == 'object' )
			$post_id = parseInt( this.getId( id ) );
			
		if ( $post_id > 0 ) {
			//console.log( "Post id: " + $post_id );
 
			var forms = [];
			var unchecked = [];
			checkbox = jQuery( '.data input[type="checkbox"]' );

			jQuery.each( checkbox, function( index, value ) {
				forms.push( $( this ).attr( 'data-id' ) );
			} );

			var uniqueNames = [];
			$.each( forms, function( i, el ) {
			    if( $.inArray( el, uniqueNames ) === -1 ) uniqueNames.push( el );
			} );

			jQuery.each( uniqueNames, function( index, value ) {
				var form = $("#form\\[" + value + "\\]")

				if( form.attr( 'data-style' ) == $post_id ) {
					form.prop( 'checked', true );
					form.parent().parent().next().hide();
				} else {
					form.prop( 'checked', false );
					form.parent().parent().next().show();
				}

				// reset hidden fields
				$( '.cf7-quick-edit .hidden-fields' ).html( '' );

				if( form.is( ":checked" ) ) {

					unchecked.push( form.attr( 'data-id' ) );

					form.on( "click", function() {
						if( ! form.prop( "checked" ) ) {
							$( '.cf7-quick-edit .hidden-fields' ).append( '<input type="hidden" name="remove-' + form.attr( 'id' ) + '" id="remove-' + form.attr( 'id' ) + '" value="on">' );
						} else {
							$("#remove-form\\[" + form.attr( 'data-id' ) + "\\]").remove();
						}
					} );
				}

			} ); 
		}

	};
 
	$( ".inline-edit-cf7_style .button-primary" ).on( "click", function() {
		var url = window.location.href;
		$( ".cf7-quick-edit" ).load( url + " .cf7-quick-edit >" );
	} );

 
} )( jQuery );