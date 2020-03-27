<?php
	global $post;
	$gID      = get_the_id();
	$theTitle = get_the_title( $gID );
?>
<?php get_header(); ?>
<div id="gallery-archive" class="row d-flex justify-content-center gallery g3 content">
	<div class="col-lg-10 col-12">
		<div class="pad-v-md">
			<div class="inner-container">
				<div class="breadcrumb">
					<a href="/gallery/">Gallery</a> / <?php echo $theTitle; ?>
				</div>
				<h1><?php echo get_the_title(); ?></h1>
				<div class="swiper-container gallery-carousel">
						<div class="swiper-wrapper">
						<?php
						$gallery = get_field( 'gallery_images' );
						if ( $gallery ) :
							?>
							<?php foreach ( $gallery as $image ) : ?>
									<div class="swiper-slide">
										<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
									</div>
							<?php endforeach; ?>
						<?php endif; ?>
						</div>
						<div class="swiper-button-next"><i class="fal fa-long-arrow-right"></i></div>
    				<div class="swiper-button-prev"><i class="fal fa-long-arrow-left"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>
