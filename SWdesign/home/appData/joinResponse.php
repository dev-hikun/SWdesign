<?php
    include "db.php";

    header("Content-Type:application/json;charset=utf-8");

    if(!$_POST){
        echo json_encode(array("data" => array("success"=>false)));
    }else{
        echo json_encode(array("data" => array("success"=>true)));
    }
?>