/*global wp, A13_CUSTOMIZER_DEPENDENCIES, A13FECustomizerControls */
( function( $ ){
	"use strict";

	var G = A13FECustomizerControls,
		api = wp.customize,
		apollo13framework_font_icons_selector = function(){
			var icons_box = $('#a13-fa-icons');

			if(icons_box.length){
				icons_box.prependTo('#customize-controls');
			}
		},

		compare_dependency = function(dependency){
			var switcher = dependency[0],
				operator = dependency[1],
				value    = dependency[2],
				control = api.control(G.options_name+'['+switcher+']');

			//not existing settings
			if(typeof control === 'undefined'){
				return false;
			}

			var switch_value = control.setting.get();

			//check operators
			if(operator === '='){
				return value === switch_value;
			}
			else if(operator === '!='){
				return value !== switch_value;
			}

			//for all other operators
			return false;
		};

	//make JSON of fonts lists
	if(typeof G.google_fonts === 'string' && G.google_fonts.length){
		G.google_fonts = JSON.parse(G.google_fonts);
	}
	if(typeof G.standard_fonts === 'string' && G.standard_fonts.length){
		G.standard_fonts = JSON.parse(G.standard_fonts);
	}
	if(typeof G.human_font_variants === 'string' && G.human_font_variants.length){
		G.human_font_variants = JSON.parse(G.human_font_variants);
	}

	//---------
	//activate & deactivate controls on changes
	api.bind( 'change', function ( setting ) {
		if(typeof A13_CUSTOMIZER_DEPENDENCIES !== 'undefined'){
			var dependencies = A13_CUSTOMIZER_DEPENDENCIES.dependencies,
				switches = A13_CUSTOMIZER_DEPENDENCIES.switches,
				switch_id = setting.id,
				requirements, matches, regexp,
				visible, i, j, size;

			regexp = new RegExp(G.options_name+'\\[([a-z0-9_]+)\\]','g');
			matches = regexp.exec(switch_id);

			//if we switch our setting
			if(matches !== null && matches.length === 2){
				switch_id = matches[1];

				//if true we need to check controls that depend on changed switch
				if(typeof switches[switch_id] !== 'undefined'){
					//for each control that depends on this switch...
					for(i = 0, size = switches[switch_id].length; i < size; i++){
						visible = true; //reset

						//... check values of all switches it depends on
						requirements = dependencies[ switches[switch_id][i] ];

						//we have more then one required condition
						if(Array.isArray(requirements[0])){
							for( j = 0; j < requirements.length; j++ ){
								if( !compare_dependency(requirements[j]) ){
									//some dependency were not met
									visible = false;
									break;
								}
							}
						}
						//we have only one required condition
						else {
							if(!compare_dependency(requirements)){
								//dependency were not met
								visible = false;
							}
						}

						//toggle control
						var control_id = G.options_name+'['+switches[switch_id][i]+']';
						if(visible){
							api.control(control_id).activate();
						}
						else{
							api.control(control_id).deactivate();
						}
					}
				}
			}
		}
	});

	//---------
	//inform preview when we enter preloader section
	api.section( 'subsection_page_preloader', function( section ) {
		section.expanded.bind( function( isExpanding ) {

			// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
			api.previewer.send( 'section-preloader', { expanded: isExpanding });
		} );
	} );

	//---------
	//inform preview when we enter cookie message section
	api.section( 'subsection_top_message', function( section ) {
		section.expanded.bind( function( isExpanding ) {

			// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
			api.previewer.send( 'section-cookie', { expanded: isExpanding });
		} );
	} );

	//---------
	//inform preview when we enter hidden sidebar section
	api.section( 'subsection_hidden_sidebar', function( section ) {
		section.expanded.bind( function( isExpanding ) {

			// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
			api.previewer.send( 'section-hidden_sidebar', { expanded: isExpanding });
		} );
	} );

	//---------
	//inform preview when we enter footer section
	api.section( 'subsection_footer', function( section ) {
		section.expanded.bind( function( isExpanding ) {

			// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
			api.previewer.send( 'section-footer', { expanded: isExpanding });
		} );
	} );

	//---------
	//do stuff when controls are loaded
	api.bind( 'ready', function() {
		//do stuff when preview is loaded
		api.previewer.bind( 'a13-preview-ready', function() {
			//if preloader section is active
			api.previewer.send( 'section-preloader', { expanded: api.section( 'subsection_page_preloader').expanded() });
			//if cookie message section is active
			if( ! _.isUndefined(api.section( 'subsection_top_message')) ){
				api.previewer.send( 'section-cookie', { expanded: api.section( 'subsection_top_message').expanded() });
			}
		} );

		// Hide redundant label for visual users. for custom CSS
		var css = api.control(G.options_name+'[custom_css]');
		if(typeof css !== 'undefined'){
			css.container.find( '.customize-control-title' ).first().addClass( 'screen-reader-text' );
		}

		//fire icons selector control
		$(document.body).trigger('a13_set_icons_control');
	});

	//---------
	//add new controls JavaScript API
	api.A13ImageControl = api.ImageControl.extend({

		/**
		 * Callback handler for when an attachment is selected in the media modal.
		 * Gets the selected image information, and sets it within the control.
		 */
		select: function() {
			// Get the attachment from the modal frame.
			var attachment = this.frame.state().get( 'selection' ).first().toJSON();

			this.params.attachment = attachment;

			var image_params = {
				id : attachment.id,
				url : attachment.url,
				height : attachment.height,
				width : attachment.width
			};

			// Set the Customizer setting; the callback takes care of rendering.
			this.setting( image_params );
		}
	});

	api.controlConstructor['a13-image'] = api.A13ImageControl;

	api.ButtonSetControl = api.Control.extend({
		ready: function() {
			var control = this,
				container = this.container.get(0),
				inputs = container.querySelectorAll('input[type="checkbox"]'),
				selected,
				check_changed = function() {
					//check what is checked
					selected = [];
					for (var i = 0; i < inputs.length; i++) {
						if (inputs[i].checked) {
							selected.push(inputs[i].value);
						}
					}

					//update setting
					control.setting.set( selected );
				};

			//bind inputs to change event
			for(var i=0 ; i < inputs.length; i++){
				inputs[i].addEventListener('change', check_changed, false);
			}

			//control.params - available params
			//control.setting() - default value
		}
	});

	api.controlConstructor['button-set'] = api.ButtonSetControl;

	api.SliderControl = api.Control.extend({
		ready: function() {
			var control = this,
				container = this.container,
				slider = container.find('.slider-place'),
				input = container.find('.slider-dump'),
				min = slider.data('min'),
				max = slider.data('max'),
				step = slider.data('step'),
				slide_event = function( event, ui ) {
					input.val( ui.value );

					//update setting
					control.setting.set( ui.value );
				},
				input_event = function(){
					var value = parseFloat(input.val());

					if( !isNaN(value) && (value + '').length){ //don't work on empty && compare as string
						slider.slider( "option", "value", value );
					}

					//update setting
					control.setting.set( value );
				};

				//check settings
				min = (min === '')? 10 : min; //0 is allowed now
				max = (max === '')? 30 : max; //0 is allowed now

			slider.slider({
				range: "min",
				animate: true,
				min: min,
				max: max,
				step: step === '' ? 1 : step,
				slide: slide_event,
				value: input.val()
			});

			//set values of sliders
			input.bind('input', input_event);
		}
	});

	api.controlConstructor['slider'] = api.SliderControl;

	api.FontControl = api.Control.extend({
		ready: function() {
			var control = this,
				container = this.container,
				google_fonts = G.google_fonts,

				collectSubsets = function(){
					var $subsets = container.find('input[name="font-subset"]').filter(':checked'),
						subsets = [];

					$subsets.each(function(index){
						subsets.push($subsets.eq(index).val());
					});

					return subsets;
				},

				collectVariants = function(){
					var $variants = container.find('input[name="font-variant"]').filter(':checked'),
						variants = [];

					$variants.each(function(index){
						variants.push($variants.eq(index).val());
					});

					return variants;
				},

				createHeadLink = function(font){
					var setting = control.params.current_font,
						subsets = [],
						apiUrl = [],
						url;

					if(typeof setting.subsets !== 'undefined'){
						subsets = setting.subsets;
					}

					apiUrl.push('https://fonts.googleapis.com/css?family=');
					apiUrl.push(font.replace(/ /g, '+')); //font name -> font+name
					apiUrl.push(':');//after font name
					apiUrl.push('400,700,400i,700i'); //weights
					apiUrl.push('&amp;subset='); //subsets
					$.each(subsets, function(index, val){
						//add comma if more subsets
						if(index > 0){
							apiUrl.push(',');
						}
						apiUrl.push(val);
					});

					url = apiUrl.join('');
					// url: https://fonts.googleapis.com/css?family=Roboto:400,700,400i,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext

					//request CSS for font and embed it in customizer
					$('head').append('<link href="'+url+'" rel="stylesheet">');
				};

			//on choosing font family
			container.on('change','select', function(){
				var select = $(this),
					selected = select.val(),

					//we need fresh object so api will know that something changed
					//otherwise we will operate on original object
					current = $.extend({}, control.setting());

				//google font - make a request
				if(typeof google_fonts[selected] !== 'undefined'){
					createHeadLink(selected);
				}

				current['font-family'] = selected;

				//for template
				control.params.current_font['font-family'] = selected;
				//for setting
				control.setting.set( current );

				//refresh control template
				control.renderContent();
			});

			//on choosing subsets or variants
			container.on('change','input[type="checkbox"]', function(){
				var subsets = collectSubsets(),
					variants = collectVariants(),

					//we need fresh object so api will know that something changed
					//otherwise we will operate on original object
					current = $.extend({}, control.setting());

				//delete legacy property
				if(typeof current['font-multi-style'] !== "undefined"){
					delete current['font-multi-style'];
				}

				current['subsets'] = subsets;
				current['variants'] = variants;

				//for template
				control.params.current_font.subsets = subsets;
				control.params.current_font.variants = variants;

				//for setting
				control.setting.set( current );
			});

			//on changing spacing
			container.on('input','input[type="number"]', function(){
				var input = $(this),
					name = input.attr('name'),
					value = input.val()+'px',

					//we need fresh object so api will know that something changed
					//otherwise we will operate on original object
					current = $.extend({}, control.setting());

				current[name] = value;

				//update font preview box
				container.find('div.preview-font').css(name, value);

				//for template
				control.params.current_font[name] = value;

				//for setting
				control.setting.set( current );
			});

			//after load ask for google font if it is selected
			var starting_font = control.params.current_font;
			if( typeof starting_font['font-family'] !== 'undefined' &&  typeof google_fonts[starting_font['font-family']] !== 'undefined'){
				createHeadLink(starting_font['font-family']);
			}
		}
	});

	api.controlConstructor['font'] = api.FontControl;

	api.SpacingControl = api.Control.extend({
		ready: function() {
			var control = this,
				container = this.container,
				unit_control = container.find('select[name="unit"]');

			//on changing unit
			container.on('change','select', function(){
				var sides = container.find('input[type="number"]'),
					unit = unit_control.val(),
					values = {};

				//get all spacings
				sides.each(function(index, side){
					var value = side.value;
					values[side.name] = value + (value.length ? unit : '');
				});

				values['units'] = unit;

				control.setting.set( values );
			});

			//on changing spacing
			container.on('input','input[type="number"]', function(){
				var input = $(this),
					value = input.val(),
					name = input.attr('name'),
					unit = unit_control.val(),

					//we need fresh object so api will know that something changed
					//otherwise we will operate on original object
					current = $.extend({}, control.setting());

				current[name] = value + (value.length ? unit : '');

				//make sure unit is saved
				current['units'] = unit;

				control.setting.set( current );
			});
		}
	});

	api.controlConstructor['spacing'] = api.SpacingControl;

	api.SocialsControl = api.Control.extend({
		ready: function() {
			var control = this,
				container = this.container,
				inputs = container.find('input.social_services'),

				update_values = _.debounce( function() {
					control.setting.set( get_current_values() );
				}, 500),

				get_current_values = function(){
					var value = {};

					//we get it again cause we are interested in order
					container.find('input.social_services').each(function(index, input){
						value[input.name] = input.value;
					});

					return value;
				},

				//action after drop of sorted item
				items_sort_update = function(){
					var value = get_current_values();

					value['__last_edit'] = new Date();//to make object different from saved

					control.setting.set( value );
				};

			inputs.on('input', update_values);

			container.sortable({
					axis: 'y',
					distance: 10,
					placeholder: "ui-state-highlight",
					handle: ".drag",
					items: '.social-service-row',
					cursor: 'move',
					revert: true,
					forcePlaceholderSize: true,
					update: items_sort_update
				});
		}
	});

	api.controlConstructor['socials'] = api.SocialsControl;

	api.SidebarsControl = api.Control.extend({
		ready: function() {
			var control = this,
				container = this.container,

				input_callback = _.debounce( function(){ update_values()} , 500),

				update_values =  function() {
					var values = get_current_values();

					//for template
					control.params.sidebars = values;

					//for control
					control.setting.set( values );
				},

				get_current_values = function(){
					var value = [];

					//we get it again cause we are interested in order
					container.find('input.custom_sidebar').each(function(index, input){
						value[input.name] = input.value;
					});

					return value;
				},

				remove_sidebar = function(e){
					e.preventDefault();
					var sidebar = $(this).parent();

					sidebar.remove();
					update_values();

					//refresh control template
					control.renderContent();
				},

				add_sidebar = function(e){
					e.preventDefault();

					var values = get_current_values();

					values.push("New sidebar " + values.length);

					//for template
					control.params.sidebars = values;

					//for control
					control.setting.set( values );

					//refresh control template
					control.renderContent();
				};

			container.on('input', 'input.custom_sidebar', input_callback);
			container.on('click', 'button.remove', remove_sidebar);
			container.on('click', 'button.add-new', add_sidebar);
		}
	});

	api.controlConstructor['custom_sidebars'] = api.SidebarsControl;

	// Extends our custom "theme-pro" section.
	api.sectionConstructor['theme-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	//fire on DOM Ready
	$(document).ready(function(){
		apollo13framework_font_icons_selector();
	});
} )( jQuery );

