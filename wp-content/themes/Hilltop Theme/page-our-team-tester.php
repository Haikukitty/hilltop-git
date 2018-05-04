<?php
/*
Template Name: Our Team Main Template
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
						
						<h1 class="et_pb_module_header">Our Team</h1>
						
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

			
			
 <div class="the-teams" id="accordion">
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
	
	
	<h3 class="lilo-accordion-control" id="tab<?php echo $i; ?>" data-tab-index="<?php echo $i; ?>">
		<a name="tab<?php echo $i; ?>" class="menu_head"><?php echo $term->name; ?></a>
       
    
   
			</h3>


    
		 
		  <div class="lilo-accordion-content">
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
	 
jQuery(document).ready( function() {
    jQuery('#accordion').accordion({
        collapsible:true,
		navigation:true,
				heightStyle: "content",
        beforeActivate: function(event, ui) {
             // The accordion believes a panel is being opened
            if (ui.newHeader[0]) {
                var currHeader  = ui.newHeader;
                var currContent = currHeader.next('.ui-accordion-content');
             // The accordion believes a panel is being closed
            } else {
                var currHeader  = ui.oldHeader;
                var currContent = currHeader.next('.ui-accordion-content');
            }
             // Since we've changed the default behavior, this detects the actual status
            var isPanelSelected = currHeader.attr('aria-selected') == 'true';
            
             // Toggle the panel's header
            currHeader.toggleClass('ui-corner-all',isPanelSelected).toggleClass('accordion-header-active ui-state-active ui-corner-top',!isPanelSelected).attr('aria-selected',((!isPanelSelected).toString()));
            
            // Toggle the panel's icon
            currHeader.children('.ui-icon').toggleClass('ui-icon-triangle-1-e',isPanelSelected).toggleClass('ui-icon-triangle-1-s',!isPanelSelected);
            
             // Toggle the panel's content
            currContent.toggleClass('accordion-content-active',!isPanelSelected)    
            if (isPanelSelected) { currContent.slideUp(); }  else { currContent.slideDown(); }

            return false; // Cancels the default action
        }
		

  	  });
	
});
	 
	 	jQuery(document).ready(function () {

jQuery(".lilo-accordion-content").click(function () {
	
	    var parentId = jQuery(this).prop('id');

    jQuery(parentId).css("display", "block");
	
	            sessionStorage.setItem('parentId', parentId).css('display')

	
  //  sessionStorage.setItem("shop-vehicle", jQuery(parentId).css("display"));
});
	 
    if (sessionStorage.getItem("parentId"))
    {
		
		sessionStorage.getItem("parentId");
        jQuery('parentId').css("display", "block");
    }
});
	
	


	 
	  
  </script>



<?php

get_footer();
