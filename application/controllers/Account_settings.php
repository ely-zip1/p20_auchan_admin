<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_settings extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PackageModel');
		$this->load->model('DepositModel');
		$this->load->model('Members');
		$this->load->model('Deposit_Options');
		$this->load->model('Bank_model');
		$this->load->model('Withdrawal_Mode_model');
		$this->load->model('Account_model');

		date_default_timezone_set('Asia/Manila');
	}

	public function index()
	{
		$data = array(
			'title' => "Account Settings"
		);
		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = ucwords($this->session->userdata('fullname'));
		$data['date_registered'] = $this->session->userdata('date_registered');

		$member_data = $this->Members->get_member($this->session->username);

		$account_balance = $this->Account_model->get_account_balance($this->session->user_id);

		$data['account_balance'] = number_format($account_balance, 2, '.', ',');

		$data['account_name'] = $member_data->username;
		$data['date_registered'] = $member_data->date;
		$data['email_address'] = $member_data->email_address;
		$data['full_name'] = ucwords($member_data->full_name);
		$data['upline'] = ucwords($member_data->referred_by);

		$bank = $this->Bank_model->get_per_member_id($member_data->id);

		$data['bank_name'] = $bank->bank_name;
		// $data['bank_swift_code'] = $bank->swift_code;
		$data['bank_account_name'] = $bank->account_name;
		$data['bank_account_number'] = $bank->account_number;
		$data['bank_code'] = $bank->bank_code;
		$data['bank_country'] = $bank->country;

		$data['spar_bank_name'] = $member_data->spar_bank_name;
		$data['spar_bank_account_name'] = $member_data->spar_account_name;

		// $data['country_placeholder'] = '<option value="'.$bank->country.'">'.$bank->country.'</option>';
		$withdrawal_account = $this->Withdrawal_Mode_model->get_per_member($member_data->id);
		// echo "++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
		// print_r($member_data);
		// print_r($withdrawal_account);

		$data['bitcoin_account'] = $withdrawal_account->bitcoin;
		$data['ethereum_account'] = $withdrawal_account->ethereum;
		$data['dog_account'] = $withdrawal_account->doge_coin;
		$data['ripple_account'] = $withdrawal_account->xrp_account;
		$data['ripple_tag'] = $withdrawal_account->xrp_tag;
		$data['tron_account'] = $withdrawal_account->trx;
		$data['litecoin_account'] = $withdrawal_account->litecoin;
		$data['usdt_account'] = $withdrawal_account->usdt;


		if (isset($_POST['account_submit'])) {
			if ($_POST['account_submit'] == 'reset_password') {
				$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
				$this->form_validation->set_rules('confirm_new_password', 'Password Confirmation', 'required|min_length[6]|matches[new_password]');
			} else if ($_POST['account_submit'] == 'bank') {
				$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
				$this->form_validation->set_rules('bank_account_name', 'Account Name', 'required');
				$this->form_validation->set_rules('bank_account_number', 'Account Number', 'required');
				// $this->form_validation->set_rules('bank_swift_code', 'Swift Code', 'required');
				$this->form_validation->set_rules('bank_code', 'Bank Code', 'required');
			}else if ($_POST['account_submit'] == 'spar_atm') {
				$this->form_validation->set_rules('spar_bank_name', 'Bank Name', 'required');
				$this->form_validation->set_rules('spar_bank_account_name', 'Account Name', 'required');
			}
			// else if ($_POST['account_submit'] == 'bitcoin') {
			// 	$this->form_validation->set_rules('bitcoin_account', 'Bitcoin Account', 'required');
			// } else if ($_POST['account_submit'] == 'ethereum') {
			// 	$this->form_validation->set_rules('ethereum_account', 'Ethereum Account', 'required');
			// } 
			else if ($_POST['account_submit'] == 'ripple') {
				$this->form_validation->set_rules('ripple_account', 'Ripple Account', 'required');
				$this->form_validation->set_rules('ripple_tag', 'Ripple Tag', 'required');
			} else if ($_POST['account_submit'] == 'usdt') {
				$this->form_validation->set_rules('usdt_account', 'USDT Account', 'required');
			}
			//else if ($_POST['account_submit'] == 'tron') {
			// 	$this->form_validation->set_rules('tron_account', 'Tron Account', 'required');
			// } else if ($_POST['account_submit'] == 'ltc') {
			// 	$this->form_validation->set_rules('litecoin_account', 'Litecoin Account', 'required');
			// } else if ($_POST['account_submit'] == 'dog') {
			// 	$this->form_validation->set_rules('dog_account', 'Doge Coin Account', 'required');
			// }
		}



		if ($this->form_validation->run() == FALSE) {
			// $this->load->view('templates/header', $data);
			$this->load->view('pages/account_settings', $data);
			// $this->load->view('templates/footer');
		} else {
			if ($_POST['account_submit'] == 'reset_password') {

				$email = $this->session->email;
				$password = $_POST['new_password'];

				$this->Members->update_password($email, $password);

				if ($this->Members->verify_member($this->session->username, $password)) {
					$data['password_update_success'] = 'Password updated!';
					$this->email_confirmation(ucwords($this->session->userdata('fullname')), $email);
				}
			}

			if ($_POST['account_submit'] == 'bank') {
				$new_bank_details = array(
					'bank_name' => $_POST['bank_name'],
					'account_name' => $_POST['bank_account_name'],
					'account_number' => $_POST['bank_account_number'],
					// 'swift_code' => $_POST['bank_swift_code'],
					'swift_code' => '',
					'bank_code' => $_POST['bank_code'],
					'member_id' => $member_data->id,
					// 'country' => $_POST['country']
					'country' => ''
				);
				$this->Bank_model->update($new_bank_details);
			} else if ($_POST['account_submit'] == 'spar_atm') {
				$spar_atm_details = array(
					'spar_bank' => $_POST['spar_bank_name'],
					'spar_account' => $_POST['spar_bank_account_name']
				);
				$this->Members->update_spar_atm($member_data->id, $spar_atm_details);
			}  else if ($_POST['account_submit'] == 'bitcoin') {
				$this->Withdrawal_Mode_model->update_bitcoin($member_data->id, $_POST['bitcoin_account']);
			} else if ($_POST['account_submit'] == 'ethereum') {
				$this->Withdrawal_Mode_model->update_ethereum($member_data->id, $_POST['ethereum_account']);
			} else if ($_POST['account_submit'] == 'ripple') {
				$this->Withdrawal_Mode_model->update_ripple($member_data->id, $_POST['ripple_account'], $_POST['ripple_tag']);
			} else if ($_POST['account_submit'] == 'tron') {
				$this->Withdrawal_Mode_model->update_tron($member_data->id, $_POST['tron_account']);
			} else if ($_POST['account_submit'] == 'ltc') {
				$this->Withdrawal_Mode_model->update_ltc($member_data->id, $_POST['litecoin_account']);
			} else if ($_POST['account_submit'] == 'dog') {
				$this->Withdrawal_Mode_model->update_doge($member_data->id, $_POST['dog_account']);
			} else if ($_POST['account_submit'] == 'usdt') {
				$this->Withdrawal_Mode_model->update_usdt($member_data->id, $_POST['usdt_account']);
			}

			// $this->load->view('templates/header', $data);
			$this->load->view('pages/account_settings', $data);
			// $this->load->view('templates/footer');
		}
	}

	private function email_confirmation($name, $email)
	{
		ini_set('display_errors', 1);
		error_reporting(E_ALL);

		$this->load->library('email');

		$userdata['name'] = $name;

		$this->email->from('customer-support@arco-virtual.com', 'ARCO Virtual')
			->to($email)
			->subject('Changed Password Notification')
			->message($this->load->view('email/changepassword', $userdata, true));

		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}
}