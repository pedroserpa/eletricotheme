var frame;
jQuery(document).ready(function() {
    jQuery('.image-select').on('click',function(e){
        e.preventDefault();
        var $imgField=jQuery(this).prev('input.image-field');
        
  		if ( frame ) {
          frame.open();
          return;
        }
        // Create a new media frame
        frame = wp.media({
          title: 'Select or Upload Media',
          button: {
            text: 'Use this media'
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });
		frame.on( 'select', function() {
          // Get media attachment details from the frame state
          var attachment = frame.state().get('selection').first().toJSON();
    
          // Send the attachment URL to our custom image input field.
          jQuery('#image-preview').append( '<img class="img-responsive" src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );
          $imgField.val(attachment.url);
        });
    
        // Finally, open the modal on click
        frame.open();
    });
});