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

    $needArr = array("memberIdx", "type");
    foreach($needArr as $key=>$val){
        if(!in_array($val, $keyCheckArr)){
            echo failed("[{$val}] is necessary for servers.");
            exit;
        }
    }


///////////////////////////////////////////////////////////////////////////////////////////////
if($s['type'] == "list"){
 $query = "SELECT c.clubIdx, c.title FROM `clubmember` as m , `club` as c WHERE m.clubIdx = c.clubIdx and m.memberIdx='{$s['memberIdx']}'";
 $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));
}else if($s['type'] == "view"){
 $query = "SELECT c.*, count(cm.clubIdx) as memberCnt, IF(m.public=0, m.nickName, m.name) as name FROM `clubmember` as cm , `club` as c, member m WHERE cm.clubIdx = c.clubIdx and c.adminIdx = m.memberIdx and c.clubIdx='{$s['clubIdx']}' group by cm.clubIdx";
 $query2 = "SELECT c.*, count(cm.clubIdx) as memberCnt, IF(m.public=0, m.nickName, m.name) as name FROM `clubmember` as cm , `club` as c, member m WHERE cm.clubIdx = c.clubIdx and c.adminIdx = m.memberIdx and c.clubIdx='{$s['clubIdx']}' and cm.memberIdx = '{$s['memberIdx']}' group by cm.clubIdx";
 $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));
 $data_res2 = mysqli_query($con, $query2)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query2, mysqli_error($con)));
 $nums = mysqli_num_rows($data_res2);
 if($nums < 1){
    echo failed("unknown Error");
    exit;
 }
}else{
    $query = "";
}
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

    $i = 0;
    $returnArr = array();
    while($data = mysqli_fetch_array($data_res)){
        $tempArr = array();
        foreach($data as $key=>$val){
            $tempArr[$key] = $val;
            if(($key == "image" || $key == "8") && ($val==null && $val=="")) $tempArr[$key] = "noimage980by170.jpg";
        }
        $returnArr[$i] = $tempArr;
        $i++;
    }

    echo json_encode(array("list"=>$returnArr, "success"=>true, "query"=>$query));

//////////////////////////////////////////////////////////////////////////////
function failed($msg, $query="", $error=""){
    $arr = array("success"=>false, "message"=>$msg);

    if($error) $arr["error"] = $error;
    if($query) $arr["query"] = $query;
    return json_encode($arr);
}
?>