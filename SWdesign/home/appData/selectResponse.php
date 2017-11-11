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
    }

    /* 실패 메세지 */
    function failed($msg, $query="", $error=""){
        $arr = array("success"=>false, "message"=>"hey sunghwan, ".$msg);

        if($error) $arr["error"] = $error;
        if($query) $arr["query"] = $query;
        return json_encode(array("data" => $arr));
    }

    /* 셀렉트 뽑아주기~ */
    function postProcess($data, $con){
        foreach($data as $key=>$val){
            if($key == "table" || $key == "where" || $key == "order" || $key == "fields") continue;
            else{
                echo failed("[".$key."] is not necessary for servers.");
                exit;
            }
        }

        $table = $data['table'];
        $fields = $data['fields'];
        $where = $data['where'];
        $order = $data['order'];

        if(!$table || !$fields || !$where || !$order) echo failed("Try again after give server all the necessary variable.");

        $field_str = "";
        foreach($fields as $val){
            if($field_str != "") $field_str .= ", ";
            $field_str .= $val;
        }


        $str = "select {$field_str} from `{$table}` where {$where} {$order}";

        $res = mysqli_query($con, $str)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $str, mysqli_error($con)));

        $i = 0;
        $returnArr = array();
        while($data = mysqli_fetch_array($res)){
            $tempArr = array();
            foreach($data as $key=>$val){
                $tempArr[$key] = $val;
            }
            $returnArr[$i] = $tempArr;
            $i++;
        }
        echo json_encode(array("data" => array("success"=>true, "data"=>$returnArr)));
    }
?>