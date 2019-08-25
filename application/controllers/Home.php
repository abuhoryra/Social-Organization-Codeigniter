<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
    parent::__construct();

		$this->load->model('Account');
		$this->load->model('GeneralModel');

  }

	public function index() {
    if($this->session->userdata('phone')) {

			$this->data['admin'] = $this->GeneralModel->get_admin_list();
			$this->data['super'] = $this->GeneralModel->check_super();
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('home', $this->data);
    }
    else{
      redirect('Login');
    }
	}


	public function add_admin() {

		$this->form_validation->set_rules('first_name','First Name','required');
    $this->form_validation->set_rules('last_name','Lastname','required');
		$this->form_validation->set_rules('email','Email','required|is_unique[member.email]');
    $this->form_validation->set_rules('password','Password','required|min_length[6]');
    $this->form_validation->set_rules('phone','Phone','required|is_unique[member.phone]|min_length[11]|max_length[11]');
		$this->form_validation->set_rules('id_type','NID/Passport/Birth Certificate','required');
		$this->form_validation->set_rules('id_number','ID Number','required|is_unique[member.id_number]');
		$this->form_validation->set_rules('nominee_name','Nominee Name','required');
		$this->form_validation->set_rules('rel_nominee','Relationship With Nominee','required');
		if ($this->form_validation->run() == FALSE){

			$this->data['admin'] = $this->GeneralModel->get_admin_list();
			$this->data['super'] = $this->GeneralModel->check_super();
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('home', $this->data);
     }
		 else{
			 $this->Account->save_admin();
			 redirect('Home');
		 }

	}

	public function make_super_admin($member_id,$super) {

		$this->GeneralModel->member_id =  $member_id;
		$this->GeneralModel->make_super_admin($super);
		redirect('Home');

	}

	public function is_super() {

		$data = $this->GeneralModel->check_super();

		if($data['is_super'] == 1) {
			return true;
		}
		else{
			return false;
		}
	}

	public function no_permission() {

		$this->data['side_bar'] = 'template/sidebar';
		$this->load->view('no_permission', $this->data);
	}

	public function add_money() {
    if($this->session->userdata('phone') && $this->is_super()) {

		$this->data['member'] = $this->GeneralModel->fetch_all_member();
		$this->data['months'] = $this->GeneralModel->get_all_months();
		$this->data['admin'] = $this->GeneralModel->session_user_data();
		$this->data['side_bar'] = 'template/sidebar';
		$this->load->view('add_money', $this->data);
	}

	elseif($this->session->userdata('phone') && !$this->is_super()) {
       redirect('Home/no_permission');
	}
	else{
		redirect('Login');
	}

	}

	public function save_deposit() {

		$post = $this->input->post();
		$phone = $post['phone'];

		$this->form_validation->set_rules('phone','Name','required');
		$this->form_validation->set_rules('month','Month','required');


		if ($this->form_validation->run() == FALSE){

			$this->data['member'] = $this->GeneralModel->fetch_all_member();
			$this->data['admin'] = $this->GeneralModel->session_user_data();
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('add_money', $this->data);
		}
		else{

			$this->GeneralModel->add_deposit();
     	redirect('Home/deposit_history');
    }


	}

	public function deposit_history() {

    if($this->session->userdata('phone') && $this->is_super()) {

			$this->load->library('pagination');
            $config['base_url'] = base_url() . "Home/deposit_history";;
            $config['total_rows'] = $this->db->count_all('account');
            $config['per_page'] = 10;
            $config["uri_segment"] = 3;
            $config['full_tag_open']  = '<div class="pagging text-center"><nav><ul class="pagination">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span></li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			$this->data['history'] = $this->GeneralModel->get_deposit_history($config["per_page"], $page);
			$this->data['calulate_deposit'] = $this->GeneralModel->sum_all_deposit();
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('deposit_history', $this->data);
		}
		else{
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('no_permission', $this->data);
		}

	}

	public function edit_deposit($deposit_id){

		if($this->session->userdata('phone') && $this->is_super()) {

			$this->GeneralModel->deposit_id = $deposit_id;
			$this->data['deposit'] = $this->GeneralModel->get_update_deposit();
			$this->data['months'] = $this->GeneralModel->get_all_months();
			$this->data['member'] = $this->GeneralModel->fetch_all_member();
			$this->data['admin'] = $this->GeneralModel->session_user_data();
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('edit_deposit', $this->data);
		}
		else{
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('no_permission', $this->data);
		}

	}

	public function update_deposit($id) {
		$this->GeneralModel->id = $id;
		$this->GeneralModel->update_deposit();
		redirect('Home/deposit_history');
	}

	public function delete_deposit($deposit_id) {

		$this->GeneralModel->deposit_id = $deposit_id;
		$this->GeneralModel->delete_deposit();
		redirect('Home/deposit_history');
	}

	public function my_deposit() {
		if($this->session->userdata('phone')) {

		$this->data['my_deposit'] = $this->GeneralModel->get_my_deposit();
		$this->data['side_bar'] = 'template/sidebar';
		$this->load->view('my_deposit', $this->data);
	}
	else{
		redirect('Login');
	}

	}

	public function add_expense() {

		if($this->session->userdata('phone') && $this->is_super()) {

			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('expense_form', $this->data);

		}
		else{
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('no_permission', $this->data);
		}

	}

	public function save_expense() {

		$this->form_validation->set_rules('reason','Name','required');
    $this->form_validation->set_rules('value','Value','required');
		if ($this->form_validation->run() == FALSE){

			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('expense_form', $this->data);
		}
		else{
			$this->GeneralModel->save_expense();
			redirect('Home/get_all_expense');
		}

	}

  public function get_all_expense() {
		if($this->session->userdata('phone')) {

		$this->data['expense'] = $this->GeneralModel->get_all_expense();
    $this->data['sum_expense'] = $this->GeneralModel->sum_all_expense();
		$this->data['super'] = $this->GeneralModel->check_super();
		$this->data['side_bar'] = 'template/sidebar';
		$this->load->view('expense_list', $this->data);
	}
	else{
		redirect('Login');
	}

	}

	public function edit_expense($expense_id) {
    if($this->session->userdata('phone') && $this->is_super()) {

			 $this->GeneralModel->expense_id = $expense_id;
       $this->data['expense'] = $this->GeneralModel->get_single_expense();
			 $this->data['side_bar'] = 'template/sidebar';
	 		$this->load->view('edit_expense', $this->data);

		}
		else{
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('no_permission', $this->data);
		}

	}

	public function update_expense($expense_id) {

		$this->GeneralModel->expense_id = $expense_id;
		$this->GeneralModel->update_expense();
		redirect('Home/get_all_expense');
	}

	public function delete_expense($expense_id) {

		$this->GeneralModel->expense_id = $expense_id;
		$this->GeneralModel->delete_expense();
		redirect('Home/get_all_expense');
	}


  public function get_my_profile() {
    if($this->session->userdata('phone')) {

		$this->data['myprofile'] = $this->GeneralModel->get_my_profile();
		$this->data['side_bar'] = 'template/sidebar';
	  $this->load->view('my_profile_edit', $this->data);

	}
	else{
		redirect('Login');
	}

	}

	public function update_my_profile() {

		$post = $this->input->post();
		$member = $this->GeneralModel->get_my_profile();

		$this->form_validation->set_rules('first_name','First Name','required');
    $this->form_validation->set_rules('last_name','Lastname','required');
		$this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('phone','Phone','required');
		$this->form_validation->set_rules('id_type','NID/Passport/Birth Certificate','required');
		$this->form_validation->set_rules('id_number','ID Number','required');
		$this->form_validation->set_rules('nominee_name','Nominee Name','required');
		$this->form_validation->set_rules('rel_nominee','Relationship With Nominee','required');

		if($member['email'] != $post['email']){
			$this->form_validation->set_rules('email','Email','required|is_unique[member.email]');
		}
		if($member['phone'] != $post['phone']){
			$this->form_validation->set_rules('phone','Phone','required|is_unique[member.phone]|max_length[11]');
		}
		if($member['id_number'] != $post['id_number']){
			$this->form_validation->set_rules('id_number','ID Number','required|is_unique[member.id_number]');
		}

		if ($this->form_validation->run() == FALSE){

			$this->data['myprofile'] = $this->GeneralModel->get_my_profile();
			$this->data['side_bar'] = 'template/sidebar';
		  $this->load->view('my_profile_edit', $this->data);

		}

		else{

			$this->GeneralModel->update_my_profile();
			redirect('Home/get_my_profile');

		}
	}

	public function delete_admin($member_id) {

			 $this->GeneralModel->member_id = $member_id;
			 $this->GeneralModel->delete_admin();
			 redirect('Home');
	}

	public function get_user_deposit_history($deposit_id) {

		if($this->session->userdata('phone') && $this->is_super()) {

			$this->GeneralModel->deposit_id = $deposit_id;
			$this->data['deposit'] = $this->GeneralModel->get_user_deposit_history();
			$this->data['side_bar'] = 'template/sidebar';
		  $this->load->view('user_deposit_history', $this->data);

		}

		else{
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('no_permission', $this->data);
		}

	}

	public function get_user_profile($member_id) {
    if($this->session->userdata('phone') && $this->is_super()) {

		$this->GeneralModel->member_id = $member_id;
		$this->data['user'] = $this->GeneralModel->get_user_profile();
		$this->data['side_bar'] = 'template/sidebar';
	  $this->load->view('edit_user', $this->data);

	}
	else{
		$this->data['side_bar'] = 'template/sidebar';
		$this->load->view('no_permission', $this->data);
	}

	}

	public function update_user_profile($member_id) {

		$this->GeneralModel->member_id = $member_id;
		$post = $this->input->post();
		$member = $this->GeneralModel->get_user_profile();

		$this->form_validation->set_rules('first_name','First Name','required');
		$this->form_validation->set_rules('last_name','Lastname','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('phone','Phone','required');

		if($member['email'] != $post['email']){
			$this->form_validation->set_rules('email','Email','required|is_unique[member.email]');
		}
		if($member['phone'] != $post['phone']){
			$this->form_validation->set_rules('phone','Phone','required|is_unique[member.phone]|max_length[11]');
		}

		if ($this->form_validation->run() == FALSE){

			$this->GeneralModel->member_id = $member_id;
			$this->data['user'] = $this->GeneralModel->get_user_profile();
			$this->data['side_bar'] = 'template/sidebar';
		  $this->load->view('edit_user', $this->data);

		}

		else{

			$this->GeneralModel->update_user_profile();
			redirect('Home/get_user_profile/'.$member_id);

		}
	}

	public function add_month() {
		if($this->session->userdata('phone') && $this->is_super()) {

			$this->data['months'] = $this->GeneralModel->get_all_months();
			$this->data['side_bar'] = 'template/sidebar';
		  $this->load->view('add_month', $this->data);

	}
	else{
		$this->data['side_bar'] = 'template/sidebar';
		$this->load->view('no_permission', $this->data);
	}

	}

	public function save_month() {

		$post = $this->input->post();
    $data = $this->GeneralModel->get_all_months();

		$this->form_validation->set_rules('month','Month','required');
		$this->form_validation->set_rules('year','Year','required');
		$this->form_validation->set_rules('value','Money','required');

		foreach ($data as $key) {
			$month = $key['month'];
			$year = $key['year'];
			if($month == $post['month'] && $year == $post['year']){
				$this->form_validation->set_rules('month_year','Month','required',array(
                'required'      => 'This %s Already Added for this Year  !'

        ));
			}

		}


		if ($this->form_validation->run() == FALSE){

      $this->data['modal'] = 1;
			$this->data['months'] = $this->GeneralModel->get_all_months();
			$this->data['side_bar'] = 'template/sidebar';
		  $this->load->view('add_month', $this->data);
		}
		else{
			$this->GeneralModel->add_month();
			redirect('Home/add_month');
		}


	}

	public function edit_month($month_id) {

		if($this->session->userdata('phone') && $this->is_super()) {

			$this->GeneralModel->month_id = $month_id;
			$this->data['months'] = $this->GeneralModel->get_single_month();
			$this->data['side_bar'] = 'template/sidebar';
		  $this->load->view('edit_month', $this->data);

	}
	else{
		$this->data['side_bar'] = 'template/sidebar';
		$this->load->view('no_permission', $this->data);
	}

	}

	public function update_month($month_id) {

		$post = $this->input->post();
    $data = $this->GeneralModel->get_all_months();

			$this->form_validation->set_rules('month','Month','required');
			$this->form_validation->set_rules('year','Year','required');
			$this->form_validation->set_rules('value','Money','required');

			foreach ($data as $key) {
				$month = $key['month'];
				$year = $key['year'];
				if($month == $post['month'] && $year == $post['year']){
					$this->form_validation->set_rules('month_year','Month','required',array(
	                'required'      => 'This %s Already Added for this Year  !'

	        ));
				}

			}


		if ($this->form_validation->run() == FALSE){

			$this->GeneralModel->month_id = $month_id;
			$this->data['months'] = $this->GeneralModel->get_single_month();
			$this->data['side_bar'] = 'template/sidebar';
		  $this->load->view('edit_month', $this->data);
		}

			else{
			$this->GeneralModel->month_id = $month_id;
			$this->GeneralModel->update_month();
			redirect('Home/add_month');

		}
	}



	/*public function delete_month($month_id) {

		$this->GeneralModel->month_id = $month_id;
		$this->GeneralModel->delete_month();
		redirect('Home/add_month');
	}*/

  public function member_password_change() {

		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('conf_password','Password','required|matches[password]');

		if ($this->form_validation->run() == FALSE){

			$this->data['show_modal'] = 1;
			$this->data['myprofile'] = $this->GeneralModel->get_my_profile();
			$this->data['side_bar'] = 'template/sidebar';
			$this->load->view('my_profile_edit', $this->data);

		}

		else{

			$this->GeneralModel->member_password_change();
			$this->session->set_flashdata('passchange', 'Password Changed Successfully :)');
			redirect('Home/get_my_profile');
		}

	}

	public function reset_password_bySuperAdmin($member_id) {

		$this->GeneralModel->member_id = $member_id;
		$phone = $this->GeneralModel->reset_password_bySuperAdmin();
		redirect('Home');
	}

	public function profile_image_upload() {

		           $config['upload_path']          = './upload/';
							 $config['allowed_types']        = 'gif|jpg|png';
							 $config['encrypt_name'] = TRUE;
							 $this->load->library('upload', $config);

							 if ( ! $this->upload->do_upload('image'))
							 {
											$this->data['error'] = array('error' => $this->upload->display_errors());
											$this->data['myprofile'] = $this->GeneralModel->get_my_profile();
								 			$this->data['side_bar'] = 'template/sidebar';
								 			$this->load->view('my_profile_edit', $this->data);
							 }
							 else
							 {
							 $image = $this->GeneralModel->get_only_image();
						 	 unlink('./upload/'.$image['photo']);
							 $data = $this->upload->data();
							 $config['image_library'] = 'gd2';
							 $config['source_image'] = './upload/'.$data["file_name"];
							 $config['create_thumb'] = FALSE;
							 $config['maintain_ratio'] = FALSE;
							 $config['quality'] = '60%';
							 $config['width'] = 400;
							 $config['height'] = 400;
							 $config['new_image'] = './upload/'.$data["file_name"];
							 $this->load->library('image_lib', $config);
							 $this->image_lib->resize();
               $this->GeneralModel->save_profile_image();
							 redirect('Home/get_my_profile');
							 }
	}


}
