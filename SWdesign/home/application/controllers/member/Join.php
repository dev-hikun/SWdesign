<?php
class Join extends CI_Controller {

        public function index($arg = "")
        {
          $data['page_title'] = '회원가입';
          $this->load->view('templates/header', $data);
          if($arg == "") $this->_selectView();

          $this->load->view('templates/footer');
        }

        private function _selectView(){
            $this->load->view('member/join_select');
        }

        public function test($a, $b){
            echo $a."<br />";
            echo $b;
        }
}