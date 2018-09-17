<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<style>
 form_open:before {
 content: "";
background: rgba(0,0,0, 0.7);
position: fixed;
top: 0px;
left: 0px;
width: 100%;
height: 100%;
z-index: 100;
 transition: opacity 0.3s ease-in-out 0s, visibility 0.3s ease-in-out 0.3s;
 }
 
 .form_open {
 opacity:0;
 visibility:hidden;
 display:none;
 background-color: transparent;
 }
 
 .form_open.formshow {
 opacity:1;
 visibility:visible;
 display:block;
background-color: transparent;
 }

.noscroll { overflow: hidden; }

.overlay { 
   position: fixed; 
   overflow-y: scroll;
   top: 0; right: 0; bottom: 0; left: 0; }

[aria-hidden="true"] { display: none; }
[aria-hidden="false"] { display: block; }

.overlay .formholder {
 margin: 15vh auto;
width: 80%;
max-width: 500px;
padding: 15px 10px 20px 25px;
background: #ffffff;


background: #ffffff;

}
.overlay {
    background:  rgba(40,40,40, .75);
z-index:99999;
}
	




 
</style>

<style type="text/css">
#text{
display:none;
}
.btn-container{
 margin: auto;
 height:44px;
 width:166.23px;
 
}
a:active{
 color:#ffd323;
}
	
	
	.hidethis {
		display:none;
	}


</style>



<script type="text/javascript">
jQuery.noConflict();

jQuery(document).ready(function() {
jQuery("#toggle").click(function() {
 var elem = jQuery("#toggle").text();
 if (elem == "Read More") {
 //Stuff to do when btn is in the read more state
 jQuery("#toggle").text("Read Less");
 jQuery("#text").slideDown();
	 	 jQuery("#quote").removeClass('hidethis')

 jQuery("#expand").removeClass('textfade');
 } else {
 //Stuff to do when btn is in the read less state
jQuery("#toggle").text("Read More");
 jQuery("#text").slideUp();
	 jQuery("#quote").addClass('hidethis')
 jQuery("#expand").addClass('textfade');
 }
 });
});
</script>

<script>
	jQuery.noConflict();

jQuery(document).ready(function() {

jQuery('.button_popup').click(function() {
jQuery('.form_open').addClass("formshow");
jQuery('.overlay').attr("aria-hidden", "false");
});



jQuery('.formcloser').click(function() {
jQuery('.form_open').removeClass("formshow");
jQuery('.overlay').attr("aria-hidden", "true");
});


jQuery('.overlay').attr("aria-hidden", "true");
 // }
 // }
 // });

});

var body = document.body,
        overlay = document.querySelector('.overlay'),
        overlayBtts = document.querySelectorAll('button[class$="overlay"]');
        
    [].forEach.call(overlayBtts, function(btt) {

      btt.addEventListener('click', function() { 
         
         /* Detect the button class name */
         var overlayOpen = this.className === 'button_popup';
         
         /* Toggle the aria-hidden state on the overlay and the 
            no-scroll class on the body */
         overlay.setAttribute('aria-hidden', !overlayOpen);
         body.classList.toggle('noscroll', overlayOpen);
         
         /* On some mobile browser when the overlay was previously
            opened and scrolled, if you open it again it doesn't 
            reset its scrollTop property */
         overlay.scrollTop = 0;

      }, false);

    });

</script>






<div id="main-content">
	
	<?php if ( ! $is_page_builder_used ) : ?>

	<?php $teamheader = get_field('team_header_image','cpt_people');
	$teamtitle = get_field('our_teams_page_title','cpt_people');
	
	$teamlink = get_field('link_back_to_main_our_team_page','cpt_people'); ?>
	
	<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first feedpages">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left staffheaderphoto et_pb_fullwidth_header_0 pubs" style="background-image:url(<?php if( !empty($teamheader) ): ?><?php echo $teamheader['url']; ?><?php endif; ?>);">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
						<h1 class="et_pb_module_header"><a href="<?php echo $teamlink; ?>"><?php echo $teamtitle; ?></a></h1>
						
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
	
	
	add_filter( 'gform_field_value_staffemail', 'my_custom_population_function' );
function my_custom_population_function( $value ) {
    global $post;
    return function_exists( 'get_field' ) ? get_field( 'staff_email', $post->ID ) : false;
}
	?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					

					<div class="entry-content">
					<?php
						the_content();
					?>
					</div> <!-- .entry-content -->

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

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
} ?>
					
					<div class="row">
						<div class="col-md-4 col-sm-4 staff-pic">
						<?php	if ( has_post_thumbnail() ) { 
    the_post_thumbnail( 'size-full' ); } ?>
						
	
		<?php $quote = get_field('staff_quote_or_personal_info_optional');
								if ($quote): ?>
							
								<div id="quote" class="bioquote hidethis">
									<?php echo $quote; ?>
							</div>
							<?php endif; ?>
	
<?php	$emails = get_field('staff_email');
 ?>
						</div>
						
						<div class="col-md-8 col-sm-8 staff-info">
					
							<h2 class="staffname"><?php the_title(); ?></h2>
							
							<h5 class="stafftitle"><?php the_field('staff_title'); ?></h5>
							<h5 class="staffphone"><?php the_field('staff_phone'); ?></h5>
							<?php if ($emails): ?>
							<div class="email" style="clear:both;display:block;width:100%;"><a class="button_popup" href="#"><img class="size-full wp-image-594 alignleft" src="https://hilltopinstitute.org/wp-content/uploads/2018/04/email-icon.png" style="emailicon" alt="Contact by Email" width="40" height="32"></a></div>
							<?php endif; ?>
							
							
													
							
							<div class="staffbio" style="clear:both;padding-top:25px;">
								<div id="expand" class="textfade">
								<?php the_field('staff_bio'); ?>
								</div>
								<div id="text">
									<?php the_field('staff_bio_hidden'); ?>
								</div>
								
								<div class="btn-container"><button id="toggle">Read More</button></div>
							</div>
							
						</div>
					
				</article> <!-- .et_pb_post -->
					<section class="overlay" aria-hidden="true">
					

					<div class="formholder">
						
						<div class="et_pb_column et_pb_column_4_4  et_pb_column_5 et_pb_css_mix_blend_mode_passthrough et-last-child">

					
						
						<div class=" et-waypoint et_pb_animation_fade_in" >
						
						<h4 style="margin-top: 5px; padding-top: 4px; padding-bottom: 5px; margin-bottom: 2px;">Contact <?php the_title(); ?></h4>
						
						<?php $staff_form = get_field('contact_form_for_staff_pages','cpt_people');
							
							?>

						 
						
						<?php  echo $staff_form; ?>
						
						
						
						
						<div class="et_pb_code et_pb_module formcloser et_pb_code_1">
				
				
				<div class="et_pb_code_inner">
					<div class="form_close">X</div>
							</div></div> <!-- .et_pb_code_inner -->
			
													
						
						</div>
							

					</div>
																				<div class="style:clear:both;">&nbsp;</div>

			</div>
		</div>
		</section>
			<?php endwhile; ?>

	<?php endif; ?>
</div> <!-- #main-content -->





<?php

get_footer();
