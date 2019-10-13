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


$sections = array(
	'sliders',
	'news',
	// 'research',
	'publications',
	'people',
	'join',
	// 'contact'
);

$odd_class = 'odd-section';
$even_class = 'even-section';

?>

<div class="container-fluid px-0">

	<?php 

		for ( $x=0; $x<sizeof($sections); $x++ ) {		
			$class = ( $x % 2 === 0 ) ? $even_class : $odd_class;
			$template = 'front-page-' . $sections[$x];
		?>

			<div class="section-containter <?= $class ?>">

			<?php get_template_part( 'loop-templates/content', $template ); ?>

			</div>

		<?php
	}
	
	?>

</div>

<?php get_footer(); ?>
