<?php 

echo'

	 <div class="mo_registration_divided_layout" style="width:97%">
		<div class="mo_registration_table_layout">';

			is_customer_registered();

echo    '   <table style="width:100%">
                <tr>
                    <td colspan="2">
                        <h2>'.mo_("CUSTOMIZE THE OTP POP-UPS").'
                        </h2><hr/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <div class="mo_otp_note" style="color:#942828;">
                            '.mo_("<i> Configure your pop-ups below. Add scripts, images, css scripts or change the popup entirely to your liking.
                             <br/><br/><b>NOTE:</b> Click on the Preview button to see how your pop up would look like.").'
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>DEFAULT POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input type="button" id="popupbutton" class="button button-primary button-large" 
                                    data-popup="mo_preview_popup" data-iframe="defaultPreview" value="'.mo_("Preview").'">
                                <input type="button" id="popupbutton"  class="button button-primary button-large"
                                    data-popup="mo_popup_save" data-iframe="defaultPreview" value="'.mo_("Save").'">
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mo_otp_note" style="color:#942828;">'.
                            mo_("Make sure to have the following tags in the popup: </i><b>{{JQUERY}}</b>, <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                <b>{{FORM_ID}}</b>, <b>{{OTP_FIELD_NAME}}</b>, <b>{{REQUIRED_FIELDS}}</b>, <b>{{REQUIRED_FORMS_SCRIPTS}}</b></ol>").   
                        '</div>
                    </td>
                </tr>
                <tr>
                    <td width="54%">
                        <form name="defaultPreview" method="post" action="'.admin_url( 'admin-post.php' ).'" target="defaultPreview">
                            <input type="hidden" id="popactionvalue" name="action" value="">
                            <input type="hidden" name="popuptype" value="'.$default_template_type.'"> ';

                            wp_nonce_field( $nonce ); 

                            wp_editor($custom_default_popup , $editorId ,$templateSettings);

echo                '         
                    </td>
                    <td width="46%">
                            <iframe id="defaultPreview" name="defaultPreview" src="" height="440" 
                                style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;"></iframe>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><br><hr/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>USER CHOICE POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input type="button" id="popupbutton" class="button button-primary button-large" 
                                    data-popup="mo_preview_popup" data-iframe="userchoicePreview" value="'.mo_("Preview").'">
                                <input type="button" id="popupbutton"  class="button button-primary button-large"
                                    data-popup="mo_popup_save" data-iframe="userchoicePreview" value="'.mo_("Save").'">
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mo_otp_note" style="color:#942828;">'.
                            mo_("Make sure to have the following tags in the popup: </i><b>{{JQUERY}}</b>, <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                <b>{{FORM_ID}}</b>, <b>{{REQUIRED_FIELDS}}</b>, <b>{{REQUIRED_FORMS_SCRIPTS}}</b></ol>").   
                        '</div>
                    </td>
                </tr>
                <tr>
                    <td width="54%">
                        <form name="userchoicePreview" method="post" action="'.admin_url( 'admin-post.php' ).'" target="userchoicePreview">
                            <input type="hidden" id="popactionvalue" name="action" value="">
                            <input type="hidden" name="popuptype" value="'.$userchoice_template_type.'"> ';

                            wp_nonce_field( $nonce ); 

                            wp_editor($custom_userchoice_popup , $editorId2 ,$templateSettings2);

echo                '         
                    </td>
                    <td width="46%">
                            <iframe id="userchoicePreview" name="userchoicePreview" src="" height="440" 
                                style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;"></iframe>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><br><hr/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>EXTERNAL POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input type="button" id="popupbutton" class="button button-primary button-large" 
                                    data-popup="mo_preview_popup" data-iframe="externalPreview" value="'.mo_("Preview").'">
                                <input type="button" id="popupbutton"  class="button button-primary button-large"
                                    data-popup="mo_popup_save" data-iframe="externalPreview" value="'.mo_("Save").'">
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mo_otp_note" style="color:#942828;">'.
                            mo_("Make sure to have the following tags in the popup: </i><b>{{JQUERY}}</b>, <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                <b>{{FORM_ID}}</b>, <b>{{REQUIRED_FIELDS}}</b>, <b>{{REQUIRED_FORMS_SCRIPTS}}</b></ol>").   
                        '</div>
                    </td>
                </tr>
                <tr>
                    <td width="54%">
                        <form name="externalPreview" method="post" action="'.admin_url( 'admin-post.php' ).'" target="externalPreview">
                            <input type="hidden" id="popactionvalue" name="action" value="">
                            <input type="hidden" name="popuptype" value="'.$external_template_type.'"> ';

                            wp_nonce_field( $nonce ); 

                            wp_editor($custom_external_popup , $editorId3 ,$templateSettings3);

echo                '         
                    </td>
                    <td width="46%">
                            <iframe id="externalPreview" name="externalPreview" src="" height="440" 
                                style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;"></iframe>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><br><hr/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>ERROR POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input type="button" id="popupbutton" class="button button-primary button-large" 
                                    data-popup="mo_preview_popup" data-iframe="errorPreview" value="'.mo_("Preview").'">
                                <input type="button" id="popupbutton"  class="button button-primary button-large"
                                    data-popup="mo_popup_save" data-iframe="errorPreview" value="'.mo_("Save").'">
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mo_otp_note" style="color:#942828;">'.
                            mo_("Make sure to have the following tags in the popup: </i><b>{{JQUERY}}</b>, <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                <b>{{REQUIRED_FORMS_SCRIPTS}}</b></ol>").   
                        '</div>
                    </td>
                </tr>
                <tr>
                    <td width="54%">
                        <form name="errorPreview" method="post" action="'.admin_url( 'admin-post.php' ).'" target="errorPreview">
                            <input type="hidden" id="popactionvalue" name="action" value="">
                            <input type="hidden" name="popuptype" value="'.$error_template_type.'"> ';

                            wp_nonce_field( $nonce ); 

                            wp_editor($error_popup , $editorId4 ,$templateSettings4);

echo                '         
                    </td>
                    <td width="46%">
                            <iframe id="errorPreview" name="errorPreview" src="" height="440" 
                                style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;"></iframe>
                        </form>
                    </td>
                </tr>
            </table>'; 

echo '
		</div>
     </div>
     <script type="text/javascript">
        $mo = jQuery;
        $mo(document).ready(function(){    
            $mo("iframe").contents().find("body").append("'.$message.'");
            $mo("input:button[id=popupbutton]").click(function(){
                var iframe = $mo(this).data("iframe");
                $mo("form[name="+iframe+"] #popactionvalue").val($mo(this).data("popup"));                
                $mo("#"+iframe).contents().find("body").empty();
                $mo("#"+iframe).contents().find("body").append("'.$loaderimgdiv.'");
                $mo("form[name="+iframe+"]").submit();
            });
        });
    </script>';

