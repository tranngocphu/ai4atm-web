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
	"advisors" => "Advisors",
	"researchers" => "Researchers",
	"students" => "PhD Students",
	"visitingscholars" => "Visiting Scholars",
	"alumni" => "Alumni"
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
			<button id="all"         type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);"><?= $group["all"] ?></button>
			<button id="advisors"    type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);"><?= $group["advisors"] ?></button>
			<button id="researchers" type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);"><?= $group["researchers"] ?></button>
		</div>
		<div class="col-6 col-sm-6 col-md-12">
			<button id="students"         type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);"><?= $group["students"] ?></button>
			<button id="visitingscholars" type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);"><?= $group["visitingscholars"] ?></button>
			<button id="alumni"           type="button" class="btn btn-outline-secondary btn-block btn-staff" onclick="show_staff(this.id);"><?= $group["alumni"] ?></button>
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
			'meta_key' => 'group',
			'meta_value' => $group[$id]
		));

		?>

		<script type="text/javascript">
			var id = "<?php echo $id ?>";
			select( id );	
			console.log(id);	
		</script>		

		<?php
	
	} else {

		$user_query = new WP_User_Query( array( 'role__in' => array('Administrator','Editor','Author')));

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

			<?php if ( ! empty( $results )  && shuffle( $results ) ) : ?>

				<?php foreach ( $results as $user ) : 
				if ( ! $user->active ) continue ?>

				<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">	
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

			<?php else : ?>
			
				<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 text-center">	
					No author found.
				</div>

			<?php endif; ?>	

			<?php if ( $id !== "advisors" && $id !== "alumni" ) : ?>

			<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4">	
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