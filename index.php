<?php
/**
 * Index.php
 *
 * @category   Components
 * @package    WordPress
 * @subpackage Incredible Theme
 * @author     Nick Gonzales
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://www.incrediblemarketing.com/
 * @since      1.0.0
 */

get_header(); ?>

<section class="block block--blog content">
	<div class="container-fluid section__padding">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<h1>Blog</h1>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php get_template_part( 'components/post-preview' ); ?>
					<?php endwhile; ?> 
					<?php get_template_part( 'components/navigation-loop' ); ?>
				<?php else : ?>
					<?php get_template_part( 'components/post-not-found' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
