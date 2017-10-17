<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {
        public function __construct() {
           parent::__construct();
           $this->load->helper('form');
        }
        public function _remap($mode="", $args)
        {
          //변수 설정
          $data['page_title'] = '회원가입';
          $data['css_link'] = '<link href="/libraries/css/member.css" rel="stylesheet" type="text/css" />';

          $this->load->view('templates/header', $data);
          if(!$args) $args[0] = 1;

          switch($mode){
            case "general":
              $this->_general($args[0]);
            break;
            case "host":
              $this->_host();
            break;
            default:
              $this->_select();
            break;
          }

          $this->load->view('templates/footer');
        }

        private function _select(){
            $this->load->view('member/join_select');
        }

        private function _general($step){
          if($step == 1){
            $this->load->view('member/join_general');
          }else{
            $this->load->view('member/join_general2');
          }
        }

        private function _host(){
            $this->load->view('member/join_select');
        }
}