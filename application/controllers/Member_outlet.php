<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member_outlet extends CI_Controller
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

	public function index($id)
	{
		$data = array(
			'title' => "Member accounts"
		);

        if(!empty($id)){


		$member_data = $this->Members->get_member_by_id($id);

		$data['username'] = $member_data->username;
		$data['date_registered'] = $member_data->date;

		$data['account_name'] = $member_data->username;
		$data['date_registered'] = $member_data->date;
		$data['email_address'] = $member_data->email_address;
		$data['full_name'] = ucwords($member_data->full_name);

		$bank = $this->Bank_model->get_per_member_id($member_data->id);

		$data['bank_name'] = $bank->bank_name;
		// $data['bank_swift_code'] = $bank->swift_code;
		$data['bank_account_name'] = $bank->account_name;
		$data['bank_account_number'] = $bank->account_number;
		$data['bank_code'] = $bank->bank_code;
		$data['bank_country'] = $bank->country;
		// $data['country_placeholder'] = '<option value="'.$bank->country.'">'.$bank->country.'</option>';
		$withdrawal_account = $this->Withdrawal_Mode_model->get_per_member($member_data->id);
		// echo "++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
		// print_r($withdrawal_account);

		$data['bitcoin_account'] = $withdrawal_account->bitcoin;
		$data['ethereum_account'] = $withdrawal_account->ethereum;
		$data['dog_account'] = $withdrawal_account->doge_coin;
		$data['ripple_account'] = $withdrawal_account->xrp_account;
		$data['ripple_tag'] = $withdrawal_account->xrp_tag;
		$data['tron_account'] = $withdrawal_account->trx;
		$data['litecoin_account'] = $withdrawal_account->litecoin;

        

		// print_r($data);
    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/member_money_outlets', $data);
    $this->load->view('admin/templates/footer');

            
        }
	}
}