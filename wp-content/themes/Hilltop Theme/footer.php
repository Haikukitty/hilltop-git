<?php if ( 'on' == et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer">
				

				
				
				
				
				
				<?php get_sidebar( 'footer' ); ?>


		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div class="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'bottomfooter' ) ) : ?> 
				<div id="et-footer-bottom">
				<?php dynamic_sidebar('bottomfooter'); ?>

				</div>
			<?php endif; ?>

				
				<div id="footer-bottom">
					<div class="container clearfix">
				<?php
					if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
						get_template_part( 'includes/social_icons', 'footer' );
					}

					echo et_get_footer_credits();
				?>
					</div>	<!-- .container -->
				</div>
									<?php
 if ((is_active_sidebar('side-tab')) && (is_front_page())) : ?>
				<?php dynamic_sidebar('side-tab'); ?>


      <?php  endif;

?>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>



	</div> <!-- #page-container -->



	<?php wp_footer(); ?>
					
<script type="text/javascript" src="/wp-content/themes/Hilltop Theme/assets/js/jquery.matchHeight-min.js"></script>
</body>
</html>