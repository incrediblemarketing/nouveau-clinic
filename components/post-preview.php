<?php
/**
 * Display Blog Post Preview
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
<article class="post-preview" id="post-<?php the_ID(); ?>">
	<div class="item post-preview-thumbnail">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			<?php the_post_thumbnail( 'blog_row_thumb' ); ?>
		</a>
		<?php else : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			<?php im_the_placeholder_image( 'blog_row_thumb' ); ?>
		</a>
		<?php endif; ?>
	</div>
	<div class="item">
		<div class="box__date">
			<span class="month"><?php echo get_the_date( 'M' ); ?></span>
			<span class="number"><?php echo get_the_date( 'd' ); ?></span>
			<span class="year"><?php echo get_the_date( 'Y' ); ?></span>
		</div>
		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( 'Permanent Link to %s', the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
		<?php echo the_excerpt(); ?>
		<a class="btn btn-secondary" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( 'Permanent Link to %s', the_title_attribute( 'echo=0' ) ); ?>">Read More <i class="fal fa-long-arrow-right"></i></a>
	</div>
</article>

