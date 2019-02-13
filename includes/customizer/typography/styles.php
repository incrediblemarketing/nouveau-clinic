<?php 

/**
 * Enqueue scripts and styles. For Google Fonts Customizer.
 */


function im_fonts_scripts() {
    $fonts = array(
        'h1' => '',
        'h2' => '',
        'h3' => '',
        'h4' => '',
        'h5' => '',
        'h6' => '',
        'body' => ''
    );
    $font_args = array();
    $i = 0;
    foreach($fonts as $key => $value) {
        $font_family = 'im_fonts_' . $key . '_family';
        $font_family = esc_html(get_theme_mod($font_family));
        if(!empty($font_family)) {
            
            $font_weight = 'im_fonts_' . $key . '_weight';
            
            $font_weight = esc_html(get_theme_mod($font_weight));
            $font_pieces = explode(':', $font_family);
            $font_weights = explode(',', $font_pieces[1]);
            $font_family = $font_pieces[0] . ':';
            $font_args[$font_family][$font_weights[$font_weight]] = $font_weights[$font_weight];
            unset($font_args[$i]);
            $i++;
        }
    }
    $fonts = array();
    $fontweights = array();
    foreach($font_args as $key => $value) {
        
        $value = implode(',', $value);
        
        $arg = $key . $value;
        array_push($fonts, $arg);
    }
    $fonts = implode('|', $fonts);
    $fonts = str_replace(' ', '+', $fonts);

    
    if( $fonts != '' ) {
        wp_enqueue_style( 'im_fonts-headings-fonts', add_query_arg( 'family', $fonts, '//fonts.googleapis.com/css' ) );
    } else {
        wp_enqueue_style( 'im_fonts-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
    }

}
add_action( 'wp_enqueue_scripts', 'im_fonts_scripts' );
/**
 * Google Fonts
 */
require get_template_directory() . '/includes/customizer/typography/gfonts.php';
