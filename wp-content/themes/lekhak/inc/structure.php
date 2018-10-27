<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

$options = lekhak_get_theme_options();


if ( ! function_exists( 'lekhak_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since Lekhak 1.0.0
	 */
	function lekhak_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;

add_action( 'lekhak_doctype', 'lekhak_doctype', 10 );


if ( ! function_exists( 'lekhak_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif;
	}
endif;
add_action( 'lekhak_before_wp_head', 'lekhak_head', 10 );

if ( ! function_exists( 'lekhak_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lekhak' ); ?></a>

		<?php
	}
endif;
add_action( 'lekhak_page_start_action', 'lekhak_page_start', 10 );

if ( ! function_exists( 'lekhak_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'lekhak_page_end_action', 'lekhak_page_end', 10 );

if ( ! function_exists( 'lekhak_header_start' ) ) :
	/**
	 * Header start html codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_header_start() {
		$options = lekhak_get_theme_options();
		?>
		<header id="masthead" class="site-header" role="banner">
			<div class="wrapper">
				<a id="sidr-left-top-button" class="menu-button right menu-toggle" href="#sidr-left-top">
					<?php if ( ! empty( $options['primary_menu_label'] ) ) : ?>
						<span class="primary-menu-label"><?php echo esc_html( $options['primary_menu_label'] ); ?></span>
					<?php endif; ?>
					<?php  
						echo lekhak_get_svg( array( 'icon' => 'menu' ) );
						echo lekhak_get_svg( array( 'icon' => 'close' ) );
					?>
                </a><!-- .sidr-left-top-button -->
		<?php
	}
endif;
add_action( 'lekhak_header_action', 'lekhak_header_start', 10 );

if ( ! function_exists( 'lekhak_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_site_branding() {
		$options  = lekhak_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];		
		?>
		<div class="site-branding">
			<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) )  ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div>
			<?php } 
			if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
				<div id="site-identity">
					<?php
					if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) { ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php } 
					
					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
						endif; 
					}?>
				</div>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<?php
	}
endif;
add_action( 'lekhak_header_action', 'lekhak_site_branding', 20 );

if ( ! function_exists( 'lekhak_site_navigation' ) ) :
	/**
	 * Site navigation codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_site_navigation() {
		$options = lekhak_get_theme_options();
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
			<?php  
				$search = '';
				if ( $options['nav_search_enable'] ) :
					$search = '<li class="search-menu"><a class="search" href="#.">';
					$search .= lekhak_get_svg( array( 'icon' => 'search' ) );
					$search .= lekhak_get_svg( array( 'icon' => 'close' ) );
					$search .= '</a><div id="search">';
					$search .= get_search_form( $echo = false );
	                $search .= '</div><!-- #search --></li>';
                endif;

        		$defaults = array(
        			'theme_location' => 'primary',
        			'container' => false,
        			'menu_class' => 'menu nav-menu',
        			'menu_id' => 'primary-menu',
        			'echo' => true,
        			'fallback_cb' => 'lekhak_menu_fallback_cb',
        			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $search . '</ul>',
        		);
        	
        		wp_nav_menu( $defaults );
        	?>
		</nav><!-- #site-navigation -->
		<?php
	}
endif;
add_action( 'lekhak_header_action', 'lekhak_site_navigation', 30 );


if ( ! function_exists( 'lekhak_header_end' ) ) :
	/**
	 * Header end html codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_header_end() {
		?>
			</div><!-- .wrapper -->
		</header><!-- #masthead -->
		<?php
	}
endif;
add_action( 'lekhak_header_action', 'lekhak_header_end', 40 );

if ( ! function_exists( 'lekhak_primary_mobile_menu' ) ) :
	/**
	 * mobile menu html codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_primary_mobile_menu() {
		$options = lekhak_get_theme_options();
		?>
		<div id="sidr-left-top" class="mobile-menu sidr left">
			<?php  
				$search = '';
				if ( $options['nav_search_enable'] ) :
					$search = '<li class="search-menu"><a class="search" href="#.">';
					$search .= lekhak_get_svg( array( 'icon' => 'search' ) );
					$search .= lekhak_get_svg( array( 'icon' => 'close' ) );
					$search .= '</a><div id="search">';
					$search .= get_search_form( $echo = false );
	                $search .= '</div><!-- #search --></li>';
                endif;

        		$defaults = array(
        			'theme_location' => 'primary',
        			'container' => false,
        			'menu_class' => 'menu nav-menu',
        			'menu_id' => 'primary-menu',
        			'echo' => true,
        			'fallback_cb' => 'lekhak_menu_fallback_cb',
        			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $search . '</ul>',
        		);
        	
        		wp_nav_menu( $defaults );
        	?>
		</div><!-- #sidr-left-top -->
	<?php
	}
endif;
add_action( 'lekhak_header_action', 'lekhak_primary_mobile_menu', 50 );

if ( ! function_exists( 'lekhak_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'lekhak_primary_content', 'lekhak_content_start', 16 );
add_action( 'lekhak_inner_page_secondary_menu', 'lekhak_content_start', 20 );

if ( ! function_exists( 'lekhak_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since Lekhak 1.0.0
	 */
	function lekhak_add_breadcrumb() {
		$options = lekhak_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( lekhak_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * lekhak_simple_breadcrumb hook
				 *
				 * @hooked lekhak_simple_breadcrumb -  10
				 *
				 */
				do_action( 'lekhak_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
		return;
	}
endif;
add_action( 'lekhak_breadcrumb_action', 'lekhak_add_breadcrumb', 20 );

if ( ! function_exists( 'lekhak_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_content_end() {
		?>
			<div class="menu-overlay"></div>
		</div><!-- #content -->
		<?php
	}
endif;
add_action( 'lekhak_content_end_action', 'lekhak_content_end', 10 );

if ( ! function_exists( 'lekhak_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'lekhak_footer', 'lekhak_footer_start', 10 );

if ( ! function_exists( 'lekhak_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_footer_site_info() {
		$theme_data = wp_get_theme();
		$options = lekhak_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );

		$copyright_text = $options['copyright_text']; 
		$powered_by_text = esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'lekhak' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>';
		?>
		<div class="site-info col-2">
                <div class="wrapper">
                	<div class="footer-copyright">
	                    <span><?php echo lekhak_santize_allow_tag( $copyright_text ); ?></span>
	                    <span>
	                    	<?php 
	                    	echo lekhak_santize_allow_tag( $powered_by_text ); 
	                    	if ( function_exists( 'the_privacy_policy_link' ) ) {
							    the_privacy_policy_link( ' | ' );
							} 
	                    	?>
	                    </span>
                    </div>
                </div><!-- .wrapper -->    
            </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'lekhak_footer', 'lekhak_footer_site_info', 40 );

if ( ! function_exists( 'lekhak_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_footer_scroll_to_top() {
		$options  = lekhak_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo lekhak_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'lekhak_footer', 'lekhak_footer_scroll_to_top', 40 );

if ( ! function_exists( 'lekhak_footer_end' ) ) :
	/**
	 * Footer starts
	 *
	 * @since Lekhak 1.0.0
	 *
	 */
	function lekhak_footer_end() {
		?>
		</footer>
		<div class="popup-overlay"></div>
		<?php
	}
endif;
add_action( 'lekhak_footer', 'lekhak_footer_end', 100 );
