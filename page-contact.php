<?php get_header(); ?>
<?php $fsi = get_field( 'footer_social_icons', 'options' ); ?>
<?php $business_location = get_field( 'business_locations', 'options' )[0]; ?>
<?php $map = get_field( 'map_image', 'options' ); ?>

<div class="row block__contact-page justify-content-center">
	<div class="col-md-6 col-12" data-bg="<?php echo get_field( 'background_page_image', 'option' ); ?>">
		<div id="contact" class="contact pad-md">
			<h1>Contact Us</h1>
					<div class="business-text">
						<?php echo $business_location['business_text']; ?>
					</div>
					<p><i class="fas fa-phone-alt"></i> <a href="tel:<?php echo $business_location['business_phone_url']; ?>"><?php echo $business_location['business_phone_display']; ?></a></p>
					<p><i class="fas fa-map-marker-alt"></i> <?php echo $business_location['business_street_address']; ?> <?php echo $business_location['business_city_state_zip']; ?></p>
					<div class="map">
						<img src="<?php echo $map; ?>" />
					</div>
		</div>
	</div>
	<div class="col-md-6 col-12 bg--primary white">
		<div class="contact pad-md">
			<h2>Schedule a Consultation</h2>
			<?php echo do_shortcode( '[gravityform id=3 title=false description=false ajax=true]' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
