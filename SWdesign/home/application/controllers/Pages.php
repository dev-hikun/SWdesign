<?php
class Pages extends CI_Controller {

        public function index()
        {
		  $data['page_title'] = '회원가입';
		  $this->load->view('templates/header', $data);
		  $this->load->view('pages/PageView');
		  $this->load->view('templates/footer');
        }

		public function comments(){
			echo 'Look at this!';
		}

		public function test($a, $b){
			echo $a."<br />";
			echo $b;
		}
}