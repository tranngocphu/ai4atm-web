<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<p>
							Copyright &#9400; AI Team <?= date("Y") ?><br />
							<a href="https://atmri.ntu.edu.sg/Pages/Home.aspx" target="_blank">Air Traffic Management Research Institute</a> - <a href="https://www.ntu.edu.sg/Pages/home.aspx" target="_blank">Nanyang Technological University, Singapore</a><br />
							Webmaster: <a href="mailto:ai4atm@gmail.com">ai4atm@gmail.com</a>
						</p>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

