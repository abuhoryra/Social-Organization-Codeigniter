<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Model {

   public function save_admin() {

      $is_super = $this->input->post('is_super');

      if(isset($is_super)){
        $is_super = 1;
      }
      else{
        $is_super = 0;
      }

     $data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),
        'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
        'phone' => $this->input->post('phone'),
        'id_type' => $this->input->post('id_type'),
        'id_number' => $this->input->post('id_number'),
        'nominee_name' => $this->input->post('nominee_name'),
        'rel_nominee' => $this->input->post('rel_nominee'),
        'is_super' => $is_super
     );

    $this->db->insert('member', $data);

   }
   public function login() {

      $phone = $this->input->post('phone');
      $password = $this->input->post('password');

      $member = $this->db->select('*')
                         ->from('member')
                         ->where('phone',$phone)
                         ->get()->row_array();
      if(password_verify($password, $member['password'])) {
        return true;
      }
      return false;
  }
  public function getMyInfo($phone=null) {
		if($phone==null) {
				$phone = $this->session->userdata('phone');
		}
		return $this->db->select('*')
										->from('member')
										->where('phone', $phone)
										->get()->row_array();
  }

}
