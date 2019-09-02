<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$pub = get_post();
$author_ids = $pub->authors;
$authors = [];

if ( $author_ids ) {
	foreach ( $author_ids as $id ) {		
		$author_query = new WP_User_Query( array( 'include' => array( (int)$id ) ) );
		array_push( $authors, $author_query->get_results()[0] );			
	}
}

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
		<div class="pub-publisher"><?= $pub->publisher ?></div>

	</header><!-- .entry-header -->

	
	<div class="row mt-4">

		<div class="col-12 col-sm-12 col-md-12 col-lg-4">			
			
			<div class="row">
			<?php if ( $author_ids ) foreach ( $authors as $author ) : ?>
				<div class="col-4 col-sm-3 col-md-3 col-lg-4">
					<div class="single-pub-author-item">			
						<div class="text-center">
							<a href="<?=  get_author_posts_url( $author->ID ) ?>">
								<img src="<?= esc_url( get_avatar_url( $author->ID ) ); ?>" alt="profile-image" class="single-pub-profile"/>
							</a>
						</div>
						<div class="text-center"><?= $author->full_name ?></div>					
					</div>				
				</div>			
			<?php endforeach; ?> 
			</div>			
			
		</div>

		<div class="col-12 col-sm-12 col-md-12 col-lg-8">
			<?php if (  $pub->abstract ) : ?>			
			<p><span class="font-weight-bold">Abstract: </span><?= $pub->abstract ?></p>
			<?php endif; ?>

			<?php if ( $pub->pdf_article ) : ?>
			<p><i class="fa fa-download pub-download-icon" aria-hidden="true"></i><a class="ml-2" href="<?= wp_get_attachment_url( $pub->pdf_article ) ?>" target="_blank">Download PDF </a><span class="pub-access-mode">(<?= $pub->full_text ?>)</span></p>
			<?php endif; ?>

			<?php if ( $pub->link ) : ?>
			<p><span style="font-weight: bold">Full text:</span><br />
			<a class="" href="<?= $pub->link ?>" target="_blank"><?= $pub->link ?></a>
			</p>
			<?php endif; ?>
		</div>

	</div>

	<footer class="entry-footer mt-5">

		<?php  understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
