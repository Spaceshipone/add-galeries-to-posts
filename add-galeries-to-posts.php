<?php
/*
Plugin Name: add-galeries-to-posts  1111111
Plugin URI: http://ombres-et-lumieres.eu
Description: crée des galeries en utilisant les attacments des posts et pages
Version: 1.0.0
Author: Eric Wayaffe
Author URI: ombres-et-lumieres.eu
 License: GPL2
*/




if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');








defined('ABSPATH') or die("No script kiddies please!");




include ("fonctions-photos.php");
include ("photos-metabox.php");
include("widget.php");



function register_my_galerie_menu_page()
	{
	    add_menu_page( 'galerie title', 'galerie', 'manage_options','hello', 'my_galerie_menu_page',  plugin_dir_url( __FILE__ )."images/camera.jpg", 101 );
	}

	add_action( 'admin_menu', 'register_my_galerie_menu_page' );


function my_galerie_menu_page()
	{
	    echo "Le plugin galerie est encore activé!!!!!!!!";
	}


function images_setup()
  {
	if ( function_exists( 'add_image_size' ) )
		{
			add_image_size( '300px', 300, 300 );
			add_image_size( '250px', 250, 250 );
			add_image_size( '200px', 200, 200 );
			add_image_size( '225px', 225, 225 );
			add_image_size( '150px', 150, 150 );
			add_image_size( '100px', 100, 100 );
		}
  }
add_action( 'after_setup_theme', 'images_setup' );




function add_styles()
{
	wp_register_style( 'add-galeries-to-posts',   plugin_dir_url( __FILE__ )."css/plugin.css" );

	wp_enqueue_style( 'add-galeries-to-posts' );

}
add_action( 'wp_enqueue_scripts', 'add_styles' );






function add_styles_to_admin()
{
	wp_register_style('add-galeries-to-admin-posts',   plugin_dir_url( __FILE__ )."css/admin.css" );

	wp_enqueue_style('add-galeries-to-admin-posts');
}
add_action('admin_print_styles', 'add_styles_to_admin' );





/* shortcode pour l' usage du plugin */


function oLgallery_shortcode($atts, $content = null )
{
	global $post;

	$atts = shortcode_atts( array (
														"post_id" =>	 $post-> ID,
														"nbre_img" =>	0,
														 "taille_imagette" =>	"150px",
														 "pop_up" => "pop-up",
													),
											$atts
										);

	ob_start();	?>
	 <section id = "galerie">
	 	<?php galerie_perso($atts );	?>
	 </section>
	<?php
	return ob_get_clean();
}

add_shortcode("olgallery",  "oLgallery_shortcode");




function oLhtml_shortcode($atts, $content = null )
{
	global $post;


	$atts = shortcode_atts( array (
													"scr" => "",
													"href"	=> "",
													"height"	=> "",
													"width"	=> "",
													"alt_text"	=> "",
													"pop_up"	=> "",
													"taille_imagette" =>"150px"
												),
											$atts
										);

	ob_start();
	html( $atts);
	return ob_get_clean();
}

add_shortcode("olhtml",  "oLhtml_shortcode");













































?>