// jquery pour fonctionner avec la fonction php create_gallery_function($post)
//d' après le tuto grafikart: http://www.grafikart.fr/tutoriels/wordpress/wp-media-uploader-403

jQuery(document).ready(function($){

    $('.customaddmedia').click(function(e){

			        var $el = $(this).parent();

			        e.preventDefault();

			        var uploader = wp.media({
			            title : 'Envoyer une image',
			            button : {
			                text : 'Choisir un fichier'
			            },
			            multiple: true
			        })
			        .on('select', function(){

							            var selection = uploader.state().get('selection');

							            var attachments = [];

							            selection.map( function(attachment){

															                attachment = attachment.toJSON();

															                attachments.push(attachment.id);

															            });

							            $('input', $el).val(attachments.join(','));


							            /*
							            // En cas de sélection simple
							            var attachment = selection.first().toJSON();
							            $('input', $el).val(attachment.url);
							            $('img', $el).attr('src', attachment.url);
							            */
							        })

					.open();

			    });


});
