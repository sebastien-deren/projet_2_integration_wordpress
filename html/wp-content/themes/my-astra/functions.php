<?php
/**
 * my astra Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package my astra
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_MY_ASTRA_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'my-astra-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_MY_ASTRA_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


add_filter( 'get_the_excerpt', function ( $excerpt, $post ) {
	if ( ! empty( $excerpt ) ) {
		return $excerpt;
	}

  	// On a specific post type, use an ACF field value as the excerpt.
	if ( $post->post_type === 'chalet' ) {
		$excerpt = get_field( 'taille', $post->ID )." " .get_field('description',$post->ID) ;
	}

	return $excerpt;
}, 10, 2 );
function myshortcode_title( ){
    return get_the_title();
 }
 add_shortcode( 'page_title', 'myshortcode_title' );

 function myshortcode_img(){
    return wp_get_attachment_image(get_field('_thumbnail_id'),"full");
 }
 add_shortcode('img_chalet','myshortcode_img');

 function get_id(){
    return get_the_ID();
 }
add_shortcode('ID','get_id');
 
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}
function acf_read_only( $field ) {
    $field['readonly'] = 1;
    $field['disabled'] = true;
return $field;
}

add_filter('acf/load_field/name=image_de_fond', 'acf_read_only');
 
?>