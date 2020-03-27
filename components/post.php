<?php
/**
 * Display Blog Post
 *
 * @category   Components
 * @package    WordPress
 * @subpackage Incredible Theme
 * @author     Nick Gonzales
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://www.incrediblemarketing.com/
 * @since      1.0.0
 */

?>
<article class="post" id="post-<?php the_ID(); ?>">
	<div class="container">
		<div class="row ">
			<div class="col-12">
				<div class="image--holder">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'hero_thumb', array( 'class' => 'img-fluid' ) ); ?>
					<?php else : ?>
						<?php im_the_placeholder_image( 'hero_thumb', '' ); ?>
					<?php endif; ?>
				</div>
				<div class="padding--inner">
					<h1><?php the_title(); ?></h1>
					<h6>Published on <?php echo get_the_date( 'F j, Y' ); ?> by <?php echo get_the_author_meta( 'nickname' ); ?></h6>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</article>

