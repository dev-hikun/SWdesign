<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
        public function __construct() {
           parent::__construct();
           $this->load->helper('form');
        }
        public function _remap($mode="", $args)
        {
          //변수 설정
          $data['page_title'] = '로그인';
          $data['css_link'] = '<link href="/libraries/css/member.css" rel="stylesheet" type="text/css" />';

          $this->load->view('templates/header', $data);
    		  if($mode == "index"){
    			$this->load->view('member/login', $data);
    		  }else if($mode == "ok"){
    			  $this->_ok();
    		  }else if($mode == "bye"){
				  $this->_logout();
			  }
          $this->load->view('templates/footer');
        }

		private function _ok(){
			if(!$_POST || isset($_SESSION['logged_in'])) exit('비정상적인 접근입니다.');
      $mData['pw'] = $_POST['passwd'];
      $mData['email'] = $_POST['email'];
      $mData['permit'] = $_POST['permit'];
      if($mData['email'] == "admin@werun.pe.kr") $mData['permit'] = 0;
      $this->load->model('member/member');
      $res = $this->member->login($mData);
      if($res == false){
          echo "<script type='text/javascript'>
            alert('아이디나 비밀번호, 회원구분을 확인해주세요.');
            history.back();
          </script>";
          exit;
      }

      if(isset($_SESSION['logged_in']) == true){
          exit('비정상적인 접근입니다.');
      }else{
          $sessData = array(
            'email' => $res['email'],
            'permit' => $res['permit'],
            'name' => $res['name'],
            'nickName' => $res['nickName'],
            'sex' => $res['sex'],
            'addr' => $res['addr'],
            'idx' => $res['memberIdx'],
            'logged_in' => 'Y'
          );
          $this->session->set_userdata($sessData);
          header('Location: /index.php');
      }
		}
		
		// 로그아웃
		private function _logout(){
			if(isset($_SESSION['logged_in']) == false){
				exit('비정상적인 접근입니다.');
			}
			
			unset(
				$_SESSION['email'],
				$_SESSION['permit'],
				$_SESSION['name'],
				$_SESSION['nickName'],
				$_SESSION['sex'],
				$_SESSION['addr'],
				$_SESSION['memberIdx'],
				$_SESSION['logged_in']
			);
			
			header('Location: /index.php');
		}

}