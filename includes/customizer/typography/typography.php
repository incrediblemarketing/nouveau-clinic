<?php
    if(!class_exists("im_typography_customizer")) {
        class im_typography_customizer {
            public function __construct() {
                add_action( 'customize_register', array(&$this, 'customize_im_fonts' ));
            }
            /**
             * Customizer manager demo
             * @param  WP_Customizer_Manager $wp_manager
             * @return void
             */
            public static function customize_im_fonts( $wp_manager ) {
                $this->im_fonts_fonts_sections( $wp_manager );
            }

            private function im_fonts_fonts_sections( $wp_manager ) {

                // Get list of google fonts to load
                // ==================================================

                $font_choices = getGoogleFonts();

                // Create typography panel
                // ==================================================

                $wp_manager->add_panel( 'custom_typography_panel', array(
                 'priority'       => 24,
                  'capability'     => 'edit_theme_options',
                  'theme_supports' => '',
                  'title'          => __('Typography', 'im_fonts'),
                  'description'    => __('Set fonts for cany google font on heaers and body tags.', 'mytheme'),
                ) );
                
                // List the different typography sections you woud like to have available to a user.
                // ==================================================

                $im_sections = array(
                    'body' => '',
                    'h1' => '',
                    'h2' => '',
                    'h3' => '',
                    'h4' => '',
                    'h5' => '',
                    'p'  => '',
                    'a'  => ''
                );
                
                // Loop through each given typography and create its section and controls.
                // ==================================================

                foreach($im_sections as $key => $value) {

                    // Create section for given typography bye $key
                    // ==================================================
                    $wp_manager->add_section( 'im_fonts_custom_typography_' . $key . '_section', array(
                        'title'       => __( ucfirst($key), 'im_fonts' ),
                        'priority'       => 24,
                        'panel'  => 'custom_typography_panel',
                    ) );

                    // Font Family
                    // ==================================================
                    $headings_font_family = esc_html(get_theme_mod('im_fonts_' . $key . '_family'));

                    // Check for set font and find its associated weights to load into the relevant weight dropdown
                    // ==================================================
                    if($headings_font_family != NULL) {

                        // Find the font weights associated with the font
                        // ==================================================
                        $font_pieces = explode(':', $headings_font_family);
                        $font_pieces = explode(',', $font_pieces[1]);
                    } else {
                        $font_pieces = '';
                    }

                    // Sanitize ( reocurring )
                    // ==================================================
                    $wp_manager->add_setting( 'im_fonts_' . $key. '_family', array(
                            'sanitize_callback' => 'im_fonts_sanitize_fonts'
                        )
                    );

                    // Load the font choices as a select option
                    // ==================================================
                    $wp_manager->add_control( 'im_fonts_' . $key . '_family', array(
                            'label' => 'Font Family',
                            'type' => 'select',
                            'description' => __( 'Select your desired font for the body.', 'im_fonts' ),
                            'section' => 'im_fonts_custom_typography_' . $key . '_section',
                            'choices' => $font_choices
                        )
                    );

                    $wp_manager->add_setting( 'im_fonts_' . $key . '_weight', array(
                            'sanitize_callback' => 'im_fonts_sanitize_fonts',
                        )
                    );

                    // Font Sizes
                    // ==================================================

                    // Font Size - Mobile
                    // ==================================================
                    $wp_manager->add_setting( 'im_fonts_' . $key . '_size_mobile', array(
                      'capability' => 'edit_theme_options',
                      'sanitize_callback' => 'im_slug_sanitize_number_absint'
                      // 'default' => 10,
                    ) );

                    // Update the label if its the body section
                    // ==================================================
                    if($key == 'body') {
                        $label = 'Baseline Sizes (Default is 16px = 1 rem)';
                    } else {
                        $label = 'Font Sizes';
                    }

                    $desc = 'Mobile Size < 768px';
                    $wp_manager->add_control( 'im_fonts_' . $key . '_size_mobile', array(
                            'label' => $label,
                            'type' => 'number',
                            'description' => __($desc, 'im_fonts'),
                            'section' => 'im_fonts_custom_typography_' . $key . '_section',
                            'input_attrs' => array(
                                'min' => __( '1', 'im_font' ),
                                'style' => __('max-width:60px;', 'im_font'),
                                'class' => __('input_size', 'im_font')
                            )
                        )
                    );
                    $desc = 'Tablet Size >= 768px';
                    $wp_manager->add_setting( 'im_fonts_' . $key . '_size_tablet', array(
                      'capability' => 'edit_theme_options',
                      'sanitize_callback' => 'im_slug_sanitize_number_absint'
                      // 'default' => 10,
                    ) );
                    $wp_manager->add_control( 'im_fonts_' . $key . '_size_tablet', array(
                            // 'label' => 'Baseline Sizes ( Default is 16px = 1 rem )',
                            'type' => 'number',
                            'description' => __($desc, 'im_fonts'),
                            'section' => 'im_fonts_custom_typography_' . $key . '_section',
                            'input_attrs' => array(
                                'min' => __( '1', 'im_font' ),
                                'style' => __('max-width:60px;', 'im_font'),
                                'class' => __('input_size', 'im_font')
                            )
                        )
                    );
                    $wp_manager->add_setting( 'im_fonts_' . $key . '_size_desktop', array(
                      'capability' => 'edit_theme_options',
                      'sanitize_callback' => 'im_slug_sanitize_number_absint'
                      // 'default' => 10,
                    ) );
                    $desc = 'Desktop Size >= 1200px';
                    $wp_manager->add_control( 'im_fonts_' . $key . '_size_desktop', array(
                            // 'label' => 'Desktop Size',
                            'type' => 'number',
                            'description' => __($desc, 'im_fonts'),
                            'section' => 'im_fonts_custom_typography_' . $key . '_section',
                            'input_attrs' => array(
                                'min' => __( '1', 'im_font' ),
                                'style' => __('max-width:60px;', 'im_font'),
                                'class' => __('input_size', 'im_font')
                            )
                        )
                    );

                    
                    // Font Weight
                    // ==================================================
                    $wp_manager->add_control( 'im_fonts_' . $key . '_weight', array(
                            'label' => 'Font Weight',
                            'type' => 'select',
                            'description' => __('Select your desired font for the <strong>body\'s</strong>', 'im_fonts'),
                            'section' => 'im_fonts_custom_typography_' . $key . '_section',
                            'choices' => $font_pieces
                        )
                    );

                    // Font Color
                    // ==================================================
                    $wp_manager->add_setting( 'im_fonts_' . $key . '_color', array(
                        'default' => '#000000'
                    ) );


                    $wp_manager->add_control( new WP_Customize_Color_Control( $wp_manager, 'im_fonts_' . $key . '_color', array(
                        'label' => 'Font Color',
                        'section' => 'im_fonts_custom_typography_' . $key . '_section',
                        'settings' => 'im_fonts_' . $key . '_color',
                    ) ) );

                    // Ignore the body styles for these options
                    // ==================================================
                    if($key != 'body') {

                        // Font Transform
                        // ==================================================
                        $wp_manager->add_setting( 'im_fonts_' . $key . '_transform', array(
                          'capability' => 'edit_theme_options',
                          'default' => 'initial',
                          'sanitize_callback' => 'im_slug_customizer_sanitize_radio',
                        ) );

                        $wp_manager->add_control( 'im_fonts_' . $key . '_transform', array(
                            'type' => 'radio',
                            'section' => 'im_fonts_custom_typography_' . $key . '_section',
                            'label' => __( 'Transform' ),
                            'choices' => array(
                                    'initial' => __( 'Initial' ),
                                    'uppercase' => __( 'Uppercase' ),
                                    'lowercase' => __( 'Lowercase' ),
                                ),
                            ) 
                        );

                        // Font Letter Spacing
                        // ==================================================
                        $wp_manager->add_setting( 'im_fonts_' . $key . '_letterspacing', array(
                          'capability' => 'edit_theme_options',
                          'sanitize_callback' => 'im_slug_sanitize_number_absint'
                          // 'default' => 10,
                        ) );
                        $wp_manager->add_control( 'im_fonts_' . $key . '_letterspacing', array(
                                'label' => 'Letter Spacing',
                                'type' => 'number',
                                // 'description' => __('', 'im_fonts'),
                                'section' => 'im_fonts_custom_typography_' . $key . '_section',
                                'input_attrs' => array(
                                    'min' => __( '1', 'im_font' ),
                                    'style' => __('max-width:60px;', 'im_font'),
                                    'class' => __('input_size', 'im_font')
                                )

                            )
                        );

                        // Font Line Height
                        // ==================================================
                        $wp_manager->add_setting( 'im_fonts_' . $key . '_lineheight', array(
                          'capability' => 'edit_theme_options',
                          'sanitize_callback' => 'im_slug_sanitize_number_absint'
                          // 'default' => 10,
                        ) );
                        $wp_manager->add_control( 'im_fonts_' . $key . '_lineheight', array(
                                'label' => 'Line Height',
                                'type' => 'number',
                                // 'description' => __('', 'im_fonts'),
                                'section' => 'im_fonts_custom_typography_' . $key . '_section',
                                'input_attrs' => array(
                                    'min' => __( '1', 'im_font' ),
                                    'style' => __('max-width:60px;', 'im_font'),
                                    'class' => __('input_size', 'im_font')
                                )
                            )
                        );

                        // Font Margins
                        // ==================================================

                        // Font Margins - Mobile < 768px
                        // ==================================================

                        $wp_manager->add_setting( 'im_fonts_' . $key . '_margin_mobile', array(
                          'capability' => 'edit_theme_options'
                        ) );
                        $wp_manager->add_control( 'im_fonts_' . $key . '_margin_mobile', array(
                                'label' => 'Margin',
                                'type' => 'input',
                                'description' => __('Mobile < 768px', 'im_fonts'),
                                'section' => 'im_fonts_custom_typography_' . $key . '_section'

                            )
                        );

                        // Font Margins - Tablet >= 768px
                        // ==================================================
                        $wp_manager->add_setting( 'im_fonts_' . $key . '_margin_tablet', array(
                          'capability' => 'edit_theme_options'
                          // 'default' => 10,
                        ) );
                        $wp_manager->add_control( 'im_fonts_' . $key . '_margin_tablet', array(
                                // 'label' => 'Margin',
                                'type' => 'input',
                                'description' => __('Tablet >= 768px', 'im_fonts'),
                                'section' => 'im_fonts_custom_typography_' . $key . '_section'
                            )
                        );

                        // Font Margins - Desktop >= 1200px
                        // ==================================================
                        $wp_manager->add_setting( 'im_fonts_' . $key . '_margin_desktop', array(
                          'capability' => 'edit_theme_options'
                          // 'default' => 10,
                        ) );
                        $wp_manager->add_control( 'im_fonts_' . $key . '_margin_desktop', array(
                                // 'label' => 'Margin',
                                'type' => 'input',
                                'description' => __('Desktop >= 1200px', 'im_fonts'),
                                'section' => 'im_fonts_custom_typography_' . $key . '_section'

                            )
                        );

                    }
                    // Stop ignoring the body section and continue adding the following fields
                    // ========================================================================


                }
            }
        }
        new im_typography_customizer();
    }

    // Setup the Theme Customizer settings and controls...
    //add_action( 'customize_register', array( 'im_typography_customizer', 'customize_im_fonts' ) );
    // Output custom CSS to live site
    // add_action( 'wp_head', array('im_typography_customizer',  'customize_im_fonts'), 10, 3 );

    // Require the styles specific to these customizations
    // ======================================================
    require get_template_directory() . '/includes/customizer/typography/styles.php';



    // Ajax call to load the proper font weights when changing font families
    // ========================================================================
    add_action( 'wp_ajax_nopriv_get_font_weights', 'get_font_weights' );
    add_action( 'wp_ajax_get_font_weights', 'get_font_weights' );


    function get_font_weights() {
        $fontfamily = $_GET['fontfamily'];
        $weightSelect = $_GET['weightSelect'];
        
        $fontfamily = explode(':', $fontfamily);
        $fontweight = explode(',', $fontfamily[1]);
        $counter = 0;
        $output = '';
        $selected = '';
        foreach($fontweight as $weight) {
            if($counter == 0) {
                $selected = ' selected';
            } else {
                $selected = '';
            }
            $output .= '<option value="' . $counter . '"' . $selected . '>' . $weight . '</option>';
            $counter++;
        }
        // $weightData = array('id' => $weightSelect, 'options' => $output);
        // $weightData = json_encode($weightData);
        
        echo $output;
        die();
    }

    // Sanitize callbacks
    // ==================================================
    function im_slug_sanitize_number_absint( $number, $setting ) {
      // Ensure $number is an absolute integer (whole number, zero or greater).
      $number = absint( $number );

      // If the input is an absolute integer, return it; otherwise, return the default
      return ( $number ? $number : $setting->default );
    }

    function im_slug_customizer_sanitize_radio( $input, $setting ) {

      // Ensure input is a slug.
      $input = sanitize_key( $input );

      // Get list of choices from the control associated with the setting.
      $choices = $setting->manager->get_control( $setting->id )->choices;

      // If the input is a valid key, return it; otherwise, return the default.
      return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }