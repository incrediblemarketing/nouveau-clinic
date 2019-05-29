<?php
	if( have_rows('sections') ):
		while ( have_rows('sections') ) : the_row();

			/* HERO SECTION
			================================================*/
			if( get_row_layout() == 'home_slider' ){
				$type = get_sub_field('slider_type');
				$rev = get_sub_field('rev_slider_shortcode');
				$textalign = get_sub_field('textarea_align');
				$overlayhero = get_sub_field('slight_overlay');
			?>
				<section class="row">
					<div class="col-12<?php if(!$overlayhero) { echo ' no-overlay'; } ?><?php if($type == 'Video'){ echo ' video-overlay'; } ?><?php if($type == 'Slider'){ echo ' hero-slider'; } ?>" id="hero" data-bg="<?php echo get_sub_field('slider_bg'); ?>">
						<?php if($type == 'Video'){ ?>
							<video poster="<?php echo get_sub_field('slider_bg'); ?>" id="bgvid" playsinline autoplay muted loop controls>
								<source src="<?php echo get_sub_field('webm_file')['url']; ?>" type="video/webm">
								<source src="<?php echo get_sub_field('mp4_file')['url']; ?>" type="video/mp4">
							</video>
						<?php }elseif($type == 'Slider') {?>
							<div class="swiper-container hero-rotator">
								<div class="swiper-wrapper">
									<?php
									if( have_rows('slider') ):
										while ( have_rows('slider') ) : the_row(); 
											if( get_row_layout() == 'slide' ):?>
											<div class="swiper-slide <?php if(get_sub_field('slide_overlay')){ echo 'overlay'; } ?>" data-bg="<?php echo get_sub_field('background_image'); ?>">
												<div class="inner-flex align-items-center <?php echo get_sub_field('slide_row_css'); ?>">
													<div class="inner <?php echo get_sub_field('slide_column_css'); ?>">
														<div class="info">
															<?php echo get_sub_field('slider_slide_content'); ?>
														</div>
													</div>
												</div>
											</div>
									<?php
											endif;
										endwhile;
									endif;
									?>
								</div>	
							</div>
						</div>
						<?php } ?>
						
						<div class="inner <?php echo $textalign; ?>">			
							<div class="info <?php echo $textalign; ?>">
								<?php echo get_sub_field('slide_content'); ?>
							</div>
						</div>
					</div>
				</section><?php 
				
			/* PAGE
			================================================*/
			}elseif( get_row_layout() == 'page' ){ 
				$content = get_sub_field('column_1_content');
				$rc = get_sub_field('row_class');
				$c1c = get_sub_field('column_1_class');
				$bc = get_sub_field('background_color');
				$bg = get_sub_field('background_image');
				$fc = get_sub_field('font_color');
				$fs = get_sub_field('font_size');
				$ta = get_sub_field('text_align');
				$pad = get_sub_field('padding');
				$showSidebar = get_sub_field('show_sidebar');
				$featuredImage = get_sub_field('featured_image_side');
				$fory = get_sub_field('youtube_or_featured_image');
				
				if($showSidebar == 1){
					$sideC = get_sub_field('sidebar_content');
					$sideCSS = get_sub_field('sidebar_css');
					$show_gallery = get_sub_field('show_gallery');
					$sidebar_side = get_sub_field('sidebar_side');
					if($show_gallery == 1){
						$gallery_link = get_sub_field('gallery_link');
					}
				}
				
				/* GET DEFAULTS IF NOTHING WAS SELECTED
				================================================*/
				if(!$rc){$rc = get_field('row_class','options');}
				if(!$c1c){$c1c = get_field('column_1_class','options');}
				if(!$bc){$bc = get_field('background_color','options');}
				if(!$bg){$bg = get_field('background_image','options');}
				if(!$fc){$fc = get_field('font_color','options');}
				if(!$fs){$fs = get_field('font_size','options');}
				if(!$ta){$ta = get_field('text_align','options');}
				if(!$pad){$pad = get_field('padding','options');}
				
				if($showSidebar == 1){
					if($sidebar_side == true){
						echo '<div class="row justify-content-center flex-row-reverse ' . $rc . ' sh-row" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'" data-bg="'.$bg.'">';
					}else{
						echo '<div class="row justify-content-center ' . $rc . ' sh-row" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'" data-bg="'.$bg.'">';
					}
				}else{
					echo '<div class="row justify-content-center ' . $rc . ' sh-row" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'" data-bg="'.$bg.'">';
				}
					if($showSidebar == 1){
						echo '<div class="col-lg-7 col-12 content pl-5 sm-pad ' . $c1c . ' ' . $ta . ' sh-col">';	
					}else{
						echo '<div class="col-lg-10 col-12 content ' . $c1c . ' ' . $ta . ' sh-col">';
					}
							echo '<div class="pad-v-md">';
								echo '<h1>'.get_the_title().'</h1>';
								if(has_post_thumbnail() && !$fory){
									if($featuredImage == true){
										echo '<div class="img alignleft">';
									}else{
										echo '<div class="img alignright">';
									}
										the_post_thumbnail('postslider_thumb', array( 'class' => 'img-responsive' ));
									echo '</div>';
								}
								if($fory){
									$youtubeID = get_sub_field('youtube_id');
									
									echo '<div class="col-xl-6 col-lg-12 col-md-6 col-12 alignright">';
										echo '<div class="embed-responsive embed-responsive-16by9">';
											echo '<iframe id="featured-video" class="embed-responsive-item" src="//www.youtube.com/embed/'.$youtubeID.'?enablejsapi=1&rel=0" allowfullscreen></iframe>';
										echo '</div>';
									echo '</div>';
								}
								echo $content;
								echo '<div class="clearfix"></div>';
							echo '</div>';
				
						echo '</div>'; /*end content*/

						if($showSidebar == 1){
							if($sidebar_side == true){
								echo '<div id="sidebar" class="sidebar-left col-lg-3 col-12 ' . $sideCSS . ' sh-col">';	
							}else{
								echo '<div id="sidebar" class="sidebar-right col-lg-3 col-12 ' . $sideCSS . ' sh-col">';
							}
								echo '<div class="pad-v-md">';

									dynamic_sidebar( 'page_sidebar' );
							
									/*Sidebar Page Menu*/
									$showpages = get_sub_field('show_page_menu');
									if($showpages == 1){
										$parent = get_sub_field('select_parent_page');
										if($parent){
											echo '<h5>'.get_the_title($parent).' Menu</h5>';
											echo '<ul class="sidebar-menu">';
													wp_list_pages( array( 'post_type' => 'page', 'title_li' => '', 'child_of' => $parent, 'depth' => 1 ) );
											echo '</ul>';
										}
									}

									$procedures = get_field('turn_onoff_procedures', 'options');
									if($procedures == 1){
										$showprocedures = get_sub_field('show_procedures_menu');
										$post_ID=get_the_ID();
										if($showprocedures == 1){
											echo '<h5>Procedures</h5>';
											echo '<ul class="sidebar-menu">';
												if((wp_get_post_parent_id($post_ID) == 0) || (get_post_type($post_ID) != 'procedure')){ 
													wp_list_pages( array( 'post_type' => 'procedure', 'title_li' => '', 'depth' => 1 ) );
												}else{
													wp_list_pages( array( 'post_type' => 'procedure', 'title_li' => '', 'child_of' => wp_get_post_parent_id( $post_ID ), 'depth' => 1 ) );
												}
											echo '</ul>';
										}
									}

									$testimonials = get_field('turn_onoff_testimonials', 'options');
									if($testimonials == 1):
										$showtestimonials = get_sub_field('show_testimonials_rotator');
										if($showtestimonials == 1):
											$testimonials = get_sub_field('sidebar_testimonials');
											echo '<div class="testimonial-container">';
												echo '<h5 class="text-center">Testimonials</h5>';
												if( $testimonials ): ?>
													<div class="owl-carousel owl-theme testimonials-rotator">
														<?php foreach( $testimonials as $post): ?>
															<?php setup_postdata($post); ?>
															<div class="item">
																<?php the_content(); ?>
																<strong><?php the_title(); ?></strong>
															</div>
														<?php endforeach; ?>
													</div><?php 
													wp_reset_postdata();
												endif;
											echo '</div>';
										endif;
									endif;

									$gallery = get_field('turn_onoff_gallery', 'options');
									if($gallery == 1 && $show_gallery == 1){
										echo '<div class="sidebar-gallery">';
											echo '<h5>Gallery</h5>';
											$images = get_field('gallery_images', $gallery_link);

											if( $images ){ ?>
												<ul class="owl-carousel owl-theme mini-gallery">
													<?php foreach( $images as $image ): ?>
														<li class="item"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive" /></li>
													<?php endforeach; ?>
												</ul>
											<?php } ?>
											<a href="<?php the_permalink($gallery_link); ?>" class="btn btn-primary">View Patient Gallery</a><?php 
										echo '</div>';
									}
							
									if($sideC){
										echo '<div class="sidebar-content">';
											echo $sideC;
										echo '</div>';
									}

								echo '</div>';
							echo '</div>';
						}
				echo '</div>';
				
			/* RELATED POSTS
			================================================*/
			}elseif( get_row_layout() == 'related_posts' ){
				$posts_category = get_sub_field('posts_category');
				$bc = get_sub_field('background_color');
				$fc = get_sub_field('font_color');
				$fs = get_sub_field('font_size');
				$pad = get_sub_field('padding');
				if($posts_category){
					echo '<section class="row graybg">';
						echo '<div class="col-lg-10 col-lg-offset-lg-1 col-md-12 col-sm-12 col-xs-12 related-posts">';
							if($pad){echo '<div class="'.$pad.'">';}
							echo '<h3>' . get_the_title() . ' Articles</h3>';
							echo '<ul class="owl-carousel owl-theme postsslider">';
								global $post;
								$args = array( 'posts_per_page' => -1, 'category' => $posts_category, 'post_status' => 'publish', );
								$myposts = get_posts( $args );
								foreach ( $myposts as $post ) : 
									setup_postdata( $post );
									echo '<li class="item">';
										if(has_post_thumbnail()){ ?>
											<div class="col-lg-4 col-md-3 col-sm-3 col-xs-3 post-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('postslider_thumb'); ?></a></div>
											<div class="col-lg-8 col-md-9 col-sm-9 col-xs-9 post-excerpt">
										<?php }else{ ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 excerpt">
										<?php } ?>
												<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php 
												the_excerpt();
											echo '</div>';
									echo '</li>';
								endforeach;
								wp_reset_postdata();
							echo '</ul>';
							if($pad){echo '</div>';}
						echo '</div>';
					echo '</section>';
				}
				
			/* 1 COLUMN SECTION
			================================================*/
			}elseif( get_row_layout() == '1_column' ){
				$content = get_sub_field('column_1_content');
				$rc = get_sub_field('row_class');
				$c1c = get_sub_field('column_1_class');
				$bc = get_sub_field('background_color');
				$bi = get_sub_field('background_image');
				$cd = get_sub_field('column_design');
				$fc = get_sub_field('font_color');
				$fs = get_sub_field('font_size');
				$ta = get_sub_field('text_align');
				$pad = get_sub_field('padding');

				echo '<section class="row ' . $rc . ' " data-bg="'.$bi.'" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
					echo '<div class="' . $c1c . ' ' . $ta . '">';
						if($pad){echo '<div class="'.$pad.'">';}
							if($cd === 'card'){	echo '<div class="card-background"><div class="card-background-bottom">'; }
							elseif($cd === 'card2'){	echo '<div class="card-background secondary-corners"><div class="card-background-bottom secondary-corners">'; }
							elseif($cd === 'card3'){	echo '<div class="card-background tertiary-corner"><div class="card-background-bottom tertiary-corner">'; }
							elseif($cd === 'block'){ echo '<div class="inner-block">';}
							elseif($cd === 'quotes'){ echo '<div class="quotes">';}
				
							echo $content;
				
							if($cd !== 'default'){ echo '</div>';}
							if($cd === 'card' || $cd === 'card2' || $cd === 'card3'){ echo '</div>'; }
						if($pad){echo '</div>';}
					echo '</div>';
				echo '</section>';
				
			/* 2 COLUMN SECTION
			================================================*/
			}elseif( get_row_layout() == '2_column' ){
				
				/* Row*/
				$rc = get_sub_field('row_class');
				$rbc = get_sub_field('row_background_color');
				$rbi = get_sub_field('row_background_image');
				$svg = get_sub_field('svg_background');
				
				/*Col 1*/
				$content1 = get_sub_field('column_1_content');
				$c1c = get_sub_field('column_1_class');
				$c1a = get_sub_field('column_1_alignment');
				$c1bc = get_sub_field('col1_background_color');
				$c1bi = get_sub_field('col1_background_image');
				$c1fc = get_sub_field('col1_font_color');
				$c1fs = get_sub_field('col1_font_size');
				$c1ta = get_sub_field('col1_text_align');
				$c1pad = get_sub_field('col1_padding');
				$cd = get_sub_field('column_design');
				
				/*Col 2*/
				$content2 = get_sub_field('column_2_content');
				$c2c = get_sub_field('column_2_class');
				$c2a = get_sub_field('column_2_alignment');
				$c2bc = get_sub_field('col2_background_color');
				$c2bi = get_sub_field('col2_background_image');
				$c2fc = get_sub_field('col2_font_color');
				$c2fs = get_sub_field('col2_font_size');
				$c2ta = get_sub_field('col2_text_align');
				$c2pad = get_sub_field('col2_padding');
				$cd2 = get_sub_field('column_2_design');
				
				/* Row */
				echo '<section class="row sh-row no-overflow '.$rc.'" data-bg="'.$rbi.'" data-bgc="'.$rbc.'">';
					if($svg === 'slant-right'){
						echo '
							<div class="slant-right">
								<svg viewbox="0 0 160 160" preserveAspectRatio="xMinYMin meet">
									<polygon points="160,0 160,160 0,0"></polygon>
								</svg>
							</div>';
					}
					if($svg === 'slant-left'){
						echo '
							<div class="slant-left">
								<svg viewbox="0 0 160 160" preserveAspectRatio="xMinYMin meet">
									<polygon points="0,160 0,0 160,160"></polygon>
								</svg>
							</div>';
					}
						/* Col 1 */
						if( $c1a && in_array('Vertical Align', $c1a) ){
							echo '<div class="' . $c1c . ' ' . $c1ta . ' sh-col tbl" data-bg="'.$c1bi.'" data-color="'.$c1fc.'" data-size="'.$c1fs.'" data-bgc="'.$c1bc.'">';
								echo '<div class="inner ' . $c1ta . ' ' . $c1pad . ' ">';
									if($cd === 'card'){	echo '<div class="card-background"><div class="card-background-bottom">'; }
									elseif($cd === 'card2'){	echo '<div class="card-background secondary-corners"><div class="card-background-bottom secondary-corners">'; }
									elseif($cd === 'card3'){	echo '<div class="card-background tertiary-corner"><div class="card-background-bottom tertiary-corner">'; }
									elseif($cd === 'block'){ echo '<div class="inner-block">';}
									elseif($cd === 'quotes'){ echo '<div class="quotes">';}
										echo $content1;
									if($cd !== 'default'){ echo '</div>';}
									if($cd === 'card' || $cd === 'card2' || $cd === 'card3'){ echo '</div>'; }
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' .$c1c . ' ' . $c1ta . ' sh-col" data-bg="'.$c1bi.'" data-color="'.$c1fc.'" data-size="'.$c1fs.'" data-bgc="'.$c1bc.'">';
								if($c1pad){echo '<div class="'.$c1pad.'">';}
									if($cd === 'card'){	echo '<div class="card-background"><div class="card-background-bottom">'; }
									elseif($cd === 'card2'){	echo '<div class="card-background secondary-corners"><div class="card-background-bottom secondary-corners">'; }
									elseif($cd === 'card3'){	echo '<div class="card-background tertiary-corner"><div class="card-background-bottom tertiary-corner">'; }
									elseif($cd === 'block'){ echo '<div class="inner-block">';}
									elseif($cd === 'quotes'){ echo '<div class="quotes">';}
										echo $content1;
									if($cd !== 'default'){ echo '</div>';}
									if($cd === 'card' || $cd === 'card2' || $cd === 'card3'){ echo '</div>'; }
								if($c1pad){echo '</div>';}
							echo '</div>';
						}

						/* Col 2 */
						if( $c2a && in_array('Vertical Align', $c2a) ){
							echo '<div class="' . $c2c . ' ' . $c2ta . ' sh-col tbl" data-bg="'.$c2bi.'" data-color="'.$c2fc.'" data-size="'.$c2fs.'" data-bgc="'.$c2bc.'">';
								echo '<div class="inner ' . $c2ta . ' ' . $c2pad . ' ">';
									if($cd2 === 'card'){	echo '<div class="card-background"><div class="card-background-bottom">'; }
									elseif($cd2 === 'card2'){	echo '<div class="card-background secondary-corners"><div class="card-background-bottom secondary-corners">'; }
									elseif($cd2 === 'card3'){	echo '<div class="card-background tertiary-corner"><div class="card-background-bottom tertiary-corner">'; }
									elseif($cd2 === 'block'){ echo '<div class="inner-block">';}
									elseif($cd2 === 'quotes'){ echo '<div class="quotes">';}
										echo $content2;
									if($cd2 !== 'default'){ echo '</div>';}
									if($cd2 === 'card' || $cd2 === 'card2' || $cd2 === 'card3'){ echo '</div>'; }
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' . $c2c . ' ' . $c2ta . ' sh-col " data-bg="'.$c2bi.'" data-color="'.$c2fc.'" data-size="'.$c2fs.'" data-bgc="'.$c2bc.'">';
								if($c2pad){echo '<div class="'.$c2pad.'">';}
									if($cd2 === 'card'){	echo '<div class="card-background"><div class="card-background-bottom">'; }
									elseif($cd2 === 'card2'){	echo '<div class="card-background secondary-corners"><div class="card-background-bottom secondary-corners">'; }
									elseif($cd2 === 'card3'){	echo '<div class="card-background tertiary-corner"><div class="card-background-bottom tertiary-corner">'; }
									elseif($cd2 === 'block'){ echo '<div class="inner-block">';}
									elseif($cd2 === 'quotes'){ echo '<div class="quotes">';}
										echo $content2;
									if($cd2 !== 'default'){ echo '</div>';}
									if($cd2 === 'card' || $cd2 === 'card2' || $cd2 === 'card3'){ echo '</div>'; }
								if($c2pad){echo '</div>';}
							echo '</div>';
						}
				
				echo '</section>';
				
			/* 3 COLUMN SECTION
			================================================*/
			}elseif( get_row_layout() == '3_column' ){
				
				/* Row*/
				$rc = get_sub_field('row_class');
				$rbc = get_sub_field('row_background_color');
				$rbi = get_sub_field('row_background_image');
				
				/*Col 1*/
				$content1 = get_sub_field('column_1_content');
				$c1c = get_sub_field('column_1_class');
				$c1a = get_sub_field('column_1_alignment');
				$c1bc = get_sub_field('col1_background_color');
				$c1fc = get_sub_field('col1_font_color');
				$c1fs = get_sub_field('col1_font_size');
				$c1ta = get_sub_field('col1_text_align');
				$c1pad = get_sub_field('col1_padding');
				
				/*Col 2*/
				$content2 = get_sub_field('column_2_content');
				$c2c = get_sub_field('column_2_class');
				$c2a = get_sub_field('column_2_alignment');
				$c2bc = get_sub_field('col2_background_color');
				$c2fc = get_sub_field('col2_font_color');
				$c2fs = get_sub_field('col2_font_size');
				$c2ta = get_sub_field('col2_text_align');
				$c2pad = get_sub_field('col2_padding');
				
				/*Col 3*/
				$content3 = get_sub_field('column_3_content');
				$c3c = get_sub_field('column_3_class');
				$c3a = get_sub_field('column_3_alignment');
				$c3bc = get_sub_field('col3_background_color');
				$c3fc = get_sub_field('col3_font_color');
				$c3fs = get_sub_field('col3_font_size');
				$c3ta = get_sub_field('col3_text_align');
				$c3pad = get_sub_field('col3_padding');
				
				/* Row */
				echo '<section class="row sh-row '.$rc.'" data-bg="'.$rbi.'" data-bgc="'.$rbc.'">';
						/* Col 1 */
						if( $c1a && in_array('Vertical Align', $c1a) ){
							echo '<div class="' . $c1c . ' ' . $c1ta . ' sh-col tbl" data-color="'.$c1fc.'" data-size="'.$c1fs.'" data-bgc="'.$c1bc.'">';
								echo '<div class="inner ' . $c1ta . ' ' . $c1pad . ' ">';
										echo $content1;
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' .$c1c . ' ' . $c1ta . ' sh-col" data-color="'.$c1fc.'" data-size="'.$c1fs.'" data-bgc="'.$c1bc.'">';
								if($c1pad){echo '<div class="'.$c1pad.'">';}
									echo $content1;
								if($c1pad){echo '</div>';}
							echo '</div>';
						}

						/* Col 2 */
						if( $c2a && in_array('Vertical Align', $c2a) ){
							echo '<div class="' . $c2c . ' ' . $c2ta . ' sh-col tbl"  data-color="'.$c2fc.'" data-size="'.$c2fs.'" data-bgc="'.$c2bc.'">';
								echo '<div class="inner ' . $c2ta . ' ' . $c2pad . ' ">';
										echo $content2;
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' . $c2c . ' ' . $c2ta . ' sh-col "  data-color="'.$c2fc.'" data-size="'.$c2fs.'" data-bgc="'.$c2bc.'">';
								if($c2pad){echo '<div class="'.$c2pad.'">';}
									echo $content2;
								if($c2pad){echo '</div>';}
							echo '</div>';
						}
				
						/* Col 3 */
						if( $c3a && in_array('Vertical Align', $c3a) ){
							echo '<div class="' . $c3c . ' ' . $c3ta . ' sh-col tbl"  data-color="'.$c3fc.'" data-size="'.$c3fs.'" data-bgc="'.$c3bc.'">';
								echo '<div class="inner ' . $c3ta . ' ' . $c3pad . ' ">';
										echo $content3;
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' . $c3c . ' ' . $c3ta . ' sh-col " data-color="'.$c3fc.'" data-size="'.$c3fs.'" data-bgc="'.$c3bc.'">';
								if($c3pad){echo '<div class="'.$c3pad.'">';}
									echo $content3;
								if($c3pad){echo '</div>';}
							echo '</div>';
						}
				
				echo '</section>';

			/* 4 COLUMN SECTION
			================================================*/
			}elseif( get_row_layout() == '4_column' ){
				
				/* Row*/
				$rc = get_sub_field('row_class');
				$rbc = get_sub_field('row_background_color');
				$rbi = get_sub_field('row_background_image');
				
				/*Col 1*/
				$content1 = get_sub_field('column_1_content');
				$c1c = get_sub_field('column_1_class');
				$c1a = get_sub_field('column_1_alignment');
				$c1bc = get_sub_field('col1_background_color');
				$c1fc = get_sub_field('col1_font_color');
				$c1fs = get_sub_field('col1_font_size');
				$c1ta = get_sub_field('col1_text_align');
				$c1pad = get_sub_field('col1_padding');
				
				/*Col 2*/
				$content2 = get_sub_field('column_2_content');
				$c2c = get_sub_field('column_2_class');
				$c2a = get_sub_field('column_2_alignment');
				$c2bc = get_sub_field('col2_background_color');
				$c2fc = get_sub_field('col2_font_color');
				$c2fs = get_sub_field('col2_font_size');
				$c2ta = get_sub_field('col2_text_align');
				$c2pad = get_sub_field('col2_padding');
				
				/*Col 3*/
				$content3 = get_sub_field('column_3_content');
				$c3c = get_sub_field('column_3_class');
				$c3a = get_sub_field('column_3_alignment');
				$c3bc = get_sub_field('col3_background_color');
				$c3fc = get_sub_field('col3_font_color');
				$c3fs = get_sub_field('col3_font_size');
				$c3ta = get_sub_field('col3_text_align');
				$c3pad = get_sub_field('col3_padding');
				
				/*Col 4*/
				$content4 = get_sub_field('column_4_content');
				$c4c = get_sub_field('column_4_class');
				$c4a = get_sub_field('column_4_alignment');
				$c4bc = get_sub_field('col4_background_color');
				$c4fc = get_sub_field('col4_font_color');
				$c4fs = get_sub_field('col4_font_size');
				$c4ta = get_sub_field('col4_text_align');
				$c4pad = get_sub_field('col4_padding');
				
				/* Row */
				echo '<section class="row sh-row '.$rc.'" data-bg="'.$rbi.'" data-bgc="'.$rbc.'">';
						/* Col 1 */
						if( $c1a && in_array('Vertical Align', $c1a) ){
							echo '<div class="' . $c1c . ' ' . $c1ta . ' sh-col tbl" data-color="'.$c1fc.'" data-size="'.$c1fs.'" data-bgc="'.$c1bc.'">';
								echo '<div class="inner ' . $c1ta . ' ' . $c1pad . ' ">';
										echo $content1;
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' .$c1c . ' ' . $c1ta . ' sh-col" data-color="'.$c1fc.'" data-size="'.$c1fs.'" data-bgc="'.$c1bc.'">';
								if($c1pad){echo '<div class="'.$c1pad.'">';}
									echo $content1;
								if($c1pad){echo '</div>';}
							echo '</div>';
						}

						/* Col 2 */
						if( $c2a && in_array('Vertical Align', $c2a) ){
							echo '<div class="' . $c2c . ' ' . $c2ta . ' sh-col tbl"  data-color="'.$c2fc.'" data-size="'.$c2fs.'" data-bgc="'.$c2bc.'">';
								echo '<div class="inner ' . $c2ta . ' ' . $c2pad . ' ">';
										echo $content2;
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' . $c2c . ' ' . $c2ta . ' sh-col "  data-color="'.$c2fc.'" data-size="'.$c2fs.'" data-bgc="'.$c2bc.'">';
								if($c2pad){echo '<div class="'.$c2pad.'">';}
									echo $content2;
								if($c2pad){echo '</div>';}
							echo '</div>';
						}
				
						/* Col 3 */
						if( $c3a && in_array('Vertical Align', $c3a) ){
							echo '<div class="' . $c3c . ' ' . $c3ta . ' sh-col tbl"  data-color="'.$c3fc.'" data-size="'.$c3fs.'" data-bgc="'.$c3bc.'">';
								echo '<div class="inner ' . $c3ta . ' ' . $c3pad . ' ">';
										echo $content3;
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' . $c3c . ' ' . $c3ta . ' sh-col " data-color="'.$c3fc.'" data-size="'.$c3fs.'" data-bgc="'.$c3bc.'">';
								if($c3pad){echo '<div class="'.$c3pad.'">';}
									echo $content3;
								if($c3pad){echo '</div>';}
							echo '</div>';
						}
				
						/* Col 4 */
						if( $c4a && in_array('Vertical Align', $c4a) ){
							echo '<div class="' . $c4c . ' ' . $c4ta . ' sh-col tbl"  data-color="'.$c4fc.'" data-size="'.$c4fs.'" data-bgc="'.$c4bc.'">';
								echo '<div class="inner ' . $c4ta . ' ' . $c4pad . ' ">';
										echo $content4;
								echo '</div>';
							echo '</div>';
						}else{
							echo '<div class="' . $c4c . ' ' . $c4ta . ' sh-col " data-color="'.$c4fc.'" data-size="'.$c4fs.'" data-bgc="'.$c3bc.'">';
								if($c4pad){echo '<div class="'.$c4pad.'">';}
									echo $content4;
								if($c4pad){echo '</div>';}
							echo '</div>';
						}
				echo '</section>';

				
			/* CALL TO ACTION
			================================================*/
			}elseif( get_row_layout() == 'call_to_action' ){
				$content = get_sub_field('column_1_content');
				$rc = get_sub_field('row_class');
				$c1c = get_sub_field('column_1_class');
				$bc = get_sub_field('background_color');
				$fc = get_sub_field('font_color');
				$fs = get_sub_field('font_size');
				$ta = get_sub_field('text_align');
				$pad = get_sub_field('padding');
				$bt = get_sub_field('button_text');
				$bu = get_sub_field('button_url');
				echo '<div class="row cta justify-content-center' . $rc . '" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
					echo '<div class="col-md-10 col-12' . $c1c .' ' .$ta  . '">';
						echo '<div class="pad-sm">';
							echo $content;
							if($bt && $bu){
								echo '<a href="'.$bu.'" class="btn btn-primary" data-color="'.$fc.'">'.$bt.'</a>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				
			/* PROCEDURES ROTATOR
			================================================*/
			}elseif( get_row_layout() == 'procedures_rotator' ){
				$procedures = get_sub_field('procedures');
				$title = get_sub_field('title');
				$content = get_sub_field('content');
				
				$style = get_sub_field('procedure_style');
				$rc = get_sub_field('row_class');
				$c1c = get_sub_field('column_1_class');
				$bc = get_sub_field('background_color');
				$fc = get_sub_field('font_color');
				$fs = get_sub_field('font_size');
				$ta = get_sub_field('text_align');
				$pad = get_sub_field('padding');
				$bt = get_sub_field('button_text');
				$bu = get_sub_field('button_url');
				
				/* Grid with Text Hover Up */
				if($style === 'grid') :
					echo '<section class="row procedures ' . $rc . '" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
						echo '<div class="' . $c1c .' ' .$ta  . ' sh-col">';
							if($pad){echo '<div class="'.$pad.'">';}

								if($title || $content){
									echo '<div class="info"><div class="inner">';
										if($title){
											echo '<h3>'.$title.'</h3>';
										}	

										if($content){
											echo $content;
										}	
									echo '</div></div>';
								}

								if( $posts ): ?>
									<div class="procedure-layout row">
										<?php foreach( $procedures as $post):
											setup_postdata($post); 
											$thumb_id = get_post_thumbnail_id();
											$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'procedure_sm_thumb', true);
											$thumb_url = $thumb_url_array[0]; ?>
											<div class=" procedure-card col-md-4 col-sm-6 col-xs-12">
												<a href="<?php the_permalink(); ?>">
													<div class="card-bottom" data-bg="<?php echo $thumb_url; ?>">
														<div class="primary-hover"></div>
														<h3><?php echo get_the_title(); ?></h3>
													</div>
												</a>
											</div>
										<?php endforeach; ?>
									</div><?php 
									wp_reset_postdata();
								endif;
							if($pad){echo '</div>';}
						echo '</div>';
					echo '</section>';
				
				/* Full Width Slider with Hover */
				elseif($style === 'hover') :
					echo '<section class="row procedures-hover ' . $rc . '" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
						echo '<div class="' . $c1c .' ' .$ta  . ' sh-col">';
							if($pad){echo '<div class="'.$pad.'">';}

								if($title || $content){
									echo '<div class="cover"></div>';
									echo '<div class="info">';
										if($title){
											echo '<h3>'.$title.'</h3>';
										}	

										if($content){
											echo $content;
										}	
									echo '</div>';
								}

								if( $posts ): ?>
									<div class="owl-carousel owl-theme procedures-rotator">
										<?php foreach( $procedures as $post):
											setup_postdata($post); 
											$thumb_id = get_post_thumbnail_id();
											$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'postslider_thumb', true);
											$thumb_url = $thumb_url_array[0]; ?>
											<div class="item" data-bg="<?php echo $thumb_url; ?>">
												<h3><?php the_title(); ?></h3>
												<div class="excerpt">
													<?php echo get_field('excerpt'); ?>
												</div>
												<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
											</div>
										<?php endforeach; ?>
									</div><?php 
									wp_reset_postdata();
								endif;
							if($pad){echo '</div>';}
						echo '</div>';
					echo '</section>';
				
				/* Half Slider with Hover */
				elseif($style === 'half') :
					echo '<section class="row procedures-half ' . $rc . '" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
						echo '<div class="col-12 nopad' . $c1c .' ' .$ta  . ' d-flex align-items-center">';
							if($pad){echo '<div class="'.$pad.'">';}
								if($title || $content){
									echo '<div class="info"><div class="inner">';
										if($title){
											echo '<h3>'.$title.'</h3>';
										}	

										if($content){
											echo $content;
										}	
									echo '</div></div>';
								}

								if( $posts ): ?>
                                    <div class="swiper-container procedures-half-rotator">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <?php foreach( $procedures as $post):
                                                setup_postdata($post); 
                                                $thumb_id = get_post_thumbnail_id();
                                                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'postslider_thumb', true);
                                                $thumb_url = $thumb_url_array[0]; ?>
                                                <div class="swiper-slide" data-bg="<?php echo $thumb_url; ?>">
                                                    <h3><?php the_title(); ?></h3>
                                                    <div class="small-desc"><?php echo get_field('excerpt'); ?></div>
                                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div>
                                    <?php /*
                                        <div class="owl-carousel owl-theme procedures-half-rotator">
                                            <?php foreach( $procedures as $post):
                                                setup_postdata($post); 
                                                $thumb_id = get_post_thumbnail_id();
                                                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'postslider_thumb', true);
                                                $thumb_url = $thumb_url_array[0]; ?>
                                                <div class="item" data-bg="<?php echo $thumb_url; ?>">
                                                    <h3><?php the_title(); ?></h3>
                                                    <div class="small-desc"><?php echo get_field('excerpt'); ?></div>
                                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div><?php 
                                    */
									wp_reset_postdata();
								endif;
							if($pad){echo '</div>';}
						echo '</div>';
					echo '</section>';
				
				/* Accordians */
				elseif($style === 'accordian') :
					echo '<section class="row procedures-accordian ' . $rc . '" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
						echo '<div class="col-12 nopad' . $c1c .' ' .$ta  . ' sh-col">';
							echo '<div class="procedures-title"><h3>'.$title.'</h3></div>';
								echo '<ul class="procedures">';
									$mypages = get_pages( array( 'post_type' => 'procedure', 'parent' => 0) );
									$i=0;
									foreach( $mypages as $page ) { $id = $page->ID; 
										$img = get_the_post_thumbnail_url($id, 'full-size'); ?>
										<li data-bg="<?php echo $img; ?>">
											<h3><?php echo $page->post_title; ?></h3>

											<ul class="sub-pages">
												<?php
												wp_list_pages( array(
													'title_li'    => '',
													'post_type'   => 'procedure',
													'child_of'    => $id
												) );	
												?>		
											</ul>
										</li><?php
										$i++;
									}	
								echo '</ul>';
							echo '</div>';
						echo '</section>';
				
				/* Card Display */
				elseif($style === 'card') :
					echo '<section class="row card-procedures ' . $rc . ' " data-bg="'.$bi.'" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'" data-bg="'.$bi.'">';
						echo '<div class="col-xl-10 col-12' . $c1c . ' ' . $ta . '">';
							if($pad){echo '<div class="'.$pad.'">';}
								if($title){
									echo '<h3>'.$title.'</h3>';
								}	

								if($content){
									echo $content;
								}		
								foreach( $procedures as $post):
									setup_postdata($post); 
									$thumb_id = get_post_thumbnail_id();
									$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'postslider_thumb', true);
									$thumb_url = $thumb_url_array[0];
									echo '<div class="card-holder">';
										echo '<div class="card-flipper">';
											echo '<div class="card-top" data-bg="'.$thumb_url.'">'; 
												echo '<h3>'.get_the_title().'</h3>';
											echo '</div>';
											echo '<div class="card-back primary-bg">';
												echo '<h4>'.get_the_title().'</h4>';
												echo get_field('excerpt');
												echo '<a href="'.get_the_permalink().'" class="btn btn-secondary">Read More</a>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								endforeach;
								wp_reset_postdata();
							if($pad){echo '</div>';}
						echo '</div>';
					echo '</section>';	
				endif;
				
			/* TESTIMONIALS ROTATOR
			================================================*/
			}elseif( get_row_layout() == 'testimonials_rotator' ){
				$testimonials = get_sub_field('testimonials');
				$title = get_sub_field('title');
				$rc = get_sub_field('row_class');
				$c1c = get_sub_field('column_1_class');
				$bc = get_sub_field('background_color');
				$bi = get_sub_field('background_image');
				$bd = get_sub_field('background_design');
				$fc = get_sub_field('font_color');
				$fs = get_sub_field('font_size');
				$ta = get_sub_field('text_align');
				$pad = get_sub_field('padding');
				$bt = get_sub_field('button_text');
				$bu = get_sub_field('button_url');
                
				echo '<section class="row sh-row testimonials no-overflow ' . $rc . '" data-bg="'.$bi.'" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
					echo '<div class="col-12 ' . $c1c .' ' .$ta  . ' sh-col">';
						if($pad){echo '<div class="'.$pad.' '.$bd.'">';}
								if($title){echo '<h3><span>'.$title.'</span></h3>';}	
								if( $posts ): ?>
                                    <div class="swiper-container testimonials-rotator">
                                        <div class="swiper-wrapper">
										<?php foreach( $testimonials as $post): ?>
											<?php setup_postdata($post); ?>
											<div class="swiper-slide">
												<?php if($bd === 'simple'){ the_post_thumbnail('thumbnail'); } ?>
												<?php the_content(); ?>
												<strong><?php the_title(); ?></strong>
											</div>
										    <?php endforeach; ?>
                                        </div>
                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>
                                    </div><?php 
									wp_reset_postdata();
								endif;
						if($pad){echo '</div>';}
					echo '</div>';
				echo '</section>';	
				
			/* FAQS
			================================================*/
			}elseif( get_row_layout() == 'faqs' ){
				$title = get_sub_field('title');
				$rc = get_sub_field('row_class');
				$c1c = get_sub_field('column_1_class');
				$bc = get_sub_field('background_color');
				$fc = get_sub_field('font_color');
				$fs = get_sub_field('font_size');
				$ta = get_sub_field('text_align');
				$pad = get_sub_field('padding');
				$bt = get_sub_field('button_text');
				$bu = get_sub_field('button_url');
				echo '<section class="row sh-row faqs ' . $rc . '" data-color="'.$fc.'" data-size="'.$fs.'" data-bgc="'.$bc.'">';
					echo '<div class="' . $c1c .' ' .$ta  . ' sh-col">';
						if($pad){echo '<div class="'.$pad.'">';}
							echo '<h3>'.$title.'</h3>';
							if( have_rows('q_a') ):
								echo '<div id="accordion" class="panel-group">';
									$f = 0;
									while ( have_rows('q_a') ) : the_row();
										$q = get_sub_field('question');
										$a = get_sub_field('answer');
										echo '<div class="panel panel-default">';
											echo '<div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$f.'">'.$q.'</a></h4></div>';
											echo '<div id="collapse'.$f.'" class="panel-collapse collapse"><div class="panel-body"><p>'.$a.'</p></div></div>';
										echo '</div>';
									$f++;
									endwhile;
								echo '</div>';
							endif;
						if($pad){echo '</div>';}
					echo '</div>';
				echo '</section>';
			}
		endwhile;
	endif; ?>