<?php
if(!function_exists('apollo13framework_password_form')){
	/**
	 * Modify password form
	 *
     * @return string new HTML
     */
    function apollo13framework_password_form() {
        //copy of function get_the_password_form() from \wp-includes\post-template.php ~1570
        //with small changes
        return
            '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
            <p class="inputs"><input name="post_password" type="password" size="20" placeholder="' . esc_attr__( 'password', 'rife-free' ) . '" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'rife-free' ) . '" /></p>
            </form>
            ';
    }
}



if(!function_exists('apollo13framework_custom_password_form')){
	/**
	 * Print password page template
	 *
     * @return string HTML
     */
    function apollo13framework_custom_password_form() {
        //we get template to buffer and return it so other filters can do something with it
        ob_start();
        get_template_part('password-template');
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
add_filter( 'the_password_form', 'apollo13framework_custom_password_form');



if(!function_exists('apollo13framework_custom_password_form')){
	/**
	 * Print password page template
	 *
     * @return string HTML
     */
    function apollo13framework_custom_password_form() {
        //we get template to buffer and return it so other filters can do something with it
        ob_start();
        get_template_part('password-template');
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
add_filter( 'the_password_form', 'apollo13framework_custom_password_form');



if(!function_exists('apollo13framework_add_password_form_to_template')) {
    function apollo13framework_add_password_form_to_template( $content ) {
        return $content . apollo13framework_password_form();
    }
}