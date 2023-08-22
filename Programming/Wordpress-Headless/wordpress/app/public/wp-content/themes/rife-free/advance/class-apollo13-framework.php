<?php

/**
 * Framework class, to keep all settings encapsulated
 * Access to this singleton is via global $apollo13framework_a13
 */
class Apollo13Framework
{

    /**
     * current theme settings
     * @var array
     */
    private $theme_options = array();

    /**
     * Array of meta fields that depends on global settings
     * @var array
     */
    private $parents_of_meta = array();

    /**
     * sets of settings to be used across theme & plugins
     * @since 2.3.0
     * @var array
     */
    private $settings_set = array();

    /**
     * structure of customizer panels, sections & fields
     * @var array
     */
    private $customizer_sections = array();

    /**
     * all default values for theme options
     * @var array
     */
    public $theme_options_defaults = array();

    /**
     * Array of default values of meta fields on current screen
     * @var array
     */
    public $defaults_of_meta = array();

    /**
     * Switch if CSS from theme options should be rebuild
     * @var bool
     */
    private $reset_user_css = false;

    /**
     * Used while saving options to compare CPT rewrites slugs
     * @var array
     */
    private $pre_save_slugs = array();


    /**
     * kind of constructor
     */
    function start()
    {
        /**
         * Define bunch of helpful paths and settings
         */
        define('A13FRAMEWORK_TPL_SLUG', 'rife-free');//it is not always same as directory of theme
        define('A13FRAMEWORK_OPTIONS_NAME_PART', 'Rife Free');
        define('A13FRAMEWORK_THEME_ID_NUMBER', '66');
        define('A13FRAMEWORK_OPTIONS_NAME', 'apollo13_option_rife');
        define('A13FRAMEWORK_CACHE', 'apollo13_rife_cache');
        define('A13FRAMEWORK_THEME_VERSION', '2.4.16.1');
        define('A13FRAMEWORK_THEME_VER', A13FRAMEWORK_THEME_VERSION ); //legacy - do not use
        define('A13FRAMEWORK_MIN_COMPANION_VERSION', '1.9.0');
        define('A13FRAMEWORK_MIN_PHP_VERSION', '5.3');
        define('A13FRAMEWORK_MIN_WP_VERSION', '4.7');

        //theme root
        define('A13FRAMEWORK_TPL_URI', get_template_directory_uri());

        //plugins recommended by theme
        define('A13FRAMEWORK_TPL_PLUGINS', A13FRAMEWORK_TPL_URI . '/advance/plugins');
        define('A13FRAMEWORK_TPL_PLUGINS_DIR', get_template_directory() . '/advance/plugins');

        //custom post type settings
        define('A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM', 'album');
//		define('A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM_SLUG', 'album'); //just to show it also exist - defined in real a bit lower
        define('A13FRAMEWORK_CUSTOM_POST_TYPE_WORK', 'work');
//		define('A13FRAMEWORK_CUSTOM_POST_TYPE_WORK_SLUG', 'work'); //just to show it also exist - defined in real a bit lower
        define('A13FRAMEWORK_CUSTOM_POST_TYPE_NAV_A', 'nava');
        define('A13FRAMEWORK_CUSTOM_POST_TYPE_PEOPLE', 'people');
        define('A13FRAMEWORK_CPT_WORK_TAXONOMY', 'work_genre');
        define('A13FRAMEWORK_CPT_ALBUM_TAXONOMY', 'genre');
        define('A13FRAMEWORK_CPT_PEOPLE_TAXONOMY', 'group');

        //misc theme globals
        define('A13FRAMEWORK_INPUT_PREFIX', 'a13_');
        define('A13FRAMEWORK_CONTENT_WIDTH', 800);

        //check minimal requirements for WordPress and PHP
        if (
            version_compare( $GLOBALS['wp_version'], A13FRAMEWORK_MIN_WP_VERSION, '<' )
            ||
            version_compare( PHP_VERSION, A13FRAMEWORK_MIN_PHP_VERSION, '<' )
        ) {
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/compatibility.php' ));
            //no further processing
            return;
        }


        // ADD CUSTOMIZER SUPPORT
        if( is_customize_preview() ){
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/customizer.php' ));
            add_action( 'wp_loaded', array( $this, 'customizer_wp_loaded' ) );
            //before save
            add_action('customize_save', array($this, 'customizer_customize_save_before'));
            //perform option save while using customizer
            add_action('customize_save_after', array($this, 'customizer_customize_save_after'));
        }


        // ADMIN PART
        if ( is_admin() ) {
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/admin/admin.php' ) );
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/admin/metaboxes.php' ) );
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/meta.php') );
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/admin/print-options.php' ) );


            // ADD ADMIN THEME PAGES
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/admin/apollo13-pages.php' ));
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/admin/apollo13-pages-functions.php' ));


            // FUNCTION FOR MANAGING ALBUMS/WORKS
            /** @noinspection PhpIncludeInspection */
            require_once(get_theme_file_path( 'advance/cpt-admin.php'));

            //ADD EXTERNAL PLUGINS
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/inc/class-tgm-plugin-activation.php'));
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/plugins/plugins-list.php' ) );

            // Warnings and notices that only admin should handle
            if (current_user_can('update_core')) {
                add_action( 'admin_notices', array(&$this, 'check_for_warnings') );
            }
        }

        // THEME FRONT-END SCRIPTS & STYLES
        /** @noinspection PhpIncludeInspection */
        require_once(get_theme_file_path( 'advance/head-scripts-styles.php'));

        //special files depending on framework generator needs
        $file_to_test = get_theme_file_path( 'advance/envy.php' );
        if( is_file( $file_to_test ) ){
            /** @noinspection PhpIncludeInspection */
            require_once $file_to_test;
        }
        $file_to_test = get_theme_file_path( 'advance/rife.php' );
        if( is_file( $file_to_test ) ){
            /** @noinspection PhpIncludeInspection */
            require_once $file_to_test;
        }

        // UTILITIES
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/core.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/core_fe.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/menu.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/media.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/posts.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/layout-parts.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/header.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/footer.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/password.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/feature.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/cpt.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/cpt-album.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/cpt-work.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/cpt-people.php' ) );
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/utilities/deprecated.php' ) );

        //WPML
        if(defined( 'ICL_SITEPRESS_VERSION')){
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/utilities/wpml.php' ) );
        }
        //WOOCOMMERCE
        if(apollo13framework_is_woocommerce_activated()){
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/utilities/woocommerce.php' ) );
        }

        $this->prepare_theme_vars();

        //define Theme constants after getting theme options
        define( 'A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM_SLUG', $this->get_option('cpt_post_type_album') );
        define( 'A13FRAMEWORK_CUSTOM_POST_TYPE_WORK_SLUG', $this->get_option('cpt_post_type_work') );

        // ADD WPBakery Page Builder ADDONS
        if ( defined( 'WPB_VC_VERSION' ) ){
            //since VC 5.5.2 it should be load always
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/vc-extend.php' ) );
        }

        //support for Elementor Pro locations
        if ( defined( 'ELEMENTOR_PRO_VERSION' ) ){
            /** @noinspection PhpIncludeInspection */
            require_once( get_theme_file_path( 'advance/elementor-pro.php' ) );
        }

        // ADD SIDEBARS
        /** @noinspection PhpIncludeInspection */
        require_once(get_theme_file_path( 'advance/sidebars.php'));

        // AFTER SETUP(supports for thumbnails, menus, languages, RSS etc.)
        add_action('after_setup_theme', array(&$this, 'setup'));
    }

    /**
     * registers panels, sections & fields for customizer. Prepares default values for theme options
     *
     * @param $section array of panel details OR section details & fields
     */
    function set_sections($section){
        /**
         * @since 2.3.0
         */
        do_action( 'apollo13framework_options_before_'.$section['id'] );

        //we need whole structure only when customizer is used
        if(is_customize_preview()){
            //section
            if(isset($section['subsection'])){
                end($this->customizer_sections);
                $key = key($this->customizer_sections);
                $this->customizer_sections[$key]['sections'][] = $section;
            }
            //panel
            else{
                $this->customizer_sections[] = $section;
            }
        }

        //collect default values
        if(isset($section['fields']) && is_array($section['fields']) && ! empty( $section['fields'] )){
            foreach($section['fields'] as $params ){
                //if we don't have such default yet, use default defined in framework
                if( !array_key_exists($params['id'], $this->theme_options_defaults) ){
                    $this->theme_options_defaults[$params['id']] = isset($params['default'])? $params['default'] : '';
                }
            }
        }

        /**
         * @since 2.3.0
         */
        do_action( 'apollo13framework_options_after_'.$section['id'] );
    }


    /**
     * returns panels, sections & fields for customizer
     */
    function get_sections(){
        return $this->customizer_sections;
    }


    /**
     * Set predefined set of settings for later use
     *
     * @param $set string set name
     * @param $values array array of set values
     *
     * @return array
     */
    function set_settings_set($set, $values){
        return $this->settings_set[$set] = $values;
    }

    /**
     * Returns predefined set of settings
     * @since 2.3.0
     */
    function get_settings_set($set){
        return $this->settings_set[$set];
    }


    /**
     * used in customizer to prepare settings after refresh in customizer
     */
    function customizer_wp_loaded() {
        $this->theme_options = get_option(A13FRAMEWORK_OPTIONS_NAME);
        $this->load_options();
    }

    /**
     * What to do before saving in customizer
     */
    function customizer_customize_save_before()
    {
        //get old set of options
        $this->theme_options = get_option(A13FRAMEWORK_OPTIONS_NAME);
        $this->load_options();

        //remember what are slugs before save
        $this->pre_save_slugs['album'] = $this->get_option('cpt_post_type_album');
        $this->pre_save_slugs['work'] = $this->get_option('cpt_post_type_work');
    }

    /**
     * Refresh options and generate user.css file after save in customizer
     */
    function customizer_customize_save_after()
    {
        //get new set of options
        $this->theme_options = get_option(A13FRAMEWORK_OPTIONS_NAME);
        $this->load_options();

        do_action( 'apollo13framework_generate_user_css' );

        //check slugs after save
        $pre_save_album   = $this->pre_save_slugs['album'];
        $pre_save_work    = $this->pre_save_slugs['work'];
        $after_save_album = $this->get_option( 'cpt_post_type_album' );
        $after_save_work  = $this->get_option( 'cpt_post_type_work' );

        //compare slugs and flush if there is a difference
        if( !($pre_save_album === $after_save_album && $pre_save_work === $after_save_work) ){
            //write option to force rewrite flush
            update_option('a13_force_to_flush','on');
        }

        //refresh cache
        delete_option(A13FRAMEWORK_CACHE);
    }

    /**
     * Various setup actions for setting up theme for WordPress
     */
    function setup()
    {
        global $content_width;
        //content width
        if (!isset($content_width)) {
            $content_width = A13FRAMEWORK_CONTENT_WIDTH;
        }


        if (
            //forced refresh
            $this->reset_user_css ||
            //on fresh theme install
            ( function_exists('a13fe_user_css_name') && ! file_exists( a13fe_user_css_name() ) ) ||
            //or customizer update after giving creds to FTP
             (is_admin() && get_option('a13_user_css_update') === 'on')
        ) {
            do_action( 'apollo13framework_generate_user_css' );
        }



        //LANGUAGE
        load_theme_textdomain( 'rife-free', get_theme_file_path( 'languages' ) );

        //remove admin bar bump
        add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

        // Featured image support
        add_theme_support('post-thumbnails');

        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        //Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Add post formats
        add_theme_support('post-formats', array(
            'aside',
            'chat',
            'gallery',
            'image',
            'link',
            'quote',
            'status',
            'video',
            'audio'
        ));

        // Switches default core markup for search form, comment form, and comments
        // to output valid HTML5.
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

        // WooCommerce support
        add_theme_support('woocommerce');
        //new thumbs in WooCommerce 3.0.0
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //below thing doesn't exist, it is left here for reference
        //our menu are NOT reloaded partially cause we use custom Walker, and then Customizer uses full refresh

        add_theme_support( 'custom-logo', array(
            'height'      => 75,
            'width'       => 200,
            'flex-height' => true,
            'flex-width'  => true
        ) );

        add_image_size( 'a13_navigation_image_size', 245, 100, true );


        //add_theme_support( 'customize-selective-refresh-menus' );

        //Header Footer Elementor Plugin support
        add_theme_support( 'header-footer-elementor' );

        //no support for block based widgets WordPress 5.8 and above
        remove_theme_support( 'widgets-block-editor' );

        // Register custom menu positions
        register_nav_menus(array(
            'header-menu' => __( 'Site Navigation', 'rife-free' ),
            'top-bar-menu' => __( 'Alternative short top bar menu', 'rife-free' ),
        ));
    }

    /**
     * Function for warnings that should be displayed in admin area
     */
    function check_for_warnings()
    {
        $notices = array();
        $valid_tags = array(
            'a' => array(
                'href' => array(),
            ),
        );
        // Notice if dir for user settings is no writable

        //NOTICE IF CPT SLUG IS TAKEN
        // albums
        $r = new WP_Query(array('post_type' => array('post', 'page'), 'name' => A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM_SLUG));
        if ($r->have_posts() && strlen(A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM_SLUG) && defined('A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM')) {
            $post_type_details = get_post_type_object( A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM );
            /* translators: %1$s: Post type name, %2$s: URL */
            $notices['albums-slug'] = sprintf( __( 'Warning - slug reserved for %1$s post type is used by some post or page. It may cause problems with reaching some of your content. You should change slug of <a href="%2$s">this post</a> to make sure everything will work proper.', 'rife-free' ), $post_type_details->label, esc_url( site_url( '/' . A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM_SLUG ) ) );
        }
        // Reset the global $the_post as this query have stomped on it
        wp_reset_postdata();

        // works
        $r = new WP_Query(array('post_type' => array('post', 'page'), 'name' => A13FRAMEWORK_CUSTOM_POST_TYPE_WORK_SLUG));
        if ($r->have_posts() && strlen(A13FRAMEWORK_CUSTOM_POST_TYPE_WORK_SLUG) && defined('A13FRAMEWORK_CUSTOM_POST_TYPE_WORK')) {
            $post_type_details = get_post_type_object( A13FRAMEWORK_CUSTOM_POST_TYPE_WORK );
            /* translators: %1$s: Post type name, %2$s: URL */
            $notices['works-slug'] = sprintf( __( 'Warning - slug reserved for %1$s post type is used by some post or page. It may cause problems with reaching some of your content. You should change slug of <a href="%2$s">this post</a> to make sure everything will work proper.', 'rife-free' ), $post_type_details->label, esc_url( site_url( '/' . A13FRAMEWORK_CUSTOM_POST_TYPE_WORK_SLUG ) ) );
        }
        // Reset the global $the_post as this query have stomped on it
        wp_reset_postdata();

        // Display all error notices
        foreach ($notices as $id => $notice) {
            //show notice only if it wasn't dismissed by user
            if( !apollo13framework_is_admin_notice_active($id) ){
                continue;
            }
            echo '<div class="a13fe-admin-notice notice notice-error is-dismissible" data-notice_id="'.esc_attr($id).'"><p>' . wp_kses( $notice, $valid_tags ) . '</p></div>';
        }

        do_action( 'apollo13framework_theme_notices' );
    }

    /**
     * Prepare all theme settings to be ready for read
     */
    public function load_options()
    {
        //prepare custom sidebars
        if ( isset($this->theme_options['custom_sidebars']) && is_array($this->theme_options['custom_sidebars'])) {
            $tmp = array();
            foreach ($this->theme_options['custom_sidebars'] as $id => $sidebar) {
                //skip if left empty or not set name
                if($sidebar === NULL || strlen($sidebar) === 0){
                    continue;
                }
                array_push($tmp, array('id' => 'apollo13-sidebar_' . (1 + $id), 'name' => $sidebar));
            }
            $this->theme_options['custom_sidebars'] = $tmp;
        }
        else{
            $this->theme_options['custom_sidebars'] = array();
        }

        //fill missing options with defaults
        foreach($this->theme_options_defaults as $id => $value ){
            if(!array_key_exists($id, $this->theme_options)){
                $this->theme_options[$id] = $value;
            }
        }

        //in customizer or importer we need defaults for longer
        if( !is_admin() && !is_customize_preview() ){
            //save memory
            unset($this->theme_options_defaults );
        }

        //finally loaded options
    }

    /**
     * Overwrite current theme settings
     *
     * @param array $overload_options options we want to set
     */
    public function set_options( $overload_options = array() )
    {
        if( is_array($overload_options) && count($overload_options) > 0){
            update_option(A13FRAMEWORK_OPTIONS_NAME, $overload_options);

            $this->theme_options = $overload_options;

            //refresh
            $this->load_options();

            //refresh cache
            delete_option(A13FRAMEWORK_CACHE);
        }
    }

    /**
     * Get one of theme settings
     *
     * @param string $index   setting id
     *
     * @param string $default default setting when option is not present
     *
     * @param bool   $filter should filter be used
     *
     * @return mixed
     */
    public function get_option($index, $default = '', $filter = true)
    {
        $option_to_return = $default;
        if ($index != '' && isset($this->theme_options[$index])) {
            $option_to_return = $this->theme_options[$index];
        }

        //for customizer we don't use filters as it mess controls behaviour.
        //JavaScript can't know about changes in filters, so it hides/shows options, and PHP then reverts this cause of filter actions
        //good and only example is vertical header in boxed layout
        if(!$filter){
            return $option_to_return;
        }
        //apply filters to returned value if some special treating is needed
        return apply_filters('a13_options_'.$index, $option_to_return );
    }

    /**
     * Get url only from media type theme setting
     *
     * @param string $index setting id
     *
     * @return string URL
     */
    public function get_option_media_url($index)
    {
        $option = $this->get_option($index);
        if (is_array($option)) {
            if (isset($option['url'])) {
                return $option['url']; //we got URL
            } else {
                return ''; //empty string as it is probably not set yet
            }
        }
        elseif( is_string($option) && ( strlen($option) > 0 ) ){
            if(strncmp($option, "http", 4) !== 0){
                //make absolute path of possibly relative path(used for starer data)
                $option = A13FRAMEWORK_TPL_URI . $option;
            }
        }

        return $option;//not an array? then probably it is saved as string
    }


    /**
     * Get rgba only from color type theme setting
     *
     * @param string $index setting_id
     *
     * @return string URL
     */
    public function get_option_color_rgba( $index )
    {
        $option = $this->get_option( $index );
        if ( is_array( $option ) ) {
            if ( isset( $option['rgba'] ) ) {
                return $option['rgba']; //we got RGBA
            } elseif ( isset( $option['color'] ) && isset( $option['alpha'] ) ) {
                return apollo13framework_hex2rgba( $option['color'], $option['alpha'] ); //we got RGBA
            } else {
                return ''; //empty string as it is probably not set yet
            }
        }

        return $option;//not an array? then probably it is saved as string
    }

    /**
     * Get all settings. Used for exporting theme options
     *
     * @return array
     */
    public function get_options_array()
    {
        return $this->theme_options;
    }



    /**
     * Get all settings. Used for exporting theme options
     *
     * @return array
     */
    public function prepare_options_array()
    {
        //set defaults values for all fields from theme specific defaults
        $file = get_theme_file_path( 'default-settings/default.php');
        if(file_exists($file)){
            /** @noinspection PhpIncludeInspection */
            $file_contents = include $file;
            $options = json_decode($file_contents, true);

            //SET THEME OPTIONS without saving to database
            $this->theme_options_defaults = $options;
        }

        //collect sections & framework defaults
        /** @noinspection PhpIncludeInspection */
        require_once( get_theme_file_path( 'advance/theme-options.php') );

        //set default setting if there is none(fresh install)
        if($this->theme_options === false){
            $this->theme_options = $this->theme_options_defaults;
            $this->load_options();
            $this->reset_user_css = true;
        }
        //normal flow, setup options
        else{
            $this->load_options();
        }
    }

    /**
     * Prepares var $parents_of_meta
     */
    private function collect_meta_parents()
    {
        /** @noinspection PhpIncludeInspection */
        require_once(get_theme_file_path( 'advance/meta.php'));

        $option_func = array(
            'post',
            'page',
            'album',
            'work',
            'people',
//            'images_manager' //no parent options here
        );

        foreach ($option_func as $function) {
            $function_to_call = 'apollo13framework_meta_boxes_' . $function;
            $family = str_replace('_layout', '', $function); //for consistent families

            if(function_exists($function_to_call)){
                foreach ( $function_to_call() as $meta_tab ) {
                    foreach( $meta_tab as $meta ) {
                        if (isset($meta['global_value'])) {
                            $this->parents_of_meta[$family][$meta['id']]['global_value'] = $meta['global_value'];
                        }
                        if (isset($meta['parent_option'])) {
                            $this->parents_of_meta[$family][$meta['id']]['parent_option'] = $meta['parent_option'];
                        }
                    }
                }
            }
        }
    }

    /**
     * Prepares list off all meta fields that have visibility dependencies and second list of possible switches with dependent fields
     */
    public function get_meta_required_array() {
        global $pagenow;
        $list_of_requirements = array();
        $list_of_dependent    = array();
        $meta_boxes           = array();


        $post_type = '';
        if ('post.php' == $pagenow && isset($_GET['post']) ) {
            // Will occur only in this kind of screen: /wp-admin/post.php?post=285&action=edit
            // and it can be a Post, a Page or a CPT
            $post_type = get_post_type( sanitize_text_field( wp_unslash( $_GET['post'] ) ) );
        }
        //if it is "new post" page
        elseif('post-new.php' == $pagenow ) {
            $post_type = isset($_GET['post_type']) ? sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) : 'post';
        }

        if(strlen($post_type)){
            switch ( $post_type ) {
                case 'post':
                    $meta_boxes = apollo13framework_meta_boxes_post();
                    break;
                case 'page':
                    $meta_boxes = apollo13framework_meta_boxes_page();
                    break;
                case A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM:
                    $meta_boxes = array_merge( apollo13framework_meta_boxes_album(), apollo13framework_meta_boxes_images_manager() );
                    break;
                case A13FRAMEWORK_CUSTOM_POST_TYPE_WORK:
                    $meta_boxes = array_merge( apollo13framework_meta_boxes_work(), apollo13framework_meta_boxes_images_manager() );
                    break;
            }

            foreach ( $meta_boxes as $meta_tab ) {
                foreach( $meta_tab as $meta ) {
                    //check is it prototype
                    if ( isset( $meta['required'] ) ) {
                        $required = $meta['required'];

                        //fill list of required condition for each control
                        $list_of_requirements[ $meta['id'] ] = $required;

                        //fill list of controls that activate/deactivate other
                        //we have more then one required condition
                        if(is_array($required[0]) ){
                            foreach($required as $dependency){
                                $list_of_dependent[$dependency[0]][] = $meta['id'];
                            }
                        }
                        //we have only one required condition
                        else{
                            $list_of_dependent[$required[0]][] = $meta['id'];
                        }
                    }
                }
            }
        }

        return array($list_of_requirements, $list_of_dependent);
    }

    public function prepare_theme_vars(){
        $cache = get_option( A13FRAMEWORK_CACHE );

        if( is_customize_preview() ){
            //load textdomain early as we optimize reading of options file
            load_theme_textdomain( 'rife-free', get_theme_file_path( 'languages' ) );

            $this->prepare_options_array();
            $this->collect_meta_parents();
        }
        //cache miss or translation plugin is active(WPML or Polylang)
        elseif( $cache === false || $cache['version'] !== A13FRAMEWORK_THEME_VERSION || defined( 'ICL_SITEPRESS_VERSION') || defined( 'POLYLANG_BASENAME' ) ){
            //get theme options from database
            $this->theme_options = get_option(A13FRAMEWORK_OPTIONS_NAME);

            //fresh install
            if($this->theme_options === false ){
                $this->prepare_options_array();
                $this->collect_meta_parents();
            }
            //normal flow
            else{
                $this->prepare_options_array();
                $this->collect_meta_parents();

                //cache collected values
                $cache = array(
                    'options' => $this->theme_options,
                    'meta'    => $this->parents_of_meta,
                    'version' => A13FRAMEWORK_THEME_VERSION
                );

                //save cache
                update_option( A13FRAMEWORK_CACHE, $cache );
            }
        }
        //cache hit
        else{
            $this->theme_options = $cache['options'];
            $this->parents_of_meta = $cache['meta'];
        }
    }

    /**
     * Retrieves meta setting with checking for parent settings, and global settings
     *
     * @param string $field name of meta setting
     * @param bool|false $id ID of post. If not passed it will try to get one for current loop
     *
     * @return bool|mixed|null|string field value
     */
    function get_meta($field, $id = false)
    {
        $family = '';

        if (!$id && apollo13framework_is_no_property_page()) {
            return null; //we can't get meta field for that page
        } else {
            if (!$id) {
                $id = get_the_ID();
            }

            $meta = trim(get_post_meta($id, $field, true));
        }

        if ($id) {
            $post_type = get_post_type($id);
            //get family to check for parent option
            if ($post_type == A13FRAMEWORK_CUSTOM_POST_TYPE_ALBUM) {
                $family = 'album';
            } else if ($post_type == A13FRAMEWORK_CUSTOM_POST_TYPE_WORK) {
                $family = 'work';
            } elseif ($post_type === 'page' ) {
                $family = 'page';
            } elseif (is_single($id)) {
                $family = 'post';
            }

            $field = substr($field, 1); //remove '_'

            //if has any parent
            if (isset($this->parents_of_meta[$family][$field])) {
                $parent = $this->parents_of_meta[$family][$field];

                //meta points to global setting
                if (isset($parent['global_value']) && ($meta == $parent['global_value'] || strlen($meta) == 0)) {
                    if (isset($parent['parent_option'])) {
                        $meta = $this->get_option($parent['parent_option']);
                    }
                }
            }

            return $meta;
        }

        return false;
    }

    /**
     * Returns list of all available in theme social icons with need additional info
     *
     * @param string $what - what should array consist of:
     *                     names    : Readable names
     *                     classes  : CSS classes used on front-end
     *                     empty    : only IDs are returned
     *
     * @return array requested list of social icons
     */
    function get_social_icons_list($what = 'names'){
        $icons = array(
            /* id         => array(class, label)*/
            '500px'       => array( 'fa fa-500px', '500px' ),
            'behance'     => array( 'fa fa-behance', 'Behance' ),
            'bitbucket'   => array( 'fa fa-bitbucket', 'Bitbucket' ),
            'codepen'     => array( 'fa fa-codepen', 'CodePen' ),
            'delicious'   => array( 'fa fa-delicious', 'Delicious' ),
            'deviantart'  => array( 'fa fa-deviantart', 'Deviantart' ),
            'digg'        => array( 'fa fa-digg', 'Digg' ),
            'dribbble'    => array( 'fa fa-dribbble', 'Dribbble' ),
            'dropbox'     => array( 'fa fa-dropbox', 'Dropbox' ),
            'mailto'      => array( 'fa fa-envelope-o', 'E-mail' ),
            'facebook'    => array( 'fa fa-facebook', 'Facebook' ),
            'flickr'      => array( 'fa fa-flickr', 'Flickr' ),
            'foursquare'  => array( 'fa fa-foursquare', 'Foursquare' ),
            'github'      => array( 'fa fa-git', 'Github' ),
            'googleplus'  => array( 'fa fa-google-plus', 'Google Plus' ),
            'instagram'   => array( 'fa fa-instagram', 'Instagram' ),
            'lastfm'      => array( 'fa fa-lastfm', 'Lastfm' ),
            'linkedin'    => array( 'fa fa-linkedin', 'Linkedin' ),
            'messenger'   => array( 'fab fa-facebook-messenger', 'Facebook Messenger' ),
            'paypal'      => array( 'fa fa-paypal', 'Paypal' ),
            'pinterest'   => array( 'fa fa-pinterest-p', 'Pinterest' ),
            'reddit'      => array( 'fa fa-reddit-alien', 'Reddit' ),
            'rss'         => array( 'fa fa-rss', 'RSS' ),
            'sharethis'   => array( 'fa fa-share-alt', 'Sharethis' ),
            'skype'       => array( 'fa fa-skype', 'Skype' ),
            'slack'       => array( 'fa fa-slack', 'Slack' ),
            'snapchat'    => array( 'fa fa-snapchat-ghost', 'Snapchat' ),
            'spotify'     => array( 'fa fa-spotify', 'Spotify' ),
            'steam'       => array( 'fa fa-steam', 'Steam' ),
            'stumbleupon' => array( 'fa fa-stumbleupon', 'Stumbleupon' ),
            'telegram'    => array( 'fa fa-telegram', 'Telegram' ),
            'tripadvisor' => array( 'fa fa-tripadvisor', 'TripAdvisor' ),
            'tumblr'      => array( 'fa fa-tumblr', 'Tumblr' ),
            'twitter'     => array( 'fa fa-twitter', 'Twitter' ),
            'viadeo'      => array( 'fa fa-viadeo', 'Viadeo' ),
            'vimeo'       => array( 'fa fa-vimeo', 'Vimeo' ),
            'vine'        => array( 'fa fa-vine', 'Vine' ),
            'vkontakte'   => array( 'fa fa-vk', 'VKontakte' ),
            'whatsapp'    => array( 'fa fa-whatsapp', 'Whatsapp' ),
            'wordpress'   => array( 'fa fa-wordpress', 'WordPress' ),
            'xing'        => array( 'fa fa-xing', 'Xing' ),
            'yahoo'       => array( 'fa fa-yahoo', 'Yahoo' ),
            'yelp'        => array( 'fa fa-yelp', 'Yelp' ),
            'youtube'     => array( 'fa fa-youtube', 'YouTube' ),
        );

        $icons = apply_filters('apollo13framework_social_icons_list', $icons );

        /* SAMPLE USAGE */
        /*
        add_filter('apollo13framework_social_icons_list', function($icons){
            $icons['youtube']     =  array( 'fa fa-youtube-play', 'Youtube' );
            $icons['new_service'] =  array( 'fa fa-star', 'My social' );

            return $icons;
        });
         *
        */

        $result = array();

        //return classes
        if($what === 'classes'){
            foreach( $icons as $id => $icon ){
                $result[$id] = $icon[0];
            }
        }

        //empty values
        elseif($what === 'empty'){
            foreach( $icons as $id => $icon ){
                $result[$id] = '';
            }
        }

        //return names
        else{
            foreach( $icons as $id => $icon ){
                $result[$id] = $icon[1];
            }
        }

        return $result;
    }


    function get_standard_fonts_list(){
        return array(
            "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif" => "System Font(Native)",
            "Arial, Helvetica, sans-serif"                                                        => "Arial",
            "'Arial Black', Gadget, sans-serif"                                                   => "Arial Black",
            "'Bookman Old Style', serif"                                                          => "Bookman Old Style",
            "'Comic Sans MS', cursive"                                                            => "Comic Sans MS",
            "Courier, monospace"                                                                  => "Courier",
            "Garamond, serif"                                                                     => "Garamond",
            "Georgia, serif"                                                                      => "Georgia",
            "Impact, Charcoal, sans-serif"                                                        => "Impact",
            "'Lucida Console', Monaco, monospace"                                                 => "Lucida Console",
            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"                                  => "Lucida Sans Unicode",
            "'MS Sans Serif', Geneva, sans-serif"                                                 => "MS Sans Serif",
            "'MS Serif', 'New York', sans-serif"                                                  => "MS Serif",
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif"                                => "Palatino Linotype",
            "Tahoma,Geneva, sans-serif"                                                           => "Tahoma",
            "'Times New Roman', Times,serif"                                                      => "Times New Roman",
            "'Trebuchet MS', Helvetica, sans-serif"                                               => "Trebuchet MS",
            "Verdana, Geneva, sans-serif"                                                         => "Verdana",
        );
    }

    function check_for_valid_license(){
        return apply_filters('apollo13framework_valid_license', false);
    }

    function check_is_import_allowed(){
        return apply_filters('apollo13framework_is_import_allowed', $this->check_for_valid_license());
    }

    function register_new_license_code($code){
        $out = array();
        return apply_filters('apollo13framework_register_license', $out, $code);
    }

    function get_license_code(){
        return apply_filters('apollo13framework_get_license', false);
    }

    function get_docs_link($location = ''){
        $locations = apply_filters( 'apollo13framework_docs_locations', array(
            'license-code'           => 'docs/getting-started/where-i-can-find-license-code/',
            'header-color-variants'  => 'docs/customizing-the-theme/header/variant-light-dark-overwrites/',
            'importer-configuration' => 'docs/installation-updating/importing-designs/importer-configuration/',
            'export'                 => 'docs/installation-updating/exporting-theme-options/',
        ) );

        if(strlen($location) && array_key_exists($location, $locations)){
            $location = $locations[$location];
        }

        return apply_filters('apollo13framework_docs_address', 'https://rifetheme.com/apollo13-framework/').$location;
    }

    function is_companion_plugin_ready($fail_message = false, $silent = false){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        //just in case have these files included
        require_once(ABSPATH . '/wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/template.php');

        $plugin_slug = 'apollo13-framework-extensions';
        $plugin_file = 'apollo13-framework-extensions.php';
        $plugin_path = $plugin_slug.'/'.$plugin_file;
        $plugins = get_plugins('/'.$plugin_slug);
        $ready = true;

        //not installed yet plugin
        if ( empty( $plugins[$plugin_file] ) ) {
            $ready = false;

            //we can install it normally
            if ( get_filesystem_method( array(), WP_PLUGIN_DIR ) === 'direct' ) {
                wp_enqueue_script( 'updates' );
                $classes =  ' install-now';
                $href = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='.esc_attr($plugin_slug) ), 'install-plugin_'.esc_attr($plugin_slug) );
            }
            //we need data from user to install plugin
            else{
                $tgm = TGM_Plugin_Activation::get_instance();
                $href = $tgm->get_tgmpa_url();
            }
            $label = __( 'Install', 'rife-free' ) . ' : ' . __( 'Apollo13 Framework Extensions', 'rife-free' );
        }

        //not active
        elseif ( is_plugin_inactive( $plugin_path ) ){
            $ready = false;

            wp_enqueue_script( 'updates' );
            $classes =  ' activate-now';
            $href = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin='.esc_attr($plugin_path) ), 'activate-plugin_'.esc_attr($plugin_path) );
            $label = __( 'Activate', 'rife-free' ) . ' : ' . __( 'Apollo13 Framework Extensions', 'rife-free' );
        }

        //not up to date
        elseif( version_compare( $plugins[$plugin_file]['Version'], A13FRAMEWORK_MIN_COMPANION_VERSION, '<'  ) ){
            $ready = false;
            wp_enqueue_script( 'updates' );
            $classes =  ' update-now';
            $href = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin='.esc_attr($plugin_path) ), 'upgrade-plugin_'.esc_attr($plugin_path) );
            $label = __( 'Update', 'rife-free' ) . ' : ' . __( 'Apollo13 Framework Extensions', 'rife-free' );
        }

        if(!$ready && !$silent){
            $message = $fail_message ? $fail_message : __( 'This feature requires Apollo13 Framework Extensions plugin to be active and in the proper version.', 'rife-free' );

            echo '<p class="center">'.esc_html($message).'</p>';
            /** @noinspection PhpUndefinedVariableInspection */
            echo '
    <div class="plugin-card-apollo13-framework-extensions center">
        <a class="button button-primary button-hero'.esc_attr($classes).'" '.
                 'href="'.esc_url( $href ).'" '.
                 'data-slug="'.esc_attr($plugin_slug).'" '.
                 'data-plugin="'.esc_attr($plugin_path).'" '.
                 '>'.
                 esc_html($label).
         '</a></div>';
        }

        return $ready;
    }
}
