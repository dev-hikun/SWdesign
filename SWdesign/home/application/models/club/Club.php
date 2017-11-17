<?php
class Club extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function itHasPowerofClub($s){
        $sql = "select adminIdx from club where adminIdx='".$s."'";
        $res = $this->db->query($sql);
        if($res->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function regist($d)
    {
		$arr = array($d['idx'], $d['title'], date("Y-m-d",time()), $d['addr'], $d['area'], $d['juso1'], $d['juso2'], $d['sigan'], $d['parts'], $d['file'], $d['description'], $d['content'], $d['public']);

        $this->db->trans_start();
    		$sql = "insert into club(adminIdx, title, birth, addr, area, juso1, juso2, sigan, part, image, description, contents, public) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $res = $this->db->query($sql, $arr);

            $sql2 = "select clubIdx from club where title=? and adminIdx=?";
            $res2 = $this->db->query($sql2, array($d['title'], $d['idx']));
            if($res2->num_rows() != 0){
                $row = $res2->row();

                $sql3 = "insert into clubmember(clubIdx, memberIdx) values(?, ?)";
                $res3 = $this->db->query($sql3, array($row->clubIdx, $d['idx']));
            }

        $this->db->trans_complete();
        $result = $this->db->trans_status();

        if(!$result){
            return false;
        }else{
            return true;
        }
    }
}
?>