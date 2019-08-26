<?php
/**
 * Partial template for content in publication-.php in page-templates directory
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$args = array (
	'post_type' => 'publication',	
	'nopaging'  => true,
	'meta_key'	=> 'year',
	'orderby'	=> 'meta_value',
	'order'		=> 'DESC'
);

$query_pub = new WP_Query( $args );
$pubs = $query_pub->posts;
wp_reset_postdata();

?>

<header class="entry-header">
	<h1 class="text-center">Publications</h1>
	<div class="text-center mb-5"><< Only authors from our team are shown >></div>
</header><!-- .entry-header -->

<div class="pub-wrapper">
	<?php foreach ( $pubs as $pub) : 
		$author_ids = $pub->authors;		
		$authors = [];	

		foreach ( $author_ids as $id ) {		
			$author_query = new WP_User_Query( array( 'include' => array( (int)$id ) ) );
			array_push( $authors, $author_query->get_results()[0] );			
		}
		
		$count = sizeof($authors);		
		$x = 0;

		foreach ($authors as $author) {
			if ( $x < $count -1 ) {
				$separator = " &#183; ";		
			} else {
				$separator = "";		
			}
		
			$authors[] = (object)array(		
				"name" => $author->display_name,
				"link" => "/author/" . $author->user_login,
				"separator" => $separator		
			);		
			$x += 1;
		};	
		?>

		<div class="row pub-item"> 
			
			<!-- Year : -->
			<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 col-xl-1">
				<div class="pub-year"><?= $pub->year ?></div>
			</div>
			
			<!-- Title, Author, Publisher : -->
			<div class="col-xs-9 col-sm-9 col-md-10 col-lg-10 col-xl-11">
				<a href="<?= $pub->link ?>" target="_blank"><span class="pub-title"><?= $pub->article_title ?></span></a>
				<div class="pub-author-list">
					<?php foreach ( $authors as $author ) : ?>
						<span class="pub-each-author"><a href="<?= $author->link ?>"><?= $author->name ?></a><?= $author->separator ?></span>
					<?php endforeach; ?>
				</div>
				<p class="pub-publisher"><?= $pub->publisher ?></p>
			</div>

		</div>

	<?php endforeach; ?>

</div> <!-- end pub_wrapper -->