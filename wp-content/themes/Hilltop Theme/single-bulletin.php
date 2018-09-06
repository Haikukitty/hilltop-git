<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional //EN">


<?php


$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<html>
	<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,700,700i" rel="stylesheet">

		<title>Hilltop Bulletin - <?php the_title(); ?></title>

		
			
<!--[if mso]>
<style type="text/css">
body, table, td, p {font-family: Calibri, Arial, Helvetica, sans-serif !important;}
			h1 {font-family:candara,cambria,serif !important;}
h3 {font-family:calibri,arial,sans-serif !important;}
</style>
<![endif]-->
		
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
			
 /* latin-ext */
@font-face {
  font-family: 'Raleway';
  font-style: italic;
  font-weight: 300;
  src: local('Raleway Light Italic'), local('Raleway-LightItalic'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptpg8zYS_SKggPNyCgw5qN_DNCb71ka4ZiO.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Raleway';
  font-style: italic;
  font-weight: 300;
  src: local('Raleway Light Italic'), local('Raleway-LightItalic'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptpg8zYS_SKggPNyCgw5qN_AtCb71ka4Q.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
  font-family: 'Raleway';
  font-style: italic;
  font-weight: 700;
  src: local('Raleway Bold Italic'), local('Raleway-BoldItalic'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptpg8zYS_SKggPNyCgw9qR_DNCb71ka4ZiO.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Raleway';
  font-style: italic;
  font-weight: 700;
  src: local('Raleway Bold Italic'), local('Raleway-BoldItalic'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptpg8zYS_SKggPNyCgw9qR_AtCb71ka4Q.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
			
			/* latin-ext */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  src: local('Raleway'), local('RalewayRegular'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptug8zYS_SKggPNyCMIT4ttDfCmxA.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 400;
  src: local('Raleway'), local('RalewayRegular'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptug8zYS_SKggPNyC0IT4ttDfA.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 300;
  src: local('Raleway Light'), local('RalewayLight'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptrg8zYS_SKggPNwIYqWqhPANqczVsq4A.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 300;
  src: local('Raleway Light'), local('RalewayLight'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptrg8zYS_SKggPNwIYqWqZPANqczVs.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 700;
  src: local('Raleway Bold'), local('Raleway-Bold'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptrg8zYS_SKggPNwJYtWqhPANqczVsq4A.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Raleway';
  font-style: normal;
  font-weight: 700;
  src: local('Raleway Bold'), local('Raleway-Bold'), url(https://fonts.gstatic.com/s/raleway/v12/1Ptrg8zYS_SKggPNwJYtWqZPANqczVs.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
				
				 body {

     font-family: RalewayLight,RalewayRegular,Raleway,Arial, Sans-Serif;

                     font-weight:300;

                     line-height:120%;

                     color:#333333;

   }

 

             p

{font-family:RalewayLight,RalewayRegular,Raleway,Calibri,Arial,sans-serif;

             font-weight:300 !important;}

 

 

 

 

 

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

     color: #d97310;

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

 

 

 

 

     #content-area { max-width: 710px; margin:0 auto;}
				
</style>

</head>

	
   <body style="font-family:RalewayLight,RalewayRegular,Raleway,Arial,Sans-Serif;font-size:13pt; line-height: 140%; color: #333333;font-weight:300;background-color:#ffffff;">

 

 

<p align="center" style="text-align:center;font-size:10pt;font-family:calibri,arial;display:none;">
<a href="<?php echo get_permalink( $post->ID ); ?>">
<font color="#00a0af">View Online</font>
</a>
</p>
	   
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
					
					 <table width="700" style="width:700px;max-width:700px;" align="center" cellpadding="0" cellspacing="0">

<tr>

 

 

 

 

                         <td style="background-image:url('<?php echo $htmlheader['url']; ?>'); background-repeat:no-repeat;" background="<?php echo $htmlheader['url']; ?>" width="700" height="300" valign="top" style="height:300px;overflow:hidden;">

   <!--[if gte mso 9]>
   <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:700px;height:300px;">
     <v:fill type="frame" src="<?php echo $htmlheader['url']; ?>" color="#00a0af" />
    <v:textbox inset="0,0,0,0">
  <![endif]-->
  <div>
					
					<table width="700" height="300" align="center" style="max-height:300px;overflow:hidden;" cellpadding="10" cellspacing="0">

                         <tr>
                             <td valign="top" style="vertical-align:top;">

                                 <img src="https://hilltopinstitute.org/images/the-hilltop-institute.png" width="673" height="132" style="padding-left:0px;display:block;border:none;padding-bottom:0;padding-top:0;" alt="The Hilltop Institute" />

                                   <img src="https://hilltopinstitute.org/wp-content/uploads/2018/08/spacer.png" width="680" height="37" alt=""/>

                                 <h1 style="text-align:left;color:#ffffff;font-family:Candara,times,serif;font-size:39pt;padding:0;margin:0;padding-top:0;margin-top:0;padding-bottom:9px;margin-bottom:0px;font-weight:normal;padding-left:2px;">Bulletin</h1>

                                 <h3 style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:14pt;font-weight:normal;font-family:RalewayLight,RalewayRegular,Raleway,Arial,sans-serif;padding-left:5px;padding-bottom:0;"><?php the_time('F j, Y'); ?></h3>
							 <img src="https://hilltopinstitute.org/wp-content/uploads/2018/08/spacer.png" width="680" height="7" alt=""/>

                             </td>

                         </tr>

 

                     </table>
    </div>
  <!--[if gte mso 9]>
    </v:textbox>
  </v:rect>
  <![endif]-->
</td>

                         </tr>

 

                         <tr>

                             <td>

 

                                   <table width="680" align="center" cellpadding="0" cellspacing="0" border="0">

                                   <tr>

		<td>

       <img src="https://hilltopinstitute.org/wp-content/uploads/2018/08/spacer.png" width="680" height="15" alt=""/><br>
	
							 <h1 style="margin:0;text-align:center;font-family:candara,cambria,serif;font-size: 20pt; font-weight:bold;margin-bottom:0;line-height:110%;margin-top:0;"><?php the_title(); ?></h1>

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
	<tr>

 			<td style="font-family:RalewayLight,RalewayRegular,Raleway,Trebuchet,Arial,sans-serif;font-weight:300;font-size:13pt;line-height:120%;color:#333333;">

                               <img src="https://hilltopinstitute.org/wp-content/uploads/2018/08/spacer.png" width="680" height="7" alt=""/><br>
					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
		 <img src="<?php echo get_site_url(); ?>/images/spacer.png" width="680" height="20" alt=""/>
		</td>
						</tr>
								</table>
							</td>
							
						</tr>
						
					  <tr>

                             <td style="background-color:#E2DCC3;color:#8b730f;">

 							<table width="700" align="center" cellpadding="10" cellspacing="0">

                         <tr>

                             <td style="font-family:RalewayRegular,Raleway,Trebuchet,Arial,sans-serif;font-size:11pt;line-height:120%;color:#8b730f;font-weight:300;"> 
													
 <?php the_field('footer_content');
	?>
							</td>
									</tr>
							</table>
												

							
							</td>
						</tr>
						<tr>
							<td class="social" style="text-align:center;">
								<table id="Table_01" width="162" height="61" border="0" cellpadding="0" cellspacing="0" style="width:auto;margin:0 auto;">

    <tr>

        <td>
			<?php $social = get_permalink(); ?>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $social; ?>"><img src="https://hilltopinstitute.org/wp-content/uploads/social/facebook.png" width="34" height="61" alt="Facebook"></a></td>

        <td>

            <a href="https://twitter.com/home?status=<?php the_title_attribute(); ?>%3A%20<?php echo $social; ?>"><img src="https://hilltopinstitute.org/wp-content/uploads/social/twitter.png" width="45" height="61" alt="Twitter"></a></td>

        <td>

            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $social; ?>&title=<?php   the_title_attribute(); ?>&summary=&source=The%20Hilltop%20Institute"><img src="https://hilltopinstitute.org/wp-content/uploads/social/linkedin.png" width="40" height="61" alt="Linked In"></a></td>

        <td>

            <a href="mailto:?&subject=<?php the_title_attribute(); ?>&body=<?php echo $social; ?>"><img src="https://hilltopinstitute.org/wp-content/uploads/social/email.png" width="43" height="61" alt="Email"></a></td>

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

