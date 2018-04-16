<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">
	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
add_filter("gform_field_value_staffname", "populate_staffname");
function populate_staffname($value){
return get_post_meta($post->ID, 'staff-name', true);
}

add_filter("gform_field_value_staffemail", "populate_staffemail");
function populate_staffemail($value){
return get_post_meta($post->ID, 'staff-email', true);

}

?>

					<div class="entry-content">
					<?php
						the_content();
					?>
					</div> <!-- .entry-content -->

				</article> <!-- .et_pb_post -->

		<?php endwhile;
		else:
	?>
	
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<?php if ( ( 'off' !== $show_default_title && $is_page_builder_used ) || ! $is_page_builder_used ) { ?>

					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
} ?>
					
				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

	<?php endif; ?>
</div> <!-- #main-content -->

<?php

get_footer();
