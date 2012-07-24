<?php
/*
Plugin Name: Require First and Last Name
Description: Require first and last name from users who are editing their profiles.
Version: 1.2
Author: mitcho (Michael 芳貴 Erlewine)
Author URI: http://mitcho.com/code/
License: GPL
*/

if(!load_plugin_textdomain('require-first-and-last-name','/wp-content/languages/'))
	load_plugin_textdomain('require-first-and-last-name',dirname(__FILE__) . '/lang/');

add_filter('user_profile_update_errors', 'check_first_and_last_name', 10, 3);
function check_first_and_last_name($errors, $update, $user) {
	if ( empty( $user->first_name ) )
		$errors->add( 'empty_first_name', __( '<strong>ERROR</strong>: Please enter a first name.', 'require-first-and-last-name' ), array( 'form-field' => 'first_name' ) );
	if ( empty( $user->last_name ) )
		$errors->add( 'empty_last_name', __( '<strong>ERROR</strong>: Please enter a last name.', 'require-first-and-last-name' ), array( 'form-field' => 'last_name' ) );
}

add_action('personal_options', 'require_first_and_last_name');
function require_first_and_last_name() {
	$script = <<<SCRIPT
<script type="text/javascript">
jQuery(function($) {
	label = $('label[for=last_name]');
	label.html(label.html() + ' <span class="description">REQUIRED</span>');
	$('#last_name').attr('required',true);

	label = $('label[for=first_name]');
	label.html(label.html() + ' <span class="description">REQUIRED</span>');
	$('#first_name').attr('required',true);
})
</script>
SCRIPT;
	echo str_replace('REQUIRED', __('(required)'), $script);
}
?>