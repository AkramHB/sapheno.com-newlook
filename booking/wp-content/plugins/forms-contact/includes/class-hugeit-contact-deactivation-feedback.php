<?php

class Hugeit_Contact_Deactivation_Feedback
{
    /**
     * @var Hugeit_Contact_Tracking
     */
    private $tracking;

    public function __construct(Hugeit_Contact_Tracking $tracking)
    {
        if ($tracking->is_opted_in()) {
            add_action('current_screen', array($this, 'init'));
            add_action('wp_ajax_hugeit_contact_deactivation_feedback', array($this, 'send'));
        }
    }

    public function init()
    {

        $screen = get_current_screen();

        if ('plugins' === $screen->id) {
            add_action('admin_footer', array($this, 'render_footer'));
        }
    }

    public function render_footer()
    {
        $slug = 'forms-contact';
        echo Hugeit_Contact_Template_Loader::render(HG_CONTACT_PATH . 'admin' . DIRECTORY_SEPARATOR . 'tracking' . DIRECTORY_SEPARATOR . 'deactivation-feedback' . DIRECTORY_SEPARATOR . 'show.php', compact('slug'));
    }

    public function send()
    {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'hugeit-contact-deactivation-feedback')) {
            die(0);
        }

        $GLOBALS['hugeit_contact_tracking']->track_data();
        if (!$GLOBALS['hugeit_contact_tracking']->is_opted_in()) {
            die(0);
        }

        $data = array(
            'project_id' => 15,
            'project_version' => HG_CONTACT_VERSION,
            'deactivation_reason' => sanitize_text_field($_POST['value']),
            'comment' => sanitize_text_field($_POST['comment']),
            'site_url' => home_url(),
            'email' => get_option('admin_email'),
        );


        wp_remote_post('https://huge-it.com/track-user-data/deactivation-feedback.php', array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'blocking' => true,
            'headers' => array(),
            'body' => $data,
        ));

        echo 'ok';
        die;
    }

}