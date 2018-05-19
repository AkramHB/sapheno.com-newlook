=== Contact Form 7 Style ===
Contributors: ionut.iclanzan, dorumarginean, mlehelsz, mircear
Donate link: http://cf7style.com/back-this-project/
Tags: contact form 7, contact form 7 style, contact form 7 templates, contact form 7 styling, CF7, CF7 style, styling contact form, styling contact form 7, multiple form styling, custom form styling, CF7 addon, customize, templates, valentine's day templates, Christmas templates, manual styling, live preview, hover state styling, CF7 form messages styling
Requires at least: 3.0.1
Tested up to: 4.9
Stable tag: 3.1.6
Requires PHP: 5.6.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple style customization and templating for Contact Form 7 forms. Requires Contact Form 7 plugin installed.

== Description ==

 [Contact Form 7 Style](http://cf7style.com/) plugin is an addon for [Contact Form 7](http://wordpress.org/plugins/contact-form-7/) which needs to be installed on your WordPress website.
 > This plugin requires the <a href="http://wordpress.org/extend/plugins/contact-form-7/" rel="nofollow">Contact Form 7 plugin</a><BR>
 <BR>
 > <a href="http://cf7style.com/downloads-history/" target="_blank">Downloads history</a> can be checked out on the cf7style.com website.<BR>
 
[youtube https://www.youtube.com/watch?v=dByaDeVlmAc]
 
Supports custom styling, which can be easily managed via admin dashboard. Also has predefined templates like Simple Pattern, Valentine's Day, Christmas that can be activated on your Contact Form 7.  <BR>


**Custom style options: <BR>**
- color styling, <BR>
- custom fonts ( google fonts included ), <BR>
- styling for input fields, text, textarea, labels, submit button, messages, placeholders, <BR>
- border-color, <BR>
- form background-color, <BR>
- form transparent background-color, <BR>
- form background-image, <BR>
- form container styling, <BR>
- form container background-image styling, <BR>
- form placeholder opacity styling, <BR>
- customized style can be imported / exported <BR>
- quick edit option <BR>
- support multiple forms with different design<BR>
- Style Template Slider on the Contact Form 7 form Settings page<BR>
- px,em, % unit selector for all the specified style settings<BR>
- possibility to change the syling for the HOVER state of each element<BR>
- live preview on changing/adding the new style properties of each element<BR>
- possibility to customize error messages, success messages and warning messages<BR>
- setting page, where can re-import deleted default templates, deactivate collecting data and / or manipulate the appearance of the "edit style" button on the page where you have your contact form 7 form<BR>

<strong>Support can be found [here](https://wordpress.org/support/plugin/contact-form-7-style).</strong>

or you can check the [FAQ](http://cf7style.com/faq/)  section.


== Installation ==

1. Upload the entire `contact-form-7-style` folder  to the `/wp-content/plugins/` directory
2. Make sure that Contact Form 7 is installed and activated ( an admin notice will check for this )
3. Activate the plugin through the 'Plugins' menu in WordPress

You will find 'Contact Style' menu in your WordPress admin panel.

== Screenshots ==

1. The Contact Style main settings page with predefined, responsive Style Templates
2. Custom new style Settings page with Google Font Selector, live preview and multiple element styling with the possibility to change the settings unit.
3. Template slider for quick setup of the form styling on the Contact Form 7 Settings Page.
4. Possibility to remove predefined templates only with 2 clicks.
5. Quick Edit on the Contact Style Settings Page, which allows Style Apply on various forms in a few seconds away.
6. Manual CSS Editor on the pages/posts which contains one or more Contact Form 7 forms.
7. Form Selector on the new Custom Style Setup Page.
8. Google Font Selector with all the Google Fonts included in one Dropdown with preview on the right side of the Dropdown.
9. Enable / disable forcing the CSS on the actual setup (it adds !important to every style property changed on the form)
10. Transparent background

== Frequently Asked Questions ==

Please check our FAQ page where you'll find answers to some of your questions on [cf7style.com/faq/](http://cf7style.com/faq/).

== Changelog ==

= 3.1.6 = 

Release Date: November 7th, 2017

* [Major Fix](https://wordpress.org/support/topic/u-have-a-problem-with-ure-update/) Fixed slash error and added extra condition to check for response

= 3.1.5 = 

Release Date: November 6th, 2017

* [Major Fix](https://wordpress.org/support/topic/error-on-updating-cf7-style/) Fallback for setups where json file can not be accesed by wp_remote_get

= 3.1.4 = 

Release Date: November 4th, 2017

* [Major Fix](https://wordpress.org/support/topic/dont-show-background-image/) Background image rendering fixed ( added "url()" )


= 3.1.3 = 

Release Date: November 3rd, 2017

* [New Feature] Placeholder elements styling and hover too + preview generate
* [New Feature] Opacity settings for placeholders
* [Improvement] Updated fonticons 
* [Improvement] Contact Form 7 "Go To CF7" button to edit form structure
* [Improvement] Notifications handling modified
* [Improvement] Removed transparent checkbox from font color
* [Improvement] Updated plugin file structure for better code management
* [Improvement] JSON files for plugin settings
* [Major Fix]   Works with PHP 7
* [Major Fix]   Compatible with WordPress Multisite
* [Major Fix] 	Refactored style generator
* General bugfixing

= 3.1.2 =
* [Small Fix](https://wordpress.org/support/topic/block-disappeared/) de-activated the possibility to drag boxes around
* [Small Fix](https://wordpress.org/support/topic/transparentclear-input-background/) added possibility to add transparent background
* [Small Fix](https://wordpress.org/support/topic/custom-submit-button-settings-not-working/) added new Force CSS settings possibility to plugin
* [Small Fix](https://wordpress.org/support/topic/successfully-sent-message-styles-not-working-properly/) customized styling to remove this issue
* [Small Fix](https://wordpress.org/support/topic/changing-default-padding-and-margins/) added possibility to add 0 padding / 0 margin
* [Small Improvement] Possible to add negative margins on custom templates
* [Small Improvement] Possible to add decimal values for "%" and "em" units
* [Small Improvement] Added tooltip on settings page for better understanding
* general bugfixing
* user interface improvements

= 3.1.1 =
* [Major Fix](https://wordpress.org/support/topic/custom-styles-not-working/) for custom styles
* [Small Fix] Styling issue on buttons
* [Small Fix] CSS generator core upgraded 

= 3.1.0 =
* [New Feature](https://wordpress.org/support/topic/error-confirmation-message-box-styling?replies=2) Error, confirmation, success message customization added
* [New Feature](https://wordpress.org/support/topic/disabling-the-edit-custom-style-button?replies=2) Added settings field, where you can activate or deactivate the "edit custom style" button
* [Major Improvement] modified settings page field generation, now it will remove every hidden field to improve page load
* [New](https://wordpress.org/support/topic/could-we-have-few-more-ready-skins-pretty-please/) predefined templates available
* [Improvements] for reliability and speed
* User interface improvements
* general bugfixing

= 3.0.5 =
* [Major Fix](https://wordpress.org/support/topic/headers-already-sent-35?replies=2) Headers already sent
* [Major Fix](https://wordpress.org/support/topic/please-fix-a-googleapi-call-in-your-php?replies=2) SSL security fix for Google Fonts
* [Major Fix] Parse error: syntax error, unexpected T_STATIC
* general bugfixing

= 3.0.4 =
* [Major Fix](https://wordpress.org/support/topic/problem-with-css-editor?replies=2) Fixed CSS editor "\" multiplier removed
* [Major Fix] Collection data functionality to prevent fatal error for various server setups
* [Major Fix] Prevent existing style data loss based on a new versioning system functionality
* [Improvement] Publish or Update Style button
* New feature - System Status page with the possibility to ask for help from the Contact Form 7 Style team by email
* New feature - Settings page - Install predefined templates or Allow collection data
* General bugfixing

= 3.0.3 =
* [Major Fix](https://wordpress.org/support/topic/existing-styling-deleted?replies=3) JQuery conflict with Siteorigin Page Builder and Visual Composer

= 3.0.2 =
* [Major Fix](https://wordpress.org/support/topic/does-not-work-639?replies=7) 
* [Collection data settings page](https://wordpress.org/support/topic/how-to-disable-data-collection?replies=2) 
* New feature - generate cf7 form preview buttons added when creating new custom style
* Improvements - preview generations on various user interactions
* Improvements - general bugfixing

= 3.0.1 =
* New feature - width and height styling properties for radio elements
* New feature - width and height styling properties for checkbox elements
* Improvements - general bugfixing

= 3.0.0 =
* UI rework, update, redesign
* New feature - Live Preview on all element changes with the actual Contact Form 7 form where the styling is applied
* New feature - Hover state design for all elements
* New feature - Style Selector Slider on Contact Form 7 Settings page, for quick style selection
* New feature - Introduced new unit selector
* New feature - Introduced new background-image add-on
* New feature - Introduced new styling properties
* New feature - Introduced fieldset, dropdowns, radio, checkbox
* Improvements - Bugfixing, running process, code updates
* Improvements - Modified Custom Styling logic and add it to new settings page
* Improvements - Message boxes behaviour
* Improvements - autocomplete styling where possible

= 2.2.8 =
* Optimize responsive view for predefined templates on mobile devices
* Added Invitora WordPress Theme compatibility
* Added support for special characters and fixed bugs

= 2.2.7 =
* Improvements for reliability and speed
* Enhanced plugin stability and fixed bugs
* Added Bretheon Premium WordPress Theme compatibility

= 2.2.6 =
* Added Avada Theme compatibility
* Added Bridge - Creative Multi-Purpose WordPress Theme compatibility
* Added Flatco - Multipurpose & Responsive WordPress Theme compatibility
* Improve CSS Editor UI

= 2.2.5 =
* [Fixed](https://wordpress.org/support/topic/avada-theme-5) Avada Theme Fusion Page Builder incompatibility issue
* [Fixed](https://wordpress.org/support/topic/good-morning-1) Contact form 7 shortcode detection for Flatco - Multipurpose & Responsive WordPress Theme
* Improve plugin installer process
 
= 2.2.4 =
* New feature - ability to add your own custom css rules
* [Fixed](https://wordpress.org/support/topic/textarea-height-and-submit-width) textarea and submit button on focus issue

= 2.2.3 =
* [Fixed](https://wordpress.org/support/topic/style-doesnt-apply-to-an-existing-form) simple template style issue

= 2.2.2 =
* Minor JQuery fixes for newer wordpress version
* Fixed custom style for textarea selector
* Admin panel minor adjustments

= 2.2.1 =
* New feature - textarea field additional options
* [Fixed](https://wordpress.org/support/topic/field-style-issue?replies=6) textarea field style issue

= 2.2 =
* Fixed Chrome preview problem
* Removed unnecessary elements from nav menus
* Fixed custom style no title problem
* [Fixed](https://wordpress.org/support/topic/custom-style-is-not-working?replies=6) css class generator
* New feature - Added quick edit
* New feature - Added new simple pattern style category with Twenty Fifteen Pattern

= 2.1.1 =
* Minor JQuery fixes for older wordpress version

= 2.1 =
* New feature - Google fonts preview when edit the style
* New feature - List all styles thumbnail preview for predefined templates

= 2.0.1 =
* Admin panel minor adjustments

= 2.0 =
* New UI Admin settings options
* Use custom post type for individual style set up
* Multiple cf7 forms can have their own style
* Style can be activated only for certain cf7 forms
* All google fonts available for use
* Styling improvement for theme twentyfifteen, twentyfourteen
* New settings available
* Possibility to change certain settings for the "custom style" styles
* Style filtering by categories for easier use
* Possibility to save your settings and import / export the generated "custom style"
* Donate option for support the plugin's continued development and better user support

= 1.1.1 =
* Added plugin update notification in plugin template selection panel

= 1.1.0 =
* Added Valentine's Day templates for 2014.
* Fixed Xmas Red header and footer position
* Added Custom Style submenu for styling the templates

= 1.0.1 =
* Fixed x-mas classic display on 2014 wordpress theme.

= 1.0 =
* First plugin version.

== Upgrade Notice ==
= Contact Form 7 Style Version 3.1.6 =

* [Major Fix](https://wordpress.org/support/topic/u-have-a-problem-with-ure-update/) Fixed slash error and added extra condition to check for response