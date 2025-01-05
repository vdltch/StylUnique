<?php
/**
 * Layout Settings
 *
 * @package Chic_Lite
 */

function chic_lite_customize_register_layout( $wp_customize ) {
    
    /** Layout Settings */
    $wp_customize->add_panel( 
        'layout_settings',
         array(
            'priority'    => 55,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Layout Settings', 'chic-lite' ),
            'description' => __( 'Change different page layout from here.', 'chic-lite' ),
        ) 
    );

    /** Header Layout */
    $wp_customize->add_section(
        'header_layout_section',
        array(
            'title'    => __( 'Header Layout', 'chic-lite' ),
            'panel'    => 'layout_settings',
            'priority' => 10,
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'header_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'header_layout_text',
            array(
                'section'     => 'header_layout_section',
                'priority'    => 30,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'header_layout_img', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio',
            'transport'         => 'postMessage'
        ) 
    );

    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'header_layout_img',
            array(
                'section'     => 'header_layout_section',
                'priority'    => 50,
                'feat_class' => 'upg-to-pro',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/header-layout.png',
                ),
            )
        )
    );

    /** Header Layout Ends*/
    
    /** Slider Layout */
    $wp_customize->add_section(
        'slider_layout_section',
        array(
            'title'    => __( 'Slider Layout', 'chic-lite' ),
            'panel'    => 'layout_settings',
            'priority' => 23,
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'slider_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'slider_layout_text',
            array(
                'section'     => 'slider_layout_section',
                'priority'    => 30,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'slider_layout_img', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio',
        ) 
    );

    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'slider_layout_img',
            array(
                'section'     => 'slider_layout_section',
                'feat_class' => 'upg-to-pro',
                'priority'    => 50,
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/slider-layout.png',
                ),
            )
        )
    );

    /** Slider Layout Ends*/

    /** Home Page Layout */
    $wp_customize->add_section(
        'homepage_layout_section',
        array(
            'title'    => __( 'Homepage Layout', 'chic-lite' ),
            'panel'    => 'layout_settings',
            'priority' => 15,
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'homepage_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'homepage_layout_text',
            array(
                'section'     => 'homepage_layout_section',
                'priority'    => 30,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'homepage_layout_img', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio',
        ) 
    );

    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'homepage_layout_img',
            array(
                'section'     => 'homepage_layout_section',
                'feat_class' => 'upg-to-pro',
                'priority'    => 50,
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/home-layout.png',
                ),
            )
        )
    );

    /** Home Page Layout Ends*/
    
    /** Archive Page Layout */
    $wp_customize->add_section(
        'archivepage_layout_settings',
        array(
            'title'    => __( 'Archive Page Layout', 'chic-lite' ),
            'panel'    => 'layout_settings',
            'priority' => 25,
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'archivepage_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'archivepage_layout_text',
            array(
                'section'     => 'archivepage_layout_settings',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'archivepage_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio',
        ) 
    );

    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'archivepage_layout_settings',
            array(
                'section'     => 'archivepage_layout_settings',
                'feat_class' => 'upg-to-pro',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/archive-layout.png',
                ),
            )
        )
    );

    /** Archive Page Layout Ends*/
    
    /** Featured Area Layout */
    $wp_customize->add_section(
        'feat_area_layout_settings',
        array(
            'title'    => __( 'Featured Area Layout', 'chic-lite' ),
            'panel'    => 'layout_settings',
            'priority' => 30,
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'feat_area_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'feat_area_layout_text',
            array(
                'section'     => 'feat_area_layout_settings',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'feat_area_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio',
        ) 
    );

    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'feat_area_layout_settings',
            array(
                'section'     => 'feat_area_layout_settings',
                'feat_class' => 'upg-to-pro',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/featured-layout.png',
                ),
            )
        )
    );

    /** Featured Area Layout Ends*/
    
    /** Single Post Layout */
    $wp_customize->add_section(
        'singlepost_layout_settings',
        array(
            'title'    => __( 'Single Post Layout', 'chic-lite' ),
            'panel'    => 'layout_settings',
            'priority' => 35,
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'singlepost_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'singlepost_layout_text',
            array(
                'section'     => 'singlepost_layout_settings',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'singlepost_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio',
        ) 
    );

    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'singlepost_layout_settings',
            array(
                'section'     => 'singlepost_layout_settings',
                'feat_class' => 'upg-to-pro',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/single-layout.png',
                ),
            )
        )
    );

    /** Single Post Layout Ends*/

    /** Pagination Settings */
    $wp_customize->add_section(
        'pagination_layout_settings',
        array(
            'title'    => __( 'Pagination Settings', 'chic-lite' ),
            'panel'    => 'layout_settings',
            'priority' => 40,
        )
    );
    
    /** Note */
    $wp_customize->add_setting(
        'pagination_layout_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );

    $wp_customize->add_control(
        new Chic_Lite_Note_Control( 
            $wp_customize,
            'pagination_layout_text',
            array(
                'section'     => 'pagination_layout_settings',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'chic-lite' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://rarathemes.com/wordpress-themes/chic-pro/?utm_source=chic_lite&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

    $wp_customize->add_setting( 
        'pagination_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'chic_lite_sanitize_radio',
        ) 
    );

    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'pagination_layout_settings',
            array(
                'section'     => 'pagination_layout_settings',
                'feat_class' => 'upg-to-pro',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pro/pagination.png',
                ),
            )
        )
    );

    /** Pagination Settings Ends*/

    /** Home Page Layout Settings */
    $wp_customize->add_section(
        'general_layout_settings',
        array(
            'title'    => __( 'General Sidebar Layout', 'chic-lite' ),
            'priority' => 80,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'chic_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'page_sidebar_layout',
            array(
                'section'     => 'general_layout_settings',
                'label'       => __( 'Page Sidebar Layout', 'chic-lite' ),
                'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in respective page.', 'chic-lite' ),
                'choices'     => array(
                    'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
                )
            )
        )
    );
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'chic_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'post_sidebar_layout',
            array(
                'section'     => 'general_layout_settings',
                'label'       => __( 'Post Sidebar Layout', 'chic-lite' ),
                'description' => __( 'This is the general sidebar layout for posts & custom post. You can override the sidebar layout for individual post in respective post.', 'chic-lite' ),
                'choices'     => array(
                    'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
                )
            )
        )
    );
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'chic_lite_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Chic_Lite_Radio_Image_Control(
            $wp_customize,
            'layout_style',
            array(
                'section'     => 'general_layout_settings',
                'label'       => __( 'Default Sidebar Layout', 'chic-lite' ),
                'description' => __( 'This is the general sidebar layout for whole site.', 'chic-lite' ),
                'choices'     => array(
                    'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
                )
            )
        )
    );
}
add_action( 'customize_register', 'chic_lite_customize_register_layout' );