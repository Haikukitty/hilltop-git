<?php
/*
Template Name: Publications Archive Page
*/



	
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

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
			
			<?php the_field('publications_archive_intro_text','cpt_publication'); ?>
			
			<?php echo do_shortcode( '[searchandfilter slug="publications"]' ); ?>
			
			<div id="results">

			<?php $i = 0; ?>

						<?php 
			
			$paged = ( get_query_var(‘page’) ) ? get_query_var(‘page’) : 1;
		if($paged == 1 ) {
			 $abstract = get_field('publication_abstract');  // in first page number of post (a=4)
		} else  { // in other page number of post (b=6),{equation: a+($paged -2)*b]
			
		}
			
			
			if (have_posts()) : while ( have_posts() ) : the_post(); ?>
 

				<article id="post-<?php the_ID(); ?> publist-<?php echo $i; ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h2 class="main_title feeds"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
						
						

						 <?php $paged = ( get_query_var(‘page’) ) ? get_query_var(‘page’) : 1;
		if(($paged == 1 ) && ($i = 0)) {
			 $abstract = get_field('publication_abstract');  // in first page number of post (a=4)
			
 ?>
					<?php
						 echo $abstract;

						
					?>
						  <?php }  else { }
						
 ?> 
		
					
					</div> <!-- .entry-content -->

			

				</article> <!-- .et_pb_post -->
			
			
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
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
