/*global tb_show, tb_remove, alert, plupload, AdminParams, ajaxurl, wp, console */
(function($){
    "use strict";

    //swaping elemnts in array
    var $body, G,
        a13ArraySwap = function (x,y) {
            var b = this[x];
            this[x] = this[y];
            this[y] = b;
            return this;
        },

        //moving element in Array from one place to another
        a13ArrayMove = function (old_index, new_index) {
            if (new_index >= this.length) {
                var k = new_index - this.length;
                while ((k--) + 1) {
                    this.push(undefined);
                }
            }
            this.splice(new_index, 0, this.splice(old_index, 1)[0]);
            return this; // for testing purposes
		},

		//delay events
		debounce=function(d,a,b){"use strict";var e;return function c(){var h=this,g=arguments,f=function(){if(!b){d.apply(h,g);}e=null};if(e){clearTimeout(e)}else{if(b){d.apply(h,g)}}e=setTimeout(f,a||100)}};

    //listing all properties of object
    Object.keys = Object.keys || (function () {
        var hasOwnProperty = Object.prototype.hasOwnProperty,
            hasDontEnumBug = !{toString:null}.propertyIsEnumerable("toString"),
            DontEnums = [
                'toString', 'toLocaleString', 'valueOf', 'hasOwnProperty',
                'isPrototypeOf', 'propertyIsEnumerable', 'constructor'
            ],
            DontEnumsLength = DontEnums.length;

        return function (o) {
            if (typeof o != "object" && typeof o != "function" || o === null)
                throw new TypeError("Object.keys called on a non-object");

            var result = [];
            for (var name in o) {
                if (hasOwnProperty.call(o, name))
                    result.push(name);
            }

            if (hasDontEnumBug) {
                for (var i = 0; i < DontEnumsLength; i++) {
                    if (hasOwnProperty.call(o, DontEnums[i]))
                        result.push(DontEnums[i]);
                }
            }

            return result;
        };
    })();

    window.A13FRAMEWORK_ADMIN = {
        settings : {},

        //run after DOM is loaded
        onReady : function(){
            $body = $(document.body);
            G = ApolloParams;

            A13FRAMEWORK_ADMIN.upload();
            A13FRAMEWORK_ADMIN.utils.init();
            A13FRAMEWORK_ADMIN.metaActions.init();
            A13FRAMEWORK_ADMIN.settingsAction();
			A13FRAMEWORK_ADMIN.demoDataImporter();
			A13FRAMEWORK_ADMIN.registerLicense();
			A13FRAMEWORK_ADMIN.installCompanionPlugin();
		},

        installCompanionPlugin : function(){

            var plugin_card = $('.plugin-card-apollo13-framework-extensions');
            if(plugin_card.length){
                var installCompanionSuccess = function( response ) {
                        response.activateLabel = wp.updates.l10n.activatePluginLabel.replace( '%s', response.pluginName );
                        wp.updates.installPluginSuccess( response );
                    },

                    updateCompanionSuccess = function( response ) {
                        //some actions are still hapening so let's wait 1 second and try again
                        if(wp.updates.ajaxLocked){
                            setTimeout(function(){
                                updateCompanionSuccess(response);
                            }, 1000);
                        }
                        else{
                            //reload page after plugin is updated & activated
                            location.reload(true);
                        }
                    },

                    installCompanion = function( e ) {
                        e.preventDefault();
                        var args = {
                            slug: $( e.target ).data( 'slug' ),
                            success: installCompanionSuccess
                        };
                        wp.updates.installPlugin( args );
                    },

                    updateCompanion = function( e ) {
                        e.preventDefault();

                        var link = $( e.target),
                            args = {
                                plugin: link.data( 'plugin' ),
                                slug:   link.data( 'slug' ),
                                success: updateCompanionSuccess
                            };

                        wp.updates.maybeRequestFilesystemCredentials( e );

                        // Return focus to update button
                        wp.updates.$elToReturnFocusToFromCredentialsModal = link;

                        //visual info
                        link.addClass( 'updating-message').text(wp.updates.l10n.updating);

                        //do the update & reactivation
                        return wp.updates.ajax( 'update-plugin', args );
                    },

                    activateCompanion = function( e ) {
                        e.preventDefault();

                        var link = $(this);
                        //load this page by Ajax, and reload after - plugin should be activated
                        $.get( link.attr('href'), function(){
                            //reload page after plugin is activated
                            location.reload(true);
                        } );

                        link.addClass( 'updating-message');
                    };

                plugin_card
                    .on( 'click', 'a.install-now', installCompanion )
                    .on( 'click', 'a.activate-now', activateCompanion )
                    .on( 'click', 'a.update-now', updateCompanion );
            }
        },

		demoDataImporter : function(){
			var demo_grid = $('#a13_demo_grid');

			if(demo_grid.length){
                var log_div                = $('#demo_data_import_log').children('div'),
                    demo_filter_categories = $('ul.demo_filter_categories'),
                    demo_id                = '',
                    import_inputs          = $('div.import-config').find('input[type="checkbox"]'),
                    progress_bar           = $('div.import_progress'),
                    search_filter          = $('.demo_search'),
                    start_import_button    = $('#start-demo-import'),
                    view_website           = $('#import-visit-site'),
                    //error protection vars
                    error_count,last_response,

					startImport = function(){

                        //reset
                        error_count = 0;
                        last_response = {
                            level : '',
                            sublevel:  ''
                        };

                        var confirm_text = start_import_button.data('confirm');
                        if( import_inputs.filter('[name="clear_content"]').is(':checked') ){
                            confirm_text = confirm_text + "\n" + start_import_button.data('confirm-remove-content')
                        }

						if ( window.confirm(confirm_text) ){
							//clear log
							log_div.html('');

                            start_import_button.prop('disabled', true);

                            //start progress bar
                            progress_bar.addClass('running');

                            //scroll to where info is showing up while importing
                            $('html, body').animate({
                                scrollTop: $("#demo_data_import_status").offset().top
                            }, 500);

                            //start import
							nextLevel('','');
						}
					},

                    log_msg = function(msg){
                        log_div.html(log_div.html()+ msg );
                    },

					nextLevel = function(level, sublevel){
                        //collect import option
                        var import_options = {},
                            _import_inputs = import_inputs.not(':disabled').filter(':checked');

                        //get all checked inputs
                        _import_inputs.each(function(index){
                            var input = _import_inputs.eq(index);
                            import_options[input.attr('name')] = 1;
                        });

						$.ajax({
							type: "POST",
							url: ajaxurl,
							data:  {
								action : 'apollo13framework_import_demo_data', //called in backend
								level : level,
								sublevel : sublevel,
                                demo_id : demo_id,
                                import_security: $('#a13_import_nonce').val(),
                                import_options: import_options
                            },
							success: function(r) { //r = response
								if(r !== false ){
                                    //save last reply
                                    last_response = r;
                                    //reset error counter
                                    error_count = 0;

									setupStatus(r);

									if(r.is_it_end === false){//end of importing
										nextLevel(r.level, r.sublevel);
									}
									else{
                                        progress_bar.css('width','100%').removeClass('running');
                                        start_import_button.prop('disabled', false).hide();
                                        view_website.show();
									}
								}
							},
                            error: function(  jqXHR,  textStatus,  errorThrown ){
                                var message;

                                //check what type of error happened
                                if(typeof jqXHR.status !=='undefined' && (jqXHR.status == 404 || jqXHR.status == 403)){
                                    message = 'Server returned status '+jqXHR.status+'. Hopefully it is temporary.';
                                }
                                else if(textStatus == 'parsererror'){
                                    message = 'Importer returned data in wrong format. Probably unexpected HTML leaked into server reply instead of JSON format.';
                                }
                                else if( errorThrown == 'Internal Server Error' ){
                                    message = 'Server returned "Internal Server Error" while importing. It usually mean misconfiguration in server/WordPress.';
                                }
                                else{
                                    message = 'Unknown error: '+textStatus+' - '+errorThrown;
                                }

                                //try to recover from error
                                if( error_count < 10 ){
                                    //count this error
                                    error_count++;

                                    //log it
                                    log_msg('Error in a row: '+error_count + ' Error status: '+message+'<br />\r\n' );

                                    //wait and try again
                                    setTimeout(function(){nextLevel(last_response.level, last_response.sublevel);}, 5000);

                                    //done here
                                    return;
                                }

                                //report error
                                log_msg( message );
                                alert( message );

                                progress_bar.removeClass('running');
                                start_import_button.prop('disabled', true);
                            },
							dataType: 'json'
						});
					},

					setupStatus = function(r){
						var content = r.level_name,
                            status = $('#demo_data_import_status');
						if(r.sublevel_name.length){
							content += ' - '+r.sublevel_name;
						}

						status.html(content);
                        log_msg( r.log + '<br />' );
                        progress_bar.css('width',r.progress+'%');

                        if(r.alert == true){
                            alert(r.log);
                        }
					},

                    checkboxCheck = function(){
                        var input = $(this);
                        if( input.attr('name') === 'install_plugins'  ){
                            //toggle prop "disabled"
                            import_inputs.filter('[name="import_shop"]').prop('disabled', function(i, v) { return !v; })
                        }
                    },

                    filterItems = function(ev){
                        ev.stopPropagation();
                        ev.preventDefault();
                        var $this = $(this),
                            filter_string = '',
                            category;

                        //check category filter
                        if(demo_filter_categories.length){
                            var filters = demo_filter_categories.find('li');
                            if($this.is(filters)){
                                filters.removeClass('active');
                                category = $this.addClass('active').data('filter');
                            }
                            else{
                                category = filters.filter('li.active').data('filter');
                            }

                            if(category !== '*'){
                                filter_string = '[data-main_category*="'+category+'"]';
                            }
                        }

                        //check search filter
                        if(search_filter.length){
                            var str = search_filter.val();

                            //only take it into account if there is atleast 3 chars
                            if( str != '' && str.length > 2 ){
                                filter_string += '[data-categories*="'+str.toLowerCase()+'"]';
                            }
                        }

                        //check for empty selections
                        if(filter_string === ''){
                            filter_string = '*';
                        }

                        //filter
                        demo_grid.isotope({ filter: filter_string });
                    },

                    openItem = function(ev){
                        var item = $(this),
                            thumb = item.find('img.thumb'),
                            full = item.find('img.full'),
                            target = $(ev.target);

                        if(target.parents().is('div.action-bar')){
                            //we don't do any hiding/showing
                            return;
                        }

                        item.toggleClass('open');

                        item.one('itemAnimated', function(){
                            if(item.hasClass('open')){
                                //show full image
                                if(full.length){
                                    thumb.fadeOut(100);
                                    full.fadeIn(500);
                                }
                                else{
                                    full = $('<img class="full" />').attr('src', item.data('full')).hide().on( 'load', function(){
                                        full.appendTo(item.children()).fadeIn(500);
                                        thumb.fadeOut(100);
                                    });
                                }
                            }
                            else{
                                //show thumb
                                thumb.show();
                                full.hide();
                            }
                        });

                    },

                    reLayout = function(ev){
                        var target = $(ev.originalEvent.target);
                        if( target.is('.demo_grid_item') && ( ev.originalEvent.propertyName === 'width' ) ){
                            //relayout after transitions are done
                            demo_grid.isotope('layout');
                            target.trigger('itemAnimated');
                        }
                    },

                    selectDemo = function(){
                        var button = $(this);

                        //save demo id
                        demo_id = button.data('demo-id');

                        //move to next step
                        changeSteps(1,2);
                    },

                    changeSteps = function(hide, show){
                        if(show === 3){
                            prepareSummary();
                        }
                        else if( show == 2){
                            //make sure that import button is ready
                            start_import_button.show();
                            view_website.hide();
                        }

                        $('#a13-import-step-'+hide).addClass('hidden');
                        $('#a13-import-step-'+show).removeClass('hidden');
                    },

                    prepareSummary = function(){
                        var selected_design = $('.demo_grid_item[data-id="'+demo_id+'"]');
                        if(selected_design.length){
                            var summary = $('#a13-import-step-3').find('.import-summary');

                            //image
                            summary.find('img').attr('src', selected_design.data('full'));
                            //name
                            summary.find('h3').text(selected_design.data('name'));
                        }
                    },

                    importNavigation = function () {
                        var button       = $(this),
                            current_step = parseInt(button.parents('.import-step').data('step'), 10);

                        if (button.hasClass('previous-step')) {
                            changeSteps(current_step, current_step - 1);
                        }
                        else if (button.hasClass('next-step')) {
                            changeSteps(current_step, current_step + 1);
                        }
                        else if (button.is(start_import_button) && !button.is(':disabled')) {
                            startImport();
                        }
                    };

                //demos grid
                demo_grid.isotope({
                    getSortData: {
                        name: '.a13_demo_name'
                    },
                    sortBy: 'name',
                    masonry: {
                        columnWidth: 200,
                        gutter: 30
                    }
                });

                //single grid item events
                $('.demo_grid_item')
                    .on( 'click', openItem )
                    .on( 'transitionend', reLayout );

                //move to step 2
                $('button.demo-select').on('click', selectDemo);

                //importer navigation
                $('.import-navigation').find('button').on( 'click', importNavigation );

                //summary image - binded to import button
                $('#a13-import-step-3').find('.import-summary').find('img').on('click', function(){
                    if( view_website.length && view_website.is(':visible') ){
                        window.location = view_website.attr('href');
                    }
                    else{
                        start_import_button.click();
                    }
                });

                //event on checkboxes in import config
                import_inputs.on('change', checkboxCheck);

                //events for filters
                demo_filter_categories.on('click','li', filterItems);
                search_filter.on('keyup',debounce(filterItems,250));
			}
		},

        registerLicense : function(){
            var license_input = $("#add_license_code");

            if(license_input.length){
                var submit              = license_input.next('span.code_submit'),
                    check_purchase_code = function (purchase_code) {
                        /* var ajaxLogoutXHR = */ //not used
                        $.ajax({
                            type    : "POST",
                            url     : ajaxurl,
                            dataType: "json",
                            data    : {
                                action: 'apollo13framework_check_license_code', //called in backend
                                code  : purchase_code,
                                unique: new Date().getTime()
                            }
                        })
                            .done(function (data) {
                                alert(data.message);
                                if (data.response == 'success') {
                                    //reload page to get demo data grid
                                    location.reload(true);
                                }

                            })
                            .fail(function (jqXHR, textStatus, errorThrown) {

                            })
                            .always(function () {
                                submit.removeClass('disabled');
                            });
                    };

                submit.on( 'click touchend', function(){
                    var purchase_code = license_input.val();

                    if( purchase_code == '' || submit.hasClass('disabled') ){
                        return;
                    }

                    submit.addClass('disabled');
                    check_purchase_code( purchase_code );
                });
            }
        },

        upload : function(){
            //uploading files variable
            var custom_file_frame,
                field_for_uploaded_file,
                $upload_input,
                upload_buttons_selector = 'input.upload-image-button',
                clear_buttons_selector = 'input.clear-image-button',

                //on start of selecting/uploading file
                a13UploadFile = function(event){
                    event.preventDefault();

                    var upload_button = $(this);

                    //makes 'Upload Files' tab default one
                    wp.media.controller.Library.prototype.defaults.contentUserSetting=false;

                    //find text input to write in
                    $upload_input = $('input[type=text]', $(this).parent());

                    //remember in which input we want to write
                    field_for_uploaded_file = $upload_input.attr('name');

                    //If the frame already exists, reopen it
                    if (typeof(custom_file_frame)!=="undefined") {
                        custom_file_frame.close();
                    }

                    //Create WP media frame.
                    custom_file_frame = wp.media.frames.customHeader = wp.media({
                        //Title of media manager frame
                        title: "WP Media Uploader",
//                        frame: 'post',
                        frame: 'select',
                        state: 'library',
//                        editing:    true,
                        multiple:   false,
                        library: {
                            type: upload_button.data('media-type') || 'image' //others: audio, video, document(?)
                        },
                        button: {
                            text: upload_button.data('media-button-name') || "Insert image"
                        },
                        states : [
                            new wp.media.controller.Library({
                                filterable : 'all'
                            })
                        ]
                    });

                    //callback for selected image
                    custom_file_frame.on('insert select change', a13SelectFile);

                    //Open modal
                    custom_file_frame.open();
                },

				a13ClearFileInput = function(event){
                    event.preventDefault();

                    var clear_button 		= $(this),
						main_input 			= $('input[type=text]',clear_button.parent()),
						attachment 			= main_input.data('attachment'),
						attachment_input 	= typeof attachment === 'undefined' ? false : $('#'+ G.input_prefix+attachment);

					main_input.val('');
					if( attachment_input !== false ){
						attachment_input.val('');
					}
                },

                //after of selecting/uploading file
                a13SelectFile = function(){
                    var whole_state     = custom_file_frame.state(),
                        attachment      = whole_state.get('selection').first().toJSON();

                    //if there is some field waiting for input
                    if (field_for_uploaded_file !== undefined) {

                        //if selected media is image
                        if(attachment.type === 'image'){
                            var file_url    = attachment.url,
								attachment_field = $upload_input.data('attachment');

                            //insert its src to waiting field
                            $upload_input.val(file_url);

                            //for this field save also attachment id
							if(typeof attachment_field !== 'undefined'){
                            	$('#a13_'+attachment_field).val(attachment.id);
							}
                        }
                        //search for link and its href
                        else{
                            //insert its src to waiting field
                            $upload_input.val(attachment.url);
                        }

                        //clean waiting variable
                        field_for_uploaded_file = undefined;
                    }
                };

            $(document).on('click', upload_buttons_selector, a13UploadFile);
            $(document).on('click', clear_buttons_selector, a13ClearFileInput);
        },

        utils: {
            init : function(){
                var AU = A13FRAMEWORK_ADMIN.utils;

                AU.colorPicker();
                AU.sliderOption();
                AU.adminMenu();
                AU.fontIconsSelector();
                AU.selectExport();
                AU.importThemeSettings();
            },


            /*** color picker ***/
            colorPicker : function(){
                var input_color = $('input.with-color');
                if(input_color.length){
                    input_color.wheelColorPicker({
                        format: 'rgba',
                        preview: false, /* buggy */
                        validate: true,
                        autoConvert: true,
                        preserveWheel: true
                    });

                    //transparent value
                    $body.on('click', 'button.transparent-value', function(){
                        $(this).prev('input.with-color').attr('style','').val('transparent');
                        return false;
                    });
                }
            },

            /**** SLIDER FOR SETTING NUMBER OPTIONS ****/
            sliderOption : function(){
                var sliders = $('div.slider-place');
                if(sliders.length){
                    //setup sliders
                    sliders.each(function(index){
                        var min,max,unit,step,$s;
                        //collect settings
                        $s = sliders.eq(index);
                        min = $s.data('min');
                        min = (min === '')? 10 : parseFloat(min); //0 is allowed now
                        max = $s.data('max');
                        max = (max === '')? 30 : parseFloat(max); //0 is allowed now
                        step = $s.data('step');
                        step = (step === '')? 1 : parseFloat(step);
                        unit = $s.data('unit');

                        $s.slider({
                            range: "min",
                            animate: true,
                            min: min,
                            max: max,
                            step: step,
                            slide: function( event, ui ) {
                                $( this ).prev('input.slider-dump').val( ui.value + unit );
                            }
                        });
                    });

                    //set values of sliders
                    $( "input.slider-dump" ).bind('blur', function(){
                        var _this = $(this),
                            value = parseInt(_this.val(), 10),
                            slider = _this.next('div.slider-place'),
                            unit = slider.data('unit');

                        if( !isNaN(value) && (value + '').length){ //don't work on empty && compare as string
                            slider.slider( "option", "value", value );
                            _this.val(value + unit);
                        }
                    }).trigger('blur');
                }
            },

            adminMenu : function(){
                var root = $('#menu-to-edit'),
                    enabled_class = 'mega-menu-enabled';

                if(root.length){
                    var switchMegaMenuOptions = function(){
                        var menu_items = root.children(),
                            number = menu_items.length,
                            i = 0,
                            current, check,
                            mm_enabled = false,
                            classChange = function(current){
                                if(mm_enabled){
                                    //WordPress 5.4 and above
                                    current.find('.a13-megamenu-options').addClass(enabled_class);
                                    //WordPress < 5.4
                                    current.addClass(enabled_class);
                                }
                                else{
                                    //WordPress 5.4 and above
                                    current.find('.a13-megamenu-options').removeClass(enabled_class);
                                    //WordPress < 5.4
                                    current.removeClass(enabled_class);
                                }
                            };

                        for(;i<number;i++){
                            current = menu_items.eq(i);

                            //level 0
                            if(current.is('.menu-item-depth-0')){
                                check = current.find('input.enable-mega-menu');
                                mm_enabled = check.is(':checked');//true || false
                                classChange(current);
                                continue;
                            }

                            //level 1
                            if(current.is('.menu-item-depth-1')){
                                classChange(current);
                            }
                        }
                    };

                    //bind events
                    root.on( 'change', 'input.enable-mega-menu', switchMegaMenuOptions);
                    root.on( 'sortstop', function(){ setTimeout( switchMegaMenuOptions, 100);} ); //delay so all DOM can be updated
                    root.on( 'click','p.field-move a', switchMegaMenuOptions ); //for manual moving
                }
            },

            fontIconsSelector :  function(){
                var selector = $('#a13-fa-icons');

                if(selector.length){
                    var inputs_selector = 'input.a13-fa-icon, input.a13_fa_icon',
                        icons = selector.find('.a13-font-icon'),
                        search = selector.find('input'),
                        current_input,

                        showSelector = function(){
                            current_input = $(this);
                            var element_to_position = current_input.next('.a13-input-icon');
                            // Reposition the popup window
                            selector.css({
                                top: (element_to_position.offset().top + element_to_position.outerHeight() - parseInt( $(document.documentElement).css('padding-top'), 10 ) ) + 'px',
                                left: element_to_position.offset().left + 'px'
                            }).show();

                            $body.off('click.iconSelector');
                            $body.on('click.iconSelector', hideCheck);

                        },

                        hideSelector = function(){
                            current_input = null;
                            selector.hide();
                            $body.off('click.iconSelector');
                        },

                        hideCheck = function(e){
                            if(typeof e.target !== 'undefined'){
                                var check = $(e.target);
                                if(check.is(current_input) || check.is(selector) || check.parents('#a13-fa-icons').length || check.is('.a13-input-icon') ||  check.parents('.a13-input-icon').length){
//                                    current_input.focus();
                                }
                                else{
                                    hideSelector();
                                }
                            }
                        },

                        fillInput = function(){
                            var prefix = current_input.hasClass('a13-full-class')? 'fa fa-' : '';
                            //we trigger input event for Customizer
                            current_input.val(prefix + $(this).attr('title')).trigger('input'); //no focus, cause it creates risk that it will not refresh;
                            updateIcon(current_input);
                        },

                        updateIcon = function(inputs){
                            inputs.each(function(){
                                var input = $(this),
                                    parent = input.next('.a13-input-icon'),
                                    icon = parent.find('.icon'),
                                    value = input.val(),
                                    prefix = input.hasClass('a13-full-class')? '' : 'fa fa-',
                                    description = value.replace(/-/gi, ' ').replace(/fa fa/gi, ''),
                                    empty = value === '';

                                if(value === ''){
                                    prefix = 'fa fa-';
                                    value = 'plus-square-o';
                                }

                                if(icon.length){
                                    empty ? parent.addClass('empty') : parent.removeClass('empty') ;
                                    //update icon
                                    icon.children().attr( 'class', prefix+value );
                                    parent.find('.description').text(description);
                                }
                                else{
                                    //add icon
                                    input.after('<span class="a13-input-icon'+(empty? ' empty' : '')+'"><span class="clean-icon fa fa-times"></span><span class<span class="icon"><i class="'+prefix+value+'"></i></span><span class="description">'+description+'</span></span>');
                                }
                            });

                        },

                        inputEvent = function(){
                            var input = $(this),
                                str;

                            str = input.val().toLowerCase();

                            filterItems(str);
                        },

                        filterItems = function (val) {
                            //only take it into account if there is at least 2 chars
                            if (val != '' && val.length > 1) {
                                icons.hide().filter('[title*="'+val+'"]').show();
                            }
                            else{
                                icons.show();
                            }
                        };

                    //add icons selector to content
                    selector.prependTo('#wpcontent');

                    //when icons input is focus show icons selector
                    $body.on('focus', inputs_selector, {}, showSelector);

                    //if icon selector starter is clicked focus on hidden input
                    $body.on('click', '.a13-input-icon', function(ev){
                        ev.preventDefault();
                        var input = $(this).prev();

                        if( current_input !== null && input.is(current_input) ){
                            hideSelector();
                        }
                        else{
                            input.focus();
                        }
                    });

                    //even for removing icon
                    $body.on('click', '.clean-icon', function(ev){
                        ev.preventDefault();
                        ev.stopPropagation();

                        var input = $(this).parent().prev();
                        input.val('');
                        updateIcon(input);
                    });

                    //filter search results on typing after 100ms
                    search.on('input', debounce(inputEvent,100) );

                    //look for icon inputs, hide them and show icon selector instead
                    updateIcon( $(inputs_selector).addClass('screen-reader-text') );
                    $body.on('a13_set_icons_control', function(){
                        updateIcon( $(inputs_selector).addClass('screen-reader-text') );
                    });

                    //on click on icon in icon selector will our input and preview
                    $('span.a13-font-icon').on('click', fillInput);
                }
            },

            //auto select text in export textarea
            selectExport : function(){
                var copy_buttons = $('button.copy-content');

                if(copy_buttons.length){
                    copy_buttons.on( 'click', function(e){
                        e.preventDefault();
                        var textarea = $(this).prev('textarea').select();
                        textarea.get(0).select();
                        document.execCommand('copy');
                    });
                }
            },

            //auto select text in export textarea
            importThemeSettings : function(){
                var import_button = $("button.import-theme-settings");

                if(import_button.length){
                    var import_settings = function (settings) {
                        /* var ajaxLogoutXHR = */ //not used
                        $.ajax({
                            type    : "POST",
                            url     : ajaxurl,
                            dataType: "json",
                            data    : {
                                action: 'apollo13framework_import_theme_settings', //called in backend
                                settings  : settings,
                                unique: new Date().getTime()
                            }
                        })
                            .done(function (data) {
                                alert(data.message);
                            })
                            .fail(function () {
                                alert('Unknown error during Import.');
                            })
                            .always(function () {
                                import_button.removeClass('disabled');
                            });
                        };

                    import_button.on( 'click touchend', function(){
                        var button = $(this),
                            field_id = button.data('import-field'),
                            settings_string = $('#'+field_id).val();

                        if( settings_string == '' || button.hasClass('disabled') ){
                            return;
                        }

                        button.addClass('disabled');
                        import_settings( settings_string );
                    });
                }
            }
        },

        metaActions : {
            init : function(){
                //if there are meta fields check for special elements
                var apollo_meta = $('div.apollo13-metas'),
                    AM = A13FRAMEWORK_ADMIN.metaActions;

                if (apollo_meta.length) {
                    //bind multi upload and some other things
                    AM.muManage(apollo_meta);

                    //bind switcher(hides unused options like image vs video)
                    apollo_meta.on('change','input[type="radio"], select',{}, AM.checkDependencies);

                    //tabs
                    AM.metaTabs();
                }
            },

            metaTabs : function(){
                var main = $('#apollo13_theme_options');

                if(main.length){
                    var field_sets   = main.find('div.fieldset_tab'),
                        tabs         = main.find('ul.meta-tabs').children(),
                        form         = $('#post'),
                        tab_hash     = '#apollo13-meta-tab',
                        hash         = window.location.hash,
                        selected_tab = 0;

                    tabs.on('click', function(){
                        tabs.removeClass('selected');
                        field_sets.hide();
                        var index = tabs.index(this);
                        tabs.eq(index).addClass('selected');
                        field_sets.eq(index).show();

                        window.location.hash = tab_hash+index;
                    });

                    //check if there is any preselected tab
                    if(hash.indexOf(tab_hash) > -1){
                        selected_tab = parseInt(hash.substr(tab_hash.length), 10);

                        //be safe
                        if(selected_tab < 0 || (selected_tab + 1 > tabs.length) ){
                            selected_tab = 0;
                        }
                    }

                    //hide all besides selected
                    field_sets.hide().eq(selected_tab).show();
                    tabs.eq(selected_tab).addClass('selected');

                    //make sure we will land in same tab after save
                    form.on('submit', function(){
                        var action = form.attr('action'),
                            //path = window.location.pathname,
                            hash = window.location.hash;
                        form.attr('action', action+hash); //insert anchor
                    });
                }
            },

			muManage : function(apollo_meta){
                var prototype_selector = 'div.fieldset.prototype',
					_prototype = apollo_meta.find(prototype_selector);

                //there is prototype so we have work to do
                if(_prototype.length){
                    var textarea                = $('#'+ G.input_prefix+'images_n_videos');
						//prevent changed "written"(changed) value of textarea if user hits f5(happens in firefox for sure)
						textarea.val(textarea.text());
                    var items_JSON              = JSON.parse( textarea.val() ),
						our_apollo_meta			= textarea.parents('.apollo13-metas').eq(0),
                        item_selector           = 'li.mu-item',
						prototype_pre_id		= 'mu-prototype-',
                        mu_button               = $('#a13-multi-upload'),
                        bulk_taging             = $('#a13_multi_tags'),
						remove_button 			= $('#a13-multi-remove'),
						sort_area 				= $('#mu-media'),
						notice_area				= $('#a13-mu-notice'),
						single_item_html		= $('#mu-single-item').children(),
                        defaults				= [],//will hold default values for different item types
						ideal_column_width		= 150,
						edited_item,			//memory what is currently edited
                        custom_file_frame,      //for multi upload window
						columns,				//number of columns
                        sort_start_position,
                        all_items,

                        //refreshes all_items variable
                        updateAllItems = function(){
                            all_items = sort_area.find(item_selector);
                        },

						//prepares list of default values for each item type
						collectDefaults = function(){
							_prototype.each(function(){
								var _this = $(this),
									id = _this.attr('id').substring(prototype_pre_id.length);

								defaults[id] = collectValues(_this);
							});
						},

						//collects values from edit fieldset
                        collectValues = function(fields_part){
                            var values = {},
                                inputs = fields_part.find('input,textarea,select').not(':button').not('.not-to-collect'),
                                size = inputs.length,
                                temp, is_radio, i;

							for(i = 0; temp = inputs.eq(i), i < size; i++){
								is_radio = temp.is('[type="radio"]');
								if( !is_radio || ( is_radio && temp.is(':checked') ) ){
									values[temp.attr('name').slice(G.input_prefix.length)] = temp.val(); //slice() to avoid a13_ prefix
								}
							}

                            return values;
                        },

                        //returns index of item in list
                        indexOfItem = function(item){
                            //check if we have proper element to get index
                            if(!item.is(item_selector)){
								//what we are doing here?
								return -1;
                            }

                            return all_items.index(item);
                        },

                        //updates JSON string in textarea
                        updateTextarea = function(){
                            textarea.val(JSON.stringify(items_JSON));
                        },

						//check if such attachment exist in gallery already
						uniqueAttachment = function(id){
							for(var i = 0, end = items_JSON.length; i < end; i++){
								if(id === items_JSON[i].id){
									return false;
								}
							}
							return true;
						},

                        //fills inputs of currently edited item with data from JSON
                        fillItemDetails = function(index, fields_part){
                            var fields  = $.extend({}, defaults[items_JSON[index].type], items_JSON[index]),
                                keys    = Object.keys(fields),
                                size    = keys.length,
                                i, field, field_id;

                            //fill inputs
                            for(i = 0; field_id = keys[i],  i < size; i++){
								field = fields_part.find('[name="'+ G.input_prefix+field_id+'"]');
								//if such field exist(it doesn't have to!)
								if(field.length){
									//radio input? special work to do!
									if(field.is('[type="radio"]')){
										field.filter('[value="'+fields[field_id]+'"]')
											.prop('checked', true).change();
									}
									//classic...
									else{
                                		field.val(fields[field_id]);
									}
								}
                            }

                            //prepare filter
                            var filter_container = fields_part.find('div.tag_media-input');
                            if(filter_container.length) {
                                itemTags({
                                    filter_container : filter_container,
                                    index : index
                                });
                            }
                        },

						//show fieldset where details of item can be edited
						showFieldset = function(type){
							var edited_id   = items_JSON[edited_item].id,
                                lightbox 	= $('<div class="a13_mu_lighhtbox"></div>'),
								pop 		= $('<div class="a13_mu_white_content"></div>'),
								shadow 		= $('<div class="a13_mu_black_overlay"></div>'),
								fieldset 	= $('#'+prototype_pre_id+type).show(),
								controls 	= $(
									'<div class="controls">'+
										'<span class="title">Editing item of '+type+' type</span>'+
                                        (edited_id === 'external'? '' : '<a class="button button-large edit-attachment" href="post.php?post='+edited_id+'&action=edit" target="_blank">Edit '+type+' details</a>')+
										'<input class="a13_mu_save button button-large button-primary" value="Save" type="button">'+
										'<input class="a13_mu_cancel button button-large" value="Cancel" type="button">'+
									'</div>'
								);


							//setup lightbox
							pop				.append(controls, fieldset);
							lightbox		.append(pop, shadow);
							our_apollo_meta	.append(lightbox);


							//display
							shadow.fadeIn(100);
							pop.slideDown(300);

							return fieldset;
						},

						//hides fieldset after edit/add item
						closeFieldset = function(){
							var lightbox 	= $(this).parents('.a13_mu_lighhtbox').eq(0).hide(),
								type 		= items_JSON[edited_item].type,
								fieldset 	= $('#'+prototype_pre_id+type).hide();

							//cleanup
							hideColorPicker(fieldset);
							our_apollo_meta.append(fieldset);
							lightbox.remove();
							edited_item = '';

                            $body.trigger('a13_close_fieldset');
						},

                        //hides open color pickers
                        hideColorPicker = function(fields_part){
							var inputs = fields_part.find('input.with-color');
							if(inputs.length){
                            	inputs.wheelColorPicker('hide');
							}
                        },

                        //action on sort start
                        itemsSortStart = function(event, ui){
                            sort_start_position = indexOfItem(ui.item);
							ui.placeholder.html('<div class="attachment-preview"></div>');
                        },

                        //action after drop of sorted item
                        itemsSortUpdate = function(event, ui){
                            updateAllItems(); //for good indexes
                            var sort_end_position = indexOfItem(ui.item);

                            //no change, do nothing
                            if(sort_start_position === sort_end_position){ return; }

                            //only swap
                            else if(Math.abs( sort_start_position - sort_end_position ) === 1){
                                //swap in object
                                a13ArraySwap.call(items_JSON, indexOfItem(ui.item), sort_start_position );
                            }

                            //move element
                            else{
                                a13ArrayMove.call(items_JSON, sort_start_position, indexOfItem(ui.item));
                            }

                            updateTextarea();
                        },

                        //on start of selecting/uploading images
                        muUploadFile = function(event){
                            event.preventDefault();

                            //makes 'Upload Files' tab default one
                            //wp.media.controller.Library.prototype.defaults.contentUserSetting=false;

                            //If the frame already exists, reopen it
                            if (typeof(custom_file_frame)!=="undefined") {
                                custom_file_frame.close();
                            }

                            //Create WP media frame.
                            custom_file_frame = wp.media.frames.customHeader = wp.media({
                                //Title of media manager frame
                                title: "WP Media Uploader",
                                frame: 'select',
                                state: 'library',
                                multiple: true,
                                library: {},
                                button: {
                                    text: "Insert item(s)"
                                },
                                states : [
                                    new wp.media.controller.Library({
                                        filterable : 'all',
                                        multiple : true
                                    })
                                ]
                            });

                            //callback for selected items
                            custom_file_frame.on('select', muSelectFile);

                            //Open modal
                            custom_file_frame.open();
                        },

                        //after of selecting/uploading file
                        muSelectFile = function(){
                            var whole_state     = custom_file_frame.state(),
                                selection       = whole_state.get('selection').models,
                                items_num       = selection.length,
								is_prepend		= $('#mu-prepend').is(':checked'),
                                to_send_array 	= [],
                                new_index, elem, current_item,
                                attachment, item_type, id, temp;

							//are there any items?
                            if (items_num) {
                                for(elem = 0; elem < items_num; elem++){
                                    attachment      = selection[elem].toJSON();
									id  			= attachment.id;
									if(!uniqueAttachment(id)){
										continue;
									}
									item_type 		= attachment.type;

									//add items to elements array
									temp = $.extend({},defaults[item_type]);
									if(is_prepend){
										items_JSON.unshift(temp);
										new_index   = 0;
									}
									else{
										new_index   = items_JSON.push(temp)-1;
									}
									current_item    = items_JSON[new_index];

									//collect this item in JSON
									to_send_array.push(attachment);

									//update of item JSON
									current_item.type	= item_type;
									current_item.id     = id;
                                }

								//proceed only if we have new(unique) items
								if(to_send_array.length){
									$.ajax({
										type: "POST",
										url: ajaxurl,
										data: {
											action : 'apollo13framework_prepare_gallery_items_html', //called in backend
											items : to_send_array
										},
										success: function(new_html) {
											//insert HTML
											if(is_prepend){
												sort_area.prepend(new_html);
											}
											else{
												sort_area.append(new_html);
											}

											updateAllItems();

											temp = 'Added '+to_send_array.length+' new item(s)';
											if(items_num-to_send_array.length){
												temp += '<br />'+(items_num-to_send_array.length)+' item(s) was already in your gallery';
											}
											showNotice(temp)
										},
										error: function(jqXHR, textStatus, errorThrown ){
											showNotice('Error: '+textStatus+' \n '+errorThrown);
										},
										dataType: 'html'
									});

									updateTextarea();
								}
								else{
									showNotice('All elements that you choose exist already in your gallery.');
								}
                            }
                        },

						editAction = function(){
							editItem($(this));
						},

                        addItem = function(){
							var is_prepend		= $('#mu-prepend').is(':checked'),
								type			= 'videolink',
								temp 			= $.extend({},defaults[type]),
								placeholder		= single_item_html.clone(),
								new_index;

							//fill defaults
							temp.id = 'external';
							temp.type = type;

							if(is_prepend){
								items_JSON.unshift(temp);
								new_index   = 0;
								sort_area.prepend(placeholder);
							}
							else{
								new_index   = items_JSON.push(temp)-1;
								sort_area.append(placeholder);
							}

                            //add to all_items list
                            updateAllItems();

                            updateTextarea();

							editItem(all_items.eq(new_index));
                        },

						editItem = function(item){
							//if clicked edit button
							if(!item.is(item_selector)){
								//item is link inside
								item = item.parents(item_selector)
							}

							var index           = indexOfItem(item),
								type			= items_JSON[index].type;

							edited_item =  index; //memory

							//show form in new place
							fillItemDetails(index, showFieldset(type));
						},

						removeItem = function(item, skip_update){
							//used for mass delete
							if(typeof skip_update === 'undefined'){
								skip_update = false;
							}

							var index = indexOfItem(item);

							if(index === -1){//this was deleted
								return;
							}

							//update all_items list
							all_items = all_items.not(all_items.eq(index));

							//update JSON
							items_JSON.splice( index ,1 );

							if(!skip_update){
								updateTextarea();
							}
						},

                        removeAction = function(){
                            var item = $(this).parents(item_selector),
                                type = items_JSON[indexOfItem(item)].type;

                            removeItem(item);

                            //remove HTML
                            item.fadeOut(250,function(){
                                item.remove();
                            });

							showNotice('Removed 1 item of type '+ type );
                        },

                        updateItem = function(){
                            //let controls finish tasks
                            $body.trigger('a13_before_item_save');

                            var $item 		= all_items.eq(edited_item),
								item 		= items_JSON[edited_item],
								type 		= item.type,
								fieldset 	= $('#'+prototype_pre_id+type),
								values 		= collectValues(fieldset);

                            item = $.extend(item, values);

							//link media type
							if(item.id === 'external'){
								//ask for new html
								$.ajax({
									type: "POST",
									url: ajaxurl,
									data: {
										action : 'apollo13framework_prepare_gallery_single_item_html', //called in backend
										item : item
									},
									success: function(new_html) {
										//insert HTML
										$item.replaceWith(new_html);
										updateAllItems(); //need to grab new DOM element instead of removed one
									},
									error: function(jqXHR, textStatus, errorThrown ){
										showNotice('Error: '+textStatus+' \n '+errorThrown);
									},
									dataType: 'html'
								});
							}

                            updateTextarea();
							closeFieldset.call(this);
							showNotice('Updated 1 item of type '+ type );
						},

						showNotice = function(text){
							hideNotice();
							$('<p>'+text+'</p>').appendTo(notice_area).slideUp(0).slideDown();
						},

						hideNotice = function(){
							var notes = notice_area.children();
							if(notes.length){
								notes.slideUp().promise().done(function(){notes.remove()});
							}
						},

						selectionHandler = function(event){
							event.preventDefault();
							var method = 'single',
								selected = all_items.filter('.selected'),
								$this = $(this),
								last, clicked;

							if ( event.shiftKey ) {
								method = 'between';
							} else if ( event.ctrlKey || event.metaKey ) {
								method = 'toggle';
							}

							//check if there is anything selected
							if(method === 'single'){
								all_items.not($this).removeClass('selected');
								$this.toggleClass('selected');
							}
							else{
								if(selected.length && method === 'between'){
									last = indexOfItem(selected.eq(selected.length - 1));
									clicked = indexOfItem($this);

									if(clicked !== last){
										if(clicked < last){
											$this.nextUntil(last).addBack().addClass('selected');
										}
										else{
											selected.eq(selected.length - 1).nextUntil($this).add($this).addClass('selected');
										}
									}
								}
								else{
									$this.toggleClass('selected');
								}
							}

							//toggle delete button
							if(all_items.filter('.selected').length){
                                switchConditionalControls();
							}
							else{
                                switchConditionalControls(false);
							}
						},

                        switchConditionalControls = function(switcher){
                            switcher = typeof switcher === 'undefined'? true : switcher;

                            remove_button.prop({
                                disabled: !switcher
                            });

                            bulk_taging.find('input').prop({
                                disabled: !switcher
                            });

                            if(switcher){
                                bulk_taging.removeClass('disabled');
                            }
                            else{
                                bulk_taging.addClass('disabled');
                            }
                        },

						removeSelected = function(){
							var selected = all_items.filter('.selected'),
								number = selected.length;

							if(number){
								selected.each(function(){
									var t = $(this);
									removeItem(t, true);
								});

								//remove HTML
								selected.fadeOut(250,function(){
									selected.remove();
								});

								updateTextarea();

								showNotice('Removed '+number+' items');
							}

							//disable button
                            switchConditionalControls(false);
						},

                        itemTags = function(args){
                            //get params
                            args = $.extend({
                                filter_container : undefined,
                                index : undefined,
                                single : true
                            }, args );

                            var filter_container = args.filter_container,
                                index            = args.index,
                                singleItem       = args.single,
                                breakTags                 = function (string_tags) {
                                    if (typeof string_tags !== 'undefined') {
                                        var tags     = string_tags.split(','),
                                            temp_arr = [];
                                        for (var i = 0; i < tags.length; i++) {
                                            if (tags[i].length) {
                                                temp_arr.push($.trim(tags[i]));
                                            }
                                        }
                                        return temp_arr;
                                    }
                                    return [];
                                },
                                uniqueArray               = function (array) {
                                    var n = [array[0]];
                                    for (var i = 1; i < array.length; i++) {
                                        if (array.indexOf(array[i]) == i) n.push(array[i]);
                                    }
                                    return n;
                                },
                                difference                = function (a1, a2) {
                                    var result = [];
                                    for (var i = 0; i < a1.length; i++) {
                                        if (a2.indexOf(a1[i]) === -1) {
                                            result.push(a1[i]);
                                        }
                                    }
                                    return result;
                                },
                                collectAllExistingAndCurrentTags = function(){
                                    var temp_array = [];

                                    for (var i = 0, end = items_JSON.length; i < end; i++) {
                                        temp_array[i] = items_JSON[i][items_JSON[i].type + '_tags'];
                                        all_tags = all_tags.concat(breakTags(temp_array[i]));
                                    }
                                    //unique list
                                    if (all_tags.length) {
                                        all_tags = uniqueArray(all_tags);
                                    }

                                    if(singleItem){
                                        //get filters for current item
                                        current_tags = breakTags(temp_array[index]);
                                    }
                                },
                                updateCurrentTags = function(){
                                    var temp_html = '';
                                    for (var i = 0; i < current_tags.length; i++) {
                                        temp_html += '<span><a class="ntdelbutton"><i class="remove-tag-icon" aria-hidden="true"></i></a>&nbsp;<em>' + current_tags[i] + '</em></span>';
                                    }

                                    current_tags_container.empty().append(temp_html);
                                },
                                updateAvailableTags = function() {
                                    available_tags = difference(all_tags, current_tags);
                                },
                                updateTagsTextarea = function(){
                                    tags_textarea.val(current_tags.join(', '));
                                },
                                addTag = function(tag){
                                    current_tags.push(tag);
                                    updateTagsTextarea();
                                    updateCurrentTags();
                                    updateAvailableTags();
                                },
                                removeTag = function(tag){
                                    var where_it_is = current_tags.indexOf(tag);
                                    current_tags.splice(where_it_is, 1);
                                    updateTagsTextarea();
                                    updateCurrentTags();
                                    updateAvailableTags();
                                },
                                inputTagsHandler = function (e) {
                                    //don't look for "enter" when autocomplete is open
                                    if ( $(this).autocomplete("instance").menu.active ){
                                        return;
                                    }

                                    if (e.keyCode == 13) {
                                        e.preventDefault();
                                        e.stopPropagation();
                                        add_tag_button.click();
                                        return false;
                                    }
                                },
                                buttonTagsHandler = function(){
                                    var value = add_tag_input.val(),
                                        tags = breakTags(value),
                                        temp;

                                    if(singleItem){
                                        for (var i = 0; i < tags.length; i++) {
                                            temp = $.trim(tags[i]);
                                            if (temp.length && current_tags.indexOf(temp) < 0) {
                                                addTag(temp);
                                            }
                                        }

                                        //reset tag input
                                        add_tag_input.val('');
                                    }
                                    else{
                                        //get selected itesm
                                        var selected = all_items.filter('.selected'),
                                            number = selected.length;

                                        if(tags.length === 0){
                                            showNotice('No tags added.');
                                        }
                                        else if(number) {
                                            //removes "," that was at end of last value
                                            //tags = tags.join(', ');

                                            //add tags for each item
                                            selected.each(function () {
                                                var index         = indexOfItem($(this)),
                                                    item          = items_JSON[index],
                                                    type          = item.type,
                                                    old_tags      = breakTags(item[type + '_tags']),
                                                    new_item_part = [];

                                                //combine old and new tags
                                                new_item_part[type + '_tags'] = uniqueArray(old_tags.concat(tags)).join(', ');

                                                //add new tags to item
                                                $.extend(item, new_item_part);
                                            });

                                            //update things
                                            updateTextarea();
                                            updateAvailableTags();

                                            showNotice('Updated ' + number + ' items with tags: ' + tags.join(', '));

                                            //reset tag input
                                            add_tag_input.val('');
                                        }
                                        //user didn't select anything
                                        else{
                                            showNotice('No items selected.');
                                        }
                                    }

                                },
                                removeTagsHandler = function(e){
                                    e.preventDefault();
                                    removeTag($(this).nextAll('em').text());
                                },
                                split = function( val ){
                                    return val.split( /,\s*/ );
                                },
                                extractLast = function ( term ){
                                    return split( term ).pop();
                                },
                                bindEvents = function(){
                                    if(singleItem){
                                        current_tags_container.on('click', 'a', removeTagsHandler);
                                        $body.on('a13_before_item_save', buttonTagsHandler);
                                        $body.on('a13_close_fieldset', unbindEvents);
                                    }
                                    add_tag_button.on('click', buttonTagsHandler);
                                    add_tag_input.on('keydown', inputTagsHandler);

                                    add_tag_input.autocomplete({
                                        autoFocus: true,
                                        minLength: 0,
                                        delay: 50,
                                        source: function( request, response ) {
                                            // delegate back to autocomplete, but extract the last term
                                            response( $.ui.autocomplete.filter(
                                                available_tags, extractLast( request.term ) ) );
                                        },
                                        focus: function() {
                                            // prevent value insert on focus - good for multi-tagging at one go
                                            return false;
                                        },
                                        select: function( event, ui ) {
                                            var terms = split( this.value );
                                            // remove the current input
                                            terms.pop();
                                            // add the selected item
                                            terms.push( ui.item.value );
                                            // add placeholder to get the comma-and-space at the end
                                            terms.push( "" );
                                            this.value = terms.join( ", " );
                                            return false;
                                        }
                                    });
                                },
                                unbindEvents = function(){
                                    if(singleItem) {
                                        current_tags_container.off('click', 'a', removeTagsHandler);
                                        $body.off('a13_before_item_save', buttonTagsHandler);
                                        $body.off('a13_close_fieldset', unbindEvents);
                                    }
                                    add_tag_button.off('click', buttonTagsHandler);
                                    add_tag_input.off('keydown', inputTagsHandler);

                                    add_tag_input.autocomplete( "destroy" );

                                    current_tags = [];
                                },
                                tags_textarea          = filter_container.find('textarea'),
                                current_tags_container = filter_container.find('div.current-tags'),
                                add_tag_button         = filter_container.find('input.tagadd'),
                                add_tag_input          = filter_container.find('input.newtag'),
                                available_tags         = [],
                                all_tags               = [],
                                current_tags           = [];

                            //collect all available tags
                            collectAllExistingAndCurrentTags();

                            //remove currently used filters from list of available filters
                            updateAvailableTags();

                            if(singleItem){
                                //print controls
                                updateCurrentTags();
                            }

                            bindEvents();
                        },

                        //not implemented yet
						/*workingStatusOn = function(){

						},

						workingStatusOff = function(){

						},*/

						setColumns = function() {
							var prev = columns,
								width = sort_area.width();

                            //if width is not present, for example in gutenberg editor due to loading and moving metaboxes, simulate width from window
                            if(width <= 0){
                                width = $(window).width();
                            }

                            columns = Math.min( Math.round( width / ideal_column_width ), 12 ) || 1;

                            if ( ! prev || prev !== columns ) {
                                sort_area.attr( 'data-columns', columns );
                            }
						};


                    collectDefaults();

					updateAllItems();

					setColumns();

                    //bind actions
					our_apollo_meta
                        .on('click', 'span.add-link-media', {}, addItem)
                        .on('click', 'input.a13_mu_save', {}, updateItem)
                        .on('click', 'input.a13_mu_cancel', {}, closeFieldset);

                    //actions on single gallery item
					sort_area
                        .on('click', 'span.mu-item-remove', {}, removeAction)
                        .on('click', 'span.mu-item-edit', {}, editAction)
						.on('click keydown', item_selector, selectionHandler)
						.sortable({
							handle: 'div.mu-item-drag',
							items: item_selector,
							placeholder : 'sort-placeholder attachment',
							start: itemsSortStart,
							update: itemsSortUpdate
                    	})
						.disableSelection();

					//remove many items
					remove_button.on('click', removeSelected);

                    //prepare bulk tag input
                    itemTags({
                        filter_container : bulk_taging,
                        single : false
                    });

					$(window).resize(debounce(setColumns, 250));

                    if(document.body.classList.contains( 'block-editor-page' )){
                        //fires after blocks in gutneberg are ready
                        const { select, subscribe } = wp.data;

                        const closeListener = subscribe( () => {
                            const isReady = select( 'core/editor' ).__unstableIsEditorReady();
                            if ( ! isReady ) {
                                // Editor not ready.
                                return;
                            }
                            // Close the listener as soon as we know we are ready to avoid an infinite loop.
                            closeListener();

                            // Your code is placed after this comment, once the editor is ready.
                            setColumns();
                        });
                    }


					//enable multi upload
                    mu_button.click(muUploadFile);

					//hide notice on click
					notice_area.click(hideNotice);

                }
            },

            compareDependency : function(dependency, possible_switches){
                var parent   = dependency[0],
                    operator = dependency[1],
                    value    = dependency[2],
                    parent_value = possible_switches.filter( '[name="'+G.input_prefix+parent+'"]' );

                //check if such input can be found
                if(parent_value.length){
                    //radio input? special work to do!
                    if(parent_value.is('[type="radio"]')){
                        parent_value = parent_value.filter(':checked').val();
                    }
                    //classic
                    else{
                        parent_value = parent_value.val()
                    }
                }
                else{
                    return false;
                }

                //check operators
                if(operator === '='){
                    return value === parent_value;
                }
                else if(operator === '!='){
                    return value !== parent_value;
                }

                //for all other operators
                return false;
            },

            checkDependencies : function(){
                var input   = $(this);
                if(input.is('.not-to-collect')){
                    return;
                }

                var name    = input.attr('name'),
                    id      = name.substr(G.input_prefix.length),
                    meta_areas = $('div.apollo13-metas'),
                    possible_switches = meta_areas.find('input[type="radio"], select, input[type="hidden"]'),
                    show_it;

                if(typeof G.list_of_dependent[id] !== 'undefined'){
                    //we check what fields are affected by changing current input
                    $.each(G.list_of_dependent[id], function(){
                        //looking for requirements for this fields
                        var dependency = G.list_of_requirements[this] || '',
                            field = meta_areas.find('[name="'+ G.input_prefix+this+'"]').closest('div.input-parent');

                        if(dependency.length){
                            show_it = true;
                            //we have more then one required condition
                            if(Array.isArray(dependency[0])){
                                for(var i = 0; i < dependency.length; i++ ){
                                    if(!A13FRAMEWORK_ADMIN.metaActions.compareDependency(dependency[i], possible_switches)){
                                        //some dependency were not met
                                        show_it = false;
                                        break;
                                    }
                                }
                            }
                            //we have only one required condition
                            else {
                                if(!A13FRAMEWORK_ADMIN.metaActions.compareDependency(dependency, possible_switches)){
                                    //dependency were not met
                                    show_it = false;
                                }
                            }

                            //show or hide
                            if(show_it){
                                field.show();
                            }
                            else{
                                field.hide();
                            }
                        }
                    });
                }
            }
        },

        settingsAction : function(){
            var a13_before_page_save = function(){
                //check if row shortcode was cloned - in case it has active nava settings - change timestamp to avoid problems
                var content_ifr = $('#content_ifr'),
                    content = content_ifr.length ? content_ifr.contents().find('#tinymce').html() : $('#content').val(),
                    matches1,
                    G = ApolloParams;

                if( typeof( content ) === 'undefined' ){
                    return true;
                }
                matches1 = content.match(/a13_nava_id="[^"]+"/g);
                //now search for anchor duplicates
                if( matches1 && matches1.length>0 ){
                    var sorted_arr1 = matches1.sort();
                    var duplicates1 = '';
                    for (var i = 0; i < matches1.length - 1; i++) {
                        if (sorted_arr1[i + 1] == sorted_arr1[i] && sorted_arr1[i] != 'a13_nava_id="-1"' ) {
                            duplicates1 = duplicates1 + G['nava'][sorted_arr1[i].match(/[0-9 -()+]+$/)[0].toString().replace('"','').replace('"','')] + ', ';
                        }
                    }

                    if ( duplicates1 != '' ) {
                        duplicates1 = duplicates1.substring(0,(duplicates1.length - 2));
                        alert(G['messages']['duplicate_nava_anchors']+' '+duplicates1);
                        return false;
                    }

                }

                return true;

            };

            A13FRAMEWORK_ADMIN.ratingNotice();
            A13FRAMEWORK_ADMIN.proofingNotice();
            A13FRAMEWORK_ADMIN.adminNotices();

            //save options button - back to current fieldset after reload
            $('input[name="theme_updated"]').click(function(){
                var I = $(this),
                    fieldset = I.parents('div.postbox').eq(0).attr('id'),
                    form = I.parents('form').eq(0);

                form.attr('action', '#'+fieldset); //insert anchor

            });

            //NAVA manipulations
            //deleting nava from vc_row shortcode edit panel
			$('#vc_ui-panel-edit-element').on('click','.a13_delete_selected_nava', function(){
                var post = $(this).closest('.edit_form_line').find('.a13_nava_id :selected');
                var id = post.val();

                if(confirm(G.messages.confirm_delete_nava)){
                    $.ajax({
                        type: 'post',
                        url: ApolloParams.ajaxurl,
                        data: {
                            action: 'apollo13framework_nava_delete_post',
                            id: id
                        },
                        success: function( result ) {
                            if( result == 'success' ) {
                                post.remove();
                            }
                        }
                    })
                }
                return false;
            } )

            //adding new nava from vc_row shortcode edit panel
            .on('keyup','.a13_new_nava_id', function(e){
                if( e.keyCode != 13){
                    return;
                }
                var name = jQuery(this).val();

                if( name == '' ){
                    return;
                }


                $.ajax({
                    type: 'post',
                    url: ApolloParams.ajaxurl,
                    data: {
                        action: 'apollo13framework_nava_add_post',
                        title: name
                    },
                    success: function( data ) {
                        $('.a13_nava_id').append('<option value="'+data.new_post_ID+'">'+name+'</option>').val(data.new_post_ID);
                        $('.a13_new_nava_id').val('');
                        G['nava'][data.new_post_ID] = data.new_post_title;
                    }
                });
                return false;
            } );

            //checking if there is no duplicate use of navigation anchors
            $body.on('click','#publish', a13_before_page_save );

        },

        ratingNotice : function(){
            var rating_notice = $('div.rating-notice');
            if(rating_notice.length){
                var later   = rating_notice.find('a[href="#remind-later"]'),
                    disable = rating_notice.find('a[href="#disable-rating"]'),
                    links = later.add(disable);

                links.on('click', function(e){
                    e.preventDefault();

                    rating_notice.hide().remove();

                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action : 'apollo13framework_rating_notice_action', //called in backend
                            what : $(this).attr('href').substr(1)//no hash
                        },
                        success: function(reply) {
                            //console.log(reply);
                        },
                        dataType: 'html'
                    });
                });


            }
        },

        proofingNotice : function(){
            var proofing_notice = $('div#proofing-notice');
            if(proofing_notice.length){
                $('#hide-proof-notice').on('click', function(e){
                    e.preventDefault();

                    proofing_notice.hide().remove();

                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action : 'apollo13framework_proofing_notice_action' //called in backend
                        },
                        success: function(reply) {
                            //console.log(reply);
                        },
                        dataType: 'html'
                    });
                });


            }
        },

        adminNotices : function(){
            var notices = $('div.a13fe-admin-notice');
            if(notices.length){
                notices.on('click', '.notice-dismiss', function(e){
                    e.preventDefault();

                    var notice = $(this).parents('div.notice').eq(0);

                    notice.hide().remove();

                    $.ajax({
                        type: "POST",
                        url: G.ajaxurl,
                        data: {
                            action : 'apollo13framework_disable_ajax_notice', //called in backend
                            notice_id : notice.data('notice_id')
                        },
                        success: function(reply) {
                            //console.log(reply);
                        },
                        dataType: 'html'
                    });
                });
            }
        }
    };

    var A13FRAMEWORK_ADMIN = window.A13FRAMEWORK_ADMIN;

    //start ADMIN
    $(document).ready(A13FRAMEWORK_ADMIN.onReady);

})(jQuery);