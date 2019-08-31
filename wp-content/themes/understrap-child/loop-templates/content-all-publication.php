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
	<h1 class="text-center mb-5">Publications</h1>
</header><!-- .entry-header -->

<div class="pub-wrapper">
	<?php foreach ( $pubs as $pub) : 

		$pub_link = get_post_permalink( $pub->ID );
		$edit_link = get_edit_post_link( $pub->ID );
		$access_mode = $pub->full_text;		
		$pdf_link = wp_get_attachment_url( $pub->pdf_article );		

		$author_ids = $pub->authors;		
		$authors = [];
		$authors_str = [];

		if (  $author_ids ) {
			
			foreach ( $author_ids as $id ) {		
				$author_query = new WP_User_Query( array( 'include' => array( (int)$id ) ) );
				array_push( $authors, $author_query->get_results()[0] );			
			}
			
			$count = sizeof($authors);
			
			$x = 0;

			foreach ($authors as $author) {
			
			
				$separator = ( $x < $count -1 ) ? ' &#183; ' : '';		
				
				$name = $author->full_name;
				$link = "/author/" . $author->user_login;
	
				if ( $author->roles[0] === 'external_author' ) {
					
					$authors_str[] = '<span class="pub-each-author">' . $name . $separator . '</span>';
				
				} else {
	
					$authors_str[] = '<span class="pub-each-author"><a href="' . $link .'">' . $name . '</a>' . $separator . '</span>';
	
				}
			
				$x += 1;
			};
		}
		?>

		<div class="row pub-item"> 
			
			<!-- Year : -->
			<div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-1">
				<div class="pub-year"><?= substr($pub->year, 0, 4) ?></div>
			</div>
			
			<!-- Title, Author, Publisher : -->
			<div class="col-9 col-sm-9 col-md-10 col-lg-10 col-xl-11">
				<div class="pub-title"><?= $pub->post_title ?></div>
				
				<div class="pub-author-list">
					<?php if ( $authors_str ) foreach ( $authors_str as $author ) echo $author; ?>
				</div>
				
				<div class="pub-publisher"><?= $pub->publisher ?></div>

				<div class="pub-abstract-pdf">
					<span class="ml-3"><i class="fa fa-info-circle pub-abstract-icon" aria-hidden="true"></i><a class="pub-abstract-link" href="<?= $pub_link ?>">Abstract</a></span>
				
					<?php if ( $pdf_link ) : ?>

					<span class="ml-3"><i class="fa fa-download pub-download-icon" aria-hidden="true"></i><a class="pub-download-link" href="<?= $pdf_link ?>" target="_blank">Download PDF</a><span class="pub-access-mode">(<?= $access_mode ?>)</span></span>

					<?php endif; ?>
				
				</div>
				

				
				<!-- Show edit link to logged in user -->
				<?php if ( is_user_logged_in() ) : ?>
				
				<div class="pub-edit-link float-right"><a href="<?= $edit_link ?>" target="_blank">edit</a></div>
				
				<?php endif; ?>
			</div>

		</div>

	<?php endforeach; ?>

</div> <!-- end pub_wrapper -->