<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Canos
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">

		<div class="wrap">

			<?php
			/* Show custom logo if the option is selected */
			if ( get_theme_mod( 'canos_opt_footer_logo' ) ) : ?>

				<?php
				/* Check if a custom logo is available */
				if ( get_theme_mod( 'canos_opt_logo' ) ) : ?>

					<?php $canos_logo_data = get_theme_mod( 'canos_opt_logo_data' ); ?>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-logo"><img id="footer-desktop-logo" src="<?php echo esc_url( get_theme_mod( 'canos_opt_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $canos_logo_data[ 'width' ] ); ?>" height="<?php echo esc_attr( $canos_logo_data[ 'height' ] ); ?>">
						<?php
						/* Check if the retina version is available */
						if ( get_theme_mod('canos_opt_logo_retina') ): ?>
							<?php $canos_logo_retina_data = get_theme_mod( 'canos_opt_logo_retina_data' ); ?>
							<img id="footer-retina-logo" src="<?php echo esc_url( get_theme_mod( 'canos_opt_logo_retina' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $canos_logo_retina_data[ 'width' ] ); ?>" height="<?php echo esc_attr( $canos_logo_retina_data[ 'height' ] ); ?>">
						<?php endif; ?>
					</a>
					
				<?php endif; ?>

			<?php endif; ?>

			<?php if ( ! get_theme_mod( 'canos_opt_hide_footer_menu' ) ) : ?>
				<?php
				/* First check if a menu is assigned to the location */
				if ( has_nav_menu('primary') ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_id' => 'footer-menu', 'depth' => -1 ) ); ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'canos_opt_footer_text' ) ) : ?>

			<div class="site-description" itemprop="description">
				<?php echo esc_html( get_theme_mod( 'canos_opt_footer_text' ) ); ?>
			</div><!-- .site-description -->

			<?php endif; ?>

			<a id="back-top" href="#masthead"><?php esc_html_e( 'Back to top', 'canos' ); ?></a>

		</div><!-- .wrap -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
