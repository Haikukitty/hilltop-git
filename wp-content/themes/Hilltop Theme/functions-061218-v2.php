<?php

// Changing excerpt more
   function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More' . '</a>';
   }
   add_filter('excerpt_more', 'new_excerpt_more');

//* Change the number of portfolio items to be displayed (props Brad Dalton)
add_action( 'pre_get_posts', 'divi_custom_posts' );
function divi_custom_posts( $query ) {

	if( $query->is_main_query() && is_post_type_archive( 'news-bulletins' ) ) {
		$query->set( 'posts_per_page', '20' );
	}
	
	if( $query->is_main_query() && is_post_type_archive( 'publication' ) ) {
		$query->set( 'posts_per_page', '20' );
	}

}

register_sidebar( array(
		'name'          => __( 'Footer Bottom Area', 'hilltop' ),
		'id'            => 'bottomfooter',
		'description'   => __( 'Add widgets here to appear in the very bottom area of the footer below the columns.', 'hilltop' ),
		'before_widget' => '', 
	'after_widget' => '', 
	'before_title' => '<h2 class="widget-title">', 
	'after_title' => '</h2>' ) );

//add_filter("gform_pre_render", "populate_email");

//function populate_email($form){

   // global $post;

      //  if($form["id"] != 1) // Change [2] to the ID of the form you want to use

        //   return $form;

	    //    $email = get_post_meta($post_id, 'wpcf_staff-email', true);


      //  $form["fields"][0]["defaultValue"] = $email ; //Change [3] to the nth (-1) field you want to populate.

     //   return $form;

 

//}

// add_filter( 'gform_pre_render', 'staff_email' );
// function staff_email( $value ) {
  //   global $post;
 
  //   $staffemail = get_post_meta($post_id, 'wpcf_staff-email', true);
 
   //  return $staffemail;
// }


//function my_acf_upload_prefilter( $errors, $file, $field ) {
    
    // only allow admin
  //  if( !current_user_can('manage_options') ) {
        
        // this returns value to the wp uploader UI
        // if you remove the ! you can see the returned values
    //    $errors[] = 'test prefilter';
   //     $errors[] = print_r($_FILES,true);
    //    $errors[] = $_FILES['async-upload']['name'] ;
        
   // }
    //this filter changes directory just for item being uploaded
  //  add_filter('upload_dir', 'publications');
    
    // return
  //  return $errors;
    
//}
//add_filter('acf/upload_prefilter', 'my_acf_upload_prefilter');

//function my_upload_directory( $param ){
  //  $mydir = '/publications';

  //  $param['path'] = $param['basedir'] . $mydir;
  //  $param['url'] = $param['baseurl'] . $mydir;

	// if you need a different location you can try one of these values
/*	
    error_log("path={$param['path']}");  
    error_log("url={$param['url']}");
    error_log("subdir={$param['subdir']}");
    error_log("basedir={$param['basedir']}");
    error_log("baseurl={$param['baseurl']}");
    error_log("error={$param['error']}"); 
*/

  //  return $param;
//}


function acc_enqueue_stuff() {
  if ( is_page_template( 'page-our-team.php' ) ) {
	  
	  wp_register_script('accordion_script', get_stylesheet_directory_uri() . '/assets/js/jquery.lilo.accordion.min.js', array('jquery'),'1.0', true);
	  
	    wp_register_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/js/jqueryacc.js', array('jquery'),'1.0', true);
       
        wp_enqueue_script('accordion_script');
	      wp_enqueue_style( 'accordion', get_stylesheet_directory_uri() . '/assets/css/lilo-accordion.css' ); 
	  
	

    /** Call landing-page-template-one enqueue */
  } else if ( is_page_template( 'archive-news-bulletins.php' ) ) {
    /** Call regular enqueue */
	  
	   wp_register_script('accordion_script', get_stylesheet_directory_uri() . '/assets/js/jquery.lilo.accordion.min.js', array('jquery'),'1.0', true);
       
	    wp_register_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/js/jqueryacc.js', array('jquery'),'1.0', true);
	  
        wp_enqueue_script('accordion_script');
	      wp_enqueue_style( 'accordion', get_stylesheet_directory_uri() . '/assets/css/lilo-accordion.css' ); 
  }
	else {
		
		wp_register_script('accordion_script', get_stylesheet_directory_uri() . '/assets/js/jquery.lilo.accordion.min.js', array('jquery'),'1.0', true);
		
	    wp_register_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/js/jqueryacc.js', array('jquery'),'1.0', true);
       
        wp_enqueue_script('accordion_script');
	      wp_enqueue_style( 'accordion', get_stylesheet_directory_uri() . '/assets/css/lilo-accordion.css' ); 
		
		wp_register_script('accordion_script', get_stylesheet_directory_uri() . '/assets/js/jquery.matchHeight.js', array('jquery'),'1.0', true);

	}
}
add_action( 'wp_enqueue_scripts', 'acc_enqueue_stuff' );

add_filter('acf/upload_prefilter', function($errors) {
    add_filter('upload_dir', function($uploads) {
        $dir = '/publications';
        $uploads['url'] = $uploads['baseurl'] . $dir;
        $uploads['path'] = $uploads['basedir'] . $dir;
        return $uploads;
    });
    return $errors;
});

add_image_size( 'team-size', 300, 300, array( 'center', 'top' ) ); // 300 pixels wide by 300 pixels tall, crop from the top


//function wp_pubs_pre_get_posts( $query ) {


//if ( is_admin() || ! $query->is_main_query() ) return;

//if ( in_array ( $query->get('post_type'), array('publication') ) ) {
   //     $query->set( 'posts_per_page', 5 ); 

 //   return;
//} }
	
//	add_action( 'pre_get_posts', 'wp_pubs_pre_get_posts' );

function news_query( $query ){
    if( ! is_admin()
        && $query->is_post_type_archive( 'news-bulletins' )
        && $query->is_main_query() ){
            $query->set( 'posts_per_page', 20 );
    }
}
add_action( 'pre_get_posts', 'news_query' );

function pubs_query( $query ){
    if( ! is_admin()
        && $query->is_post_type_archive( 'publication' )
        && $query->is_main_query() ){
            $query->set( 'posts_per_page', 10 );
    }
}
add_action( 'pre_get_posts', 'pubs_query' );


function wdw_query_orderby_postmeta_date( $orderby ){
    $new_orderby = str_replace( "wp_postmeta.meta_value", "STR_TO_DATE(wp_postmeta.meta_value, '%d-%m-%Y')", $orderby );
    return $new_orderby;
}

/*
 * Add columns to staff post list
 */
  function add_acf_columns ( $columns ) {
   return array_merge ( $columns, array ( 
     'staff_display_order_within_department' => __ ( 'Display Order' )
   ) );
 }
 add_filter ( 'manage_people_posts_columns', 'add_acf_columns' );

/*
 * Add columns to staff post list
 */
 function people_custom_column ( $column, $post_id ) {
   switch ( $column ) {
     case 'staff_display_order_within_department':
       echo get_post_meta ( $post_id, 'staff_display_order_within_department', true );
       break;
     
   }
 }
 add_action ( 'manage_people_posts_custom_column', 'people_custom_column', 10, 2 );


