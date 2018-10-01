<?php
/**
 * The mobile sidebar.
 *
 * @package Canos
 */

?>

<div id="site-sidebar" class="widget-area" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<div class="sidebar-navigation">
		<nav id="site-navigation" class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
			<h3 class="semantic"><?php esc_html_e( 'Site navigation', 'canos' ); ?></h3>

			<?php
			/* First check if a menu is assigned to the location */
			if ( has_nav_menu('primary') ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<?php endif; ?>
		</nav><!-- #site-navigation -->

		<?php dynamic_sidebar( 'canos-sidebar-mobile' ); ?>

	</div><!-- .sidebar-navigation -->
</div><!-- #secondary -->
