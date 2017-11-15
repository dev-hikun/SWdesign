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
		$arr = array($d['idx'], $d['title'], date("Y-m-d",time()), $d['addr'], $d['area'], $d['parts'], $d['file'], $d['description'], $d['content'], $d['public']);

		print_r($arr);

		$sql = "insert into club(adminIdx, title, birth, addr, area, part, image, description, contents, public) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $res = $this->db->query($sql, $arr);

        if(!$res){
            return false;
        }else{
            return true;
        }
    }
}
?>