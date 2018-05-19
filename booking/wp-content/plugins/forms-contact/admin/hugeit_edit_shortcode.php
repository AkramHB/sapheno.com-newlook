<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( function_exists( 'current_user_can' ) ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        die( 'Access Denied' );
    }
}
if ( ! function_exists( 'current_user_can' ) ) {
    die( 'Access Denied' );
}
?>
<div >
    <h3>Select Huge IT Form to Insert Into Post</h3>
    <select id="huge_it_contact-select">
        <option value="1">Subscribe Form</option>
        <option value="2">Delivery Form</option>
        <option value="3">Contact US Form</option>
        <option value="4">Reservation Form</option>
        <option value="6">Free Form Test</option>
        <option value="7">Pro Form Test</option>
        <option value="8">File Upload</option>
        <option value="11">Export/Import Form</option>
        <option value="15">Import Form</option>
        <option value="16">Import Form</option>
        <option value="17">My New Form</option>
        <option value="20">Subscribe</option>
        <option value="21">My New Form</option>
    </select>
    <button class="button primary" id="hugeithugeit_contactinsert">Insert Form</button>
</div>
