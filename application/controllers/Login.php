<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	function __construct()

	{
		parent::__construct();
		$this->load->helper(array('url',"form"));
		$this->load->library(array("session","form_validation"));
		$this->load->model("common_model");
	}
	public function index()
	{
		$this->load->view('login');
	}

	public function do_login()
	{
		$post = $this->input->post();

		$email= $post['email'];
		$password= $post['password'];
		$this->LoginformValidation(); 
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata("msg","<div class='alert alert-danger'>Pleaes enter all information.</div>");
			$this->load->view('login');
		}
		else
		{
			if (!empty($email) && !empty($password)) 
			{
				$encryptPassword = md5($password);
				$match = array('email' => $email, 'password' => $encryptPassword,'status' => '1');
				$userData = $this->common_model->read_data_where(USER, $match);
				if(!empty($userData))
				{
					$session_login = array(
						"id"          		=>  $userData[0]->id, 
						"first_name"  		=>  $userData[0]->first_name,
						"last_name"  		=>  $userData[0]->last_name,
						"email"       		=>  $userData[0]->email,
						"status"          	=>  $userData[0]->status, 
						"user_role"        =>  $userData[0]->user_role, 

					);
					$this->session->set_userdata('login_session',$session_login);
					redirect(site_url('home'));
				}
				else
				{
					$this->session->set_flashdata("msg","<div class='alert alert-danger'>Email/Password something wrong.</div>");
					redirect(site_url('login'));
				}
			}
		}
	}
	public function LoginformValidation() 
	{
		$this->form_validation->set_rules('email', 'Please enter correct email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Please enter password', 'trim|required');
	}
	public function logout()
	{
		$this->session->unset_userdata('login_session');
		$this->session->sess_destroy();
		$this->session->set_flashdata("msg","<div class='alert alert-success'>Your sessin has been destroy.</div>");
		redirect(site_url('login'));
	}
}