<?php
// Code to process uploads
if($_FILES && !$_FILES['ajax_file']['error']){
    $allowed_types = ["audio","image","video"];
    $type = substr($_FILES['ajax_file']['type'],0,5);
    //Check if uploaded file is image,audio or video then save file
    if(in_array($type,$allowed_types)){
        move_uploaded_file($_FILES['ajax_file']['tmp_name'],"files/".$_FILES['ajax_file']['name']);
    }
}
?>