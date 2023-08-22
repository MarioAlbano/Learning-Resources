jQuery.noConflict();

(function($, window, document){
	/*global ApolloParams a2a_config,
	a2a, alert, jQuery */
	"use strict";

	//for debugger
	$ = jQuery;

	//no hiding animation when loading filtered bricks in isotope
	Isotope.Item.prototype.hide = function() {
		// set flag
		this.isHidden = true;
		// just hide
		this.css({ display: 'none' });
	};

	var A13F 		= window.A13FRAMEWORK,
		html		= document.documentElement,
		$html       = $(html),
		body        = document.body,
		$body       = $(body),
		$window     = $(window),
		G           = ApolloParams,
		is_rtl 		= $html.attr('dir') === 'rtl',
		is_adminbar = false,

		click_event         = 'click',
		transitionend_event = 'transitionend',
		can_use_transitions = false,
		elementor_is_ready_fired = false,


		header, header_tools, footer, mid, admin_bar,//DOM elements

		break_point = [600,768,1024,1300]; //media queries break points

	//elementor init prepare
	$window.on( 'elementor/frontend/init', () => {
		//it is already ready to fire
		elementor_is_ready_fired = true;
	});

	window.A13FRAMEWORK = {
		//run after DOM is loaded
		onReady : function(){
			//some exception when we don't push scroll
			var exceptions_pages = ['single-album-slider', 'single-album-scroller'],
				no_scroll = false;
			for(var i = 0; i < exceptions_pages.length; i++ ){
				if($body.hasClass(exceptions_pages[i])){
					no_scroll = true;
					break;
				}
			}

			if(typeof $.fn.isotope !== 'undefined' && !no_scroll){
				//add scroll bar to fix some delayed resize issues with bricks
				$html.addClass('show-scroll');
			}

			can_use_transitions = A13F.transitionsAvailable();

			header 			= $('#header');
			header_tools 	= $('#header-tools');
			footer 			= $('#footer');
			mid 			= $('#mid');
			admin_bar		= $('#wpadminbar');

			if(admin_bar.length){
				is_adminbar = true;
			}



			//bind resize
			$window.resize(A13F.debounce(A13F.layout.resize, 250));
			$body.on('webfontsloaded', function(){
				$window.resize();
			});

			//enables hover states on various elements on iOS when finger is on element while scrolling for example
			document.addEventListener("touchstart", function(){}, true);

			//set current size
			A13F.layout.set();

			A13F.runPlugins();
			A13F.temporarySafes();
			A13F.elementsActions.init();
		},

		//for resizing with media queries
		layout : {
			pointers : [],

			size : 0,

			add : function(f){
				A13F.layout.pointers.push(f);
			},

			remove : function(f){
				var pointers = A13F.layout.pointers;

				//call each registered for resize function
				for(var i = 0; i < pointers.length; i++){
					if(pointers[i] === f){
						delete pointers[i];
					}
				}
			},

			set : function(){
				var size = window.getComputedStyle ? getComputedStyle(body, ':after').getPropertyValue('content') : null,
					width = $window.width(),
					index = (size === null)? -1 : size.indexOf("narrow"),
					to_return;

				//if we can get value of current media query(normal desktop browsers)
				if (index === -1) {
					to_return = width;
				} else {
					to_return = parseInt(size.substr(index + 6), 10);
				}

				A13F.layout.size = to_return;

				return to_return;
			},

			resize : function(e){
				var A = A13F.layout,
					size = A.set(),
					pointers = A.pointers;

				//call each registered for resize function
				for(var i = 0; i < pointers.length; i++){
					if(pointers[i] !== undefined){
						pointers[i].call(this, e, size);
					}
				}
			}
		},

		runPlugins : function(){
			//Resize iframe videos (YT, VIMEO)
			$("div.post-media").fitVids();
			$("div.real-content").find('p').fitVids();
		},

		temporarySafes : function(){
			//this hack is to remove '!' hash from url after closing the prettyPhoto
			// which causes JavaScript error after refresh cause of VisualComposer bug
			$window.on( 'hashchange', function(){
				if( window.location.hash == '#!' ){
					history.pushState('', document.title, window.location.pathname);
				}
			});
		},

		cookieExpire : function(name_value, hours){
			var d = new Date(),
				expires;
			d.setTime(d.getTime()+(hours*60*60*1000));
			expires = d.toUTCString();
			document.cookie=name_value+"; expires="+expires+"; path=/";
		},

		transitionsAvailable : function() {
			var el = document.createElement('div');
			return (el.style['transition'] !== undefined);
		},

		/**
		 * Retrieves available window height for content elements in regard to current layout
		 * @param {number} option 1 for header, 2 for header & title-bar
		 * @returns {number}
		 */
		windowVisibleAvailableHeight : function(option){
			//default value
			if(typeof option === 'undefined'){
				option = 0;
			}

			var window_height    = $window.height(),
				admin_bar_height = is_adminbar ? parseInt(admin_bar.height(), 10) : 0,
				is_vertical      = header.hasClass('vertical'),
				header_space     = 0,
				total;

			//on mobile widths, take header height into account when using vertical header
			if(is_vertical){
				if(A13F.layout.size <= break_point[2]){
					header_space = header.height();
				}
			}
			else{
				header_space     = option > 0 ? parseInt($body.css('padding-top'), 10) : 0;
			}

			total = window_height - admin_bar_height - header_space;

			//check for theme borders
			if($body.hasClass('site-layout-bordered')){
				var borders              = $('.theme-borders'),
					top_border           = borders.find('.top-border'),
					bottom_border        = borders.find('.bottom-border'),
					top_border_height    = top_border.length ? top_border.height() : 0,
					bottom_border_height = bottom_border.length ? bottom_border.height() : 0;

				total = total - top_border_height - bottom_border_height;
			}

			//check for title-bar
			if(option > 1){
				var title_bar        = $('header.title-bar.outside'),
					title_bar_height = title_bar.length ? title_bar.height() : 0;

				total = total - title_bar_height;
			}

			return total;
		},


		isInteger : function(value){
			return typeof value === "number" &&
				isFinite(value) &&
				Math.floor(value) === value;
		},

		throttle: function (t, n) {
			n || (n = 100);
			var e = null,
				u = +new Date,
				i = !1,
				r = 0;
			return function () {
				var o = +new Date,
					a = this,
					c = arguments,
					l = function () {
						clearTimeout(e);
						t.apply(a, c);
						u = r = o;
						i = !0;
						e = setTimeout(function () {
							r !== u && l()
						}, n)
					};
				!i || o - u > n ? l() : r = o
			}
		},

		debounce: function (t, n, e) {
			var u;
			return function () {
				var i = this,
					r = arguments;
				u ? clearTimeout(u) : e && t.apply(i, r);
				u = setTimeout(function () {
					e || t.apply(i, r);
					u = null
				}, n || 100)
			}
		},

		elementsActions : {
			init : function(){
				var $e = A13F.elementsActions;

				$e.preloader();
				$e.headerVertical();
				$e.headerHorizontal();
				$e.headerSearch();
				$e.topMessage();
				$e.logo();
				$e.menuOverlay();
				$e.sideMenu();
				$e.basketMenu();
				$e.toolsLanguages();
				$e.footer();

				$e.topMenu();
				$e.toTop();
				if(G.scroll_to_anchor){
					$e.scrollToAnchor();
				}
				$e.parallax();
				$e.pageSlider();
				$e.titleBar();
				$e.stickyOnePage();

				$e.carousel();
				$e.countDown();
				$e.countTo();
				$e.fitText();
				$e.typedJS();
				$e.A13PostLightbox();

				//before singleAlbumMasonry()
				$e.lightbox();

				//big(main) chunks of layout
				$e.blogMasonry();
				$e.shopMasonry();

				$e.albumsListMasonry();
				$e.singleAlbumMasonry();
				$e.singleWork();
				$e.makeBricks();
				$e.makeSlider();
				$e.makeScroller();

				$e.worksListMasonry();
				$e.peopleListMasonry();

				/******* For widgets that have lots of content *********/
				$e.widgetSlider();
				$e.demoFlyOut();

				//react to customizer partials refresh
				if(typeof wp !== 'undefined' && typeof  wp.customize !== 'undefined' && typeof wp.customize.selectiveRefresh !== 'undefined'){
					wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
						//footer
						if(G.options_name+'[footer_switch]' ===  placement.partial.id){
							mid.css('margin-bottom', '');
							footer = $('#footer');
							$e.footer();
						}
					} );
				}

				var ElementorInitCallback = function(){
					if(typeof elementorFrontend !== 'undefined' && typeof elementorFrontend.hooks !== 'undefined'){
						//react to Elementor Preview changes on shortcodes
						elementorFrontend.hooks.addAction( 'frontend/element_ready/shortcode.default', function( $scope ) {
							$e.typedJS($scope);
							$e.makeSlider($scope);
							$e.makeScroller($scope);
							$e.blogMasonry($scope);
							$e.albumsListMasonry($scope);
							$e.worksListMasonry($scope);
							$e.peopleListMasonry($scope);
							$e.makeBricks($scope);
						} );


						//react to Elementor Preview changes on widgets
						elementorFrontend.hooks.addAction( 'frontend/element_ready/a13fe-slider.default', function( $scope ) {
							$e.makeSlider($scope);
						} );
						elementorFrontend.hooks.addAction( 'frontend/element_ready/a13fe-scroller.default', function( $scope ) {
							$e.makeScroller($scope);
						} );
						elementorFrontend.hooks.addAction( 'frontend/element_ready/a13fe-gallery.default', function( $scope ) {
							$e.makeBricks($scope);
						} );
						elementorFrontend.hooks.addAction( 'frontend/element_ready/a13fe-post-list.default', function( $scope ) {
							$e.blogMasonry($scope);
							$e.albumsListMasonry($scope);
							$e.worksListMasonry($scope);
							$e.peopleListMasonry($scope);
						} );
					}
				};

				$window.on( 'elementor/frontend/init', () => {
					ElementorInitCallback();
				} );

				//if event occured before the ready event, lets fire
				if(elementor_is_ready_fired === true){
					ElementorInitCallback();
				}


			},

			stickyOnePage : function(){
				var content_box = mid.find('div.content-box');
				if( !content_box.hasClass('a13-sticky-one-page') ){
					return;
				}

				//resize all vc rows
				var wrapper_selector      = 'div.real-content',
					section_selector      = 'div.vc_row',
					all_sections_selector = wrapper_selector + ' > ' + section_selector,
					fp_sections           = mid.find(wrapper_selector).children(section_selector),
					tooltips              = [],
					global_bullet_color   = ( content_box.attr('data-a13-sticky-one-page-icon-global-color') === undefined ? '' : content_box.attr('data-a13-sticky-one-page-icon-global-color') ),
					global_bullet_icon    = ( content_box.attr('data-a13-sticky-one-page-icon-global-icon') === undefined ? '' : content_box.attr('data-a13-sticky-one-page-icon-global-icon') );

				//prepare tooltips before running script
				fp_sections.each( function(){
					var icon_title = $(this).attr('data-a13-sticky-one-page-icon-title');
					tooltips.push( icon_title === undefined ? '' : icon_title )
				});

				//resize event
				$(window).resize(A13F.debounce( function () {
					$.fn.fullpage.reBuild();
				}, 250));

				//initiate
				$(wrapper_selector).fullpage({
					lockAnchors       : false,
					autoScrolling     : true,
					scrollingSpeed    : 700,
					fitToSection      : true,
					css3              : true,
					easingcss3        : "ease",
					easing            : "easeInOutCubic",
					continuousVertical: false,
					loopBottom        : false,
					loopTop           : false,
					loopHorizontal    : true,
					scrollOverflow    : true,
					controlArrows     : false,
					verticalCentered  : true,

					responsiveWidth   : 0,
					responsiveHeight  : 0,
					fixedElements     : "",
					keyboardScrolling : true,
					animateAnchor     : true,
					recordHistory     : false,

					resize: false,
					sectionSelector: all_sections_selector,
					navigation: true,
					paddingTop: admin_bar.length ? parseInt(admin_bar.height(), 10)+'px' : '',
					navigationTooltips: tooltips,
					showActiveTooltip: true,
					scrollBar: false,
					afterRender: function(){
						//customize navigation for one page
						var nav_container = $('#fp-nav').find('ul');

						fp_sections.each(function (i) {
							var icon_attr = $(this).attr('data-a13-sticky-one-page-icon-class'),
								color_attr = $(this).attr('data-a13-sticky-one-page-icon-color'),
								icon_class = ( icon_attr ? icon_attr : global_bullet_icon ),
								icon_color = ( color_attr ? color_attr : global_bullet_color );

							if ( icon_class ) {
								//set color of custom icon
								nav_container.children().eq(i).css({'color': icon_color})// li element
									.find('a').addClass('custom').find('span').addClass(icon_class);
							} else {
								//set color of default bullet
								nav_container.children().eq(i).css({'color': icon_color})// li element
									.find('a').find('span').css({'background-color': icon_color});
							}
						});

						//show navigation
						nav_container.fadeIn();
					},
					afterLoad: function(){

					},
					onLeave: function() {

						// when lightbox is active, prevent scrolling the page

					}
				});

			},

			carousel: function(){
				$('.a13_images_carousel').each(function () {
					var $carousel_container = $(this),
							$carousel = $carousel_container.find('.owl-carousel'),
							loop = $carousel_container.data('wrap') == 1,
							autoplay = $carousel_container.data('autoplay'),
							interval = $carousel_container.data('interval'),
							perView = $carousel_container.data('per_view'),
							nav = $carousel_container.data('hide_nav') == '1',
							pag = $carousel_container.data('hide_pag') == '1',
							giveResponsiveSet = function (perView) {
								var responsiveSet = {};
								for (var i = 0; i < perView; i++) {
									var tmp_obj = {};
									if (i % 2) {
										tmp_obj = {'items': (i + 1)};
									} else {
										tmp_obj = {'items': (i + 1), 'center': true};
									}
									responsiveSet[Math.floor(1 + i * (1920 / perView))] = tmp_obj;
								}
								return responsiveSet;
							};


					$window.on('load', function() {
						$carousel.owlCarousel({
							loop           : loop,
							items          : perView,
							autoplay       : autoplay,
							autoplayTimeout: interval,
							responsive     : giveResponsiveSet(perView),
							nav            : !nav,
							navText		   : ['<span class="a13icon-chevron-thin-left">', '<span class="a13icon-chevron-thin-right">'],
							dots           : !pag
						});
					});

				});
			},

			countDown: function(){
				$('div.a13_count_down').each( function(){
					var $countDowner = $(this),
							labels = [ $countDowner.data('weeks'), $countDowner.data('days'), $countDowner.data('hours'), $countDowner.data('minutes'), $countDowner.data('seconds')],
							style = $countDowner.data('style'),
							targetDate = $countDowner.data('date'),
							template = (style == 'simple' ? '' : _.template($('#main-example-template').html()) ),
							currDate = '00:00:00:00:00',
							nextDate = '00:00:00:00:00',
							parser = /([0-9]{2})/gi;
					// Parse countdown string to an object
					function strfobj(str) {
						var parsed = str.match(parser),
								obj = {};
						labels.forEach(function(label, i) {
							obj[label] = parsed[i]
						});
						return obj;
					}

					// Return the time components that diffs
					function diff(obj1, obj2) {
						var diff = [];
						labels.forEach(function(key) {
							if (obj1[key] !== obj2[key]) {
								diff.push(key);
							}
						});
						return diff;
					}

					// Starts the countdown
					if(style == 'simple'){
						$countDowner.countdown(targetDate).on('update.countdown', function(event) {
							$(this).html(event.strftime(''
									+ '<div class="block"><div class="value">%w</div> <div class="label">' + $countDowner.data('weeks') +'</div></div>'
									+ '<div class="block"><div class="value">%d</div> <div class="label">' + $countDowner.data('days')+'</div></div>'
									+ '<div class="block"><div class="value">%H</div> <div class="label">' + $countDowner.data('hours')+'</div></div>'
									+ '<div class="block"><div class="value">%M</div> <div class="label">' + $countDowner.data('minutes')+'</div></div>'
									+ '<div class="block"><div class="value">%S</div> <div class="label">' + $countDowner.data('seconds')+'</div></div>' ) );
						});
					}else{
						// Build the layout
						var initData = strfobj(currDate);
						labels.forEach(function(label/*, i*/ ) {
							$countDowner.append(template({
								curr: initData[label],
								next: initData[label],
								label: label
							}));
						});
						$countDowner.countdown(targetDate, function(event) {
							var newDate = event.strftime('%w:%d:%H:%M:%S'),
									data;
							if (newDate !== nextDate) {
								currDate = nextDate;
								nextDate = newDate;
								// Setup the data
								data = {
									'curr': strfobj(currDate),
									'next': strfobj(nextDate)
								};
								// Apply the new values to each node that changed
								diff(data.curr, data.next).forEach(function(label) {
									var selector = '.%s'.replace(/%s/, label),
											$node = $countDowner.find(selector);
									// Update the node
									$node.removeClass('flip');
									$node.find('.curr').text(data.curr[label]);
									$node.find('.next').text(data.next[label]);
									// Wait for a repaint to then flip
									_.delay(function($node) {
										$node.addClass('flip');
									}, 50, $node);
								});
							}
						});
					}

				});
			},

			countTo: function(){
				var counters = $('div.a13_counter');
				//bind event for each counter
				counters.each(function(){
					var counter = $(this),
							number = counter.find('span.number'),
							params = {onComplete: function(){
								counter
										.find('span.finish-text')
										.css({
											visibility: 'visible',
											opacity: '0',
											top: '-20px'
										})
										.animate({top: '0',opacity:'1'},600);
							}};

					//disable counter counting for mobile view to save processor
					if(A13F.layout.size <= break_point[0]){
						params.speed = 1; //1ms, 0 causes error
					}

					/** @namespace $.fn.waypoint */
					if (typeof $.fn.waypoint !== 'undefined') {
						counter.waypoint(function(){
							number.countTo(params);
						}, {triggerOnce:true, offset: 'bottom-in-view'});
					} else {
						number.countTo(params)
					}

				});
			},

			fitText : function(){
				var fitText_headings = mid.find('.vc_custom_heading.a13-fit_text'),
						doFitText = function( heading ){
							var compress_ratio = $(heading).data('compress'),
								min_fs = $(heading).data('min-font-size'),
								max_fs = $(heading).data('max-font-size'),
								extra = {};

							if(typeof min_fs !== 'undefined'){
								extra['minFontSize'] = min_fs;
							}
							if(typeof max_fs !== 'undefined'){
								extra['maxFontSize'] = max_fs;
							}

							$(heading).fitText( compress_ratio, extra );
						};

				fitText_headings.each( function(){
					//WPBakery < 6.0
					if (typeof $.fn.waypoint !== 'undefined') {
						$(this).waypoint( $.proxy(doFitText, this, this, 0),{ offset: 'bottom-in-view', triggerOnce:true } );
					}
					//WPBakery >= 6.0
					else if(typeof $.fn.vcwaypoint !== 'undefined'){
						$(this).vcwaypoint( $.proxy(doFitText, this, this, 0),{ offset: 'bottom-in-view', triggerOnce:true } );
					}
					//native version
					else {
						doFitText(this);
					}
				} );

			},

			typedJS : function($scope){
				$scope = typeof $scope === 'undefined'? $body : $scope;

				var typed_texts = $scope.find('.a13-to-type'),

						start_typing = function(text){
							var block         = $(text),
								block_strings = [],
								is_loop       = block.data('loop') == 1;

							//don't animate for mobiles
							if(!G.writing_effect_mobile && A13F.layout.size <= break_point[0]){
								block.addClass('disabled-writing');
							}
							//animate for desktop
							else{
								var typing_area = block.find('.typing-area');

								//skip if it was initialized already
								if(typing_area.data('typed')){
									return;
								}

								//collect sentences
								block.find('.sentences-to-type').children() //<span(s)>
										.each( function(){
											block_strings.push( $(this).html() );
										});


								typing_area.typed({
									strings: block_strings,
									startDelay: 500,
									typeSpeed: parseInt(G.writing_effect_speed, 10),
									loop: is_loop
								});
							}

						};

				typed_texts.each( function(){
					var _this = this;
					//native version
					if(typeof Waypoint === 'function'){
						//noinspection JSUnusedGlobalSymbols
						new Waypoint({
							element: _this,
							handler: function(){
								start_typing(this.element);
								//fire only once
								this.destroy();
							},
							offset: '85%'
						});
					}
					//jQuery version
					else if(typeof jQuery.waypoints === 'function'){
						$(this).waypoint( $.proxy(start_typing, this, this, 0),{ offset: 'bottom-in-view', triggerOnce:true } );
					}
					//WPBakery >= 6.0
					else if(typeof $.fn.vcwaypoint !== 'undefined'){
						$(this).vcwaypoint( $.proxy(start_typing, this, this, 0),{ offset: 'bottom-in-view', triggerOnce:true } );
					}
				} );

			},

			parallax : function(){
				var p_bgs = $('div.a13-parallax, div.a13-parallax-video, header.a13-parallax'),
					set_bg_position = function(element,x,y,speed){
						if(typeof speed === 'undefined'){
							speed = 1;
						}
						element.style.backgroundPosition = (speed*x)+'% '+(speed*y)+'%';
					},

					set_video_position = function(video, position, parent_height){
						var val = (parent_height - video.innerHeight()) * position;
						video[0].style.top = val+'px';
					},

					update = function(){
						// reset the tick so we can
						// capture the next onScroll
						ticking = false;

						//check all parallax elements
						p_bgs.each(function(){
							//noinspection JSCheckFunctionSignatures
							var element     = this,
								$elem       = $(element),
								using_speed = getComputedStyle(element).getPropertyValue('background-repeat') !== 'no-repeat',
								for_video   = $elem.hasClass('a13-parallax-video'),
								video       = for_video ? $elem.children('video.a13-bg-video') : $([]),
								type        = for_video ? $elem.data('a13-parallax-video-type') : $elem.data('a13-parallax-type'),
								speed       = using_speed? $elem.data('a13-parallax-speed') : 1;

							//we make sure that video exists
							if(!for_video || (for_video && video.length)){
								var window_height   = window.innerHeight || html.clientHeight, //modern || IE 8
									window_top      = last_window_top,
									window_bottom   = window_top + window_height,
									elem_height     = $elem.innerHeight(),
									elem_top        = $elem.offset().top,
									elem_bottom     = elem_top + elem_height,
									end_range       = elem_bottom + window_height,
									top_part_in_range       = window_bottom >= elem_top,
									bottom_part_in_range    = window_bottom <= end_range,
									current_position_in_range = (window_bottom - elem_top) / (end_range - elem_top);

								//we can see element
								if( top_part_in_range && bottom_part_in_range ){
									//choose type of move

									//from top to bottom
									if(type === 'tb'){
										if(for_video){
											set_video_position(video, current_position_in_range, elem_height);
										}
										else{
											set_bg_position(element, 50, current_position_in_range * 100, speed);
										}
									}
									//from bottom to top
									else if(type === 'bt'){
										if(for_video){
											set_video_position(video, 1-current_position_in_range, elem_height);
										}
										else{
											set_bg_position(element, 50, (1-current_position_in_range) * 100, speed);
										}
									}
									//from left to right
									else if(type === 'lr'){
										set_bg_position(element, current_position_in_range * 100, 50, speed);
									}
									//from right to left
									else if(type === 'rl'){
										set_bg_position(element, (1-current_position_in_range) * 100, 50, speed);
									}
									//from top-left to bottom-right
									else if(type === 'tlbr'){
										set_bg_position(element, current_position_in_range * 100, current_position_in_range * 100, speed);
									}
									//from top-right to bottom-left
									else if(type === 'trbl'){
										set_bg_position(element, (1-current_position_in_range) * 100, current_position_in_range * 100, speed);
									}
									//from bottom-left to top-right
									else if(type === 'bltr'){
										set_bg_position(element, current_position_in_range * 100, (1-current_position_in_range) * 100, speed);
									}
									//from bottom-right to top-left
									else if(type === 'brtl'){
										set_bg_position(element, (1-current_position_in_range) * 100, (1-current_position_in_range) * 100, speed);
									}
								}
							}
						});
					},

					requestTick = function() {
						if (!ticking) {
							requestAnimationFrame(update);
						}
						ticking = true;
					},

					last_window_top = 0,
					ticking = false;

				if(p_bgs.length){
					$window
						.off('scroll.parallax resize.parallax a13_parallax_trigger.parallax')//if we have multiple calls
						.on('scroll.parallax resize.parallax a13_parallax_trigger.parallax', function() {
							last_window_top = html.scrollTop || window.pageYOffset || 0; //IE8 || modern || 0 for undefined value in IE 8 if scrolled to top
							requestTick();
					});

					//start call
					$window.trigger('a13_parallax_trigger');
				}
			},

			preloader : function(show_it_now){
				var p = $('#preloader');
				if(p.length){
					var c = p.find('div.preload-content'),
						skip = p.find('a.skip-preloader'),
						hide_onready = p.hasClass('onReady'),
						hide_it = function(){ // makes sure the whole site is loaded
							c.fadeOut().promise().done(function(){
								p.fadeOut(400);
							})
						},
						show_it = function(){
							skip.hide();
							c.show();
							p.fadeIn();
						};


					if(typeof show_it_now === 'undefined'){
						if(hide_onready){
							$(document).ready(hide_it);
						}
						else{
							//when this script is loaded then show link to skip preloader
							skip.fadeIn().on( click_event, function(ev){
								ev.stopPropagation();
								ev.preventDefault();
								hide_it();
							});

							$window.on( 'load', hide_it);
						}
					}

					//for showing/hiding on AJAX
					else{
						if(show_it_now){
							show_it();
						}
						else{
							hide_it();
						}
					}
				}
			},

			logo:  function(){
				var image_logo = header.find('.image-logo'),
					logo = '',
					load = function(){
						logo.on( 'load', function(){
							//inform about possible resize
							$body.trigger('a13LogoLoaded');
						});
					};

				if(image_logo.length){
					//try variant logo
					logo = header.find('a.'+G.default_header_variant+'-logo').children();
					if(logo.is('img')){
						load();
						return;
					}
					//try normal logo
					logo = header.find('a.normal-logo').children();
					if(logo.is('img')){
						load();
						return;
					}
				}

				//text logo or no logo
				$body.trigger('a13LogoLoaded');
			},

			topMenu : function(){
				var sub_menus       = header.find('ul.sub-menu'),
					menu            = header.find('div.menu-container'),
					menu_list       = menu.children(),
					sub_parents     = sub_menus.parent().not(function() { return $(this).parents('.mega-menu').length; }),
					scrollable_class= 'scrollable-menu',
					menu_init       = $('#mobile-menu-opener'),
					overlay			= $('#content-overlay'),
					size            = A13F.layout.size,
					is_vertical		= header.hasClass('vertical');

				var desktopEvents = function(on){
						if(typeof on !== 'undefined' && on === false){
							header.removeClass('desktop_menu');

							resetMenu(undefined, true);
							sub_parents
								.off(click_event)
								.children('i.sub-mark, span.title').off(click_event);
						}
						else{
							header.addClass('desktop_menu');

							sub_parents
								.children('i.sub-mark, span.title')
								.on(click_event+' keydown', function(ev){
									var reserved_keys = [13,32];
									if(ev.type === 'keydown'){
										if( reserved_keys.indexOf(ev.keyCode) === -1 ){
											//we don't react to this key
											return;
										}
									}
									ev.stopPropagation();
									ev.preventDefault();

									var this_li = $(this).parent(), //li
										sub = this_li.children('ul.sub-menu'),
										was_open = this_li.hasClass('open');

									resetMenu(this_li);

									//close this menu if it was open
									if(was_open){
										return;
									}

									if(this_li.parents('li').length > 0){
										this_li.children('i.sub-mark').removeClass(G.submenu_third_lvl_opener).addClass(G.submenu_third_lvl_closer);
									}
									else{
										this_li.children('i.sub-mark').removeClass(G.submenu_opener).addClass(G.submenu_closer);
									}

									measureSubmenu(sub);

									//show sub-menu
									if(is_vertical){
										this_li.addClass('open');
										sub.slideDown(600, function(){$window.trigger('mess_in_header');});
									}
									else{
										sub.show();
										//requestAnimationFrame often adds class at same repaint, and this blocks animation from running as element is shown at the same time when it suppose to be animated
										//that is why setTimeout is more reliable here
										setTimeout(function(){ this_li.addClass('open'); }, 15);
									}

									$body.off( click_event, bodyClickFn ); //turn off if there were any binds
									$body.on( click_event, bodyClickFn );
								});

							if( is_vertical ){
								var current_ancestors = sub_parents.filter('.to-open');
								if( current_ancestors.length ){
									current_ancestors.addClass('open');
								}
							}
						}
					},

					bodyClickFn = function(ev){
						//we don't want to block clicks in other single menu options
						if(! $(ev.target).parents().addBack().hasClass( 'menu-container' ) ) {
							ev.stopPropagation();
							ev.preventDefault();
							resetMenu();
						}
					},

					resetMenu = function(menu, hard){
						var parents_of_open_menus,
							onHideTransitionEndFn = function(ev){
								//do it only after visibility transition
								if( !_sub_menus.is(ev.target) || ev.originalEvent.propertyName !== 'visibility' ){ return; }

								_sub_menus.off( transitionend_event, onHideTransitionEndFn );
								cleanUpAfterHide();
							},
							cleanUpAfterHide = function(){
								_sub_menus.removeClass('otherway')
									//clean so it won't interfere with mobile menu
									.attr('style','');

								parents_of_open_menus.each(function(){
									var parent = $(this);
									if(parent.parents('li').length > 0){
										parent.children('i.sub-mark').removeClass(G.submenu_third_lvl_closer).addClass(G.submenu_third_lvl_opener);
									}
									else{
										parent.children('i.sub-mark').removeClass(G.submenu_closer).addClass(G.submenu_opener);
									}
								});
							};

						if (typeof menu === 'undefined') {
							//all menus
							parents_of_open_menus = sub_parents.filter('.open');
						} else {
							//for 3rd level menu
							parents_of_open_menus = menu.siblings('li').addBack().filter('.open');
							//if there are more then one menu (like in one line header with center logo)
							if(menu_list.length > 1){
								parents_of_open_menus = parents_of_open_menus.add(menu.parents('.top-menu').siblings().find('li.open'));
							}
						}

						if(is_vertical){
							parents_of_open_menus.children('ul.sub-menu').slideUp(350).promise().done(function(){
								parents_of_open_menus.removeClass('open');
								if(parents_of_open_menus.parents('li').length > 0){
									parents_of_open_menus.children('i.sub-mark').removeClass(G.submenu_third_lvl_closer).addClass(G.submenu_third_lvl_opener);
								}
								else{
									parents_of_open_menus.children('i.sub-mark').removeClass(G.submenu_closer).addClass(G.submenu_opener);
								}
								$window.trigger('mess_in_header');
							});
						}
						else{
							var _sub_menus = parents_of_open_menus.children('ul.sub-menu');

							if(can_use_transitions && typeof hard === 'undefined'){
								_sub_menus.on( transitionend_event, onHideTransitionEndFn );
								parents_of_open_menus.removeClass('open');
							}
							else{
								parents_of_open_menus.removeClass('open');
								cleanUpAfterHide();
							}
						}

						$body.off( click_event, bodyClickFn );
					},

					measureSubmenu = function(sub){
						//fixes resize of window issue when sub menu is opened near window edge
						header.css('overflow','hidden');

						//values
						var window_width      = $window.width(),
							submenu_width     = sub.addClass('measure').width(),
							sub_parent        = sub.parent(),
							sub_parent_offset = sub_parent.offset(),
							is_mega_menu      = sub_parent.hasClass('mega-menu'),
							temp              = 0,
							side_to_measure   = is_rtl ? 'right' : 'left',
							out               = false,
							parents,
							measured_offset,
							left_offset;

						if(!is_vertical){
							//for horizontal menu reset also inline css
							sub.css(side_to_measure, '');
						}

						//set back
						sub.removeClass('measure');

						if (is_vertical) {
							if(is_mega_menu){
								//if menu is wider then window
								if(submenu_width > (window_width - header.width())){
									sub.width(window_width);
								}
							}
						}
						else{
							left_offset = sub_parent_offset.left;
							measured_offset = is_rtl? (window_width - (left_offset + sub_parent.outerWidth())) : left_offset;

							if(is_mega_menu){
								//if menu is wider then window
								if(submenu_width > window_width){
									sub.width(window_width);
									submenu_width = window_width;
								}

								temp = measured_offset + submenu_width;
								if(temp > window_width){
									sub.css(side_to_measure, - ( temp - window_width ) );
								}
							}
							//out of the edge of the screen, then show on other side
							else{
								//check on which level is this submenu
								parents = sub.parents('ul');
								temp = parents.length;

								//first level
								if(temp === 1){
									if(measured_offset + submenu_width > window_width){
										out = true;
									}
								}

								//next levels
								else if(temp > 1){
									var parent_ul = parents.eq(0),
										parent_left = parent_ul.offset().left,
										parent_width = parents.eq(0).width(),
										parent_measured_offset = is_rtl? (window_width - (parent_left + parent_width)) : parent_left;

									if(parent_measured_offset + parent_width + submenu_width > window_width){
										out = true;
									}
								}

								if(out){
									sub.addClass('otherway');
								}
							}
						}

						//back to normal
						header.css('overflow','');
					},

					mobileOverlayClickFn = function(e){
						e.preventDefault();
						menu_init.trigger('click');
					},

					mobile_menu_toggle = function(ev){
						ev.stopPropagation();
						ev.preventDefault();

						var opener = $(this);

						//hide menu
						if(menu.hasClass('open')){
							menu.slideUp(200, function(){
								menu.children().hide();//helps with menu 'flicker' on IOS
								sub_menus.attr('style','');
								sub_parents.removeClass('open').attr('style','');
								if_needed_make_scrolling_mobile_menu();
								opener.removeClass('active');
							});
							menu.removeClass('open');

							$body.removeClass('mobile-menu-open');
							overlay.off( click_event, mobileOverlayClickFn );
						}
						//show menu
						else{
							menu_list.show(); //helps with menu 'flicker' on IOS
							menu.slideDown(200,if_needed_make_scrolling_mobile_menu);
							menu.addClass('open');
							opener.addClass('active');

							$body.addClass('mobile-menu-open');
							overlay.on( click_event, mobileOverlayClickFn );
						}
					},

					mobile_submenu_toggle = function(ev){
						ev.stopPropagation();
						ev.preventDefault();

						var li   = $(this).parent(),
							menu = li.children('ul');

						//hide
						if(li.hasClass('open')){
							menu.slideUp(200, if_needed_make_scrolling_mobile_menu);
							li.removeClass('open');
						}
						//show
						else{
							menu.slideDown(200, if_needed_make_scrolling_mobile_menu);
							li.addClass('open');
						}
					},

					if_needed_make_scrolling_mobile_menu = function(){
						var parent_height   = header.height() + menu.height(),
							parent_top      = is_vertical ? parseInt(header.css('top'),10) : parseInt(header.css('margin-top'),10),
							available_space = $window.height(),
							has_class       = header.hasClass(scrollable_class);

						//smallest screen width don't need this
						if(is_vertical && A13F.layout.size <= break_point[0]){
							return;
						}

						//we have to make menu scrollable
						if(!has_class && parent_height > (available_space-parent_top)){
							header.addClass(scrollable_class).css(is_vertical?'margin-top' : 'top',$window.scrollTop());
						}
						//normal fixed menu
						else if(has_class && parent_height <= (available_space-parent_top)){
							header.removeClass(scrollable_class).css(is_vertical?'margin-top' : 'top','');
						}
					},

					mobileEvents = function(on){
						if(typeof on !== 'undefined' && on === false){
							header.removeClass('mobile-menu');

							//clean after mobile menu cause we did animations on it
							menu_init.off(click_event);
							menu.removeClass('open').attr('style','');
							menu_init.removeClass('active');
							menu_list.css('display','');
							header_tools.removeClass('menu-open');
							header.removeClass(scrollable_class).css('margin-top','');

							if(sub_menus.length){
								sub_parents.removeClass('open').children('i.sub-mark, span.title').off('click');
								sub_menus.removeClass('open').attr('style','');
							}

							//clean after mobile menu overlay
							$body.removeClass('mobile-menu-open');
							overlay.off( click_event, mobileOverlayClickFn );

							if(!!parseInt(G.close_mobile_menu_on_click, 10)){
								//all menu items that are not parent
								menu_list.find('li').not(sub_parents).off('click.mobile');
							}
						}
						else{
							header.addClass('mobile-menu');
							//bind open menu
							//no double binds!
							menu_init.off(click_event);
							menu_init.on(click_event, mobile_menu_toggle);

							if(sub_menus.length){
								//bind open submenu
								//no double binds!
								sub_parents.children('i.sub-mark, span.title').off('click');
								sub_parents.children('i.sub-mark, span.title').on('click', mobile_submenu_toggle);
							}
							if(!!parseInt(G.close_mobile_menu_on_click, 10)){
								//all menu items that are not parent
								menu_list.find('li').not(sub_parents).off('click.mobile').on('click.mobile', function(){
									menu_init.trigger('click');
								});
							}
						}
					},

				//resize for menu
					layout = function(event, size){
						var menu_type = menu.data('menu-type'),
							allow_mobile_menu = !!parseInt(G.allow_mobile_menu, 10);

						//if wide screen
						if(!allow_mobile_menu || (size > break_point[2] && menu_type !== 'desktop')){
							mobileEvents(false);
							desktopEvents(true);
							menu.data('menu-type', 'desktop');
						}
						//small screen
						else if(allow_mobile_menu && (size <= break_point[2] && menu_type !== 'mobile') ){
							//clean after desktop version
							desktopEvents(false);
							mobileEvents(true);
							menu.data('menu-type', 'mobile');
						}
					},

					detect_anchors = function(){
						var anchors = menu.find('a[href*="#"]').not('a[href="#"]'),
							anchors_on_this_page = $([]),
							ids_to_watch = [],
							active_class = 'current-menu-item',

							onlyUnique = function(value, index, self) {
								return self.indexOf(value) === index;
							},

							element_on_screen = function(id){
								var $elem 			= $('#'+id),
									windowHeight	= $window.height(),
									docViewTop 		= $window.scrollTop(),
									docViewBottom 	= docViewTop + windowHeight,
									elemTop 		= $elem.offset().top,
									elemBottom 		= elemTop + $elem.outerHeight(),
									activePoint 	= docViewBottom - 0.75*windowHeight;//25% height of current screen

								return {
									'inView' : !(((elemBottom >= docViewBottom) && (elemTop >= docViewBottom)) || ((elemBottom <= docViewTop) && (elemTop <= docViewTop))),
									'inActivePoint' : (elemBottom >= activePoint) && (elemTop <= activePoint)
								};
							},

							scrolling = function(){
								var elements_on_screen = [],
									how_many, id, links, positions;

								for(var i = 0; i < ids_to_watch.length; i++){
									id = ids_to_watch[i];
									links = anchors_on_this_page.filter('a[href*="#'+id+'"]');

									positions = element_on_screen(id);
									if(positions.inView){
										elements_on_screen.push({
											links: links,
											positions: positions
										});
									}
									else{
										links.parent().removeClass(active_class);
									}
								}

								how_many = elements_on_screen.length;

								//if only one element is on screen
								if( how_many === 1 ){
									elements_on_screen[0].links.parent().addClass(active_class);
								}
								//more elements
								else if(how_many > 1){
									for(i = 0; i < elements_on_screen.length; i++){
										if(elements_on_screen[i].positions.inActivePoint){
											elements_on_screen[i].links.parent().addClass(active_class);
										}
										else{
											elements_on_screen[i].links.parent().removeClass(active_class);
										}
									}
								}
							},

							noProtocolnoQuery = function(url){
								return url.split('?', 1)[0].replace(/^https?\:\/\//i, "");
							};

						if(anchors.length){
							//check if anchor is on this site
							anchors.each(function(){
								var $t = $(this),
									href = $t.attr('href').split('/#', 2),
									site, id;

								//http://site.com/#anchor
								if(href.length === 2){
									id = href[1];
									site = href[0];
								}
								//#anchor or http://site.com/page#anchor
								else{
									href = $t.attr('href').split('#', 2);
									site = href[0];
									id = href[1];
								}

								if(id.length){
									site = noProtocolnoQuery(site);

									//is this anchor to this page?
									if((site.length && window.location.href.indexOf(site) > -1) || !site.length){
										//make sure that these ids really exist on page!
										if($('#'+id).length){
											anchors_on_this_page = anchors_on_this_page.add($t);
											ids_to_watch.push(id);
										}
									}
								}
							});

							//remove duplicates
							ids_to_watch = ids_to_watch.filter( onlyUnique );


							//should we watch for something?
							if(anchors_on_this_page.length){
								$window.scroll(A13F.throttle(scrolling, 500));
								scrolling();//initial call
								$body.on('revolution.slide.onloaded', scrolling);
							}
						}
					};

				//register resize
				A13F.layout.add(layout);

				//initial layout
				layout({}, size);

				detect_anchors();

				//show menu
				menu.addClass('loaded');
			},

			headerHorizontal:  function() {
				//process only for horizontal header
				if (!header.hasClass('a13-horizontal')) {
					return;
				}

				var last_scroll_top             = 0,
					last_state                  = '',
					header_height               = header.outerHeight(),
					top_bar                     = header.find('div.top-bar-container'),
					access          			= header.find('nav.navigation-bar'),
					is_one_line_header          = header.hasClass('header-type-one_line'),
					shield_logo          		= is_one_line_header && header.find('div.logo-container').hasClass('shield'),
					one_line_header_h           = undefined,
					first_level_links           = header.find('ul.top-menu').children().children('a, span.title'),
					sticky_enabled              = !header.hasClass('no-sticky'),
					sticky_hiding               = !header.hasClass('sticky-no-hiding'),
					hide_header_until			= header.hasClass('hide-until-scrolled-to'),
					revolution_sliders          = $('div.rev_slider').filter( function(){ return $( 'li[data-variant]', this ).length; } ),
					vc_rows                     = $('div.vc_row').filter('[data-a13-header-color-variant]'),
					header_color_variants 		= G.header_color_variants,
					default_page_header_variant = G.default_header_variant,
					sticky_header_variant       = 'sticky',
					current_header_variant      = default_page_header_variant,
					last_header_variant         = default_page_header_variant,
					variants                    = ['dark', 'light', 'normal', sticky_header_variant],
					hidden_logo_class           = 'hidden-logo',
					scrolling_tracking          = sticky_enabled || hide_header_until || vc_rows.length || revolution_sliders.length,
					sticky_hiding_timeout		= 0,
					logos                       = {
						normal: header.find('a.normal-logo'),
						sticky: header.find('a.sticky-logo'),
						light : header.find('a.light-logo'),
						dark  : header.find('a.dark-logo')
					},
					social_colors               = {
						normal: G.header_normal_social_colors.split('|'),
						light : G.header_light_social_colors.split('|'),
						dark  : G.header_dark_social_colors.split('|'),
						sticky: G.header_sticky_social_colors.split('|')
					},
					default_logo,
					all_logos                   = $([]),
					all_variants_classes        = '',

					layout = function(){
						if(!shield_logo && is_one_line_header){
							one_line_header_h = undefined;
							setItemsHeight();
						}

						//measure
						header_height = parseInt(header.outerHeight(), 10);

						//padding top of body
						if(G.hide_content_under_header === 'content'){
							//do nothing
						}
						else if(G.hide_content_under_header === 'title'){
							var title_bar = mid.find('header.outside'),
								color_layer = title_bar.children(),
								temp;

							if(title_bar.length){
								//reset
								color_layer.css('padding-top', '');
								//get neutral values
								temp = parseInt(color_layer.css('padding-top'), 10);
								color_layer.css('padding-top', header_height + temp);
							}
						}
						else{
							//push content below header
							$body.css('padding-top', header_height);
						}

						//refresh
						if( scrolling_tracking ) {
							scrolling();
						}

						//inform VC about mess
						$window.trigger('resize.vcRowBehaviour');
					},

					isElementUnderHeader = function($e){
						var scroll_top     = $window.scrollTop(),
							compare_point  = scroll_top + parseInt(header_height / 2, 10),
							element_height = $e.outerHeight(),
							element_top    = $e.offset().top;

						return compare_point > element_top && compare_point < (element_top + element_height);
					},

					switchStickyElements = function(on){
						if(on){
							//show sticky values of header
							header.addClass('sticky-values');

							if(top_bar.length && !G.header_sticky_top_bar){
								if(can_use_transitions) {
									//measure
									top_bar.css( 'height', top_bar.height()+'px' );

									top_bar.on(transitionend_event, onTopBarHideTransitionEndFn);
									//requestAnimationFrame often adds class at same repaint, and this blocks animation from running as element is shown at the same time when it suppose to be animated
									//that is why setTimeout is more reliable here
									setTimeout(function(){ top_bar.addClass('hide').css('height', ''); }, 15);
								}
								else{
									top_bar.addClass('hide').hide();
								}
							}

							if(sticky_hiding) {
								clearTimeout(sticky_hiding_timeout);
								sticky_hiding_timeout = setTimeout(function(){ header.css('position', 'fixed') },800);
							}

							$body.trigger('header-sticked');
						}
						else{
							//remove sticky values of header
							header.removeClass('sticky-values');

							if(top_bar.length && !G.header_sticky_top_bar){
								if(can_use_transitions) {
									//measure what height should be
									top_bar.show().addClass('measure');
									var height = top_bar.height();
									top_bar.removeClass('measure');

									top_bar.on(transitionend_event, onTopBarShowTransitionEndFn);
									//requestAnimationFrame often adds class at same repaint, and this blocks animation from running as element is shown at the same time when it suppose to be animated
									//that is why setTimeout is more reliable here
									setTimeout(function(){ top_bar.removeClass('hide').css('height', height+'px'); }, 15);
								}
								else{
									top_bar.show().removeClass('hide');
								}
							}

							if(sticky_hiding) {
								clearTimeout(sticky_hiding_timeout);
								sticky_hiding_timeout = setTimeout(function(){ header.css('position', '') },800);
							}

							$body.trigger('header-unsticked');
						}
					},

					changeSocials = function(remove, add){
						header.children('div.head').find('div.socials')
							.removeClass(social_colors[remove][0]+' '+social_colors[remove][1])
							.addClass(social_colors[add][0]+' '+social_colors[add][1]);

						if(top_bar.length){
							top_bar.find('div.socials')
								.removeClass(social_colors[remove][2]+' '+social_colors[remove][3])
								.addClass(social_colors[add][2]+' '+social_colors[add][3]);
						}
					},

					scrolling = function(e, data){
						if(sticky_enabled){
							var st = $window.scrollTop(),
								top_of_site = st === 0 || st < 0,
								normal_header_area = st < header_height,
								scrolling_down = st > last_scroll_top,
								scrolling_up = st < last_scroll_top,
								index = 0;

							if(!normal_header_area && scrolling_down && last_state !== 'noTop_scrollingDown' ){
								last_state = 'noTop_scrollingDown';

								//header fixed hidden
								if(sticky_hiding){
									header.addClass('sticky-hide');
								}
								switchStickyElements(1);
							}
							else if(normal_header_area && scrolling_down && last_state !== 'top_scrollingDown' ){
								last_state = 'top_scrollingDown';
								//do nothing, normal header still visible
							}
							else if(sticky_hiding && top_of_site && scrolling_up && header.hasClass('sticky-values')){
								header.css('position', '');//instant set
								header.removeClass('sticky-hide');
								switchStickyElements(0);
							}
							else if(sticky_hiding && normal_header_area && scrolling_up && last_state !== 'top_scrollingUp' && last_state !== 'top_scrollingDown' ){
								header.css('position', 'fixed');//instant set
								last_state = 'top_scrollingUp';
								header.removeClass('sticky-hide');
							}
							else if(!sticky_hiding && normal_header_area && scrolling_up && last_state !== 'top_scrollingUp' && last_state !== 'top_scrollingDown' ){
								last_state = 'top_scrollingUp';
								switchStickyElements(0);
							}
							else if(!normal_header_area && scrolling_up && last_state !== 'noTop_scrollingUp' ){
								last_state = 'noTop_scrollingUp';

								//header fixed show
								if(sticky_hiding) {
									header.css('position', 'fixed');//instant set
									header.removeClass('sticky-hide');
								}
								switchStickyElements(1)
							}
							else{
								//first call or resize event after load - we do nothing
							}

							last_scroll_top = st;
						}

						var element_under_header = false;

						//check if there is any slider with variants added
						if(revolution_sliders.length){
							for( index = 0; index < revolution_sliders.length; index++){
								var slider = revolution_sliders.eq(index);
								if(isElementUnderHeader(slider)){
									var slide,
										temp_variant = undefined;

									//from swap event
									if(typeof e !== 'undefined' && typeof e.type !== 'undefined' &&  e.type === 'revolution' && e.namespace === 'onbeforeswap.slide'){
										//check if we received event from slider that is under header
										if(data.nextslide.parents('div.rev_slider').eq(0).is(slider)){
											temp_variant = data.nextslide.attr('data-variant');
										}
										//if not then we are not interested and we finish function
										else{
											return;
										}
									}
									//from scroll event
									else{
										slide = slider.attr('data-slideactive');
										if(typeof slide !== 'undefined'){
											temp_variant = slider.find('li[data-index="'+slide+'"]').attr('data-variant');
										}
									}

									//if there is none variant defined for slide, then we will look in rows
									if( typeof temp_variant !== 'undefined'){
										element_under_header = true;
										setCurrentHeaderVariant( temp_variant );
									}

									//we don't need to check other sliders
									break;
								}
							}
						}

						//no slider were matched, lets try row
						if(!element_under_header && vc_rows.length){
							for( index = 0; index < vc_rows.length; index++){
								if(isElementUnderHeader(vc_rows.eq(index))){
									element_under_header = true;

									setCurrentHeaderVariant( vc_rows.eq(index).attr('data-a13-header-color-variant') );

									//we don't need to check other rows
									break;
								}
							}
						}

						//if none row or slider was matched get default variant for page
						if(!element_under_header){
							setCurrentHeaderVariant();//empty on purpose
						}

						if(hide_header_until){
							var show_after = parseInt(G.show_header_at, 10),
								row = {};
							show_after = show_after > 0 ? show_after : 1;
							//Elementor page builder
							if(typeof elementorFrontend === 'object' ){
								row = $('.elementor-section-wrap').children().eq(show_after-1);
							}
							//WPBakery Page builder
							else if(typeof vc_js === 'function' ){
								row = mid.find('div.real-content').children('div.vc_row').eq(show_after-1);
							}

							if( row.length && ($window.scrollTop() < row.offset().top ) ){
								header.addClass('hide-until-scrolled-to')
							}
							else{
								header.removeClass('hide-until-scrolled-to')
							}

						}
					},

					setItemsHeight = function(e){
						//noinspection JSValidateTypes
						var h = parseInt(header.find('div.logo-container').find('a.logo').not('.hidden-logo').innerHeight(), 10),
							allow_mobile_menu = !!parseInt(G.allow_mobile_menu, 10),
							size = A13F.layout.size;

						//if this is undefined then we are probably measuring layout when header is in its default state
						if (typeof one_line_header_h === 'undefined' || (typeof e !== 'undefined' && e.type === 'a13LogoLoaded')) {
							one_line_header_h = h;
						}

						//when header is unsticked we can use stored height of logo
						//to make animations of logo and line height go in same time to proper values
						if(typeof e !== 'undefined' && e.type === 'header-unsticked'){
							h = one_line_header_h;
						}

						//menu enabled
						if(first_level_links.length){
							if(size > break_point[2] || !allow_mobile_menu){
								first_level_links.css({ 'line-height' : h+'px', height : h+'px'});
							}
							else{
								first_level_links.css({ 'line-height' : '', height : ''});
							}
						}
						//we don't have any menu links to work on
						else{
							if(size > break_point[2]){
								access.css('min-height', h);
							}
							else{
								access.css('min-height', '');
							}
						}
					},

					setCurrentHeaderVariant = function(new_current_variant){
						//if header color variants are disabled
						if(header_color_variants === 'off'){
							return;
						}
						//only sticky changes are possible so overwrite send value
						if(header_color_variants === 'sticky'){
							new_current_variant = 'normal';
						}

						last_header_variant = current_header_variant;
						current_header_variant = new_current_variant;

						//if not defined variant then use default one for current header
						if( typeof current_header_variant === 'undefined' ){
							if(header.hasClass('sticky-values')){
								current_header_variant = sticky_header_variant;
							}
							else{
								current_header_variant = default_page_header_variant;
							}
						}
						//if "normal" variant for sticky header then use sticky color variant for it
						else if( current_header_variant === 'normal' && header.hasClass('sticky-values') ){
							current_header_variant = sticky_header_variant;
						}

						//skip if variant didn't change
						if(last_header_variant === current_header_variant){
							return;
						}

						cleanHeaderVariants();
						showHeaderVariant();
					},

					cleanHeaderVariants = function(){
						//clean all variants
						header.removeClass(all_variants_classes);

						//hide other logos
						if( all_logos.length ){
							all_logos.addClass(hidden_logo_class);
						}

						//change socials
						changeSocials(last_header_variant, default_page_header_variant);
					},

					showHeaderVariant = function(){
						//set header variant
						header.addClass('a13-' + current_header_variant + '-variant' );

						//set logo
						if(logos[current_header_variant].length){
							logos[current_header_variant].removeClass(hidden_logo_class);
						}
						//make sure that default logo will be visible if there is no logo for selected variant
						else{
							default_logo.removeClass(hidden_logo_class);
						}

						//change socials
						changeSocials(default_page_header_variant, current_header_variant);
					},

					onTopBarHideTransitionEndFn = function(ev){
						//do it only after visibility transition
						if( !top_bar.is(ev.target) || ev.originalEvent.propertyName !== 'visibility' ){ return; }
						top_bar.off( transitionend_event, onTopBarHideTransitionEndFn );

						top_bar.hide();
					},

					onTopBarShowTransitionEndFn = function(ev){
						//do it only after opacity transition
						if( !top_bar.is(ev.target) || ev.originalEvent.propertyName !== 'opacity' ){ return; }
						top_bar.off( transitionend_event, onTopBarShowTransitionEndFn );

						top_bar.css({
							'display' : '',
							'height' : ''
						});
					};


				//setup variables depending on default variant for current page
				for(var i = 0; i < variants.length; i++){
					all_variants_classes += ' a13-'+variants[i]+'-variant';
					all_logos = all_logos.add(logos[variants[i]]);

					//remember default page logo
					if(default_page_header_variant === variants[i]){
						if(logos[variants[i]].length){
							default_logo = logos[variants[i]];
						}
						//if no logo for current variant then set "normal" as default
						else{
							default_logo = logos['normal'];
						}
					}
				}

				//fix header height for single line header
				if(!shield_logo && is_one_line_header){
					$body.on('a13LogoLoaded header-unsticked header-sticked', setItemsHeight );
					//safe mechanism for logo
					header.find('a.logo').on(transitionend_event, function(e){
						if( e.originalEvent.propertyName === 'padding-top' ){
							if(header.hasClass('sticky-values')){
								setItemsHeight();
							}
							//make sure layout is in proper place if it is not sticky header now
							else{
								setTimeout(function(){ layout({}, A13F.layout.size); }, 500);
							}
						}
					});

					//because of line height animation we have to act on its change
					if(first_level_links.length){
						first_level_links.eq(0).on(transitionend_event, function(e){
							if( first_level_links.eq(0).is(e.target) && e.originalEvent.propertyName === 'height' ){
								if(!header.hasClass('sticky-values')) {
									layout({}, A13F.layout.size);
								}
							}
						});
					}
				}

				$body.on('a13LogoLoaded', layout);

				//register resize
				A13F.layout.add(layout);

				//initial layout
				layout({}, A13F.layout.size);

				//only if sticky version is enabled
				if(scrolling_tracking){
					$window.scroll(A13F.throttle(scrolling, 250));
				}

				if ( revolution_sliders.length ) {
					revolution_sliders.on('revolution.slide.onbeforeswap', scrolling);
				}
			},

			headerVertical:  function(){
				//process only for vertical header
				if(!header.hasClass('vertical')){
					return;
				}

				var windowWidth,
					top,
					bottom,
					top_offset,
					new_offset,
					whole_offset,
					admin_bar_height,
					top_border_offset,
					bottom_border_offset,
					borders_offset,
					header_height,
					window_height,
					body_height,
					resize_timer,
					header_content 			= header.find('div.head'),
					stick_to_bottom_class 	= 'stick_to_bottom',
					stick_to_top_class 		= 'stick_to_top',
					footer_marker			= 'footer-was-here',
					previous_window_top     = 0,
					current_window_top      = 0,
					ticking                 = false,
					is_border_layout        = $body.hasClass('site-layout-bordered'),
					is_border_layout_top    = is_border_layout && !$body.hasClass('no-border-top'),
					is_border_layout_bottom = is_border_layout && !$body.hasClass('no-border-bottom'),
					borders                 = $('div.theme-borders'),
					top_border              = borders.find('div.top-border'),
					bottom_border           = borders.find('div.bottom-border'),
					mobile_resolution		= false,

					calcOffsets = function(){
						window_height = $window.height();
						body_height = $body.height();
						admin_bar_height = is_adminbar ? parseInt(admin_bar.height(), 10) : 0;
						top_border_offset = is_border_layout_top ? parseInt(top_border.height(), 10) : 0;
						bottom_border_offset = is_border_layout_bottom ? parseInt(bottom_border.height(), 10) : 0;
						borders_offset = top_border_offset + bottom_border_offset;
						top_offset = admin_bar_height + top_border_offset;
						whole_offset = admin_bar_height + borders_offset;
					},

					scroll = function(){
						current_window_top = html.scrollTop || window.pageYOffset || 0; //IE8 || modern || 0 for undefined value in IE 8 if scrolled to top
						requestTick();
					},

					requestTick = function() {
						if (!ticking) {
							requestAnimationFrame( function(){ update(); } );
						}
						ticking = true;
					},

					reset = function(){
						//unpin and clean
						top = bottom = false;
						header.css('top', '').removeClass(stick_to_top_class).removeClass(stick_to_bottom_class);

						//set position so it wont be equal to current position
						previous_window_top = -1;
					},

					update = function(resize) {
						if(typeof resize === 'undefined'){
							resize = false;
						}

						// reset the tick so we can
						// capture the next onScroll
						ticking = false;

						if ( break_point[2] > windowWidth ) {
							return;
						}

						header_height 	= header_content.innerHeight();

						//resize occurred
						if(resize){
							reset();
						}

						if ( header_height > window_height - whole_offset ) {
							//scroll down
							if ( current_window_top >= previous_window_top ) {
								//top edge was pinned
								if ( top ) {
									//unpin top edge
									top = false;
									header.removeClass(stick_to_top_class);

									new_offset = current_window_top + admin_bar_height;
									header.css('top', new_offset);
								}
								//bottom edge not pinned
								else if ( ! bottom && //not pinned yet
									current_window_top + window_height > header_height + header.offset().top + bottom_border_offset && //position of window is bigger then unpinned header position
									header_height + whole_offset < body_height //header is smaller then body height
								) {
									bottom = true;
									header.css('top', '').addClass(stick_to_bottom_class).removeClass(stick_to_top_class);
								}

							}
							//scroll up
							else if ( current_window_top < previous_window_top ) {
								//bottom is pinned
								if ( bottom ) {
									//unpin bottom edge
									bottom = false;
									header.removeClass(stick_to_bottom_class);
									new_offset = current_window_top - borders_offset  + window_height - header_height;
									header.css('top', new_offset);
								}
								else if ( ! top && current_window_top + top_offset < header.offset().top ) {
									top = true;
									header.css('top', '').addClass(stick_to_top_class).removeClass(stick_to_bottom_class);
								}
							}
						}
						else if ( ! top ) {
							top = true;
							bottom = false;
							header.css('top', '').addClass(stick_to_top_class).removeClass(stick_to_bottom_class);
						}

						previous_window_top = current_window_top;
					},

					resizeAndScroll = function () {
						windowWidth = $window.width();
						current_window_top = html.scrollTop || window.pageYOffset || 0; //IE8 || modern || 0 for undefined value in IE 8 if scrolled to top
						update(true);
					},

					//resize function
					layout = function(event, size){
						calcOffsets();
						var access = header.find('nav.navigation-bar');

						//reset padding in header
						header_content.css('padding-bottom', '');
						//reset vertical header menu space
						access.css('height', '');

						var header_padding = parseInt( header_content.css('padding-bottom'), 10);

						if(size > break_point[2]){
							if(mobile_resolution){
								//give time for transitions if we are switching from smaller to bigger resolution
								mobile_resolution = false;
								clearTimeout( resize_timer );
								resize_timer = setTimeout( function(){ layout(event, size); }, 500 );

								//we will get back here in 500ms
								return;
							}

							//remove inline padding for mid, that could be set on smaller resolutions
							mid.css('padding-top', '' );
							//position footer inside of header
							if(footer.length){
								//if header is not placed in header yet
								if( !$('#' + footer_marker).length){
									//put marker
									footer.before('<div id="'+footer_marker+'" />');
									//move footer
									header_content.append(footer);
								}

								//padding positioning away from footer
								header_content.css('padding-bottom', footer.outerHeight(true) + header_padding );
							}

							//prepare space for vertically centered header
							var window_height = parseInt($window.height(), 10),
								access_height;

							if( parseInt(header.height(), 10) <= window_height ){
								access_height = parseInt(access.height(), 10) + (window_height - whole_offset - parseInt(header_content.innerHeight(), 10 ) );
								access.css('height', access_height);
							}

							//attach events for header scrolling
							if(typeof header.data('scrolling-events') === 'undefined'){
								header.data('scrolling-events', true);
								$window
									.on( 'scroll.header', scroll)
									.on( 'mess_in_header', function(){ /* so no event object is passed */ update(); } )
									.on( 'resize.header', function() {
										clearTimeout( resize_timer );
										resize_timer = setTimeout( resizeAndScroll, 500 );
									} );

								//initial call
								update();
							}
						}
						//resolution smaller or equal then 1024
						else{
							reset();
							mobile_resolution = true;

							//make sure footer is not in header anymore
							if(footer.length && header_content.find(footer).length) {
								$('#' + footer_marker).after(footer).remove();
								header_content.css('padding-bottom', '');
							}

							//de-attach any events for header scrolling
							if(typeof header.data('scrolling-events') !== 'undefined'){
								header.removeData('scrolling-events');
								$window.off( 'scroll.header mess_in_header resize.header');
								clearTimeout( resize_timer );
								header.css('top', '').removeClass(stick_to_top_class).removeClass(stick_to_bottom_class);
							}

							//resolution smaller or equal then 600
							if(size <= break_point[0]){
								//remove inline padding for mid, that could be set on smaller resolutions
								mid.css('padding-top', '' );
							}
							//smaller resolutions (601 - 1024)
							else{
								mid.css('padding-top', header.height() );
							}
						}
					};

				//register resize
				A13F.layout.add(layout);

				//initial layout
				layout({}, A13F.layout.size);

				//layout again if there are some images in footer
				if(footer.length){
					footer.imagesLoaded( function() {
						layout({}, A13F.layout.size);
					});
				}
			},

			headerSearch: function(){
				//showing search field
				var search_button = header_tools.find('#search-button');
				if(search_button.length){
					var parent = header.find('div.search-container'),
						sf = parent.find('form.search-form'),
						input = sf.find('input[name="s"]'),
						close = sf.next(),//span
						onShowTransitionEndFn = function(ev){
							//do it only after opacity transition
							if( ev.originalEvent.propertyName !== 'opacity' ){ return; }

							parent.off( transitionend_event, onShowTransitionEndFn );
							input.focus();
						},
						onHideTransitionEndFn = function(ev){
							//do it only after visibility transition
							if( ev.originalEvent.propertyName !== 'visibility' ){ return; }

							parent.off( transitionend_event, onHideTransitionEndFn );
							parent.removeClass('open')
						};

					search_button.on('click', function(){ //do not use click_event here, cause it closes item
						if(parent.hasClass('open')){
							close.click();
							return;
						}
						parent.addClass('open');
						if(can_use_transitions){
							parent.on( transitionend_event, onShowTransitionEndFn );
							//requestAnimationFrame often adds class at same repaint, and this blocks animation from running as element is shown at the same time when it suppose to be animated
							//that is why setTimeout is more reliable here
							setTimeout(function(){ parent.addClass('show'); }, 15);
						}
						else{
							parent.addClass('show');
							input.focus();
						}
						search_button.addClass('active');
					});

					close.on( click_event, function(e){
						e.preventDefault();
						if(can_use_transitions){
							parent.on( transitionend_event, onHideTransitionEndFn );
						}
						else{
							parent.removeClass('open')
						}
						parent.removeClass('show');
						search_button.removeClass('active');
					});
				}
			},

			topMessage : function(){
				var tm = $('#top-closable-message');
				if(tm.length){
					var button 	= tm.find('div.button').children(),
						x 		= tm.find('span.close-sidebar'),
						onHideTransitionEndFn = function(ev){
							//do it only after opacity transition
							if( ev.originalEvent.propertyName !== 'opacity' ){ return; }

							tm.off( transitionend_event, onHideTransitionEndFn );
							tm.remove();
						};

					button.add(x).one( click_event, function(ev){
						ev.stopPropagation();
						ev.preventDefault();

						//hide message
						if(can_use_transitions){
							tm.on( transitionend_event, onHideTransitionEndFn );
							tm.addClass('hide');
						}
						else{
							tm.addClass('hide');
							tm.remove();
						}

						//set cookie that message was read
						A13F.cookieExpire('apollo13framework_top_msg=closed', 7*24);//7 days
					});
				}
			},

			toolsLanguages : function(){
				var switcher = $('#tools-lang-switcher');
				if(switcher.length){
					var langs 	= switcher.parent();

					switcher.on( click_event, function(){
						langs.toggleClass('open');
					});
				}
			},

			toTop : function(){
				var tt = $('#to-top'),
					cb = function(){
						if ($window.scrollTop() > 100) {
							tt.addClass('show');
						} else {
							tt.removeClass('show');
						}
					};

				if(tt.length){
					cb(); //fire after refresh
					$window.scroll(A13F.debounce(cb, 250));
				}
			},

			scrollToAnchor : function(){
				var move = function(target, href){
						$('html,body').animate({
								scrollTop: Math.round(target.offset().top)
							}, 1000,
							function () {
								if(typeof href !== 'undefined'){
									window.location.hash = href;
								}
							}
						);
					},

					contentAnchorsFilter = function(){
						//we don't do script on VC pagination elements
						var item = $(this);

						return !(item.parent().hasClass('vc_pagination-item') || item.parents('li.vc_tta-tab').length || item.parents('h4.vc_tta-panel-title').length || item.hasClass('lae-tab-label'));
					},

					disableOtherPlugins = function(){
						var $events = $('a').filter('[href*="#"]').length ? $._data(document,"events") : null;
						if($events && typeof $events.click !== 'undefined'){
							for(var i = $events.click.length-1; i >= 0; i--){
								var handler = $events.click[i];
								if( handler && handler.selector === 'a[href*="#"]' ){
									handler.selector='a[href*="#"]:not(a)';
								}
							}
						}
					};

				//check if current page has hash and there is such element
				if(window.location.hash.length){
					var href = decodeURIComponent(window.location.hash);

					//if href is not one of those values
					if(['#','#!','#/'].indexOf(href) === -1 && href.indexOf('=') === -1 && href.indexOf('&') === -1){
						var	target = $(href),
							   one_page_target = $('div.vc_row[data-a13-one-page-pointer=' + href.slice(1) +']');

						target = target.length ? target : $('[name=' + href.slice(1) +']');
						target = target.add(one_page_target);

						if (target.length) {
							//delay scroll cause page is still loading
							setTimeout(function(){ move(target, href); }, 1500);
						}
					}
				}

				//menus
				var top_menu = $('ul.top-menu'),
					menu_overlay = $('#menu-overlay');

				//scan for anchors
				var content_anchors = mid.find('a').filter('[href*="#"]').not('[href="#"]').not('[href*="#!"]').not('[data-vc-container]').filter(contentAnchorsFilter),
					menu_anchors = top_menu.length ? top_menu.find('a').filter('[href*="#"]').not('[href="#"]').not('[href*="#!"]') : [],
					menu_overlay_anchors = menu_overlay.length ? menu_overlay.find('a').filter('[href*="#"]').not('[href="#"]').not('[href*="#!"]') : [],
					//connect all anchors
					anchors = content_anchors.add(menu_anchors).add(menu_overlay_anchors).add('#to-top');

				anchors.click(function(e) {
					if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
						var href = decodeURIComponent(this.hash),
							target = $(href),
							one_page_target = $('div.vc_row[data-a13-one-page-pointer=' + href.slice(1) +']');

						target = target.length ? target : $('[name=' + href.slice(1) +']');
						target = target.add(one_page_target);
						if (target.length && target.is(':visible')) {
							//not adding anchor in address bar
							if(!G.anchors_in_bar){
								move(target);
								if(typeof history !== 'undefined' && history.pushState) {
									history.pushState(null, null, window.location.pathname);
								}
							}
							//adding anchor in bar(after scroll animation)
							else{
								move(target, href);
							}

							e.preventDefault(); //<- not adding anchor but allows propagation
							//return false; //<- this prevents propagation so click events don't fire on other elements,
											// but we need them in hiding mobile navigation on one pagers
						}
					}
				});

				$window.on('load',function(){
					setTimeout( disableOtherPlugins, 300 );
				});
			},

			menuOverlay : function(){
				var switches = $( '#menu-overlay-switch' );

				if( switches.length ){
					var menu = $('#menu-overlay'),
						closing_x = $('span.close-menu'),

						resetMenu = function() {
							switches.removeClass('active');
							menu.removeClass('open');
						},

						openFn = function(ev) {
							ev.stopPropagation();
							ev.preventDefault();

							if( menu.hasClass('open') ){
								closeFn(ev);
								return;
							}

							switches.addClass('active');
							menu.addClass('open');

							menu.on( transitionend_event, onHideTransitionEndFn );

							//check if content isn't too high
							if(menu.children().height() > menu.height()){
								menu.addClass('big-content');
							}
						},

						onHideTransitionEndFn = function( ev ) {
							//do it only after visibility transition
							if( ev.originalEvent.propertyName !== 'visibility' ){ return; }
							//and only if it is menu element
							if(menu.is(ev.target)){
								menu.off( transitionend_event, onHideTransitionEndFn );
								menu.removeClass( 'big-content' );
							}
						},

						closeFn = function(e) {
							e.preventDefault();
							resetMenu();
						};

					switches.on( click_event, openFn );
					closing_x.on( click_event, closeFn );
					if(!!parseInt(G.menu_overlay_on_click, 10)){
						menu.find('.menu-item').find('a').on('click', function(){
							closing_x.trigger('click');
						});
					}
				}
			},

			sideMenu : function(){
				var switches = $( '#side-menu-switch' );

				if( switches.length ){
					var postfix_size = '-switch'.length,
						closing_x    = $('span.close-sidebar'),
						overlay      = $('#content-overlay'),
						id,

						resetMenu = function() {
							switches.removeClass('active');
							$body.removeClass( id+'-open');
						},

						bodyClickFn = function(evt) {
							evt.preventDefault();
							var target = $(evt.target);

							if(target.is(closing_x) || !target.parents().addBack().hasClass( 'side-widget-menu' ) ) {
								resetMenu();
								overlay.off( click_event, bodyClickFn );
								closing_x.off( click_event, bodyClickFn );
							}

						};

					switches.on( click_event, function(ev) {
						ev.stopPropagation();
						ev.preventDefault();

						var sw 	= $(this),
							sw_id = sw.attr('id');

						//close if it is open
						if(sw.hasClass('active')){
							overlay.trigger('click');
						}
						else{
							//hide if any other element with overlay is open
							overlay.trigger('click');

							sw.addClass('active');

							id = sw_id.slice(0, sw_id.length - postfix_size);

							$body.addClass(id+'-open');

							overlay.on( click_event, bodyClickFn );
							closing_x.on( click_event, bodyClickFn );
						}
					});
				}
			},

			basketMenu : function(){
				var switcher = $( '#basket-menu-switch' );

				if( switcher.length ){
					var closing_x = $('span.close-sidebar'),
						id = 'basket-menu',
						sidebar = $('#' + id),
						is_vertical	= header.hasClass('vertical'),
						is_vertical_right = is_vertical && $body.hasClass('header-side-right'),

						basketPosition = function(){
							var size = A13F.layout.size,
								top, side;

							//in case previous animation did not finish
							cleanUpAfterEffect();

							if(is_vertical_right && (size > break_point[2])){
								top = parseInt(switcher.offset().top, 10);
								side = parseInt(header.offset().left, 10) - sidebar.innerWidth();
							}
							else if(is_vertical && (size > break_point[2])){
								top = parseInt(switcher.offset().top, 10);
								side = parseInt(header.outerWidth(), 10) + parseInt(header.offset().left, 10);
							}
							else{
								top = parseInt(header.offset().top, 10) + parseInt(header.outerHeight(), 10);
								side = parseInt(switcher.offset().left, 10) - 160 + parseInt(switcher.width()/2);

								if(side + 320 > $window.width()){
									side = ($window.width() - 320);
								}
							}

						    return {display: 'block', top: top, left: side };
						},

						resetMenu = function() {
							switcher.removeClass('active');
							$body.removeClass( id+'-open');
						},

						bodyClickFn = function(evt) {
							var target = $(evt.target),
								size = A13F.layout.size;

							if(target.is(closing_x) || !target.parents().addBack().hasClass( 'basket-sidebar' ) ) {
								resetMenu();
								if(can_use_transitions){
									if(is_vertical && (size > break_point[2])){
										sidebar.css('transform', 'translateY(100%)');
										sidebar.on( transitionend_event, onHideTransitionEndFn );
										sidebar.removeClass('show');
									}
									else{
										sidebar.on( transitionend_event, onHideTransitionEndFn );
										sidebar.removeClass('show');
									}
								}
								else{
									sidebar.removeClass('show');
									cleanUpAfterEffect();
								}

								$body.off( click_event, bodyClickFn );
								closing_x.off( click_event, bodyClickFn );
							}

						},

						onHideTransitionEndFn = function(ev){
							//do it only after visibility transition
							if( !sidebar.is(ev.target) || ev.originalEvent.propertyName !== 'visibility' ){ return; }

							cleanUpAfterEffect();
						},

						cleanUpAfterEffect = function(){
							sidebar.off( transitionend_event, onHideTransitionEndFn );
							sidebar.hide().css('transform', '');
						};

					switcher.on( click_event, function(ev) {
						ev.stopPropagation();
						ev.preventDefault();

						//if we are clicking switcher again to close basket
						if($body.hasClass(id+'-open')){
							//propagation is stopped so we need to trigger it
							bodyClickFn({target:closing_x});
							return;
						}

						switcher.addClass('active');
						$body.addClass(id+'-open');

						//count position
						sidebar.css(basketPosition());

						//requestAnimationFrame often adds class at same repaint, and this blocks animation from running as element is shown at the same time when it suppose to be animated
						//that is why setTimeout is more reliable here
						setTimeout(function(){ sidebar.addClass('show'); }, 15);

						$body.on( click_event, bodyClickFn );
						closing_x.on( click_event, bodyClickFn );
					});
				}
			},

			titleBar : function(){
				var tb = mid.find('header.title-bar.has-effect');
				if(tb.length){
					$window.on('scroll resize a13_title_bar_trigger', function() {
						var move_edge        = 50, // we can move detection of edge of range by x px
							window_top       = html.scrollTop || window.pageYOffset || 0, //IE8 || modern || 0 for undefined value in IE 8 if scrolled to top
							window_height    = parseInt($window.height(), 10),
							elem_height      = parseInt(tb.outerHeight(), 10),
							top_range        = parseInt(tb.offset().top, 10) + move_edge,
							end_range        = (top_range + elem_height),
							range            = elem_height,
							percent_in_range = (window_top - top_range) / range;

						if(percent_in_range < 0 ){
								percent_in_range = 0;
						}
						if(percent_in_range > 1 ){
							percent_in_range = 1;
						}

						//we can see element
						if(window_top > end_range && window_top+window_height < top_range){
							//not visible on screen, we do nothing
						}
						else{
							tb.children().children().css({ //div.in
								position: 'relative',
								top : (elem_height * percent_in_range),
								opacity: 1 - (2.5*percent_in_range)
							});
						}
					});

					//start call
					$window.trigger('a13_title_bar_trigger');

				}
			},

			pageSlider : function(){
				var sliders = $(".item-slider");
				if(sliders.length){
					//noinspection JSUnresolvedFunction
					sliders.filter(function () {
						var images = $(this).find('img');
						return images.length > 1;
					})

					.slidesjs({
						width: 940,
						height: 528.75,
						pagination: {
							active: true
						},
						navigation: {
							active: false,
							// [boolean] Generates next and previous buttons.
							// You can set to false and use your own buttons.
							// User defined buttons must have the following:
							// previous button: class="slidesjs-previous slidesjs-navigation"
							// next button: class="slidesjs-next slidesjs-navigation"
							effect: "slide"
							// [string] Can be either "slide" or "fade".
						},
						play: {
							active: false,
							// [boolean] Generate the play and stop buttons.
							// You cannot use your own buttons. Sorry.
							effect: "slide",
							// [string] Can be either "slide" or "fade".
							interval: 5000,
							// [number] Time spent on each slide in milliseconds.
							auto: true,
							// [boolean] Start playing the slideshow on load.
							swap: false,
							// [boolean] show/hide stop and play buttons
							pauseOnHover: false,
							// [boolean] pause a playing slideshow on hover
							restartDelay: 2500
							// [number] restart delay on inactive slideshow
						}
					});
				}
			},

			footer :  function(){
				if(footer.length && header.hasClass('a13-horizontal')){
					var unravel_effect = footer.hasClass('unravel'),
						footer_height,
						//for unravel effect
						scrolling = function(){
							var st = $window.scrollTop(),
								document_height = $(document).height(),
								window_height = $window.height();

							if(document_height - window_height - st <= footer_height){
								footer.removeClass('hide-it');
							}
							else{
								footer.addClass('hide-it');
							}
						},
						layout = function(event, size){
							footer_height = footer.outerHeight();
							$window.off('scroll.footer');

							if (size <= break_point[2]) {
								//make sure footer will be on bottom of page
								var offset = parseInt(mid.offset().top, 10),
									padding = parseInt(mid.css('padding-top'), 10),
									space = $window.height();

								mid.css('min-height', space - (offset + padding + footer_height));

								//remove unravel effect for small screens
								if(unravel_effect){
									mid.css('margin-bottom', '');
									footer.removeClass('hide-it');
								}
							}
							else{
								//don't push footer on big screens
								mid.css('min-height', '');

								//unravel effect
								if(unravel_effect){
									$window.on('scroll.footer', A13F.throttle(scrolling, 50));

									mid.css('margin-bottom', footer_height);
									scrolling();
								}
							}
						};


					//register resize
					A13F.layout.add(layout);

					//initial layout
					layout({}, A13F.layout.size)
				}
			},

			blogMasonry : function($scope){
				$scope = typeof $scope === 'undefined'? $body : $scope;
				var $container = $scope.find('div.posts-grid-container'),
					is_vertical		= header.hasClass('vertical');
				for(var i = 0; i < $container.length; i++){
					var _container = $container.eq(i),
						filter = _container.parent().prev('ul.posts-filter');

					//skip if it was initialized already
					if(_container.data('isotope')){
						continue;
					}

					if(is_vertical) {
						filter = filter.add(header.find('ul.blog-filter')); //blog not posts
					}

					A13F.elementsActions.lazyLoadBricks({
						container	: _container,
						items		: '.archive-item',
						filter 		: filter,
						gutter		: _container.data('margin'),
						layoutMode  : G.posts_layout_mode
					});
				}
			},

			shopMasonry : function(){
				A13F.elementsActions.lazyLoadBricks({
					container	: mid.find('.content-box').children('.formatter').children('ul.products'),//make sure only main list is affected
					items		: 'li.product',
					filter 		: '',
					gutter		: G.products_brick_margin,
					layoutMode  : G.products_layout_mode
				});
			},

			albumsListMasonry : function($scope){
				$scope = typeof $scope === 'undefined'? $body : $scope;
				var $container = $scope.find('div.albums-grid-container'),
					is_vertical		= header.hasClass('vertical');
				for(var i = 0; i < $container.length; i++){
					var _container = $container.eq(i),
						filter = _container.parent().prev('ul.albums-filter');

					//skip if it was initialized already
					if(_container.data('isotope')){
						continue;
					}

					if(is_vertical) {
						filter = filter.add(header.find('ul.albums-filter'));
					}

					A13F.elementsActions.lazyLoadBricks({
						container	: _container,
						items		: '.archive-item',
						filter 		: filter,
						gutter		: _container.data('margin'),
						layoutMode  : G.albums_list_layout_mode
					});
				}
			},

			worksListMasonry : function($scope){
				$scope = typeof $scope === 'undefined'? $body : $scope;
				var $container = $scope.find('div.works-grid-container'),
					is_vertical		= header.hasClass('vertical');
				for(var i = 0; i < $container.length; i++){
					var _container = $container.eq(i),
						filter = _container.parent().prev('ul.works-filter');

					//skip if it was initialized already
					if(_container.data('isotope')){
						continue;
					}

					if(is_vertical) {
						filter = filter.add(header.find('ul.works-filter'));
					}

					A13F.elementsActions.lazyLoadBricks({
						container	: _container,
						items		: '.archive-item',
						filter 		: filter,
						gutter		: _container.data('margin'),
						layoutMode  : G.works_list_layout_mode
					});
				}

				//bind to VC grid elements loaded event
				$window.on('grid:items:added', function(){
					//post is loaded
					$body.trigger( 'post-load' );
				});
			},

			peopleListMasonry : function($scope){
				$scope = typeof $scope === 'undefined'? $body : $scope;
				var $container = $scope.find('div.people-grid-container');
				for(var i = 0; i < $container.length; i++){
					var _container = $container.eq(i);
					//skip if it was initialized already
					if(_container.data('isotope')){
						continue;
					}

					A13F.elementsActions.lazyLoadBricks({
						container	: _container,
						items		: '.archive-item',
						filter 		: _container.parent().prev('ul.people-filter'),
						gutter		: _container.data('margin'),
						layoutMode  : G.people_list_layout_mode
					});
				}
			},

			A13PostLightbox : function(){
				var next_item, prev_item,
					lightbox_id = '#a13-post-lightbox',
					lightbox_url_prefix = '#a13lightbox-',
					history_api = typeof history !== 'undefined' && history.pushState,

					openItemInLightbox = function(target, add_history){
						if(typeof add_history === 'undefined'){
							add_history = true;
						}

						//create lightbox
						createLightbox();
						var lightbox = $(lightbox_id);

						//push URL state
						if(add_history) {
							var base_url = window.location.href.split("#")[0],
								new_state = base_url+lightbox_url_prefix+target.parents().filter('.object-item').eq(0).attr('data-id');
							pushNewState(new_state);
						}

						$html.addClass('post-lightbox-active');

						//make ajax call for content
						lightbox.children('div.a13-post-lightbox-content')
							.load(target.attr('href'), 'a13-ajax-get', function () {
								lightbox.removeClass('loading');

								//get links for next and previous post, but next and previous are items from post grid
								getNavLinks(target);

								//post is loaded
								$body.trigger( 'post-load' );

								//prepare HTML5 videos for slider
								var $gallery      = lightbox.find(".gallery-media-collection");
								if( $gallery.length ) {
									var $gallery_items = $gallery.children();

									$gallery_items.each(function () {
										var $el    = $(this),
											$video = $el.find('div.album-video');

										if ($video.length) {
											$el.attr('data-html', '#' + $video.attr('id'));
										}
									});
								}

								//run some scripts for content
								A13F.elementsActions.useSlider( lightbox.find('.a13-slider-stuff').attr('data-window_high', 'off' ));

								//Visual Composer
								if(typeof vc_js === 'function' ){
									vc_js();
								}

								//block scroll to not move too far

								//load images
								lightbox
									.find('div.real-content')
									.add(lightbox.find('div.similar-works-frame'));
							});
					},

					openFromHash = function(href){
						//if found lightbox prefix
						if(href.indexOf(lightbox_url_prefix) === 0 ){
							var lb_id = href.slice(lightbox_url_prefix.length),
								lb_item;

							lb_item = $('div[data-id="'+lb_id+'"]').children('a');
							if(lb_item.length){
								openItemInLightbox(lb_item, false);
							}
						}
						//if lightbox is open then close it
						else{
							var lightbox = $(lightbox_id);
							if(lightbox.length && lightbox.is(':visible')){
								lightbox.children('div.controls').find('span.close').trigger('click');
							}
						}
					},

					pushNewState = function(new_state){
						if(history_api) {
							//don't push same state two times in a row
							if(new_state !== window.location.href){
								history.pushState(null, null, new_state);
							}
						}
					},

					getNavLinks = function(current_element){
						var parents = current_element.parents(),
							controls = $(lightbox_id).children('div.controls'),
							item;

						//if item was from similar-works then search in post lists
						if(parents.is('div.similar-works-frame')){
							//switch item to posts list item if possible
							item = $('#'+parents.filter('.object-item').attr('id'));
							if(item.length){
								parents = item.parents();
							}
						}

						//look in works list
						if(parents.is('div.bricks-frame')){
							item = parents.filter('.object-item');

							//get prev link
							prev_item = item.prevAll('.object-item').filter(':visible').eq(0);
							prev_item = prev_item.length ? prev_item.children('a') : '';

							//get next link
							next_item = item.nextAll('.object-item').filter(':visible').eq(0);
							next_item = next_item.length ? next_item.children('a') : '';
						}
						//look in posts grid
						else if(parents.is('div.post-grid-bricks-frame')){
							item = parents.filter('div.vc_grid-item');

							//get prev link
							prev_item = item.prevAll('div.vc_grid-item').filter(':visible').eq(0);
							prev_item = prev_item.length ? prev_item.find('.object-item').children('a') : '';

							//get next link
							next_item = item.nextAll('div.vc_grid-item').filter(':visible').eq(0);
							next_item = next_item.length ? next_item.find('.object-item').children('a') : '';
						}
						else{
							prev_item = '';
							next_item = '';
						}

						//activate links
						next_item.length? controls.find('span.next').removeClass('inactive') : controls.find('span.next').addClass('inactive');
						prev_item.length? controls.find('span.prev').removeClass('inactive') : controls.find('span.prev').addClass('inactive');
					},

					createLightbox = function () {
						var lightbox_id = '#a13-post-lightbox',
							$el         = $(lightbox_id),
							first_call  = false,
							controls,

							showLightbox = function(){
								$el.show();
								//requestAnimationFrame often adds class at same repaint, and this blocks animation from running as element is shown at the same time when it suppose to be animated
								//that is why setTimeout is more reliable here
								setTimeout(function(){ $el.addClass('show'); }, 15);
							},

							deactivateNavigation = function(){
								controls.find('span').not('.close').addClass('inactive');
							},

							onHideTransitionEndFn = function(ev){
								//do it only after visibility transition
								if( !$el.is(ev.target) || ev.originalEvent.propertyName !== 'visibility' ){ return; }

								$el.off( transitionend_event, onHideTransitionEndFn );
								cleanUpAfterHide();
							},

							cleanUpAfterHide = function(){
								$el.hide();
								//destroy any sliders in lightbox
								$el.find('.a13-slider').trigger('a13-slider-destroy');
								//remove content
								$el.children('div.a13-post-lightbox-content').empty();
							};

						//prepare lightbox if it does not exist yet
						if (!$el.length) {
							//create lightbox HTML
							$('<div id="a13-post-lightbox" class="a13-post-lightbox">' +
								'<div class="a13-post-lightbox-content"></div>' +
								'<div class="controls">' +
								'	<span class="close fa fa-times"></span>' +
								'	<span class="prev fa fa-chevron-'+(is_rtl? 'right' : 'left')+' inactive"></span>' +
								'	<span class="next fa fa-chevron-'+(is_rtl? 'left' : 'right')+' inactive"></span>' +
								'</div>' +
								'<div class="a13-post-lightbox-preloader"></div>' +
								'</div>')
								.appendTo($body);

							first_call = true;
						}

						//get elements
						$el = $(lightbox_id);
						controls = $el.children('div.controls');
						//clean sliders
						$el.find('.a13-slider').trigger('a13-slider-destroy');

						//lightbox just created
						if (first_call) {
							//bind events
							controls
								//close
								.find('span.close').on(click_event, function () {
									if(can_use_transitions){
										$el.on( transitionend_event, onHideTransitionEndFn );
										$el.removeClass('show');
									}
									else{
										$el.removeClass('show');
										cleanUpAfterHide();
									}

									deactivateNavigation();
									$window.off('scroll.a13-lightbox');

									$html.removeClass('post-lightbox-active');

									//push closed state
									pushNewState(window.location.href.split("#")[0]);
								}).end()

								//go to previous
								.find('span.prev').on(click_event, function () {
									if (!prev_item.length || $(this).hasClass('inactive') || $el.is('.loading')) {
										return;
									}
									openItemInLightbox(prev_item);
								}).end()

								//go to next
								.find('span.next').on(click_event, function () {
									if (!next_item.length || $(this).hasClass('inactive') || $el.is('.loading')) {
										return;
									}
									openItemInLightbox(next_item);
								});

							showLightbox();
						}

						//we already have lightbox element present
						else {
							//check if it is currently open
							if($el.is(':visible')){
								deactivateNavigation();
							}
							//just open
							else{
								deactivateNavigation();
								showLightbox();
							}
						}

						$el.addClass('loading');
					};

				//bind open of lightbox
				$body.on('click', '.open-item-in-lightbox > a', function(event){
					event.preventDefault();
					var target = $(event.target);

					//lets open our lightbox
					if(target.is('a')){
						openItemInLightbox(target);
					}
				});

				//history moving
				$window.on('popstate', function () {
					openFromHash(window.location.hash);
				});

				//check if it is link to our lightbox on page load
				if(window.location.hash.length){
					openFromHash(window.location.hash);
				}
			},

			lazyLoadBricks : function(args){
				var $container = (args.container instanceof jQuery) ? args.container : $(args.container);

				if($container.length){
					var items_selector  = args.items,
						pagination		= mid.find('nav.navigation'),
						loading_space 	= $('#loadingSpace'),
						filter 			= (args.filter instanceof jQuery) ? args.filter : $(args.filter),
						layoutMode		= args.layoutMode,
						gutter 			= parseInt(args.gutter,10),
						lli_id 			= 'lazyload-indicator',
						lazy_load		= $container.data('lazy-load'),
						lazy_load_mode	= $container.data('lazy-load-mode'),
						lazy_load_auto 	= lazy_load && lazy_load_mode === 'auto',
						lazy_load_button= lazy_load && !lazy_load_auto,

						addLoader = function(elem){
							var loader = $('#'+lli_id);

							if( !loader.length ){
								loader = $('<div id="'+lli_id+'" class="idle" title="'+ G.loading_items+'"><div class="ll-animation"></div></div>')
									.appendTo( (typeof elem === 'undefined') ? $body : elem );
							}
							loader.removeClass('idle');
						},

						removeLoader = function(){
							$('#'+lli_id).addClass('idle');
						},

						addLoadMoreButton = function(){
							var prev = pagination.prev('.load-more-button');
							if(prev.length){
								return;
							}

							//insert pagination
							pagination.before('<div class="load-more-button"><span class="text">'+G.load_more+'<i class="a13icon-plus"></i></span><span class="ll-animation"></span></div>');

							var result_count = $('span.result-count');
							if(result_count){
								$('div.load-more-button').append(result_count);
							}
						},

						removeLoadMoreButton = function(){
							var prev = pagination.prev('.load-more-button');
							if(prev.length){
								prev.fadeOut();
							}
						},

						loadMoreClick = function () {
							var button = $(this);

							//we have more then one page of items
							if(pagination.length){
								var next_link = pagination.find('a.next');

								if( !next_link.length ){
									//unbind loading more
									removeLoadMoreButton();

									return;
								}

								//activate loading on button
								button.addClass('loading');

								//get new items
								loading_space.load(next_link.attr('href'), 'a13-ajax-get', function(){
									//pagination replace
									var new_pagination = loading_space.find('.navigation');
									pagination.replaceWith(new_pagination);
									pagination = new_pagination;

									//update result count
									if( lazy_load_button ){
										var new_result_count = loading_space.find('span.result-count'),
											old_result_count = $('div.load-more-button').find('span.result-count');

										if(old_result_count){
											old_result_count.replaceWith(new_result_count);
										}
									}

									//check if button is still needed
									if(!new_pagination.find('a.next').length){
										removeLoadMoreButton();
									}

									loading_space.imagesLoaded( function() {
										var elems = loading_space.find(items_selector);

										if(typeof $.fn.mediaelementplayer !== 'undefined'){
											loading_space.find('.wp-video video').mediaelementplayer((typeof mejs === 'undefined' ? {} : mejs.MediaElementDefaults));
										}

										//make video look proper
										elems.fitVids();

										//add elements to main container
										elems.appendTo($container);

										//fix sliders
										A13F.elementsActions.pageSlider();

										//check for parallaxes
										A13F.elementsActions.parallax();

										// add and lay out newly appended elements
										$container.isotope( 'appended', elems );

										//finished loading
										//clear loading class
										button.removeClass('loading');

										//if no items, try to load more
										if( $container.data('isotope').filteredItems.length === 0 ){
											$('div.load-more-button').click();
										}
									});

								});
							}
						},

						bindLoadMore = function () {
							var action = function () {
									$window.off('.lazyload');
									loadTillViewIsFull();
								},

								cb = function () {
									var scroll_pos = $window.scrollTop() + $window.height();

									if ($container.height() - scroll_pos < 250) {
										action();
									}
								};

							$window.on('scroll.lazyload resize.lazyload', A13F.throttle(cb, 150));
						},

						loadTillViewIsFull = function () {
							//we have more then one page of items
							if(pagination.length){
								var next_link = pagination.find('a.next');

								if( !next_link.length ){
									//unbind loading more
									removeLoader();

									return;
								}
								else if ( !(($container.height() < (2 * $window.height() + $window.scrollTop())) && next_link.length) ){
									bindLoadMore();
									removeLoader();

									return; //nothing to do here
								}

								//lets load more items
								addLoader();

								//get new items
								loading_space.load(next_link.attr('href'), 'a13-ajax-get', function(){
									//pagination replace
									var new_pagination = loading_space.find('.navigation');
									pagination.replaceWith(new_pagination);
									pagination = new_pagination;

									//jetpack doesn't replace 1px GIF image that it insert instead of the original image, as it doesn't know about not loaded yet images
									//therefore we have to remove this 1px GIF ourself after loading images
									var jetpack_loading_images = loading_space.find('img.jetpack-lazy-image');

									if(jetpack_loading_images.length){
										jetpack_loading_images.removeAttr('srcset');
									}

									loading_space.imagesLoaded( function() {
										//get elements from loading space
										var elems = loading_space.find(items_selector);

										if(typeof $.fn.mediaelementplayer !== 'undefined'){
											loading_space.find('.wp-video video').mediaelementplayer((typeof mejs === 'undefined' ? {} : mejs.MediaElementDefaults));
										}

										//make video look proper
										elems.fitVids();

										//add elements to main container
										elems.appendTo($container);

										//fix sliders
										A13F.elementsActions.pageSlider();

										// add and lay out newly appended elements
										$container.isotope( 'appended', elems );

										//finished loading
										//but try to load more items
										loadTillViewIsFull();
									});

								});
							}
						};


					/****** STARTUP CONFIGURATION *****/
					if(!loading_space.length){
						loading_space = $('<div id="loadingSpace"></div>').appendTo($body);
					}

					//get layoutMode from param
					layoutMode = (typeof layoutMode !== 'undefined' && layoutMode.length) ? args.layoutMode : 'packery';
					//check if this layou mode is registered
					layoutMode = (typeof Isotope.LayoutMode.modes[layoutMode] === 'undefined')? 'masonry' : layoutMode;


					//start isotope
					$container.isotope({
						// main isotope options
						itemSelector: items_selector,
						transitionDuration: '0.6s',
						isOriginLeft: !is_rtl,

						layoutMode: layoutMode,
						// layout mode options
						packery: {
							columnWidth: '.grid-master',
							gutter: gutter
						},
						masonry: {
							columnWidth: '.grid-master',
							gutter: gutter
						},
						fitRows: {
							gutter: gutter
						}
					}).addClass('layout-'+layoutMode);

					// layout Isotope again after all images have loaded
					$container.imagesLoaded( function() {
						$container.isotope('layout');
						//and add more items
						if (lazy_load_auto) {
							loadTillViewIsFull();
						}
						else if( lazy_load_button ){
							//if no items, try to load more
							if( $container.data('isotope').filteredItems.length === 0 ){
								$('div.load-more-button').click();
							}
						}
					});

					// and again when web fonts are loaded
					$body.on('webfontsloaded', function(){
						if($container.data('isotope')){
							$container.isotope('layout');
						}
					});

					// and again when Smush will load images
					$(document).on('lazyloaded', function(){
						if($container.data('isotope')){
							$container.isotope('layout');
						}
					});

					//if jetpack lazy load images module is working layout items on each image load
					$body.on('jetpack-lazy-loaded-image', function(){
						if($container.data('isotope')){
							setTimeout( function(){$container.isotope('layout');}, 100 );
						}
					});

					//filter bind
					if(filter.length){
						var filters = filter.find('li');

						filters.on( click_event, function(ev){
							ev.stopPropagation();
							ev.preventDefault();

							filters.removeClass('selected');

							var f = $(this).addClass('selected'),
								category = f.data('filter');

							if(category === '__all'){ //__all so users will not overwrite this
								category = '*'
							}
							else{
								category = '[data-category-'+category+']';
							}

							$container.isotope({ filter: category });


							if(lazy_load_auto){
								//trigger scroll to load more elements if there is place
								$window.trigger('scroll.lazyload');
							}
							else if( lazy_load_button ){
								//if no items, try to load more
								if( $container.data('isotope').filteredItems.length === 0 ){
									$('div.load-more-button').click();
								}
							}
						});


						filters.filter('.selected').click();
					}

					//load more button
					if( lazy_load_button ){
						addLoadMoreButton();
						$('div.load-more-button').on(click_event, loadMoreClick);
					}
				}
			},

			singleCptMasonry : function(args){
				var $container = (args.container instanceof jQuery) ? args.container : $(args.container);

				if($container.length){
					var $items_list		= $container.prevAll('.gallery-media-collection'),
						$items			= $items_list.children(),
						unique_id		= args.id ? args.id : 1,
						loading_space 	= $('<div id="loadingSpace-'+unique_id+'" class="loadingSpace"></div>').appendTo($body),
						category_filter = args.filter ? ((args.filter instanceof jQuery) ? args.filter : $(args.filter)) : $([]),
						proofing_filter = args.proofing_filter ? $(args.proofing_filter) : $([]),
						proofing_accept	= $('#done-with-proofing'),
						lli_id 			= 'lazyload-indicator',
						cover_color		= $container.data('cover-color'),
						show_desc		= parseInt($container.data('desc'), 10),
						proofing		= parseInt($container.data('proofing'), 10),
						socials		    = parseInt($container.data('socials'), 10),
						p_manual_ids	= !!G.proofing_manual_ids,
						limit_per_load	= 2,
						pointer			= 0,//how many elements are loaded
						number_of_items = $items.length,
						thumbs_video	= args.thumbs_video ? args.thumbs_video : '',
						sticky_sidebar 	= args.sticky_sidebar ? args.sticky_sidebar_el : '',

						addLoader = function(elem){
							var loader = $('#'+lli_id);

							if( !loader.length ){
								loader = $('<div id="'+lli_id+'" class="idle" title="'+ G.loading_items+'"><div class="ll-animation"></div></div>')
									.appendTo( (typeof elem === 'undefined') ? $body : elem );
							}
							loader.removeClass('idle');
						},

						removeLoader = function(){
							$('#'+lli_id).addClass('idle');
						},

						bindLoadMore = function() {
							var action = function () {
									$window.off('.lazyload'+unique_id);
									loadTillViewIsFull();
								},
								cb = function () {
									var scroll_pos = $window.scrollTop() + $window.height();

									if ($container.height() + $container.offset().top - scroll_pos < 250) {
										action();
									}
								};

							$window.on('scroll.lazyload'+unique_id+' resize.lazyload'+unique_id, A13F.throttle(cb, 150));
							$window.on('filter.lazyload'+unique_id, action);
						},

						makeBrick = function(itemNumber){
							var $el              = $items.eq(itemNumber),
								html             = '',
								description      = $el.find('.item-desc').find('.description'),
								add_to_cart      = $el.find('.add_to_cart_inline'),
								link             = $el.children('.item__link'),
								title            = link.text(),
								filter_tags      = $el.data('filter'),
								data_attributes  = '',
								type			 = $el.hasClass('type-video')? 'type-video' : 'type-image',
								proofing_comment = proofing ? $el.find('div.proofing_comment').html() : '',//no matter if html() or text(). html() is fastest
								proofing_html = function(){
									var html = '';
									if(proofing){
										var proofing_id = $el.data('proofing_id')+'',//toString
											proofing_checked = $el.data('proofing_checked') == 1;

										//if auto ids for proofing
										if(!p_manual_ids && !$el.hasClass('subtype-videolink')){
											proofing_id = $el.data('id')+'';//toString
										}

										html += '<div class="proofing">';
										//no id for external videos
										if( proofing_id.length ) {
											html += '<span class="p-id">' + proofing_id + '</span>';
										}
										html += '<i class="p-comment fa fa-commenting'+(proofing_comment.length ? ' filled' : '')+'" title="'+G.proofing_add_comment+'"></i>';
										html += '<i class="p-check fa fa-check'+(proofing_checked ? ' filled' : '')+'" title="'+(proofing_checked ? G.proofing_uncheck_item : G.proofing_mark_item)+'"></i>';
										html += '</div>';
									}
									return html;
								};

							//collect filters
							if(typeof filter_tags !== 'undefined' && filter_tags.length){
								var tags = filter_tags.split(',');

								for(var i = 0; i < tags.length; i++){
									if(tags[i].length){
										data_attributes += ' data-category-'+tags[i]+'="1"';
									}
								}
							}

							if(proofing){
								data_attributes += ' data-proofing_checked="'+$el.data('proofing_checked')+'"';
								data_attributes += ' data-proofing_comment="'+$el.data('proofing_comment')+'"';
							}

							add_to_cart = add_to_cart.length ? $('<div />').append(add_to_cart.clone()).html() : '';

							//video
							if( !thumbs_video && type === 'type-video' ){
								//external video
								if( $el.hasClass('subtype-videolink') ){
									html += '<div class="archive-item object-item w'+$el.data('ratio_x')+' '+type+'"'+data_attributes+'>';
									html += '<iframe src="'+$el.data('video_player')+'" allowfullscreen></iframe>';
									html += proofing_html();
									html += '</div>';
								}
								//internal video
								else{
									html += '<div class="archive-item object-item w'+$el.data('ratio_x')+' '+type+'"'+data_attributes+'>';
									html += $($el.data('html')).html();
									html += proofing_html();
									html += '</div>';
								}
							}

							//images
							else{
								html += '<div class="archive-item object-item w'+$el.data('ratio_x')+' '+type+'"'+data_attributes+'>';
								html += '<img src="'+$el.data('brick_image')+'" alt="'+$el.data('alt_attr')+'" title="'+title+'" />';
								html += '<div class="cover" style="'+(cover_color? 'background-color:'+cover_color+';' : '')+'"></div>';
								html += '<div class="covering-image"></div>';
								html += '<div class="icon a13icon-plus"></div>';
								html += '<div class="caption">';
								if(show_desc){
									html += '<div class="texts_group">';
									html += '<h2 class="post-title">';
									if(title.length){
										html += title;
									}
									html += '</h2>';
									html += description.length ? ('<div class="excerpt">'+description.html()+add_to_cart+'</div>') : '';
									html += '</div>';
								}
								if($el.hasClass('link')){
									html += '<a href="'+link.attr('href')+'"'+( parseInt( $el.data('link_target'), 10 ) === 1 ? ' target="_blank"' : '' )+'></a>';
								}
								html += '</div>'; //.caption
								if(socials){
									html += '<div class="social"></div>';
								}
								html += proofing_html();
								html += '</div>';
							}

							return html;
						},

						openBrick = function(ev){
							//lightbox is off?
							if(parseInt($container.data('lightbox_off'), 10) === 1){
								return;
							}

							//lightbox is off for mobile?
							if( A13F.layout.size <= break_point[0] && parseInt($container.data('lightbox_off_mobile'), 10) === 1 ){
								return;
							}

							var index = $container.find('.object-item').index($(this)),
								$item = $items.eq(index),
								target = $(ev.target);

							//check if we didn't click some link in description
							if(!target.is('a') && target.parents('a').length === 0){
								//no click stealing if video or link
								if(thumbs_video || !$item.hasClass('type-video')){
									$item.click();
									return;
								}
								//no click on link
								else if($item.hasClass('link')){
									return;
								}

								ev.stopPropagation();
								ev.preventDefault();
							}
						},

						commentItem = function(ev){
							var $icon = $(this),
								item = $icon.parents('.object-item').eq(0),
								icons_parent = $icon.parent(),
								index = $container.find('.object-item').index(item),
								original_item = $items.eq(index),
								album_id = G.album_id,
								item_id = original_item.data('id'),
								//read comment value as text so all entities will be converted
								original_comment = original_item.find('div.proofing_comment').text(),
								comment_class = 'fa-commenting',
								save_class = 'fa-floppy-o',

								hide_textarea = function(){
									textarea.css('opacity', 0);
									setTimeout(function(){
										textarea.remove();
										//hide save button
										$icon.removeClass(save_class).addClass(comment_class);
									}, 315 );
								};

							ev.stopPropagation();
							ev.preventDefault();

							//don't send double events
							if($icon.hasClass('loading')){
								return;
							}

							//blur textarea if clicked again - important on mobiles
							if(icons_parent.find('textarea').length){
								icons_parent.find('textarea').blur();
								return;
							}

							//display save button
							$icon.removeClass(comment_class).addClass(save_class);

							//add textarea and focus on it
							var textarea = $('<textarea placeholder="'+G.proofing_comment_placeholder+'"></textarea>').appendTo(icons_parent).focus();

							//add value by JavaScript instead while creating element, to be safe against closing </textarea> tag
							textarea.val(original_comment);

							//check is it video link
							if(original_item.hasClass('subtype-videolink')){
								item_id = 'external';
							}

							textarea
								//save comment on blur
								.one('blur', function(){
								var comment = $.trim(textarea.val());

								//no changes - no ajax
								if(comment === original_comment){
									hide_textarea();
									return;
								}

								//disable textarea and start animation
								textarea.prop('readonly', true);
								$icon.addClass('loading');

								//make ajax request
								$.ajax({
									type: 'post',
									url: G.ajaxurl,
									data: {
										action  : 'apollo13framework_comment_album_item',
										security: G.proofing_nonce,
										album_id: album_id,
										item_id : item_id,
										link    : item_id === 'external' ? original_item.data('src') : '',
										comment : comment
									},
									dataType : 'json'
								})
									.done(function (data) {
										//replace original comment with processed one
										if(typeof data.comment !== 'undefined'){
											comment = data.comment;
										}

										if(comment.length){
											$icon.addClass('filled');
										}
										else{
											$icon.removeClass('filled');
										}

										hide_textarea();

										//save comment in HTML
										original_item.find('div.proofing_comment').html(comment); //html() instead of text() to convert entities that came from server

										//add attribute for filtering
										item.add(original_item).attr('data-proofing_comment', comment.length? 1 : 0);

										//rearrange
										$container.isotope();
										//activate button
										proofing_accept.removeClass('done idle');
										//update numbers
										updateProofingFilter();
									})
									.fail(function (jqXHR) {
										if(typeof jqXHR.status !=='undefined' && jqXHR.status == 403){
											alert('Site version is outdated. Please refresh page to make this function work.')
										}

										//open textarea to allow copy
										textarea.prop('readonly', false);
									})
									.always(function () {
										$icon.removeClass('loading');
									});
							})
								//hide without saving on Esc key
								.on('keydown', function (event) {
									if(event.keyCode === 27){
										hide_textarea();
									}
								})
								//prevent opening lightbox on click on textarea
								.on(click_event, function(ev){
									ev.stopPropagation();
								});
						},

						approveItem = function(ev){
							var $icon = $(this),
								item = $icon.parents('.object-item').eq(0),
								index = $container.find('.object-item').index(item),
								original_item = $items.eq(index),
								album_id = G.album_id,
								item_id = original_item.data('id');

							ev.stopPropagation();
							ev.preventDefault();

							//don't send double events
							if($icon.hasClass('loading')){
								return;
							}

							//check is it video link
							if(original_item.hasClass('subtype-videolink')){
								item_id = 'external';
							}

							$icon.addClass('loading');

							$.ajax({
								type: 'get',
								url: G.ajaxurl,
								data: {
									action  : 'apollo13framework_mark_album_item',
									security: G.proofing_nonce,
									album_id: album_id,
									item_id : item_id,
									link    : item_id === 'external' ? original_item.data('src') : '',
									approve : $icon.hasClass('filled') ? 0 : 1
								},
								dataType : 'json'
							})
								.done(function (data) {
									if(data.approve){
										$icon.addClass('filled').attr('title', G.proofing_uncheck_item);
									}
									else{
										$icon.removeClass('filled').attr('title', G.proofing_mark_item);
									}
									//change original item
									item.add(original_item).attr('data-proofing_checked', data.approve);
									//rearrange
									$container.isotope();
									//activate button
									proofing_accept.removeClass('done idle');
									//update numbers
									updateProofingFilter();
								})
								.fail(function (jqXHR) {
									if(typeof jqXHR.status !=='undefined' && jqXHR.status == 403){
										alert('Site version is outdated. Please refresh page to make this function work.')
									}
								})
								.always(function () {
									$icon.removeClass('loading');
								});

						},

						finishProofing = function(ev){
							ev.stopPropagation();
							ev.preventDefault();

							//don't send double events
							if(proofing_accept.hasClass('loading') || proofing_accept.hasClass('done') ){
								return;
							}

							proofing_accept.addClass('loading');

							//update counter
							proofing_accept.find('span.counter').text($items.filter('[data-proofing_checked=1]').length+'/'+$items.length);

							$.ajax({
								type: 'get',
								url: G.ajaxurl,
								data: {
									action  : 'apollo13framework_album_finished_proofing',
									security: G.proofing_nonce,
									album_id: G.album_id
								},
								dataType : 'json'
							})
								.done(function (data) {
									if(data.done){
										proofing_accept.addClass('done');
										setTimeout(function(){
											proofing_accept.addClass('idle');
										}, 4000);
									}
								})
								.fail(function (jqXHR) {
									if(typeof jqXHR.status !=='undefined' && jqXHR.status == 403){
										alert('Site version is outdated. Please refresh page to make this function work.')
									}
								})
								.always(function () {
									proofing_accept.removeClass('loading');
								});
						},

						startupConfiguration = function(){
							var gutter = parseInt($container.data('margin'),10),
								layoutMode = (typeof Isotope.LayoutMode.modes.packery !== 'undefined')? 'packery' : 'masonry';

							//start isotope
							$container.isotope({
								// main isotope options
								itemSelector: '.archive-item',
								transitionDuration: '0.6s',
								isOriginLeft: !is_rtl,

								layoutMode: layoutMode,
								// options for masonry layout mode
								packery: {
									columnWidth: '.grid-master',
									gutter: gutter
								},
								masonry: {
									columnWidth: '.grid-master',
									gutter: gutter
								}
							}).addClass('layout-'+layoutMode);

							// layout Isotope again when web fonts are loaded
							$body.on('webfontsloaded', function(){
								if($container.data('isotope')){
									$container.isotope('layout');
								}
							});

							// and again when Smush will load images
							$(document).on('lazyloaded', function(){
								if($container.data('isotope')){
									$container.isotope('layout');
								}
							});

							//if jetpack lazy load images module is working layout items on each image load
							$body.on('jetpack-lazy-loaded-image', function(){
								if($container.data('isotope')){
									setTimeout( function(){$container.isotope('layout');}, 100 );
								}
							});


							//click on bricks make click on list element to open lightbox
							$container
								.on( 'click', '.object-item', openBrick)
								.on( click_event, 'i.p-comment', commentItem)
								.on( click_event, 'i.p-check', approveItem)
								.on( click_event, 'span.p-id', function(ev){ ev.stopPropagation(); ev.preventDefault(); }); //don't open lightbox on text selection

							$('#done-with-proofing').on( click_event, finishProofing);
						},

						loadTillViewIsFull = function () {
							//we have any items
							if(number_of_items){
								//we have loaded all items
								if( pointer >= number_of_items ){
									//unbind loading more
									removeLoader();

									return;
								}

								var container_height = parseInt($container.css('height'), 10),
									container_min_height = parseInt($container.css('min-height'), 10),
									top_offset = $container.offset().top;

								//if min-height is same as height then sticky sidebar is affecting our height
								if(container_height === container_min_height){
									container_height = 0;
								}

								//our formula to decide if we have enough items loaded
								if ( !( container_height + top_offset < ( 2 * $window.height() + $window.scrollTop() ) ) ){
									bindLoadMore();
									removeLoader();

									return; //nothing to do here
								}

								addLoader();

								//get new items
								var new_items_html = '',
									saved_pointer = pointer,
									load_till 	 = pointer + limit_per_load;
								//check if we are not beyond number of items
								load_till = load_till > number_of_items ? number_of_items : load_till;

								for(; pointer < load_till; pointer++){
									new_items_html += makeBrick(pointer);
								}

								//start loading items
								loading_space.append(new_items_html)
									//make video look proper
									.fitVids();


								pointer = saved_pointer;

								//will work only when item has thumb
								loading_space.find('.archive-item').each(function(){
									//add social components
									if(socials){
										var s = $(this).find('.social'),
											irt = $items.eq(pointer).find('.dot-irecommendthis');

										//add social icons for sharing
										if(typeof a2a_config !== 'undefined'){
											s.append($items.eq(pointer).find('.a2a_kit'));
										}

										//I recommend this link
										if(irt.length){
											s.append(irt);
										}
									}
									pointer++;
								});


								if(typeof $.fn.mediaelementplayer !== 'undefined'){
									loading_space.find('.wp-video video').mediaelementplayer((typeof mejs === 'undefined' ? {} : mejs.MediaElementDefaults));
								}

								//after items are ready to display send them to their container
								loading_space.imagesLoaded( function() {
									//get elements from loading space
									var elems = loading_space.find('.archive-item')/*.css('opacity',0).addClass('not-revealed')*/.appendTo($container);

									//first run
									if( saved_pointer === 0 ){
										startupConfiguration();
									}
									// add and lay out newly appended elements
									else{
										$container.isotope( 'appended', elems );
									}

									//try to load more items
									loadTillViewIsFull();
								});

								//});
							}
						},

						filterItems = function(ev){
							ev.stopPropagation();
							ev.preventDefault();
							var $this = $(this),
								filter_string = '',
								category,
								group = $this.closest('ul.category-filter');

							//check category filter
							if(category_filter.length){
								if(group.is(category_filter)){
									category_filter.find('li').removeClass('selected');
									category = $this.addClass('selected').data('filter');
								}
								else{
									category = category_filter.find('li.selected').data('filter');
								}

								if(category !== '__all'){ //__all so users will not overwrite this
									filter_string = '[data-category-'+category+']';
								}
							}

							//check proofing filter
							if(proofing_filter.length){
								if(group.is(proofing_filter)) {
									proofing_filter.find('li').removeClass('selected');
									category = $this.addClass('selected').data('filter');
								}
								else{
									category = proofing_filter.find('li.selected').data('filter');
								}

								if(category !== '__all'){
									//commented
									if(category === 2){
										filter_string += '[data-proofing_comment=1]';
									}
									//selected/not selected
									else{
										filter_string += '[data-proofing_checked='+category+']';
									}
								}
							}

							//check for empty selections
							if(filter_string === ''){
								filter_string = '*';
							}

							//filter
							$container.isotope({ filter: filter_string });

							//trigger scroll to load more elements if there is place
							$window.trigger('filter.lazyload'+unique_id);
							$window.trigger('a13_gallery_filtered',[filter_string, $items_list]);
						},

						updateProofingFilter =  function(){
							if(proofing_filter.length){
								var accepted = $items.filter('[data-proofing_checked=1]').length,
									not_accepted = $items.length - accepted,
									commented = $items.filter('[data-proofing_comment=1]').length,
									filters = proofing_filter.find('li');

								filters.filter('[data-filter="1"]').find('.count').text('('+accepted+')');
								filters.filter('[data-filter="0"]').find('.count').text('('+not_accepted+')');
								filters.filter('[data-filter="2"]').find('.count').text('('+commented+')');
							}

						},

						//resize function
						layout = function(event, size){
							/***** scrolled text content *******/
							//enough space
							if (sticky_sidebar.length && (size > break_point[2])) {
								if(typeof sticky_sidebar.data('sticky_kit') === 'undefined'){
									var offset_top = 0;

									//we have admin bar
									if(is_adminbar){
										offset_top = admin_bar.height();
									}

									//we have top border
									if( $body.hasClass('site-layout-bordered') && !$body.hasClass('no-border-top') ){
										offset_top += parseInt($( 'div.theme-borders').find( 'div.top-border').height(), 10);
									}

									//to be sure that sticky kit didn't left parent on relative
									sticky_sidebar.parent().css('position','');

									sticky_sidebar.stick_in_parent({
										offset_top : offset_top
									});
								}

								//safety mechanism when content is longer then images
								$container.css('min-height', sticky_sidebar.innerHeight());
							}
							//not enough space
							else{
								if (sticky_sidebar.length){
									sticky_sidebar.trigger("sticky_kit:detach");
									//clean after safety
									$container.css('min-height', '');
								}
							}
						};

					//register resize
					A13F.layout.add(layout);

					//initial layout
					layout({}, A13F.layout.size);


					loadTillViewIsFull();

					$container.data('initialized', 1);


					//check if it isn't "share image" link
					var share_it = getParameterByName('gallery_item'),
						links, i;

					if(share_it.length){
						links = $items.children('a');
						for(i = 0; i < links.length; i++){
							if(links.eq(i).attr('href').indexOf(share_it) > -1){
								links.eq(i).click();
								break;
							}
						}
					}

					//filters bind
					if(category_filter.length){
						category_filter.find('li').on( click_event, filterItems);
					}
					if(proofing_filter.length){
						proofing_filter.find('li').on( click_event, filterItems);
						updateProofingFilter();
					}
				}
			},

			singleWork : function(){
				if($body.hasClass('single-work')){
					var sticky_sidebar = mid.find('div.meta-data'),
						parent = sticky_sidebar.length ? sticky_sidebar.parent() : '',
						layout = function(event, size){
						/***** scrolled text content *******/
						//enough space
						if (sticky_sidebar.length && (size > break_point[2])) {
							var sticky_height = sticky_sidebar.innerHeight();

							//safety mechanism when content is longer then images
							//why +1 ?
							//script for sticky sidebar dies when it discovers that sidebar has same height as parent
							//that is why we make it bigger cause otherwise we won't be able to refire it if we are loading
							//something with ajax to content.
							//This way we don't have to refire it, as it will reposition itself on scroll
							parent.css('min-height', sticky_height+1);

							if(typeof sticky_sidebar.data('sticky_kit') === 'undefined'){
								var offset_top = 30; //some space

								//we have admin bar
								if(is_adminbar){
									offset_top += admin_bar.height();
								}

								//we have top border
								if(size > break_point[3] && $body.hasClass('site-layout-bordered') && !$body.hasClass('no-border-top') ){
									offset_top += parseInt($( 'div.theme-borders').find( 'div.top-border').height(), 10);
								}

								sticky_sidebar.stick_in_parent({
									offset_top : offset_top
								});
							}
						}
						//not enough space
						else{
							if (sticky_sidebar.length){
								sticky_sidebar.trigger("sticky_kit:detach");
								//clean after safety
								parent.css('min-height', '');
							}
						}
					};

					A13F.elementsActions.singleWorkMasonry();

					//register resize
					A13F.layout.add(layout);

					//initial layout
					layout({}, A13F.layout.size);
				}
			},

			singleAlbumMasonry : function(){
				A13F.elementsActions.singleCptMasonry({
					container        : $('.single-album-gallery').find('.a13-bricks-items'),
					thumbs_video     : parseInt(G.album_bricks_thumb_video, 10),
					filter           : 'ul.single-album-filter',
					proofing_filter  : 'ul.single-album-proofing-filter',
					sticky_sidebar   : true,
					sticky_sidebar_el: mid.find('div.album-content').children() //div.inside
				});
			},

			singleWorkMasonry : function(){
				A13F.elementsActions.singleCptMasonry({
					container        : '#only-work-items-here',
					thumbs_video     : parseInt(G.work_bricks_thumb_video, 10),
					sticky_sidebar   : false,
					sticky_sidebar_el: ''
				});
			},

			makeBricks : function($scope){
				$scope = typeof $scope === 'undefined'? $body : $scope;
				var $container = $scope.find('.a13-bricks-items');

				for(var i = 0; i < $container.length; i++){
					var _container = $container.eq(i);
					//skip if it was initialized already
					if(_container.data('initialized')){
						continue;
					}

					A13F.elementsActions.singleCptMasonry({
						container        : _container,
						thumbs_video     : parseInt(G.album_bricks_thumb_video, 10),
						filter           : _container.parent().prevAll('ul.single-album-filter'),
						id 			     : i+1
					});
				}
			},

			makeSlider : function($scope) {
				$scope = typeof $scope === 'undefined'? $body : $scope;
				var $container = $scope.find('.a13-slider-stuff');
				for(var i = 0; i < $container.length; i++){
					A13F.elementsActions.useSlider($container.eq(i));
				}
			},

			makeScroller : function($scope) {
				$scope = typeof $scope === 'undefined'? $body : $scope;
				var $container = $scope.find('.a13-scroller-stuff');
				for(var i = 0; i < $container.length; i++){
					A13F.elementsActions.useScroller($container.eq(i));
				}
			},

			useSlider : function(container) {
				var $container = (container instanceof jQuery) ? container : $(container),
					$gallery   = $container.find('.gallery-media-collection');

				if ($container.length && $gallery.length) {
					//skip if it was initialized already
					if($container.find('.a13-slider').length){
						return;
					}

					var $gallery_items 	= $gallery.children(),
						items = [],
						share_it = getParameterByName('gallery_item'),
						links,
						start_slide = 0,
						i,item, type, description, link,
						add_to_cart,
						html5_video, video_type;

					//collect data from items
					for(i = 0; i < $gallery_items.length; i++){
						item 		= $gallery_items.eq(i);
						type 		= item.hasClass('type-video')? 'video' : 'image';
						description = item.find('div.item-desc').find('.description');
						//if lightbox is disabled
						description = description.length ? description.html() : item.find('div.item-desc').html();
						add_to_cart = item.find('p.add_to_cart_inline');
						link 		= item.children('.item__link');
						video_type  = item.data('video_type');
						html5_video = type==='video' && video_type === 'html5';

						add_to_cart = add_to_cart.length ? $('<div />').append(add_to_cart.clone()).html() : '';

						items.push({
							type:       type,
							image:      item.data('main-image'),
							thumb:		item.data('thumb'),
							title:      link.text(),
							alt_attr:   item.data('alt_attr'),
							desc:       description+add_to_cart,
							autoplay:   item.data('autoplay'),
							video_type: video_type,
							video_url:  html5_video? item.data('html') : item.data('video_player'),//id reference for internal video
							bg_color:   item.data('bg_color'),
							url:        type==='image' && item.hasClass('link')? link.attr('href') : false,
							url_target: item.data('link_target')
						});
					}

					//check if it isn't "share image" link
					if(share_it.length){
						links = $gallery_items.children('.item__link');
						for(i = 0; i < links.length; i++){
							if(links.eq(i).attr('href').indexOf(share_it) > -1){
								start_slide = i;
								break;
							}
						}
					}

					//call script
					$container.a13slider({
						parent                  :   $container, // where will be embeded slider
						extra_class				:   $container.data('extra_class'),
						main_slider				:	$container.data('main_slider') === 'on' ? 1 : 0,
						window_high				:	$container.data('window_high') === 'on',
						ratio					:	$container.data('ratio'),
						autoplay				:	$container.data('autoplay') === 'on' ? 1 : 0,
						slide_interval          :   parseInt($container.data('slide_interval'), 10),
						transition              :   parseInt($container.data('transition'), 10),
						transition_speed		:	parseInt($container.data('transition_time'), 10),
						ken_burns_scale			:   parseInt($container.data('ken_burns_scale'), 10),
						fit_variant				:	parseInt($container.data('fit_variant'), 10),
						pattern					:	parseInt($container.data('pattern'), 10),
						gradient				:	$container.data('gradient') === 'on' ? 1 : 0,
						texts					:	$container.data('texts') === 'on' ? 1 : 0,
						socials					:   $container.data('socials') === 'on' ? 1 : 0,
						title_color				:	$container.data('title_color'),
						thumb_links				:	$container.data('thumbs') === 'on' ? 1 : 0,
						show_thumbs_on_start	:	$container.data('thumbs_on_load') === 'on' ? 1 : 0,
						start_slide				: 	start_slide,
						original_items			: 	$gallery_items,
						slides                  :   items // Slideshow Items
					});
				}
			},

			useScroller : function(container) {
				var $container = (container instanceof jQuery) ? container : $(container),
					$scroller  = $container.children('.a13-scroller'),
					$gallery   = $container.children('.gallery-media-collection');

				if ($scroller.length && $gallery.length) {
					//skip if it was initialized already
					if($scroller.data('flickity')){
						return;
					}

					var $gallery_items   = $gallery.children(),
						items            = [],
						scroller_options = JSON.parse($scroller.attr('data-scroller')),
						show_desc        = scroller_options.a13ShowDesc,
						show_socials     = scroller_options.a13Socials,
						share_it         = getParameterByName('gallery_item'),
						loaded_elements  = 0,
						start_slide      = 0,
						wheel_ticking    = false,
						last_wheel_down	 = 0,
						last_wheel_tick	 = 0,
						is_main_slider	 = scroller_options.a13MainSlider,
						scroll_below	 = $container.find('.scroll-below'),
						after_scroller	 = [],
						i, item, type, description, link,
						add_to_cart,

						scrollerHeight = function () {
							if (scroller_options.a13WindowHigh) {
								var total = A13F.windowVisibleAvailableHeight(is_main_slider ? 2 : 0);

								//resize slider to fit
								if (total > 150) {
									$container.css({
										margin : 0,
										paddingTop: 0,
										height : total
									});
								}
								//use normal size
								else {
									$container.css({
										margin : '',
										paddingTop: _scrollerProportion(),
										height : ''
									});
								}
							}
							else{
								$container.css({
									paddingTop: _scrollerProportion()
								});
							}
						},
						_scrollerProportion = function(){
							var ratio = scroller_options.a13Ratio.split('/');
							if(ratio.length === 2){
								ratio[0] = parseInt(ratio[0],10);
								ratio[1] = parseInt(ratio[1],10);
								if(A13F.isInteger(ratio[0]) && A13F.isInteger(ratio[1]) && ratio[0] > 0 && ratio[1] > 0){
									return ratio[1]/ratio[0]*100+'%';
								}
							}

							return '';
						},
						loadCallback = function( event, element ) {
							var cells = $scroller.find('div.img'),
								next = start_slide+1;
							//if we out of range
							next = next > $gallery.length ? 0 : next;

							//first two cells must be loaded to start autoplay
							if(cells.eq(start_slide).is(element) || cells.eq(next).is(element)){
								loaded_elements++;
							}
							if(loaded_elements === 2){
								$scroller.off( 'bgLazyLoad.flickity', loadCallback).flickity('playPlayer');
							}
						},
						setNextElement = function(){
							//check for immediate next element
							after_scroller = $container.next();

							if(after_scroller.length === 0){
								//look in parents for next element
								var parents = $container.parents(), parent;
								for(var i = 0; i < parents.length; i++){
									parent = parents.eq(i);
									if(parent.is(mid)){
										//if footer is one of next elements
										if(mid.nextAll().is(footer)){
											after_scroller = footer;
										}
										break;
									}
									else{
										after_scroller = parent.next();
										if(after_scroller.length){
											break;
										}
									}
								}
							}
						},
						requestWheelTick = function(event, delta){
							var el_h = $scroller.height(),
								el_t = $scroller.offset().top,
								w_h = $window.height(),
								w_t = $window.scrollTop();

							//if whole element is in visible area
							if( (el_t + el_h <= w_h + w_t) && el_t >= w_t ){
								var now = new Date;

								event.preventDefault();

								if((now - last_wheel_tick > 200)){
									if ( !wheel_ticking ) {
										requestAnimationFrame(function(){
												wheel_ticking = false;
												last_wheel_tick = now;
												if(delta < 0){
													$scroller.flickity( 'next' );
												}
												else{
													$scroller.flickity( 'previous' );
												}
											}
										);
									}
									wheel_ticking = true;
								}

								//scrolling down && there is next element to scroll
								if(delta<0 && after_scroller.length){
									//last scroll down was longer then 5 seconds on this scroller
									if(now - last_wheel_down > 5000){
										scroll_below.addClass('active');
										setTimeout(function(){
											scroll_below.removeClass('active');
										}, 500);
									}
									last_wheel_down = now;
								}
							}
						},
						layout = function(event, size){
							//effect depending on resolution
							if(typeof scroller_options.a13Effect !== "undefined"){
								var effect = scroller_options.a13Effect;
								if(effect !== 'off'){
									if (size > break_point[2]) {
										$scroller.addClass('effect-'+effect);
									}
									else{
										$scroller.removeClass('effect-'+effect);
									}
								}
							}

							if(size <= break_point[0]){
								$scroller
									.removeClass('cells_'+scroller_options.a13CellWidth)
									.addClass('cells_'+scroller_options.a13CellWidthMobile);
							}
							else{
								$scroller
									.removeClass('cells_'+scroller_options.a13CellWidthMobile)
									.addClass('cells_'+scroller_options.a13CellWidth);
							}

							scrollerHeight();

							//resize cause we switched off default resize for flickity
							$scroller.flickity('resize');

							setNextElement();
						};


					//collect data from items
					for(i = 0; i < $gallery_items.length; i++){
						item 		= $gallery_items.eq(i);
						type 		= item.hasClass('type-video')? 'video' : 'image';

						//skip if video
						if(type === 'video'){
							continue;
						}

						description = item.find('.item-desc').find('.description');
						//if lightbox is disabled
						description = description.length ? description.html() : item.find('.item-desc').html();
						add_to_cart = item.find('.add_to_cart_inline');
						link 		= item.children('.item__link');

						//check if it isn't "share image" link
						if(share_it.length && link.attr('href').indexOf(share_it) > -1){
							start_slide = i;
							scroller_options['initialIndex'] = i;
							share_it = '';//no more looking for it
						}

						add_to_cart = add_to_cart.length ? $('<div />').append(add_to_cart.clone()).html() : '';

						items.push({
							image:      item.data('main-image'),
							title:      link.text(),
							//alt_attr:   item.data('alt_attr'),
							desc:       description+add_to_cart,
							bg_color:   item.data('bg_color'),
							url:        type==='image' && item.hasClass('link')? link.attr('href') : false,
							url_target: type==='image' ? parseInt( item.data('link_target'), 10 ) === 1 : false
						});
					}

					//prepare html for scroller
					var slides_num  = items.length,
						slides_iterator = 0,
						items_html = '';

					while(slides_iterator <= slides_num-1){
						items_html += '<div class="carousel-cell">';
						items_html += '<div class="img" data-flickity-bg-lazyload="'+items[slides_iterator]['image']+'"></div>';

						if(show_desc){
							items_html += '<div class="texts_group">';
							if(items[slides_iterator]['title'].length){
								items_html += '<strong class="name">';
								items_html += items[slides_iterator]['title'];
								items_html += '</strong>';
							}
							items_html += items[slides_iterator]['desc'].length ? ('<div class="excerpt">'+items[slides_iterator]['desc']+'</div>') : '';
							items_html += '</div>';
						}
						if(items[slides_iterator]['url'].length){
							items_html += '<a href="'+items[slides_iterator]['url']+'"'+(items[slides_iterator]['url_target']? ' target="_blank"' : '')+'></a>';
						}


						items_html += show_socials? '<div class="social"></div>' : '';

						items_html += '</div>';

						slides_iterator++;
					}

					//RTL site?
					if(is_rtl){
						scroller_options['rightToLeft'] = true;
					}

					//fire flickity
					$scroller
						.append(items_html)
						.flickity( scroller_options )
						.on( 'staticClick.flickity', function( event, pointer, cellElement, cellIndex ) {
							var data = $scroller.data('flickity'),
								is_current_cell = cellIndex === data.selectedIndex;

							if(is_current_cell){
								if( items[cellIndex].url === false ){
									$(data.selectedElement).toggleClass('enlarge');
									$scroller.flickity( 'reposition' );
								}
							}
							else{
								if ( typeof cellIndex == 'number' ) {
									$scroller.flickity( 'selectCell', cellIndex );
								}
							}

						})
						.on('mousewheel', requestWheelTick);

					scroll_below.on('click', function () {
						if (after_scroller.length) {
							$('html,body').animate({
								scrollTop: Math.round(after_scroller.offset().top)
							}, 500);
						}
					});

					//social elements
					if(show_socials){
						$scroller.find('.carousel-cell').each(function(index){
							var s = $(this).find('.social'),
								irt = $gallery_items.eq(index).find('.dot-irecommendthis');

							//add social icons for sharing
							if(typeof a2a_config !== 'undefined'){
								s.append($gallery_items.eq(index).find('.a2a_kit'));
							}

							//I recommend this link
							if(irt.length){
								s.append(irt);
							}
						});
					}

					//wait for images to be loaded if autoplay is enabled
					if(typeof scroller_options.autoPlay !== 'undefined' && scroller_options.autoPlay > 0 ){
						$scroller.flickity('stopPlayer');
						//count loaded images and play later
						$scroller.on( 'bgLazyLoad.flickity', loadCallback);
					}

					//using parallax scroller
					if(typeof scroller_options.a13Parallax !== "undefined" && scroller_options.a13Parallax){
						var $imgs = $scroller.find('div.img'),
							flickity_data = $scroller.data('flickity'),
							docStyle = html.style,
							transformProp = typeof docStyle.transform == 'string' ? 'transform' : 'WebkitTransform',
							wrap_around = typeof scroller_options.wrapAround !== "undefined" && scroller_options.wrapAround;

						$scroller
							.on( 'scroll.flickity', function() {
								//lot of exceptions if we wrap parallax
								if(wrap_around){
									var sw = flickity_data.slideableWidth,
										_x = fizzyUIUtils.modulo( flickity_data.x, sw);
									_x = _x - sw;

									flickity_data.slides.forEach( function( slide, i ) {
										var img = $imgs[i],
											shift = slide.cells[0].shift,
											x;

										//depending on shift, calculate x in different way
										if(shift===0){
											x = slide.target + _x;
										}
										else if(shift===1){
											x = sw + _x + slide.target ;
										}
										else{//shift === -1
											x = -(sw - slide.target) + _x;
										}

										if(is_rtl){
											img.style[ transformProp ] = 'translateX( ' + x * +1/3  + 'px)';
										}
										else{
											img.style[ transformProp ] = 'translateX( ' + x * -1/3  + 'px)';
										}
									});
								}
								//simple, if parallax is not wrapped
								else{
									flickity_data.slides.forEach( function( slide, i ) {
										var img = $imgs[i],
											x = ( slide.target + flickity_data.x ) * -1/3;

										if(is_rtl){
											img.style[ transformProp ] = 'translateX( ' + -x  + 'px)';
										}
										else{
											img.style[ transformProp ] = 'translateX( ' + x  + 'px)';
										}
									});
								}
							});

						//make sure images are on proper places when parallax
						flickity_data.resize();
					}

					//register resize
					A13F.layout.add(layout);

					//initial layout
					layout({}, A13F.layout.size);

					//also when logo is loaded
					$body.on('a13LogoLoaded', function(){ layout({}, A13F.layout.size);} );
				}
			},

			widgetSlider: function(){
				var sidebars = footer.add('#side-menu, #basket-menu, #secondary'),
					selectors = sidebars.find('div.widget_rss');
				if(selectors.length){
					selectors.each(function(){
						var selector = $(this),
							html = '<div class="widget-slider-ctrls"><span class="prev-slide a13icon-chevron-thin-left"></span><span class="next-slide a13icon-chevron-thin-right"></span>',
							slides = selector.find('li').eq(0).show().end(),
							left,right,

							move = function(ev){
								ev.stopPropagation();
								ev.preventDefault();

								var direction = ev.data.dir,
									current = slides.filter(':visible'),
									toShow;

								if(direction === 'next'){
									toShow = current.next();
									if(!toShow.length){
										toShow = slides.eq(0);
									}
								}
								else{
									toShow = current.prev();
									if(!toShow.length){
										toShow = slides.eq(slides.length-1);
									}
								}

								//animate
								current.fadeOut(200, function(){ toShow.fadeIn(200); })
							};

						if(selector.hasClass('slider-ctrls')){
							//there are controls already
							return;
						}

						if(slides.length > 1){ //more then one slide
							selector.addClass('slider-ctrls').append(html);
							left = selector.find('span.prev-slide');
							right = selector.find('span.next-slide');

							//bind clicks
							left.on(click_event,null,{dir: 'prev'}, move);
							right.on(click_event,null,{dir: 'next'}, move);
						}
					});
				}
			},

			lightbox : function(){
				//if no lightbox script do nothing
				//Using lightGallery ?
				if(typeof $.fn.lightGallery !== 'undefined'){

					var lightbox_args = {
							hash              : !!parseInt(G.lg_lightbox_share, 10),
							share             : !!parseInt(G.lg_lightbox_share, 10),
							controls          : !!parseInt(G.lg_lightbox_controls, 10),
							download          : !!parseInt(G.lg_lightbox_download, 10),
							counter           : !!parseInt(G.lg_lightbox_counter, 10),
							thumbnail         : !!parseInt(G.lg_lightbox_thumbnail, 10),
							showThumbByDefault: !!parseInt(G.lg_lightbox_show_thumbs, 10),
							autoplay          : !!parseInt(G.lg_lightbox_autoplay_open, 10),
							autoplayControls  : !!parseInt(G.lg_lightbox_autoplay, 10),
							progressBar       : !!parseInt(G.lg_lightbox_progressbar, 10),
							fullScreen        : !!parseInt(G.lg_lightbox_full_screen, 10),
							zoom              : !!parseInt(G.lg_lightbox_zoom, 10),
							mode              : G.lg_lightbox_mode,
							pause             : parseInt(G.lg_lightbox_autoplay_pause, 10),
							speed             : parseInt(G.lg_lightbox_speed, 10),
							preload           : parseInt(G.lg_lightbox_preload, 10),
							hideBarsDelay     : parseInt(G.lg_lightbox_hide_delay, 10)
						},
						$gallery      = $(".gallery-media-collection"),
						vc_media_grid = $('div.vc_media_grid, div.vc_masonry_media_grid'),
						wp_gallery    = $('div.gallery');

					//bricks albums/works
					if( $gallery.length ){
						var $gallery_items 	= $gallery.children(),
							//standard params
							params = $.extend(
								{
									selector    : $gallery_items.not('.link'),
									exThumbImage: 'data-thumb'
								},
								lightbox_args),
							filter = function(event, filter_string, $gallery){
								var new_params;

								//if all elements are visible
								if(filter_string === '*'){
									new_params = params;
								}
								else{
									new_params = $.extend({}, params, {selector: $gallery_items.not('.link').filter(filter_string)})
								}

								//clean current binding of elements to lightbox
								$gallery.data('lightGallery').destroy(true);
								//rebind only filtered elements
								$gallery.lightGallery(new_params);
							};

						//if gallery is bricks gallery & have vimeo video, load Vimeo Api for lightbox
						if( $gallery.parent().is('div.bricks-frame') && $gallery_items.filter('[data-video_type="vimeo"]').length ){
							//load VIMEO API
							(function(){
								var tag = document.createElement('script');
								tag.src = "https://f.vimeocdn.com/js/froogaloop2.min.js";
								var firstScriptTag = document.getElementsByTagName('script')[0];
								firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
							})();
						}

						//rewrite HTML to match lightbox syntax
						$gallery_items.each(function(){
							var $el = $(this),
								$link = $el.children('a.item__link'),
								$desc = $el.find('div.item-desc'),
								$video = $el.find('div.album-video'),
								title;

							if($desc.length){
								title = $link.text();
								//mark where lightbox should search for description
								$el.attr('data-sub-html', '#'+$desc.attr('id'));
								//wrap real description so we can distinguish it
								$desc.wrapInner('<div class="description"></div>');
								//add title
								$desc.prepend('<h4>'+title+'</h4>');
								//wrap everything in special class, so it will look nice in lightbox
								$desc.wrapInner('<div class="customHtml"></div>');

								//share texts
								$el.attr('data-pinterest-text', title);
								$el.attr('data-tweet-text', title);
							}

							//can't have data-html and data-src in one item
							if($video.length){
								$el.attr('data-html', '#'+$video.attr('id'));
							}
							else{
								$el.attr('data-src', $link.attr('href'));
							}
						});

						$gallery.lightGallery(params);

						$window.on('a13_gallery_filtered', filter);
					}

					//lets try media grid from VC
					if( vc_media_grid.length ){
						//when elements are loaded we bind our lightbox
						$window.on('grid:items:added', function(event, element){
							var this_media_grid = $(element),
								grid_items 	= this_media_grid.find('a.a13-lightbox-added');

							//we check if this was fired for one of our media grids
							if(vc_media_grid.is(this_media_grid) && grid_items.length){
								this_media_grid.lightGallery($.extend({}, lightbox_args,
										{
											selector                : grid_items,
											exThumbImage            : 'href',
											subHtmlSelectorRelative : true,
											hash 					: false
										})
								);

								//block VC actions that force to open image native
								grid_items.on('click', function(){
									return false;
								});
							}
						});
					}

					//lets try normal WordPress gallery
					if( wp_gallery.length ){
						var gallery_items 	= wp_gallery.find('.gallery-icon').children('a');
						wp_gallery.lightGallery($.extend(
							{
								selector                : gallery_items,
								exThumbImage            : 'href',
								getCaptionFromTitleOrAlt : false
							},
							lightbox_args)
						);
					}

					//single post/page/work/album but not page made with Elementor
					if(G.lightbox_single_post && ( $body.hasClass('single-post') || $body.hasClass('single-work') || ( $body.hasClass('page') && !$body.hasClass('elementor-page') ) || $body.hasClass('single-album') )){
						var content = $body.find('.real-content'),
							single_images = content.find('a').children('img').parent();
						content.lightGallery($.extend(
								{
									selector                : single_images,
									exThumbImage            : 'href',
									getCaptionFromTitleOrAlt : false
								},
								lightbox_args)
						);
					}

					$window.on('post-load', function(){
						var post_lightbox = $('#a13-post-lightbox' );
						if(G.lightbox_single_post && post_lightbox.length && post_lightbox.is(':visible') ){
							var content = post_lightbox.find('.real-content'),
								single_images = content.find('a').children('img').parent();
							content.lightGallery($.extend(
									{
										selector                : single_images,
										exThumbImage            : 'href',
										getCaptionFromTitleOrAlt : false
									},
									lightbox_args)
							);
						}
					});
				}

				//if no lightbox script do nothing

			},

			demoFlyOut : function(){
				var flyout = $('#a13-flyout-box');
				if(flyout.length){
					flyout.find('span.drag-out').on(click_event, function(){
						flyout.toggleClass('open');
					});
				}

			}
		}
	};



	//start Theme
	A13F = window.A13FRAMEWORK;
	$(document).ready(A13F.onReady);

})(jQuery, window, document);
