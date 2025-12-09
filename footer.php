    <?php

?>

    <footer class="site-footer">
        <div class="tf-container">
            <div class="row footer-container">
                <div class="col-lg-3 col-md-4 col-sm-3">
                    <div class="footer-logo">
                        <?php
                $footer_logo = get_theme_mod('footer_logo');
                if ($footer_logo): ?>
                        <img src="<?php echo esc_url($footer_logo); ?>" alt="Footer Logo">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4 col-sm-5">
                    <div class="footer-contact">
                        <h3><?php echo esc_html(get_theme_mod('footer_contact_title')); ?></h3>
                        <div class="text-wraps">
                            <div class="text">
                            <?php echo wp_kses_post(get_theme_mod('footer_contact_text1')); ?>
                        </div>
                        <div class="text">
                            <?php echo wp_kses_post(get_theme_mod('footer_contact_text2')); ?>
                        </div>

                        </div>                       
                    </div>

                </div>

                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="footer-address">
                        <h3><?php echo esc_html(get_theme_mod('footer_address_title')); ?></h3>
                        <div class="text">
                            <?php echo wp_kses_post(get_theme_mod('footer_address_text')); ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="footer-bottom">
                <div class="coppyright">
                    <p><?php echo wp_kses_post(get_theme_mod('footer_copyright')); ?></p>
                </div>
            </div>
        </div>
    </footer>

    <div class="go-top">
        <i class="icon-clevercarsale-arrowright"></i>
    </div>
    <!-- wrapp -->
    </div>
    <?php wp_footer(); ?>
    </body>

    </html>