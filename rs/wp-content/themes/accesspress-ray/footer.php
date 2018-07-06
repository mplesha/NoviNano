<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package AccessPress Ray
 */
?>
<?php 
global $post, $accesspress_ray_options;
$accesspress_ray_settings = get_option( 'accesspress_ray_options', $accesspress_ray_options );
?>
	</div><!-- #content -->

	<footer id="colophon">
	<?php 
		if ( is_active_sidebar( 'footer-1' ) ||  is_active_sidebar( 'footer-2' )  || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' ) ) : ?>
		<div id="top-footer">
		<div class="ak-container">
			<div class="footer1 footer">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php endif; ?>	
			</div>

			<div class="footer2 footer">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php endif; ?>	
			</div>

			<div class="clearfix hide"></div>

			<div class="footer3 footer">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php endif; ?>	
			</div>

			<div class="footer4 footer">
				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				<?php endif; ?>	
			</div>
		</div>
		</div>
		<?php endif; ?>

		<div id="middle-footer" class="footer-menu">
			<div class="ak-container">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'depth' => -1) ); 	?>
			</div>
		</div>

		<div id="bottom-footer">
		<div class="ak-container">
			<div class="footer-wrap clearfix">
				<div class="copyright">
					<?php _e('Copyright', 'accesspress-ray'); ?> &copy; <?php echo date('Y') ?> 
					<a href="<?php echo home_url(); ?>">
					<?php if(!empty($accesspress_ray_settings['footer_copyright'])){
						echo $accesspress_ray_settings['footer_copyright']; 
						}else{
							echo bloginfo('name');
						} ?>
					</a>. <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>"><?php printf( __( 'Powered by %s', 'accesspress-ray' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php _e( 'Theme:', 'accesspress-ray' ) ?> <a href="<?php echo esc_url('http://accesspressthemes.com/');?>" title="AccessPress Themes" target="_blank">AccessPress Ray</a>
				</div><!-- .copyright -->
			</div><!-- .footer-wrap -->

			<?php if($accesspress_ray_settings['show_social_footer'] == 0){?>
			<div class="footer-socials clearfix">
	            <?php
					do_action( 'accesspress_ray_social_links' ); 
				?>
			</div>
			<?php } ?>
		</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<div class="multi-border">
	<ul>
		<li class="dark-green"></li>
		<li class="yellow"></li>
		<li class="cream"></li>
		<li class="orange"></li>
		<li class="light-green"></li>				
	</ul>
</div>
<?php wp_footer(); ?>
</body>
</html>
