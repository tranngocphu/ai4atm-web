<?php
/**
 * Partial template for content in people-fullwidth.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$user_query = new WP_User_Query( array( 'role__in' => array('Administrator','Editor','Author')));

$positions = array(
	'dt' => 'Director',
	'pi' => 'Principle Investigator',
	'pd' => 'Program Director',
	'pm' => 'Project Manager',
	'tl' => 'Team Leader',
	'rf' => 'Research Fellow',
	'ra' => 'Research Associate',
	'po' => 'Project Officer',
	'vs' => 'Visiting Scholar',
	'ps' => 'PhD Student',
	'ms' => 'Master Student',
	'fs' => 'FYP Student',
	'al' => 'Alumni'
);

?>

<header class="entry-header">

	<h1 class="text-center mb-5">Meet The Team</h1>

</header><!-- .entry-header -->

<div class="row">

<?php if ( ! empty( $user_query->get_results() ) ) : ?>

	<?php foreach ( $user_query->get_results() as $user ) : 
	if ( ! $user->active ) continue ?>

	<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
				
		<div class="card profile-card">
			<div class="card-body pt-5">
				<a href="<?php echo '/author/' . $user->user_login ?>"><img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="profile-image" class="profile"/></a>
				<h5 class="card-title text-center mt-4"><?= $user->display_name ?></h5>
				<p class="staff-position text-center mt-4"><?= $positions[$user->position] ?></p>
				<p class="card-text text-center"></p>
			</div>
		</div>
	
	</div>

	<?php endforeach; ?>	

<?php else : ?>

	<div>No author found.</div>	

<?php endif; ?>

</div> <!-- row end -->