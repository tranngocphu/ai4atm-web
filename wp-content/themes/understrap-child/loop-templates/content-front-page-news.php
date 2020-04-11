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

                <div class="col-12 col-md-6 col-lg-6 col-xl-3 mb-3 news-item">
                    <div class="row">
                        <div class="col-5 col-sm-6 col-md-12 mb-2">
                            <img class="" src="<?= get_the_post_thumbnail_url($news->ID) ?>">
                        </div>
                        <div class="col-7 col-sm-6 col-md-12">
                            <a href="<?= get_permalink($news->ID) ?>"><span class="news-title"><?= get_the_title($news->ID) ?></span></a>
                            <div class="news-date"><?= get_the_date('j F Y', $news->ID) ?></div>
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
