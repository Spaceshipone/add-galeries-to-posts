<?php
/*
Plugin Name: add-galeries-to-posts
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







function enqueue_and_register_my_jquery()
	{


	    wp_register_script( 'resize-link-box', plugin_dir_url( __FILE__ ) . "jquery/resize-link-box.js" );

	   wp_enqueue_script( 'resize-link-box', plugin_dir_url( __FILE__ ) . "jquery/resize-link-box.js", "jquery" );

}

add_action( 'wp_enqueue_scripts', 'enqueue_and_register_my_jquery' );




function add_styles()
{
	wp_register_style( 'AAAAAgaleries',   plugin_dir_url( __FILE__ )."css/plugin.css" );

	wp_enqueue_style( 'AAAAAgaleries' );

}
add_action( 'wp_enqueue_scripts', 'add_styles' );






























































?>