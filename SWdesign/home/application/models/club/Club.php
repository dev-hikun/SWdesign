<?php
class Club extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function regist($d)
    {
        $sql = "insert into club(adminIdx, title, birth, addr, part, image, description, contents, public) values(?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $res = $this->db->query($sql, array($d['idx'], $d['title'], date("Y-m-d",time()), $d['addr'], $d['parts'], $d['file'], $d['description'], $d['content']));

        if(!$res){
            return false;
        }else{
            return true;
        }
    }
}
?>