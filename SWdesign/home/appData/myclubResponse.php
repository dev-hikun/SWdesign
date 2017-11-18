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

    $needArr = array("type");
    foreach($needArr as $key=>$val){
        if(!in_array($val, $keyCheckArr)){
            echo failed("[{$val}] is necessary for servers.");
            exit;
        }
    }


///////////////////////////////////////////////////////////////////////////////////////////////
if($s['type'] == "list"){
 $query = "SELECT c.clubIdx, c.title FROM `clubmember` as m , `club` as c WHERE m.clubIdx = c.clubIdx and m.permit < 3 and m.memberIdx='{$s['memberIdx']}'";
 $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));
}else if($s['type'] == "view"){
 $query = "SELECT c.*, count(cm.clubIdx) as memberCnt, IF(m.public=0, m.nickName, m.name) as name, m.memberIdx as adminIdx FROM `clubmember` as cm , `club` as c, member m WHERE cm.clubIdx = c.clubIdx and cm.memberIdx = m.memberIdx and cm.permit='0' and c.clubIdx='{$s['clubIdx']}' group by cm.clubIdx";
 $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));

 $member_q = "SELECT memberIdx, permit from clubmember where clubIdx='{$s['clubIdx']}'";
 $member_r = mysqli_query($con, $member_q)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $mebmer_q, mysqli_error($con)));
    $j = 0;
    $returnMemberArr = array();
    while($member_data = mysqli_fetch_array($member_r)){
        $tempArr = array();
        foreach($member_data as $key=>$val){
            $tempArr[$key] = $val;
        }
        $returnMemberArr[$j] = $tempArr;
        $j++;
    }
}else if($s['type'] == 'changePermit'){ //////////////////////가입 승인 및 등급변경
    $query = "UPDATE clubmember SET permit='{$s['permit']}' where clubIdx='{$s['clubIdx']}' and memberIdx='{$s['memberIdx']}'";
    $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));

    echo json_encode(array("success"=>true, "query"=>$query));
    exit;
}else if($s['type'] == 'expulsion'){ //////////////////////제명
    $query = "DELETE FROM clubmember where clubIdx='{$s['clubIdx']}' and memberIdx='{$s['memberIdx']}'";
    $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));

    echo json_encode(array("success"=>true, "query"=>$query));
    exit;
}else{
    $query ="";
}
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

if($s['type'] != 'approval' && $s['type'] != 'expulsion'){
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
    if($s['type'] == "view"){
        $returnArr["memberList"] = $returnMemberArr;
    }
    echo json_encode(array("list"=>$returnArr, "success"=>true, "query"=>$query));
}

//////////////////////////////////////////////////////////////////////////////
function failed($msg, $query="", $error=""){
    $arr = array("success"=>false, "message"=>$msg);

    if($error) $arr["error"] = $error;
    if($query) $arr["query"] = $query;
    return json_encode($arr);
}
?>