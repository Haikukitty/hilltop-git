<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<style>
	
	.formdiv {
		    z-index: 9999999;
}
	.formcloser {
    position: absolute;
    z-index: 999999999;
    top: -25px;
    color: #ffffff;
    right: -25px;
    font-size: 33px;
    padding: 10px 15px;
    background: #d97310;
    border-radius: 50%;
    cursor: pointer;
}
	
 .form_open:before {
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
	
	

.form_open.formshow {
    position: fixed;
    width: 100%;
    min-width: 600px;
    z-index: 99999;
    top: 19%;
}
.form_open {
    opacity: 0;
    visibility: hidden;
    display: none;
    background-color: transparent;
}
 .formshow .formholder {
    position: absolute;
    top: 50%;
    max-width: 500px;
    z-index: 999999999999;
    background: #ffffff;
    left: 20%;
    padding: 23px 0px 3px 15px;
}
</style>

<script>
jQuery(document).ready(function() {

jQuery('.button_popup').click(function() {
jQuery('.form_open').addClass("formshow");
});



jQuery('.formcloser').click(function() {
jQuery('.form_open').removeClass("formshow");
});

 // jQuery(document).click(function (e) {
 // if (jQuery(".form_open").hasClass("formshow")) {
 // if (!$('.form_open').is(e.target) && !$('input').is(e.target) && !$('button_popup').is(e.target)) {
 // $(".form_open").removeClass("formshow");
 // }
 // }
 // });

});
</script>





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
<?php endif; ?>
	
	<?php
//add_filter("gform_field_value_staffname", "populate_staffname");
// function populate_staffname($value){
// return get_post_meta($post->ID, 'staff-name', true);
// }
global $post;
add_filter("gform_field_value_staffemail", "populate_staffemail");
function populate_staffemail($value){
return get_post_meta($post->ID, 'wpcf-staff-email', true);
}
	
// }
					
//					add_filter( 'gform_pre_render', 'staff_email' );
//function staff_email( $value ) {
//    global $post;
 
 //   $staffemail = get_post_meta($post_id, 'wpcf_staff-email', true);
 
 //   return $staffemail;
//}
	
	



?>
	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post(); ?>

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
	
	<?php
//add_filter("gform_pre_render", "populate_staffname");
//function populate_staffname($value){
//return get_post_meta($post->ID, 'wpcf-staff-name', true);
// }

//add_filter("gform_pre_render", "populate_staffemail");
// function populate_staffemail($value){
// return get_post_meta($post->ID, 'wpcf-staff-email', true);
	
// }
					

	
	



?>
	
		<?php
//add_filter("gform_field_value_staffname", "populate_staffname");
// function populate_staffname($value){
// return get_post_meta($post->ID, 'staff-name', true);
// }
//global $post;
//add_filter("gform_field_value_staffemail", "populate_staffemail");
//function populate_staffemail($value){
//return get_post_meta($post->ID, 'wpcf-staff-email', true);
//}
	
// }
					
//					add_filter( 'gform_pre_render', 'staff_email' );
//function staff_email( $value ) {
//    global $post;
 
 //   $staffemail = get_post_meta($post_id, 'wpcf_staff-email', true);
 
 //   return $staffemail;
//}
	
	



?>
	
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
						<div class="col-md-4 staff-pic">
						<?php	if ( has_post_thumbnail() ) { 
    the_post_thumbnail( 'size-full' ); 
} ?>
						</div>
						
						<div class="col-md-8">
					
							<h2 class="staffname"><?php echo(types_render_field("staff-name", array('raw' => true))); ?></h2>
							<h5 class="stafftitle"><?php echo(types_render_field("staff-title", array('raw' => true))); ?></h5>
							<h5 class="staffphone" style="display:none;"><?php echo(types_render_field("staff-phone", array('raw' => true))); ?></h5>
							
							<div class="email" style="clear:both;display:block;width:100%;"><a class="button_popup" href="#"><img class="size-full wp-image-594 alignleft" src="http://dev-hilltop.pantheonsite.io/wp-content/uploads/2018/04/email-icon.png" style="emailicon" alt="" width="40" height="32"></a></div>
							
							
													
							
							<div class="staffbio" style="clear:both;padding-top:25px;">
								<?php echo(types_render_field("staff-bio", array('output' => 'html'))); ?>
							</div>
							
						</div>
					
				</article> <!-- .et_pb_post -->
					
										<div class="form_open">

					<div class="formholder">
					
						
						<div class=" et-waypoint et_pb_animation_fade_in" >
						
						<h4 style="margin-top: 5px; padding-top: 4px; padding-bottom: 5px; margin-bottom: 2px;">Contact <?php echo(types_render_field("staff-name", array('raw' => true))); ?></h4>
						
						<?php $staff_form = get_field('contact_form_for_staff_pages','cpt_people');
							
							?>

						 
						
						<?php  echo $staff_form; ?>
						
					</div>
						
						
						
						<div class="et_pb_code et_pb_module formcloser et_pb_code_1">
				
				
				<div class="et_pb_code_inner">
					<div class="form_close">X</div>
				</div> <!-- .et_pb_code_inner -->
			</div>
						
						</div>
					</div>
			</article>
		</div>
		</div>
			<?php endwhile; ?>

	<?php endif; ?>
</div> <!-- #main-content -->

<?php

get_footer();
