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
        case 'ok':
          $this->_ok($_POST);
        break;

        default :
          $this->_regist($mode);
        break;
      }
      $this->load->view('templates/footer'); //푸터 인클루드
    }

    /* 클럽 등록 */
    private function _regist($mode){
      if(!isset($_SESSION['logged_in'])){
        echo "<script type='text/javascript'>
          alert('해당 서비스를 이용하기 위해서는 로그인이 필요합니다.');
          document.location.href='/member/login?ref=club/regist'
        </script>";
        exit;
      }
      $this->load->view('club/regist', $mode);
    }

    /* 클럽 등록 ok */
    private function _ok($data){
        if(!$data){
            echo "<script type='text/javascript'>alert('잘못된 접근입니다.'); history.back();</script>";
            exit;
        }

        unset($data['addrs']);
        $s = array();
        foreach($data as $key=>$val){
          if(!is_array($data[$key])){
            $s[$key] = htmlspecialchars($val);
          }
        }
        $s['addr'] = "";
        if(is_array($data["addr"])){
          foreach($data['addr'] as $key=>$val){
            if(!$s['addr']){
              $s['addr'] = $s['addr'].$val;
            }else{
              $s['addr'] = $s['addr']."|".$val;
            }
          }
        }
        $config = array(
          'upload_path' => './site_data/club_img/',
          'allowed_types' => 'gif|jpg|png|jpeg',
          'max_size' => '10240',
          'max_width' => '10240',
          'max_height' => '7680',
          'remove_spaces' => true,
          'encrypt_name' => true
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload("profileImage")){
          $s['file'] = $this->upload->data("file_name");
        }else{
          $s['file'] = "";
        }
        $s['idx'] = $_SESSION['idx'];

        $this->load->model('club/club');
        $val = $this->club->regist($s);

        if($val == true){
          echo "<script type='text/javascript'>
            alert('클럽이 생성되었습니다.');
            document.location.href='/club/myclub';
          </script>";
        }else{
          echo "<script type='text/javascript'>
            alert('클럽생성에 실패하였습니다. 다시 시도해주세요.');
            document.location.href='/club/regist';
          </script>";
        }
          //header('Location: /');
        exit;
    }
}