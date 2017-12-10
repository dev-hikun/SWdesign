<?php
class Lists extends CI_Controller {
  public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
  }

  public function _remap($mode)
  {
    //변수 설정
    $data['page_title'] = '대회 리스트';
    $data['css_link'] = '<link href="/libraries/css/competition.css" rel="stylesheet" type="text/css" />';
    $data['mode'] = 'lists';
    $this->load->view('templates/header', $data); //헤더 인클루드
    $this->_List($data);
    $this->load->view('templates/footer'); //푸터 인클루드
  }

  private function _List($d){
    $this->load->view('competition/list', $d);
  }
}
?>