
<?php

new theme_customizer();

class theme_customizer {
    public function __construct() {
        add_action( 'customize_register', array(&$this, 'customize_im_fonts' ));
    }
    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_im_fonts( $wp_manager ) {
        $this->im_fonts_fonts_sections( $wp_manager );
    }

    private function im_fonts_fonts_sections( $wp_manager ) {
        $font_choices = getGoogleFonts();
        $wp_manager->add_panel( 'google_fonts_panel', array(
         'priority'       => 24,
          'capability'     => 'edit_theme_options',
          'theme_supports' => '',
          'title'          => __('Google Fonts', 'im_fonts'),
          'description'    => __('Set fonts for cany google font on heaers and body tags.', 'mytheme'),
        ) );


        $headings_font_h1 = esc_html(get_theme_mod('im_fonts_h1_fonts'));
        $headings_font_h2 = esc_html(get_theme_mod('im_fonts_h2_fonts'));
        $headings_font_h3 = esc_html(get_theme_mod('im_fonts_h3_fonts'));
        $headings_font_h4 = esc_html(get_theme_mod('im_fonts_h4_fonts'));
        $headings_font_h5 = esc_html(get_theme_mod('im_fonts_h5_fonts'));
        $headings_font_h6 = esc_html(get_theme_mod('im_fonts_h6_fonts'));
        $body_font = esc_html(get_theme_mod('im_fonts_body_fonts'));
        
        if($body_font != NULL) {
            $font_pieces_body = explode(':', $headings_font_body);
            $font_pieces_body = explode(',', $font_pieces_body[1]);
        } else {
            $font_pieces_body = '';
        }
        if($headings_font_h1 != NULL) {
            $font_pieces_h1 = explode(':', $headings_font_h1);
            $font_pieces_h1 = explode(',', $font_pieces_h1[1]);
        } else {
            $font_pieces_h1 = '';
        }
        if($headings_font_h2 != NULL) {
            $font_pieces_h2 = explode(':', $headings_font_h2);
            $font_pieces_h2 = explode(',', $font_pieces_h2[1]);
        } else {
            $font_pieces_h2 = '';
        }
        if($headings_font_h3 != NULL) {
            $font_pieces_h3 = explode(':', $headings_font_h3);
            $font_pieces_h3 = explode(',', $font_pieces_h3[1]);
        } else {
            $font_pieces_h3 = '';
        }
        if($headings_font_h4 != NULL) {
            $font_pieces_h4 = explode(':', $headings_font_h4);
            $font_pieces_h4 = explode(',', $font_pieces_h4[1]);
        } else {
            $font_pieces_h4 = '';
        }
        if($headings_font_h5 != NULL) {
            $font_pieces_h5 = explode(':', $headings_font_h5);
            $font_pieces_h5 = explode(',', $font_pieces_h5[1]);
        } else {
            $font_pieces_h5 = '';
        }
        if($headings_font_h6 != NULL) {
            $font_pieces_h6 = explode(':', $headings_font_h6);
            $font_pieces_h6 = explode(',', $font_pieces_h6[1]);
        } else {
            $font_pieces_h6 = '';
        }

        $wp_manager->add_section( 'im_fonts_google_fonts_h1_section', array(
            'title'       => __( 'H1', 'im_fonts' ),
            'priority'       => 24,
            'panel'  => 'google_fonts_panel',
        ) );
        $wp_manager->add_section( 'im_fonts_google_fonts_h2_section', array(
            'title'       => __( 'H2', 'im_fonts' ),
            'priority'       => 24,
            'panel'  => 'google_fonts_panel',
        ) );
        $wp_manager->add_section( 'im_fonts_google_fonts_h3_section', array(
            'title'       => __( 'H3', 'im_fonts' ),
            'priority'       => 24,
            'panel'  => 'google_fonts_panel',
        ) );
        $wp_manager->add_section( 'im_fonts_google_fonts_h4_section', array(
            'title'       => __( 'H4', 'im_fonts' ),
            'priority'       => 24,
            'panel'  => 'google_fonts_panel',
        ) );
        $wp_manager->add_section( 'im_fonts_google_fonts_h5_section', array(
            'title'       => __( 'H5', 'im_fonts' ),
            'priority'       => 24,
            'panel'  => 'google_fonts_panel',
        ) );
        $wp_manager->add_section( 'im_fonts_google_fonts_h6_section', array(
            'title'       => __( 'H6', 'im_fonts' ),
            'priority'       => 24,
            'panel'  => 'google_fonts_panel',
        ) );
        $wp_manager->add_section( 'im_fonts_google_fonts_body_section', array(
            'title'       => __( 'Body', 'im_fonts' ),
            'priority'       => 24,
            'panel'  => 'google_fonts_panel',
        ) );

        $wp_manager->add_setting( 'im_fonts_body_fonts', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts'
            )
        );
        $wp_manager->add_control( 'im_fonts_body_fonts', array(
                'label' => 'Font Family',
                'type' => 'select',
                'description' => __( 'Select your desired font for the body.', 'im_fonts' ),
                'section' => 'im_fonts_google_fonts_body_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_body_weight', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_body_weight', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>body\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_body_section',
                'choices' => $font_pieces_body
            )
        );
        $wp_manager->add_setting( 'im_fonts_body_size_mobile', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_body_size_mobile', array(
                'label' => 'Mobile Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>body\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_body_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_body_size_Tablet', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_body_size_Tablet', array(
                'label' => 'Tablet Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>body\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_body_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_body_size_Desktop', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_body_size_Desktop', array(
                'label' => 'Desktop Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>body\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_body_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h1_fonts', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h1_fonts', array(
                'label' => 'Font Family',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h1\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h1_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h1_weight', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h1_weight', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h1\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h1_section',
                'choices' => $font_pieces_h1
            )
        );
        $wp_manager->add_setting( 'im_fonts_h1_size_mobile', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h1_size_mobile', array(
                'label' => 'Mobile Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h1\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h1_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h1_size_Tablet', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h1_size_Tablet', array(
                'label' => 'Tablet Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h1\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h1_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h1_size_Desktop', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h1_size_Desktop', array(
                'label' => 'Desktop Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h1\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h1_section',
                'choices' => $font_choices
            )
        );

        $wp_manager->add_setting( 'im_fonts_h2_fonts', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h2_fonts', array(
                'label' => 'Font Family',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h2\'s</strong>.', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h2_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h2_weight', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h2_weight', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h2\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h2_section',
                'choices' => $font_pieces_h2
            )
        );
        $wp_manager->add_setting( 'im_fonts_h2_size_mobile', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h2_size_mobile', array(
                'label' => 'Mobile Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h2\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h2_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h2_size_Tablet', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h2_size_Tablet', array(
                'label' => 'Tablet Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h2\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h2_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h2_size_Desktop', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h2_size_Desktop', array(
                'label' => 'Desktop Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h2\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h2_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h3_fonts', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h3_fonts', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h3\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h3_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h3_weight', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h3_weight', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h3\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h3_section',
                'choices' => $font_pieces_h3
            )
        );
        $wp_manager->add_setting( 'im_fonts_h3_size_mobile', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h3_size_mobile', array(
                'label' => 'Mobile Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h3\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h3_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h3_size_Tablet', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h3_size_Tablet', array(
                'label' => 'Tablet Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h3\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h3_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h3_size_Desktop', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h3_size_Desktop', array(
                'label' => 'Desktop Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h3\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h3_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h4_fonts', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h4_fonts', array(
                'label' => 'Font Family',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h4\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h4_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h4_weight', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h4_weight', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h4\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h4_section',
                'choices' => $font_pieces_h4
            )
        );
        $wp_manager->add_setting( 'im_fonts_h4_size_mobile', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h4_size_mobile', array(
                'label' => 'Mobile Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h4\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h4_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h4_size_Tablet', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h4_size_Tablet', array(
                'label' => 'Tablet Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h4\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h4_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h4_size_Desktop', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h4_size_Desktop', array(
                'label' => 'Desktop Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h4\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h4_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h5_fonts', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h5_fonts', array(
                'label' => 'Font Family',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h5\'s</strong>.', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h5_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h5_weight', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h5_weight', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h5\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h5_section',
                'choices' => $font_pieces_h5
            )
        );
        $wp_manager->add_setting( 'im_fonts_h5_size_mobile', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h5_size_mobile', array(
                'label' => 'Mobile Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h5\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h5_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h5_size_Tablet', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h5_size_Tablet', array(
                'label' => 'Tablet Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h5\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h5_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h5_size_Desktop', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h5_size_Desktop', array(
                'label' => 'Desktop Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h5\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h5_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h6_fonts', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h6_fonts', array(
                'label' => 'Font Family',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h6\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h6_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h6_weight', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h6_weight', array(
                'label' => 'Font Weight',
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h6\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h6_section',
                'choices' => $font_pieces_h6
            )
        );
        $wp_manager->add_setting( 'im_fonts_h6_size_mobile', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h6_size_mobile', array(
                'label' => 'Mobile Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h6\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h6_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h6_size_Tablet', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h6_size_Tablet', array(
                'label' => 'Tablet Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h6\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h6_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'im_fonts_h6_size_Desktop', array(
                'sanitize_callback' => 'im_fonts_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'im_fonts_h6_size_Desktop', array(
                'label' => 'Desktop Size',
                'type' => 'input',
                'description' => __('Select your desired font size for the <strong>h6\'s</strong>', 'im_fonts'),
                'section' => 'im_fonts_google_fonts_h6_section',
                'choices' => $font_choices
            )
        );


    }
}
// Setup the Theme Customizer settings and controls...
//add_action( 'customize_register', array( 'theme_customizer', 'customize_im_fonts' ) );
// Output custom CSS to live site
add_action( 'wp_head', array( 'theme_customizer' ) );
