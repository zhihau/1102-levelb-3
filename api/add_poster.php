<?php
include_once "../base.php";

if(!empty($_FILES['path']['tmp_name'])){
    move_uploaded_file($_FILES['path']['tmp_name'],"../img/".$_FILES['path']['name']);
    $data['path']=$_FILES['path']['name'];
    $data['name']=$_POST['name'];
    $maxid=$Poster->math('max','id');
    $data['rank']=$maxid+1;
    $Poster->save($data);
}

to('../back.php?do=poster');