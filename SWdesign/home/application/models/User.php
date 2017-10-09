<?php
class User extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
 
    public function select()
    {
        $result = $this->db->query('select * from member');
        return $result;
    }
}
?>