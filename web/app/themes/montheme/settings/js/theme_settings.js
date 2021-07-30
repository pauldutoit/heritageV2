jQuery(document).ready(function($){
   'use strict';
   var meta_image_frame;
   handleUploadLogo($, meta_image_frame);
   handleUploadInnerBgImage($, meta_image_frame);
   initializeAlphaColorPicker($);
});

function initializeAlphaColorPicker($) {
    $('input.alpha-color-picker-settings').alphaColorPicker();
}

/**
 * Handle upload logo functionnality
 * @param $
 * @param meta_image_frame
 */
function handleUploadLogo($, meta_image_frame) {
    $('#lc_swp_upload_logo_button').click(function(e) {
        e.preventDefault();
        openAndHandleMedia($, meta_image_frame, '#lc_swp_logo_upload_value', '#lc_logo_image_preview img', "Choose Custom Logo Image", "Use this image as logo");
    });

    $('#lc_swp_remove_logo_button').click(function(){
        $('#lc_logo_image_preview img').attr('src', '');
        $('#lc_swp_logo_upload_value').val('');
    })
}

/**
 * Handle custom bg image upload functionnality
 * @param $
 * @param meta_image_frame
 */
function handleUploadInnerBgImage($, meta_image_frame) {
    $('#lc_swp_upload_innner_bg_image_button').click(function(e) {
        e.preventDefault();
        openAndHandleMedia(
            $,
            meta_image_frame,
            '#lc_swp_innner_bg_image_upload_value',
            '#lc_innner_bg_image_preview img',
            "Choose Custom Background Image For Inner Pages",
            "Use this image as background"
        );
    });

    $('#lc_swp_remove_innner_bg_image_button').click(function(){
        $('#lc_innner_bg_image_preview img').attr('src', '');
        $('#lc_swp_innner_bg_image_upload_value').val('');
    })
}

/**
 * Use the wp media library to upload logo image
 * @param $
 * @param meta_image_frame
 * @param inputId
 * @param pathToImgId
 * @param titleText
 * @param buttonText
 */
function openAndHandleMedia($, meta_image_frame, inputId, pathToImgId, titleText, buttonText) {
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }

    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: titleText,
        button: {text:  buttonText},
        library: {type: 'image'}
    });

    // Runs when an image is selected.
    meta_image_frame.on('select', function(){
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
        $(inputId).val(media_attachment.url);
        $(pathToImgId).attr('src', media_attachment.url);
    });

    meta_image_frame.open();
}
