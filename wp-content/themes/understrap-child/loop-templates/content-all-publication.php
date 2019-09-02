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
			
			$count = sizeof( $authors );			
			$x = 0;

			foreach ( $authors as $author ) {			
			
				$separator = ( $x < $count -1 ) ? ' &#183; ' : '';
				$name = $author->full_name;
				$link = get_author_posts_url( $author->ID );
	
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
			<div class="col-12 col-sm-2 col-md-2 col-lg-1 col-xl-1">
				<div class="pub-year"><?= substr($pub->year, 0, 4) ?></div>
			</div>			
			<!-- Title, Authors, Publisher -->
			<div class="col-12 col-sm-6 col-md-7 col-lg-9 col-xl-9 pub-title-author-publisher">
				<div class="pub-title"><?= $pub->post_title ?></div>
				<div class="pub-author-list">
					<?php if ( $authors_str ) foreach ( $authors_str as $author ) echo $author; ?>
				</div>
				<div class="pub-publisher"><?= $pub->publisher ?></div>
			</div>	
			
			<!-- Abstract, Download, Edit Links -->
			<div class="col-12 col-sm-4 col-md-3 col-lg-2 col-xl-2">
				<div class="row pub-abstract-pdf">
					<!-- Abstract link -->
					<div class="col-4 col-sm-12 col-md-12 mb-1">
						<i class="fa fa-info-circle pub-abstract-icon" aria-hidden="true"></i>
						<a class="pub-abstract-link" href="<?= $pub_link ?>">Abstract</a>
					</div>	
					<!-- Download link -->							
					<?php if ( $pdf_link ) : ?>
					<div class="col-5 col-sm-12 col-md-12 mb-1">
							<i class="fa fa-download pub-download-icon" aria-hidden="true"></i>
							<a class="pub-download-link" href="<?= $pdf_link ?>" target="_blank"><?= $access_mode ?></a>
					</div>
					<?php endif; ?>								
					<!-- Edit link -->							
					<?php if ( is_user_logged_in() && is_array( $author_ids ) && in_array( get_current_user_id(), $author_ids ) ) : ?> 
					<div class="col-3 col-sm-12 col-md-12 mb-1">									
						<i class="fa fa-edit pub-edit-icon"></i>
						<a class="pub-edit-link" href="<?= $edit_link ?>" target="_blank">Edit</a>
					</div>
					<?php endif; ?>
										
				</div>
			</div>				
		</div>

	<?php endforeach; ?>

</div> <!-- end pub_wrapper -->