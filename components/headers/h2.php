<?php
$logo = get_field( 'logo_image', 'option' );

?>

<header id="header" class="header2">
	<div class="d-flex align-items-center w-100">
		<div class="d-flex w-100 justify-content-between align-items-center">
			<a class="logo align-self-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo $logo; ?>" />
			</a>
			<nav role="navigation" class="align-items-center">
				<?php ubermenu( 'main', array( 'menu' => 2 ) ); ?>
			</nav>
			<?php if ( $hsi == 1 ) { ?>
				<?php get_template_part( 'components/social', 'icons' ); ?>
			<?php } ?>
			<a href="https://www.vagaro.com/looknatural/book-now" target="_blank" class="btn btn-primary">Book Now</a>
			<?php get_template_part( 'components/call' ); ?>
		</div>
	</div>
</header>
