<?php
/**
 * Partial template for content in contact-fullwidth.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


$args = array (
	'post_type' => 'contact_info'	
);

$contact = new WP_Query( $args );
$contact = $contact->posts[0];


?>


<h3 class="text-center mb-5">CONTACT US</h3>

<div class="row">

	<div class="col-12 col-sm-12 col-md-12 col-lg-6 mb-3">
		<div class="col-12 contact-gg-map">
			<?= $contact->map ?>
		</div>
	</div>

	<div class="col-12 col-sm-12 col-md-12 col-lg-6">
		<h5>Contact person</h5>
		<div><?= $contact->prefix . ' ' . $contact->full_name ?></div>
		<div><a href="mailto:<?= $contact->email ?>"><?= $contact->email ?></a></div>
		
		<h5 class="mt-3">Address</h5>
		<div><?= $contact->address ?></div>
		

	</div>

</div>