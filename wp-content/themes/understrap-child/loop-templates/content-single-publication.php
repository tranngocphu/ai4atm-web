<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$author_ids = get_post()->authors;		
$authors = [];
$authors_str = [];

foreach ( $author_ids as $id ) {		
	$author_query = new WP_User_Query( array( 'include' => array( (int)$id ) ) );
	array_push( $authors, $author_query->get_results()[0] );			
}

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	
	<div class="row mt-4">

		<div class="col-12 col-sm-12 col-md-12 col-lg-4">			
			
			<div class="row">
			<?php foreach ( $authors as $author ) : ?>
				<div class="col-6 col-sm-4 col-md-4 col-lg-6">
					<div class="single-pub-author-item">			
						<div class="text-center">
							<a href="<?php echo '/author/' . $author->user_login ?>">
								<img src="<?php echo esc_url( get_avatar_url( $author->ID ) ); ?>" alt="profile-image" class="single-pub-profile"/>
							</a>
						</div>
						<div class="text-center"><?= $author->full_name ?></div>					
					</div>				
				</div>			
			<?php endforeach; ?> 
			</div>			
			
		</div>

		<div class="col-12 col-sm-12 col-md-12 col-lg-8">
			<?php if (  get_post()->abstract ) : ?>			
			<p><span style="font-weight: bold">Abstract: </span><?= get_post()->abstract ?></p>
			<?php endif; ?>

			<?php if ( get_post()->pdf_article ) : ?>
			<p><i class="fa fa-download pub-download-icon" aria-hidden="true"></i><a class="ml-2" href="<?= wp_get_attachment_url( get_post()->pdf_article ) ?>" target="_blank">Download PDF </a><span class="pub-access-mode">(<?= get_post()->full_text ?>)</span></p>
			<?php endif; ?>

			<p><span style="font-weight: bold">Full text:</span><br />
			<a class="" href="<?= get_post()->link ?>" target="_blank"><?= get_post()->link ?></a>
			</p>
		</div>

	</div>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer mt-5">

		<?php  understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
