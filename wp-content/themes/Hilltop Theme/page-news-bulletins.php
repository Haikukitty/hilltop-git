<?php
/*
Template Name: News & Bulletins Main Page
*/



	
get_header();

 ?>

<style>
		#wp-admin-bar-et-use-visual-builder {
		display:none;
	}
</style>

<div id="main-content">


	<?php $newsheader = get_field('news_section_header_photo','cpt_news-bulletins'); ?>
	
	<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($newsheader) ): ?><?php echo $newsheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header">News &amp; Bulletins</h1>
						
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
			<div class="news-intro introtext">
			<?php the_field('news_section_intro_text','cpt_news-bulletins'); ?>
			</div>
			
			
			<div id="results">
				
				 <div class="the-news">



						<?php 
			
			
			
			
			if (have_posts()) : while ( have_posts() ) : the_post(); ?>
 


				<?php if ( ! $is_page_builder_used ) : ?>
					 
					   <?php
					 
					 								$numbernewsposts = get_field('number_of_featured_news', 'cpt_news-bulletins');


$args = array(
    'numberposts'     => $numbernewsposts,
	
    'post_type'       => 'news-bulletins',
    'post_status'     => 'publish', 
	 
	'orderby' => 'published_date',
	'order' => 'DESC',
		
	
	
);

$newsposts = get_posts( $args );


foreach( $newsposts as $post ) :  //setup_postdata($ppost); 
 setup_postdata( $post );  ?>
				


					<h2 class="main_title feeds"><?php echo $post->post_title; ?></h2>
		
				
				

	
			<?php the_content(); ?>
					 
					 					 <?php echo do_shortcode('[addtoany buttons="facebook,twitter,email"]'); ?> 

							  	<p class="published-dates newspage"><em><?php
						the_time('m/d/Y');
								?></em></p>
					 

					 

					 
					 
		<?php 
$pnum++;
endforeach;
					
?>
					 
<?php wp_reset_postdata(); ?>
					 
					 
			<?php endif; ?>
			
			<?php 

			
endwhile;
					
?>
				
	<?php endif; ?>
					 
				</div>
<div class="news-archive-link">
	<a href="<?php echo site_url(); ?>/news-bulletins/" class="et_pb_button button pdfbutton">News &amp; Bulletins Archive</a>
				</div>
			


					 
				</div>
			
		</div> <!-- #content-area -->
	</div> <!-- .container -->


</div> <!-- #main-content -->

<?php

get_footer();
