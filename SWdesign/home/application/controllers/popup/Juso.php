<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juso extends CI_Controller {
  public function __construct() {
     parent::__construct();
     $this->load->helper(array('form', 'url'));
  }

  public function _remap($mode="", $args)
  {
      $this->load->view('popup/juso');

      if()
  }
}