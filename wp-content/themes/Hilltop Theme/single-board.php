<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>




<div id="main-content">
	
	<?php if ( ! $is_page_builder_used ) : ?>

	<?php $boardheader = get_field('board_header_image','cpt_board');
	$boardlink = get_field(' board_link','cpt_board'); ?>
	
	<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first feedpages">
			
				
			<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($boardheader) ): ?><?php echo $boardheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
					
						<h1 class="et_pb_module_header">
							<a href="/advisory-board/"><?php echo the_field('advisory_board_title','cpt_board'); ?></a>
						</h1>
						
						<div class="et_pb_header_content_wrapper"></div>
						
					</div>
				</div>
					
				</div>
				<div class="et_pb_fullwidth_header_overlay" style="background-color: rgba(40,40,40,0.45);"></div>
				<div class="et_pb_fullwidth_header_scroll"></div>
			</section>
				
				
			</div>

<?php endif; ?>
	

	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post(); 
	
	
	?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					


				</article> <!-- .et_pb_post -->

		<?php endwhile;
		else:
	?>
	
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>
	

	
		
	<div class="container">
		<div id="content-area" class="clearfix">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<?php if ( ( 'off' !== $show_default_title && $is_page_builder_used ) || ! $is_page_builder_used ) { ?>

					<?php
						do_action( 'et_before_content' );

					

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
} ?>
					
					<div class="row">
						<div class="col-md-4 col-sm-4 staff-pic">
						<?php	if ( has_post_thumbnail() ) { 
    the_post_thumbnail( 'size-full' ); 
	
} ?>
						</div>
						
						<div class="col-md-8 col-sm-8 staff-info">
					
							<h2 class="staffname"><?php the_title(); ?></h2>
							
							<h5 class="stafftitle"><?php the_field('board_title'); ?></h5>
							<h5 class="stafftitle"><?php the_field('board_company'); ?></h5>

							
							
							
													
							
							<div class="staffbio" style="clear:both;padding-top:25px;padding-bottom:25px;">
											  <?php the_content(); ?>

								
							</div>
							
						</div>
						
					</div>
					
				</article> <!-- .et_pb_post -->
					
			<?php endwhile; ?>

	<?php endif; ?>
		</div>
			</div>
</div> <!-- #main-content -->





<?php

get_footer();
