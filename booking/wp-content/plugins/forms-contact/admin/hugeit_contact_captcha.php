<?php
if(!isset($_SESSION))session_start();


function hugeit_contact_get_field_row($id){
    global $wpdb;
    $id=intval($id);
    $query="SELECT * FROM  " . $wpdb->prefix . "huge_it_contact_contacts_fields WHERE id={$id}";
    $captcha_field=$wpdb->get_results($query,'ARRAY_A');

    return $captcha_field[0];
}



function hugeit_contact_create_new_captcha($captcha_id='',$from='',$time=''){

    $upload_dir=wp_upload_dir();


    if (!file_exists($upload_dir['basedir']."/hugeit_forms_tmp")) {
        mkdir($upload_dir['basedir']."/hugeit_forms_tmp", 0777, true);
    }

    $current_dir = getcwd(); // Save the current directory
    $dir = $upload_dir['basedir']."/hugeit_forms_tmp/";

    chdir($dir);
    /*** cycle through all files in the directory ***/
    foreach (glob($dir."*") as $file) {
        /*** if file is 1/2 hours (1800 seconds) old then delete it ***/
        if (filemtime($file) < time() - 1800) {
            unlink($file);
        }
    }
    chdir($current_dir); // Restore the old working directory



    $is_ajax_request=false;
    if(isset($_POST['captchaid'])){
        $captcha_id=$_POST['captchaid']; $from='user';
        $is_ajax_request=true;
        $time=$_POST['time'];
    }
    else{
        $time=time();
    }

    $field = hugeit_contact_get_field_row($captcha_id);

    $captchaRow = json_decode($field['hc_other_field']);

    $digitsLength = (isset($captchaRow->digits))?$captchaRow->digits:5;

    $colorOption = $field['description'];

    $captcha='';

    if(!$digitsLength){
        $digitsLength=5;
    }

    for($i=1;$i<=$digitsLength;$i++){
        $randnumber=rand(65,122);
        while(in_array($randnumber,array(91,92,93,94,95,96))){
            $randnumber=rand(65,122);
        }
        $captcha.=chr($randnumber);
    }


    if($digitsLength<=5){$font_size=30;}
    else{$font_size=25;}



    $_SESSION['hugeit_contact_captcha-'.$from.'-'.$captcha_id.'-'.$captcha_id.$time]=$captcha;



    $font=plugin_dir_path(__FILE__).'../elements/fonts/Roboto-Regular.ttf';
    $image=imagecreatetruecolor(170,60);

    $black=imagecolorallocate($image,0,0,0);
    $white=imagecolorallocate($image,255,255,255);

    if($colorOption=='default'){
        $color=imagecolorallocate($image,rand(0,200),rand(0,200),rand(0,200));
    }
    else{
        $color=$captchaRow->color;
        $rgbArray=hugeit_hex_to_rgb($color);
        $color=imagecolorallocate($image,$rgbArray['red'],$rgbArray['green'],$rgbArray['blue']);
    }


    imagefilledrectangle($image,0,0,200,100,$color);
    imagettftext($image,$font_size,5,30,45,$white,$font,$captcha);

    $filename='captcha-'.$from.'-'.md5($captcha_id.$time).'.png';

    imagepng($image,$dir.'/'.$filename);

    if($is_ajax_request){
        wp_send_json($upload_dir['baseurl']."/hugeit_forms_tmp/".$filename);
    }

    return $upload_dir['baseurl']."/hugeit_forms_tmp/".$filename;

}


function hugeit_hex_to_rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array(
        'red'=>$r,
        'green'=>$g,
        'blue'=>$b
    );
    return $rgb; // returns an array with the rgb values
}

?>
