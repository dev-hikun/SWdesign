<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WerunBoard {
    protected $CI;
    protected $data;
    public function __construct($params){
        $this->CI =& get_instance();
        $this->CI->load->helper(array('form', 'url'));
        $this->data = $params;
        $this->CI->load->model('board/board');
    }

    public function getList()
    {
        //echo "<script type='text/javascript'>alert('준비중입니다...'); history.back(); </script>";
        print_r($this->data);
        $this->CI->load->view('board/lists', $this->data);
    }


}