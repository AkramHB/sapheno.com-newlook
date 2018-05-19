<?php

 interface ITemplate
 {

     public function build($template,$templateType,$message,$otp_type,$from_both);
     public function parse($template,$message,$otp_type,$from_both);
     public function getDefaults($templates);
     public function showPreview();
     public function savePopup();
 }