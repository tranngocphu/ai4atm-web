<?php
/**
 * People to be included in front page template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

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

$authors = $user_query->get_results();

?>

<div class="home-people-wrapper">
    <div class="container">

        <div class="home-section-title">People</div>

        <div class="row">
            <!-- Profile pics -->
            <div class="col-12 col-md-7">       
                <div class="row scrolling-wrapper-flexbox">
                <?php foreach ( $authors as $author ) : if ( ! $author->active ) continue ?>                
                    <div class="col-3 col-xl-2">
                        <div class="card home-people-card">                
                            <a href="<?= get_author_posts_url( $author->ID ) ?>">
                                <img src="<?php echo esc_url( get_avatar_url( $author->ID ) ); ?>" alt="profile-image" class="profile"/>
                            </a>
                        </div>
                    </div>            
                <?php endforeach; ?>            
                </div>
            </div>   
            <!-- Link to all people -->
            <div class="col-12 col-md-5 text-center">
                <p>
                    We are from <br/>						
                    <a href="https://atmri.ntu.edu.sg/Pages/Home.aspx" target="_blank">Air Traffic Management Research Institute</a> <br/>
                    <a href="https://www.ntu.edu.sg/Pages/home.aspx" target="_blank">Nanyang Technological University, Singapore</a> <br/>
                </p>     
                <a class="btn btn-lg btn-outline-primary" href="/people/" role="button">Meet the team</a>
            </div>
        </div>

   
    
    </div> 
</div>