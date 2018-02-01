<?php get_header(); ?>

<div class="row justify-content-center">
  <div class="col-lg-8 col-12">
    <div id="content-full" class="pad-v-md">
      <article id="post-0" class="error404">
        <section class="post-entry">
          <header>
          <h1 class="title-404"><?php _e('404 &#8212; Whoopsie!', 'responsive'); ?></h1>
          </header>
          <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'responsive'); ?></p>
          <h6><?php _e( 'You can return', 'responsive' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'responsive' ); ?>"><?php _e( '&larr; Home', 'responsive' ); ?></a> <?php _e( 'or search for the page you were looking for', 'responsive' ); ?></h6>
          <?php get_search_form(); ?>
        </section><!-- end of .post-entry -->
      </article><!-- end of #post-0 -->
    </div><!-- end of #content-full -->
  </div>
</div>

<?php get_footer(); ?>
