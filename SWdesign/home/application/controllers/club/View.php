<?php
class View extends CI_Controller {
  public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
  }

  public function _remap($mode, $args="")
  {
    //변수 설정
    $data['page_title'] = '클럽상세';
    $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';
    $data['mode'] = 'lists';
    $data['clubIdx'] = $mode;

    if($mode == "index"){
        echo "<script type='text/javascript'>
          alert('비정상적인 접근입니다.');
          document.location.href='/club/lists';
        </script>";
        exit;
    }

    $this->load->view('templates/header', $data); //헤더 인클루드
    $this->detail($data);
    $this->load->view('templates/footer'); //푸터 인클루드
  }

  private function detail($d){
    $this->load->view('club/view', $d);
  }
}
?>