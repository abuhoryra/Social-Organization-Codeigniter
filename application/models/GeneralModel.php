<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneralModel extends CI_Model {

  public $member_id;
  public $deposit_id;
  public $expense_id;

   public function get_admin_list() {

     return $this->db->select('id,first_name,last_name,email,phone,is_super')
                     ->from('member')
                     ->get()->result_array();
   }

   public function make_super_admin($super) {
     $this->db->set('is_super', $super);
     $this->db->where('id', $this->member_id);
     $this->db->update('member');

   }

   public function check_super() {

      return $this->db->select('is_super')
                      ->from('member')
                      ->where('email', $this->session->userdata['email'])
                      ->get()->row_array();

   }

   public function fetch_all_member() {

     return $this->db->select('id,first_name,last_name,email,phone')
                     ->from('member')
                     ->get()->result_array();
   }

   public function session_user_data() {

     return $this->db->select('id,first_name,last_name,email,phone')
                     ->from('member')
                     ->where('email', $this->session->userdata['email'])
                     ->get()->row_array();
   }

   public function add_deposit() {

        $phone = $this->input->post('phone');

        $new_data = $this->db->select('first_name,last_name')
                             ->from('member')
                             ->where('phone',$phone)
                             ->get()->row_array();

        $depositor_name = $new_data['first_name'].' '.$new_data['last_name'];

        $data = array(
          'depositor_name' => $depositor_name,
          'depositor_phone'  => $this->input->post('depositor_phone'),
          'recipient_name'  => $this->input->post('recipient_name'),
          'recipient_phone'  => $this->input->post('recipient_phone'),
          'value'  => $this->input->post('value'),
          'time'  => time()
        );

        $this->db->insert('account', $data);


   }

   public function get_deposit_history($limit,$start) {

     return $this->db->select('*')
                     ->from('account')
                     ->order_by('time', 'DESC')
                     ->limit($limit,$start)
                     ->get()->result_array();
   }

   public function sum_all_deposit(){

     return $this->db->select_sum('value')
              ->from('account')
              ->get()->row()->value;
   }

   public function get_update_deposit(){

      return $this->db->select('*')
                      ->from('account')
                      ->where('id', $this->deposit_id)
                      ->get()->row_array();
   }

   public function update_deposit() {

        $phone = $this->input->post('phone');

        $new_data = $this->db->select('first_name,last_name')
                             ->from('member')
                             ->where('phone',$phone)
                             ->get()->row_array();

        $depositor_name = $new_data['first_name'].' '.$new_data['last_name'];

        $data = array(
          'depositor_name' => $depositor_name,
          'depositor_phone'  => $this->input->post('depositor_phone'),
          'value'  => $this->input->post('value'),
          'time'  => time()
        );
        $this->db->set($data);
        $this->db->where('id', $this->deposit_id);
        $this->db->update('account');


   }

   public function delete_deposit() {

     $this->db->where('id', $this->deposit_id);
     $this->db->delete('account');

   }

   public function get_my_deposit() {

     return $this->db->select('*')
                     ->from('account')
                     ->where('depositor_phone', $this->session->userdata['phone'])
                     ->order_by('time', 'DESC')
                     ->get()->result_array();
   }

   public function save_expense() {

     $data = $this->db->select('id,first_name,last_name,phone')
                      ->from('member')
                      ->where('email',$this->session->userdata['email'])
                      ->get()->row_array();

     $full_name = $data['first_name'].' '.$data['last_name'];
     $phone = $data['phone'];

     $newdata = array(
       'reason' => $this->input->post('reason'),
       'value' => $this->input->post('value'),
       'register_name' => $full_name,
       'register_phone' => $phone,
       'time' => time()
     );

     $this->db->insert('expense_history', $newdata);
   }

   public function get_all_expense() {

     return $this->db->select('*')
                     ->from('expense_history')
                     ->order_by('time', 'DESC')
                     ->get()->result_array();
   }

   public function get_single_expense() {

     return $this->db->select('*')
                     ->from('expense_history')
                     ->where('id', $this->expense_id)
                     ->get()->row_array();
   }

   public function update_expense(){

     $data = array(
       'reason' => $this->input->post('reason'),
       'value' => $this->input->post('value'),
       'time' => time()
     );

     $this->db->set($data);
     $this->db->where('id', $this->expense_id);
     $this->db->update('expense_history');

   }

   public function delete_expense() {

     $this->db->where('id', $this->expense_id);
     $this->db->delete('expense_history');
   }

   public function get_my_profile() {

     return $this->db->select('id,first_name,last_name,email,phone')
                     ->from('member')
                     ->where('id', $this->session->userdata['id'])
                     ->get()->row_array();
   }

   public function update_my_profile() {

     $data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),
        'phone' => $this->input->post('phone')
     );

     $this->db->set($data);
     $this->db->where('id', $this->session->userdata['id']);
     $this->db->update('member');
   }

   public function delete_admin() {

     $this->db->where('id', $this->member_id);
     $this->db->delete('member');

   }

   public function sum_all_expense(){

     return $this->db->select_sum('value')
              ->from('expense_history')
              ->get()->row()->value;
   }

}
