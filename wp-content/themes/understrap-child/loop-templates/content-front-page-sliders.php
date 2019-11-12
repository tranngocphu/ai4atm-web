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
    
    <style>
      <?php echo '.button-wrapper-' . $slider->order; ?> {
        margin-top: 0px;
        padding-top: 30px;
        padding-bottom: 40px;
      }

      <?php echo '.btn-custom-' . $slider->order; ?> {
        border-color:  <?= $slider->text_color ?>;
        color:  <?= $slider->text_color ?>; 
      }

      <?php echo '.btn-custom-' . $slider->order . ':active,'; ?>
      <?php echo '.btn-custom-' . $slider->order . ':hover'; ?> {
        background-color: <?= $slider->text_color ?>;
        border-color: <?= $slider->text_color ?>;
      }

      <?php echo '.carousel-caption-' . $slider->order ;?>  {
        top: calc(55vh - 80px + 2vw);
      }

      <?php echo '.primary-caption-' . $slider->order ;?> {
        color: <?= $slider->text_color ?>;
        font-size: calc(1vw + 1vh + 12px);
        margin-bottom: 0;
        padding-top: 30px;
      }

      <?php echo '.secondary-caption-' . $slider->order ;?> {
        color: <?= $slider->text_color ?>;
        font-size: calc(1vw + 1vh + 6px);
        margin-top: 0;
        margin-bottom: 0;
        padding-top: 30px;
        
      }

      <?php if ($slider->text_shading) : ?>
      <?php echo '.primary-caption-' . $slider->order . ','; ?>
      <?php echo '.secondary-caption-' . $slider->order . ','; ?>
      <?php echo '.button-wrapper-' . $slider->order; ?> {
        background-color: rgba(255, 255, 255, 0.6);
      }
      <?php endif; ?>

    </style>
    
    <div class="carousel-item carousel-item-height <?= $active ?>" style="background-image: url('<?= wp_get_attachment_url( $slider->image ) ?>')">
      <div class="carousel-caption carousel-caption-<?=  $slider->order ?>">
        <div class="display-4 primary-caption-<?= $slider->order ?>">
          <?= $slider->primary_caption ?>
        </div>  

        <div class="display-4 secondary-caption-<?= $slider->order ?>">
          <?= $slider->secondary_caption ?>
        </div> 
        
        <?php if ($slider->button) : 
          $new_tab = ($slider->new_tab == true) ? 'target="_blank"' : '';        
        ?>
        <div class="button-wrapper-<?= $slider->order ?>">
          <a class="btn btn-lg btn-outline-secondary btn-custom-<?= $slider->order ?>" href="<?= $slider->button_link ?>"  <?= $new_tab ?> role="button"><?= $slider->button_label ?> </a>
        </div>
        <?php endif; ?>
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