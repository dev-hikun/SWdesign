<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {
        public function __construct() {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
            $this->load->model('member/email_chk');
        }
        public function _remap($mode="", $args)
        {
          //변수 설정
          $data['page_title'] = '회원가입';
          $data['css_link'] = '<link href="/libraries/css/member.css" rel="stylesheet" type="text/css" />';
		  if($mode == "chk"){
			  $this->_chk();
		  }else{
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

        //중복확인 체크
        private function _chk(){
          if(!$_POST){
              $this->output->set_content_type('application/json; charset=utf-8');
          }else{
			  
            $this->output->set_content_type('application/json; charset=utf-8');
            $json_dt['id'] = $_POST['id'];
            $json_dt['domain'] = $_POST['domain'];
			$this->email_chk->dupChk($json_dt);
			echo json_encode($this->email_chk->dupChk($json_dt));
			exit;
          }
        }

        //회원가입 완료
        private function _ok(){
			echo "<script type='text/javascript'>alert('준비중입니다.'); history.back(); exit;</script>";
          //post data 받음
          $data['post'] = $this->input->post();

          //업로드를 위한..
          $config = array(
            'upload_path' => './site_data/member_img/',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => '100',
            'max_width' => '1024',
            'max_height' => '768',
            'remove_spaces' => true,
            'encrypt_name' => true
          );

          $this->load->library('upload', $config);


          if($this->upload->do_upload("profileImage")){
            echo $this->upload->data("file_name"); // converted file name
            echo $this->upload->data("orig_name"); // original name
            echo $this->upload->data("file_size"); // uploaded file size
          }else{
            $error = array('error' => $this->upload->display_errors());

          }
        }
}