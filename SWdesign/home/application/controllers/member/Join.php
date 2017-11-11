 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends CI_Controller {
        public function __construct() {
            parent::__construct();

            $this->load->helper(array('form', 'url'));
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
              $this->load->model('member/email_chk');
              $json_dt['id'] = $_POST['id'];
              $json_dt['domain'] = $_POST['domain'];
        			$this->email_chk->dupChk($json_dt);
        			echo json_encode($this->email_chk->dupChk($json_dt));
        			exit;
          }
        }

        //회원가입 완료
		private function _ok(){
			    //echo "<script type='text/javascript'>alert('준비중입니다.'); history.back(); exit;</script>";
          if(!$_POST){
            echo "<script type='text/javascript'>alert('잘못된 접근입니다.'); history.back();</script>";
            exit;
          }
          if(!$_POST) exit('비정상적인 접근입니다.');

			$mdata['id'] = $_POST["email"];
			$mdata['pw'] = $_POST["password"];
			$mdata['name'] = $_POST["name"];
			$mdata['nickName'] = $_POST["nickname"];
			$mdata['birth'] = $_POST["bDate"];
			$mdata['phone'] = $_POST["phone"];
			$mdata['addr1'] = $_POST["addr1"];
			$mdata['addr2'] = $_POST["addr2"];
			$mdata['zipCode'] = $_POST["zipCode"];
			$mdata['sex'] = $_POST["sex"];
			$mdata['file'] = "";
			$mdata['parts'] = "";
			$mdata['permit'] = $_POST['permit'];
			$mdata['public'] = $_POST['public'];

			if($mdata['pw'] != $_POST['password']){
			  echo "<script type='text/javascript'>
				alert('비밀번호와 비밀번호확인이 다릅니다.');
				history.back();
			  </script>";
			  exit;
			}

			if(is_array($_POST["part"])){
				foreach($_POST['part'] as $key=>$val){
					if($val == "start") continue;

					if($mdata['parts'] == ""){
						$mdata['parts'] = $mdata['parts'].$val;
					}else{
						$mdata['parts'] = $mdata['parts']."|".$val;
					}
				}
			}

          //업로드를 위한..
          $config = array(
            'upload_path' => './site_data/member_img/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size' => '10240',
            'max_width' => '10240',
            'max_height' => '7680',
            'remove_spaces' => true,
            'encrypt_name' => true
          );

          $this->load->library('upload', $config);

          if($this->upload->do_upload("profileImage")){
            $mdata['file'] = $this->upload->data("file_name");
          }else{
            $mdata['file'] = "";
          }


          foreach($mdata as $key=>$val){
            $mdata[$key] = addslashes($val);
          }

          $this->load->model('member/member');
          $val = $this->member->join($mdata);
          if($val == true){
            echo "<script type='text/javascript'>
              alert('회원가입이 완료되었습니다.');
              document.location.href='/';
            </script>";
          }else{
            echo "<script type='text/javascript'>
              alert('회원가입에 실패하였습니다. 다시 시도해주세요.');
              history.back();
            </script>";
          }
          //header('Location: /');
          exit;
        }
}