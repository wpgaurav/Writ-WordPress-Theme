<?php
/**
 * @package Writ
 */

/* If none of the sidebars have widgets, then let's bail early. */
if (! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>
<div id="tertiary" class="widget-area sidebar-widget-area">
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<div class="sidebar-widgets">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</div>
	<?php endif; ?>
</div>