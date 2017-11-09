<?php
class Club extends CI_Controller {

        public function index()
        {
          //변수 설정
          $data['page_title'] = '로그인';
          $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';

          $this->load->view('templates/header', $data);
          $this->load->view('club/list');
          $this->load->view('templates/footer');
        }
}