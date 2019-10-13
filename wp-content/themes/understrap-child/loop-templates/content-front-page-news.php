<?php
/**
 * Recent news to be included in front page template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$args = array (
    'post_type'      => 'post',
    'category_name'  => 'activity',	
    'nopaging'  => false,
    'posts_per_page' => 4,
);

$query_news = new WP_Query( $args );
$recent_news = $query_news->posts;

wp_reset_postdata();
?>

<div class="home-news-wrapper">

    <div class="container">
        <div class="home-section-title">Recent activities</div>

        <div class="row">

            <?php foreach ( $recent_news as $news ) : ?>

                <div class="col-12 col-md-6 col-lg-6 col-xl-3">

                    <div class="card ml-1 mr-1 mb-4">
                        <img class="card-img-top" src="<?= get_the_post_thumbnail_url($news->ID) ?>" alt="Card image cap">
                        <div class="card-body">
                            <a href="<?= get_permalink($news->ID) ?>"><h5 class="card-title"><?= get_the_title($news->ID) ?></h5></a>
                            <div class="entry-date"><?= get_the_date('j F Y', $news->ID) ?></div>
                        </div>
                    </div>
                
                </div>

            <?php endforeach; ?>

            <div class="col-12">
                <div class="text-center mt-3">
                    <a class="btn btn-lg btn-outline-primary" href="/category/activity/" role="button">See all activities</a>
                </div>
            </div>

        </div>
    
    </div>

</div>