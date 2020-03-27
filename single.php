<?php get_header(); ?>
<?php if (is_singular(array('procedure', 'team_members'))) { ?>
    <?php get_template_part('components/content-page'); ?>
<?php } elseif (is_singular('gallery')) {

    $gallery = get_field('single_gallery_layout', 'options');

    if ($gallery == 's1') :
        get_template_part('components/galleries/single-template1');
    elseif ($gallery == 's2') :
        get_template_part('components/galleries/single-template2');
    elseif ($gallery == 's3') :
        get_template_part('components/galleries/single-template3');
    endif;
} else { ?>
<section class="block block--blog-single section__padding content">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'components/post' ); ?>
		<?php endwhile; ?> 
		<?php get_template_part( 'components/navigation-single' ); ?>
	<?php else : ?>
		<?php get_template_part( 'components/post-not-found' ); ?>
	<?php endif; ?>
</section>
<?php } ?>
<?php get_footer(); ?>
