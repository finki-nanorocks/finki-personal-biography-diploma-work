<?php

function bizworx_custom_header_setup() {
	add_theme_support( 'custom-header', array(
		'default-image'          => get_template_directory_uri() . '/images/header.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'video'					 => true,
		'video-active-callback'  => '',
	) );
}
add_action( 'after_setup_theme', 'bizworx_custom_header_setup' );

/**
 * Video header settings
 */
function bizworx_video_settings( $settings ) {
	$settings['l10n']['play'] 	= '<i class="fa fa-play"></i>';
	$settings['l10n']['pause'] 	= '<i class="fa fa-pause"></i>';
	$settings['minWidth'] 		= '100';
	$settings['minHeight'] 		= '100';	
	
	return $settings;
}
add_filter( 'header_video_settings', 'bizworx_video_settings' );