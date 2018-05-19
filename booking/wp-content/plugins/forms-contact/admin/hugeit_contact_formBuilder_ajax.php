<?php
if ( ! defined( 'ABSPATH' ) ) exit;
	global $wpdb;
	//Draw the form
	function hugeit_contact_drawThemeNew($themeId) { ob_start();
		global $wpdb;
		$query = "SELECT *  from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = '".$themeId."' ";
	    $rows = $wpdb->get_results($query);
	    $style_values = array();
	    foreach ($rows as $row) {
	        $key = $row->name;
	        $value = $row->value;
	        $style_values[$key] = $value;
	    }

		//return $newCss;
	?>
#<?php echo $style_values["form_button_submit_icon_style"]."_".$style_values['form_button_submit_has_icon']; ?>{} #<?php echo $style_values["form_button_reset_icon_style"]."_".$style_values['form_button_reset_has_icon']; ?>{}  #hugeit-contact-wrapper { width:<?php echo $style_values["form_wrapper_width"]; ?>%; <?php $color = explode(",", $style_values["form_wrapper_background_color"]); if($style_values["form_wrapper_background_type"]=="color"){?> background:#<?php echo $color[0]; ?>; <?php } elseif($style_values["form_wrapper_background_type"]=="gradient"){ ?> background: -webkit-linear-gradient(#<?php echo $color[0]; ?>, #<?php echo $color[1]; ?>); /* For Safari 5.1 to 6.0 */ background: -o-linear-gradient(#<?php echo $color[0]; ?>, #<?php echo $color[1]; ?>); /* For Opera 11.1 to 12.0 */ background: -moz-linear-gradient(#<?php echo $color[0]; ?>, #<?php echo $color[1]; ?>); /* For Firefox 3.6 to 15 */ background: linear-gradient(#<?php echo $color[0]; ?>, #<?php echo $color[1]; ?>); /* Standard syntax */ <?php } ?> } #hugeit-contact-wrapper > div { border:<?php echo $style_values["form_border_size"]; ?>px solid #<?php echo $style_values["form_border_color"]; ?>; }#hugeit-contact-wrapper > div > h3 { <?php if($style_values["form_show_title"]=="on"):?>position:relative; display:block; clear:both !important; padding:5px 0px 10px 2% !important; font-size:<?php echo $style_values["form_title_size"]; ?>px !important; line-height:<?php echo $style_values["form_title_size"]; ?>px !important; color:#<?php echo $style_values["form_title_color"]; ?> !important; margin: 10px 0 15px 0 !important;<?php else:?>display:none;<?php endif;?> } #hugeit-contact-wrapper > div > h3 > input {border: 1px solid transparent !important; outline: none !important; -webkit-box-shadow: none !important; box-shadow: none !important; background-color: transparent !important; font-size:<?php echo $style_values['form_title_size']; ?>px !important; line-height:<?php echo $style_values['form_title_size']; ?>px !important;	color:#<?php echo $style_values['form_title_color']; ?>!important; outline: 0 !important; -webkit-transition: none !important; transition: none !important;} #hugeit-contact-wrapper label { font-size:<?php echo $style_values["form_label_size"]; ?>px; color:#<?php echo $style_values["form_label_color"]; ?>; font-family:<?php echo $style_values["form_label_font_family"]; ?>; } #hugeit-contact-wrapper .hugeit-contact-column-block > div > label { display:block; width:38%; float:left; margin-right:2%; cursor: move; } #hugeit-contact-wrapper .hugeit-contact-column-block > div .field-block { display:inline-block; width:60%; /*min-width:150px;*/ } #hugeit-contact-wrapper label.error { color:#<?php echo $style_values["form_label_error_color"]; ?>; } #hugeit-contact-wrapper label em.required-star{ color: #<?php echo $style_values["form_label_required_color"]; ?>; } #hugeit-contact-wrapper .hugeit-contact-column-block > div .field-block ul li label span.sublable{vertical-align: super;} #hugeit-contact-wrapper .hugeit-contact-column-block > div > label.formsRightAlign{ text-align: right !important; } #hugeit-contact-wrapper .hugeit-contact-column-block > div > label.formsAboveAlign{ width:100% !important; float:none !important; padding-bottom: 5px !important; } #hugeit-contact-wrapper .hugeit-contact-column-block > div .formsAboveAlign { width:100% !important; } #hugeit-contact-wrapper .hugeit-contact-column-block > div > label.formsInsideAlign{ display:none !important; } #hugeit-contact-wrapper .hugeit-contact-column-block > div .formsInsideAlign { width:100% !important; } .input-text-block input,.input-text-block input:focus,.simple-captcha-block input[type=text],.simple-captcha-block input[type=text]:focus { height:<?php echo $style_values["form_input_text_font_size"]*2; ?>px; <?php if($style_values["form_input_text_has_background"]=="on"){?> background:#<?php echo $style_values["form_input_text_background_color"]; ?>; <?php }else { ?> background:none; <?php } ?> border:<?php echo $style_values["form_input_text_border_size"]; ?>px solid #<?php echo $style_values["form_input_text_border_color"]; ?> !important; box-shadow:none !important ; border-radius:<?php echo $style_values["form_input_text_border_radius"]; ?>px; font-size:<?php echo $style_values["form_input_text_font_size"]; ?>px; color:#<?php echo $style_values["form_input_text_font_color"]; ?>; margin:0px !important; outline:none; }.textarea-block textarea { <?php if($style_values["form_textarea_has_background"]=="on"){?> background:#<?php echo $style_values["form_textarea_background_color"]; ?>; <?php }else { ?> background:none; <?php } ?> border:<?php echo $style_values["form_textarea_border_size"]; ?>px solid #<?php echo $style_values["form_textarea_border_color"]; ?>; border-radius:<?php echo $style_values["form_textarea_border_radius"]; ?>px; font-size:<?php echo $style_values["form_textarea_font_size"]; ?>px; color:#<?php echo $style_values["form_textarea_font_color"]; ?>; margin:0px !important; } .radio-block, .checkbox-block { position:relative; float:left; margin:0px 5px 0px 5px; display: block; } .radio-block input, .checkbox-block input { visibility:hidden; position:absolute; top:0px; left:0px; } .radio-block i { display:inline-block; float:left; width:20px; color:#<?php echo $style_values["form_radio_color"]; ?>; } .checkbox-block i { display:inline-block; float:left; width:20px; color:#<?php echo $style_values["form_checkbox_color"]; ?>; } #hugeit-contact-wrapper.big-radio .radio-block i ,#hugeit-contact-wrapper.big-checkbox .checkbox-block i {font-size:24px;} #hugeit-contact-wrapper.medium-radio .radio-block i ,#hugeit-contact-wrapper.medium-checkbox .checkbox-block i {font-size:20px;} #hugeit-contact-wrapper.small-radio .radio-block i ,#hugeit-contact-wrapper.small-checkbox .checkbox-block i {font-size:15px;} .radio-block i:hover { color:#<?php echo $style_values["form_radio_hover_color"]; ?>; } .checkbox-block i:hover { color:#<?php echo $style_values["form_checkbox_hover_color"]; ?>; } .radio-block i.active, .checkbox-block i.active {display:none;} .radio-block input:checked + i.active + i.passive, .checkbox-block input:checked + i.active + i.passive {display:none;} .radio-block input:checked + i.active, .radio-block input:checked + i.active:hover { display:inline-block; color:#<?php echo $style_values["form_radio_active_color"]; ?>; } .checkbox-block input:checked + i.active, .checkbox-block input:checked + i.active:hover { display:inline-block; color:#<?php echo $style_values["form_checkbox_active_color"]; ?>; } .selectbox-block { position:relative; height:<?php echo $style_values["form_selectbox_font_size"]*2+$style_values["form_selectbox_border_size"]; ?>px; } .selectbox-block select { position:relative; height:<?php echo $style_values["form_selectbox_font_size"]*2-$style_values["form_selectbox_border_size"]*2; ?>px; margin:<?php echo $style_values["form_selectbox_border_size"]; ?>px 0px 0px 1px !important; opacity:0; z-index:2; } .selectbox-block .textholder { position:absolute; height:<?php echo $style_values["form_selectbox_font_size"]*2; ?>px; width:90%; padding-right:10%; margin:0px !important; top;0px; left:0px; border:0px; color:#<?php echo $style_values["form_selectbox_font_color"]; ?>; background:none; border:<?php echo $style_values["form_selectbox_border_size"]; ?>px solid #<?php echo $style_values["form_selectbox_border_color"]; ?>; border-radius:<?php echo $style_values["form_selectbox_border_radius"]; ?>px; color:#<?php echo $style_values["form_selectbox_font_color"]; ?>; font-size:<?php echo $style_values["form_selectbox_font_size"]; ?>px; <?php if($style_values["form_selectbox_has_background"]=="on"){?> background:#<?php echo $style_values["form_selectbox_background_color"]; ?>; <?php }else { ?> background:none; <?php } ?> } .selectbox-block i { position:absolute; top:<?php echo $style_values["form_selectbox_font_size"]/2+$style_values["form_selectbox_border_size"]/4; ?>px; right:10px; z-index:0; color:#<?php echo $style_values["form_selectbox_arrow_color"]; ?>; font-size:<?php echo $style_values["form_selectbox_font_size"]; ?>px; } .file-block { position:relative; cursor:pointer; } .file-block .textholder { position:relative; float:left; width:calc(60% - <?php echo $style_values["form_file_border_size"]*2 + 5; ?>px) !important; height:<?php echo $style_values["form_file_font_size"]*2; ?>px; margin:0px; border:<?php echo $style_values["form_file_border_size"]; ?>px solid #<?php echo $style_values["form_file_border_color"]; ?> !important; border-radius:<?php echo $style_values["form_file_border_radius"]; ?>px !important; font-size:<?php echo $style_values["form_file_font_size"]; ?>px; color:#<?php echo $style_values["form_file_font_color"]; ?>; <?php if($style_values["form_file_has_background"]=="on"){?> background:#<?php echo $style_values["form_file_background"]; ?>; <?php }else { ?> background:none; <?php } ?> padding:0px 40% 0px 5px !important; box-sizing: content-box; -moz-box-sizing: content-box; } .file-block .uploadbutton { position:absolute; top:0px; right:0px; width:38%; border-top:<?php echo $style_values["form_file_border_size"]; ?>px solid #<?php echo $style_values["form_file_border_color"]; ?> !important; border-bottom:<?php echo $style_values["form_file_border_size"]; ?>px solid #<?php echo $style_values["form_file_border_color"]; ?> !important; border-right:<?php echo $style_values["form_file_border_size"]; ?>px solid #<?php echo $style_values["form_file_border_color"]; ?> !important; border-top-right-radius:<?php echo $style_values["form_file_border_radius"]; ?>px !important; border-bottom-right-radius:<?php echo $style_values["form_file_border_radius"]; ?>px !important; <?php $fileheight=$style_values["form_file_font_size"]*2; ?> height:<?php echo $fileheight; ?>px; padding:0px 1%; margin:0px; overflow: hidden; font-size:<?php echo $style_values["form_file_font_size"]; ?>px; line-height:<?php echo $style_values["form_file_font_size"]*2; ?>px; color:#<?php echo $style_values["form_file_button_text_color"]; ?>; background:#<?php echo $style_values["form_file_button_background_color"]; ?>; text-align:center; -webkit-transition: all 0.5s ease; transition: all 0.5s ease; box-sizing:content-box; } .file-block:hover .uploadbutton { color:#<?php echo $style_values["form_file_button_text_color"]; ?>; background:#<?php echo $style_values["form_file_button_background_color"]; ?>; vertical-align: baseline; } .file-block .uploadbutton i { color:#<?php echo $style_values["form_file_icon_color"]; ?>; font-size:<?php echo $style_values["form_file_font_size"]; ?>px; vertical-align: baseline; -webkit-transition: all 0.5s ease; transition: all 0.5s ease; } .file-block:hover .uploadbutton { color:#<?php echo $style_values["form_file_button_text_hover_color"]; ?>; background:#<?php echo $style_values["form_file_button_background_hover_color"]; ?>; } .file-block:hover .uploadbutton i { color:#<?php echo $style_values["form_file_icon_hover_color"]; ?>; } .file-block input[type="file"] { height:30px; width:100%; position:absolute; top:0px; left:0px; opacity:0; cursor:pointer; } .captcha-block div { margin-right:-1px; } .buttons-block { <?php if($style_values["form_button_position"]=="left"){echo "text-align:left;";} else if ($style_values["form_button_position"]=="right"){echo "text-align:right;";} else {echo "text-align:center;";} ?> } .buttons-block button { height:auto; padding:<?php echo $style_values["form_button_padding"]; ?>px <?php echo $style_values["form_button_padding"]*2; ?>px <?php echo $style_values["form_button_padding"]; ?>px <?php echo $style_values["form_button_padding"]*2; ?>px; cursor:pointer; text-transform: none; <?php if($style_values["form_button_fullwidth"]=="on"){ ?> clear:both; width:100%; padding-left:0px; padding-right:0px; margin:0px 0px 0px 0px !important; padding-left:0px; padding-right:0px; <?php } ?> font-size:<?php echo $style_values["form_button_font_size"]; ?>px; } .buttons-block button.submit { color:#<?php echo $style_values["form_button_submit_font_color"]; ?> !important; background-color:#<?php echo $style_values["form_button_submit_background"]; ?> !important; border:<?php echo $style_values["form_button_submit_border_size"]; ?>px solid #<?php echo $style_values["form_button_submit_border_color"]; ?> !important; border-radius:<?php echo $style_values["form_button_submit_border_radius"]; ?>px !important; -webkit-transition: all 0.5s ease !important; transition: all 0.5s ease !important; margin:0px 0px 5px 0px !important; } .buttons-block button.submit:hover { color:#<?php echo $style_values["form_button_submit_font_hover_color"]; ?> !important; background:#<?php echo $style_values["form_button_submit_hover_background"]; ?> !important; } .buttons-block button.submit i { color:#<?php echo $style_values["form_button_submit_icon_color"]; ?> !important; vertical-align: baseline !important; font-size:<?php echo $style_values["form_button_font_size"]; ?>px !important; -webkit-transition: all 0.5s ease !important; transition: all 0.5s ease !important; } .buttons-block button.submit:hover i { color:#<?php echo $style_values["form_button_submit_icon_hover_color"]; ?> !important; } .buttons-block button.reset { color:#<?php echo $style_values["form_button_reset_font_color"]; ?> !important; background-color:#<?php echo $style_values["form_button_reset_background"]; ?> !important; border:<?php echo $style_values["form_button_reset_border_size"]; ?>px solid #<?php echo $style_values["form_button_reset_border_color"]; ?> !important; border-radius:<?php echo $style_values["form_button_reset_border_radius"]; ?>px !important; -webkit-transition: all 0.5s ease !important; transition: all 0.5s ease !important; } .buttons-block button.reset:hover { color:#<?php echo $style_values["form_button_reset_font_hover_color"]; ?> !important; background:#<?php echo $style_values["form_button_reset_hover_background"]; ?> !important; } .buttons-block button.reset i { color:#<?php echo $style_values["form_button_reset_icon_color"]; ?> !important; vertical-align: baseline !important; font-size:<?php echo $style_values["form_button_font_size"]; ?>px !important; -webkit-transition: all 0.5s ease !important; transition: all 0.5s ease !important; } .buttons-block button.reset:hover i { color:#<?php echo $style_values["form_button_reset_icon_hover_color"]; ?> !important; }

	<?php
	    return ob_get_clean();
	}
	//1 Textbox // Left Column
	function hugeit_contact_textBoxHtml($rowimages) { ob_start(); ?>
	    <div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?> </label>
			<div class="field-block input-text-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign'||$rowimages->hc_input_show_default=='formsInsideAlign')echo $rowimages->hc_input_show_default;?>">
                <?php if($rowimages->hc_input_show_default=='formsInsideAlign' && $rowimages->hc_required == 'on') $placeholder = $rowimages->name.' *';
                else $placeholder = $rowimages->name;?>
				<input id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" type="text" placeholder="<?php echo $placeholder;?>" class="<?php if($rowimages->hc_required == 'on'){echo 'required';}?>"  <?php if($rowimages->description != 'on'){echo 'disabled="disabled"';}?>/>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}
	//Text box Right Column
function hugeit_contact_textBoxSettingsHtml($rowimages){ ob_start(); ?>
    <li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>">
        <input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="Textbox"/>
        <input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
        <h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Textbox";} ?></h4>
        <div class="fields-options">
            <div class="left">
                <div>
                    <label class="input-block">Label:
                        <input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
                    </label>
                </div>
                <div>
                    <label class="input-block" for="form_label_position">Label Position:
                        <select id="form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
                            <option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
                            <option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
                            <option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
                            <option <?php if($rowimages->hc_input_show_default == 'formsInsideAlign'){ echo 'selected="selected"'; } ?> value="formsInsideAlign">Inside Placeholder</option>
                        </select>
                    </label>
                </div>
                <div>
                    <label class="input-block">Field Is Required:
                        <input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
                        <input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked="checked"';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on" />
                    </label>
                    <label class="input-block">Field Is Active:
                        <input type="hidden" name="im_description<?php echo absint($rowimages->id); ?>" value=""/>
                        <input class="fieldisactive" class="isactive" type="checkbox" <?php if($rowimages->description == 'on'){ echo 'checked="checked"';} ?> name="im_description<?php echo absint($rowimages->id); ?>" value="on" />
                    </label>
                </div>
            <!--Mask On-->
            <label class="input-block"><?php _e('Mask On','hugeit_contact'); ?>
                  <input type="checkbox" <?php if($rowimages->field_type == 'number') echo "disabled";?> class="hg-mask-on-check" <?php if(!empty(trim($rowimages->mask_on)) && $rowimages->field_type == 'text') echo "checked='checked'";  ?>>
                  <label class="hg-mask-on <?php if(empty(trim($rowimages->mask_on)) || $rowimages->field_type == 'number') echo "readonlyHgMask" ?>" >
                          <input  type="text" name="mask_on<?php echo absint($rowimages->id); ?>"  value="<?php echo $rowimages->mask_on; ?>" class="mask_on" placeholder="Mask Pattern (ex. (99)-999-99-9) " /><br>
                            <b>a</b><em>- (A-Z,a-z)</em> <br>
                            <b>9</b><em>- (0-9)</em><br>
                            <b>*</b><em>- (A-Z,a-z,0-9)</em>
                        </label>
            </label>
            <!--Mask On-->
            </div>
            <div class="left">
                <div>
                    <label class="input-block">Value If Empty:
                        <input class="placeholder text_area" type="text" name="titleimage<?php echo absint($rowimages->id); ?>" id="titleimage<?php echo absint($rowimages->id); ?>"  oldvalue="<?php echo esc_html($rowimages->name); ?>" value="<?php echo esc_html($rowimages->name); ?>">
                    </label>
                </div>
                <div>
                    <div class="input-block textbox_file_type">
                        <div>Field type:</div>
                        <label><input  type="radio" <?php if($rowimages->field_type == 'text'){ echo 'checked="checked"';} ?> name="field_type<?php echo absint($rowimages->id); ?>"  value="text" >Simple Text</label>
                        <label><input  type="radio" <?php if($rowimages->field_type == 'number'){ echo 'checked="checked"';} ?> name="field_type<?php echo absint($rowimages->id); ?>"  value="number" >Number</label>
                    </div>
                <div>
               <!-- Default Value -->
              <label class="input-block"><?php _e('Default Value','hugeit_contact'); ?>
                  <input class="hg-def-value"  type="text" name="def_value<?php echo absint($rowimages->id); ?>"  value="<?php echo $rowimages->def_value; ?>" <?php if(!empty(trim($rowimages->mask_on))) echo "readonly='readonly'"; ?>  />
              </label>
                <!-- Default Value -->
                </div>

                </div>
            </div>
            <div class="field-top-options-block">
                <a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
                <a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
                <a class="open-close" href="#"><span><p>Edit Field</p></span></a>
            </div>
        </div>

        <div class="clear"></div>
    </li>
    <?php
    return ob_get_clean();
}

	//2 Textarea //
    function hugeit_contact_textareaHtml($rowimages) { ob_start(); ?>
    	<div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?></label>
			<div class="field-block textarea-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign'||$rowimages->hc_input_show_default=='formsInsideAlign')echo esc_html($rowimages->hc_input_show_default);?>">
                <?php if($rowimages->hc_input_show_default=='formsInsideAlign' && $rowimages->hc_required == 'on') $placeholder = $rowimages->name.' *';
                else $placeholder = $rowimages->name;?>
				<textarea style="height:<?php echo $rowimages->hc_other_field;?>px;resize:<?php if($rowimages->field_type=='on'){echo 'vertical';}else{ echo 'none';}?>;" id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" <?php if($rowimages->description != 'on'){echo 'disabled="disabled"';}?> placeholder="<?php echo esc_html($placeholder); ?>"></textarea>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_textareaSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position"  name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="Textarea"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Textarea";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Field Label:
							<input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsInsideAlign'){ echo 'selected="selected"'; } ?> value="formsInsideAlign">Inside Placeholder</option>
							</select>
						</label>
					</div>
					<div>
						<label class="input-block">Field Is Required:
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked="checked"';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>
					<div>
						<label class="input-block">Field Is Active:
							<input type="hidden" name="im_description<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="fieldisactive" type="checkbox" <?php if($rowimages->description == 'on'){ echo 'checked="checked"';} ?> name="im_description<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>

                    <div>
                        <!-- Default Value -->
                        <label class="input-block"><?php _e('Default Value','hugeit_contact'); ?>
                            <input  type="text" name="def_value<?php echo absint($rowimages->id); ?>"  value="<?php echo $rowimages->def_value; ?>" class="def_value"  />
                        </label>
                        <!-- Default Value -->
                    </div>

				</div>
				<div class="left">
					<div>
						<label class="input-block">Value If Empty:
							<input class="placeholder" type="text" id="titleimage<?php echo absint($rowimages->id); ?>" name="titleimage<?php echo absint($rowimages->id); ?>" oldvalue="<?php echo esc_html($rowimages->name); ?>" value="<?php echo esc_html($rowimages->name); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block">Field Height Size:
							<input class="textarea-size" type="number" class="small" name="hc_other_field<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_other_field); ?>" />px
						</label>
					</div>
					<div>
						<label class="input-block">Field Resize Is Available:
							<input type="hidden" name="field_type<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="textarea-resize" type="checkbox" <?php if($rowimages->field_type == 'on'){ echo 'checked="checked"';} ?> name="field_type<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>
			<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}
	//3 Selectbox //
	function hugeit_contact_selectboxHtml($rowimages) { ob_start(); ?>
		<div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?></label>
			<div class="field-block selectbox-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign' || $rowimages->hc_input_show_default=='formsInsideAlign')echo esc_html($rowimages->hc_input_show_default);?>" >
                <?php $options=explode(';;',$rowimages->name);?>

                <?php if($rowimages->def_value && $rowimages->def_value!=''){
                    $optionValue = $rowimages->def_value;
                    if($rowimages->hc_required && $rowimages->hc_input_show_default=='formsInsideAlign') $optionValue .= ' *';
                } else {
                    $selectedOptionIndex = $rowimages->hc_other_field;
                    if( is_numeric($selectedOptionIndex) && isset($options[$selectedOptionIndex]) )  $optionValue = $options[$selectedOptionIndex];
                    else if(in_array($selectedOptionIndex,$options)) $optionValue = $selectedOptionIndex;
                    else $optionValue = $options[0];

                } ?>

                <input type="text" disabled="disabled" class="textholder" value="<?php echo esc_html($optionValue); ?>" />
				<select id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" >
					<?php
					 foreach($options as $opt_key => $option){
					?>
						<option <?php if($rowimages->def_value =='' && ($optionValue==$opt_key || $optionValue == $option)){
						    echo 'selected="selected"';
						} ?>><?php echo esc_html($option); ?></option>
					<?php } ?>
				</select>
				<i class="hugeicons-chevron-down"></i>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_selectboxSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position"  name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="Selectbox"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Selectbox";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Field Label:
							<input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsInsideAlign'){ echo 'selected="selected"'; } ?> value="formsInsideAlign">Inside Placeholder</option>
							</select>
						</label>
					</div>
                    <div>
                        <label class="input-block" for="form_label_position">Placeholder Option:
                            <input class="placeholder-option selectbox" type="text" name="def_value<?php echo absint($rowimages->id); ?>" id="def_value<?php echo absint($rowimages->id); ?>"   value="<?php echo esc_html($rowimages->def_value); ?>">
                        </label>
                    </div>
					<div>
						<label class="input-block">Field Is Required:
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on"/>
						</label>
					</div>
				</div>
				<div class="left secondBlock">
					<label class="input-block">Field Options:
                        <ul rel="<?php echo absint($rowimages->id); ?>" class="field-multiple-option-list selectbox">
                        <?php
                         $options=explode(';;',$rowimages->name);
                         foreach($options as $opt_key=>$option){
                        ?>
                            <li>
                                <input id="" class="field-multiple-option" type="text" name="fieldoption<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($option); ?>" />
                                <div class="set-active <?php if($rowimages->def_value == '' && ( trim($rowimages->hc_other_field) == $opt_key || trim($rowimages->hc_other_field)==$option) ){echo 'checked';} ?>" >
                                    <input type="radio" <?php if($rowimages->def_value=='' && ($rowimages->hc_other_field == $opt_key || trim($rowimages->hc_other_field)==$option)){echo 'checked="checked"';} ?> />
                                </div>
                                <a href="#remove" class="remove-field-option">remove</a>
                            </li>
                        <?php } ?>

                            <li>
                                <input class="field-multiple-option-all-values" name="titleimage<?php echo absint($rowimages->id); ?>" type="hidden" value="<?php echo esc_html($rowimages->name); ?>" />
                                <input class="add-new-name" type="text" id="titleimage"  value="" />
                                <a href="#" class="add-new">+</a>
                            </li>
                        </ul>
                        <input type="hidden" class="field-multiple-option-active-field" name="hc_other_field<?php echo absint($rowimages->id); ?>"  value="<?php echo esc_html($rowimages->hc_other_field); ?>" />
					</label>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>

				</div>
			</div>
		<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}
	//4 Checkbox //
	function hugeit_contact_checkboxHtml($rowimages,$themeId) { ob_start();
		global $wpdb;
		$themeId = sanitize_text_field($themeId);
		$query = "SELECT *  from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = '".$themeId."' ";
	    $rows = $wpdb->get_results($query);
	    $style_values = array();
	    foreach ($rows as $row) {
	        $key = $row->name;
	        $value = $row->value;
	        $style_values[$key] = $value;
	    }?>
		<div class="hugeit-field-block hugeit-check-field" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?></label>
			<div class="field-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign')echo esc_html($rowimages->hc_input_show_default);?>">
				<ul id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" class="hugeit-checkbox-list">
					<?php
					 $options=explode(';;',$rowimages->name);
					 $actives=explode(';;',$rowimages->hc_other_field);															
					 $i=0;
					 $j=0;
					 foreach($options as $key=>$option){?>
						<li style="width:<?php if($rowimages->field_type!=0){echo 100/intval($rowimages->field_type);}?>%;">
							<label class="secondary-label">
								<div class="checkbox-block big">
								<input <?php if(isset($actives[$j])&&$actives[$j]==''.$key.''){echo 'checked="checked"';$j++;} ?> type="checkbox" value="" <?php if($rowimages->description != 'on'){echo 'disabled="disabled"';}?>/>
									<?php if($style_values['form_checkbox_type']=='circle'){ ?>
										<i class="hugeicons-dot-circle-o active"></i>
										<i class="hugeicons-circle-o passive"></i>
									<?php }else{ ?>			
										<i class="hugeicons-check-square active"></i>
										<i class="hugeicons-square-o passive"></i>
									<?php }?>	
								</div>
								<span class="sublable"><?php echo esc_html($option); ?></span>
							</label>
						</li>
					<?php $i++; } ?>
				</ul>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_checkboxSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position"  name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="Checkbox"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Checkbox";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Field Label:
							<input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
							</select>
						</label>
					</div>
					<div>
						<label class="input-block">Field Is Required:
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked="checked"';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>
					<div>	
						<label class="input-block">Field(s) Is/Are Active:
							<input type="hidden" name="im_description<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="fieldisactive" type="checkbox" <?php if($rowimages->description == 'on'){ echo 'checked="checked"';} ?> name="im_description<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>
					<div>
						<label class="input-block">Columns Count:
							<input type="number" class="small field-columns-count" name="field_type<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->field_type); ?>" />
						</label>
					</div>
				</div>
				<div class="left secondBlock">
					<div>
						<label class="input-block">Field Options:
						<ul rel="<?php echo absint($rowimages->id); ?>" class="field-multiple-option-list checkbox">
						<?php
						 $options=explode(';;',$rowimages->name);
						 $actives=explode(';;',$rowimages->hc_other_field);
						 $i=0;
						 $j=0;
						 foreach($options as $key=>$option){
						?>
							<li>
								<input id="" class="field-multiple-option" type="text" value="<?php echo esc_html($option); ?>" />
								<div class="set-active <?php if(isset($actives[$j])&&$actives[$j]==''.$key.''){echo 'checked';$j++;} ?>" >
									<input type="hidden" class="field-multiple-option-active-field" name="hc_other_field<?php echo absint($rowimages->id); ?>"  value="<?php echo esc_html($rowimages->hc_other_field); ?>" />
									<input type="radio"  <?php if(trim($rowimages->hc_other_field)==$i){echo 'checked="checked"';} ?> name="options_active_<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($i); ?>" />
								</div>
								<a href="#remove" class="remove-field-option">remove</a>
							</li>
						<?php $i++; } ?>
							<li>
								<input class="field-multiple-option-all-values" type="hidden" name="titleimage<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->name); ?>" />
								<input class="add-new-name" type="text" id="titleimage<?php echo absint($rowimages->id); ?>"  value="" />
								<a href="#" class="add-new">+</a>
							</li>
						</ul>
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>
		<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}

function hugeit_contact_hiddenFieldHtml($rowimages,$themeId) { ob_start();
    global $wpdb;
    $themeId = sanitize_text_field($themeId);
    $query = $wpdb->prepare("SELECT *  from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = %s", $themeId);
    $rows = $wpdb->get_results($query);
    $style_values = array();
    foreach ($rows as $row) {
        $key = $row->name;
        $value = $row->value;
        $style_values[$key] = $value;
    }?>
    <div class="hugeit-field-block hugeit-check-field" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>" style="background-color: rgba(211, 211, 211, 0.45) !important; font-weight: bold !important; border-radius: 3px !important;">
        <label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>">
            <?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Hidden Field";} ?>
        </label>

        <div class="field-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign')echo esc_html($rowimages->hc_input_show_default);?>">
        </div>

        <span class="hugeit-error-message"></span>
        <span class="hugeOverlay"></span>
        <input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
        <input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
    </div>
    <?php
    return ob_get_clean();
}

function hugeit_contact_hiddenFieldSettingsHtml($rowimages) { ob_start(); ?>
    <li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>">
        <input type="hidden" class="left-right-position"  name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
        <input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
        <h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Hidden Field";} ?></h4>
        <div class="fields-options">

            <div class="left">
                <div>
                    <?php _e('Default Value: ','hugeit_contact');?><br>
                    <div class="input-block">
                        <input  type="hidden" name="imagess<?php echo absint($rowimages->id); ?>" value="Hidden Field">
                        <label for="user_id"><input  type="radio"  name="hc_other_field<?php echo absint($rowimages->id); ?>" id="user_id"  value="user_id" <?php if($rowimages->hc_other_field=="user_id"){echo 'checked="checked"';} ?> >User ID</label>
                        <br>
                        <label for="user_login"><input  type="radio"  name="hc_other_field<?php echo absint($rowimages->id); ?>" id="user_login"  value="user_login" <?php if($rowimages->hc_other_field=="user_login"){echo 'checked="checked"';} ?> >Username</label>
                        <br>
                        <label for="user_email"><input  type="radio"  name="hc_other_field<?php echo absint($rowimages->id); ?>"  id="user_email"  value="user_email" <?php if($rowimages->hc_other_field=="user_email"){echo 'checked="checked"';} ?>>User Email</label>
                        <br>
                        <label for="user_ip"><input  type="radio"  name="hc_other_field<?php echo absint($rowimages->id); ?>" id="user_ip"  value="ip_address" <?php if($rowimages->hc_other_field=="ip_address"){echo 'checked="checked"';} ?>>IP Address</label>
                    </div>
                </div>
            </div>

            <div class="field-top-options-block">
                <a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
                <a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
                <a class="open-close" href="#"><span><p>Edit Field</p></span></a>
            </div>
        </div>
        <div class="clear"></div>
    </li>
    <?php
    return ob_get_clean();
}
function hugeit_contact_pageBreakHtml($rowimages,$themeId) { ob_start();
    global $wpdb;
    $themeId = sanitize_text_field($themeId);
    $query = "SELECT *  from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = '".$themeId."' ";
    $rows = $wpdb->get_results($query);
    $style_values = array();
    foreach ($rows as $row) {
        $key = $row->name;
        $value = $row->value;
        $style_values[$key] = $value;
    }?>
    <div class="hugeit-field-block hugeit-check-field" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>"  style="text-align: center!important;font-weight: bold!important;">
        <hr>
        <label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" style="width:100%!important;">
            <?php echo esc_textarea("Page Break");  ?>
        </label>
        <div class="field-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign')echo esc_html($rowimages->hc_input_show_default);?>">
        </div>

        <span class="hugeit-error-message"></span>
        <span class="hugeOverlay"></span>
        <input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
        <input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
    </div>
    <?php
    return ob_get_clean();
}
function hugeit_contact_pageBreakSettingsHtml($rowimages) { ob_start(); ?>
    <li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>">
        <input type="hidden" class="left-right-position"  name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
        <input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
        <h4><?php echo esc_textarea("Page Break"); ?></h4>
        <div class="fields-options">

            <div class="left">
            </div>

            <div class="field-top-options-block">
                <a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
            </div>
        </div>
        <div class="clear"></div>
    </li>
    <?php
    return ob_get_clean();
}
	//5 Radiobox //
	function hugeit_contact_radioboxHtml($rowimages, $themeId) { ob_start();
		$themeId = sanitize_text_field($themeId);
		global $wpdb;
		$query = "SELECT *  from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = '".$themeId."' ";
	    $rows = $wpdb->get_results($query);
	    $style_values = array();
	    foreach ($rows as $row) {
	        $key = $row->name;
	        $value = $row->value;
	        $style_values[$key] = $value;
	    }?>
		<div class="hugeit-field-block hugeit-radio-field" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';}?></label>
			<div class="field-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign')echo esc_html($rowimages->hc_input_show_default);?>">
				<ul id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>">
					<?php
					 $options=explode(';;',$rowimages->name);
					 $i=0;
					 foreach($options as $option){
					?>
						<li style="width:<?php if($rowimages->description!=0){echo 100/$rowimages->description;}?>%;">
							<label class="secondary-label">
								<div class="radio-block big">
								<input <?php if(trim($rowimages->hc_other_field)==$i){echo 'checked="checked"';} ?> type="radio" name="preview_radio_<?php echo absint($rowimages->id); ?>" >
								
									<?php if($style_values['form_radio_type']=='circle'){ ?>
										<i class="hugeicons-dot-circle-o active"></i>
										<i class="hugeicons-circle-o passive"></i>
									<?php }else{ ?>			
										<i class="hugeicons-check-square active"></i>
										<i class="hugeicons-square-o passive"></i>
									<?php }?>	
								</div>
								<span class="sublable"><?php echo esc_html($option); ?></span>
							</label>
						</li>
					<?php $i++; } ?>
				</ul>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_radioboxSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"   data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position"   name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="Radiobox"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Radiobox";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Field Label:
							<input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
							</select>
						</label>
					</div>
					<div>
						<label class="input-block">Columns Count:
							<input type="number" class="small field-columns-count" type="text" name="im_description<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->description); ?>" />
						</label>
					</div>
				</div>
				<div class="left secondBlock">
					<div>
						<label class="input-block">Field Options:
						<ul rel="<?php echo absint($rowimages->id); ?>" class="field-multiple-option-list radio">
						<?php
						 $options=explode(';;',$rowimages->name);
						 $i=0;
						 foreach($options as $option){
						?>
							<li>
								<input id="" class="field-multiple-option" type="text" name="fieldoption<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($option); ?>" />
								<div class="set-active <?php if(trim($rowimages->hc_other_field)==$i){echo 'checked';} ?>" >
									<input type="hidden" class="field-multiple-option-active-field" name="hc_other_field<?php echo absint($rowimages->id); ?>"  value="<?php echo esc_html($rowimages->hc_other_field); ?>" />
									<input type="radio" <?php if(trim($rowimages->hc_other_field)==$i){echo 'checked="checked"';} ?> />
								</div>
								<a href="#remove" class="remove-field-option">remove</a>
							</li>
						<?php $i++; } ?>
							<li>
								<input class="field-multiple-option-all-values" type="hidden" name="titleimage<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->name); ?>" />
								<input class="add-new-name" type="text"  value="" />
								<a href="#" class="add-new">+</a>
							</li>
						</ul>
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>
		<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}
	//6 Filebox //
	function hugeit_contact_fileboxHtml($rowimages,$themeId) { ob_start();
		$themeId = sanitize_text_field($themeId);
		global $wpdb;
		$query = "SELECT *  from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = '".$themeId."' ";
	    $rows = $wpdb->get_results($query);
	    $style_values = array();
	    foreach ($rows as $row) {
	        $key = $row->name;
	        $value = $row->value;
	        $style_values[$key] = $value;
	    }?>
		<script>
		jQuery(document).ready(function(){
			function mbToBytes(mb){
				return Math.round(mb * 1048576 * 100000) / 100000;
			}
			var byteRes=mbToBytes(<?php echo $rowimages->name;?>);
			jQuery(".hugeit-contact-column-block input[name='MAX_FILE_SIZE']").attr('value',byteRes);
		});													
		</script>
		<div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo $rowimages->hc_input_show_default;?>" for="hugeit_preview_textbox_<?php echo htmlspecialchars($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?></label>
			<div class="field-block file-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign'||$rowimages->hc_input_show_default=='formsInsideAlign')echo esc_html($rowimages->hc_input_show_default);?>">
				<input type="text" class="textholder" placeholder="<?php if($rowimages->hc_input_show_default=='formsInsideAlign') echo esc_html($rowimages->hc_field_label);?>"/>
				<span class="uploadbutton">
					<?php if($style_values['form_file_has_icon']=='on'):?>
					<?php if($style_values['form_file_icon_position']=="left"){?><i class="<?php echo esc_html($style_values['form_file_icon_style']); ?>"></i><?php } ?>
					<?php endif;?>
					<?php echo esc_html($style_values['form_file_button_text']);?>
					<?php if($style_values['form_file_has_icon']=='on'):?>
					<?php if($style_values['form_file_icon_position']=="right"){?><i class="<?php echo esc_html($style_values['form_file_icon_style']); ?>"></i><?php }?>
					<?php endif;?>
				</span>
				<input type="hidden" name="MAX_FILE_SIZE" value="" />
				<input id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" type="file" name="userfile"/>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_fileboxSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position"   name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="Filebox"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Filebox";} ?></h4>
			<div class="fields-options">					
				<div class="left">
					<div>
						<label class="input-block">Field Label:
							<input class="label"  type="text" name="imagess<?php echo htmlspecialchars($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsInsideAlign'){ echo 'selected="selected"'; } ?> value="formsInsideAlign">Inside Placeholder</option>
							</select>
						</label>
					</div>
					<div>
						<label class="input-block">Allowed files:
							<textarea class="text_area" type="hidden" name="hc_other_field<?php echo absint($rowimages->id); ?>" rows="3" cols="45" name="text"><?php echo esc_html($rowimages->hc_other_field); ?></textarea>
						</label>
					</div>
				</div>
				<div class="left">
					<div>
						<label class="input-block">Field Maximum Size(MB):
							<input class="text_area" type="number" name="titleimage<?php echo absint($rowimages->id); ?>" id="titleimage<?php echo absint($rowimages->id); ?>"  value="<?php echo esc_html($rowimages->name); ?>">
						</label>
					</div>
					<div>
						<label class="input-block">Upload File Directory:
							<input class="text_area" type="text" name="field_type<?php echo absint($rowimages->id); ?>"  value="<?php echo esc_html($rowimages->field_type); ?>" >
						</label>
					</div>
					<div>
						<label>Field Is Required:
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked="checked"';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on"/>
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>
		<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}
	//7 Custom Text //
	function hugeit_contact_cutomtextHtml($rowimages) { ob_start(); ?>
		<div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<div class="custom_text_content"><?php echo $rowimages->name; ?></div>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_cutomtextSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"   data-fieldNum="<?php echo absint($rowimages->id); ?>" data-fieldType="custom_text">
			<input type="hidden" class="left-right-position"   name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4>Custom Text</h4>
			<div class="fields-options">	
				<div class="left tinymce_custom_text">
					<?php	wp_editor($rowimages->name, "titleimage".$rowimages->id); ?>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>
			<div class="clear"></div>
		</li>
		<script>
					function editorchange(value){
						var fieldid=jQuery('.fields-list li.open').attr('id');
						var previewfield=jQuery('.hugeit-contact-column-block > div[rel="'+fieldid+'"]');										
						previewfield.find('.custom_text_content').html(value);
					}
					jQuery('#fields-list-block').on('keyup','#wp-titleimage'+<?php echo absint($rowimages->id); ?>+'-wrap',function(){

						var value=jQuery('#titleimage'+<?php echo absint($rowimages->id); ?>).val();
						jQuery(this).attr('value',value);
						editorchange(value);
					});													
		</script>
	<?php
	    return ob_get_clean();
	}
	//8 ReCaptcha //
	function hugeit_contact_captchaHtml($rowimages) { ob_start(); ?>
		<div class="hugeit-field-block captcha-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<?php $capPos='right';if($rowimages->hc_input_show_default=='2')$capPos="left";?>
			<div <?php if($rowimages->hc_required=='dark'){echo 'style="display:none"';}else{echo 'style="float:'.$capPos.'"';}?> id="democaptchalight"></div>
			<div <?php if($rowimages->hc_required=='light'){echo 'style="display:none"';}else{echo 'style="float:'.$capPos.'"';}?> id="democaptchadark"></div>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_captchaSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>" data-fieldType="captcha">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4>ReCaptcha</h4>
			<div class="fields-options">
				<div class="left">
					<label class="input-block">ReCaptcha Type
						<select name="titleimage<?php echo absint($rowimages->id); ?>">
							<option <?php if($rowimages->name == 'image'){ echo 'selected="selected"'; } ?> value="image">Image</option>
							<option <?php if($rowimages->name == 'audio'){ echo 'selected="selected"'; } ?> value="audio">Audio</option>
						</select>
					</label>
					<label class="input-block">ReCaptcha Position
						<select class="captcha_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
							<option <?php if($rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="1">Right</option>
							<option <?php if($rowimages->hc_input_show_default == '2'){ echo 'selected="selected"'; } ?> value="2">Left</option>
						</select>
					</label>
				</div>	
				<div class="left">
					<label class="input-block">ReCaptcha Theme
						<select class="hugeit_contact_captcha_theme" name="hc_required<?php echo absint($rowimages->id); ?>">
							<option <?php if($rowimages->hc_required == 'dark'){ echo 'selected="selected"'; } ?> value="dark">Dark</option>
							<option <?php if($rowimages->hc_required == 'light'){ echo 'selected="selected"'; } ?> value="light">Light</option>
						</select>
					</label>
				</div>	
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>
			<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}

//8.1 Simple Captcha //
//Simple Captcha DEMO HTML(Right Column)
function hugeit_contact_simple_captcha_html($rowimages,$formid) { ob_start(); ?>
	<?php $capPos='text-left';if($rowimages->hc_input_show_default=='formsRightAlign')$capPos="text-right";?>
    <?php $hc_other_field = json_decode($rowimages->hc_other_field);?>
	<div class="hugeit-field-block simple-captcha-block <?php echo esc_html($capPos);?>" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
		<label class="formsAboveAlign">
			<img src="<?php echo hugeit_contact_create_new_captcha($rowimages->id,'admin');?>">
			<span class="hugeit_captcha_refresh_button" data-captcha-id="<?php echo absint($rowimages->id);?>" data-digits="<?php echo isset($hc_other_field->digits)?esc_html($hc_other_field->digits):5;?>" data-form-id="<?php echo esc_html($formid); ?>">
				<img src="<?php echo plugin_dir_url(__FILE__);?>../images/refresh-icon.png" width="32px">
			</span>
		</label>
		<div class="field-block">
			<input type="text" name="simple_captcha" placeholder="<?php echo esc_html($rowimages->name);?>">
		</div>

		<span class="hugeOverlay"></span>
		<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
		<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />

	</div>
	<?php
	return ob_get_clean();
}

// Simple Captcha Field HTML(Left Column)
function hugeit_contact_simple_captcha_settings_html($rowimages) { ob_start(); ?>
	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"  data-fieldNum="<?php echo absint($rowimages->id); ?>" data-fieldType="simple_captcha_box">
		<h4>Simple Captcha</h4>
		<div class="fields-options">
			<div class="left">
				<label class="input-block">Simple Captcha Digits(3-7)
					<?php $hc_other_field=json_decode($rowimages->hc_other_field);?>
					<input type="number" min="3" max="7" name="hc_other_field<?php echo absint($rowimages->id); ?>[digits]" value="<?php echo (isset($hc_other_field->digits))?$hc_other_field->digits:5;?>">
				</label>
				<label class="input-block">Simple Captcha Position
					<select id="form_label_position" class="simple_captcha_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
						<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' ){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
						<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
					</select>
				</label>
			</div>
			<div class="left">
				<label class="input-block">Input Placeholder
					<input class='placeholder' type="text" name="titleimage<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->name);?>">
				</label>
				<label class="input-block">Color Settings
					<br>
					<label><input type="radio" <?php if($rowimages->description == 'default') echo 'checked';?> name="im_description<?php echo absint($rowimages->id); ?>" value="default" class="default-custom">Default</label>
					<label><input type="radio" <?php if($rowimages->description == 'custom') echo 'checked';?> name="im_description<?php echo absint($rowimages->id); ?>" value="custom" class="default-custom">Custom</label>

					<input <?php if($rowimages->description == 'default') echo 'disabled';?> class='custom-option color' type="text" style="margin-top:10px; width:90%;" value="<?php echo (isset($hc_other_field->color))?$hc_other_field->color:'FF601C';?>" name="hc_other_field<?php echo absint($rowimages->id); ?>[color]">

				</label>

			</div>

			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />

			<div class="field-top-options-block">
				<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
				<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
			</div>
		</div>
		<div class="clear"></div>
	</li>
	<?php
	return ob_get_clean();
}




	//9 Buttons //
	function hugeit_contact_buttonsHtml($rowimages,$themeId) { ob_start();
		$themeId = sanitize_text_field($themeId);
		global $wpdb;
		$query = "SELECT * from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = '".$themeId."' ";
	    $rows = $wpdb->get_results($query);
	    $style_values = array();
	    foreach ($rows as $row) {
	        $key = $row->name;
	        $value = $row->value;
	        $style_values[$key] = $value;
	    }
		?>
		<div class="hugeit-field-block buttons-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<button type="submit" class="submit" id="hugeit_preview_button__submit_<?php echo absint($rowimages->id);?>" value="Submit">

				<?php if($style_values['form_button_icons_position']=="left" and $style_values['form_button_submit_has_icon']=="on"){
				    ?><i class="<?php echo esc_html($style_values['form_button_submit_icon_style']); ?>"></i><?php
				}?>

				<?php echo esc_html($rowimages->description); ?>

				<?php if($style_values['form_button_icons_position']=="right" and $style_values['form_button_submit_has_icon']=="on"){
				    ?><i class="<?php echo esc_html($style_values['form_button_submit_icon_style']); ?>"></i><?php
				}?>

			</button>
			<button type="reset" class="reset" <?php if($rowimages->hc_required!='checked') echo 'style="display: none;"'?> id="hugeit_preview_button_reset_<?php echo absint($rowimages->id);?>" value="Reset">
				<?php if($style_values['form_button_icons_position']=="left" and $style_values['form_button_reset_has_icon']=="on"){?><i class="<?php echo esc_html($style_values['form_button_reset_icon_style']); ?>"></i><?php }?>
				<?php echo esc_html($rowimages->hc_field_label); ?>
				<?php if($style_values['form_button_icons_position']=="right" and $style_values['form_button_reset_has_icon']=="on"){?><i class="<?php echo esc_html($style_values['form_button_reset_icon_style']); ?>"></i><?php }?>
			</button>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_buttonsSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>"   data-fieldNum="<?php echo absint($rowimages->id); ?>" data-fieldType="buttons">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4>Buttons</h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Submit Button Text:
							<input class="submitbutton" type="text" name="im_description<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->description); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block">Actions After Submission:
							<select id="form_checkbox_size" name="hc_other_field<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_other_field == 'go_to_url'){ echo 'selected="selected"'; } ?> value="go_to_url">Go To Url</option>
								<option <?php if($rowimages->hc_other_field == 'print_success_message'){ echo 'selected="selected"'; } ?> value="print_success_message">Print Success Message</option>
								<option <?php if($rowimages->hc_other_field == 'refresh_page'){ echo 'selected="selected"'; } ?> value="refresh_page">Refresh Page</option>
							</select>
						</label>							
					</div>
					<div id="go_to_url_field" <?php if($rowimages->hc_other_field != 'go_to_url'){ echo "style='display:none;'";}?>>
						<label class="input-block">Go To This Url:
							<input class="" type="text" name="field_type<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->field_type); ?>" />
						</label>
					</div>
				</div>
				<div class="left">
					<div>
						<label class="input-block">Reset Button Text:
							<input class="resetbutton" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label>Show Reset Button
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="showresetbutton" class="required" type="checkbox" <?php if($rowimages->hc_required == 'checked'){ echo 'checked';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="checked"/>
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>
			<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}
	//10 Email //
	function hugeit_contact_emailHtml($rowimages) { ob_start(); ?>
		<div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?> </label>
			<div class="field-block input-text-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign'||$rowimages->hc_input_show_default=='formsInsideAlign')echo esc_html($rowimages->hc_input_show_default);?>">

                <?php if($rowimages->hc_input_show_default=='formsInsideAlign' && $rowimages->hc_required == 'on') $placeholder = $rowimages->name.' *';
                else $placeholder = $rowimages->name;?>

				<input id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" type="email" placeholder="<?php echo esc_html($placeholder);?>" class="<?php if($rowimages->hc_required == 'on'){echo 'required';}?>"  <?php if($rowimages->description != 'on'){echo 'disabled="disabled"';}?>/>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_emailSettingsHtml($rowimages) { ob_start(); ?>
    	<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>" data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="Email"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Email";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Label:
							<input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsInsideAlign'){ echo 'selected="selected"'; } ?> value="formsInsideAlign">Inside Placeholder</option>
							</select>
						</label>
					</div>
					<div>
						<label class="input-block">Field Is Required:
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked="checked"';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
						<label class="input-block">Field Is Active:
							<input type="hidden" name="im_description<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="fieldisactive" class="isactive" type="checkbox" <?php if($rowimages->description == 'on'){ echo 'checked="checked"';} ?> name="im_description<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>										
				</div>
				<div class="left">
					<div>
						<label class="input-block">Value If Empty:
							<input class="placeholder" class="placeholder" class="text_area" type="text" name="titleimage<?php echo absint($rowimages->id); ?>" id="titleimage<?php echo absint($rowimages->id); ?>"  oldvalue="<?php echo esc_html($rowimages->name); ?>"  value="<?php echo esc_html($rowimages->name); ?>">
						</label>
					</div>
                    <div>
                        <!-- Default Value -->
                        <label class="input-block"><?php _e('Default Value','hugeit_contact'); ?>
                            <input  type="text" name="def_value<?php echo absint($rowimages->id); ?>"  value="<?php echo $rowimages->def_value; ?>" class="def_value"  />
                        </label>
                        <!-- Default Value -->
                    </div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>			
			<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}

	//Ready to Go Fields

	//11 Name
	function hugeit_contact_nameSurnameHtml($rowimages) { ob_start(); ?>
		<div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?> </label>
			<div class="field-block input-name-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign'||$rowimages->hc_input_show_default=='formsLabelHide')echo esc_html($rowimages->hc_input_show_default);?>">
				<input id="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>" type="text" placeholder="<?php echo esc_html($rowimages->name); ?>" class="pl_name <?php if($rowimages->hc_required == 'on'){echo 'required';}?>"  <?php if($rowimages->description != 'on'){echo 'disabled="disabled"';}?>/>
				<input id="hugeit_preview_textbox_1<?php echo absint($rowimages->id);?>" type="text" placeholder="<?php echo esc_html($rowimages->hc_other_field); ?>" class="pl_surname <?php if($rowimages->hc_required == 'on'){echo 'required';}?>"  <?php if($rowimages->description != 'on'){echo 'disabled="disabled"';}?>/>
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_nameSurnameSettingsHtml($rowimages){ob_start(); ?>
		<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>" data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="nameSurname"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Fullname";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Label:
							<input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block">Name Placeholder:
							<input class="placeholderName" class="text_area" type="text" name="titleimage<?php echo absint($rowimages->id); ?>" id="titleimage<?php echo absint($rowimages->id); ?>"  oldvalue="<?php echo esc_html($rowimages->name); ?>" value="<?php echo esc_html($rowimages->name); ?>">
						</label>
					</div>						
					<div>
						<label class="input-block">Fields Are Required:
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked="checked"';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
						<label class="input-block">Field Is Active:
							<input type="hidden" name="im_description<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="fieldisactive" class="isactive" type="checkbox" <?php if($rowimages->description == 'on'){ echo 'checked="checked"';} ?> name="im_description<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>														
				</div>
				<div class="left">
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="ready_form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsLabelHide'){ echo 'selected="selected"'; } ?> value="formsLabelHide">Hide Label</option>
							</select>
						</label>
					</div>
					<div>
						<label class="input-block">Surname Placeholder:
							<input class="placeholderSur" class="text_area" type="text" name="hc_other_field<?php echo absint($rowimages->id); ?>" id="hc_other_field<?php echo absint($rowimages->id); ?>"  oldvalue="<?php echo esc_html($rowimages->hc_other_field); ?>" value="<?php echo esc_html($rowimages->hc_other_field); ?>">
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>			
			<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}

	//12 Phone
	function hugeit_contact_phoneHtml($rowimages) { ob_start(); ?>
		<div class="hugeit-field-block" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<label class="<?php if($rowimages->hc_input_show_default!='1')echo esc_html($rowimages->hc_input_show_default);?>" for="hugeit_preview_textbox_<?php echo absint($rowimages->id);?>"><?php echo esc_html($rowimages->hc_field_label); if($rowimages->hc_required == 'on'){ echo '<em class="required-star">*</em>';} ?> </label>
			<div class="field-block ready-phone-block <?php if($rowimages->hc_input_show_default=='formsAboveAlign'||$rowimages->hc_input_show_default=='formsInsideAlign')echo
esc_html($rowimages->hc_input_show_default);?>">
                <?php if($rowimages->hc_input_show_default=='formsInsideAlign' && $rowimages->hc_required == 'on') $placeholder = $rowimages->hc_other_field.' *';
                else $placeholder = $rowimages->hc_other_field;?>
				<input type="tel" class="readyPhone" id="formsPhone<?php echo absint($rowimages->id); ?>" placeholder="<?php echo esc_html($placeholder); ?>">
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" />
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery('#formsPhone<?php echo absint($rowimages->id); ?>').ForceNumericOnly();
				jQuery('#formsPhone<?php echo absint($rowimages->id); ?>').intlTelInput({autoFormat: true,nationalMode:false,numberType: "MOBILE",autoHideDialCode: true,preferredCountries: [ "<?php echo $rowimages->name; ?>" ]});
			});
		</script>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_phoneSettingsHtml($rowimages){ob_start(); ?>
		<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>" data-fieldNum="<?php echo absint($rowimages->id); ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_left_right); ?>" fileType="nameSurname"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->ordering); ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo esc_html($rowimages->hc_field_label);}else{ echo "Phone";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Label:
							<input class="label" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo esc_html($rowimages->hc_field_label); ?>" />
						</label>
					</div>
					<div>
						<label class="input-block" for="form_label_position">Label Position:
							<select id="ready_form_label_position" name="hc_input_show_default<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_input_show_default == 'formsLeftAlign' || $rowimages->hc_input_show_default == '1'){ echo 'selected="selected"'; } ?> value="formsLeftAlign">Left Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsRightAlign'){ echo 'selected="selected"'; } ?> value="formsRightAlign">Right Align</option>
								<option <?php if($rowimages->hc_input_show_default == 'formsAboveAlign'){ echo 'selected="selected"'; } ?> value="formsAboveAlign">Above Field</option>
							</select>
						</label>
					</div>						
					<div>
						<label class="input-block">Field Is Required:
							<input type="hidden" name="hc_required<?php echo absint($rowimages->id); ?>" value=""/>
							<input class="required" type="checkbox" <?php if($rowimages->hc_required == 'on'){ echo 'checked="checked"';} ?> name="hc_required<?php echo absint($rowimages->id); ?>" value="on" />
						</label>
					</div>														
				</div>
				<div class="left">
					<div>
						<label class="input-block">Placeholder:
							<input class="placeholder" class="placeholder" class="text_area" type="text" name="hc_other_field<?php echo absint($rowimages->id); ?>" id="hc_other_field<?php echo absint($rowimages->id); ?>"  oldvalue="<?php echo esc_html($rowimages->hc_other_field); ?>"  value="<?php echo esc_html($rowimages->hc_other_field); ?>">
						</label>
					</div>
					<div>
						<label class="input-block" for="form_phone">Default Country:
							<select id="form_phone" class="country-list" name="titleimage<?php echo absint($rowimages->id); ?>">
								<option <?php selected( "af", $rowimages->name , true ); ?> value="af">Afghanistan (‫افغانستان‬‎)</option>
								<option <?php selected( "al", $rowimages->name , true ); ?> value="al">Albania (Shqipëri)</option>
								<option <?php selected( "dz", $rowimages->name , true ); ?> value="dz">Algeria (‫الجزائر‬‎)</option>
								<option <?php selected( "as", $rowimages->name , true ); ?> value="as">American Samoa</option>
								<option <?php selected( "ad", $rowimages->name , true ); ?> value="ad">Andorra</option>
								<option <?php selected( "ao", $rowimages->name , true ); ?> value="ao">Angola</option>
								<option <?php selected( "ai", $rowimages->name , true ); ?> value="ai">Anguilla</option>
								<option <?php selected( "ag", $rowimages->name , true ); ?> value="ag">Antigua and Barbuda</option>
								<option <?php selected( "ar", $rowimages->name , true ); ?> value="ar">Argentina</option>
								<option <?php selected( "am", $rowimages->name , true ); ?> value="am">Armenia (Հայաստան)</option>
								<option <?php selected( "aw", $rowimages->name , true ); ?> value="aw">Aruba</option>
								<option <?php selected( "au", $rowimages->name , true ); ?> value="au">Australia</option>
								<option <?php selected( "at", $rowimages->name , true ); ?> value="at">Austria (Österreich)</option>
								<option <?php selected( "az", $rowimages->name , true ); ?> value="az">Azerbaijan (Azərbaycan)</option>
								<option <?php selected( "bs", $rowimages->name , true ); ?> value="bs">Bahamas</option>
								<option <?php selected( "bh", $rowimages->name , true ); ?> value="bh">Bahrain (‫البحرين‬‎)</option>
								<option <?php selected( "bd", $rowimages->name , true ); ?> value="bd">Bangladesh (বাংলাদেশ)</option>
								<option <?php selected( "bb", $rowimages->name , true ); ?> value="bb">Barbados</option>
								<option <?php selected( "by", $rowimages->name , true ); ?> value="by">Belarus (Беларусь)</option>
								<option <?php selected( "be", $rowimages->name , true ); ?> value="be">Belgium (België)</option>
								<option <?php selected( "bz", $rowimages->name , true ); ?> value="bz">Belize</option>
								<option <?php selected( "bj", $rowimages->name , true ); ?> value="bj">Benin (Bénin)</option>
								<option <?php selected( "bm", $rowimages->name , true ); ?> value="bm">Bermuda</option>
								<option <?php selected( "bt", $rowimages->name , true ); ?> value="bt">Bhutan (འབྲུག)</option>
								<option <?php selected( "bo", $rowimages->name , true ); ?> value="bo">Bolivia</option>
								<option <?php selected( "ba", $rowimages->name , true ); ?> value="ba">Bosnia and Herzegovina (Босна и Херцеговина)</option>
								<option <?php selected( "bw", $rowimages->name , true ); ?> value="bw">Botswana</option>
								<option <?php selected( "br", $rowimages->name , true ); ?> value="br">Brazil (Brasil)</option>
								<option <?php selected( "io", $rowimages->name , true ); ?> value="io">British Indian Ocean Territory</option>
								<option <?php selected( "vg", $rowimages->name , true ); ?> value="vg">British Virgin Islands</option>
								<option <?php selected( "bn", $rowimages->name , true ); ?> value="bn">Brunei</option>
								<option <?php selected( "bg", $rowimages->name , true ); ?> value="bg">Bulgaria (България)</option>
								<option <?php selected( "bf", $rowimages->name , true ); ?> value="bf">Burkina Faso</option>
								<option <?php selected( "bi", $rowimages->name , true ); ?> value="bi">Burundi (Uburundi)</option>
								<option <?php selected( "kh", $rowimages->name , true ); ?> value="kh">Cambodia (កម្ពុជា)</option>
								<option <?php selected( "cm", $rowimages->name , true ); ?> value="cm">Cameroon (Cameroun)</option>
								<option <?php selected( "ca", $rowimages->name , true ); ?> value="ca">Canada</option>
								<option <?php selected( "cv", $rowimages->name , true ); ?> value="cv">Cape Verde (Kabu Verdi)</option>
								<option <?php selected( "bq", $rowimages->name , true ); ?> value="bq">Caribbean Netherlands</option>
								<option <?php selected( "ky", $rowimages->name , true ); ?> value="ky">Cayman Islands</option>
								<option <?php selected( "cf", $rowimages->name , true ); ?> value="cf">Central African Republic (République centrafricaine)</option>
								<option <?php selected( "td", $rowimages->name , true ); ?> value="td">Chad (Tchad)</option>
								<option <?php selected( "cl", $rowimages->name , true ); ?> value="cl">Chile</option>
								<option <?php selected( "cn", $rowimages->name , true ); ?> value="cn">China (中国)</option>
								<option <?php selected( "cx", $rowimages->name , true ); ?> value="cx">Christmas Island</option>
								<option <?php selected( "cc", $rowimages->name , true ); ?> value="cc">Cocos (Keeling) Islands</option>
								<option <?php selected( "co", $rowimages->name , true ); ?> value="co">Colombia</option>
								<option <?php selected( "km", $rowimages->name , true ); ?> value="km">Comoros (‫جزر القمر‬‎)</option>
								<option <?php selected( "cd", $rowimages->name , true ); ?> value="cd">Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)</option>
								<option <?php selected( "cg", $rowimages->name , true ); ?> value="cg">Congo (Republic) (Congo-Brazzaville)</option>
								<option <?php selected( "ck", $rowimages->name , true ); ?> value="ck">Cook Islands</option>
								<option <?php selected( "cr", $rowimages->name , true ); ?> value="cr">Costa Rica</option>
								<option <?php selected( "ci", $rowimages->name , true ); ?> value="ci">Côte d’Ivoire</option>
								<option <?php selected( "hr", $rowimages->name , true ); ?> value="hr">Croatia (Hrvatska)</option>
								<option <?php selected( "cu", $rowimages->name , true ); ?> value="cu">Cuba</option>
								<option <?php selected( "cw", $rowimages->name , true ); ?> value="cw">Curaçao</option>
								<option <?php selected( "cy", $rowimages->name , true ); ?> value="cy">Cyprus (Κύπρος)</option>
								<option <?php selected( "cz", $rowimages->name , true ); ?> value="cz">Czech Republic (Česká republika)</option>
								<option <?php selected( "dk", $rowimages->name , true ); ?> value="dk">Denmark (Danmark)</option>
								<option <?php selected( "dj", $rowimages->name , true ); ?> value="dj">Djibouti</option>
								<option <?php selected( "dm", $rowimages->name , true ); ?> value="dm">Dominica</option>
								<option <?php selected( "do", $rowimages->name , true ); ?> value="do">Dominican Republic (República Dominicana)</option>
								<option <?php selected( "ec", $rowimages->name , true ); ?> value="ec">Ecuador</option>
								<option <?php selected( "eg", $rowimages->name , true ); ?> value="eg">Egypt (‫مصر‬‎)</option>
								<option <?php selected( "sv", $rowimages->name , true ); ?> value="sv">El Salvador</option>
								<option <?php selected( "gq", $rowimages->name , true ); ?> value="gq">Equatorial Guinea (Guinea Ecuatorial)</option>
								<option <?php selected( "er", $rowimages->name , true ); ?> value="er">Eritrea</option>
								<option <?php selected( "ee", $rowimages->name , true ); ?> value="ee">Estonia (Eesti)</option>
								<option <?php selected( "et", $rowimages->name , true ); ?> value="et">Ethiopia</option>
								<option <?php selected( "fk", $rowimages->name , true ); ?> value="fk">Falkland Islands (Islas Malvinas)</option>
								<option <?php selected( "fo", $rowimages->name , true ); ?> value="fo">Faroe Islands (Føroyar)</option>
								<option <?php selected( "fj", $rowimages->name , true ); ?> value="fj">Fiji</option>
								<option <?php selected( "fi", $rowimages->name , true ); ?> value="fi">Finland (Suomi)</option>
								<option <?php selected( "fr", $rowimages->name , true ); ?> value="fr">France</option>
								<option <?php selected( "gf", $rowimages->name , true ); ?> value="gf">French Guiana (Guyane française)</option>
								<option <?php selected( "pf", $rowimages->name , true ); ?> value="pf">French Polynesia (Polynésie française)</option>
								<option <?php selected( "ga", $rowimages->name , true ); ?> value="ga">Gabon</option>
								<option <?php selected( "gm", $rowimages->name , true ); ?> value="gm">Gambia</option>
								<option <?php selected( "ge", $rowimages->name , true ); ?> value="ge">Georgia (საქართველო)</option>
								<option <?php selected( "de", $rowimages->name , true ); ?> value="de">Germany (Deutschland)</option>
								<option <?php selected( "gh", $rowimages->name , true ); ?> value="gh">Ghana (Gaana)</option>
								<option <?php selected( "gi", $rowimages->name , true ); ?> value="gi">Gibraltar</option>
								<option <?php selected( "gr", $rowimages->name , true ); ?> value="gr">Greece (Ελλάδα)</option>
								<option <?php selected( "gl", $rowimages->name , true ); ?> value="gl">Greenland (Kalaallit Nunaat)</option>
								<option <?php selected( "gd", $rowimages->name , true ); ?> value="gd">Grenada</option>
								<option <?php selected( "gp", $rowimages->name , true ); ?> value="gp">Guadeloupe</option>
								<option <?php selected( "gu", $rowimages->name , true ); ?> value="gu">Guam</option>
								<option <?php selected( "gt", $rowimages->name , true ); ?> value="gt">Guatemala</option>
								<option <?php selected( "gg", $rowimages->name , true ); ?> value="gg">Guernsey</option>
								<option <?php selected( "gn", $rowimages->name , true ); ?> value="gn">Guinea (Guinée)</option>
								<option <?php selected( "gw", $rowimages->name , true ); ?> value="gw">Guinea-Bissau (Guiné Bissau)</option>
								<option <?php selected( "gy", $rowimages->name , true ); ?> value="gy">Guyana</option>
								<option <?php selected( "ht", $rowimages->name , true ); ?> value="ht">Haiti</option>
								<option <?php selected( "hn", $rowimages->name , true ); ?> value="hn">Honduras</option>
								<option <?php selected( "hk", $rowimages->name , true ); ?> value="hk">Hong Kong (香港)</option>
								<option <?php selected( "hu", $rowimages->name , true ); ?> value="hu">Hungary (Magyarország)</option>
								<option <?php selected( "is", $rowimages->name , true ); ?> value="is">Iceland (Ísland)</option>
								<option <?php selected( "in", $rowimages->name , true ); ?> value="in">India (भारत)</option>
								<option <?php selected( "id", $rowimages->name , true ); ?> value="id">Indonesia</option>
								<option <?php selected( "ir", $rowimages->name , true ); ?> value="ir">Iran (‫ایران‬‎)</option>
								<option <?php selected( "iq", $rowimages->name , true ); ?> value="iq">Iraq (‫العراق‬‎)</option>
								<option <?php selected( "ie", $rowimages->name , true ); ?> value="ie">Ireland</option>
								<option <?php selected( "im", $rowimages->name , true ); ?> value="im">Isle of Man</option>
								<option <?php selected( "il", $rowimages->name , true ); ?> value="il">Israel (‫ישראל‬‎)</option>
								<option <?php selected( "it", $rowimages->name , true ); ?> value="it">Italy (Italia)</option>
								<option <?php selected( "jm", $rowimages->name , true ); ?> value="jm">Jamaica</option>
								<option <?php selected( "jp", $rowimages->name , true ); ?> value="jp">Japan (日本)</option>
								<option <?php selected( "je", $rowimages->name , true ); ?> value="je">Jersey</option>
								<option <?php selected( "jo", $rowimages->name , true ); ?> value="jo">Jordan (‫الأردن‬‎)</option>
								<option <?php selected( "kz", $rowimages->name , true ); ?> value="kz">Kazakhstan (Казахстан)</option>
								<option <?php selected( "ke", $rowimages->name , true ); ?> value="ke">Kenya</option>
								<option <?php selected( "ki", $rowimages->name , true ); ?> value="ki">Kiribati</option>
								<option <?php selected( "kw", $rowimages->name , true ); ?> value="kw">Kuwait (‫الكويت‬‎)</option>
								<option <?php selected( "kg", $rowimages->name , true ); ?> value="kg">Kyrgyzstan (Кыргызстан)</option>
								<option <?php selected( "la", $rowimages->name , true ); ?> value="la">Laos (ລາວ)</option>
								<option <?php selected( "lv", $rowimages->name , true ); ?> value="lv">Latvia (Latvija)</option>
								<option <?php selected( "lb", $rowimages->name , true ); ?> value="lb">Lebanon (‫لبنان‬‎)</option>
								<option <?php selected( "ls", $rowimages->name , true ); ?> value="ls">Lesotho</option>
								<option <?php selected( "lr", $rowimages->name , true ); ?> value="lr">Liberia</option>
								<option <?php selected( "ly", $rowimages->name , true ); ?> value="ly">Libya (‫ليبيا‬‎)</option>
								<option <?php selected( "li", $rowimages->name , true ); ?> value="li">Liechtenstein</option>
								<option <?php selected( "lt", $rowimages->name , true ); ?> value="lt">Lithuania (Lietuva)</option>
								<option <?php selected( "lu", $rowimages->name , true ); ?> value="lu">Luxembourg</option>
								<option <?php selected( "mo", $rowimages->name , true ); ?> value="mo">Macau (澳門)</option>
								<option <?php selected( "mk", $rowimages->name , true ); ?> value="mk">Macedonia (FYROM) (Македонија)</option>
								<option <?php selected( "mg", $rowimages->name , true ); ?> value="mg">Madagascar (Madagasikara)</option>
								<option <?php selected( "mw", $rowimages->name , true ); ?> value="mw">Malawi</option>
								<option <?php selected( "my", $rowimages->name , true ); ?> value="my">Malaysia</option>
								<option <?php selected( "mv", $rowimages->name , true ); ?> value="mv">Maldives</option>
								<option <?php selected( "ml", $rowimages->name , true ); ?> value="ml">Mali</option>
								<option <?php selected( "mt", $rowimages->name , true ); ?> value="mt">Malta</option>
								<option <?php selected( "mh", $rowimages->name , true ); ?> value="mh">Marshall Islands</option>
								<option <?php selected( "mq", $rowimages->name , true ); ?> value="mq">Martinique</option>
								<option <?php selected( "mr", $rowimages->name , true ); ?> value="mr">Mauritania (‫موريتانيا‬‎)</option>
								<option <?php selected( "mu", $rowimages->name , true ); ?> value="mu">Mauritius (Moris)</option>
								<option <?php selected( "yt", $rowimages->name , true ); ?> value="yt">Mayotte</option>
								<option <?php selected( "mx", $rowimages->name , true ); ?> value="mx">Mexico (México)</option>
								<option <?php selected( "fm", $rowimages->name , true ); ?> value="fm">Micronesia</option>
								<option <?php selected( "md", $rowimages->name , true ); ?> value="md">Moldova (Republica Moldova)</option>
								<option <?php selected( "mc", $rowimages->name , true ); ?> value="mc">Monaco</option>
								<option <?php selected( "mn", $rowimages->name , true ); ?> value="mn">Mongolia (Монгол)</option>
								<option <?php selected( "me", $rowimages->name , true ); ?> value="me">Montenegro (Crna Gora)</option>
								<option <?php selected( "ms", $rowimages->name , true ); ?> value="ms">Montserrat</option>
								<option <?php selected( "ma", $rowimages->name , true ); ?> value="ma">Morocco (‫المغرب‬‎)</option>
								<option <?php selected( "mz", $rowimages->name , true ); ?> value="mz">Mozambique (Moçambique)</option>
								<option <?php selected( "mm", $rowimages->name , true ); ?> value="mm">Myanmar (Burma) (မြန်မာ)</option>
								<option <?php selected( "na", $rowimages->name , true ); ?> value="na">Namibia (Namibië)</option>
								<option <?php selected( "nr", $rowimages->name , true ); ?> value="nr">Nauru</option>
								<option <?php selected( "np", $rowimages->name , true ); ?> value="np">Nepal (नेपाल)</option>
								<option <?php selected( "nl", $rowimages->name , true ); ?> value="nl">Netherlands (Nederland)</option>
								<option <?php selected( "nc", $rowimages->name , true ); ?> value="nc">New Caledonia (Nouvelle-Calédonie)</option>
								<option <?php selected( "nz", $rowimages->name , true ); ?> value="nz">New Zealand</option>
								<option <?php selected( "ni", $rowimages->name , true ); ?> value="ni">Nicaragua</option>
								<option <?php selected( "ne", $rowimages->name , true ); ?> value="ne">Niger (Nijar)</option>
								<option <?php selected( "ng", $rowimages->name , true ); ?> value="ng">Nigeria</option>
								<option <?php selected( "nu", $rowimages->name , true ); ?> value="nu">Niue</option>
								<option <?php selected( "nf", $rowimages->name , true ); ?> value="nf">Norfolk Island</option>
								<option <?php selected( "kp", $rowimages->name , true ); ?> value="kp">North Korea (조선 민주주의 인민 공화국)</option>
								<option <?php selected( "mp", $rowimages->name , true ); ?> value="mp">Northern Mariana Islands</option>
								<option <?php selected( "no", $rowimages->name , true ); ?> value="no">Norway (Norge)</option>
								<option <?php selected( "om", $rowimages->name , true ); ?> value="om">Oman (‫عُمان‬‎)</option>
								<option <?php selected( "pk", $rowimages->name , true ); ?> value="pk">Pakistan (‫پاکستان‬‎)</option>
								<option <?php selected( "pw", $rowimages->name , true ); ?> value="pw">Palau</option>
								<option <?php selected( "ps", $rowimages->name , true ); ?> value="ps">Palestine (‫فلسطين‬‎)</option>
								<option <?php selected( "pa", $rowimages->name , true ); ?> value="pa">Panama (Panamá)</option>
								<option <?php selected( "pg", $rowimages->name , true ); ?> value="pg">Papua New Guinea</option>
								<option <?php selected( "py", $rowimages->name , true ); ?> value="py">Paraguay</option>
								<option <?php selected( "pe", $rowimages->name , true ); ?> value="pe">Peru (Perú)</option>
								<option <?php selected( "ph", $rowimages->name , true ); ?> value="ph">Philippines</option>
								<option <?php selected( "pl", $rowimages->name , true ); ?> value="pl">Poland (Polska)</option>
								<option <?php selected( "pt", $rowimages->name , true ); ?> value="pt">Portugal</option>
								<option <?php selected( "pr", $rowimages->name , true ); ?> value="pr">Puerto Rico</option>
								<option <?php selected( "qa", $rowimages->name , true ); ?> value="qa">Qatar (‫قطر‬‎)</option>
								<option <?php selected( "re", $rowimages->name , true ); ?> value="re">Réunion (La Réunion)</option>
								<option <?php selected( "ro", $rowimages->name , true ); ?> value="ro">Romania (România)</option>
								<option <?php selected( "ru", $rowimages->name , true ); ?> value="ru">Russia (Россия)</option>
								<option <?php selected( "rw", $rowimages->name , true ); ?> value="rw">Rwanda</option>
								<option <?php selected( "bl", $rowimages->name , true ); ?> value="bl">Saint Barthélemy (Saint-Barthélemy)</option>
								<option <?php selected( "sh", $rowimages->name , true ); ?> value="sh">Saint Helena</option>
								<option <?php selected( "kn", $rowimages->name , true ); ?> value="kn">Saint Kitts and Nevis</option>
								<option <?php selected( "lc", $rowimages->name , true ); ?> value="lc">Saint Lucia</option>
								<option <?php selected( "mf", $rowimages->name , true ); ?> value="mf">Saint Martin (Saint-Martin (partie française))</option>
								<option <?php selected( "pm", $rowimages->name , true ); ?> value="pm">Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)</option>
								<option <?php selected( "vc", $rowimages->name , true ); ?> value="vc">Saint Vincent and the Grenadines</option>
								<option <?php selected( "ws", $rowimages->name , true ); ?> value="ws">Samoa</option>
								<option <?php selected( "sm", $rowimages->name , true ); ?> value="sm">San Marino</option>
								<option <?php selected( "st", $rowimages->name , true ); ?> value="st">São Tomé and Príncipe (São Tomé e Príncipe)</option>
								<option <?php selected( "sa", $rowimages->name , true ); ?> value="sa">Saudi Arabia (‫المملكة العربية السعودية‬‎)</option>
								<option <?php selected( "sn", $rowimages->name , true ); ?> value="sn">Senegal (Sénégal)</option>
								<option <?php selected( "rs", $rowimages->name , true ); ?> value="rs">Serbia (Србија)</option>
								<option <?php selected( "sc", $rowimages->name , true ); ?> value="sc">Seychelles</option>
								<option <?php selected( "sl", $rowimages->name , true ); ?> value="sl">Sierra Leone</option>
								<option <?php selected( "sg", $rowimages->name , true ); ?> value="sg">Singapore</option>
								<option <?php selected( "sx", $rowimages->name , true ); ?> value="sx">Sint Maarten</option>
								<option <?php selected( "sk", $rowimages->name , true ); ?> value="sk">Slovakia (Slovensko)</option>
								<option <?php selected( "si", $rowimages->name , true ); ?> value="si">Slovenia (Slovenija)</option>
								<option <?php selected( "sb", $rowimages->name , true ); ?> value="sb">Solomon Islands</option>
								<option <?php selected( "so", $rowimages->name , true ); ?> value="so">Somalia (Soomaaliya)</option>
								<option <?php selected( "za", $rowimages->name , true ); ?> value="za">South Africa</option>
								<option <?php selected( "kr", $rowimages->name , true ); ?> value="kr">South Korea (대한민국)</option>
								<option <?php selected( "ss", $rowimages->name , true ); ?> value="ss">South Sudan (‫جنوب السودان‬‎)</option>
								<option <?php selected( "es", $rowimages->name , true ); ?> value="es">Spain (España)</option>
								<option <?php selected( "lk", $rowimages->name , true ); ?> value="lk">Sri Lanka (ශ්‍රී ලංකාව)</option>
								<option <?php selected( "sd", $rowimages->name , true ); ?> value="sd">Sudan (‫السودان‬‎)</option>
								<option <?php selected( "sr", $rowimages->name , true ); ?> value="sr">Suriname</option>
								<option <?php selected( "sj", $rowimages->name , true ); ?> value="sj">Svalbard and Jan Mayen</option>
								<option <?php selected( "sz", $rowimages->name , true ); ?> value="sz">Swaziland</option>
								<option <?php selected( "se", $rowimages->name , true ); ?> value="se">Sweden (Sverige)</option>
								<option <?php selected( "ch", $rowimages->name , true ); ?> value="ch">Switzerland (Schweiz)</option>
								<option <?php selected( "sy", $rowimages->name , true ); ?> value="sy">Syria (‫سوريا‬‎)</option>
								<option <?php selected( "tw", $rowimages->name , true ); ?> value="tw">Taiwan (台灣)</option>
								<option <?php selected( "tj", $rowimages->name , true ); ?> value="tj">Tajikistan</option>
								<option <?php selected( "tz", $rowimages->name , true ); ?> value="tz">Tanzania</option>
								<option <?php selected( "th", $rowimages->name , true ); ?> value="th">Thailand (ไทย)</option>
								<option <?php selected( "tl", $rowimages->name , true ); ?> value="tl">Timor-Leste</option>
								<option <?php selected( "tg", $rowimages->name , true ); ?> value="tg">Togo</option>
								<option <?php selected( "tk", $rowimages->name , true ); ?> value="tk">Tokelau</option>
								<option <?php selected( "to", $rowimages->name , true ); ?> value="to">Tonga</option>
								<option <?php selected( "tt", $rowimages->name , true ); ?> value="tt">Trinidad and Tobago</option>
								<option <?php selected( "tn", $rowimages->name , true ); ?> value="tn">Tunisia (‫تونس‬‎)</option>
								<option <?php selected( "tr", $rowimages->name , true ); ?> value="tr">Turkey (Türkiye)</option>
								<option <?php selected( "tm", $rowimages->name , true ); ?> value="tm">Turkmenistan</option>
								<option <?php selected( "tc", $rowimages->name , true ); ?> value="tc">Turks and Caicos Islands</option>
								<option <?php selected( "tv", $rowimages->name , true ); ?> value="tv">Tuvalu</option>
								<option <?php selected( "vi", $rowimages->name , true ); ?> value="vi">U.S. Virgin Islands</option>
								<option <?php selected( "ug", $rowimages->name , true ); ?> value="ug">Uganda</option>
								<option <?php selected( "ua", $rowimages->name , true ); ?> value="ua">Ukraine (Україна)</option>
								<option <?php selected( "ae", $rowimages->name , true ); ?> value="ae">United Arab Emirates (‫الإمارات العربية المتحدة‬‎)</option>
								<option <?php selected( "gb", $rowimages->name , true ); ?> value="gb">United Kingdom</option>
								<option <?php selected( "us", $rowimages->name , true ); ?> value="us">United States</option>
								<option <?php selected( "uy", $rowimages->name , true ); ?> value="uy">Uruguay</option>
								<option <?php selected( "uz", $rowimages->name , true ); ?> value="uz">Uzbekistan (Oʻzbekiston)</option>
								<option <?php selected( "vu", $rowimages->name , true ); ?> value="vu">Vanuatu</option>
								<option <?php selected( "va", $rowimages->name , true ); ?> value="va">Vatican City (Città del Vaticano)</option>
								<option <?php selected( "ve", $rowimages->name , true ); ?> value="ve">Venezuela</option>
								<option <?php selected( "vn", $rowimages->name , true ); ?> value="vn">Vietnam (Việt Nam)</option>
								<option <?php selected( "wf", $rowimages->name , true ); ?> value="wf">Wallis and Futuna</option>
								<option <?php selected( "eh", $rowimages->name , true ); ?> value="eh">Western Sahara (‫الصحراء الغربية‬‎)</option>
								<option <?php selected( "ye", $rowimages->name , true ); ?> value="ye">Yemen (‫اليمن‬‎)</option>
								<option <?php selected( "zm", $rowimages->name , true ); ?> value="zm">Zambia</option>
								<option <?php selected( "zw", $rowimages->name , true ); ?> value="zw">Zimbabwe</option>
								<option <?php selected( "ax", $rowimages->name , true ); ?> value="ax">Åland Islands</option>
							</select>
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>			
			<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}

	//13 License
	function hugeit_contact_licenseHtml($rowimages,$themeId) { ob_start();
		$themeId = sanitize_text_field($themeId);
		global $wpdb;
		$query = "SELECT *  from " . $wpdb->prefix . "huge_it_contact_style_fields where options_name = '".$themeId."' ";
	    $rows = $wpdb->get_results($query);
	    $style_values = array();
	    foreach ($rows as $row) {
	        $key = $row->name;
	        $value = $row->value;
	        $style_values[$key] = $value;
	    }
	    $linkName=$rowimages->hc_field_label;
	    $linkUrl=$rowimages->description;
	    $toReplace=' <a target="_blank" href="'.$linkUrl.'">'.$linkName.'</a> ';
	    $license=$rowimages->hc_other_field;
	    $license=preg_replace('/{link}/', $toReplace, $license);
	    ?>
		<div class="hugeit-field-block hugeit-check-field" rel="huge-contact-field-<?php echo absint($rowimages->id); ?>">
			<div class="field-block license-block" style="text-align:<?php echo $rowimages->hc_required; ?>;">				
				<label class="secondary-label">
					<div class="checkbox-block big">
						<input type="checkbox" value=""/>
						<?php if($style_values['form_checkbox_type']=='circle'){ ?>
							<i class="hugeicons-dot-circle-o active"></i>
							<i class="hugeicons-circle-o passive"></i>
						<?php }else{ ?>			
							<i class="hugeicons-check-square active"></i>
							<i class="hugeicons-square-o passive"></i>
						<?php }?>	
					</div>
					<span class="sublable"><?php echo $license; ?></span>
				</label>					
			</div>
			<span class="hugeit-error-message"></span>
			<span class="hugeOverlay"></span>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo $rowimages->ordering; ?>">
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo $rowimages->hc_left_right; ?>" />
		</div>
	<?php
	    return ob_get_clean();
	}

	function hugeit_contact_licenseSettingsHtml($rowimages){ob_start(); ?>
		<li id="huge-contact-field-<?php echo absint($rowimages->id); ?>" data-fieldNum="<?php echo absint($rowimages->id); ?>"  data-fieldType="license">	
			<input type="hidden" class="left-right-position" name="hc_left_right<?php echo absint($rowimages->id); ?>" value="<?php echo $rowimages->hc_left_right; ?>" fileType="license"/>
			<input type="hidden" class="ordering" name="hc_ordering<?php echo absint($rowimages->id); ?>" value="<?php echo $rowimages->ordering; ?>" />
			<h4><?php if($rowimages->hc_field_label!=''){echo $rowimages->hc_field_label;}else{ echo "License";} ?></h4>
			<div class="fields-options">
				<div class="left">
					<div>
						<label class="input-block">Link Name:
							<input class="linkName" type="text" name="imagess<?php echo absint($rowimages->id); ?>" value="<?php echo $rowimages->hc_field_label; ?>" />
						</label>
					</div>
					<div>
						<label class="input-block">Link URL:
							<input class="linkUrl" type="text" name="im_description<?php echo absint($rowimages->id); ?>" value="<?php echo $rowimages->description; ?>" />
						</label>
					</div>	
					<div>
						<label class="input-block" for="form_label_position">Field Align:
							<select id="ready_form_label_position" class="fieldPos" name="hc_required<?php echo absint($rowimages->id); ?>">
								<option <?php if($rowimages->hc_required == 'left'){ echo 'selected="selected"'; } ?> value="left">Left</option>
								<option <?php if($rowimages->hc_required == 'right'){ echo 'selected="selected"'; } ?> value="right">Right</option>
							</select>
						</label>
					</div>												
				</div>
				<div class="left">
					<div>
						<label class="input-block">Field Content:
							<textarea class="fieldContent" type="text" name="hc_other_field<?php echo absint($rowimages->id); ?>" value=""><?php echo $rowimages->hc_other_field; ?></textarea>
						</label>
					</div>
				</div>
				<div class="field-top-options-block">
					<a class="remove-field" href="#"><span><p>Remove Field</p></span></a>
					<a class="copy-field" href="#"><span><p>Duplicate Field</p></span></a>
					<a class="open-close" href="#"><span><p>Edit Field</p></span></a>
				</div>
			</div>			
			<div class="clear"></div>
		</li>
	<?php
	    return ob_get_clean();
	}
	//ADD FIELDS
	if (isset($_POST['task']) && $_POST['task']=='addFieldsTask') {

		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'builder_nonce')) {
			return false;
		}

		$formId= absint($_POST['formId']);
		$inputtype= sanitize_text_field($_POST['inputType']);
		$themeId= sanitize_text_field($_POST['themeId']);
		$inserttexttype = $wpdb->prefix . "huge_it_contact_contacts_fields";
		switch ($inputtype) {
		    case 'text':
		        $inserttexttype = $wpdb->prefix . "huge_it_contact_contacts_fields";

			    $wpdb->insert(
				    $inserttexttype,
				    array(
					    'name' => 'Placeholder',
					    'hugeit_contact_id' => $formId,
					    'description' => 'on',
					    'conttype' => $inputtype,
					    'hc_field_label' => 'Textbox',
					    'hc_other_field' => '',
					    'field_type' => 'text',
					    'hc_required' => '',
					    'ordering' => '0',
					    'published' => 2,
					    'hc_input_show_default' => '1',
					    'hc_left_right' => 'left',
				    ),
				    array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
			    );

		        $queryMax=$wpdb->prepare(
		        	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
			        $formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID= absint($row8[0]->resId);
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_textBoxHtml($rowimages[0]),
				    "outputFieldSettings" => hugeit_contact_textBoxSettingsHtml($rowimages[0])
			    ));

		        break;

		    case 'textarea':

			    $wpdb->insert(
				    $inserttexttype,
				    array(
					    'name' => 'Placeholder',
					    'hugeit_contact_id' => $formId,
					    'description' => 'on',
					    'conttype' => $inputtype,
					    'hc_field_label' => 'Textarea',
					    'hc_other_field' => '80',
					    'field_type' => 'on',
					    'hc_required' => 'on',
					    'ordering' => 0,
					    'published' => 2,
					    'hc_input_show_default' => '1',
					    'hc_left_right' => 'left',
				    ),
				    array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
			    );

			    $queryMax=$wpdb->prepare(
			    	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",$formId
			    );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_textareaHtml($rowimages[0]),
                    "outputFieldSettings" =>hugeit_contact_textareaSettingsHtml($rowimages[0])
			    ));
		        break;

		    case 'selectbox':
		    	$wpdb->insert(
				    $inserttexttype,
				    array(
					    'name' => 'Option 1;;Option 2',
						'hugeit_contact_id' => $formId,
						'description' => '',
						'conttype' => $inputtype,
						'hc_field_label' => 'Selectbox',
						'hc_other_field' => 'Option 1',
						'ordering' => 0,
						'published' => 2,
						'hc_input_show_default' => '1',
						'hc_left_right' => 'left'
				    ),
				    array('%s', '%d', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
			    );

			    $queryMax=$wpdb->prepare(
			    	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
				    $formId
			    );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_selectboxHtml($rowimages[0]),
				    "outputFieldSettings" =>hugeit_contact_selectboxSettingsHtml($rowimages[0])
			    ));
		     	break;

			case 'checkbox':

		     	$wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'On',
						'hugeit_contact_id' => $formId,
						'description' => 'on',
						'conttype' => $inputtype,
						'hc_field_label' => 'Checkbox',
						'hc_other_field' => '',
						'field_type' => '1',
						'published' => 2,
						'hc_input_show_default' => '1',
						'hc_required' => 'on',
						'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

			    $queryMax=$wpdb->prepare(
			    	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
				    $formId
			    );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_checkboxHtml($rowimages[0],$themeId),
				    "outputFieldSettings" =>hugeit_contact_checkboxSettingsHtml($rowimages[0])
			    ));
		     	break;

            case 'hidden_field':

                $wpdb->insert(
                    $inserttexttype,
                    array(
                        'name' => 'Hidden Field',
                        'hugeit_contact_id' => $formId,
                        'description' => 'Hidden Field',
                        'conttype' => $inputtype,
                        'hc_field_label' => 'Hidden Field',
                        'hc_other_field' => 'user_id',
                        'hc_required' => 'text',
                        'ordering' => 0,
                        'field_type' => '1',
                        'published' => 2,
                        'hc_input_show_default' => '1',
                        'hc_left_right' => 'left',
                    ),
                    array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%d','%s','%s')
                );

                $queryMax=$wpdb->prepare(
                    "SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
                    $formId
                );
                $row8=$wpdb->get_results($queryMax);
                $fieldID=$row8[0]->resId;
                $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
                $rowimages=$wpdb->get_results($fieldQuery);
                echo json_encode(array(
                    "outputField" => hugeit_contact_hiddenFieldHtml($rowimages[0],$themeId),
                    "outputFieldSettings" =>hugeit_contact_hiddenFieldSettingsHtml($rowimages[0])
                ));
                break;

            case 'page_break':

                $wpdb->insert(
                    $inserttexttype,
                    array(
                        'name' => 'Page Break',
                        'hugeit_contact_id' => $formId,
                        'description' => 'Page Break',
                        'conttype' => $inputtype,
                        'hc_field_label' => 'Page Break',
                        'hc_other_field' => 'page_break',
                        'hc_required' => 'text',
                        'ordering' => 0,
                        'field_type' => '1',
                        'published' => 2,
                        'hc_input_show_default' => '1',
                        'hc_left_right' => 'left',
                    ),
                    array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%d','%s','%s')
                );

                $queryMax=$wpdb->prepare(
                    "SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
                    $formId
                );
                $row8=$wpdb->get_results($queryMax);
                $fieldID=$row8[0]->resId;
                $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
                $rowimages=$wpdb->get_results($fieldQuery);
                echo json_encode(array(
                    "outputField" => hugeit_contact_pageBreakHtml($rowimages[0],$themeId),
                    "outputFieldSettings" =>hugeit_contact_pageBreakSettingsHtml($rowimages[0])
                ));
                break;

	     	case 'radio_box':

	     		$wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'option 1;;option 2',
						'hugeit_contact_id' => $formId,
						'description' => '2',
						'conttype' => $inputtype,
						'hc_field_label' => 'Radio Box',
						'hc_other_field' => 'option 1',
						'field_type' => '1',
						'hc_required' => 'text',
						'ordering' => 0,
						'published' => 2,
						'hc_input_show_default' => '1',
						'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		      	$queryMax=$wpdb->prepare(
		      		"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",$formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_radioboxHtml($rowimages[0],$themeId),
				    "outputFieldSettings" =>hugeit_contact_radioboxSettingsHtml($rowimages[0])
			    ));
		     	break;

	     	case 'file_box':
	     		$wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => '5',
						'hugeit_contact_id' => $formId,
						'description' => 'on',
						'conttype' => $inputtype,
						'hc_field_label' => 'Filebox',
						'hc_other_field' => 'jpg, jpeg, gif, png, docx, xlsx, pdf',
						'field_type' => '',
						'hc_required' => '',
						'ordering' => 0,
						'published' => 2,
						'hc_input_show_default' => '1',
						'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		      	$queryMax=$wpdb->prepare(
		      		"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",$formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_fileboxHtml($rowimages[0],$themeId),
				    "outputFieldSettings" =>hugeit_contact_fileboxSettingsHtml($rowimages[0])
			    ));
		     	break;

	     	case 'custom_text':
		        $wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'Placeholder',
				        'hugeit_contact_id' => $formId,
				        'description' => 'on',
				        'conttype' => $inputtype,
				        'hc_field_label' => 'Label',
				        'hc_other_field' => '80',
				        'field_type' => 'on',
				        'hc_required' => 'on',
				        'ordering' => 0,
				        'published' => 2,
				        'hc_input_show_default' => '1',
				        'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		        $queryMax=$wpdb->prepare(
		        	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",$formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    $queryMax=$wpdb->prepare(
			    	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",$formId
			    );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    echo json_encode(array( "outputField" => hugeit_contact_cutomtextHtml($rowimages[0]),
                    "outputFieldSettings" =>hugeit_contact_cutomtextSettingsHtml($rowimages[0]),
                    "customText" => "titleimage" . $fieldID
			    ));
		     	break;

	     	case 'captcha':
		        $query = "SELECT *  from " . $wpdb->prefix . "huge_it_contact_general_options";
		        $rowspar = $wpdb->get_results($query);
			    $paramssld = array();
			    foreach ($rowspar as $rowpar) {
			        $key = $rowpar->name;
			        $value = $rowpar->value;
			        $paramssld[$key] = $value;
			    }
			    $capKeyPub=$paramssld['form_captcha_public_key'];
			    $capKeyPriv=$paramssld['form_captcha_private_key'];
			    if($capKeyPub != '' && $capKeyPriv != '') {

				    $wpdb->insert(
					    $inserttexttype,
					    array(
						    'name' => 'image',
						    'hugeit_contact_id' => $formId,
						    'description' => '',
						    'conttype' => $inputtype,
						    'hc_field_label' => '',
						    'hc_other_field' => '',
						    'field_type' => '',
						    'hc_required' => 'light',
						    'ordering' => 0,
						    'published' => 2,
						    'hc_input_show_default' => '1',
						    'hc_left_right' => 'left',
					    ),
					    array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
				    );

			      	$queryMax=$wpdb->prepare(
			      		"SELECT MAX(id) AS resId 
						FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
						WHERE hugeit_contact_id=%d",$formId
			        );
				    $row8=$wpdb->get_results($queryMax);
				    $fieldID=$row8[0]->resId;
				    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
				    $rowimages=$wpdb->get_results($fieldQuery);
				    $query = "SELECT *  FROM " . $wpdb->prefix . "huge_it_contact_general_options";
				    $rowspar = $wpdb->get_results($query);
				    $paramssld = array();
				    foreach ($rowspar as $rowpar) {
				        $key = $rowpar->name;
				        $value = $rowpar->value;
				        $paramssld[$key] = $value;
				    }
				    $capKeyPub=$paramssld['form_captcha_public_key'];
				    echo json_encode(array(
				    	"outputField" => hugeit_contact_captchaHtml($rowimages[0]),
					    "outputFieldSettings" => hugeit_contact_captchaSettingsHtml($rowimages[0]),
					    "captchaNum" => $capKeyPub
				    ));
				} else {
					echo json_encode(array(
						"captchaNum" => $capKeyPub,
						"toRedirect"=>"admin.php?page=hugeit_forms_main_page&task=captcha_keys&id=".$formId."&TB_iframe=1"
					));
				}
		     	break;
			case 'simple_captcha_box'://simple captcha to do
				$field_exists_in_the_form=$wpdb->prepare(
					"SELECT id 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE conttype='simple_captcha_box' AND hugeit_contact_id=%d",
					$formId
				);
				$field_exists_in_the_form=$wpdb->query($field_exists_in_the_form);
				if( !$field_exists_in_the_form ){
					$wpdb->insert(
						$inserttexttype,
						array(
							'name' => 'Type the code on the image',
							'hugeit_contact_id' => $formId,
							'description' => 'default',
							'conttype' => $inputtype,
							'hc_field_label' => 'Simple Captcha',
							'hc_other_field' => '{"digits":"5","color":"FF601C"}',
							'field_type' => 'simple_captcha_box',
							'hc_required' => '',
							'ordering' => 0,
							'published' => 2,
							'hc_input_show_default' => 'formsLeftAlign',
							'hc_left_right' => 'left',
						),
						array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
					);

					$queryMax=$wpdb->prepare(
						"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
						$formId
					);
					$row81=$wpdb->get_results($queryMax);
					$fieldID=$row81[0]->resId;
					$fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
					$rowimages=$wpdb->get_results($fieldQuery);
					echo json_encode(array(
						"outputField" => hugeit_contact_simple_captcha_html($rowimages[0]),
						"outputFieldSettings"=>hugeit_contact_simple_captcha_settings_html($rowimages[0])
					));
				}
				else{
					echo json_encode(array());
				}
				break;
	     	case 'buttons':
		     	$query=$wpdb->prepare(
		     		"SELECT MAX(ordering) AS res 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
			        $formId
		        );
			    $row8=$wpdb->get_results($query);
			    $resOfMax=$row8[0]->res;
			    $resOfMax=$resOfMax+1;
			    $query=$wpdb->prepare(
			    	"SELECT * 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
				    $formId
			    );
			    $row8=$wpdb->get_results($query);
			    $leftRightPos='left';
			    foreach ($row8 as $value) {
			    	if($value->hc_left_right=='right') {
			    		$leftRightPos='right';
			    	}
			    }

		        $wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'text',
				        'hugeit_contact_id' => $formId,
				        'description' => 'Submit',
				        'conttype' => $inputtype,
				        'hc_field_label' => 'Reset',
				        'hc_other_field' => 'print_success_message',
				        'field_type' => '',
				        'hc_required' => '',
				        'ordering' => $resOfMax,
				        'published' => 2,
				        'hc_input_show_default' => '1',
				        'hc_left_right' => $leftRightPos,
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		      	$queryMax=$wpdb->prepare(
		      		"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
			        $formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_buttonsHtml($rowimages[0],$themeId),
                    "outputFieldSettings" => hugeit_contact_buttonsSettingsHtml($rowimages[0]),
				    "buttons" => 'button'
			    ));
		     	break;

	     	case 'e_mail':

		        $wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'Type Your Email',
				        'hugeit_contact_id' => $formId,
				        'description' => 'on',
				        'conttype' => $inputtype,
				        'hc_field_label' => 'E-mail',
				        'hc_other_field' => '',
				        'field_type' => 'name',
				        'hc_required' => '',
				        'ordering' => 0,
				        'published' => 2,
				        'hc_input_show_default' => '1',
				        'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		        $queryMax=$wpdb->prepare(
		        	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
			        $formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare(
			    	"SELECT * 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE id=%d",
				    $fieldID
			    );
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_emailHtml($rowimages[0]),
                    "outputFieldSettings" => hugeit_contact_emailSettingsHtml($rowimages[0])
			    ));
		     	break;

	     	case 'nameSurname':

		        $wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'Name',
				        'hugeit_contact_id' => $formId,
				        'description' => 'on',
				        'conttype' => $inputtype,
				        'hc_field_label' => 'Full Name',
				        'hc_other_field' => 'Surname',
				        'field_type' => 'name',
				        'hc_required' => '',
				        'ordering' => 0,
				        'published' => 2,
				        'hc_input_show_default' => '1',
				        'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		        $queryMax=$wpdb->prepare(
		        	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
			        $formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_nameSurnameHtml($rowimages[0]),
				    "outputFieldSettings"=>hugeit_contact_nameSurnameSettingsHtml($rowimages[0])
			    ));
		     	break;

	     	case 'phone':

		        $wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'us',
				        'hugeit_contact_id' => $formId,
				        'description' => 'on',
				        'conttype' => $inputtype,
				        'hc_field_label' => 'Phone',
				        'hc_other_field' => 'e.g. +1 123 4567',
				        'field_type' => 'name',
				        'hc_required' => '',
				        'ordering' => 0,
				        'published' => 2,
				        'hc_input_show_default' => '1',
				        'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		        $queryMax=$wpdb->prepare(
		        	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
			        $formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_phoneHtml($rowimages[0]),
				    "outputFieldSettings"=>hugeit_contact_phoneSettingsHtml($rowimages[0])
			    ));
		     	break;

	     	case 'license':

		        $wpdb->insert(
			        $inserttexttype,
			        array(
				        'name' => 'License',
				        'hugeit_contact_id' => $formId,
				        'description' => 'http://huge-it.com',
				        'conttype' => $inputtype,
				        'hc_field_label' => 'Policy Agreement',
				        'hc_other_field' => 'I have read and agreed to the {link}',
				        'field_type' => 'name',
				        'hc_required' => 'left',
				        'ordering' => 0,
				        'published' => 2,
				        'hc_input_show_default' => '1',
				        'hc_left_right' => 'left',
			        ),
			        array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s', '%s')
		        );

		        $queryMax=$wpdb->prepare(
		        	"SELECT MAX(id) AS resId 
					FROM ".$wpdb->prefix."huge_it_contact_contacts_fields 
					WHERE hugeit_contact_id=%d",
			        $formId
		        );
			    $row8=$wpdb->get_results($queryMax);
			    $fieldID=$row8[0]->resId;
			    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
			    $rowimages=$wpdb->get_results($fieldQuery);
			    echo json_encode(array(
			    	"outputField" => hugeit_contact_licenseHtml($rowimages[0],$themeId),
				    "outputFieldSettings"=>hugeit_contact_licenseSettingsHtml($rowimages[0])
			    ));
		     	break;

		}
		
	}
	//REMOVE FIELDS
	if( isset($_POST['task']) && $_POST['task']=='removeFieldTask') {
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'builder_nonce')) {
			return false;
		}

		$formId = absint($_POST['formId']);
		$all = $_POST['formData'];
		parse_str("$all",$myArray);
		$fieldID = absint($_POST['fieldId']);
		$_POSTED= array_map('sanitize_text_field', $myArray);
		$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields where hugeit_contact_id = %d order by id ASC",$formId);
	    $rowim=$wpdb->get_results($query);
		if(isset($_POSTED["name"])){
			if($_POSTED["name"] != ''){
				$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_contact_contacts SET  name = %s  WHERE id = %d ", sanitize_text_field($_POSTED["name"]), $formId));
				$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_contact_contacts SET  hc_yourstyle = %s WHERE id = %d ", sanitize_text_field($_POSTED["select_form_theme"]), $formId));
			}
		}	   
	   foreach ($rowim as $key=>$rowimages){
		   if(isset($_POSTED)&&isset($_POSTED["hc_left_right".$rowimages->id.""])){
			   if($_POSTED["hc_left_right".$rowimages->id.""]){
			   	$id = absint($rowimages->id);
					if ( isset( $_POSTED[ "field_type" . $rowimages->id . "" ] ) )
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  field_type = %s WHERE id = %d", sanitize_text_field($_POSTED[ "field_type" . $rowimages->id . "" ]), $id ) );
				   if ( isset( $_POSTED[ "hc_other_field" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_other_field = %s WHERE id = %d", sanitize_text_field($_POSTED[ "hc_other_field" . $rowimages->id . "" ]), $id ) );
				   }
				   if ( isset( $_POSTED[ "titleimage" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  name = %s  WHERE id = %d", sanitize_text_field(stripslashes( $_POSTED[ "titleimage" . $rowimages->id . "" ] )), $id ) );
				   }
				   if ( isset( $_POSTED[ "im_description" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  description = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "im_description" . $rowimages->id . "" ]), $id ) );
				   }
				   if ( isset( $_POSTED[ "hc_required" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_required = %s WHERE id = %d", sanitize_text_field($_POSTED[ "hc_required" . $rowimages->id . "" ]), $id ) );
				   }
				   if ( isset( $_POSTED[ "imagess" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_field_label = %s  WHERE id = %d", sanitize_text_field(stripslashes( $_POSTED[ "imagess" . $rowimages->id . "" ] )), $id ) );
				   }
				   if ( isset( $_POSTED[ "hc_left_right" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_left_right = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "hc_left_right" . $rowimages->id . "" ]), $id ) );
				   }
				   if ( isset( $_POSTED[ "def_value" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  def_value = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "def_value" . $rowimages->id . "" ]), $id ) );
				   }
				   if ( isset( $_POSTED[ "mask_on" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  mask_on = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "mask_on" . $rowimages->id . "" ]), $id ) );
				   }
				   if ( isset( $_POSTED[ "hc_ordering" . $rowimages->id . "" ] ) ) {
					   $wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  ordering = %s  WHERE id = %d", intval($_POSTED[ "hc_ordering" . $rowimages->id . "" ]), $id ) );
				   }
				   if ( isset( $_POSTED["hc_input_show_default".$rowimages->id.""]))$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_contact_contacts_fields SET  hc_input_show_default = %s  WHERE id = %d",sanitize_text_field($_POSTED["hc_input_show_default".$rowimages->id.""]),$id));
				}
			}
		}
		$wpdb->delete(
			$wpdb->prefix."huge_it_contact_contacts_fields",
			array('id' => $fieldID),
			array('%d')
		);

	  	echo json_encode(array(
	  		"removedField" => $fieldID
	    ));
	}
	//DUBLICATE FIELDS
	if (isset($_POST['task']) && $_POST['task'] == 'dublicateFieldTask'){
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'builder_nonce')) {
			return false;
		}
		$formId = absint($_POST['formId']);
		$themeId = absint($_POST['themeId']);
		$all=$_POST['formData'];
		parse_str("$all",$myArray);
		$fieldID = absint($_POST['fieldId']);
		$_POSTED = array_map('sanitize_text_field', $myArray);
		$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields where hugeit_contact_id = %d order by id ASC",$formId);
	    $rowim = $wpdb->get_results($query);
		if (isset($_POSTED["name"])){
			if($_POSTED["name"] != '') {
				$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_contact_contacts SET  name = %s  WHERE id = %d ", sanitize_text_field($_POSTED["name"]), $formId));
				$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_contact_contacts SET  hc_yourstyle = %s  WHERE id = %d ", sanitize_text_field($_POSTED["select_form_theme"]), $formId));
			}
		}
		foreach ( $rowim as $key => $rowimages ) {
			if ( isset( $_POSTED ) && isset( $_POSTED[ "hc_left_right" . $rowimages->id . "" ] ) ) {
				if ( $_POSTED[ "hc_left_right" . $rowimages->id . "" ] ) {
					$id = absint($rowimages->id);
					if ( isset( $_POSTED[ "field_type" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  field_type = %s WHERE id = %d", sanitize_text_field($_POSTED[ "field_type" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "hc_other_field" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_other_field = %s WHERE id = %d", sanitize_text_field($_POSTED[ "hc_other_field" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "titleimage" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  name = %s  WHERE id = %d", sanitize_text_field(stripslashes( $_POSTED[ "titleimage" . $rowimages->id . "" ] )), $id ) );
					}
					if ( isset( $_POSTED[ "im_description" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  description = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "im_description" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "hc_required" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_required = %s WHERE id = %d", sanitize_text_field($_POSTED[ "hc_required" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "imagess" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_field_label = %s  WHERE id = %d", sanitize_text_field(stripslashes( $_POSTED[ "imagess" . $rowimages->id . "" ] )), $id ) );
					}
					if ( isset( $_POSTED[ "hc_left_right" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_left_right = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "hc_left_right" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "hc_ordering" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  ordering = %s  WHERE id = %d", intval($_POSTED[ "hc_ordering" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "def_value" . $rowimages->id . "" ] ) &&  $_POSTED[ "def_value" . $rowimages->id . "" ] ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  def_value = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "def_value" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "mask_on" . $rowimages->id . "" ] ) && $_POSTED[ "mask_on" . $rowimages->id . "" ]) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  mask_on = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "mask_on" . $rowimages->id . "" ]), $id ) );
					}
					if ( isset( $_POSTED[ "hc_input_show_default" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET  hc_input_show_default = %s  WHERE id = %d", sanitize_text_field($_POSTED[ "hc_input_show_default" . $rowimages->id . "" ]), $id ) );
					}
				}
			}
		}
		///ENDS SAVING
		$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID);
		$rowduble=$wpdb->get_row($query);
		$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields where hugeit_contact_id = %d order by id ASC", $formId);
		$rowplusorder=$wpdb->get_results($query);

		foreach ( $rowplusorder as $key => $rowplusorders ) {
			if ( $rowplusorders->ordering > $rowduble->ordering ) {
				$rowplusorderspl = $rowplusorders->ordering + 1;
				$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields SET ordering = %d WHERE id = %d ", $rowplusorderspl, $rowplusorders->id ) );
			}
		}
		
		$inserttexttype = $wpdb->prefix . "huge_it_contact_contacts_fields";
		$rowdubleorder=$rowduble->ordering+1;
		$inputtype=$rowduble->conttype;

		$wpdb->insert(
			$inserttexttype,
			array(
				'name' => $rowduble->name,
				'hugeit_contact_id' => $rowduble->hugeit_contact_id,
				'description' => $rowduble->description,
				'conttype' => $rowduble->conttype,
				'hc_field_label' => $rowduble->hc_field_label,
				'hc_other_field' => $rowduble->hc_other_field,
				'field_type' => $rowduble->field_type,
				'hc_required' => $rowduble->hc_required,
				'ordering' => $rowdubleorder,
				'published' => $rowduble->published,
				'hc_input_show_default' => $rowduble->hc_input_show_default,
				'def_value' => $rowduble->def_value,
				'mask_on' => $rowduble->mask_on,
				'hc_left_right' => $rowduble->hc_left_right,
			),
			array('%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%s','%s', '%s')
		);

		$queryMax=$wpdb->prepare("SELECT MAX(id) AS resId FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE hugeit_contact_id=%d",$formId);
	    $row8=$wpdb->get_results($queryMax);
	    $fieldID2=$row8[0]->resId;
	    $fieldQuery=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields WHERE id=%d",$fieldID2);
	    $rowimages=$wpdb->get_results($fieldQuery);

		switch ( $inputtype ) {
			case 'text':
				echo json_encode( array(
					"outputField"         => hugeit_contact_textBoxHtml( $rowimages[0] ),
					"outputFieldSettings" => hugeit_contact_textBoxSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'textarea':
				echo json_encode( array(
					"outputField"         => hugeit_contact_textareaHtml( $rowimages[0] ),
					"outputFieldSettings" => hugeit_contact_textareaSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'selectbox':
				echo json_encode( array(
					"outputField"         => hugeit_contact_selectboxHtml( $rowimages[0] ),
					"outputFieldSettings" => hugeit_contact_selectboxSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'checkbox':
				echo json_encode( array(
					"outputField"         => hugeit_contact_checkboxHtml( $rowimages[0], $themeId ),
					"outputFieldSettings" => hugeit_contact_checkboxSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'radio_box':
				echo json_encode( array(
					"outputField"         => hugeit_contact_radioboxHtml( $rowimages[0], $themeId ),
					"outputFieldSettings" => hugeit_contact_radioboxSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'file_box':
				echo json_encode( array(
					"outputField"         => hugeit_contact_fileboxHtml( $rowimages[0], $themeId ),
					"outputFieldSettings" => hugeit_contact_fileboxSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'custom_text':
				echo json_encode( array(
					"outputField"         => hugeit_contact_cutomtextHtml( $rowimages[0] ),
					"outputFieldSettings" => hugeit_contact_cutomtextSettingsHtml( $rowimages[0] ),
					"customText"          => "titleimage" . $fieldID . "",
					"beforeId"            => $fieldID,
				) );
				break;

			case 'e_mail':
				echo json_encode( array(
					"outputField"         => hugeit_contact_emailHtml( $rowimages[0] ),
					"outputFieldSettings" => hugeit_contact_emailSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'nameSurname':
				echo json_encode( array(
					"outputField"         => hugeit_contact_nameSurnameHtml( $rowimages[0] ),
					"outputFieldSettings" => hugeit_contact_nameSurnameSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

			case 'phone':
				echo json_encode( array(
					"outputField"         => hugeit_contact_phoneHtml( $rowimages[0] ),
					"outputFieldSettings" => hugeit_contact_phoneSettingsHtml( $rowimages[0] ),
					"beforeId"            => $fieldID,
				) );
				break;

            case 'hidden_field':
                echo json_encode( array(
                    "outputField"         => hugeit_contact_hiddenFieldHtml( $rowimages[0], $themeId ),
                    "outputFieldSettings" => hugeit_contact_hiddenFieldSettingsHtml($rowimages[0]),
                    "beforeId"            => $fieldID,
                ) );
                break;

            case 'page_break':
                echo json_encode( array(
                    "outputField"         => hugeit_contact_pageBreakHtml( $rowimages[0], $themeId ),
                    "outputFieldSettings" => hugeit_contact_pageBreakSettingsHtml($rowimages[0]),
                    "beforeId"            => $fieldID,
                ) );
                break;

		}
	}
	//Save Form Action
if ( isset( $_POST['task'] ) && $_POST['task'] == 'saveEntireForm' ) {
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'builder_nonce')) {
		return false;
	}
	$formId = sanitize_text_field($_POST['formId']);

    $_POSTED=$_POST['formData'];


	$query   = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "huge_it_contact_contacts_fields WHERE hugeit_contact_id = %d ORDER BY id ASC", $formId );
	$rowim   = $wpdb->get_results( $query );

    if ( isset( $_POSTED ) ) {
        if (isset($_POSTED["name"])) {
            if ($_POSTED["name"] != '') {
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "huge_it_contact_contacts SET  name = %s  WHERE id = %d ", sanitize_text_field(wp_unslash($_POSTED["name"])), $formId));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "huge_it_contact_contacts SET  hc_yourstyle = %s  WHERE id = %d ", sanitize_text_field($_POSTED["select_form_theme"]), $formId));
                $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "huge_it_contact_contacts SET  hc_yourstyle = %s  WHERE id = %d ", sanitize_text_field($_POSTED["select_form_theme"]), $formId));
            }
        }

        if (isset($_POSTED['hugeit_contact_show_title_for_form_' . $formId]) && in_array($_POSTED['hugeit_contact_show_title_for_form_' . $formId], array('yes', 'no', 'default'))) {
            update_option('hugeit_contact_show_title_for_form_' . $formId, $_POSTED['hugeit_contact_show_title_for_form_' . $formId]);
        }
        //Allowed html tags for wp_editor
        global $allowedposttags;
        $allowed_atts = array(
            'align'      => array(),
            'type'       => array(),
            'style'      => array(),
            'src'        => array(),
            'alt'        => array(),
            'href'       => array(),
            'target'     => array(),
            'value'      => array(),
            'name'       => array(),
            'for'        => array(),
            'width'      => array(),
            'height'     => array(),
            'data'       => array(),
            'title'      => array(),
        );
        $allowedposttags['form']     = $allowed_atts;
        $allowedposttags['label']    = $allowed_atts;
        $allowedposttags['input']    = $allowed_atts;
        $allowedposttags['textarea'] = $allowed_atts;
        $allowedposttags['strong']   = $allowed_atts;
        $allowedposttags['small']    = $allowed_atts;
        $allowedposttags['table']    = $allowed_atts;
        $allowedposttags['span']     = $allowed_atts;
        $allowedposttags['abbr']     = $allowed_atts;
        $allowedposttags['code']     = $allowed_atts;
        $allowedposttags['pre']      = $allowed_atts;
        $allowedposttags['div']      = $allowed_atts;
        $allowedposttags['img']      = $allowed_atts;
        $allowedposttags['h1']       = $allowed_atts;
        $allowedposttags['h2']       = $allowed_atts;
        $allowedposttags['h3']       = $allowed_atts;
        $allowedposttags['h4']       = $allowed_atts;
        $allowedposttags['h5']       = $allowed_atts;
        $allowedposttags['h6']       = $allowed_atts;
        $allowedposttags['ol']       = $allowed_atts;
        $allowedposttags['ul']       = $allowed_atts;
        $allowedposttags['li']       = $allowed_atts;
        $allowedposttags['em']       = $allowed_atts;
        $allowedposttags['hr']       = $allowed_atts;
        $allowedposttags['br']       = $allowed_atts;
        $allowedposttags['tr']       = $allowed_atts;
        $allowedposttags['td']       = $allowed_atts;
        $allowedposttags['p']        = $allowed_atts;
        $allowedposttags['a']        = $allowed_atts;
        $allowedposttags['b']        = $allowed_atts;
        $allowedposttags['i']        = $allowed_atts;
        //Allowed html tags for wp_editor
        foreach ($rowim as $key => $rowimages) {
            $inputAllowedTypes = array('text', 'custom_text', 'textarea', 'selectbox', 'checkbox', 'radio_box', 'file_box', 'e_mail', 'buttons', 'captcha', 'simple_captcha_box','hidden_field','page_break');
            $inputtype = $rowimages->conttype;
            if (in_array($inputtype, $inputAllowedTypes)) {
                $id = $rowimages->id;

                $hc_other_field = '';

                if ( isset($_POSTED['hc_other_field' . $id]) ) {
                    $hc_other_field = is_array($_POSTED['hc_other_field' . $id]) ? json_encode($_POSTED['hc_other_field' . $id]) : $_POSTED['hc_other_field' . $id];
                }
                $row_updated = $wpdb->update(
                    $wpdb->prefix . "huge_it_contact_contacts_fields",
                    array(
                        'ordering' => isset($_POSTED['hc_ordering' . $id])? intval($_POSTED['hc_ordering' . $id]):0,
                        'hc_required' => isset($_POSTED['hc_required' . $id])? sanitize_text_field($_POSTED['hc_required' . $id]):'off',
                        'hc_input_show_default' => isset($_POSTED['hc_input_show_default' . $id])? sanitize_text_field($_POSTED['hc_input_show_default' . $id]):'',
                        'hc_left_right' => isset($_POSTED['hc_left_right' . $id]) ? sanitize_text_field($_POSTED['hc_left_right' . $id]) : 'left',
                        'hc_other_field' => $hc_other_field,
                        'name' => isset($_POSTED['titleimage' . $id]) ? wp_kses($_POSTED['titleimage' . $id],$allowedposttags) : '',
                        'description' => isset($_POSTED['im_description' . $id]) ? sanitize_text_field($_POSTED['im_description' . $id]) : '',
                        'hc_field_label' => isset($_POSTED['imagess' . $id])? sanitize_text_field(wp_unslash($_POSTED['imagess' . $id])):'',
                        'def_value' => isset($_POSTED['def_value' . $id])? sanitize_text_field(wp_unslash($_POSTED['def_value' . $id])):'',
                        'mask_on' => isset($_POSTED['mask_on' . $id])? sanitize_text_field(wp_unslash($_POSTED['mask_on' . $id])):'',
                        'field_type' => isset($_POSTED['field_type' . $id]) ? sanitize_text_field($_POSTED['field_type' . $id]) : '',
                    ),
                    array('id' => $rowimages->id)
                );
            }
        }


        echo json_encode(array("saveForm" => "success"));
    }
}
/* End Save Entire Form */

	/* Change Theme */
	if (isset($_POST['task'])&&$_POST['task']=='changeFormTheme') {
		if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'builder_nonce')) {
			return false;
		}

		$themeId = absint($_POST['themeId']);
		$formId = absint($_POST['formId']);
		$all = $_POST['formData'];
		parse_str("$all",$myArray);
		$_POSTED = array_map('sanitize_text_field', $myArray);
		$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_contact_contacts_fields where hugeit_contact_id = %d order by id ASC",$formId);
	    $rowim=$wpdb->get_results($query);
		if ( isset( $_POSTED["name"] ) ) {
			if ( $_POSTED["name"] != '' ) {
				$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts SET  name = %s  WHERE id = %d ", sanitize_text_field(wp_unslash($_POSTED["name"])), $formId ) );
				$wpdb->query( $wpdb->prepare( "UPDATE " . $wpdb->prefix . "huge_it_contact_contacts SET  hc_yourstyle = %s  WHERE id = %d ", intval($themeId), $formId ) );
			}
		}
		foreach ( $rowim as $key => $rowimages ) {
			if ( isset( $_POSTED ) && isset( $_POSTED[ "hc_left_right" . $rowimages->id . "" ] ) ) {
				if ( $_POSTED[ "hc_left_right" . $rowimages->id . "" ] ) {
					$id = absint($rowimages->id);
					if ( isset( $_POSTED[ "field_type" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  field_type = %s 
							WHERE id = %d", sanitize_text_field($_POSTED[ "field_type" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "hc_other_field" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  hc_other_field = %s 
							WHERE id = %d", sanitize_text_field($_POSTED[ "hc_other_field" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "titleimage" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  name = %s  
							WHERE id = %d", sanitize_text_field(stripslashes( $_POSTED[ "titleimage" . $rowimages->id . ""
						] )), $id ) );
					}
					if ( isset( $_POSTED[ "im_description" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  description = %s  
							WHERE id = %d", sanitize_text_field($_POSTED[ "im_description" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "hc_required" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  hc_required = %s 
							WHERE id = %d", sanitize_text_field($_POSTED[ "hc_required" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "imagess" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  hc_field_label = %s  
							WHERE id = %d", sanitize_text_field(stripslashes( $_POSTED[ "imagess" . $rowimages->id . ""
						] )), $id ) );
					}
					if ( isset( $_POSTED[ "hc_left_right" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  hc_left_right = %s  
							WHERE id = %d", sanitize_text_field($_POSTED[ "hc_left_right" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "hc_ordering" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  ordering = %s  
							WHERE id = %d", intval($_POSTED[ "hc_ordering" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "def_value" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  def_value = %s  
							WHERE id = %d", sanitize_text_field($_POSTED[ "def_value" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "mask_on" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  mask_on = %s  
							WHERE id = %d", sanitize_text_field($_POSTED[ "mask_on" . $rowimages->id . "" ]),
							$id ) );
					}
					if ( isset( $_POSTED[ "hc_input_show_default" . $rowimages->id . "" ] ) ) {
						$wpdb->query( $wpdb->prepare(
							"UPDATE " . $wpdb->prefix . "huge_it_contact_contacts_fields 
							SET  hc_input_show_default = %s  
							WHERE id = %d", sanitize_text_field($_POSTED[ "hc_input_show_default" . $rowimages->id . "" ]),
							$id ) );
					}
				}
			}
		}
		echo hugeit_contact_drawThemeNew($themeId);
	}
/* Change Theme */
