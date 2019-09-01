<?php
/**
 * Template part for displaying footer
 *
 * @package Bizworx
 */

?>

	</div><!-- /.row -->
	</div><!-- /.container -->
	</div><!-- /.page-wrap -->
	
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<?php get_sidebar('footer'); ?>
	<?php endif; ?>
    <footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<div style="text-align:center;">Изработено од Андреј Нанков студент на ФИНКИ. </div>
			<!--
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'bizworx' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'bizworx' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( '%2$s theme build by %1$s.', 'bizworx' ), 'Themeworx', '<a href="http://themeworx.net/demo/bizworx" rel="designer">Bizworx</a>' ); ?>
			<div class="go-top">
				<i class="fa fa-angle-up"></i>
			</div>
-->
		</div>
    </footer><!-- /.site-footer -->
	
	<?php wp_footer(); ?> 
  </body>
</html>