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
		  }
          $this->load->view('templates/footer');
        }
		
		private function _ok(){
			print_r($_POST);
		}

}