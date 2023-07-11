<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Advanced_withdrawal  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PackageModel');
		$this->load->model('DepositModel');
		$this->load->model('Members');
		$this->load->model('Deposit_Options');
		$this->load->model('WithdrawalModel');
		$this->load->model('Referral_bonus_model');
		$this->load->model('Fund_transfer_model');
		$this->load->model('Referral_codes');
		$this->load->model('Fund_bonus_model');
		$this->load->model('GroupSalesModel');
		$this->load->model('Advanced_withdrawals_model');

		date_default_timezone_set('Asia/Manila');
	}

	public function index()
	{
		$data = array(
			'title' => 'Advanced Withdrawal'
		);

		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['date_registered'] = $this->session->userdata('date_registered');

		$member_data = $this->Members->get_member($this->session->username);
		
		$capital_list = $this->DepositModel->get_deposits_last_2days($member_data->id);
		// print_r($capital_list);

		$data['investment_list'] = $this->check_for_withdrawals($capital_list,$member_data->id);
		$capital_count = count($data['investment_list']);
		$data['capital_count'] = $capital_count;

		$this->form_validation->set_rules('capital', 'Capital Investment', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|callback_is_amount_valid');

		if ($this->form_validation->run() == FALSE) {
			
			$this->load->view('pages/advanced_withdrawal', $data);
		}
		else {
			$deposit = $this->DepositModel->get_by_id($_POST['capital']);
		
			$withdrawal_data = array(
				'member_id' => $member_data->id,
				'deposit_id' => $deposit->id,
				'amount' => $_POST['amount'],
				'date' => date('Y-m-d H:i:s'),
				'capital' => $deposit->amount,
				'status' => 0
			);
			
			if($this->Advanced_withdrawals_model->add($withdrawal_data)){
				$data['is_received'] = true;
				$this->session->set_flashdata('advanced_withdrawal_status', "Your application has been received.");

				$data['investment_list'] = $this->check_for_withdrawals($capital_list,$member_data->id);
				$capital_count = count($data['investment_list']);
				$data['capital_count'] = $capital_count;
				$this->load->view('pages/advanced_withdrawal', $data);
			}else{
				$data['is_received'] = false;
				$this->session->set_flashdata('advanced_withdrawal_status', "There has been an error on our end. Please try again after a few minutes.");
				
				$data['investment_list'] = $this->check_for_withdrawals($capital_list,$member_data->id);
				$capital_count = count($data['investment_list']);
				$data['capital_count'] = $capital_count;
				$this->load->view('pages/advanced_withdrawal', $data);
			}
		}
		
    }

	public function is_amount_valid(){

		$deposit = $this->DepositModel->get_by_id($_POST['capital']);
		
		if($_POST['amount'] <= ($deposit->amount * .40)){
			return true;
		}else{
			$this->form_validation->set_message('is_amount_valid','Invalid amount.');
			return false;
		}
	}

	public function check_for_withdrawals($capital_list, $member_id){
		$counter = 0;
		foreach($capital_list as $deposit){
			$has_withdrawal = $this->Advanced_withdrawals_model->has_withdrawal($member_id, $deposit->id);
			
			if($has_withdrawal){
				unset($capital_list[$counter]);
			}
			$counter++;
		}

		return $capital_list;
	}

  }