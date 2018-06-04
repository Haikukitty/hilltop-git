<?php

//* Create Portfolio Type custom taxonomy
add_action( 'init', 'divi_type_taxonomy' );
function divi_type_taxonomy() {

	register_taxonomy( 'portfolio-type', 'portfolio',
		array(
			'labels' => array(
				'name'          => _x( 'Types', 'taxonomy general name', 'divi' ),
				'add_new_item'  => __( 'Add New Portfolio Type', 'divi' ),
				'new_item_name' => __( 'New Portfolio Type', 'divi' ),
			),
			'exclude_from_search' => true,
			'has_archive'         => true,
			'hierarchical'        => true,
			'rewrite'             => array( 'slug' => 'portfolio-type', 'with_front' => false ),
			'show_ui'             => true,
			'show_tagcloud'       => false,
		)
	);

}


//* Create portfolio custom post type
add_action( 'init', 'divi_portfolio_post_type' );
function divi_portfolio_post_type() {

	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name'          => __( 'Portfolio', 'divi' ),
				'singular_name' => __( 'Portfolio', 'divi' ),
			),
			'has_archive'  => true,
			'hierarchical' => true,
			'menu_icon'    => 'dashicons-portfolio',
			'public'       => true,
			'rewrite'      => array( 'slug' => 'portfolio', 'with_front' => false ),
			'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),
			'taxonomies'   => array( 'portfolio-type' ),

		)
	);
	
}

//* Change the number of portfolio items to be displayed (props Brad Dalton)
add_action( 'pre_get_posts', 'divi_portfolio_items' );
function divi_portfolio_items( $query ) {

	if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'portfolio' ) ) {
		$query->set( 'posts_per_page', '12' );
	}
	
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


