<?php

	$olderLink = get_next_post_link('%link', '<i class="fas fa-angle-left"></i> %title');
	$newerLink = get_previous_post_link('%link', '%title <i class="fas fa-angle-right"></i>');

?>

<?php if ( $olderLink || $newerLink ) : ?>

	<nav class="d-flex align-items-center navigation navigation-single">

		<?php echo $olderLink; ?>
		<?php echo $newerLink; ?>

	</nav>

<?php endif; ?>
