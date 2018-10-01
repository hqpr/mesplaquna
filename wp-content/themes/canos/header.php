<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till #masthead
 *
 * @package Canos
 */
?><!DOCTYPE html>
<?php
$canos_check_responsive = ( get_theme_mod( 'canos_opt_disable_responsive' ) ) ? 'no-responsive' : 'yes-responsive';
?>
<html <?php language_attributes(); ?> class="no-js <?php echo esc_attr( $canos_check_responsive ); ?>">
<head>
<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
<?php if ( $canos_check_responsive != 'no-responsive' ) : ?>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php if ( get_theme_mod( 'canos_opt_favicon' ) ) : ?>
<link rel="shortcut icon" href="<?php echo esc_url( get_theme_mod( 'canos_opt_favicon' ) ); ?>">
<?php endif; ?>

<script>(function(){document.documentElement.className+=' js'})();</script>

<?php wp_head(); ?>
<link href="https://fonts.googleapis.com/css?family=Kanit:600i|Roboto:100" rel="stylesheet">
</head>

<body <?php body_class(); ?>>

<?php /* Display the mobile sidebar */ ?>
<?php get_sidebar( 'mobile' ); ?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'canos' ); ?></a>

	<?php $canos_opt_check_social_header = ( get_theme_mod( 'canos_opt_social_header' ) ) ? 'has-not-social' : 'has-social'; ?>

	<header id="masthead" class="site-header <?php echo esc_attr( $canos_opt_check_social_header ); ?>" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<div class="wrap">
			
			<a href="#" id="site-navigation-toggle"><i class="fa fa-bars"></i><?php esc_html_e( 'Menu', 'canos' ); ?></a>

			<?php
			/* Show social icons if activated */
			if ( ! get_theme_mod( 'canos_opt_social_header' ) ) :
				canos_social_header();
			endif; ?>

			<div class="site-branding">
				<?php
				/* Show custom logo if available */
				if ( get_theme_mod( 'canos_opt_logo' ) ) : ?>

					<?php $canos_logo_data = get_theme_mod( 'canos_opt_logo_data' ); ?>

					<?php if ( ( is_home() ) || ( is_front_page() ) ) : ?>
					<h1 class="site-title semantic" itemprop="headline"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
					<?php else : ?>
					<h3 class="site-title semantic" itemprop="headline"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h3>
					<?php endif; ?>

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-logo"><img id="desktop-logo" src="<?php echo esc_url( get_theme_mod( 'canos_opt_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $canos_logo_data[ 'width' ] ); ?>" height="<?php echo esc_attr( $canos_logo_data[ 'height' ] ); ?>">
						<?php
						/* Check if the retina version is available */
						if ( get_theme_mod('canos_opt_logo_retina') ): ?>
							<?php $canos_logo_retina_data = get_theme_mod( 'canos_opt_logo_retina_data' ); ?>
							<img id="retina-logo" src="<?php echo esc_url( get_theme_mod( 'canos_opt_logo_retina' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr( $canos_logo_retina_data[ 'width' ] ); ?>" height="<?php echo esc_attr( $canos_logo_retina_data[ 'height' ] ); ?>">
						<?php endif; ?>
					</a>
					
				<?php
				/* No custom logo available */
				else: ?>

					<?php if ( ( is_home() ) || ( is_front_page() ) ) : ?>
					<h1 class="site-title" itemprop="headline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
					<?php else : ?>
					<h3 class="site-title" itemprop="headline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h3>
					<?php endif; ?>

				<?php endif; ?>
			</div><!-- .site-branding -->

		</div><!-- .wrap -->
	
	</header><!-- #masthead -->
