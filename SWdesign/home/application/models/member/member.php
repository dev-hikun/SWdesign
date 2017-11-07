<?php
/**
 * member
 *
 * Created on 2017. 11. 08.
 * @author 이희현 <hihyeoni@naver.com>
 * @version 1.0
 */
class Member extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function join($data)
    {
        $sql = "insert into member(email, passwd, name, nickName, birth, sex, addr1, addr2, zipCode, phone, parts, public, permit, profileImage) values(?, password(?), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $res = $this->db->query($sql, array($data['id'], $data['pw'], $data['name'], $data['nickName'], $data['birth'], $data['sex'], $data['addr1'], $data['addr2'], $data['zipCode'], $data['phone'], $data['parts'], $data['public'], $data['permit'], $data['file']));

        if(!$res){
            return false;
        }else{
            return true;
        }
    }
}