(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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
		$('.em_btn_clipboard_copy').click(function(){
			var current_button = $(this);
			var em_post_id = current_button.data('id');
			var em_btn_clipboard_id = '#em_btn_clipboard_value_' + em_post_id;
			var clipboard_text = $(em_btn_clipboard_id).val()
			navigator.clipboard.writeText(clipboard_text).then(
				() => {
				  	current_button.html('Copied');
					setTimeout(
						function() 
						{
							current_button.html('Copy');
						},
						1000
					);
				},
				() => {
				  alert("Not Copied to clipboard!");
				}
			  );
		});
		$('#em_pdf_css_styles_reset_as_default').click(function(){
			if(confirm('Do you confirm reset AS DEFAULT value?')){
				var css_style_value = $('#em_plugin_setting_pdf_css_styles').val()
				$('#em_plugin_setting_pdf_css_styles_default').val(css_style_value);
				document.getElementById('submit').click();	
			}
		});
		$('#em_pdf_css_styles_reset_default').click(function(){
			if(confirm('Do you confirm reset TO DEFAULT value?')){
				var css_style_default_value = $('#em_plugin_setting_pdf_css_styles_default').val()
				$('#em_plugin_setting_pdf_css_styles').val(css_style_default_value);
			}
		});
	});
})( jQuery );
