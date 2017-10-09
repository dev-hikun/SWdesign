<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {
        public function __construct() {
           parent::__construct();
        }
        public function _remap($arg="")
        {
           $data['page_title'] = '회원가입';
           $data['css_link'] = '<link href="/libraries/css/member.css" rel="stylesheet" type="text/css" />';

          $this->load->view('templates/header', $data);
          switch($arg){
            case "general":
              $this->_general();
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

        private function _general(){
            $this->load->view('member/join_general');
        }

        private function _host(){
            $this->load->view('member/join_select');
        }
}