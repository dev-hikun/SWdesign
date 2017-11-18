<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function _remap($mode)
    {
    //변수 설정
    $data['page_title'] = '클럽가입신청';
    $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';
    $data['mode'] = 'lists';
    $this->load->view('templates/header', $data); //헤더 인클루드
    $this->load->view('club/join', $data);
    $this->load->view('templates/footer'); //푸터 인클루드
    }
}

?>