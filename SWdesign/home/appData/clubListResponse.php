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

    if(!in_array("start", $keyCheckArr)) $s['start'] = 0;
    if(!in_array("Limit", $keyCheckArr)) $s['limit'] = 10;
    if(!in_array("key", $keyCheckArr)) $s['key'] = null;
    if(!in_array("area", $keyCheckArr)) $s['area'] = null;
    if(!in_array("part", $keyCheckArr)) $s['part'] = null;
    if(!in_array("table", $keyCheckArr)){
        echo failed("[table] is necessary for servers.");
        exit;
    }

///////////////////////////////////////////////////////////////////////////////////////////////
    $query = "select * from {$s['table']}";

    /* where절 */
    $where = " where clubIdx > 0";
    $limit = "";
    if($s['key'] != null) $where .= " and (title like '%{$s['key']}%' or content like '%{$s['key']}%' or description like '%{$s['key']}%') or addr like '%{$s['key']}%'";

    if($s['area'] != null) $where .= " and (addr like '%{$s['area']}%')";

    if($s['part'] != null) $where .= " and (addr like '%{$s['part']}%')";

    if($s['start'] != null && $s['limit'] != null) $limit = " limit {$s['start']}, {$s['limit']}";

    $query .= $where;
    $query .= $limit;

    //echo json_encode($query);

//////////////////////////////////////////////////////////////////////////////////////////////////


    $res1 = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));
    $res2 = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));

    $i = 0;
    $returnArr = array();
    while($data = mysqli_fetch_array($res1)){
        $tempArr = array();
        foreach($data as $key=>$val){
            $tempArr[$key] = $val;
        }
        $returnArr[$i] = $tempArr;
        $i++;
    }



    echo json_encode(array("num"=>mysqli_num_rows($res2), "list"=>$returnArr));

//////////////////////////////////////////////////////////////////////////////

    function failed($msg, $query="", $error=""){
        $arr = array("success"=>false, "message"=>$msg);

        if($error) $arr["error"] = $error;
        if($query) $arr["query"] = $query;
        return json_encode(array("data" => $arr));
    }
?>