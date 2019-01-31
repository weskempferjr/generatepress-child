<?php


define ('GENERATEPRESS_CHILD_TEXT_DOMAIN', 'generatepress-child');
define ('GENERATEPRESS_LOGGED_IN_MENU', 'SEEN Menu Logged In');
define ('GENERATEPRESS_CHILD_LOGGED_OUT_MENU', 'SEEN Menu Logged Out');

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION


if ( !function_exists( 'insert_user_icons' ) ):

	function insert_user_icons() {
		echo '<div class="gpc-user-icons"><i class="fa fa-user"></i><i class="fa fa-search"></i></div>';
	}

endif;

// add_action('generate_before_header_content', 'insert_user_icons');

function my_wp_nav_menu_args( $args = '' ) {


	if( is_user_logged_in() ) {
		$args['menu'] = GENERATEPRESS_LOGGED_IN_MENU;
	} else {
		$args['menu'] = GENERATEPRESS_CHILD_LOGGED_OUT_MENU ;
	}


    /*
	if (is_user_logged_in() ) {
		if ( current_user_can('mepr-active','rule:1109') ) {
			$args['menu'] = 'AAPAS Licensed Members';
		}
		elseif ( current_user_can('mepr-active','rule:1110')) {
			$args['menu'] = 'AAPAS Non-licensed Members';
		}
		else {
			$args['menu'] = 'AAPAS Menu Logged In';
		}

	}
	else {
		$args['menu'] = 'AAPAS Menu Logged Out';
	}
    */

	return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

function auto_redirect_after_logout(){
	wp_redirect( home_url() );
	exit();
}
add_action('wp_logout','auto_redirect_after_logout');



function mb_post_sign_up( $user ) {
	$wp_user = get_user_by('ID', $user->rec->ID);
	$wp_user->remove_role('subscriber');
	$wp_user->add_role('No role for this site');
}

// add_action( 'mepr_user_account_saved','mb_post_sign_up');
