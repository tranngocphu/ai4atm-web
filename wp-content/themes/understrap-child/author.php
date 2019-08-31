<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

if ( isset( $_GET['author_name'] ) ) {
	$curauth = get_user_by( 'slug', $author_name );
} else {
	$curauth = get_userdata( intval( $author ) );
}


?>

<div class="wrapper" id="author-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<main class="site-main" id="main">


				<div class="row">
					
					<!-- Left columns: Profile pic and full name with prefix -->
					<div class="col-4">
						<img src="<?php echo esc_url( get_avatar_url( $curauth->ID ) ); ?>" alt="profile-image" class="author-profile"/>
					</div>

					<!-- Right column: Details bio and publications -->
					<div class="col-8">
						<h3 class=""><?php  echo esc_html( $curauth->display_name ); ?></h3>
					
					
					
					</div>  
				
				</div> 

				<header class="page-header author-header" hidden>

					<h3><?php  echo esc_html__( 'About:', 'understrap' ) . ' ' . esc_html( $curauth->display_name ); ?></h3>

					<?php if ( ! empty( $curauth->ID ) ) : ?>
						<?php echo get_avatar( $curauth->ID ); ?>
					<?php endif; ?>

					<?php if ( ! empty( $curauth->user_url ) || ! empty( $curauth->user_description ) ) : ?>
						<dl>
							<?php if ( ! empty( $curauth->user_url ) ) : ?>
								<dt><?php esc_html_e( 'Website', 'understrap' ); ?></dt>
								<dd>
									<a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
								</dd>
							<?php endif; ?>

							<?php if ( ! empty( $curauth->user_description ) ) : ?>
								<dt><?php esc_html_e( 'Profile', 'understrap' ); ?></dt>
								<dd><?php esc_html_e( $curauth->user_description ); ?></dd>
							<?php endif; ?>
						</dl>
					<?php endif; ?>

				</header><!-- .page-header -->
				
				<h4 class="mt-5" hidden><?php echo esc_html( 'Publications:', 'understrap' ) ?></h4>

			</main><!-- #main -->

	</div><!-- #content -->

</div><!-- #author-wrapper -->

<?php get_footer(); ?>
