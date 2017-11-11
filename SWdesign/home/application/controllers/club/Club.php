<?php
class Club extends CI_Controller {
  public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
  }

  public function index()
  {
    //변수 설정
    $data['page_title'] = '클럽리스트';
    $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';
    $data['mode'] = 'list';
    $this->load->view('templates/header', $data); //헤더 인클루드
    $this->load->view('club/list', $data);
    $this->load->view('templates/footer'); //푸터 인클루드
  }
}
?>