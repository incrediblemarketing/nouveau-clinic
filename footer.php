</main><!-- end container-fluid -->
<?php if ( ! is_front_page() ) : ?>
	<?php $text = get_field( 'contact_text', 'option' ); ?>
	<section class="block block--cta">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-md-10 col-12">
					<div class="flex">
						<p><?php echo $text; ?></p>
						<a href="/contact/" class="btn btn-primary">Book Now</a>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php

$fl     = get_field( 'footer_layout', 'option' );
$footer = 'components/footers/' . $fl;
get_template_part( $footer );

wp_footer();
?>

</body>

</html>
