add-galeries-to-posts
=====================


Version de base, 1.0.0


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
 
 "pop_up";  introduit une classe dans l' html, celle donnée dans le plugin responsive lightbox comme déclencheur de l' évènement.
 
 
 
Ce plugin crée un certain nombre de tailles d' images qui feront dorénavant partie du dossier média de votre installation. Mais si celles-ci existeront pour tout nouvel upload après son activation, ce ne sera pas le cas de celles qui y figurent déjà. Donc, pour un bon fonctionnement du plugin, il est impératif de la recréer à l' aide d' un plugin comme force regeneration thumbnails.
Les noms des tailles utiles sont 100px, 150px, 200px, pour une taille équivalente sur leur plus grand côté.



En outre, je vous conseille d' utiliser les plugins Responsive Lightbox pour créer vos lightbox, parce que ce plugin-ci se base dessus pour créer l' html des galeries, ainsi que PhotoPress - Image Taxonomies, qui recherche et inclu en base de données tous les métas d' une photo lors de son upload.
Mon site allant de plus en plus utiliser les taxonomies qu' il crée, ce plugin les utilisera également pour les réorganiser à ma façon.






 Ne pas oublier d' ajouter des attachments au post ou la page, sinon cela ne fonctionne pas, puisque sa première préoccupation est de les chercher.
 
 
 
 
 
 
 Version 1.1.0
 
 
 

 Ajout d' un shortcode:
 
 [olgallery nbre_img="", taille_imagette = "", pop_up= "" ]
 
 
 Les paramètres du shortcode sont ceux de la fonction de la version précédente, avec ce "détail": ils ont tous des valeurs par défaut. 
 0 pour,  nbre_img
150px, pour taille_imagette
pop_up, pour pop_up

L' avantage du shortcode est double: ne pas avoir à intervenir dans le code et pouvoir placer la galerie n' importe où au milieu du texte.





Ajout de l' attribut "alt"

à partir de maintenant un attribut "alt" sera inclu dans l' html de l' image, pour le css. 

 
 
Ajout et suppression d' une métabox dans l' admin 
 
 J' avais créé une métabox dans l' écran des médias pour la faire ou non apparaître dans un système de vente. Celle-ci disparaît: je suis toujours à la recherche d' un moyen d' ajouter plus ou moins automatiquement mes photos à la boutique.
 
 J' ai créé dans les écrans "post" et "page" une métabox reprenant l' ensemble des photos attachées aux articles et pages.
 L' utilité actuelle est faible puisqu' à part savoir quelles photos, sans avoir à passer par l' écran des médias, y sont attachées. Cependant, je compte petit à petit y ajouter des données qui seront utilisées par ce plugin.
 
 
 
 
 
 TO-DO LIST, comme disent nos voisins d' outre manche et atlantique.
 
 Ce plugin est destiné à ceux qui ne se contentent pas de deux ou trois photos par article, mais à au minimum une dizaine, voire vingt ou trente.
 Donc, l' idée est d' utiliser des shortcodes pour créer des minis galeries dans le texte ou de positionner des images seules, mais en les retirant du décompte de la galerie finale. J' ignore encore comment le faire automatiquement, mais finirai bien par avoir l' étincelle créatrice.
 
 L' autre point sera d' utiliser la liste des médias pour décider quelles seront les photos à vendre ou non et les ajouter automatiquement à woo commerce. Là encore, j' ignore comment faire, mais ce devrait être plus facile que le précédent.
 
 
 Et le dernier est d' ajouter des hooks pour vous permettre de créer vos propres galeries html en utilisant les fonctions de ce plugin.
 
 
 
 
 
 
  Version 1.2.0
  
  
  ajout d' un widget
 
 
 
 
 Version 1.3.0
 
 ajout d' une fonctionnalité de tri sur les noms des photos pour une meilleure organisation des galeries
 
 
 version 1.4.0
 
 la galerie est enfin affichée dans l' ordre des photos. Celui-ci est basé sur les noms des photos qui doivent être de type "nomjourmoisannée-numdesérie
 
 