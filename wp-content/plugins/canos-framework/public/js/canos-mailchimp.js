jQuery(document).ready(function($){
	"use strict";
	/* global canos_framework_process_form_vars, jQuery */
	$( '.canos-newsletter-button' ).on( 'click', function( e ) {

		var el = $( this ),
			form = el.parent( 'form' ),
			display_name = form.data( 'name' ),
			confirm = form.data( 'confirm' ),
			list_id = form.find( '.canos-newsletter-list-id' ).val(),
			first_name = form.find( '.canos-newsletter-first-name' ).val(),
			last_name = form.find( '.canos-newsletter-last-name' ).val(),
			email = form.find( '.canos-newsletter-email' ).val(),
			response_message_el = form.parent( '.canos-item-newsletter' ).find( '.canos-newsletter-response' ),
			loader = form.find( '.canos-newsletter-loader' );

		response_message_el.find( '.canos-newsletter-message' ).remove();
		loader.addClass( 'loading' );

		var post_data = {
			action: 'canos_framework_mailchimp_form',
			canos_framework_m_display_name: display_name,
			canos_framework_m_confirm: confirm,
			canos_framework_m_list_id: list_id,
			canos_framework_m_first_name: first_name,
			canos_framework_m_last_name: last_name,
			canos_framework_m_email: email,
			canos_framework_m_nonce: canos_framework_process_form_vars.nonce
		};

		$.post(canos_framework_process_form_vars.ajaxurl, post_data, function( response ) {
			response_message_el.append( response );
			loader.removeClass( 'loading' );
		});

		e.preventDefault();
		
	});	
});
