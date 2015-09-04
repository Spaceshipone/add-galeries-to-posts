<?php
function add_js()
{
	if (is_admin())
	{
	    wp_enqueue_script('customadminjs', plugin_dir_url( __FILE__ ) . '/js/admin.js');
	}
}

add_action('admin_enqueue_scripts' , 'add_js');

/**
* On initialise nos différents menus
**/
	function register_my_galerie_menu_page()
	{
	    add_menu_page( 'galerie title', 'galerie', 'manage_options','hello', 'ol_galerie_menu_page',  plugin_dir_url( __FILE__ )."images/camera.jpg", 101 );
	}

	add_action( 'admin_menu', 'register_my_galerie_menu_page' );


/**
* Fonction permettant de générer le code HTML de notre page d'option
**/
function ol_galerie_menu_page()
{
    wp_enqueue_media();


    /**
    * Le traitement
    **/
    if(isset($_POST['pannel_update'])){
        if(!wp_verify_nonce($_POST['pannel_noncename'], 'my-pannel')){
            die('Token non valide');
        }
        foreach($_POST['options'] as $name => $value){
            if(empty($value)){
                delete_option($name);
            }else{
                update_option($name, $value);
            }
        }
        ?>
        <div id="message" class="updated fade">
            <p><strong>Bravo !</strong> Options sauvegardées avec succès</p>
        </div>
        <?php
    }

    /**
    * L'affichage
    **/
    ?>
    <div class="wrap theme-options-page">
        <div id="icon-options-general" class="icon32"><br></div>
        <h2>Galeries</h2>
        <form action="" method="post">

            <div class="theme-options-group">
                <table cellspacing="0" class="widefat options-table">
                    <thead>
                        <tr>
                            <th colspan="2">Medias pour galeries</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="identifiants">identifiants</label>
                            </th>
                            <td>
                                <img src="<?= get_option('header',''); ?>" width="250" class="customaddmedia"/>
                                <input type="text" id="header" name="options[header]" value="<?= get_option('header',''); ?>" size="75">
                                <a href="#" class="button  customaddmedia">Choisir une image</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="pannel_noncename" value="<?= wp_create_nonce('my-pannel'); ?>">
            <p class="submit">
                <input type="submit" name="pannel_update" class="button-primary autowidth" value="Sauvegarder">
            </p>


        </form>
    </div>
    <?php
}