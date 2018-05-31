<?php
/*
Template Name: News & Bulletins Archive Page
*/



	
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>
	<?php $newsheader = get_field('news_section_header_photo','cpt_news-bulletins'); ?>
	
	<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($newsheader) ): ?><?php echo $newsheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header">News &amp; Bulletins Archive</h1>
						
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
			
			
			<div id="results">
				
				 <div class="the-news">


			<?php $i = 0; ?>

						<?php 
			
			
			
			
			if (have_posts()) : while ( have_posts() ) : the_post(); ?>
 


				<?php if ( ! $is_page_builder_used ) : ?>
				
					<div class="lilo-accordion-control">


					<div class="pubsholder">
					  <div class="pubsdate">
						  <?php the_time('m/d/Y', '<h4 class="pubdate">', '</h4>'); ?>

					  </div>
								  <div class="pubslist">

					<h2 class="main_title feeds"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
									  
					  </div>
				  </div>
		
				</div>
				
				

						  <div class="lilo-accordion-content">
	
			<?php the_content(); ?>
							  <!--	<p class="published-dates" style="text-align:right;"><em><?php
						the_time('m/d/Y');
								?></em></p> -->

				</div> 
			<?php endif; ?>
			
			<?php 

			$i++;
endwhile;
					
?>
				
	<?php endif; ?>

			
<?php wp_reset_postdata(); 
			
			the_posts_pagination( array(
	'mid_size'  => 2,
	'prev_text' => __( '< Back', 'textdomain' ),
	'next_text' => __( 'Next >', 'textdomain' ),
) );

?>
			
<?php if ( ! $is_page_builder_used ) :
	
							
					?>
					 
				</div>
			</div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->
 <script>
jQuery( document ).ready(function( $ ) {
    jQuery('.the-news').liloAccordion({
  onlyOneActive: false,
  initFirstActive: false,
  hideControl: false,
  openNextOnClose: false

})
});
  </script>
<?php

get_footer();
