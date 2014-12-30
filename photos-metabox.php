<?php

function add_attachments_to_post_screen()
{
	add_meta_box("attachments", "attachments", "add_attachments_to_post_screen_function", "post");
	add_meta_box("attachments", "attachments", "add_attachments_to_post_screen_function", "page");
}
add_action('add_meta_boxes','add_attachments_to_post_screen');


function add_attachments_to_post_screen_function($post)
{

	$args = array(
							"post_id" => $post -> ID,
							"nbre_img"   => 0,
							"taille_imagette"  => "200px",
							"pop_up" => "pop-up"
						);

	galerie_perso($args );
}





















?>