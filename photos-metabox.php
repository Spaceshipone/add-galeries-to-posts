<?php

/*
Le code commenté est du code "inutile" pour le bon fonctionnement de la metabox, mais nécesaire pour afficher
les photos qui seront utilisées pour la galerie et dans la partie sauvegarde pour les contrôles de sécurité
*/







function add_attachments_to_post_screen()
{
	// ajout de metabox pour visualiser les photos attachées
	add_meta_box("attachments", "attachments", "add_attachments_to_post_screen_function", "post");
	add_meta_box("attachments", "attachments", "add_attachments_to_post_screen_function", "page");

	//ajout d' une metabox pour ouvrir la bibliothèque de media et choisir des photos pour créer une galerie
	add_meta_box("gallery_id", "photos", "create_gallery_function", "post", "normal", "high");
}
add_action('add_meta_boxes','add_attachments_to_post_screen');


/* ************** *************************/
/* affiche les médias attachés à l' article */
/* ************************************* */

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


/* *********************************************************************************************** */
/* ******création d' une galerie à la manière de wordpress, sans attacher les médias **************/
/* ********************************************************************************************* */

function create_gallery($post)
{
	wp_nonce_field( 'create_gallery_save', 'create_gallery_nonce' );

	 $val = get_post_meta($post->ID,'_pict_ids',true);

	?>

        <label for="pict_ids">identifiantsdes médias</label>
        <input type="text" id="pict_ids" name="pict_ids" value="<?php echo $val ?>" size="75">
        <a href="#" class="button  customaddmedia">Choisir des images</a>

	<?php
/*
		$post_id = $post->ID;

		$pict_ids = get_post_meta($post_id, '_pict_ids');


		if ($pict_ids)
			{
				echo "<ul>";
				foreach ($pict_ids as $pict_id => $name)
					{

						$pict_datas = attachment_by_id($attachment_id, "200px");


						extract($pict_datas);

						if (isset($permalink))
							{
								$href = $permalink;
							}

						 $args = array(
						 						"scr" => $scr,
						 						"href" =>$href,
						 						"height" => $height,
						 						"width" => $width,
						 						"alt_text" =>$alt_text,
						 						"pop_up" => $pop_up,
						 						"taille_imagette" => $taille_imagette,
						 						);



					html( $args );

					}   // fin foreach attachments_ids
				echo "</ul>";

			}
*/				//fin de if attachments_ids

}


function create_gallery_save($post_id)
{


/*
	if ( ! isset( $_POST['create_gallery_nonce'] ) )
		{
			return;
		}

	if ( ! wp_verify_nonce( $_POST['create_gallery_nonce'], 'create_gallery_save' ) )
		{
			return;
		}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		{
			return;
		}

	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] )
		{
			if ( ! current_user_can( 'edit_page', $post_id ) )
				{
					return;
				}
		}
		else
			{
				if ( ! current_user_can( 'edit_post', $post_id ) )
					{
						return;
					}
			}

	if ( ! isset( $_POST["pict_ids"] ) )
		{
			return;
		}
*/

	$my_data = sanitize_text_field( $_POST["pict_ids"] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_pict_ids', $my_data );








}

add_action( 'save_post', 'create_gallery_save' );












?>