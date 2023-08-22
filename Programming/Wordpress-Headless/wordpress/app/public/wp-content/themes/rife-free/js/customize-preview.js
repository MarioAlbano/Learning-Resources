/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

/*global wp, A13_CUSTOMIZER_DEPENDENCIES, A13FECustomizerPreview */

(function( $ ) {
	var G = A13FECustomizerPreview;
	wp.customize.bind( 'preview-ready', function() {
		//on partial refresh check if there is CSS send with it
		wp.customize.selectiveRefresh.bind( 'render-partials-response', function( response ) {
			$.each( response.contents, function(index, value) {
				if( typeof value[1] !== 'undefined' ){
					var style, id, org;
					style = $(value[1]);
					if(style.is('style')){
						id = style.attr('id');
						org = $('#'+id);

						//replace current style tag
						if(org.length){
							org.replaceWith(style);
						}
						//create new one after inline user.css styles
						else{
							$('#user-css-inlined').after(style);
						}
					}

					//remove style tag, as it triggers full refresh in customizer otherwise
					response.contents[index].splice( 1, 1 );
				}
			});
		});

		// Collect information from customize-controls.js about which panels are opening.
		wp.customize.preview.bind( 'section-preloader', function( data ) {
			var preloader = $('#preloader');

			if(preloader.length){
				var pc = preloader.find('.preload-content');
				if ( true === data.expanded ) {
					preloader.show();
					pc.show();
				} else {
					preloader.hide();
					pc.hide();
				}
			}
		});
		wp.customize.preview.bind( 'section-cookie', function( data ) {
			var cookie_message = $('#top-closable-message');

			if(cookie_message.length){
				if ( true === data.expanded ) {
					cookie_message.show();
				} else {
					cookie_message.hide();
				}
			}
		});
		wp.customize.preview.bind( 'section-footer', function( data ) {
			var footer = document.getElementById("footer");

			//scroll to footer
			if(footer && true === data.expanded){
				//footer.scrollIntoView({behavior: "smooth"});
				window.scroll({ top: document.body.clientHeight, behavior: 'smooth' })
			}
		});
		wp.customize.preview.bind( 'section-hidden_sidebar', function( data ) {
			var sidebar = $('#side-menu'),
				opener = $('#side-menu-switch');

			//open hidden sidebar
			if(sidebar.length && opener.length){
				if((true === data.expanded && !opener.hasClass('active')) ||
					(false === data.expanded && opener.hasClass('active'))
				){
					opener.trigger('click');
				}
			}
		});

		//send event to controls when preview is ready
		wp.customize.preview.bind( 'active', function() {
			wp.customize.preview.send( 'a13-preview-ready' );
		});
	});


	//update values live
	wp.customize(G.options_name+'[boxed_layout_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#mid').css('background-color', to);
		});
	});
	wp.customize(G.options_name+'[theme_borders_color]',function( value ) {
		value.bind(function(to) {
			$('.theme-borders').children().css('background-color', to);
		});
	});
	wp.customize(G.options_name+'[theme_borders]',function( value ) {
		value.bind(function(to) {
			var no_borders = _.difference(['top', 'left', 'bottom', 'right'], to),
				new_class = 'no-border-'+no_borders.join(' no-border-');

			$('body').removeClass('no-border-top no-border-right no-border-bottom no-border-left').addClass(new_class);
			$(window).resize();
		});
	});
	wp.customize(G.options_name+'[custom_cursor]',function( value ) {
		value.bind(function(to) {
			if(to === 'default'){
				$('body').css('cursor','auto');
			}
			else{
				//we need info what current cursor is
				wp.customize.selectiveRefresh.requestFullRefresh();
			}
		});
	});
	wp.customize(G.options_name+'[cursor_select]',function( value ) {
		value.bind(function(to) {
			$('body').css('cursor','url('+ G.cursors+to+'), auto');
		});
	});
	wp.customize(G.options_name+'[cursor_image]',function( value ) {
		value.bind(function(to) {
			$('body').css('cursor','url('+to+'), auto');
		});
	});
	wp.customize(G.options_name+'[preloader]',function( value ) {
		value.bind(function(to) {
			var preloader = $('#preloader');
			if(preloader.length){
				var pc = preloader.find('.preload-content');
				if ( 'on' === to ) {
					preloader.show();
					pc.show();
				} else {
					preloader.hide();
					pc.hide();
				}
			}
			else{
				wp.customize.selectiveRefresh.requestFullRefresh();
			}
		});
	});
	wp.customize(G.options_name+'[preloader_bg_image]',function( value ) {
		value.bind(function(to) {
			$('#preloader').css('background-image','url('+to+')');
		});
	});
	wp.customize(G.options_name+'[preloader_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#preloader').css('background-color',to);
		});
	});

	//cookie message
	wp.customize(G.options_name+'[top_message]',function( value ) {
		value.bind(function(to) {
			var cookie_message = $('#top-closable-message');
			if(cookie_message.length){
				if ( 'on' === to ) {
					cookie_message.show();
				} else {
					cookie_message.hide();
				}
			}
			else{
				wp.customize.selectiveRefresh.requestFullRefresh();
			}
		});
	});
	wp.customize(G.options_name+'[top_message_position]',function( value ) {
		value.bind(function(to) {
			$('#top-closable-message').removeClass('top-screen bottom-screen').addClass(to+'-screen');
		});
	});
	wp.customize(G.options_name+'[top_message_bg_color]',function( value ) {
		value.bind(function(to) {
			$('.top-message-container').css('background-color',to);
		});
	});
	wp.customize(G.options_name+'[top_message_text_color]',function( value ) {
		value.bind(function(to) {
			$('.top-message-container').css('color',to);
		});
	});
	wp.customize(G.options_name+'[top_message_link_color]',function( value ) {
		value.bind(function(to) {
			$('.top-message-container').find('a').css('color',to);
		});
	});
	wp.customize(G.options_name+'[top_message_text]',function( value ) {
		value.bind(function(to) {
			$('#top-closable-message').find('.message').html(to);
		});
	});
	wp.customize(G.options_name+'[top_message_button]',function( value ) {
		value.bind(function(to) {
			$('#top-closable-message').find('.button').children().text(to);
		});
	});
	
	//footer
	wp.customize(G.options_name+'[footer_switch]',function( value ) {
		value.bind(function(to) {
			var footer = $('#footer');
			if(footer.length){
				if ( 'on' === to ) {
					footer.show();
				} else {
					footer.hide();
				}
			}
			else{
				wp.customize.selectiveRefresh.requestFullRefresh();
			}
		});
	});
	wp.customize(G.options_name+'[footer_text]',function( value ) {
		value.bind(function(to) {
			$('#footer').find('.foot-text').html(to);
		});
	});
	wp.customize(G.options_name+'[footer_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#footer').css('background-color',to);
		});
	});
	wp.customize(G.options_name+'[footer_lower_bg_color]',function( value ) {
		value.bind(function(to) {
			$('#footer').find('.foot-items').css('background-color',to);
		});
	});

	//custom css live
	wp.customize(G.options_name+'[custom_css]',function( value ) {
		value.bind(function(to) {
			$('#user-custom-css').text(to);
		});
	});
} )( jQuery );
