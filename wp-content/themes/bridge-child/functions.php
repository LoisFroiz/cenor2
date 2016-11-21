<?php

// enqueue the child theme stylesheet

function child_enqueue_scripts() {
    wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
    wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_scripts', 11);


function shortcode_multiple_maps( $atts ){
 	$catPost = get_posts(get_cat_ID("portfolio_page")); //Check all portfolio_page
 	$i=0;
 	$output='[MultipleMarkerMap id="MultipleMarkerMapDemo" z="12" lat="48.220162" lon="16.287525" marker="';
   	foreach ($catPost as $post) : setup_postdata($post);
   															//Check the data from each post
       $mykey_values = get_post_custom_values( 'latitud' );
			if (sizeof($mykey_values)>0){
				foreach ( $mykey_values as $key => $value ) {
					$latitud=$value;
				}
	 		}
	 	$mykey_values = get_post_custom_values( 'longitud' );
			if (sizeof($mykey_values)>0){
				foreach ( $mykey_values as $key => $value ) {
					$longitud=$value;
				}
	 		}
	 	$output.=$latitud.','.$longitud.$post->title.',http://cenor2.artenovaclientes.es/wp-content/themes/bridge/bridge/img/pin.png | ';
	 	
	 	$i++;	 	
	endforeach;
	$output.='" w="690" h="442"]';
	return $output;
}
	
add_shortcode( 'multiple_maps', 'shortcode_multiple_maps' );