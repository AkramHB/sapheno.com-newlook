<?php
/**
 * @var $slug string The plugin slug
 */
?>
<div id="forms-contact-deactivation-feedback" class="-hugeit-modal">
    <div class="-hugeit-modal-content">
        <div class="-hugeit-modal-content-header">
            <div class="-hugeit-modal-header-icon">
                <img src="<?php echo HG_CONTACT_URL . '/images/tracking/plugin-icon.png'; ?>"
                     alt="<?php echo $slug; ?>"/>
            </div>
            <div class="-hugeit-modal-header-info">
                <div class="-hugeit-modal-header-title"><?php _e('We\'re sorry to see you go.', 'hugeit-forms-contact'); ?></div>
                <div class="-hugeit-modal-header-subtitle"><?php _e('Before deactivating and deleting Forms plugin, we\'d love to know why you\'re leaving us.', 'hugeit-forms-contact'); ?></div>
            </div>
            <div class="-hugeit-modal-close"></div>
        </div>
        <div class="-hugeit-modal-content-body">
            <?php wp_nonce_field('hugeit-contact-deactivation-feedback', 'hugeit-contact-deactivation-nonce'); ?>
            <div class="-hugeit-modal-cb">
                <label>
                    <input type="radio" value="useless_and_limited_plugin"
                           name="forms-contact-deactivation-reason"/><span><?php _e('Useless and limited plugin', 'hugeit-forms-contact'); ?></span>
                </label>
            </div>
            <div class="-hugeit-modal-cb">
                <label>
                    <input type="radio" value="found_another_plugin"
                           name="forms-contact-deactivation-reason"/><span><?php _e('Found another plugin', 'hugeit-forms-contact'); ?></span>
                </label>
            </div>
            <div class="-hugeit-modal-cb">
                <label>
                    <input type="radio" value="activating_pro_version"
                           name="forms-contact-deactivation-reason"/><span><?php _e('Activating Pro version', 'hugeit-forms-contact'); ?></span>
                </label>
            </div>
            <div class="-hugeit-modal-cb">
                <label>
                    <input type="radio" value="support_was_bad"
                           name="forms-contact-deactivation-reason"/><span><?php _e('Support was bad', 'hugeit-forms-contact'); ?></span>
                </label>
            </div>
            <div class="-hugeit-modal-cb">
                <label>
                    <input type="radio" value="plugin_does_not_meet_your_expectations"
                           name="forms-contact-deactivation-reason"/><span><?php _e('Plugin doesn\'t meet your expectations', 'hugeit-forms-contact'); ?></span>
                </label>
            </div>
            <div class="-hugeit-modal-textarea">
                <label for="<?php echo $slug; ?>-deactivation-comment"
                       class="-deactivation-feedback-textarea-label"><?php _e('My other reason is', 'hugeit-forms-contact'); ?></label>
                <textarea name="<?php echo $slug; ?>-deactivation-comment"
                          id="<?php echo $slug; ?>-deactivation-comment"></textarea>
            </div>
        </div>
        <div class="-hugeit-modal-content-footer">
            <a href="#"
               class="hugeit-deactivate-plugin-forms-contact"><?php _e('Deactivate', 'hugeit-forms-contact') ?></a>
            <a href="#"
               class="hugeit-cancel-deactivation-forms-contact"><?php _e('Cancel', 'hugeit-forms-contact') ?></a>
        </div>
    </div>
</div>