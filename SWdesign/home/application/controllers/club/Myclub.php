<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyClub extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    public function _remap($mode, $args="")
    {
      if(!(isset($_SESSION) && isset($_SESSION['logged_in']))){
        echo "<script type='text/javascript'>
          alert('해당 서비스를 이용하기 위해서는 로그인이 필요합니다.');
          document.location.href='/member/login?ref=club/myclub'
        </script>";
        exit;

      }
      //변수 설정
      $data['page_title'] = '나의클럽';
      $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';
      $data['mode'] = "myclub";
      $data['submode'] = $mode;
      if($mode != 'index'){
        $data['type'] = 0;
        $data['clubIdx'] = $args[0];
        if($mode == 'notice') $data['notice'] = 0;
        if($mode == 'board') $data['notice'] = 1;
        //게시판 가져옴
        $this->load->library('werunBoard', $data);
      }

      $this->load->view('templates/header', $data); //헤더 인클루드
      if($mode == 'index'){
        $this->load->view('club/myclub', $data);
      }else if($mode == 'notice'){
        $this->load->view('club/myclub_board', $data);
      }else if($mode == 'board'){
        $this->load->view('club/myclub_board', $data);
      }
      $this->load->view('templates/footer'); //푸터 인클루드
    }
}