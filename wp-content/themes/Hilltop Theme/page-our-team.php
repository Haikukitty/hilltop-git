<?php
/*
Template Name: Our Team Main Page
*/


get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>


<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<?php $teamheader = get_field('team_header_image','cpt_people'); ?>
	
	<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first feedpages">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($teamheader) ): ?><?php echo $teamheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header">Our Teams</h1>
						
						<div class="et_pb_header_content_wrapper"></div>
						
					</div>
				</div>
					
				</div>
				<div class="et_pb_fullwidth_header_overlay" style="background-color: rgba(40,40,40,0.45);"></div>
				<div class="et_pb_fullwidth_header_scroll"></div>
			</section>
				
				
			</div>
<?php endif; ?><div class="container">
		<div id="content-area" class="clearfix">
			
		<?php	$teamintrotext = get_field('our_team_main_page_intro_content_or_photo','cpt_people');
if($teamintrotext) { ?>
	
	<div class="introtext teamintrotext">
		
		<?php echo $teamintrotext; ?>
			</div>
<?php } ?>

			
			
 <div class="the-teams">
			<?php $i = 0; ?>

			<?php
//$_terms = get_terms( array('teams') );
			
			$_terms = get_terms( array(
    'taxonomy' => 'teams',
    'hide_empty' => true,
				'orderby' => 'ID'
) );
 $c = 0;
foreach ($_terms as $term) :

    $term_slug = $term->slug;
    $_posts = new WP_Query( array(
                'post_type'         => 'people',
                'posts_per_page'    => 50, //important for a PHP memory limit warning
				'orederby' => 'publication_date',
		'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'teams',
                        'field'    => 'slug',
                        'terms'    => $term_slug,
                    ),
                ),
            )); ?>


  <?php  if( $_posts->have_posts() ) : ?>
	
	
	<h3 class="lilo-accordion-control" id="tab<?php echo $i; ?>1" data-tab-index="<?php echo $i; ?>">
		<a name="tab<?php echo $i; ?>"><?php echo $term->name; ?></a>
       
    
   
			</h3>


    
		 
		  <div class="lilo-accordion-content" id="tab<?php echo $i; ?>">
			  <div class="row">
		   <?php   while ( $_posts->have_posts() ) : $_posts->the_post();
        ?>
			  
				  <div class="col-md-3 col-sm-6">
					  <div class="teamthumb">
						  <a href="<?php echo get_permalink($post->ID); ?>"><?php
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail('team-size');
}
							  ?></a></div>
<h4 class="main_title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h4>  
					  							<h5 class="stafftitle"><?php the_field('staff_title'); ?></h5>

			   </div>
			   <?php
        endwhile; ?>
				 
			  </div>
	
			  </div>
   

	
	 <?php
$i++;
    endif;
    wp_reset_postdata();  ?>
	
			
<?php endforeach;
?>

			</div>		</div>	

			




		</div> <!-- #content-area -->
	</div> <!-- .container -->


</div> <!-- #main-content -->

 <script>
	 
jQuery( document ).ready(function( $ ) {
    jQuery('.the-teams').liloAccordion({
  onlyOneActive: false,
  initFirstActive: false,
  hideControl: false,
  openNextOnClose: false

})

	 

jQuery(".lilo-accordion-content").click(function () {
	
	    var parentId = jQuery(this).prop('id');

	
	            sessionStorage.setItem('parentId', parentId);

	
  //  sessionStorage.setItem("shop-vehicle", jQuery(parentId).css("display"));
});
	
			 


	});
			
	 
	 window.onload = function() {

			    var parentId = sessionStorage.getItem('parentId');
		 
		 var parentacc = parentId + "1";

	 
  
		sessionStorage.getItem('parentId');
		//sessionStorage.getItem("parentId");
        document.getElementById(parentId).style.display = "block";
		       var acc= document.getElementById(parentacc);
		 acc.className += " active remembered";
	 }


	


	 
	  
  </script>



<?php

get_footer();
