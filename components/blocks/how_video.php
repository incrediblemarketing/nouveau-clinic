
<section class="block__videos justify-content-center padding--section">
	<div class="container-fluid">
		<div class="row justify-content-center content section__padding">
			<div class="col-12 col-xl-8">
				<h1><?php echo get_the_title(); ?></h1>
				 <?php 				 
				$videos = get_sub_field('videos');
				if( $videos ): ?>
					<div class="grid__procedures">
						<?php foreach( $videos as $post): // variable must be called $post (IMPORTANT) ?>
						<?php setup_postdata($post); ?>
							<div class="procedure--preview">
									<?php if(has_post_thumbnail()) : ?>
											<?php echo get_the_post_thumbnail($post->ID, 'featured_thumb'); ?>
									<?php endif; ?>
									<div class="card--bottom">
										<h2><?php echo get_the_title(); ?></h2>
										<a href="<?php echo get_the_permalink(); ?>" class="btn btn-tertiary">Learn More</a>
									</div>
							</div>
						<?php endforeach; ?> 
					</div>
				<?php endif; ?>  
			</div>
		</div>
  </div>
</section>
