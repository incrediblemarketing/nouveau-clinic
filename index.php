<?php get_header(); ?>

<div class="row justify-content-center sh-row">
    <div class="col-lg-7 col-12 sh-col">
        <div class="pad-v-md">
            <?php if (have_posts()) : ?>

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('components/post-preview'); ?>

                <?php endwhile; ?>

                <?php get_template_part('components/navigation-loop'); ?>

            <?php else : ?>

                <?php get_template_part('components/post-not-found'); ?>

            <?php endif; ?>

        </div>
    </div>
    <div class="col-lg-3">
        <?php get_sidebar('blog'); ?>
    </div>
</div>

<?php get_footer(); ?>