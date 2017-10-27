<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {
        public function __construct() {
           parent::__construct();

           $this->load->helper(array('form', 'url'));
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
            case "ok":
              $this->_ok();
            break;
            default:
              $this->_select();
            break;
          }

          $this->load->view('templates/footer');
        }

        //회원가입 선택화면으로 이동.
        private function _select(){
            $this->load->view('member/join_select');
        }

        //일반 회원가입
        private function _general($step){
          if($step == 1){
            //일반회원 스텝 1
            $this->load->view('member/join_general');
          }else{
            //일반회원 스텝 2
            $this->load->view('member/join_general2');
          }
        }

        //주최측 회원가입
        private function _host(){
            $this->load->view('member/join_select');
        }

        private function _ok(){
          $config['upload_path'] = '/site_data/member_img/';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = '100';
          $config['max_width']  = '1024';
          $config['max_height']  = '768';

          $this->load->library('upload', $config);
          $error = array('error' => $this->upload->display_errors());
        }
}