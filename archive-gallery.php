<?php get_header();

	$gallery = get_field('gallery_archive_layout', 'options');

	if($gallery == 'g1'):
		get_template_part( 'gallery-templates/archive', 'template1' );
	elseif($gallery == 'g2'):
		get_template_part( 'gallery-templates/archive', 'template2' );
	endif;

get_footer();
