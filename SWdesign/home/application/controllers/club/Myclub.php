<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyClub extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        //Model Load
        $this->load->model('club/myclubs');
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
      $data['isAdmin'] = 'N';

      if(isset($_GET['clubIdx'])){
          if($this->myclubs->adminChk($_GET['clubIdx'], $_SESSION['idx']) == true){
              $data['isAdmin'] = 'Y';
          }
          $data['clubIdx'] = $_GET['clubIdx'];
      }

      if($mode != 'index' && $mode != 'admin'){
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
      }else if($mode == 'admin'){
        $data['admin'] = $this->myclubs->getInfo($_GET['clubIdx']);
        $data['admin']['list'] = $this->myclubs->getMyclubList($_SESSION['idx']);
        if($this->myclubs->adminChk($_GET['clubIdx'], $_SESSION['idx']) == false){
          echo "<script type='text/javascript'>
            alert('접근권한이 없습니다.');
            history.back();
          </script>";
          exit;
        }
        $this->load->view('club/myclub_admin', $data);
      }
      $this->load->view('templates/footer'); //푸터 인클루드
    }
}