<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regist extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
        }

        public function _remap($mode, $arg="")
        {
          //변수 설정
          $data['page_title'] = '클럽등록';
          $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';
          $data['mode'] = "regist";
          $this->load->view('templates/header', $data); //헤더 인클루드
          switch($mode){
            case 'ok': break;

            default :
              $this->_regist($mode);
            break;
          }
          $this->load->view('templates/footer'); //푸터 인클루드
        }

        /* 클럽 등록 */
        public function _regist($mode){
          if(!isset($_SESSION['logged_in'])){
            echo "<script type='text/javascript'>
              alert('해당 서비스를 이용하기 위해서는 로그인이 필요합니다.');
              document.location.href='/member/login?ref=club/regist'
            </script>";
            exit;
          }
          $this->load->view('club/regist', $mode);
        }
}