<?php
include_once "../base.php";

foreach($_POST['id'] as $k=>$id){
    if(isset($_POST['del'])&&in_array($id,$_POST['del'])){
        $Poster->del($id);
    }else{
        $p=$Poster->find($id);
        $p['name']=$_POST['name'][$k];
        $p['sh']=isset($_POST['sh'])&&in_array($id,$_POST['sh'])?1:0;
        $p['ani']=$_POST['ani'][$k];
        $Poster->save($p);
    }
}

to('../back.php?do=poster');