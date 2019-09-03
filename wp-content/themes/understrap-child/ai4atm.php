<?php
// ALLOW EMPTY EMAIL ADDRESS FOR EXTERNAL AUTHOR

// This will suppress empty email errors when new user is External Author
add_action('user_profile_update_errors', 'external_author_error_update', 10, 3 );
function external_author_error_update( $errors, $update, $user ) {    
    if (  $user->role === 'external_author' )
        $errors->remove('empty_email');    
}

// This will suppress JS validation of email field when Role changed to External Author
add_action('user_new_form', 'external_author_form_update', 10, 1);
add_action('show_user_profile', 'external_author_form_update', 10, 1);
add_action('edit_user_profile', 'external_author_form_update', 10, 1);
function external_author_form_update( $form_type ) { ?>
    <script type="text/javascript">

        $('#ure_select_other_roles').parent().parent().hide();
        
        $('#role').change (function () {

            if ( this.value === 'external_author' ) {
            
                $('#email').closest('tr').removeClass('form-required').find('.description').html("");
                
                // Uncheck send new user email option by default
                <?php if (isset($form_type) && $form_type === 'add-new-user') : ?>
                    jQuery('#send_user_notification').removeAttr('checked');
                <?php endif; ?>

                $("#acf-field_5d624cd491a80 option[value='External Author']").attr("selected", "selected").change();
                $("#acf-field_5d624cd491a80").prop('disabled', true);
            
            } else {

                $('#email').closest('tr').addClass('form-required').find('.description').html("(required)");
                $("#acf-field_5d624cd491a80 option[value='']").attr("selected", "selected").change();
                $("#acf-field_5d624cd491a80").prop('disabled', false);

            } 
        })

    </script>
    <?php
}


add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary' )
        return $items . 
            "<li class='menu-header-search'>
                <a href='/search/'><i class='fa fa-search d-none d-sm-none d-md-none d-lg-inline d-xl-inline ml-lg-2 ml-xl-2 search-icon' aria-hidden='true'></i></a>
            </li>"; 
    return $items;
}


/**
 * 
 * Remove Wordpress logo from login page
 * 
 */
function my_custom_login_logo() {
    echo '<style type="text/css">
    h1 a {background-image:none !important; margin:0 auto; height: 0px !important;}
    </style>';
}
add_filter( 'login_head', 'my_custom_login_logo' );


/**
 * 
 * Add theme options menu to admin panel at top level
 * 
 */

//
// Add top-level "AI4ATM Theme Options" Menu 
//
add_action( 'admin_menu', 'ai4atm_theme_menu' );

function ai4atm_theme_menu() {
    add_utility_page( 'AI4ATM Theme Options', 'AI4ATM<br>Theme Options', 'manage_options', 'ai4atm-theme', 'ai4atm_theme_options', '');
    add_submenu_page( 'ai4atm-theme', 'Home Sections Reorder', 'Home Sections Reorder', 'manage_options', 'section-reorder', 'ai4atm_theme_section_reorder' );
    add_submenu_page( 'ai4atm-theme', 'Home Slider Setting', 'Home Slider', 'manage_options', 'home-slider', 'ai4atm_theme_slider_options' );    
    remove_submenu_page('ai4atm-theme','ai4atm-theme');
    add_action( 'admin_init', 'register_ai4atm_theme_settings' );
}

function register_ai4atm_theme_settings() {
    // Home sections reorder

    // Home slider
    register_setting( 'slider_options_group', 'img_1' );
    register_setting( 'slider_options_group', 'img_2' );
    register_setting( 'slider_options_group', 'img_3' );
    register_setting( 'slider_options_group', 'img_4' );
    register_setting( 'slider_options_group', 'img_5' );

}

function ai4atm_theme_options() {
	if ( ! current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
}


function ai4atm_theme_section_reorder() {
    ?>
    <div class="wrap">
        <h1>Home Sections Reorder</h1>
    </div>
    <?php
}

function ai4atm_theme_slider_options() {
    ?>
    <div class="wrap">
        <h1>Home Slider Setting</h1>

        <!-- Google and See : File Upload using WordPress Settings API -->

        <form method="post" action="options.php">
            <?php settings_fields( 'slider_options_group' ); ?>
            <?php do_settings_sections( 'home-slider' ); ?>
            <table class="form-table">
                <tr valign="top">
                <th scope="row">IMG 1</th>
                <td><input type="file" name="img_1" value="<?php echo esc_attr( get_option('img_1') ); ?>" /></td>
                </tr>
                
                <tr valign="top">
                <th scope="row">IMG 2</th>
                <td><input type="text" name="img_2" value="<?php echo esc_attr( get_option('img_2') ); ?>" /></td>
                </tr>
                
                <tr valign="top">
                <th scope="row">IMG 3</th>
                <td><input type="text" name="img_3" value="<?php echo esc_attr( get_option('img_3') ); ?>" /></td>
                </tr>

                <tr valign="top">
                <th scope="row">IMG 4</th>
                <td><input type="text" name="img_4" value="<?php echo esc_attr( get_option('img_4') ); ?>" /></td>
                </tr>
                
                <tr valign="top">
                <th scope="row">IMG 5</th>
                <td><input type="text" name="img_5" value="<?php echo esc_attr( get_option('img_5') ); ?>" /></td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>     
    <?php

    echo "Hello<br>";
    var_dump(get_option("img_1"));
}