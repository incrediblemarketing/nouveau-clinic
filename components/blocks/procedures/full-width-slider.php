<?php
$procedures = get_sub_field('procedures');
$title = get_sub_field('title');
$content = get_sub_field('content');

$rc = get_sub_field('row_class');
$c1c = get_sub_field('column_1_class');
$bc = get_sub_field('background_color');
$fc = get_sub_field('font_color');
$fs = get_sub_field('font_size');
$ta = get_sub_field('text_align');
$pad = get_sub_field('padding');
$bt = get_sub_field('button_text');
$bu = get_sub_field('button_url');

echo '<section class="row procedures-hover ' . $rc . '" data-color="' . $fc . '" data-size="' . $fs . '" data-bgc="' . $bc . '">';
echo '<div class="' . $c1c . ' ' . $ta  . ' sh-col">';
if ($pad) {
    echo '<div class="' . $pad . '">';
}

if ($title || $content) {
    echo '<div class="cover"></div>';
    echo '<div class="info">';
    if ($title) {
        echo '<h3>' . $title . '</h3>';
    }

    if ($content) {
        echo $content;
    }
    echo '</div>';
}

if ($posts) : ?>
    <div class="owl-carousel owl-theme procedures-rotator">
        <?php foreach ($procedures as $post) :
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
    </div>
    <?php
    wp_reset_postdata();
endif;
if ($pad) {
    echo '</div>';
}
echo '</div>';
echo '</section>';
