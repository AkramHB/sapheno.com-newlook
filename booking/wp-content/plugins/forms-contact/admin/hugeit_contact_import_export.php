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
require_once( "hugeit_free_version.php" ); ?>
<style>
    .left-half,.right-half{
        width: 48%;
        float: left;
        box-sizing: border-box;
        padding: 15px;
        background: rgba(211, 211, 211, 0.18);
    }
    .right-half{
        float: right;
    }
    label{
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #726c6c;
    }
    #hugeit_import_export #post-body-content{
        padding: 15px;
        box-sizing: border-box;
    }

    #hugeit_import_export input[type=submit]{
        background: #1279b9;
        color: #fff;
        border: 1px solid #1279b9;
        padding: 5px 15px;
        transition: all 0.3s;
        cursor: pointer;
        margin-top: 5px;
    }
    #hugeit_import_export input[type=submit]:hover{
        background: transparent;
        color: #1279b9;
    }
    .clear-float:after{
        content: '';
        display: block;
        clear: both;
    }

</style>
    <div class="wrap" id="hugeit_import_export">
        <?php hugeit_contact_drawFreeBanner('yes');?>
        <div id="poststuff" class="clear-float">
            <div id="post-body-content" class="clear-float">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h2><?php _e('Import/Export','hugeit_contact');?></h2>
                    <p class="description">You can export and import forms here to transfer data from one site to another.</p>
                    <div class="clear-float">
                        <div class="left-half">
                            <label for="import-file"><?php _e('Import Form','hugeit_contact');?></label>
                            <input type="file" name="import-file" id="import-file">
                            <br>
                            <input type="submit" name="import-form" value="<?php _e('Import','hugeit_contact');?>">
                        </div>
                        <div class="right-half">
                            <label for="export-file"><?php _e('Select Form to Export','hugeit_contact');?></label>
                            <select  id="export-form" name="export-form">
                                <?php global $wpdb;
                                $forms = $wpdb->get_results('SELECT id,name FROM '.$wpdb->prefix.'huge_it_contact_contacts');
                                foreach ( $forms as $form){ ?>
                                    <option value="<?php echo $form->id;?>"><?php echo $form->name;?></option>
                                <?php } ?>
                            </select>
                            <br>
                            <input name="export-button" type="submit" id="export-button" value="<?php _e('Export','hugeit_contact');?>">
                        </div>
                    </div>

                    <input type="hidden" name="form">
                </form>
            </div>
        </div>
    </div>
<?php

