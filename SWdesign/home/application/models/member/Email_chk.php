<?php
/**
 * Email_chk
 *
 * Created on 2017. 11. 07.
 * @author 이희현 <hihyeoni@naver.com>
 * @version 1.0
 */
class Email_chk extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function dupChk($data)
    {
		$query = $this->db->query("SELECT * FROM `member` WHERE EMAIL='".$data['id'].'@'.$data['domain']."';");
		
		if($query->num_rows() > 0){
			return true;
			exit;
		}else{
			return false;
			exit;
		}
    }
}
