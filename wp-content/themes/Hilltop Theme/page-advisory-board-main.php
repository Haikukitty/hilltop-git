<?php
/*
Template Name: Advisory Board Main Page
*/


get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<style>
	button#toggle {
 padding: 7px 7px !important;
    margin-top: 0em;
		min-width: 110px;
}
</style>

<div id="main-content">


	<?php  ?>

	<?php $boardheader = get_field('board_header_image','cpt_board');
	$boardlink = get_field('board_link','cpt_board');
	$boardtitle = get_field('advisory_board_title','cpt_board'); ?>
	
	<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first feedpages">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($boardheader) ): ?><?php echo $boardheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header"><a href="/advisory-board/"><?php echo $boardtitle; ?></a></h1>
						
						<div class="et_pb_header_content_wrapper"></div>
						
					</div>
				</div>
					
				</div>
				<div class="et_pb_fullwidth_header_overlay" style="background-color: rgba(40,40,40,0.45);"></div>
				<div class="et_pb_fullwidth_header_scroll"></div>
			</section>
				
				
			</div>
<?php ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			
		<?php	$boardintrotext = get_field('board_intro_text','cpt_board');
if($boardintrotext) { ?>
	
	<div class="introtext teamintrotext">
		
		<?php echo $boardintrotext; ?>
			</div>
			
<?php } ?>

			
			
			
 <div class="the-board" style="clear:both;">
			<?php $i = 0; ?>

			<?php
//$_terms = get_terms( array('teams') );
			
			$posts = get_posts(array(
	'post_type'			=> 'board',
	'posts_per_page'	=> -1,
	'meta_key'			=> 'order_on_advisory_board_listing_page',
	'orderby'			=> 'meta_value_num',
	'order'				=> 'ASC'
));

if( $posts ): ?>
	
	
		
	<?php foreach( $posts as $post ): 
		
		setup_postdata( $post )
			
			?>

<div class="row board">
	  <div class="col-md-3 col-sm-3 col-xs-12 teamdiv">
					  <div class="teamthumb">
						  <a href="<?php echo get_permalink($post->ID); ?>"><?php
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail('team-size');
}
							  ?></a></div>
	</div>
		  <div class="col-md-9 col-sm-9 col-xs-12">
<h4 class="main_title board"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h4>  
					  							<h5 class="stafftitle"><?php the_field('board_title'); ?></h5>
			  <h5 class="stafftitle boardco"><?php the_field('board_company'); ?></h5>
			  
			  			  <?php the_excerpt(); ?>

			  
			  <!-- <?php the_content(); ?> -->

			   </div>
	</div>

			  	<?php endforeach; ?>

				 
			  </div>
	
			  </div>
   

	
	<?php wp_reset_postdata(); ?>
		
		<?php endif; ?>



			</div>		</div>	

			




		</div> <!-- #content-area -->
	</div> <!-- .container -->


</div> <!-- #main-content -->

 



<?php

get_footer();
