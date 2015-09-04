<!-- code repris à titre d' example depuis http://wabeo.fr/meta-box-pdf-article/ -->



<?php
add_action( 'add_meta_boxes', 'ajout_pdf_metabox' );

function ajout_pdf_metabox()
{
  add_meta_box( "url_du_pdf", "Fichier à télécharger", "pdf_metabox", "post", "normal", "high" );
}

function pdf_metabox( $post )
{
  $url_pdf = get_post_meta( $post->ID, '_url_pdf', true );

  wp_enqueue_script( 'willy-meta-box-sup', get_bloginfo('template_url').'/js/willy-pdf.js', array( 'jquery','media-upload','thickbox' ) );
  ?>

  <label for="url_pdf">Sélectionner un pdf à télécharger</label><input id="url_pdf" style="width: 450px;" type="text" name="url_pdf" value="<?php echo esc_url( $url_pdf ); ?>" />
  <input id="upload_pdf_button" class="button-secondary" type="button" value="Télécharger un document pdf" />

  <?php
}

add_action( 'save_post', 'save_custom' );

function save_custom( $post_ID )
{
  if ( isset( $_POST[ 'url_pdf' ] ) )
  {
    update_post_meta( $post_ID, '_url_pdf', esc_url_raw( $_POST[ 'url_pdf' ] ) );
  }
}






































?>