<?php
/**
 * Template Name: Front Page
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<div class="container-fluid px-0">

	<?php 
	
	get_template_part( 'loop-templates/content', 'front-page-sliders' );

	// get_template_part( 'loop-templates/content', 'front-page-people' );

	// get_template_part( 'loop-templates/content', 'front-page-news' );

	// get_template_part( 'loop-templates/content', 'front-page-research' );

	// get_template_part( 'loop-templates/content', 'front-page-publications' );

	// get_template_part( 'loop-templates/content', 'front-page-join' ); 
	
	?>

</div>

<?php get_footer(); ?>
