<?php
/* widget pour créer une galerie de médias attachés */

class OL_Galerie extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {

        parent::WP_Widget(
							           'OL_Galerie',
							          'OL_Galerie', // Name
							           array(
								                'classname' =>  'OL-Galerie-widget', // Base ID,
								                'description' =>"ce widget vous permet d' ajouter une galerie d' images",
								                ) // Args
									);

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance )
    {
        $title  = apply_filters( 'widget_title', $instance['title'] );
        //$yt_url = esc_url($instance['yt_url'] );

        echo $args['before_widget'];
        if ( ! empty( $title ) )
	        {
	            echo $args['before_title'] . $title . $args['after_title'];
	        }

         global $post;

         $args = array(
						"post_id"					=> $post -> ID,
						"taille_imagette"		=>	"100px",
						"pop_up"				=>	"pop-up",
					);




		galerie_perso($args ) ;

    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ]) )
	        {
	            $title = $instance[ 'title' ];
	        }
	        else
		         {
		            $title ='Nouveau Titre';
		        }
        ?>
        <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Titre de la galerie</label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

    /**
    *  Cette méthode est protégée, elle n'est pas accessible à l'extérieur de la classe
    *  ni dans une classe fille, pour y remédier on utiliserait plutôt protected que private
    */
    private function oembed( $url, $args = array() ){

        return wp_oembed_get($url, $args);

    }


}


// On enregistre notre nouveau widget
function _OL_Galerie_register_foo_widget() {
    register_widget( 'OL_Galerie' );
}
add_action( 'widgets_init', '_OL_Galerie_register_foo_widget' );











?>