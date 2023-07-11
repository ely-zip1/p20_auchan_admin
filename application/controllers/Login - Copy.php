<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login  extends CI_Controller
{
		public function __construct()
        {
            parent::__construct();
						$this->load->model('members');
						$this->load->model('Referral_codes');
        }

	public function index()
	{
		$this->members->update_v_code();

		if(isset($this->session->username)){

			if($this->session->is_admin){

				redirect('deposits_admin', 'refresh');
			}else{

				redirect('dashboard', 'refresh');
			}
		}else{
			$data = array(
				'title' => "Login"
			);

			$this->form_validation->set_rules('username', 'Username', 'required|callback_is_login_valid');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|callback_is_login_valid');

			if ($this->form_validation->run() == FALSE) {
				// $this->load->view('login/header', $data);
				$this->load->view('login/login', $data);
				// $this->load->view('login/footer');
			}
			else {

				if($this->is_login_valid()){

					// printf($this->members->get_member($_POST['email']));
					$member_data = $this->members->get_member($_POST['username']);

					echo '<pre>';
					// print_r($member_data);
					echo '</pre>';


					$userdata = array(
						'email' => $member_data->email_address,
						'fullname' => $member_data->full_name,
						'date_registered' => $member_data->date,
						'username' => $member_data->username,
						'user_id' => $member_data->id,
						'country' => $member_data->country,
						'last_access' => $member_data->last_access
					);

					if($member_data->account_type_id == '1' || $member_data->account_type_id == '3'){
						$userdata['is_admin'] = true;
					}else{
						$userdata['is_admin'] = false;
					}

					

					$this->load->model('DepositModel');

					if($member_data->account_type_id == '1' || $member_data->account_type_id == '3'){
						$this->session->set_userdata($userdata);
						redirect('deposits_admin');
					}else{
						// $auth_code = random_string('numeric', 5);
						// $is_code_updated =  $this->members->update_auth($member_data->id, $auth_code);
						// if($is_code_updated == 1){
						// 	$is_email_sent = $this->send_auth_code($member_data->username, $auth_code, $member_data->email_address);
						// 	if($is_email_sent){
								$userdata['user_id'] = $member_data->id;
								$this->session->set_userdata($userdata);

						// 		$this->session->set_flashdata('member_id', $member_data->id);
						// 		redirect('authorize');
						// 	}
						// }else{
						// 	redirect('login');
						// }

						// if($this->DepositModel->has_deposit($member_data->id)){
							redirect('dashboard');
						// }else{
						// 	redirect('plans');
						// }
					}

				}else{
					// $this->load->view('login/header', $data);
					$this->load->view('login/login', $data);
					// $this->load->view('login/footer');

				}
			}

		}

	}

	function is_login_valid(){

		$is_valid = $this->members->verify_member($_POST['username'],$_POST['password']);

		if($is_valid){
			return true;
		}else{
			$this->form_validation->set_message('is_login_valid','Invalid username or password.');
			return false;
		}
	}

	function send_auth_code($username, $code, $email){

		ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );

		$this->load->library('email');

		$userdata['member_username'] = $username;
		$userdata['auth_code'] = $code;

        $this->email->from('support@member-equifinance.com', 'Equifinance')
            ->to($email)
            ->subject('Login Authentication')
						->message($this->load->view('email/authentication', $userdata, true));

        if($this->email->send()){
					return true;
				}else{
					return false;
				}
	}

}