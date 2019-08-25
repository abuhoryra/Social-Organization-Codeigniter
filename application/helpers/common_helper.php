<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('is_super')){

  function is_super() {
    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('session');
    $session_id = $ci->session->userdata['id'];
    $data = $ci->db->select('*')
                   ->from('member')
                   ->where('id', $session_id)
                   ->get()->row_array();

    if($data['is_super'] == 1){
      return true;
    }
    else{
      return false;
    }
  }

}
