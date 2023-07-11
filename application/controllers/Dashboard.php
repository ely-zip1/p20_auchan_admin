<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('DepositModel');
		$this->load->model('Members');
		$this->load->model('WithdrawalModel');
		$this->load->model('Referral_bonus_model');
		$this->load->model('ReferralModel');
		$this->load->model('Referral_codes');
		$this->load->model('Indirect_bonus_model');
		$this->load->model('Fund_transfer_model');
		$this->load->model('Fund_bonus_model');
		$this->load->model('Lifestyle_bonus_model');
		$this->load->model('GroupSalesModel');
		$this->load->model('Account_model');
		$this->load->model('Activation_fund_model');
		$this->load->model('Daily_income_model');
	}

	public function index()
	{

		$data = array(
			'title' => "Dashboard",
			'profit' => '0',
			'deposit' => '0',
			'referral_bonus' => '0',
			'balance' => '0'
		);
		// $dir    = './assets/img/country_flag';
		// $flags = scandir($dir);
		//
		// print_r($flags);

		$member_data = $this->Members->get_member($this->session->userdata('username'));
		// $upline_id = $this->ReferralModel->get_referrer($member_data->id);
		// $upline_details = $this->Members->get_member_by_id($upline_id->referrer_id);

		$fsf_bonus = $this->Fund_bonus_model->total_fund_bonus($member_data->id);
		$lifestyle_bonus = $this->Lifestyle_bonus_model->total_fund_bonus($member_data->id);
		$bonus_withdrawal = $this->WithdrawalModel->get_bonus_withdrawal_per_member($member_data->id)->amount;

		$lifestyle_bonus_balance = $lifestyle_bonus - $bonus_withdrawal;

		$data['fsf_bonus'] = '$ ' . number_format($fsf_bonus, 2, '.', ',');
		$data['coupon_bonus'] = number_format($lifestyle_bonus_balance, 2, '.', ',');

		// $data['upline'] = ucwords($upline_details->full_name);

		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = ucwords($this->session->userdata('fullname'));
		$data['date_registered'] = $this->session->userdata('date_registered');

		$data['is_verified'] = $this->Members->is_verified($data['username']);

		if (isset($member_data)) {
			// print_r($this->Account_model->get_account_balance($member_data->id));
			$todays_income = $this->Daily_income_model->total_income_today($member_data->id);

			$pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member_data->id);
			$total_withdrawal = $this->WithdrawalModel->get_total_withdrawal_per_member($member_data->id);
			$last_withdrawal = $this->WithdrawalModel->get_latest_withdrawal_amount($member_data->id);
			$total_growth = $this->DepositModel->get_total_growth($member_data->id);
			$last_deposit = $this->DepositModel->get_latest_deposit_amount($member_data->id);
			$total_deposit = $this->DepositModel->get_total_approved_deposit($member_data->id);
			$total_bonus = $this->Referral_bonus_model->get_total_bonus($member_data->id);
			$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member_data->id);
			$total_sent = $this->Fund_transfer_model->get_total_sent($member_data->id);
			$total_received = $this->Fund_transfer_model->get_total_received($member_data->id);
			$active_deposit = $this->DepositModel->get_total_approved_deposit_per_member($member_data->id);
			$total_monthly_bonus = $this->GroupSalesModel->get_total_per_member($member_data->id);
			$activation_fund = $this->Activation_fund_model->total_fund_per_member($member_data->id);

			$last_deposit_date = null;
			$lds = $this->DepositModel->get_latest_approved($member_data->id);
			if ($lds != null) {
				$last_deposit_date = new DateTime($lds->date_approved);
				$data['last_deposit_date'] = date_format($last_deposit_date, 'F d, Y');
			}

			$account_balance = $this->Account_model->get_account_balance($member_data->id);
			// $account_balance = ($total_growth + $total_bonus + $total_received + $total_monthly_bonus->bonus) - $total_withdrawal->amount - $total_reinvestment->amount - $total_sent - $pending_withdrawal->total;
			// print_r($account_balance);
			$data['active_deposit'] = '$ ' . number_format($active_deposit, 2, '.', ',');
			$data['account_balance'] = number_format($account_balance, 2, '.', ',');
			$data['pending_withdrawals'] = '$ ' . number_format($pending_withdrawal->total, 2, '.', ',');
			$data['total_withdrawals'] = '$ ' . number_format($total_withdrawal->amount, 2, '.', ',');
			$data['last_withdrawal'] = '$ ' . number_format($last_withdrawal->amount, 2, '.', ',');
			$data['total_growth'] = '$ ' . number_format($total_growth, 2, '.', ',');
			$data['last_deposit'] = '$ ' . number_format($last_deposit->amount, 2, '.', ',');
			// print_r($last_deposit_date);
			$data['total_deposit'] = '$ ' . number_format($total_deposit->amount, 2, '.', ',');
			$data['referral_bonus'] = '$ ' . number_format($total_bonus, 2, '.', ',');
			$data['activation_fund'] = '$ ' . number_format($activation_fund, 2, '.', ',');

			// if($todays_income->todays_income != null)
			$data['todays_income'] = '$ ' . number_format($todays_income->todays_income, 2, '.', ',');
			// '$'.number_format($_POST['deposit_amount'], 2, '.', ',');

			// print_r($this->WithdrawalModel->get_pending_withdrawal($member_data->id));
		}
		// $data['referral_code'] = $this->Referral_codes->get_members_code($member_data->referral_code_id)->code;

		// $last_deposit = $this->DepositModel->get_latest_deposit($member_data->id);
		// $temp_date = new DateTime($last_deposit->date_approved);

		// $qry = "insert into td_daily_income values (null, 100, '" . $temp_date->modify('+1 day')->format('Y-m-d H:i:s') . "', 2,2)";
		// print_r($qry);
		// $this->Daily_income_model->add($qry);


		$this->load->view('pages/dashboard', $data);



		// print_r($temp_date);
		// print_r($temp_date->modify('+1 day'));
		// echo "\n";
		// print_r($temp_date->modify('+1 day')->format('Y-m-d H:i:s'));

	}
}