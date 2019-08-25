<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GeneralModel extends CI_Model {

  public $member_id;
  public $deposit_id;
  public $expense_id;
  public $phone;
  public $month_id;
  public $id;

   public function get_admin_list() {

     return $this->db->select('id,first_name,last_name,email,phone,is_super,photo')
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
        $id = $this->input->post('id');


        $new_data = $this->db->select('id,first_name,last_name')
                             ->from('member')
                             ->where('phone',$phone)
                             ->get()->row_array();

        $depositor_name = $new_data['first_name'].' '.$new_data['last_name'];
        $depositor_id = $new_data['id'];

        $month_data = $this->db->select('*')
                               ->from('month')
                               ->where('id', $id)
                               ->get()->row_array();

        $value = $month_data['value'];
        $month = $month_data['month'];
        $year = $month_data['year'];

        $check =$this->db->select('*')
                         ->from('account')
                        ->where('depositor_name',$depositor_name)
                        ->where('month',$month)
                        ->where('year', $year)
                        ->get()->num_rows();


                $rowcount= $check;



        $data = array(
          'depositor_id' => $depositor_id,
          'depositor_name' => $depositor_name,
          'depositor_phone'  => $this->input->post('depositor_phone'),
          'recipient_name'  => $this->input->post('recipient_name'),
          'recipient_phone'  => $this->input->post('recipient_phone'),
          'value'  => $value,
          'month' => $month,
          'year' => $year,
          'time'  => time()
        );

        if($rowcount > 0){

          $this->session->set_flashdata('message', 'You Are Already Add Deposit for This Month.');
          redirect('Home/add_money');
        }
        else{
          $this->db->insert('account', $data);
          $this->send_sms($phone,$value,$month,$year);
        }




   }

   public function send_sms($phone,$value,$month,$year){

 		try{
 $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
 $paramArray = array(
 'userName' => "01754586742",
 'userPassword' => "msjt13151831513",
 'mobileNumber' => "$phone",
 'smsText' => "Your Deposited ammount is $value Tk. for $month $year Thank You.",
 'type' => "TEXT",
 'maskName' => '',
 'campaignName' => '',
 );

 $value = $soapClient->__call("OneToOne", array($paramArray));
 print_r($value->OneToOneResult);
 }
 catch (Exception $e) {
 print_r($e->getMessage());
 }

 	}

   public function get_deposit_history($limit,$start) {

     return $this->db->select('*')
                     ->from('account')
                     ->order_by('id', 'DESC')
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
        $id = $this->input->post('id');


        $new_data = $this->db->select('id,first_name,last_name')
                             ->from('member')
                             ->where('phone',$phone)
                             ->get()->row_array();

        $depositor_name = $new_data['first_name'].' '.$new_data['last_name'];
        $depositor_id = $new_data['id'];

        $month_year = $this->input->post('month');

        $split = explode(" ",$month_year);
        $month = $split[0];
        $year = $split[1];

        $get_value = $this->db->select('value')
                              ->from('month')
                              ->where('month', $month)
                              ->where('year', $year)
                              ->get()->row_array();

       $value = $get_value['value'];

        $month_data = $this->db->select('value')
                                ->from('month')
                                ->where('month', $month)
                                ->where('year', $year)
                                ->get()->row_array();

        $value = $month_data['value'];



        $check =$this->db->select('*')
                         ->from('account')
                        ->where('depositor_name',$depositor_name)
                        ->where('month',$month)
                        ->where('year', $year)
                        ->get()->num_rows();


                $rowcount= $check;

          $data = array(
            'depositor_name' => $depositor_name,
            'depositor_phone' => $phone,
            'value'  => $value,
            'month' => $month,
            'year' => $year,
            'time'  => time()
          );

        if($rowcount > 0){
          $url = $this->uri->segment(3);
          $this->session->set_flashdata('message', 'You Are Already Add Deposit for This Month.');
          redirect('Home/edit_deposit/'.$url);
        }
        else{
          $this->db->set($data);
          $this->db->where('id', $this->id);
          $this->db->update('account');
        }




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

     return $this->db->select('*')
                     ->from('member')
                     ->where('id', $this->session->userdata['id'])
                     ->get()->row_array();
   }

   public function update_my_profile() {

     $data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),
        'phone' => $this->input->post('phone'),
        'id_type' => $this->input->post('id_type'),
        'id_number' => $this->input->post('id_number'),
        'nominee_name' => $this->input->post('nominee_name'),
        'rel_nominee' => $this->input->post('rel_nominee')
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

   public function get_user_deposit_history() {
     return $this->db->select('*')
                     ->from('account')
                     ->where('depositor_id', $this->deposit_id)
                     ->get()->result_array();
   }



   public function get_user_profile() {

     return $this->db->select('id,first_name,last_name,email,phone')
                     ->from('member')
                     ->where('id', $this->member_id)
                     ->get()->row_array();
   }

   public function update_user_profile() {

     $data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'email' => $this->input->post('email'),
        'phone' => $this->input->post('phone')
     );

     $this->db->set($data);
     $this->db->where('id', $this->member_id);
     $this->db->update('member');
   }

   public function add_month() {

     $data = array(

       'month' => $this->input->post('month'),
       'year' => $this->input->post('year'),
       'value' => $this->input->post('value')
     );

     $this->db->insert('month', $data);
   }

   public function get_all_months() {

     return $this->db->select('*')
                     ->from('month')
                     ->get()->result_array();
   }

   public function get_single_month() {

     return $this->db->select('*')
                     ->from('month')
                     ->where('id', $this->month_id)
                     ->get()->row_array();
   }

   public function update_month() {



       $data = array(
          'month' => $this->input->post('month'),
          'year' => $this->input->post('year'),
          'value' => $this->input->post('value')
       );


     $this->db->set($data);
     $this->db->where('id', $this->month_id);
     $this->db->update('month');
   }

   /*public function delete_month() {

     $this->db->where('id', $this->month_id);
     $this->db->delete('month');
   }*/

   public function get_only_year() {

     return $this->db->select('year')
                     ->from('month')
                     ->get()->result_array();
   }

   public function member_password_change() {

     $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

     $this->db->set('password', $password);
     $this->db->where('id', $this->session->userdata['id']);
     $this->db->update('member');
   }

   public function reset_password_bySuperAdmin() {

     $phone = $this->db->select('phone')
              ->from('member')
              ->where('id', $this->member_id)
              ->get()->row_array();

      $reset_password = $phone['phone'];
      $password = password_hash($reset_password, PASSWORD_BCRYPT);

      $this->db->set('password', $password);
      $this->db->where('id', $this->member_id);
      $this->db->update('member');

   }

   public function save_profile_image() {

     $image = $this->upload->file_name;

     $this->db->set('photo', $image);
     $this->db->where('id', $this->session->userdata['id']);
     $this->db->update('member');

   }

   public function get_only_image() {

     return $this->db->select('photo')
                     ->from('member')
                     ->where('id', $this->session->userdata['id'])
                     ->get()->row_array();
   }

}
