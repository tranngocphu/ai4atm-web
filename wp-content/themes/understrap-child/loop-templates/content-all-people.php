<?php
/**
 * Partial template for content in people-fullwidth.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$group = array(
	"all" => "All",
	"advisors" => 0,
	"researchers" => 1,
	"students" => 2,
	"visitingscholars" => 3,
	"alumni" => 4
)
?>

<script type="text/javascript">

function select ( id ) {
	jQuery('.btn-staff').removeClass('btn-secondary btn-selected');
	jQuery('.btn-staff').addClass('btn-outline-secondary btn-unselected');
	jQuery('#'+id).addClass('btn-secondary btn-selected');
}

</script>

<header class="entry-header">

	<h1 class="text-center mb-5">The AI Team</h1>

</header><!-- .entry-header -->

<div class="row">


	<!-- Staff categories -->
	<div class="col-sm-12 col-md-4 col-lg-3 mb-5">

		<div class="row">
		<div class="col-6 col-sm-6 col-md-12 mb-2">
			<button id="all"         type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);">All</button>
			<button id="advisors"    type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);">Advisors</button>
			<button id="researchers" type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);">Researchers</button>
		</div>
		<div class="col-6 col-sm-6 col-md-12">
			<button id="students"         type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);">PhD Students</button>
			<button id="visitingscholars" type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);">Visiting Scholars</button>
			<button id="alumni"           type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);">Alumni</button>
		</div>
		</div>

	</div>

	<form method="get" id="people-form">	
		<input type="text" id="staff_group" name="show" value="" hidden>
	</form>	

<?php 
	
	if (  isset($_GET['show']) && $_GET['show'] != 'all' ) {

		$id = $_GET['show'];

		$user_query = new WP_User_Query( array(
			'meta_key' => 'date_joined',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'meta_query' => array( 
				array(
					'key' => 'group',
					'value' => $group[$id]
				)
			)
		));

		?>

		<script type="text/javascript">
			var id = "<?php echo $id ?>";
			select( id );	
			console.log(id);	
		</script>		

		<?php
	
	} else {

		$user_query = new WP_User_Query( array( 
			'role__in' => array('Administrator','Editor','Author'),
			'meta_query' => array(
				'relation' => 'AND',
				'group_sort' => array(
					'key' => 'group'
				),
				'date_sort' => array(
					'key' => 'date_joined'
				)
			),
			'orderby' => array( 
				'group_sort' => 'ASC',
				'date_sort' => 'ASC',
			),
		));

		?>

		<script type="text/javascript">
			select( "all" );
		</script>

		<?php	

	} 	

	$results = $user_query->get_results();

?>

	<!-- Staffs listing -->
	<div class="col-sm-12 col-md-8 col-lg-9">
		<div class="row">	

			<?php if ( ! empty( $results ) ) : ?>

				<?php foreach ( $results as $user ) : 
				if ( ! $user->active ) continue ?>

				<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">	
					<div class="card profile-card">
						<!-- <div class="card-img-block">			
						</div>	 -->
						<div class="card-body pt-5">
							<a href="<?= get_author_posts_url( $user->ID ) ?>"><img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="profile-image" class="profile"/></a>
							<div class="staff-name text-center mt-4"><?= $user->full_name ?></div>
							<div class="staff-position text-center mt-2"><?= $user->position ?></div>
						</div>
					</div>
				</div>

				<?php endforeach; ?>	

			<?php else : ?>
			
				<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 text-center">	
					No author found.
				</div>

			<?php endif; ?>	

			<?php if ( $id !== "advisors" && $id !== "alumni" ) : ?>

			<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">	
				<div class="card profile-card">
					<div class="card-body pt-5">
						<a href="join-us"> <img src="/ai4atm/empty-avatar-150x150.jpg" alt="profile-image" class="profile"/></a>
						<div class="staff-name text-center mt-4">Wanna join us?</div>
						<a href="/join-us/"><div class="staff-position text-center mt-2">Explore the opportunities...</div></a>
					</div>
				</div>
			</div>

			<?php endif; ?>
		
		</div>

	</div>

</div> <!-- row end -->


<script type="text/javascript">

	function show_staff( id ) {		
		jQuery('#staff_group').val(id);		
		jQuery('#people-form').submit();
	}

</script>