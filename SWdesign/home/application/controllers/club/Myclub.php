<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyClub extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));

        //Model Load
        $this->load->model('club/club');
    }
    public function _remap($mode, $arg="")
    {
      //변수 설정
      $data['page_title'] = '나의클럽';
      $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';
      $data['mode'] = "myclub";
      $this->load->view('templates/header', $data); //헤더 인클루드
      $this->load->view('club/myclub', $data);
      $this->load->view('templates/footer'); //푸터 인클루드
    }
}