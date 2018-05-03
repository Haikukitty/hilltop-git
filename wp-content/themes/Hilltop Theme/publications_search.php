<?php
/*
Template Name: Publications Search Page
*/



	
	
get_header();
global $wp_query;


$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>
	<?php $pubheader = get_field('pubs_header_image','cpt_publication'); ?>
	
	<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($pubheader) ): ?><?php echo $pubheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header">Publications</h1>
						
						<div class="et_pb_header_content_wrapper"></div>
						
					</div>
				</div>
					
				</div>
				<div class="et_pb_fullwidth_header_overlay" style="background-color: rgba(40,40,40,0.45);"></div>
				<div class="et_pb_fullwidth_header_scroll"></div>
			</section>
				
				
			</div>
<?php endif; ?>
	<div class="container">
		<div id="content-area" class="clearfix">
			
			<?php echo do_shortcode( '[searchandfilter slug="publications"]' ); ?>
			
	<div id="results">
		
		 <h4 class="search-title"> <?php echo $wp_query->found_posts; ?>
        <?php _e( 'Search Results Found', 'locale' ); ?></h4>

        <?php if ( have_posts() ) { ?>


            <?php while ( have_posts() ) { the_post(); ?>

              <article id="post-<?php the_ID(); ?> publist-<?php echo $i; ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h2 class="main_title feeds"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
				
				<?php endif; ?>

						
						

						


           <?php echo paginate_links(); ?>

        <?php }  } ?>


			
					

			

				</article> <!-- .et_pb_post -->
			
			

				

			
<?php wp_reset_postdata(); 
			
			the_posts_pagination( array(
	'mid_size'  => 2,
	'prev_text' => __( '< Back', 'textdomain' ),
	'next_text' => __( 'Next >', 'textdomain' ),
) );
								   
								  

?>
			

			</div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->


</div> <!-- #main-content -->

<?php

get_footer(); 