<header id="header" class="header1">
    <div class="header-top d-flex align-items-center justify-content-between">
        <?php if ($hsi == 1) : ?>
            <?php get_template_part('components/social', 'icons'); ?>
        <?php endif; ?>
        <a class="logo align-self-center" href="<?php echo esc_url(home_url('/')); ?>">
            <?php get_template_part('components/svg/logo'); ?>
        </a>
        <?php get_template_part('components/call'); ?>
    </div>
    <nav role="navigation" class="d-flex justify-content-center">
        <?php ubermenu('main', array('menu' => 3)); ?>
    </nav>
</header>