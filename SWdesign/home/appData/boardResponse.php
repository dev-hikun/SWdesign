<?php
    include "db.php";
    header("Content-Type:application/json;charset=utf-8");

    $s = $_POST;

/////////////////////////////////////////////////////////////////////////////////////////////
    if(!$s){
        echo failed("Servers require post-data");
        exit;
    }

    $keyCheckArr = array();
    foreach($s as $key=>$val){
        array_push($keyCheckArr, $key);
    }

    $needArr = array("type", "boardType", "adminIdx", "isNotice");
    foreach($needArr as $key=>$val){
        if(!in_array($val, $keyCheckArr)){
            echo failed("[{$val}] is necessary for servers.");
            exit;
        }
    }

    if(!in_array("start", $keyCheckArr)) $s["start"] = "";
    if(!in_array("limit", $keyCheckArr)) $s["limit"] = "";
//////////////////////////////////////////////////////////////////////////////
    $limit = "";
    $where = "";

    $query = "SELECT IF(m.public=0, m.nickName, m.name) as name, b.* FROM `board` b, `member` m WHERE b.memberIdx = m.memberIdx";

    $where .= " and (adminIdx = '{$s['adminIdx']}')";
    if($s['start'] != null && $s['limit'] != null) $limit = " limit {$s['start']}, {$s['limit']}";

    $query .= $where;

    $num_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));
    $query .= $limit;
    $query .= " order by groupIdx desc, depth asc, idx asc";


//////////////////////////////////////////////////////////////////////////////////////////////////


    $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));

    $i = 0;
    $returnArr = array();
    while($data = mysqli_fetch_array($data_res)){
        $tempArr = array();
        foreach($data as $key=>$val){
            $tempArr[$key] = $val;
            if(($key == "image" || $key == "8") && ($val==null && $val=="")) $tempArr[$key] = "noImage300by150.jpg";
        }
        $returnArr[$i] = $tempArr;
        $i++;
    }

    echo json_encode(array("num"=>mysqli_num_rows($num_res), "list"=>$returnArr, "success"=>true/*, "query"=>$query*/));

//////////////////////////////////////////////////////////////////////////////////////////////////


function failed($msg, $query="", $error=""){
    $arr = array("success"=>false, "message"=>$msg);

    if($error) $arr["error"] = $error;
    if($query) $arr["query"] = $query;
    return json_encode($arr);
}
?>