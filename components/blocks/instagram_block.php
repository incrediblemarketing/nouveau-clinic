<?php
$instaLink = '';
if ( have_rows( 'social_icons', 'option' ) ) :
	while ( have_rows( 'social_icons', 'option' ) ) :
		the_row();
		if ( get_sub_field( 'social_icon' ) === 'instagram' ) :
			$instaLink = get_sub_field( 'social_url' );
		endif;
	endwhile;
endif; ?>

<div class="row block__instagram justify-content-center">
	<div class="col-lg-10 col-12">
		<div class="social-top d-flex align-items-center justify-content-between">
			<h2><i class="fab fa-instagram"></i> Connect With Us</h2>
			<p class="insta-handle">#THENOUVEAUCLINIC</p>
			<p><a class="btn btn-primary" href="<?php echo $instaLink; ?>" target="_blank" rel="noopener">View Instagram</a></p>
		</div>
	</div>
	<div class="col-12 nopad">
		<?php echo do_shortcode( '[elfsight_instagram_feed id="1"]' ); ?>
	</div>
</div>
