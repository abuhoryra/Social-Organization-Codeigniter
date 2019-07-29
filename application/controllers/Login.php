<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('login_form');
	}

	public function user_login() {

		$this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('password','Password','required');

		if ($this->form_validation->run() == FALSE){
            $this->load->view('login_form');
     }
        else{
        $email = $this->input->post('email');
        $this->load->model('Account');
         if($this->Account->login()){

            $user = $this->Account->getMyInfo($email);
            $sdata['id']=$user['id'];
            $sdata['email']=$user['email'];
            $this->session->set_userdata($sdata);
            redirect('Home');
        }
        else{
            $this->session->set_flashdata('failed', 'Invalid Username Or Password');
            redirect('Login/index');
        }
    }
	}

	public function test() {
		echo password_hash("pranto", PASSWORD_DEFAULT);
	}

	public function logout() {
			 $this->session->unset_userdata('email');
			 redirect('Login');
	 }

}