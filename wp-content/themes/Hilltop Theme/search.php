<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); 

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">


	<style>
	.dynamic-content {
    display:none;
}
	
	.show {
		display:block;
	}
	
	.et_fixed_nav #main-header, .et_fixed_nav #top-header {
    position: absolute;
}
	
	input[type="text"], select, textarea {
    padding: 2px;
    border: 1px solid rgba(140,115,42,0.4);
        border-top-color: rgba(140,115,42,0.4);
        border-right-color: rgba(140,115,42,0.4);
        border-bottom-color: rgba(140,115,42,0.4);
        border-left-color: rgba(140,115,42,0.4);
    color: #7f6707;
    background-color: rgba(139,115,15,0.08);
    width: 70%;
    height: 41px;
}
	
	
</style>





	

<div class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular et_pb_section_first">
			
				
					<section class="et_pb_fullwidth_header et_pb_module et_pb_bg_layout_dark et_pb_text_align_left hcbpheaderphoto et_pb_fullwidth_header_0 pubs" style="background-color:#006D75;">			
				
				<div class="et_pb_fullwidth_header_container left">
					<div class="header-content-container bottom">
					<div class="header-content">
						
<?php if ( have_posts() ) : ?>
			<h1 class="et_pb_module_header"><?php printf( __( 'Search Results for: %s'), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="et_pb_module_header"><?php _e( 'Nothing Found'); ?></h1>
		<?php endif; ?>						
						<div class="et_pb_header_content_wrapper"></div>
						
					</div>
				</div>
					
				</div>
				<div class="et_pb_fullwidth_header_overlay"></div>
				<div class="et_pb_fullwidth_header_scroll"></div>
			</section>
				
				
			</div>

	

	<div class="container">
		<div id="content-area" class="clearfix" style="min-height:400px;">

		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom:25px;">

	<header class="entry-header">
		<?php
		

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

			</article>


<?php
			endwhile; // End of the loop.

						the_posts_pagination( array(
	'mid_size'  => 2,
	'prev_text' => __( '< Back', 'textdomain' ),
	'next_text' => __( 'Next >', 'textdomain' ),
) );
								   
		

		else : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></p>
			<?php
				get_search_form();

		 endif;
					
					
						?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
