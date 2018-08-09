<?php


$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>
<html>
	<head>
		<title>Hilltop Bulletin - <?php
						the_title();
					?></title>
<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,700,700i" rel="stylesheet">

		
		<style>
	
	@font-face {
	font-family: 'Calibri';
	  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri.eot'); /* IE9 Compat Modes */
  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri.woff2') format('woff2'), /* Super Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri.woff') format('woff'), /* Pretty Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri.svg#svgCalibri') format('svg'); /* Legacy iOS */
	font-weight: normal;
	font-style: normal;
}

@font-face {
	font-family: 'Calibri-Italic';
	  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Italic.eot'); /* IE9 Compat Modes */
  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Italic.woff2') format('woff2'), /* Super Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Italic.woff') format('woff'), /* Pretty Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Italic.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Italic.svg#Calibri-Italic') format('svg'); /* Legacy iOS */
	font-weight: normal;
	font-style: normal;
}

@font-face {
	font-family: 'Calibri-Bold';
	  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Bold.eot'); /* IE9 Compat Modes */
  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Bold.woff2') format('woff2'), /* Super Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Bold.woff') format('woff'), /* Pretty Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Bold.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Calibri-Bold.svg#Calibri-Bold') format('svg'); /* Legacy iOS */
	font-weight: normal;
	font-style: normal;
}

@font-face {
	font-family: 'Candara';
	  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara.eot'); /* IE9 Compat Modes */
  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara.woff') format('woff'), /* Pretty Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara.svg#Candara') format('svg'); /* Legacy iOS */
	font-weight: normal;
	font-style: normal;
}

@font-face {
	font-family: 'Candara-Italic';
	  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Italic.eot'); /* IE9 Compat Modes */
  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Italic.woff2') format('woff2'), /* Super Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Italic.woff') format('woff'), /* Pretty Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Italic.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Italic.svg#Candara-Italic') format('svg'); /* Legacy iOS */
	font-weight: normal;
	font-style: normal;
}

@font-face {
	font-family: 'Candara-Bold';
	  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Bold.eot'); /* IE9 Compat Modes */
  src: url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Bold.woff2') format('woff2'), /* Super Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Bold.woff') format('woff'), /* Pretty Modern Browsers */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Bold.ttf')  format('truetype'), /* Safari, Android, iOS */
       url('https://hilltopinstitute.org/wp-content/themes/Hilltop Theme/assets/typography/Candara-Bold.svg#Candara-Bold') format('svg'); /* Legacy iOS */
	font-weight: normal;
	font-style: normal;
}


.textWrap {
	float: left;
	padding-top: 10px;
	padding-left: 0px;
	padding-right: 20px;
	padding-bottom: 10px;	
}
	a {
	color: #d97310;
	font-weight: bold;
	text-decoration: none;
}
	
		a strong {
	color: #d97310;
	font-weight: bold;
	text-decoration: none;
}
	
		a strong em {
	color: #d97310;
	font-weight: bold;
	text-decoration: none;
			font-style:italic;
}
	
		a em{
	color: #d97310;
	font-weight: bold;
	text-decoration: none;
			font-style:italic;

}

a:link {
	color: #d97310;
	font-weight: bold;
	text-decoration: none;
}
a:visited {
	color: #00302F;
	font-weight: bold;
}
a:active {
	color: #00302F;
	font-weight: bold;
}
a:hover {
	color: #d97310;
	font-weight: bold;
	text-decoration: underline;
}
			
			
			
			.aligncenter {
				display: block;
margin-right: auto;
margin-left: auto;
			}
			
			.alignright {
			display: inline;
float: right;
margin-left: 15px;
			}
			.alignleft {
				display: inline;
float: left;
margin-right: 15px;
			}
	
	h1.entry-title { font-family:'Candara','orienta',arial;  font-size: 20pt; color: #333333;font-weight:normal;}


h1.bulletin { font-family:'Candara-Bold','Candara',times new roman; font-size: 36pt;padding:0;margin:0;padding-top:0;magin-top:0;padding-bottom:5px;margin-bottom:2px; }

.newsHead { font-family:'Candara-Bold','Candara',times new roman; font-size: 11pt; font-style:italic; font-weight:bold;}

.contentTitle { font-family:'raleway',calibri,arial; font-size: 14pt; font-weight:bold;}

	
	#content-area { max-width: 710px; margin:0 auto;}


.links  { font-family:'raleway',calibri,arial; font-size:12pt;}

td { font-family:'raleway',calibri,arial; font-size:12pt;}

.info { font-family:'raleway',calibri,arial; font-size:11pt; font-style:italic }

.elevator { font-family:'raleway',calibri,arial; font-size:10pt }
.style1 {font-family:'Candara',times new roman; font-size: 36pt;padding:0;margin:0;padding-top:0;magin-top:0;padding-bottom:5px;margin-bottom:2px; }
.style2 {
	font-family:'raleway',calibri,arial; 
	font-style: italic;
}
			
				h3.thedate {
		margin-top:0;
					padding-top:0;
		font-size:14pt;
					font-weight:normal;
					font-family:'Raleway','arial',sans-serif;
		color:#ffffff;
					padding-left:5px;
	}
			
			.entry-content.html p {
				text-align:justify;
			}
</style>

</head>
	
	<body>
<div id="main-content">
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
	<div class="container">
		<div id="content-area" class="clearfix">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<?php if ( ( 'off' !== $show_default_title && $is_page_builder_used ) || ! $is_page_builder_used ) { ?>
					
					
 <?php $htmlheader = get_field('html_header_photo');
	?>
					
					<table width="700" align="center" cellpadding="0" cellspacing="0">

<tr>

                <td style="height:340px;background-color:#00a0af;background-image:url(<?php if( !empty($htmlheader) ): ?><?php echo $htmlheader['url']; ?><?php endif; ?>);overflow:hidden;">
					
					<table width="680" align="center">
						<tr>
							<td>
								<img src="<?php echo get_site_url(); ?>/images/the-hilltop-institute.png" style="padding-left:7px;display:block;border:none;padding-bottom:73px;padding-top:11px;" />					
							</td>
						</tr>
						<tr>
							<td>
								<h1 class="style1" style="text-align:left;color:#ffffff;font-family:'Candara',times new roman; font-size:39pt;padding:0;margin:0;padding-top:0;magin-top:0;padding-bottom:5px;margin-bottom:2px;font-weight:normal;padding-left:2px;">Bulletin</h1>
								
								<h3 class="thedate"><?php the_time('F j, Y'); ?></h3>
						</tr>
					</table>
	</td>
						</tr>
						
						<tr>
							<td>
								
													<table width="680" align="center">
														<tr>
															<td>

	
	
					
							<h1 class="entry-title" style="text-align:center;font-family:candara,cambria,times new roman; font-size: 20pt; font-weight: bold;padding-top:27px;padding-bottom:3px;margin-bottom:0;"><?php the_title(); ?></h1>

						<?php
							if ( ! post_password_required() ) :


								$thumb = '';

								$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

								$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
								$classtext = 'et_featured_image';
								$titletext = get_the_title();
								$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
								$thumb = $thumbnail["thumb"];

								$post_format = et_pb_post_format();

								if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) {
									printf(
										'<div class="et_main_video_container">
											%1$s
										</div>',
										$first_video
									);
								} else if ( ! in_array( $post_format, array( 'gallery', 'link', 'quote' ) ) && 'on' === et_get_option( 'divi_thumbnails', 'on' ) && '' !== $thumb ) {
									print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
								} else if ( 'gallery' === $post_format ) {
									et_pb_gallery_images();
								}
							?>

							<?php
								$text_color_class = et_divi_get_post_text_color();

								$inline_style = et_divi_get_post_bg_inline_style();

								switch ( $post_format ) {
									case 'audio' :
										$audio_player = et_pb_get_audio_player();

										if ( $audio_player ) {
											printf(
												'<div class="et_audio_content%1$s"%2$s>
													%3$s
												</div>',
												esc_attr( $text_color_class ),
												$inline_style,
												$audio_player
											);
										}

										break;
									case 'quote' :
										printf(
											'<div class="et_quote_content%2$s"%3$s>
												%1$s
											</div> <!-- .et_quote_content -->',
											et_get_blockquote_in_content(),
											esc_attr( $text_color_class ),
											$inline_style
										);

										break;
									case 'link' :
										printf(
											'<div class="et_link_content%3$s"%4$s>
												<a href="%1$s" class="et_link_main_url">%2$s</a>
											</div> <!-- .et_link_content -->',
											esc_url( et_get_link_url() ),
											esc_html( et_get_link_url() ),
											esc_attr( $text_color_class ),
											$inline_style
										);

										break;
								}

							endif;
						?>
							</td>
						</tr>
				<?php  } ?>
	<tr><td style="font-family:'Raleway','Arial',sans-serif;">
		
					<div class="entry-content html">
					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->
		</td>
						</tr>
								</table>
							</td>
							
						</tr>
						
						<tr>
							<td style="background:#E2DCC3;padding:15px;font-family:'Raleway','Arial',sans-serif;">
													
 <?php the_field('footer_content');
	?>
							</td>
						</tr>
						<tr>
							<td class="social" style="text-align:center;">
								<table id="Table_01" width="162" height="61" border="0" cellpadding="0" cellspacing="0" style="width:auto;margin:0 auto;">

    <tr>

        <td>

            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink( $post->ID ); ?>"><img src="https://hilltopinstitute.org/wp-content/uploads/social/facebook.png" width="34" height="61" alt="Facebook"></a></td>

        <td>

            <a href="https://twitter.com/home?status=<?php the_title(); ?>%3A%20<?php echo get_permalink( $post->ID ); ?>"><img src="https://hilltopinstitute.org/wp-content/uploads/social/twitter.png" width="45" height="61" alt="Twitter"></a></td>

        <td>

            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink( $post->ID ); ?>&title=<?php the_title(); ?>&summary=&source=The%20Hilltop%20Institute"><img src="https://hilltopinstitute.org/wp-content/uploads/social/linkedin.png" width="40" height="61" alt="Linked In"></a></td>

        <td>

            <a href="mailto:?&subject=<?php the_title(); ?>&body=<?php echo get_permalink( $post->ID ); ?>"><img src="https://hilltopinstitute.org/wp-content/uploads/social/email.png" width="43" height="61" alt="Email"></a></td>

    </tr>

</table>
							</td>
							
						</tr>
					</table>
				
				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

		</div> <!-- #content-area -->
	</div> <!-- .container -->
	<?php endif; ?>
</div> <!-- #main-content -->
</body>
</html>
<?php ?>

