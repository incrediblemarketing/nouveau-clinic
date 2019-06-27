<?php $fsi = get_field('footer_social_icons', 'options'); ?>

<footer id="footer" class="f7 clearfix container-fluid" data-bg="<?php echo get_field('footer_bg', 'options'); ?>">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-8 col-md-10">
            <?php if (!is_page('contact')) : ?>
                <div class="row grid__footer">
                    <?php if (get_field('business_locations', 'option')) : ?>
                        <?php while (has_sub_field('business_locations', 'option')) : ?>
                            <div class="block__location">
                                <?php if (get_sub_field('location_title')) : ?>
                                    <h4><?php echo get_sub_field('location_title'); ?></h4>
                                <?php endif; ?>
                                <?php if (get_sub_field('business_text')) : ?>
                                    <div class="business-text">
                                        <?php echo get_sub_field('business_text'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (get_sub_field('business_street_address')) : ?>
                                    <p><?php echo get_sub_field('business_street_address'); ?> <?php echo get_sub_field('business_city_state_zip'); ?></p>
                                <?php endif; ?>
                                <?php if (get_sub_field('business_phone_url')) : ?>
                                    <p><a href="tel:<?php echo get_sub_field('business_phone_url'); ?>"><?php echo get_sub_field('business_phone_display'); ?></a></p>
                                <?php endif; ?>
                                <a href="<?php echo get_sub_field('map_url'); ?>" class="btn btn-primary" target="_blank">Get Directions</a>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <div class="block__contact">
                        <h3><?php echo get_field('footer_header', 'options'); ?></h3>
                        <?php echo get_field('footer_text', 'options'); ?>
                        <?php echo do_shortcode('[gravityform id=1 title=false description=false ajax=true]'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="footer--bottom">
                <div class="logo__footer">
                    <?php get_template_part('components/svg/logo'); ?>
                </div>
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> <?php echo $copyright ?: get_bloginfo(); ?> | Digital Marketing By <a href="http://www.incrediblemarketing.com/" target="_blank"><?php get_template_part('components/svg/incredible-marketing'); ?>Incredible Marketing</a></p>
                </div>
                <?php if ($fsi == 1) : ?>
                    <?php get_template_part('components/social-icons'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer><!-- end #footer -->