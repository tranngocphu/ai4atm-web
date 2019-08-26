<?php
/**
 * Partial template for content in people-fullwidth.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$user_query = new WP_User_Query( array( 'role__in' => array('Administrator','Editor','Author')));

$results = $user_query->get_results();

?>

<header class="entry-header">

	<h1 class="text-center mb-5">Meet the team</h1>

</header><!-- .entry-header -->

<div class="row">

<?php if ( ! empty( $results )  && shuffle( $results ) ) : ?>

	<?php foreach ( $results as $user ) : 
	if ( ! $user->active ) continue ?>

	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">	
		<div class="card profile-card">
			<div class="card-img-block">			
			</div>	
			<div class="card-body pt-5">
				<a href="<?php echo '/author/' . $user->user_login ?>"><img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="profile-image" class="profile"/></a>
				<h5 class="card-title text-center mt-4"><?= $user->display_name ?></h5>
				<div class="staff-position text-center mt-2"><?= $user->position ?></div>
				<p class="card-text text-center"></p>
			</div>
		</div>
	</div>

	<?php endforeach; ?>

	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">	
		<div class="card profile-card">
			<div class="card-img-block">			
			</div>	
			<div class="card-body pt-5">
				<a href="join-us"> <img src="/wp-content/uploads/2019/08/next-staff.jpg" alt="profile-image" class="profile"/></a>
				<h5 class="card-title text-center mt-4">Wanna join us?</h5>
				<a href="/join-us/"><div class="staff-position text-center mt-2">Explore the opportunities...</div></a>
				<p class="card-text text-center"></p>
			</div>
		</div>
	</div>	

<?php else : ?>

	<div>No author found.</div>	

<?php endif; ?>

</div> <!-- row end -->