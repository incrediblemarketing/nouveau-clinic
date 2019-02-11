<?php
/*
 * Props to the BLDR Theme: https://wordpress.org/themes/bldr/
 * */
function getGoogleFonts() {
    $googleListFonts = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDglsQUsvAE9R6u9tvmQzeYt2hKdNN7FN4');
    $googleListFonts = json_decode($googleListFonts);
    
    $font_choices = array();
    foreach($googleListFonts->items as $googleListFont) {
        $googleFamily = $googleListFont->family;
        $variants = implode(',', $googleListFont->variants);
        $googleFontArg = $googleFamily . ':' . $variants;
        $font_choices[$googleFontArg] .= $googleFamily;
    }
    return $font_choices;
}
function remove_empty($array) {
  return array_filter($array, '_remove_empty_internal');
}

function _remove_empty_internal($value) {
  return !empty($value) || $value === 0;
}

function linje_custom_styles($custom) {
    //Fonts
    $headings_font_h1 = esc_html(get_theme_mod('linje_h1_fonts'));
    $headings_font_h2 = esc_html(get_theme_mod('linje_h2_fonts'));
    $headings_font_h3 = esc_html(get_theme_mod('linje_h3_fonts'));
    $headings_font_h4 = esc_html(get_theme_mod('linje_h4_fonts'));
    $headings_font_h5 = esc_html(get_theme_mod('linje_h5_fonts'));
    $headings_font_h6 = esc_html(get_theme_mod('linje_h6_fonts'));
    $headings_font =  array(
                        'h1' => $headings_font_h1,
                        'h2' => $headings_font_h2,
                        'h3' => $headings_font_h3,
                        'h4' => $headings_font_h4,
                        'h5' => $headings_font_h5,
                        'h6' => $headings_font_h6
                    );
    $headings_font = remove_empty($headings_font);
    // $headings_font = array_map('array_filter', $headings_font);
    // $headings_font = array(array_filter($headings_font));
    // $headings_font = implode('|', $headings_font);
    // echo '<pre>';
    //     var_dump($headings_font);            
    // echo '</pre>';

    // die();
    $body_font = esc_html(get_theme_mod('linje_body_fonts'));
    if ( $headings_font ) {
        foreach($headings_font as $key => $value) {
            // $custom .= $font_heading
            $font_pieces = explode(':', $value);
            $custom .= $key . "{font-family: {$font_pieces[0]};}"."\n";
            
        }
        // $font_pieces = explode(":", $headings_font);
        // $custom .= "h1, h2, h3, h4, h5, h6 { font-family: {$font_pieces[0]}; }"."\n";
    }
    if ( $body_font ) {
        $font_pieces = explode(":", $body_font);
        $custom .= "body, button, input, select, textarea { font-family: {$font_pieces[0]}; }"."\n";
    }

    //Output all the styles
    wp_add_inline_style( 'style', $custom );
}
add_action( 'wp_enqueue_scripts', 'linje_custom_styles' );
//Sanitizes Fonts
function linje_sanitize_fonts( $input ) {
    return $input;
}
