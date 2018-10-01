<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Canos
 */

if ( ! is_active_sidebar( 'canos-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'canos-sidebar' ); ?>
</div><!-- #secondary -->
