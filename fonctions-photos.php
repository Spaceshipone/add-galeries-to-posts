<?php
function search_post_attachments($post_id)
	{
		$args = array(									//recuperation des fichiers attaches
								'post_type' => 'attachment',
								'numberposts' => -1,
								'post_status' => null,
								'post_parent' => $post_id
							);

		$attachments_ids = array();

		$attachments = get_posts( $args );

		foreach ($attachments as $attachment )
			{
				$attachment_id = $attachment -> ID;
				array_push( $attachments_ids, $attachment_id);
			}

		return  $attachments_ids;
	}


function attachments_aleatoire($attachments_ids, $nbre_img)
	{

		if ($attachments_ids)
			{
				$nbre_attachments = count($attachments_ids);

				$random_attachment_ids = array();

				$randoms = array();

				$randoms = nbres_aleatoires( $nbre_attachments, $nbre_img);

				foreach ( $randoms as $position )
						{
							$attachment_id= $attachments_ids[$position];		// la position de l' ID dans la liste des attachments du post
							array_push($random_attachment_ids, $attachment_id);
						}

				$attachments_ids = $random_attachment_ids;
			}

		return $attachments_ids;
	}



function nbres_aleatoires($nbre_attachments, $max_photos)

	{
			// début de la création d' un vecteur empli de nombres aléatoires
		$i=0;
		$existe="non";
		$positions[0]=0;

		do
		 {
			 $position=rand (0 ,$nbre_attachments-1);

			 foreach ($positions as $element)  // contrôle si le nombre aléatoire  existe
				{
				 if ($element==$position)
					{
					 $existe="oui";
					}
				}
			if( $existe="non") // sinon on l' ajoute au tableau et on incrémente
			{
			 $positions[$i]=$position;
			 $i=$i+1;
			}

		 }   // fin du vecteur de position

		while ($i<$max_photos) ; // $n est le nombre d' images de la galerie

		return $positions;

	}


function organize_attachments($args = array("post_id", "nbre_img") )
	{

		extract($args);

		$attachments_ids = search_post_attachments($post_id);

		if ($attachments_ids)
			{
				$nbre_ids  = count($attachments_ids);

				if (( $nbre_img < $nbre_ids ) and ( 0 != $nbre_img ))
					{
						$attachments_ids = attachments_aleatoire($attachments_ids, $nbre_img);
					}


				foreach ( $attachments_ids as $attachment_id )
					{

						$metas = wp_get_attachment_metadata( $attachment_id );

						$full_name = $metas["file"];

						$file_name = explode( ".", $full_name)[0];

						$attachments_list [ $attachment_id ]  =   $file_name  ;

					}
				asort($attachments_list);
			}  // fin if attachments
			else
				{
					$attachments_list = null;
				}

		return $attachments_list;

	} // fin de fonction






function attachment_by_id($attachment_id, $taille_imagette)
{
	$datas_image = wp_get_attachment_image_src( $attachment_id, 'full' );

	$href  =  $datas_image[0];

	$datas_imagette = wp_get_attachment_image_src( $attachment_id, $taille_imagette);

	if($datas_imagette )
		{

			$height = $datas_imagette[2];

			$width = $datas_imagette[1];

			if ( ($height < $width) )    // la mesure de base est la hauteur de la photo
			/* ici on teste le rapport largeur/hauteur et on décide de de la taille d' imagette à utiliser */
				{
					switch ($taille_imagette)
						{

							case "100px":
								$taille_imagette_plus_un = "150px";
								break;

							case "150px":
								$taille_imagette_plus_un  = "225px";
								break;

							case "200px":
								$taille_imagette_plus_un  = "300px";
								break;

							case "250px":
								$taille_imagette_plus_un  = "375px";
								break;

						}			// end swtch

						$datas_imagette = wp_get_attachment_image_src( $attachment_id, $taille_imagette_plus_un );

				}   // fin de if    ($height < $width)
		} // fin de if $datas_imagettes


		$scr = $datas_imagette[0];

		$height = $datas_imagette[2];

		$width = $datas_imagette[1];

		$href = $datas_image[0];

		$alt_text = get_post($attachment_id ) -> post_content;

		$attachment_datas = array(
													"height" => $height,
													"scr"      => $scr,
													"width"  => $width,
													"href"    => $href,
													"alt_text" => $alt_text,
													);


	return $attachment_datas;

}






function galerie_perso($args = array("post_id", "nbre_img", "taille_imagette", "pop_up" ) )  // "nbre_img" => Null pour afficher toutes les photos
	{

		extract($args);

		if ( !isset($nbre_img) ) { $nbre_img = 0; };
		if ( !isset($taille_imagette) ) { $taille_imagette = '150px'; };
		if ( !isset($pop_up) ) { $pop_up = ""; };


		$args = array (
								"post_id" => $post_id,
								"nbre_img" => $nbre_img,
								);


		$attachments_ids = organize_attachments( $args );

		$nbre_attachments = count($attachments_ids);

		if ($attachments_ids)
			{
				echo "<ul>";
				foreach ($attachments_ids as $attachment_id => $name)
					{

						$attachment_datas = attachment_by_id($attachment_id, $taille_imagette);


						extract($attachment_datas);

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

			}  				//fin de if attachments_ids
			return array($height, $width);

	}  // fin de fonction




function html( $args = array("scr", "href", "height", "width", "alt_text", "pop_up", "taille_imagette"))
{
	extract($args);

	switch ($taille_imagette)
		{

			case "100px":
				$classe_taille_imagette = "px100";
				break;

			case "150px":
				$classe_taille_imagette = "px150";
				break;

			case "200px":
				$classe_taille_imagette = "px200";
				break;

			case "225px":
				$classe_taille_imagette = "px225";
				break;

			case "250px":
				$classe_taille_imagette = "px250";
				break;

			case "300px":
				$classe_taille_imagette = "px300";
				break;

			case "375px":
				$classe_taille_imagette = "px375";
				break;

		}			// end swtch


	if ( !is_admin())
	{
		?>
			<li class="galerie <?php echo $classe_taille_imagette ?>"><a class = "<?php echo $pop_up ?> "  href="<?php echo $href ?>" rel =  "<?php echo $pop_up ?>"    >

				<img class="thumbnail <?php //echo $classe_taille_imagette ?>" src='<?php echo $scr ;?>' alt=" <?php echo $alt_text  ?>"  height="<?php echo $height; ?>" width="<?php echo $width ; ?>"  >

			</a></li>
	<?php
	}
	else
		{
			?>
			<img class="galerie" src='<?php echo $scr ;?>' alt=" <?php echo $alt_text  ?>"  height="<?php echo $height; ?>" width="<?php echo $width ; ?>"  >
			<?php
		}


} // fin de fonction



































?>