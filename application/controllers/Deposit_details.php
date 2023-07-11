<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit_details extends CI_Controller {
		public function __construct()
        {
            parent::__construct();
						$this->load->model('DepositModel');
						$this->load->model('Deposit_Options');
						$this->load->model('PackageModel');
						$this->load->model('Members');
						$this->load->model('WithdrawalModel');
						$this->load->model('Referral_bonus_model');
						$this->load->model('ReferralModel');
						$this->load->model('Referral_codes');
						$this->load->model('Indirect_bonus_model');
        }

	public function index() {

		$data = array(
			'title' => "Deposit Details"
		);

				$data['username'] = $this->session->userdata('username');
				$data['email'] = $this->session->userdata('email');
				$data['fullname'] = $this->session->userdata('fullname');
				$data['date_registered'] = $this->session->userdata('date_registered');

		$member = $this->Members->get_member($this->session->username);
		$last_deposit = $this->DepositModel->get_latest_deposit($member->id);

		// print_r($last_deposit);

		$selected_plan = $this->PackageModel->get_package_by_id($last_deposit->package_id);
		$payment_mode = $this->Deposit_Options->get_by_id($last_deposit->deposit_options_id);

		$data['deposit_selected_plan'] = $selected_plan->package_name;
		$data['deposit_amount'] = '$'.number_format($last_deposit->amount, 2, '.', ',');
		$data['deposit_date'] = $last_deposit->date;
		$data['deposit_payment_mode'] = $payment_mode->name;
		$data['deposit_address'] = $payment_mode->account;
		$data['deposit_status'] = ($last_deposit->is_pending == 1)?'Waiting for payment':'Approved';
		$data['deposit_tag'] = ($payment_mode->tag);

		// print_r($payment_mode);

		// $this->load->view('templates/header', $data);
		$this->load->view('pages/deposit_details', $data);
		// $this->load->view('templates/footer');
	}
}