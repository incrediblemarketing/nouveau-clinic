<?php 

/**
 * Enqueue scripts and styles. For Google Fonts Customizer.
 */


function im_fonts_scripts() {
    $headings_font_h1 = esc_html(get_theme_mod('im_fonts_h1_family'));
    $headings_font_h2 = esc_html(get_theme_mod('im_fonts_h2_family'));
    $headings_font_h3 = esc_html(get_theme_mod('im_fonts_h3_family'));
    $headings_font_h4 = esc_html(get_theme_mod('im_fonts_h4_family'));
    $headings_font_h5 = esc_html(get_theme_mod('im_fonts_h5_family'));
    $headings_font_h6 = esc_html(get_theme_mod('im_fonts_h6_family'));
    $headings_font =  array($headings_font_h1, $headings_font_h2, $headings_font_h3, $headings_font_h4, $headings_font_h5, $headings_font_h6);
    $headings_font = array_unique($headings_font); 
    $headings_font = remove_empty($headings_font);
    $headings_font = implode('|', $headings_font);
    $headings_font = str_replace(' ', '+', $headings_font);
    $body_font = esc_html(get_theme_mod('im_fonts_body_family'));
    $body_font = str_replace(' ', '+', $body_font);
    
    if( $headings_font ) {
        wp_enqueue_style( 'im_fonts-headings-fonts', add_query_arg( 'family', $headings_font, '//fonts.googleapis.com/css' ) );
    } else {
        wp_enqueue_style( 'im_fonts-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
    }
    if( $body_font ) {
        wp_enqueue_style( 'google-fonts-body', add_query_arg( 'family', $body_font, '//fonts.googleapis.com/css' ) );
    } else {
        wp_enqueue_style( 'im_fonts-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
    }
}
add_action( 'wp_enqueue_scripts', 'im_fonts_scripts' );
/**
 * Google Fonts
 */
require get_template_directory() . '/includes/customizer/typography/gfonts.php';
