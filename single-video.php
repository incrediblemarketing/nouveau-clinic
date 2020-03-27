<?php get_header(); ?>
<section class="block block--blog-single section__padding content">
	<article class="post" id="post-<?php the_ID(); ?>">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10">
					<div class="padding--inner">
					<?php if ( have_posts() ) : ?>
						<?php
						while ( have_posts() ) :
							the_post();
							?>
								<h1><?php the_title(); ?></h1>
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="<?php echo get_field( 'video_url' ); ?>" allowfullscreen></iframe>
								</div>
								<?php endwhile; ?> 
							<?php else : ?>
								<?php get_template_part( 'components/post-not-found' ); ?>
							<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</article>
</section>
<?php get_footer(); ?>
