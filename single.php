<?php get_header(); ?>
<?php if (is_singular(array('procedure', 'testimonial', 'team'))) { ?>
    <?php get_template_part('page-template/content', 'page'); ?>
<?php } elseif (is_singular('gallery')) {

    $gallery = get_field('single_gallery_layout', 'options');

    if ($gallery == 's1') :
        get_template_part('gallery-templates/single', 'template1');
    elseif ($gallery == 's2') :
        get_template_part('gallery-templates/single', 'template2');
    elseif ($gallery == 's3') :
        get_template_part('gallery-templates/single', 'template3');
    endif;
} else { ?>
    <div class="row justify-content-center sh-row leaf-bg">
        <div class="col-lg-7 col-12 sh-col">
            <div class="pad-v-md">
                <?php if (have_posts()) : ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php get_template_part('components/post'); ?>

                    <?php endwhile; ?>

                    <?php get_template_part('components/navigation-single'); ?>

                <?php else : ?>

                    <?php get_template_part('components/post-not-found'); ?>

                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-3">
            <?php get_sidebar('blog'); ?>
        </div>
    </div>
<?php } ?>
<?php get_footer(); ?>