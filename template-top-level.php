<?php
/*
 * Template Name: Top Level Procedure Page
 * Template Post Type: procedure
 */
$id = get_the_ID();
 get_header();  ?>

<div class="container-fluid page__top-level">
  <div class="row justify-content-center content section__padding">
    <div class="col-12 col-lg-10">
			<h1><?php echo get_the_title(); ?></h1>
    <?php 
      $args = array(
        'post_type'   => 'procedure',
        'order'       =>  'ASC',
        'orderby'     => 'menu_order',
        'post_parent' => $id
      );
      $query = new WP_Query($args); ?>
      <?php if ($query->have_posts()) : ?>
        <div class="grid__procedures">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="procedure--preview">
                <?php if(has_post_thumbnail()) : ?>
                    <?php echo get_the_post_thumbnail($post->ID, 'featured_thumb'); ?>
                <?php endif; ?>
                <div class="card--bottom">
                  <h2><?php echo get_the_title(); ?></h2>
                  <a href="<?php echo get_the_permalink(); ?>" class="btn btn-tertiary">Learn More</a>
                </div>
            </div>
            <?php endwhile; ?> 
        </div>
      <?php endif; ?>  
    </div>
  </div>
</div>
<?php get_footer(); ?>