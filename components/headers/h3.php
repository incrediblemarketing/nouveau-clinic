<header id="header" class="header3">
    <div class="header-top d-flex justify-content-between align-items-center">
        <a class="logo align-self-center" href="<?php echo esc_url(home_url('/')); ?>">
            <?php get_template_part('components/svg/logo'); ?>
        </a>
        <div class="header-right d-flex align-items-center">
            <?php if ($hsi == 1) { ?>
                <?php get_template_part('components/social', 'icons'); ?>
            <?php } ?>
            <?php get_template_part('components/call'); ?>
        </div>
    </div>
    <div class="menu-container"><?php ubermenu('main', array('menu' => 3)); ?></div>
</header>