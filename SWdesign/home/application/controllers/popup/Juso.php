<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juso extends CI_Controller {
  public function __construct() {
     parent::__construct();
     $this->load->helper(array('form', 'url'));
  }

  public function _remap($mode="", $args)
  {
      $data['inputYn'] = "N";
      $data['addr1'] = " ";
      $data['addr2'] = " ";
      $data['addr3'] = " ";
      $data['zipCode'] = " ";

      if($_POST){
        $data['inputYn'] = "Y";
        $data['addr1'] = $_POST['roadAddrPart1'];
        $data['addr2'] = $_POST['roadAddrPart2'];
        $data['addr3'] = $_POST['addrDetail'];
        $data['zipCode'] = $_POST['zipNo'];
      }

      $this->load->view('popup/juso', $data);
  }
}