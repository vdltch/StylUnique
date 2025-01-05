<?php
/**
 * Footer Setting
 *
 * @package Chic_Lite
 */

function chic_lite_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'chic-lite' ),
            'priority'   => 199,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => __( 'Footer Copyright Text', 'chic-lite' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.site-info .copyright',
        'render_callback' => 'chic_lite_get_footer_copyright',
    ) );

     /** Note */
     $wp_customize->add_setting(
        'pro_footer_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'pro_footer_text',
            array(
                'section'     => 'footer_settings',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );
   
    $wp_customize->add_setting( 
        'pro_footer_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'pro_footer_settings',
            array(
                'section'     => 'footer_settings',
                'feat_class' => 'upg-to-pro',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/footer.png',
                ),
            )
        )
    );
    /** Footer Settings End */
        
}
add_action( 'customize_register', 'chic_lite_customize_register_footer' );