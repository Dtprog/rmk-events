/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function ($) {

    // Instantiates the variable that holds the media library frame.
    let meta_image_frame;

    // Runs when the image button is clicked.
    $('#meta-image-button').click(function(e){

        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: 'Upload Image for Event',
            button: { text:  'Set as event image' },
            library: { type: 'image' }
        });

        meta_image_frame.on('select', function(){
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            $('#event-image-preview').attr('src', media_attachment.url).css('display', 'block');
            $('#meta-image').val(media_attachment.url);
        });

        meta_image_frame.open();
    });

    $('#meta-image-remove-btn').click(function(e) {
        $('#event-image-preview').attr('src', '').css('display', 'none');
        $('#meta-image').val('');
    });

});