<?php
/**
 * @var $optin_url string
 * @var $optout_url string
 */
?>
<div class="hugeit-tracking-optin-forms-contact">
    <div class="hugeit-tracking-optin-forms-contact-left">
        <div class="hugeit-tracking-optin-forms-contact-icon"><img
                    src="<?php echo HG_CONTACT_URL . '/images/tracking/plugin-icon.png'; ?>"
                    alt="forms-contact"/></div>
        <div class="hugeit-tracking-optin-forms-contact-info">
            <div class="hugeit-tracking-optin-forms-contact-header"><?php _e('Let us know how you wish to better this plugin! ', 'hugeit-forms-contact'); ?></div>
            <div class="hugeit-tracking-optin-forms-contact-description"><?php _e('Allow us to email you and ask how you like our plugin and what issues we may fix or add in the future. We collect <a href="http://huge-it.com/privacy-policy/#collected_data_from_plugins" target="_blank">basic data</a>, in order to help the community to improve the quality of the plugin for you. Data will never be shared with any third party.', 'hugeit-forms-contact'); ?></div>
            <div>
                <a href="<?php echo $optin_url; ?>"
                   class="hugeit-tracking-optin-forms-contact-button"><?php _e('Yes, sure', 'hugeit-forms-contact'); ?></a><a
                        href="<?php echo $optout_url; ?>"
                        class="hugeit-tracking-optout-button"><?php _e('No, thanks', 'hugeit-forms-contact'); ?></a>
            </div>
        </div>
    </div>
    <div class="hugeit-tracking-optin-forms-contact-right">
        <div class="hugeit-tracking-optin-forms-contact-logo">
            <img src="<?php echo HG_CONTACT_URL . '/images/tracking/logo.png'; ?>" alt="Huge-IT"/>
        </div>
        <div class="hugeit-tracking-optin-forms-contact-links">
            <a href="http://huge-it.com/privacy-policy/#collected_data_from_plugins"
               target="_blank"><?php _e('What data We Collect', 'hugeit-forms-contact'); ?></a>
            <a href="https://huge-it.com/privacy-policy"
               target="_blank"><?php _e('Privacy Policy', 'hugeit-forms-contact'); ?></a>
        </div>
    </div>
</div>