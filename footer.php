</main><!-- end container-fluid -->
<?php 

	$fl = get_field('footer_layout' , 'option');
	$fsi = get_field('footer_social_icons' , 'option');
	$fh = get_field('footer_header', 'option');
	$mapImg = get_field('map_image', 'option');
	$copyright = get_field('copyright', 'option');
    $footerTitle = get_field('footer_header', 'option');
	$address = get_field('business_street_address', 'option');
	$address2 = get_field('business_city_state_zip', 'option');
	$addressLink = get_field('business_address_link', 'option');
	$phone = get_field('business_phone_display', 'option');
	$phoneURL = get_field('business_phone_url', 'option');
	$email = get_field('business_email_address', 'option');
	$lat = get_field('map_latitude', 'option');
	$long = get_field('map_longitude', 'option');

	function footer_menu() {
		$fm = get_field('footer_menu', 'option');
		return ($fm && in_array('Show Footer Menu', $fm));
	}
?>
		<?php if($fl == 'f1'): ?>
			<footer id="footer" class="f1 clearfix container-fluid">
                <?php if($mapImg){ ?>
                    <div id="map"<?php echo ' data-bg="'.$mapImg['url'].'"'; ?>></div>
                <?php } ?>
				<div class="row justify-content-center">
					<div class="col-12 col-xl-8 col-md-10">
						<h2 class="text-center"><?php echo $footerTitle; ?></h2>
						<div class="row contact text-center">
							<div class="col">
								<h4>Address</h4>
								<p><a href="<?php echo $addressLink; ?>" target="_blank"><?php echo $address; ?><br/><?php echo $address2; ?></a></p>
							</div>
							<div class="col">
								<h4>Phone</h4>
								<p><a href="tel:<?php echo $phoneURL; ?>"><?php echo $phone; ?></a></p>
							</div>
							<?php if ( $fsi == 1 ) : ?>
							<div class="col">
								<h4>Follow Us</h4>
								<ul class="social-icons">
									<?php get_template_part('components/social', 'icons'); ?>
								</ul>
							</div>
							<?php endif; ?>
						</div>
						<?php echo do_shortcode('[gravityform id=3 title=false description=false]'); ?>
					</div>
				</div>			
			</footer><!-- end #footer -->
			<div id="footer-bottom" class="container-fluid">
				<div class="row">
					<div class="col copyright">			
						<p>&copy; <?php echo date('Y'); ?> <?php echo $copyright ?: get_bloginfo(); ?> | Digital Marketing By <a href="http://www.incrediblemarketing.com/" target="_blank"><?php get_template_part('components/svg/incredible-marketing'); ?>Incredible Marketing</a></p>
					</div>
				</div> <!-- end row --> 
			</div>
		<?php elseif($fl == 'f2') :?>
			<div id="footer-top" class="clearfix container-fluid">
				<div class="row justify-content-center">
					<div class="col-sm-10 col-12">
						<div class="row">
						<?php 
							$the_query = new WP_Query( 'posts_per_page=2' ); 

							while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
								<div class="col-sm-6">
									<a href="<?php the_permalink() ?>" class="alignleft"><?php the_post_thumbnail(); ?></a>
									<a href="<?php the_permalink() ?>" class="blog-header"><?php the_title(); ?></a>
									<p>By <span class="primary-text"><?php echo get_the_author(); ?></span> | <?php echo get_the_date(); ?></p>
									<?php the_excerpt(); ?>
								</div>
							<?php 
							endwhile;
						wp_reset_postdata();
						?>
						</div>
					</div>
				</div>
			</div>
			<footer id="footer" class="f2 clearfix container-fluid">
				<div class="row justify-content-center">
					<div class="col-lg-10 col-sm-12 col-12">
						<div class="col-12">
							<h3 class="text-center"><?php $footerTitle; ?></h3>
						</div>
						<div class="row contact">
							<div class="col-sm-6 col-12">
                                <?php if($mapImg){ ?>
                                    <div id="map"<?php echo ' data-bg="'.$mapImg['url'].'"'; ?>></div>
                                <?php } ?>
							</div>
							<div class="col-sm-6 col-12">
								<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>
							</div>
						</div>
						<div class="row">
							<?php if ( $fsi == 1 ) : ?>
								<ul class="social-icons right">
									<?php get_template_part('components/social', 'icons'); ?>
								</ul>
							<?php endif; ?>
							<div class="copyright text-center">
								<p>&copy; <?php echo date('Y'); ?> <?php echo $copyright ?: get_bloginfo(); ?> | Digital Marketing By <a href="http://www.incrediblemarketing.com/" target="_blank"><?php get_template_part('components/svg/incredible-marketing'); ?>Incredible Marketing</a></p>
							</div>
						</div>
					</div>
				</div>			
			</footer><!-- end #footer -->
		<?php elseif($fl == 'f3') : ?>
			<footer id="footer" class="f3 clearfix">
				<div class="row">
                    <?php if($mapImg){ ?>
                        <div id="map"<?php echo ' data-bg="'.$mapImg['url'].'"'; ?>></div>
                    <?php } ?>
					<div class="col-lg-4 col-md-5 offset-md-7 col-xs-12 col-bg pad-sm">
						<h3>Contact Us</h3>
						<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>
					</div>
				</div>	
				<div class="row footer-bg justify-content-center">
					<div class="col-md-10 col-sm-12 col-xs-12 pad-v-sm">
						<div class="row">
							<div class="col">
								<h3><?php echo $footerTitle ?: get_bloginfo(); ?></h3>
								<p><i class="fas fa-phone squared" aria-hidden="true"></i> <a href="tel:<?php echo $phoneURL; ?>"><?php echo $phone; ?></a></p>
								<p><i class="fas fa-envelope squared" aria-hidden="true"></i> <a href="mailto:<?php echo $email; ?>" target="_top">Contact Us</a></p>
								<p><i class="fas fa-home squared" aria-hidden="true"></i> <a href="<?php echo $addressLink; ?>" target="_blank"><?php echo $address; ?> <?php echo $address2; ?></a></p>
								<p><i class="far fa-calendar-alt squared" aria-hidden="true"></i> <a href="/contact" target="_blank">Book an Appointment</a></p>
							</div>
							<div class="col">
								<h4 class="line-right"><span>Follow Us</span></h4>
								<ul class="social-icons d-flex">
									<?php get_template_part('components/social', 'icons'); ?>
								</ul>
								<h4 class="line-right mt-3 pad-v-xs"><span>Newsletter</span></h4>
								<?php echo do_shortcode('[gravityform id=2 title=false description=false]'); ?>
							</div>
							<div class="col blog-roll">
								<h4 class="line-right"><span>Latest News</span></h4>
								<?php 
									$the_query = new WP_Query( 'posts_per_page=3' ); 

									while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
										<div class="row">
											<div class="col mb-3">
												<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium', array( 'class' => 'alignleft' ) ); ?></a><a href="<?php the_permalink() ?>" class="blog-header"><?php the_title(); ?></a>
												<div class="excerpt"><?php echo incredible_custom_excerpts(7); ?></div>
											</div>
										</div>
									<?php 
									endwhile;
								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row footer-bg">
					<div class="col text-center">
						<div class="copyright">
							<p>&copy; <?php echo date('Y'); ?> <?php echo $copyright ?: get_bloginfo(); ?> | Digital Marketing By <a href="http://www.incrediblemarketing.com/" target="_blank"><?php get_template_part('components/svg/incredible-marketing'); ?>Incredible Marketing</a></p>
						</div>
					</div>
				</div>
			</footer><!-- end #footer -->
		<?php elseif($fl == 'f4') : ?>
			<footer id="footer" class="f4 clearfix">
				<div class="container-fluid">
					<div class="row py-5 justify-content-center">
						<div class="col-lg-10 col-12">
							<div class="row d-flex sh-row">
								<div class="col-lg-4 col-12 sh-col">
									<div class="map-container inner box-shadow">
                                        <?php if($mapImg){ ?>
                                            <div id="map"<?php echo ' data-bg="'.$mapImg['url'].'"'; ?>></div>
                                        <?php } ?>
									</div>
								</div>
								<div class="col-lg-4 col-12 sh-col">
									<div class="inner-block">
										<h3><?php echo $footerTitle ?: get_bloginfo(); ?></h3>
										<?php if(get_field('business_locations', 'option')): ?>
											<?php while(has_sub_field('business_locations', 'option')): ?>
												<h4><?php echo get_sub_field('location_title'); ?></h4>
												<?php if(get_sub_field('business_street_address')) : ?>
													<p><a href="<?php echo get_sub_field('business_address_link'); ?>" target="_blank"><?php echo get_sub_field('business_street_address'); ?><br/><?php echo get_sub_field('business_city_state_zip'); ?></a></p>
												<?php endif; ?>
												<?php if(get_sub_field('business_phone_url')) : ?>
													<p>Phone: <a href="tel:<?php echo get_sub_field('business_phone_url'); ?>"><?php echo get_sub_field('business_phone_display'); ?></a></p>
												<?php endif; ?>
												<?php if(get_sub_field('business_fax')) : ?>
													<p>Fax: <?php echo get_sub_field('business_fax'); ?></p>
												<?php endif; ?>
											<?php endwhile; ?>
										<?php endif; ?>
										<ul class="social-icons d-flex">
											<?php get_template_part('components/social', 'icons'); ?>
										</ul>
									</div>
								</div>
								<div class="col-lg-4 col-12 sh-col">
									<div class="inner-block">
										<h3>Contact Us</h3>
										<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center" id="subfooter">
						<div class="col-12 copyright text-center">
							<p>&copy; <?php echo date('Y'); ?> <?php echo $copyright ?: get_bloginfo(); ?> | Digital Marketing By <a href="http://www.incrediblemarketing.com/" target="_blank"><?php get_template_part('components/svg/incredible-marketing'); ?>Incredible Marketing</a></p>
						</div>
					</div>
				</div>
			</footer>
		<?php elseif($fl == 'f5') : ?>
			<footer id="footer" class="f5 clearfix">
				<div class="container-fluid">
					<div class="row d-flex">
						<div class="col-lg-6 col-12 nopad">
                            <?php if($mapImg){ ?>
    							<div id="map"<?php echo ' data-bg="'.$mapImg['url'].'"'; ?>></div>
                            <?php } ?>
							<div class="slant-footer">
								<svg viewbox="0 0 160 600" preserveAspectRatio="xMinYMin meet">
									<polygon points="50,600 160,600 160,0"></polygon>
								</svg>
							</div>
						</div>
						<div class="info col-lg-6 col-12">
							<h3>Contact Us</h3>
                            <?php 
								$counter = 0;
								if(get_field('business_locations', 'option')): ?>
								<?php while(has_sub_field('business_locations', 'option')): ?>
									<?php if(get_sub_field('business_street_address') && $counter < 1) : ?>
									<div class="flex-info">
										<p><i class="fas fa-map-marker-alt"></i> <a href="<?php echo get_sub_field('business_address_link'); ?>" target="_blank"><?php echo get_sub_field('business_street_address'); ?><br/><?php echo get_sub_field('business_city_state_zip'); ?></a></p>
									<?php endif; ?>
									<?php if(get_sub_field('business_phone_url') && $counter < 1) : ?>
										<p><i class="fas fa-phone"></i> <a href="tel:<?php echo get_sub_field('business_phone_url'); ?>"><?php echo get_sub_field('business_phone_display'); ?></a></p>
									</div>
									<?php endif; 
									$counter++; ?>
								<?php endwhile; ?>
							<?php endif; ?>
							
							<?php echo do_shortcode('[gravityform id=1 title=false description=false]'); ?>
						</div>
					</div>
                    <div class="row copyright">
                        <div class="col-12 text-center">
                            <p>&copy; <?php echo date('Y'); ?> <?php echo $copyright ?: get_bloginfo(); ?> | Digital Marketing By <a href="http://www.incrediblemarketing.com/" target="_blank"><?php get_template_part('components/svg/incredible-marketing'); ?>Incredible Marketing</a></p>
                        </div>
                    </div>
				</div>
			</footer>
		<?php elseif($fl == 'f6') : ?>
			<footer id="footer" class="f6 clearfix container-fluid">
				<div class="row justify-content-center">
					<div class="col-12 col-xl-10 col-md-11">
						<div class="row animated fadeIn delay1 duration2 eds-on-scroll ">
							<div class="col-12 col-xl-4 col-md-5 col-sm-6">
								<h4>How<br/>May We<br/>Help You?</h4>
								<?php $counter = 0; ?>
								<?php if(get_field('business_locations', 'option')): ?>
									<?php while(has_sub_field('business_locations', 'option')): ?>
										<?php if($counter > 1): ?>
											<?php if(get_sub_field('business_street_address')) : ?>
												<p><?php echo get_sub_field('business_street_address'); ?><br/><?php echo get_sub_field('business_city_state_zip'); ?></p>
											<?php endif; ?>
											<a href="<?php echo get_sub_field('map_url'); ?>" class="directions" target="_blank">Get Directions</a>
										<?php endif; ?>
										<?php $counter++; ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
							<div class="col-xl-8 col-md-7 col-sm-6 col-12">
								<?php echo do_shortcode('[gravityform id=3 title=false description=false]'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<?php $counter = 0; ?>
								<?php if(get_field('business_locations', 'option')): ?>
									<?php while(has_sub_field('business_locations', 'option')): ?>
										<?php if($counter > 1): ?>
                                            <?php if($mapImg){ ?>
                                                <div id="map"<?php echo ' data-bg="'.$mapImg['url'].'"'; ?>></div>
                                            <?php } ?>
										<?php endif; ?>
										<?php $counter++; ?>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>			
			</footer><!-- end #footer -->
			<div id="footer-bottom" class="f6-bottom container-fluid">
				<div class="row">
					<div class="col copyright">			
						<p>&copy; <?php echo date('Y'); ?> <?php echo $copyright ?: get_bloginfo(); ?> | Digital Marketing By <a href="http://www.incrediblemarketing.com/" target="_blank"><?php get_template_part('components/svg/incredible-marketing'); ?>Incredible Marketing</a></p>
					</div>
				</div> <!-- end row --> 
			</div>
		<?php elseif($fl == 'custom') : ?>
		
		
		
			<!-- This is where any custom code would go or possibly an import from another component for a custom footer. -->
			
			
			
		<?php endif; ?>
        <?php wp_footer(); ?>
    </body>
</html>