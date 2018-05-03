<?php
/*
Template Name: News & Bulletins Archive Page
*/



	
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>
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
<?php endif; ?>
	<div class="container">
		<div id="content-area" class="clearfix">
			<div class="news-intro">
			<?php the_field('news_section_intro_text','cpt_news-bulletins'); ?>
			</div>
			
			
			<div id="results">

			<?php $i = 0; ?>

						<?php 
			
			
			
			
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
