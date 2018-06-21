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

					<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($pubheader) ): ?><?php echo $pubheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header"><a href="<?php echo site_url(); ?>/hilltop-publications/" class="headerpiclink">Publications</a></h1>
						
						<div class="et_pb_header_content_wrapper"></div>
						
					</div>
				</div>
					
				</div>
				<div class="et_pb_fullwidth_header_overlay" style="background-color: rgba(40,40,40,0.45);"></div>
				<div class="et_pb_fullwidth_header_scroll"></div>
			</section>
				
				
			</div>
					<?php if ( ( 'off' !== $show_default_title && $is_page_builder_used ) || ! $is_page_builder_used ) { ?>

					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
} ?>

					<div class="et_pb_row et_pb_row_0">
					<div class="entry-content">
						
						
						
						<h1 class="entry-title" style="font-size: 26px;"><?php the_title(); ?></h1>
						
						  <h4 class="pubdate"><?php the_date('m/d/Y'); ?></h4>

						
						 <?php the_field('publication_abstract'); ?> 
						
					
						
						<?php

						if(get_field('upload_pdf')) { ?>
						
						<p style="text-align:center;margin:33px;"><a href="<?php the_field('upload_pdf'); ?>" class="et_pb_button_0 et_pb_button button pdfbutton" target="_blank">View PDF </a></p>
						

						
						<?php } else { ?>
						
						<p style="text-align:center;margin:33px;"><a href="<?php the_field("external_pdf_link"); ?>" class="et_pb_button_0 et_pb_button button pdfbutton" target="_blank">View PDF </a></p>
						
						<?php } ?>
						
						</div>
						
					</div>
					
				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

	<?php endif; ?>
</div> <!-- #main-content -->

<?php

get_footer();
