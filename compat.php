<?php

if ( !function_exists( 'is_login_page' ) ) :
/**
 * Whether the current request is for a login page
 *
 * @return bool
 */
function is_login_page() {
	$current_url = remove_query_arg( array( 'redirect_to', 'reauth', 'loggedout', 'action' ), get_current_url() );

	return wp_login_url() == $current_url;
}
endif;

if ( !function_exists( 'is_register_page' ) ) :
/**
 * Whether the current request is for the registration page
 *
 * @return bool
 */
function is_register_page() {
	$current_url = remove_query_arg( array( 'action', 'redirect_to', 'loggedout', ), get_current_url() );

	$register_url = remove_query_arg( array( 'action' ), wp_register_url() );

	return $current_url == $register_url;
}
endif;

if ( !function_exists( 'wp_register_url' ) ) :
/**
 * Returns the user registration URL
 *
 * Returns the URL that allows the user to log in to the site
 *
 * @uses site_url() To generate the log in URL
 * @uses apply_filters() calls 'register_url' hook on final url
 *
 * @return string
 */
function wp_register_url($redirect = '') {
	if ( is_multisite() )
		return apply_filters( 'wp_signup_location', network_site_url( 'wp-signup.php' ) );

	return apply_filters( 'register_url', site_url( 'wp-login.php?action=register', 'login' ), $redirect );
}
endif;

if ( !function_exists( 'get_current_url' ) ) :
/**
 * Return the full URL of the current page
 *
 * @return string
 */
function get_current_url() {
	return ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
endif;

