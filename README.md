add-galeries-to-posts
=====================


J' ai créé ce plugin parce que je trouvais nextgen trop lourd à manipuler. Donc , comme il a été conçu pour mon usage il est basé sur mes besoins. Cela signifie, entre autre l' asbsence de shortcode.
Vous pouvez y inclure vos remarques et modifications. 


Pour l' utiliser, vous avez deux fonctions:

$args = array(
						"post_id"					=>	, 
						"nbre_img"				=>	, 
						"taille_imagette"		=>	, 
						"pop_up"					=>	 , 
					);
 
 
 
 
 galerie_perso($args ) ;
 
 
 
 
 
 
 
 $args = array(
 						"scr"						=>	, 
 						"href"					=>	, 
 						"height"				=>	, 
 						"width"					=>	, 
 						"alt_text"				=>	, 
 						"pop_up"				=>	, 
 						"taille_imagette"	=>	,
 					);
 
 
 
 html( $args );
 
 
 "nbre_img": non obligatoire, par défaut 0 ce qui donne une galerie utilisant tous les attachments. Pour une galerie aléatoire, lui attribuer un nombre entier positif

 "taille_imagette": non obligatoire, par défaut "150px"
 
 "pop_up";  introduit une classe dans l' html, celle donnée dans le plugin responsive lightbox comme déclencheur de l' évènement
 
 
 Ajoute les tailles d' image suivantes: "100px" , "150px", "200px", "225px", "250px", "300px". Attention, ces tailles n' apparaîtront qu' après l' actiaion du plugin. Il vous faudra donc utiliser un plugin comme force regeneration thumbnails pour les créer.
 
 
 Ne pas oublier d' ajouter des attachments au post ou la page, sinon cela ne fonctionne pas, puisque sa première préoccupation est de les chercher.