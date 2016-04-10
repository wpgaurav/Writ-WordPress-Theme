<?php
/**
 * @package Writ
 */
 ?>
<div id="footer" class="footer-elements">

<div id="secondary" class="widget-area footer-widget-area" role="complementary">
<div class="first footer-widgets">
  <?php if(is_active_sidebar('sidebar-1')) { dynamic_sidebar( 'sidebar-1' ); } ?>
</div>
<div class="second footer-widgets">
  <?php if(is_active_sidebar('sidebar-2')) { dynamic_sidebar( 'sidebar-2' ); } ?>
</div>
<div class="third footer-widgets">
<?php if(is_active_sidebar('sidebar-3')) { dynamic_sidebar( 'sidebar-3' ); } ?>
</div>
</div><!-- #secondary -->
<div id="footer-credits">
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'writ_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'writ' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'writ' ), 'WordPress' ); ?></a>
			<span class="sep">  &#8226; </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'writ' ), 'Writ', '<a href="http://gauravtiwari.org/" rel="designer">Gaurav Tiwari</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #footer-credits -->
</div> <!-- #footer -->


<?php wp_footer(); ?>

</body>
</html>
