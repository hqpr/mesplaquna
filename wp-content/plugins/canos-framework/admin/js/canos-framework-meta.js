(function( $ ) {
	'use strict';

	$(function() {

		var video_section = $( '#canos-framework-meta-box-video' ),
			audio_section = $( '#canos-framework-meta-box-audio' ),
			gallery_section = $( '#canos-framework-meta-box-gallery' ),
			post_format_select = $( '#post-formats-select input' ),
			video_check = $( '#post-format-video' ),
			audio_check = $( '#post-format-audio' ),
			gallery_check = $( '#post-format-gallery' );

		video_section.hide();
		audio_section.hide();
		gallery_section.hide();

		if ( video_check.is( ':checked' ) ) {
			video_section.removeClass( 'closed' ).show();
		}

		if ( audio_check.is( ':checked' ) ) {
			audio_section.removeClass( 'closed' ).show();
		}

		if ( gallery_check.is( ':checked' ) ) {
			gallery_section.removeClass( 'closed' ).show();
		}

		post_format_select.change( function() {
			if ( $( this ).val() === 'video') {
				video_section.removeClass( 'closed' ).show();
				audio_section.hide();
				gallery_section.hide();
			} else if ( $( this ).val() === 'audio') {
				audio_section.removeClass( 'closed' ).show();
				video_section.hide();
				gallery_section.hide();
			} else if ( $( this ).val() === 'gallery') {
				gallery_section.removeClass( 'closed' ).show();
				video_section.hide();
				audio_section.hide();
			} else {
				video_section.hide();
				audio_section.hide();
				gallery_section.hide();
			}
		});

		$( '.section-upload-gallery' ).on('click', '.upload-button-gallery', function( e ) { 
			e.preventDefault();

			var image_gallery_ids = $(this).prev().prev();
			var file_frame;
			var attachment_ids = '';
	 
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
	 
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Create a gallery',
				button: {
					text: 'Create a gallery',
				},
				states : [
					new wp.media.controller.Library({
						title: 'title',
						filterable :	'all',
						multiple: true,
					})
				]
			});
	 
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {

				var file_path = '';
				var selection = file_frame.state().get('selection');

				selection.map( function( attachment ) {

					attachment = attachment.toJSON();

					if ( attachment.id ) {
						attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
					}

					image_gallery_ids.val( attachment_ids );

				});

			});
	 
			// Finally, open the modal
			file_frame.open();

		});
		
	});

})( jQuery );
