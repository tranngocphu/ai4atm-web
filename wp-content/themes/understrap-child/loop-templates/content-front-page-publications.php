<?php
/**
 * Recent publication to be included in front page template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$args = array (
	'post_type' => 'publication',	
    'nopaging'  => false,
    'posts_per_page' => 5,
	'meta_key'	=> 'year',
	'orderby'	=> 'meta_value',
	'order'		=> 'DESC'
);

$query_pub = new WP_Query( $args );

$pubs = $query_pub->posts;

wp_reset_postdata();
?>

<div class="home-publications-wrapper">
    <div class="container">
        <div class="home-section-title">Publications</div>
        <div class="row">
            <div class="col-12 col-md-4 col-xl-3">
                <div class="sub-title text-center">Recent publications</div>
                <div class="text-center mt-3 mb-3">
                    <a class="btn btn-lg btn-outline-primary" href="/publications/" role="button">See all publications</a>
                </div>
            </div>
            <div class="col-12 col-md-8 col-xl-9 mt-2">

                <div class="pub-wrapper">

                    <?php foreach ( $pubs as $pub) : 

                        $pub_link = get_post_permalink( $pub->ID );
                        $edit_link = get_edit_post_link( $pub->ID );
                        $access_mode = $pub->full_text;		
                        $pdf_link = wp_get_attachment_url( $pub->pdf_article );		

                        $author_ids = $pub->authors;		
                        $authors = [];
                        $authors_str = [];

                        if (  $author_ids ) {
                            
                            foreach ( $author_ids as $id ) {		
                                $author_query = new WP_User_Query( array( 'include' => array( (int)$id ) ) );
                                array_push( $authors, $author_query->get_results()[0] );			
                            }
                            
                            $count = sizeof( $authors );			
                            $x = 0;

                            foreach ( $authors as $author ) {			
                            
                                $separator = ( $x < $count -1 ) ? ', ' : '';
                                $name = $author->full_name;
                                $link = get_author_posts_url( $author->ID );
                    
                                if ( $author->roles[0] === 'external_author' ) {										
                                    $authors_str[] = '<span class="pub-each-author">' . $name . $separator . '</span>';				
                                } else {	
                                    $authors_str[] = '<span class="pub-each-author"><a href="' . $link .'">' . $name . '</a>' . $separator . '</span>';	
                                }
                            
                                $x += 1;
                            };
                        }
                        ?>

                        <div class="row pub-item">				
                            <!-- Year, Title, Authors, Publisher -->
                            <div class="col-12 pub-title-author-publisher">
                                <div>
                                    <span class="pub-year"><?= substr($pub->year, 0, 4) ?> - </span>
                                    <span class="pub-title"><a href="<?= $pub_link ?>"><?= $pub->post_title ?></a></span>
                                </div>
                                <div class="pub-author-list">
                                    <?php if ( $authors_str ) foreach ( $authors_str as $author ) echo $author; ?>
                                </div>
                                <div class="pub-publisher"><?= $pub->publisher ?></div>
                            </div>					
                        </div>

                    <?php endforeach; ?>
                </div> <!-- end pub_wrapper -->

            </div>
        </div>
    </div>

    

</div>