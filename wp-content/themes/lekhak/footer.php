<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage Lekhak
 * @since Lekhak 1.0.0
 */

/**
 * lekhak_footer_primary_content hook
 *
 * @hooked lekhak_add_contact_section -  10
 *
 */
do_action( 'lekhak_footer_primary_content' );

/**
 * lekhak_content_end_action hook
 *
 * @hooked lekhak_content_end -  10
 *
 */
do_action( 'lekhak_content_end_action' );

/**
 * lekhak_content_end_action hook
 *
 * @hooked lekhak_footer_start -  10
 * @hooked Lekhak_Footer_Widgets->add_footer_widgets -  20
 * @hooked lekhak_footer_site_info -  40
 * @hooked lekhak_footer_end -  100
 *
 */
do_action( 'lekhak_footer' );

/**
 * lekhak_page_end_action hook
 *
 * @hooked lekhak_page_end -  10
 *
 */
do_action( 'lekhak_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
