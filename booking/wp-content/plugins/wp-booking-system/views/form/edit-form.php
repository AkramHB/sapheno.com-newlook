<?php global $wpdb;?>
<div class="wrap wpbs-wrap">
    <div id="icon-themes" class="icon32"></div>
    <h2><?php _e('Edit Form','wpbs');?></h2>
    <?php if(!empty($_GET['save']) && $_GET['save'] == 'ok'):?>
    <div id="message" class="updated">
        <p><?php echo __('The form was updated','wpbs')?></p>
    </div>
    <?php endif;?>
    <?php if(!(!empty($_GET['id']))) $_GET['id'] = 'wpbs-new-form';?>
    <?php $sql = $wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'bs_forms WHERE formID=%d',$_GET['id']); ?>
    <?php $form = $wpdb->get_row( $sql, ARRAY_A );?>
    <?php if($wpdb->num_rows > 0 || $_GET['id'] == 'wpbs-new-form'): $formOptions = json_decode($form['formOptions'],true);?>
        <div class="postbox-container meta-box-sortables">
            
            <form action="<?php echo admin_url( 'admin.php?page=wp-booking-system-forms&do=save-form&noheader=true');?>" method="post">
            <div class="wpbs-buttons-wrapper">
                <input type="submit" class="button button-primary button-h2 saveCalendar" value="<?php echo __("Save Changes",'wpbs') ;?>" /> 
                <a class="button secondary-button button-h2 button-h2-back-margin" href="<?php echo admin_url( 'admin.php?page=wp-booking-system-forms' );?>"><?php _e('Back','wpbs');?></a>
            </div>
            <input type="text" name="formTitle" class="fullTitle" id="formTitle" placeholder="<?php echo __("Form title",'wpbs') ;?>" value="<?php echo esc_html(stripslashes(((!empty($form['formTitle'])) ? $form['formTitle'] : ""))) ;?>"/>
            
                
            
            <div class="metabox-holder">
                    <?php wpbs_edit_form( array('formData' => $form['formData']) );?>
                    <input type="hidden" value="<?php echo (!empty($form['formID'])) ? $form['formID'] : "" ;?>" name="formID" />   
            </div> 
            <div class="metabox-holder">
                <div class="postbox closed">
                    <div class="handlediv" title="<?php _e('Click to toggle','wpbs');?>"><br /></div>
                    <h3 class="hndle"><?php _e('Form Settings','wpbs');?></h3>
                    <div class="inside">
                        <div class="wpbs-settings-col">
                            <div class="wpbs-settings-col-left">
                                <strong><?php _e('Receive messages by mail','wpbs');?></strong>                                
                            </div>
                            <div class="wpbs-settings-col-right">
                                <select name="receive_emails" id="receive_emails">
                                    <option value="yes"><?php _e('Yes','wpbs');?></option>
                                    <option value="no"<?php if(empty($formOptions['sendTo'])):?> selected="selected"<?php endif;?>><?php _e('No','wpbs');?></option>
                                </select>
                            </div>
                            <div class="wpbs-clear"></div>                            
                        </div>
                        
                        <div class="wpbs-settings-col" id="send_to_emails" <?php if(empty($formOptions['sendTo'])):?>style="display:none;"<?php endif;?>>
                            <div class="wpbs-settings-col-left">
                                <strong><?php _e('Send to','wpbs');?>:</strong>                                
                            </div>
                            <div class="wpbs-settings-col-right">
                                <input type="text" name="sendto" value="<?php echo esc_html($formOptions['sendTo']);?>" />
                                <small><?php _e('Separate multiple e-mail addresses with a comma','wpbs');?></small>
                            </div>
                            <div class="wpbs-clear"></div>                            
                        </div>
                        
                        <div class="wpbs-settings-col">
                            <div class="wpbs-settings-col-left">
                                <strong><?php _e('Confirmation message','wpbs');?>:</strong>                                
                            </div>
                            <div class="wpbs-settings-col-right">
                                <textarea class="widefat" name="confirmation"><?php echo esc_html($formOptions['confirmationMessage']);?></textarea>
                                <small><?php _e('The message to be shown to the visitor when the form was submitted succesfully','wpbs');?></small>
                            </div>
                            <div class="wpbs-clear"></div>                            
                        </div>    
                    </div>
                </div>
            </div> 
            
            <div class="metabox-holder">
                <div class="postbox closed">
                    <div class="handlediv" title="<?php _e('Click to toggle','wpbs');?>"><br /></div>
                    <h3 class="hndle"><?php _e('Submit Button','wpbs');?></h3>
                    <div class="inside">
                        <div class="wpbs-settings-col">
                            <div class="wpbs-settings-col-left">
                                <strong><?php _e('Default Label','wpbs');?></strong>                                
                            </div>
                            <div class="wpbs-settings-col-right">
                                <input type="text" name="submitLabel" value="<?php echo esc_html($formOptions['submitLabel']['default']);?>" />
                            </div>
                            <div class="wpbs-clear"></div>                            
                        </div>
                        <hr />
                        <?php $activeLanguages = json_decode(get_option('wpbs-languages'),true); foreach ($activeLanguages as $code => $language):?>
                        <div class="wpbs-settings-col">
                            <div class="wpbs-settings-col-left">
                                <strong><?php echo $language;?></strong>                                
                            </div>
                            <div class="wpbs-settings-col-right">
                                <input type="text" name="submitLabel_<?php echo $code;?>" value="<?php echo esc_html($formOptions['submitLabel'][$code]);?>" />
                            </div>
                            <div class="wpbs-clear"></div>                            
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div> 
            <input type="submit" class="button button-primary saveCalendar" style="margin-top: 20px;" value="<?php _e('Save Changes','wpbs');?>" /> 
            </form>
        </div>
    <?php else:?>
        <?php echo __('Invalid calendar ID.','wpbs')?>
    <?php endif;?>     
</div>

