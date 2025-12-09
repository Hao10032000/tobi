<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="wrapper-body">

        <header class="site-header">

            <!-- Main Navigation -->
            <div class="tf-container">
                <div class="main-header">
                    <?php
                $custom_logo = get_theme_mod( 'custom_logo_image' );
            ?>

                    <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                            <img src="<?php echo esc_url( $custom_logo ? $custom_logo : get_template_directory_uri() . '/assets/img/logo.png' ); ?>"
                                alt="Logo">
                        </a>
                    </div>

                    <nav class="main-menu">
                        <?php
                            wp_nav_menu([
                            'theme_location' => 'main-menu',
                            'container' => false,
                            'menu_class' => 'menu',
                            ]);
                        ?>
                    </nav>
                    <?php if ( get_theme_mod('header_button_enable', true) ) : ?>
                    <div class="header-right">
                        <a href="<?php echo esc_url(get_theme_mod('header_button_link', '#')); ?>" class="tf-button">
                            <span><?php echo esc_html(get_theme_mod('header_button_text', 'Contact')); ?></span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.27002 0V1.73H7.19995L0 8.92L1.23999 10.16L8.43994 2.97V9.9H10.17V0H0.27002Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                    <?php endif; ?>


                    <button class="menu-toggle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                        aria-controls="offcanvasExample">
                        <span></span>
                    </button>

                </div>
            </div>

        </header>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="mobile-menu-content">
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                            <img src="<?php echo esc_url( $custom_logo ? $custom_logo : get_template_directory_uri() . '/assets/img/logo.png' ); ?>"
                                alt="Logo">
                        </a>
                    </div>

                    <?php
            wp_nav_menu([
                'theme_location' => 'main-menu',
                'container'      => false,
                'menu_class'     => 'mobile-menu',
            ]);
        ?>
                    <?php if ( get_theme_mod('header_button_enable', true) ) : ?>
                    <div class="header-right">
                        <a href="<?php echo esc_url(get_theme_mod('header_button_link', '#')); ?>" class="tf-button">
                            <span><?php echo esc_html(get_theme_mod('header_button_text', 'Contact')); ?></span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.27002 0V1.73H7.19995L0 8.92L1.23999 10.16L8.43994 2.97V9.9H10.17V0H0.27002Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>