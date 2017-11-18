<?php
class Myclubs extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function getAdminIdx($clubIdx){
        $sql = "select memberIdx from clubMember where clubIdx='{$clubIdx}' and permit='0'";
        $r = $this->db->query($sql);
        if($r->num_rows() != 0){
            $row = $r->row();
            return $row->memberIdx;
        }else{
            return "error";
        }
    }

    public function getInfo($clubIdx){
        $sql = "SELECT c.*, count(cm.clubIdx) as memberCnt, IF(m.public=0, m.nickName, m.name) as name, m.memberIdx as adminIdx FROM `clubmember` as cm , `club` as c, member m WHERE cm.clubIdx = c.clubIdx and cm.memberIdx = m.memberIdx and cm.permit='0' and c.clubIdx='{$clubIdx}' group by cm.clubIdx";
        $r = $this->db->query($sql);
        if ($r->num_rows() > 0)
        {
                $row = $r->row_array();
                return $row;
        }
    }

    public function adminChk($clubIdx, $memberIdx){
        if($this->myclubs->getPermit($memberIdx, $clubIdx) < 2) return true;
        return false;
    }

    public function getMyClubList($memberList){
        $sql = "SELECT c.clubIdx, c.title FROM `clubmember` as m , `club` as c WHERE m.clubIdx = c.clubIdx and m.permit < 3 and m.memberIdx='{$memberList}'";
        $res = $this->db->query($sql);
        $resultArr = array();
        foreach ($res->result_array() as $row)
        {
            array_push($resultArr, $row);
        }
        return $resultArr;
    }

    public function getRequestArr($clubIdx){
        $sql = "SELECT m.email, m.phone, m.memberIdx, IF(m.public=0, m.nickName, m.name) as name, m.birth, m.sex, m.phone, m.addr1, m.addr2, c.permit FROM `clubmember` as c , `member` as m WHERE c.memberIdx = m.memberIdx and c.permit = '3' and c.clubIdx='{$clubIdx}'";
        $res = $this->db->query($sql);
        $resultArr = array();
        foreach ($res->result_array() as $row)
        {
            array_push($resultArr, $row);
        }
        return $resultArr;
    }

    public function getClubMember($clubIdx){
        $sql = "SELECT m.email, m.phone, m.memberIdx, IF(m.public=0, m.nickName, m.name) as name, m.birth, m.sex, m.phone, m.addr1, m.addr2, c.permit FROM `clubmember` as c , `member` as m WHERE c.memberIdx = m.memberIdx and c.permit < 3 and c.clubIdx='{$clubIdx}'";
        $res = $this->db->query($sql);
        $resultArr = array();
        foreach ($res->result_array() as $row)
        {
            array_push($resultArr, $row);
        }
        return $resultArr;
    }

    public function getPermit($memberIdx, $clubIdx){
        $sql = "SELECT permit From clubmember Where memberIdx='{$memberIdx}' and clubIdx='{$clubIdx}'";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0){
            $row = $res->row();
            return $row->permit;
        }
    }
}
?>