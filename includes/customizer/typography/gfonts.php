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

function im_fonts_custom_styles($custom) {
    //Fonts
    $headings_font_h1 = esc_html(get_theme_mod('im_fonts_h1_family'));
    $headings_font_h2 = esc_html(get_theme_mod('im_fonts_h2_family'));
    $headings_font_h3 = esc_html(get_theme_mod('im_fonts_h3_family'));
    $headings_font_h4 = esc_html(get_theme_mod('im_fonts_h4_family'));
    $headings_font_h5 = esc_html(get_theme_mod('im_fonts_h5_family'));
    $headings_font_h6 = esc_html(get_theme_mod('im_fonts_h6_family'));








    $headings_font =  array(
                        'h1' => $headings_font_h1,
                        'h2' => $headings_font_h2,
                        'h3' => $headings_font_h3,
                        'h4' => $headings_font_h4,
                        'h5' => $headings_font_h5,
                        'h6' => $headings_font_h6,
                        'p' => '',
                        'a' => ''
                    );

    // $headings_font = remove_empty($headings_font);

    
    // if ( $headings_font ) {
        foreach($headings_font as $key => $value) {
            // $custom .= $font_heading
            if($value != '') {
                $font_pieces = explode(':', $value);
                $font_family = "font-family: {$font_pieces[0]};";
            } else {
                $font_family = '';
            }
            $font_pieces = explode(':', $value);
            $font_weight = 'im_fonts_' . $key . '_weight';
            $font_color = 'im_fonts_' . $key . '_color';
            $font_color = esc_html(get_theme_mod($font_color));

            $font_weight = esc_html(get_theme_mod($font_weight));

            $size = '';
            $size = getFontSizes($key, 'mobile');

            $font_transform = 'im_fonts_' . $key . '_transform';
            $font_transform = esc_html(get_theme_mod($font_transform));

            $font_letterspacing = 'im_fonts_' . $key . '_letterspacing';
            $font_letterspacing = esc_html(get_theme_mod($font_letterspacing));

            $font_lineheight = 'im_fonts_' . $key . '_lineheight';
            $font_lineheight = esc_html(get_theme_mod($font_lineheight));

            $margin = 'im_fonts_' . $key . '_margin_mobile';
            $margin = esc_html(get_theme_mod($margin));

            if($margin) {
                $margin = "margin:" . $margin .";";
            } else {
                $margin = '';                
            }
            if($font_lineheight != '') {
                $font_lineheight = "line-height:" . $font_lineheight .";";
            } else {
                $font_lineheight = '';
            }
            if($font_transform != '') {
                $font_transform = "text-transform:" . $font_transform .";";
            } else {
                $font_transform = '';
            }
            if($font_letterspacing != '') {
                $font_letterspacing = "letter-spacing:" . $font_letterspacing ."px;";
            } else {
                $font_letterspacing = '';
            }
            if($font_weight != '') {
                $font_weight = explode(',', $font_pieces[1])[$font_weight];
                $font_style  = $font_weight;
                if(!preg_match('/^\d+$/', $font_style)){
                    $font_style = preg_replace('/[0-9]+/', '', $font_style);
                    if($font_style == 'regular') {
                        $font_style = 'normal';
                    }
                    $font_style = 'font-style:' . $font_style .';';
                } else {
                    $font_style = '';
                }

                $font_weight = preg_replace("/[^0-9]/", "", $font_weight);
                if($font_weight != '') {
                    $font_weight = 'font-weight:' . $font_weight . ';';
                } else {
                    $font_weight = '';
                }
                


            } else {
                $font_weight = '';
            }

            $custom .= $key . ", ." . $key . "{" . $font_family . $font_weight . $font_style . "color: " . $font_color . ";" . $size . $margin . $font_transform . $font_letterspacing . $font_lineheight ."}"."\n";
        // }
        // $font_pieces = explode(":", $headings_font);
        // $custom .= "h1, h2, h3, h4, h5, h6 { font-family: {$font_pieces[0]}; }"."\n";
    }
    $body_font = esc_html(get_theme_mod('im_fonts_body_family'));
    $im_fonts_body_color = esc_html(get_theme_mod('im_fonts_body_color'));
    if($body_font != '') {
        $font_pieces = explode(":", $body_font);
        $body_font = "font-family: {$font_pieces[0]};";
    } else {
        $body_font = '';
    }
    $body_size_mobile = getBodySize(esc_html(get_theme_mod('im_fonts_body_size_mobile')));
    $body_size_tablet = getBodySize(esc_html(get_theme_mod('im_fonts_body_size_tablet')));
    $body_size_desktop = getBodySize(esc_html(get_theme_mod('im_fonts_body_size_desktop')));

    $custom .= "body, button, input, select, textarea { " . $body_font . "color: " . $im_fonts_body_color .";}"."\n";
    $custom .= "body {" .$body_size_mobile. "}";

    $custom .= "@media (min-width:768px) {";
    if($body_size_tablet) {
        $custom .= "body {" . $body_size_tablet . "}";
    }
    foreach($headings_font as $key => $value) {
        $size = getFontSizes($key, 'tablet');

        if($key != 'body') {
            $margin = esc_html(get_theme_mod('im_fonts_' . $key . '_margin_tablet'));
            if($margin) {
                $margin = "margin:" . $margin . ";";
            } else {
                $margin = '';
            }            
        } else {
            $margin = '';
        }
        if($size || $margin) {
            $custom .= $key . ", ." . $key . "{" . $size . $margin . "}"."\n";    
        }
        
    }
    $custom .= "}";

    $custom .= "@media (min-width:1200px) {";
    if($body_size_desktop) {
        $custom .= "body {" . $body_size_desktop . "}";
    }
    foreach($headings_font as $key => $value) {
        $size = getFontSizes($key, 'desktop');
        if($key != 'body') {
            $margin = esc_html(get_theme_mod('im_fonts_' . $key . '_margin_desktop'));
            if($margin) {
                $margin = "margin:" . $margin . ";";
            } else {
                $margin = '';
            }
        } else {
            $margin = '';
        }
        if($size || $margin) {
            $custom .= $key . ", ." . $key . "{" . $size . $margin . "}"."\n";
        }
    }
    $custom .= "}";
    //Output all the styles
    wp_add_inline_style( 'style', $custom );
}
add_action( 'wp_enqueue_scripts', 'im_fonts_custom_styles' );
//Sanitizes Fonts
function im_fonts_sanitize_fonts( $input ) {
    return $input;
}

function pxToRem($px, $viewport = null) {
    if($viewport) {

        if($viewport == 'mobile') {
            $base = esc_html(get_theme_mod('im_fonts_body_size_mobile'));
        } elseif($viewport == 'tablet') {
            $base = esc_html(get_theme_mod('im_fonts_body_size_tablet'));
        } elseif(viewport == 'desktop') {
            $base = esc_html(get_theme_mod('im_fonts_body_size_desktop'));
        } else {
            $base = 16;
        }
        if(empty($base)) {
            $base = 16;
        }

    } else {
        $base = 16;
    }
    $rem = $px / $base;
    $rem = strval($rem) . 'rem';
    return $rem;
}
function getFontSizes($key, $viewport = null) {
    if($key != 'body') {
        if(empty($viewport)) {
            $viewport = '';
        }
        $mobile_size = 'im_fonts_' . $key . '_size_' . $viewport;
        $mobile_size = esc_html(get_theme_mod($mobile_size));
        if($mobile_size > 0) {
            
            $mobile_size_rem = pxToRem($mobile_size, $viewport);
            $mobile_size_rem = 'font-size:' . $mobile_size_rem . ';';

            $mobile_size = strval($mobile_size);
            $mobile_size_px = 'font-size:' . $mobile_size .'px' . ';';
            $size =  $mobile_size_px . $mobile_size_rem;
            // $custom .= 'h1{' 

        } else {
            $size = '';
        }    
    } else {
        $size = '';
    }
    return $size;
}
function getBodySize($size) {
    if(empty($size)) {
        $size = '';
    } else {
        $size = strval($size);
        $size = "font-size:" . $size . "px;";
    }
    return $size;
}