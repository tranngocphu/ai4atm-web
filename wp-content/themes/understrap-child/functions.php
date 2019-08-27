<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    wp_enqueue_style( 'understrap-child-styles', get_stylesheet_directory_uri() . '/style.css', wp_get_theme()->get('Version') );
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


// ALLOW EMPTY EMAIL ADDRESS FOR EXTERNAL AUTHOR

// This will suppress empty email errors when new user is External Author
add_action('user_profile_update_errors', 'external_author_error_update', 10, 2 );
function external_author_error_update( $errors, $user ) {    
    if (  $user->role === 'external_author' )
        $errors->remove('empty_email');    
}

// This will suppress JS validation of email field when Role changed to External Author
add_action('user_new_form', 'external_author_form_update', 10, 1);
add_action('show_user_profile', 'external_author_form_update', 10, 1);
add_action('edit_user_profile', 'external_author_form_update', 10, 1);
function external_author_form_update( $form_type ) { ?>
    <script type="text/javascript">

        $('#role').change (function () {

            if ( this.value === 'external_author' ) {
            
                $('#email').closest('tr').removeClass('form-required').find('.description').html("");
                // Uncheck send new user email option by default
                <?php if (isset($form_type) && $form_type === 'add-new-user') : ?>
                    jQuery('#send_user_notification').removeAttr('checked');
                <?php endif; ?>
            
            } else {

                $('#email').closest('tr').addClass('form-required').find('.description').html("(required)");

            } 
        })

    </script>
    <?php
}