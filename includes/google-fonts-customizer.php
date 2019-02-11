
<?php

new theme_customizer();
class theme_customizer {
    public function __construct() {
        add_action( 'customize_register', array(&$this, 'customize_linje' ));
    }
    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_linje( $wp_manager ) {
        $this->linje_fonts_sections( $wp_manager );
    }
    private function linje_fonts_sections( $wp_manager ) {
        $wp_manager->add_section( 'linje_google_fonts_section', array(
            'title'       => __( 'Google Fonts', 'linje' ),
            'priority'       => 24,
        ) );
        $font_choices = getGoogleFonts();

        $wp_manager->add_setting( 'linje_body_fonts', array(
                'sanitize_callback' => 'linje_sanitize_fonts'
            )
        );
        $wp_manager->add_control( 'linje_body_fonts', array(
                'type' => 'select',
                'description' => __( 'Select your desired font for the body.', 'linje' ),
                'section' => 'linje_google_fonts_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'linje_h1_fonts', array(
                'sanitize_callback' => 'linje_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'linje_h1_fonts', array(
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h1\'s</strong>', 'linje'),
                'section' => 'linje_google_fonts_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'linje_h2_fonts', array(
                'sanitize_callback' => 'linje_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'linje_h2_fonts', array(
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h2\'s</strong>.', 'linje'),
                'section' => 'linje_google_fonts_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'linje_h3_fonts', array(
                'sanitize_callback' => 'linje_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'linje_h3_fonts', array(
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h3\'s</strong>', 'linje'),
                'section' => 'linje_google_fonts_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'linje_h4_fonts', array(
                'sanitize_callback' => 'linje_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'linje_h4_fonts', array(
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h4\'s</strong>', 'linje'),
                'section' => 'linje_google_fonts_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'linje_h5_fonts', array(
                'sanitize_callback' => 'linje_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'linje_h5_fonts', array(
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h5\'s</strong>.', 'linje'),
                'section' => 'linje_google_fonts_section',
                'choices' => $font_choices
            )
        );
        $wp_manager->add_setting( 'linje_h6_fonts', array(
                'sanitize_callback' => 'linje_sanitize_fonts',
            )
        );
        $wp_manager->add_control( 'linje_h6_fonts', array(
                'type' => 'select',
                'description' => __('Select your desired font for the <strong>h6\'s</strong>', 'linje'),
                'section' => 'linje_google_fonts_section',
                'choices' => $font_choices
            )
        );

    }
}
// Setup the Theme Customizer settings and controls...
//add_action( 'customize_register', array( 'theme_customizer', 'customize_linje' ) );
// Output custom CSS to live site
add_action( 'wp_head', array( 'theme_customizer' ) );
