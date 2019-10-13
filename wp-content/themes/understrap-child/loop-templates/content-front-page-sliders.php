<?php
/**
 * Slider to be included in front page template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$args = array (
	'post_type' => 'slider',	
  'nopaging'  => true,
  'meta_key' => 'order',
  'orderby' => 'meta_value',
  'order' => 'ASC'
);

$sliders = new WP_Query( $args );
$sliders = $sliders->posts;
wp_reset_postdata();
?>


<div id="home-slider" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php foreach ( $sliders as $slider ) : 
        $active = ( $slider->order == 1 ) ? 'active' : '';       
    ?>      
    <li data-target="#home-slider" data-slide-to="<?= $slider->order ?>" class="<?= $active ?>"></li>
    <?php endforeach; ?>
  </ol>
  <div class="carousel-inner" role="listbox">
    <?php foreach ( $sliders as $slider ) : 
        $active = ( $slider->order == 1 ) ? 'active' : '';       
    ?>      
    <div class="carousel-item carousel-item-height <?= $active ?>" style="background-image: url('<?= wp_get_attachment_url( $slider->image ) ?>')">
      <div class="carousel-caption">
        <div class="display-4" style="color: <?= $slider->text_color ?>"><?= $slider->primary_caption ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#home-slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
  <a class="carousel-control-next" href="#home-slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
</div>