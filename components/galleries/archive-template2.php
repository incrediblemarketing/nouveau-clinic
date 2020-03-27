<div id="gallery-archive" class="row d-flex justify-content-center gallery-archive a2 content">
	<div class="col-lg-10 col-12">
		<div class="pad-v-md">
			<div class="inner-container">
				<h1 class="fancy"><span>Gallery Photos</span></h1>
				<div class="gallery--grid">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
						<?php the_post();	?>
							<div class="item">
								<a href="<?php echo get_the_permalink(); ?>">
									<?php echo get_the_post_thumbnail(); ?>
									<h3><?php echo get_the_title(); ?></h3>
								</a>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>