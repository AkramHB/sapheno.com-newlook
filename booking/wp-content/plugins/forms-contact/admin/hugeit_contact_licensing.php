<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$license = array(
    array(
        "title" => "PayPal Integration",
        "text" => "Use popular online payments solution integrated with plugin. It supports money transfers with PayPal.",
        "icon" => "78px -573px"
    ),
    array(
        "title" => "Google Maps Integration",
        "text" => "Plugin includes simple Google Maps integration, helping showcase locations on website next to forms.
",
        "icon" => "151px -572px"
    ),
    array(
        "title" => "Multiple Email For Recipients",
        "text" => "Unlock more options and opportunities for the multiple email recipients at once.",
        "icon" => "0px -577px"
    ),
    array(
        "title" => "Email Newsletters",
        "text" => "Help your visitors to subscribe to your newsletters. Set up the time and number of letters to inform your visitors about your latest news and services.",
        "icon" => "-83px -572px"
    ),
    array(
        "title" => "Themes Customization",
        "text" => "Our Forms plugin includes a large bouquet of various themes, specially designed for you. In addition, you may create or customize your own.",
        "icon" => "-156px -565px"
    ),
    array(
        "title" => "Advanced Design",
        "text" => "Access to a huge number of design options allows you to customize every detail in your form and make it look and function as needed.",
        "icon" => "-232px -571px"
    ),
    array(
        "title" => "Ready-To-Go Fields",
        "text" => "By one click add multiple ready-to-go fields to your form. This will help you to save your time.",
        "icon" => "-310px -577px"
    ),
    array(
        "title" => "Layout Customization",
        "text" => "With the Pro version of Forms you will be able to customize every corner of your product and make it more modern and eye-catching.",
        "icon" => "-386px -577px"
    )
);
?>


<div class="responsive grid">
    <?php foreach ($license as $key => $val) { ?>
        <div class="col column_1_of_3">
            <div class="header">
                <div class="col-icon" style="background-position: <?= $val["icon"] ?>; ">
                </div>
                <?= $val["title"] ?>
            </div>
            <p><?= $val["text"] ?></p>
            <div class="col-footer">
                <a href="https://goo.gl/ycVtso" target="_blank" class="a-upgrate">Upgrade</a>
            </div>
        </div>
    <?php } ?>
</div>


<div class="license-footer">
    <p class="footer-text">
        You are using the Lite version of the Forms Plugin for WordPress. If you want to get more awesome options,
        advanced features, settings to customize every area of the plugin, then check out the Full License plugin.
        The full version of the plugin is available in 3 different packages of one-time payment.
    </p>
    <p class="this-steps max-width">
        After the purchasing the commercial version follow this steps
    </p>
    <ul class="steps">
        <li>Deactivate Huge IT Forms Plugin</li>
        <li>Delete Huge IT Forms</li>
        <li>Install the downloaded commercial version of the plugin</li>
    </ul>
    <a href="https://goo.gl/ycVtso" target="_blank">Purchase a License</a>
</div>
