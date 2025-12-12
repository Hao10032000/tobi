<?php

// 1. Khai báo Hỗ trợ Theme và Elementor
add_action('after_setup_theme', function () {
    // Hỗ trợ các tính năng cơ bản
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    
    // Hỗ trợ logo tùy chỉnh của WordPress (Appearance -> Customize -> Site Identity) - Rất nên dùng
    add_theme_support( 'custom-logo' );

    // Elementor compatibility
    if (!isset($GLOBALS['content_width'])) {
        $GLOBALS['content_width'] = 1200;
    }
});

define( 'THEMESFLAT_DIR', trailingslashit( get_template_directory() )) ;
require_once( THEMESFLAT_DIR . 'elementor-options/elementor-options.php');
require_once( THEMESFLAT_DIR . 'elementor-options/elementor-functions.php');


// 2. Enqueue styles và scripts (ĐÃ SỬA: Gộp tất cả vào hook)
add_action('wp_enqueue_scripts', function () {
    // Styles
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css');
     wp_enqueue_style('responsive-css', get_template_directory_uri() . '/assets/css/responsive.css');

    // Scripts
    wp_enqueue_script('jquery-js', get_template_directory_uri() . '/assets/js/jquery.js', array('jquery'), null, true);
    wp_enqueue_script('splitext', get_template_directory_uri() . '/assets/js/SplitText.min.js', array('jquery'), null, true);
    wp_enqueue_script('smoothscroll-js', get_template_directory_uri() . '/assets/js/smoothscroll.js', array('jquery'), null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
});


// 3. Đăng ký Menu
add_action('init', function () {
    register_nav_menus([
        'main-menu' => __('Main Menu', 'tobi')
    ]);
});



function tobi_customize_register($wp_customize) {

    /**
     * ================================
     * 1. SITE LOGO SECTION
     * ================================
     */
    $wp_customize->add_section( 'custom_logo_section', [
        'title'    => __( 'Site Logo', 'tobi' ),
        'priority' => 20,
    ] );

    $wp_customize->add_setting( 'custom_logo_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ] );

    $wp_customize->add_control( new WP_Customize_Image_Control( 
        $wp_customize,
        'custom_logo_image_control',
        [
            'label'    => __( 'Upload Logo', 'tobi' ),
            'section'  => 'custom_logo_section',
            'settings' => 'custom_logo_image',
        ]
    ) );


// ============================
// HEADER SECTION
// ============================
$wp_customize->add_section('header_section', [
    'title'    => __('Header Settings', 'tobi'),
    'priority' => 45,
]);

// ON/OFF BUTTON
$wp_customize->add_setting('header_button_enable', [
    'default'           => true,
    'sanitize_callback' => 'wp_validate_boolean',
]);

$wp_customize->add_control('header_button_enable', [
    'label'   => __('Enable Header Button', 'tobi'),
    'type'    => 'checkbox',
    'section' => 'header_section',
]);

// BUTTON TEXT
$wp_customize->add_setting('header_button_text', [
    'default'           => 'Contact',
    'sanitize_callback' => 'sanitize_text_field',
]);

$wp_customize->add_control('header_button_text', [
    'label'   => __('Header Button Text', 'tobi'),
    'type'    => 'text',
    'section' => 'header_section',
]);

// BUTTON LINK
$wp_customize->add_setting('header_button_link', [
    'default'           => '#',
    'sanitize_callback' => 'esc_url_raw',
]);

$wp_customize->add_control('header_button_link', [
    'label'   => __('Header Button Link', 'tobi'),
    'type'    => 'text',
    'section' => 'header_section',
]);




     // ============================
    // FOOTER SECTION
    // ============================
    $wp_customize->add_section('footer_section', [
        'title'    => __('Footer Settings', 'tobi'),
        'priority' => 50,
    ]);

    // FOOTER LOGO
    $wp_customize->add_setting('footer_logo', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'footer_logo_control',
        [
            'label'    => __('Footer Logo', 'tobi'),
            'section'  => 'footer_section',
            'settings' => 'footer_logo',
        ]
    ));

    // CONTACT TITLE
    $wp_customize->add_setting( 'footer_contact_title', [
        'default'           => 'Contact',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'footer_contact_title', [
        'label'   => __( 'Contact Title', 'tobi' ),
        'type'    => 'text',
        'section' => 'footer_section',
    ] );

    // CONTACT TEXT 1
    $wp_customize->add_setting('footer_contact_text1', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ]);

    $wp_customize->add_control('footer_contact_text1', [
        'label'   => __('Contact Text 1', 'tobi'),
        'type'    => 'textarea',
        'section' => 'footer_section',
    ]);

    // CONTACT TEXT 2
    $wp_customize->add_setting('footer_contact_text2', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ]);

    $wp_customize->add_control('footer_contact_text2', [
        'label'   => __('Contact Text 2', 'tobi'),
        'type'    => 'textarea',
        'section' => 'footer_section',
    ]);

    // ADRESSE TITLE
    $wp_customize->add_setting('footer_address_title', [
        'default'           => 'Adresse',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('footer_address_title', [
        'label'   => __('Adresse Title', 'tobi'),
        'type'    => 'text',
        'section' => 'footer_section',
    ]);

    // ADRESSE TEXT
    $wp_customize->add_setting('footer_address_text', [
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ]);

    $wp_customize->add_control('footer_address_text', [
        'label'   => __('Adresse Text', 'tobi'),
        'type'    => 'textarea',
        'section' => 'footer_section',
    ]);

    // COPYRIGHT
    $wp_customize->add_setting('footer_copyright', [
        'default'           => '© 2025 Your Company. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ]);

    $wp_customize->add_control('footer_copyright', [
        'label'   => __('Copyright Text', 'tobi'),
        'type'    => 'textarea',
        'section' => 'footer_section',
    ]);

}
add_action('customize_register', 'tobi_customize_register');




function mytheme_enqueue_bootstrap() {
    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        array(),
        '5.3.3'
    );

    // Bootstrap JS (không cần jQuery)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.3',
        true
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_bootstrap');

function custom_enqueue_nice_select() {
    // Nice Select CSS
    wp_enqueue_style(
        'nice-select-css',
        'https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/css/nice-select2.min.css'
    );

    // Nice Select JS
    wp_enqueue_script(
        'nice-select-js',
        'https://cdn.jsdelivr.net/npm/nice-select2@2.0.0/dist/js/nice-select2.min.js',
        array('jquery'),
        null,
        true
    );

    // Init script
    wp_add_inline_script('nice-select-js', "
        function initNiceSelect() {
            // Contact Form 7
            document.querySelectorAll('.filter-dropdown-wrapper select').forEach(function (select) {
                if (!select.classList.contains('nice-initialized')) {
                    NiceSelect.bind(select);
                    select.classList.add('nice-initialized');
                }
            });
        }
        document.addEventListener('DOMContentLoaded', initNiceSelect);
        // Contact Form 7 reload
        document.addEventListener('wpcf7mailsent', initNiceSelect);
    ");
}
add_action('wp_enqueue_scripts', 'custom_enqueue_nice_select');

add_filter( 'elementor/fonts/groups', function( $groups ) {
    $groups['custom-fonts'] = __( 'Custom Fonts', 'tobi' );
    return $groups;
});
add_filter( 'elementor/fonts/additional_fonts', function( $fonts ) {

    $fonts['Gotham']      = 'custom-fonts';
    $fonts['Myriad Pro']  = 'custom-fonts';

    return $fonts;
});