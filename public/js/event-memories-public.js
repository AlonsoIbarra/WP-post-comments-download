(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 $(document).ready(function() {
		// Hide no required fields in comment form
		$( ".comment-form-email" ).css('display', 'none');
		$("#email").val("anonimo@mail.com")
		$( ".comment-form-url" ).css('display', 'none');

		$('#comment').on('keydown', function(event) {
			$("#comment" ).removeClass('commentform-error');
		});

		$('#author').on('keydown', function(event) {
			$("#author" ).removeClass('commentform-error');
		});

		// validate comment form fields
		$("#commentform").submit( function(){
			var errors = false;

			if( $('#comment').val() == '' ){
				errors =true;
				$("#comment" ).addClass('commentform-error');
			}

			if( $('#author').val() == '' ){
				errors =true;
				$("#author" ).addClass('commentform-error');
			}
			if (errors){
				return false;
			}
		});
		
		// validate token for pdf download.
		$('#em_download_to_pdf_form').submit( function(event){
			var user_token=prompt("Por favor ingrese su contraseña.");
			if(user_token){
				$.ajax({
					type: "POST",
					url: EventMemoriesPluginRequests.url,
					data: {
						key: EventMemoriesPluginRequests.key,
						action: 'em_validate_token_pdf_input',
						token: user_token,
					},
					success: function(response){
						if ( response.success ){
							window.open(
								response.data,
								'_blank'
							); 
						} else {
							alert(response.data);
						}
					}
				});
			}
			return false;
		});
	});
})( jQuery );
