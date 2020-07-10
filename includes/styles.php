<?php

function im_register_styles() {
	$theme         = wp_get_theme();
	$theme_version = $theme->get( 'Version' );
	wp_register_style( 'fonts', 'https://use.typekit.net/alm5plw.css' );
	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap' );
	wp_register_style( 'fontawesome', get_stylesheet_directory_uri() . '/assets/dist/plugins/fontawesome-pro/css/all.min.css' );
	wp_register_style( 'swiper', get_template_directory_uri() . '/assets/dist/plugins/swiper/css/swiper.min.css' );
	wp_register_style( 'main', get_template_directory_uri() . '/assets/dist/css/main.min.css' );
	wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'im_register_styles' );

function im_enqueue_styles() {
	wp_enqueue_style( 'fonts' );
	wp_enqueue_style( 'google-fonts' );
	wp_enqueue_style( 'fontawesome' );
	wp_enqueue_style( 'swiper' );
	wp_enqueue_style( 'main' );
	wp_enqueue_style( 'style' );
}
add_action( 'wp_enqueue_scripts', 'im_enqueue_styles' );
