<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<?php $btnStyle = get_field('button_style', 'option'); ?>

<body <?php body_class($btnStyle); ?>>
    <div style="display: none;">
        <svg width="0" height="0" style="position:absolute">
            <symbol viewBox="0 0 40 40" id="incredible-marketing" xmlns="http://www.w3.org/2000/svg">
                <title>incredible-marketing</title>
                <path d="M33.156 22.044c-.933-1.333-2.933-2.444-5.378-3.6 0 0 1.022-2.667 1.467-6.978.444-4.311-.933-4.578-1.644-4.8-.711-.222-2.222-.756-4.044-1.289 0 0-.356-.178-1.244.222 0 0-1.556.756-3.556 4.089.622.667.667.578 1.778.844 1.111.267 1.422.489 2.889 1.644 0 0 .933-1.6 1.689-2.667.031 2.079-.456 4.397-1.105 6.54a5.778 5.778 0 1 0-10.209 4.576c-1.897-1.018-3.269-1.993-4.33-2.715 0 0 .533 0 1.733.133-.089-1.822.222-2.444.622-3.511.4-1.067.089-1.156-.667-1.244-2.618-.157-3.156.044-3.733.4-.58.356-1.024 2.312-1.38 3.334-.355 1.022-.844 2.222-.222 2.978.622.756.978 2.044 7.156 5.111-.533 3.556-.222 4.578.178 5.689.4 1.111 3.111 1.867 4.533 2.4 1.422.533 2.222.089 3.156-.8.933-.889 1.156-1.022 2.578-3.511 0 0 3.244.622 6 .622s3.244-3.111 3.733-4.267c.488-1.155.933-1.866 0-3.2zm-15.423 7.2l.222-2 .844.267c.001 0-.31.756-1.066 1.733zm3.245-5.733a41.105 41.105 0 0 1-2.265-.727 5.76 5.76 0 0 0 3.218-1.26c-.552 1.227-.953 1.987-.953 1.987zm4.533 1.378s.4-.844.844-1.956c0 0 1.511.889 3.556 2.311 0 0-1.822.045-4.4-.355z"></path>
            </symbol>
            <symbol viewBox="0 0 102.08 19.41" id="rightarrow" xmlns="http://www.w3.org/2000/svg">
                <title>Arrow</title>
                <polygon points="81.25 17.99 82.67 19.41 102.08 0 99.25 0 92.83 0 0 0 0 2 97.25 2 81.25 17.99" />
            </symbol>
        </svg>
    </div>
    <?php
    $hl = get_field('header_layout');
    if (!$hl) {
        $hl = get_field('header_layout', 'options');
    }
    $hsi = get_field('header_social_icons', 'options');
    $sticky = get_field('sticky_header', 'options');
    $hideHeader = get_field('hide_page_header');
    ?>
    <?php if ($sticky == 1) : ?>
        <div id="stickyHeader" class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center w-100">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <?php get_template_part('components/header', 'logo'); ?>
                    <nav role="navigation" class="d-flex align-items-center">
                        <?php ubermenu('main', array('menu' => 3)); ?>
                    </nav>
                    <?php get_template_part('components/header', 'call'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($hl == 'h1') { ?>
        <header id="header" class="header1">
            <div class="header-top d-flex align-items-center justify-content-between">
                <?php if ($hsi == 1) : ?>
                    <ul class="social-icons d-flex p-4">
                        <?php get_template_part('components/social', 'icons'); ?>
                    </ul>
                <?php endif; ?>
                <?php get_template_part('components/header', 'logo'); ?>
                <?php get_template_part('components/header', 'call'); ?>
            </div>
            <nav role="navigation" class="d-flex justify-content-center">
                <?php ubermenu('main', array('menu' => 3)); ?>
            </nav>
        </header>
    <?php } elseif ($hl == 'h2') { ?>
        <header id="header" class="header2">
            <div class="d-flex align-items-center w-100">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <?php get_template_part('components/header', 'logo'); ?>
                    <nav role="navigation" class="d-flex align-items-center">
                        <?php ubermenu('main', array('menu' => 3)); ?>
                    </nav>
                    <?php if ($hsi == 1) { ?>
                        <ul class="social-icons">
                            <?php get_template_part('components/social', 'icons'); ?>
                        </ul>
                    <?php } ?>
                    <?php get_template_part('components/header', 'call'); ?>
                </div>
            </div>
        </header>
    <?php } elseif ($hl == 'h3') { ?>
        <header id="header" class="header3">
            <div class="header-top d-flex justify-content-between align-items-center">
                <?php get_template_part('components/header', 'logo'); ?>
                <div class="header-right d-flex align-items-center">
                    <?php if ($hsi == 1) { ?>
                        <ul class="social-icons">
                            <?php get_template_part('components/social', 'icons'); ?>
                        </ul>
                    <?php } ?>
                    <?php get_template_part('components/header', 'call'); ?>
                </div>
            </div>
            <div class="menu-container"><?php ubermenu('main', array('menu' => 3)); ?></div>
        </header>
    <?php } ?>

    <main role="main" class="container-fluid">
        <?php
        if (!is_front_page() && $hideHeader == 0) {
            $headerImage = get_field('background_image');
            if (!$headerImage) {
                $headerImage = get_field('default_header_image', 'options');
            } ?>
            <div id="page-header" class="row" data-bg="<?php echo $headerImage['sizes']['header_bg']; ?>"></div>
        <?php
    } ?>