<?php
$input_position_class = "vc_lc_element three_on_row three_on_row_layout";
$center_button_class = "text_center";
?>

<div class="heritage_contactform">
    <form class="heritage_contactform">
        <ul class="contactform_fields">
            <li class="comment-form-author heritage_cf_entry <?php echo esc_attr($input_position_class); ?>">
                <input type="text" placeholder="<?php echo esc_html__('Your Name ', 'heritage'); ?>" name="contactName" id="contactName" class="heritage_cf_input required requiredField contactNameInput" />
                <div class="heritage_cf_error"><?php echo esc_html__('Please enter your name', 'heritage'); ?></div>
            </li>
            <li class="comment-form-email heritage_cf_entry <?php echo esc_attr($input_position_class); ?>">
                <input type="text" placeholder="<?php echo esc_html__('Email ', 'heritage'); ?>" name="email" id="contactemail" class="heritage_cf_input required requiredField email" />
                <div class="heritage_cf_error"><?php echo esc_html__('Please enter a correct email address', 'heritage'); ?></div>
            </li>

            <li class="comment-form-url heritage_cf_entry <?php echo esc_attr($input_position_class); ?>">
                <input type="text" placeholder="<?php echo esc_html__('Phone ', 'heritage'); ?>" name="phone" id="phone" class="heritage_cf_input" />
            </li>

            <li class="comment-form-comment heritage_cf_entry vc_lc_element">
                <textarea name="comments" placeholder="<?php echo esc_html__('Message ', 'heritage'); ?>" id="commentsText" rows="10" cols="30" class="heritage_cf_input required requiredField contactMessageInput"></textarea>
                <div class="heritage_cf_error"><?php echo esc_html__('Please enter a message', 'heritage'); ?></div>
            </li>
            <?php
            /*
            //TODO: add recaptcha error here
            <li class="captcha_error">
                <span class="error"><?php echo esc_html__('Incorrect reCaptcha. Please enter reCaptcha challenge;', 'heritage'); ?></span>
            </li>
            */
            ?>
            <li class="wp_mail_error">
                <div class="heritage_cf_error"><?php echo esc_html__('Cannot send mail, an error occurred while delivering this message. Please try again later.', 'heritage'); ?></div>
            </li>

            <li class="formResultOK">
                <div class="heritage_cf_error"><?php echo esc_html__('Your message was sent successfully. Thanks!', 'heritage'); ?></div>
            </li>
            <?php /*TODO: add recaptcha */?>
            <li class="<?php echo esc_attr($center_button_class); ?>">
                <input name="Button1" type="submit" id="submit" class="lc_button" value="<?php echo esc_html__('Send', 'heritage'); ?>" >
                <?php /*<div class="progressAction"><img src="<?php echo get_template_directory_uri()."/images/progress.gif"; ?>"></div> */ ?>
            </li>

        </ul>
        <input type="hidden" name="action" value="heritagecontactform_action" />
        <?php wp_nonce_field('heritagecontactform_action', 'contactform_nonce'); ?>
    </form>
</div>