<?php
class Club extends CI_Controller {
  public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
  }

  public function _remap($mode)
  {
    //변수 설정
    $data['page_title'] = '클럽리스트';
    $data['css_link'] = '<link href="/libraries/css/club.css" rel="stylesheet" type="text/css" />';
    $data['mode'] = 'list';

    $this->load->view('templates/header', $data); //헤더 인클루드
    switch($mode){
      case 'index':
        $this->load->view('club/list', $data);
      break;
      case 'regist':
        $this->_regist($mode); break;
        parent::back();
      break;
      case 'myclub':
        parent::alert('준비중입니다.');
        parent::back();
      break;
      default:
        parent::alert('잘못된 경로입니다.');
        parent::back();
      break;
    }
    $this->load->view('templates/footer'); //푸터 인클루드
  }

  public function _regist($mode){
    if(!isset($_SESSION['logged_in'])){
      parent::log('해당 서비스를 이용하기 위해서는 로그인이 필요합니다.');
      parent::move('/member/login?ref=club/regist');
      exit;
    }
    $this->load->view('club/regist', $mode);
  }
}
?>