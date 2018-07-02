<?php
/*
Template Name: Publications Main Page Template
*/



	
get_header();
 ?>

<style>
		#wp-admin-bar-et-use-visual-builder {
		display:none;
	}
</style>

<div id="main-content">
	
	<?php while( have_posts() ): the_post(); /* start main loop */ ?>


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

	<div class="container firstpara">
		<div id="content-area" class="clearfix">
			<div class="pubs-intro">
			<?php the_field('publications_archive_intro_text','cpt_publication'); ?>
			</div>
			
			<div class="pubsearchfilter">
				<h4 style="color:#333333;">
					Search all publications:</h4>
				<?php if( have_rows('focus_areas','cpt_publication') ): ?>
				<div class="row">
					<?php  while ( have_rows('focus_areas','cpt_publication') ) : the_row(); 
					
								$iconimage = get_sub_field('icon_image','cpt_publication');
							$icontitle = get_sub_field('icon_title','cpt_publication');
							$iconlink = get_sub_field('icon_link','cpt_publication');

					
					?>
					<div class="col-md-2 col-sm-2 col-xs-4 focus">
						<p style="text-align:center;"><a href="<?php echo $iconlink; ?>"><img src="<?php echo $iconimage['url']; ?>" alt="" /><br>
							<a href="<?php echo $iconlink; ?>" class="focuslink"><?php echo $icontitle; ?></a>
						</p>
						
					</div>
							<?php endwhile; ?>
				</div>
				
				<?php endif; ?>
			
						<?php echo do_shortcode( '[searchandfilter slug="publications"]' ); ?>
				
			</div>

			<div id="results" class="featuredpubs">
				

					 
					   <?php
					 
					 	$numberpubsposts = get_field('number_of_featured_publications', 'cpt_publication');



  $my_loop = new WP_Query(array(
        'post_type' => 'publication',
        'showposts' => $numberpubsposts,
		
   )  );  

if( $my_loop->have_posts() ):
    while( $my_loop->have_posts() ): $my_loop->the_post();		?>		
 <div class="pubsholder" style="overflow:hidden">
					  <div class="pubsdate">
						  <?php the_time('m/d/Y', '<h4 class="pubdate">', '</h4>'); ?>

					  </div>
								  <div class="pubslist">

					<h2 class="main_title feeds"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
									  
					 
									  
					<?php
						the_field('publication_abstract'); ?>
									  
									  						<?php echo do_shortcode('[addtoany buttons="facebook,twitter,email"]'); ?> 

									  
									  <?php

						if(get_field('upload_pdf')) { ?>
						
						<p style="text-align:center;margin:33px 33px 33px 33px;"><a href="<?php the_field('upload_pdf'); ?>" class="et_pb_button_0 et_pb_button button pdfbutton" target="_blank">View PDF </a></p>
						

						
						<?php } else { ?>
						
						<p style="text-align:center;margin:33px 33px 33px 33px;"><a href="<?php the_field("external_pdf_link"); ?>" class="et_pb_button_0 et_pb_button button pdfbutton" target="_blank">View PDF </a></p>
						
						<?php } ?>
						
						  
										  </div>
					
					 
				</div>
					 
	<?php	 endwhile;
endif;
wp_reset_postdata(); ?>
			
			
				
				<p class="clear:both;">&nbsp;</p>
			
			</div>
			<div class="pubsholder">
			 <div class="pubsdate">&nbsp; </div>		 			
<div class="pubs-archive-link pubslist" style="min-height:100px;margin-top:40px;">
	<p><a href="<?php echo site_url(); ?>/publication/" class="et_pb_button button pdfbutton">Publications Archive</a></p>
				</div>	
			</div>
					
					 
			
		</div> <!-- #content-area -->
	</div> <!-- .container -->


<?php	 endwhile; ?>

<script>
	 
jQuery( document ).ready(function( $ ) {
	
	


jQuery.noConflict();
jQuery(document).ready(function(){
jQuery('.focus').matchHeight();
                    });

	

	 
 });	

	  
  </script>
</div> <!-- #main-content -->

<?php

get_footer();
