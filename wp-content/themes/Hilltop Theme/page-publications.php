<?php
/*
Template Name: Publications Main Page Template
*/



	
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">
	
	<?php while( have_posts() ): the_post(); /* start main loop */ ?>


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
			<div class="news-intro introtext">
			<?php the_field('publications_archive_intro_text','cpt_publication'); ?>
			</div>
			
			<div class="pubsearchfilter">
				<h4 style="color:#333333;">
					Search all publications:</h4>
			
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
						  
										  </div>
					
					 
				</div>
					 
	<?php	 endwhile;
endif;
wp_reset_postdata(); ?>
			
			
				
				<p class="clear:both;">&nbsp;</p>
			
			</div>
					 			
<div class="pubs-archive-link" style="clear:both;min-height:100px;margin-top:40px;">
	<p><a href="<?php echo site_url(); ?>/publication/" class="et_pb_button button pdfbutton">Publications Archive</a></p>
				</div>		
					
					 
			
		</div> <!-- #content-area -->
	</div> <!-- .container -->

</div>

<?php	 endwhile; ?>
</div> <!-- #main-content -->

<?php

get_footer();
