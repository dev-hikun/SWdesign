<?php
    include "db.php";

    header("Content-Type:application/json;charset=utf-8");

    if(mysqli_connect_errno($con)){
        echo failed("failed to connect database!");
        exit;

    }else{
        if(!$_POST){
            echo failed("Servers require post-data~");
            exit;
        }else{
            postProcess($_POST, $con);
        }

        if($_FILES){

        }
    }

    function failed($msg, $query="", $error=""){
        $arr = array("success"=>false, "message"=>"hey sunghwan, ".$msg);

        if($error) $arr["error"] = $error;
        if($query) $arr["query"] = $query;
        return json_encode(array("data" => $arr));
    }

    function postProcess($data, $con){
        foreach($data as $key=>$val){
            if($key == "table" || $key == "fields" || $key == "values") continue;
            else{
                echo failed("[".$key."] is not necessary for servers.");
                exit;
            }
        }

        $table = $data['table'];
        $fields = $data['fields'];
        $values = $data['values'];

        if(!$table || !$fields || !$values) echo failed("Try again after give server all the necessary variable.");

        $field_str = "";
        foreach($fields as $val){
            if($field_str != "") $field_str .= ", ";
            $field_str .= $val;
        }

        $value_str = "";
        foreach($values as $val){
            if($value_str != "") $value_str .= ", ";
            if(strpos($val, "assword") == 1) $value_str .= htmlspecialchars($val);
            else $value_str .= "'".$val."'";
        }

        $str = "insert into `{$table}`";
        $str .= " (".$field_str.")";
        $str .= " values";
        $str .= " (".$value_str.")";

        mysqli_query($con, $str)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $str, mysqli_error($con)));

        echo json_encode(array("data" => array("success"=>true, "message"=>$str)));
    }
?>