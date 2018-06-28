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
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto headerphotoshort et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($pubheader) ): ?><?php echo $pubheader['url']; ?><?php endif; ?>);">			
				
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
<?php endif; ?>
	<div class="container firstpara">
		<div id="content-area" class="clearfix">
			
				<?php if( have_rows('focus_areas','cpt_publication') ): ?>
				<div class="row">
					<?php  while ( have_rows('focus_areas','cpt_publication') ) : the_row(); 
					
							$iconimage = get_sub_field('icon_image','cpt_publication');
							$icontitle = get_sub_field('icon_title','cpt_publication');
							$iconlink = get_sub_field('icon_link','cpt_publication');

					
					?>
					<div class="col-md-2 col-sm-2 col-xs-4 focus">
						<p style="text-align:center;"><a href="<?php echo $iconlink; ?>"><img src="<?php echo $iconimage['url']; ?>" alt="<?php echo $iconimage['alt'] ?>" /></a><br>
							<a href="<?php echo $iconlink; ?>" class="focuslink"><?php echo $icontitle; ?></a>
						</p>
						
					</div>
							<?php endwhile; ?>
				</div>
				
				<?php endif; ?>
			
			<?php echo do_shortcode( '[searchandfilter slug="publications"]' ); ?>
			
	<div id="results">
		<div class="pubsarchive">
		
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
	
			 <?php the_field('publication_abstract'); ?> 
						
					
						
						<?php

						if(get_field('upload_pdf')) { ?>
						
						<p style="text-align:center;margin:33px;"><a href="<?php the_field('upload_pdf'); ?>" class="et_pb_button_0 et_pb_button button pdfbutton" target="_blank">View PDF </a></p>
						

						
						<?php } else { ?>
						
						<p style="text-align:center;margin:33px;"><a href="<?php the_field("external_pdf_link"); ?>" class="et_pb_button_0 et_pb_button button pdfbutton" target="_blank">View PDF </a></p>
						
						<?php } ?>
						
						<?php echo do_shortcode('[addtoany buttons="facebook,twitter,email"]'); ?> 

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
		</Div>
				</div>
			</div>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>



<script>
	 
jQuery( document ).ready(function( $ ) {
	
	


jQuery.noConflict();
jQuery(document).ready(function(){
jQuery('.focus').matchHeight();
                    });
	

	    jQuery('.pubsarchive').liloAccordion({
  onlyOneActive: false,
  initFirstActive: false,
  hideControl: false,
  openNextOnClose: false

});

	 
 });	

	  
  </script>
 <script>

  </script>

</div> <!-- #main-content -->

<?php

get_footer(); 
