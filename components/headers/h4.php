<header id="header" class="header4">
    <div class="header-left">
        <a href="/contact-us/" class="btn btn-primary">BOOK NOW</a>
        <?php get_template_part('components/call'); ?>
    </div>
    <a href="<?php echo get_home_url(); ?>"><?php get_template_part('components/svg/logo'); ?></a>
    <div class="header-right">
        <button data-toggle="toggle-menu">
            <p>MENU</p>
            <?php get_template_part('components/svg/menu-button'); ?>
        </button>
    </div>
</header>