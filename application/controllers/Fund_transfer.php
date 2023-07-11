<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fund_transfer extends CI_Controller
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
		$this->load->model('Account_model');
		$this->load->model('Activation_fund_model');
		$this->load->model('Spar_fund_model');
		$this->load->model('Spar_fund_transfer_model');

		date_default_timezone_set('Asia/Manila');
	}

	public function index()
	{
		$data = array(
			'title' => 'Money Transfer'
		);

		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['date_registered'] = $this->session->userdata('date_registered');

		$member_data = $this->Members->get_member($this->session->username);
		
		// QUERY SENT FUNDS 
		// =============================================================================================
		$sent_funds = $this->Fund_transfer_model->sent_per_member($member_data->id);
		$sent_af = $this->Activation_fund_model->get_sent_funds($member_data->id);
		$sent_sparfunds = $this->Spar_fund_transfer_model->get_sent($member_data->id);

		$sent_fund_history = array();
		foreach ($sent_funds as $sent_fund) {
			$sent = array();
			$sent['amount'] = $sent_fund->amount;

			$recipient_data = $this->Members->get_member_by_id($sent_fund->receiver_member_id);
			$sent['recipient'] = $recipient_data->full_name;
			$sent['date'] = $sent_fund->date;
			$sent['source'] = "Account Balance";


			array_push($sent_fund_history, $sent);
		}
		foreach ($sent_af as $sent_fund) {
			$sent = array();
			$sent['amount'] = abs($sent_fund->amount);

			$recipient_data = $this->Members->get_member_by_id($sent_fund->peer_id);
			$sent['recipient'] = $recipient_data->full_name;
			$sent['date'] = $sent_fund->date;
			$sent['source'] = "USD Wallet";

			array_push($sent_fund_history, $sent);
		}
		if($sent_sparfunds != null)
		foreach ($sent_sparfunds as $sent_spar) {
			$sent = array();
			$sent['amount'] = $sent_spar->amount;

			$recipient_data = $this->Members->get_member_by_id($sent_spar->recipient_id);
			$sent['recipient'] = $recipient_data->full_name;
			$sent['date'] = $sent_spar->date;
			$sent['source'] = "SPAR Fund";

			array_push($sent_fund_history, $sent);
		}

		$data['sent_fund_history'] = $sent_fund_history;

		// QUERY RECEIVED FUNDS 
		// =============================================================================================
		$received_funds = $this->Fund_transfer_model->received_per_member($member_data->id);
		$received_af = $this->Activation_fund_model->get_received_funds($member_data->id);
		$recieved_sparfunds = $this->Spar_fund_transfer_model->get_received($member_data->id);


		$received_fund_history = array();
		foreach ($received_funds as $received_fund) {
			$received = array();
			$received['amount'] = $received_fund->amount;

			$sender_data = $this->Members->get_member_by_id($received_fund->sender_member_id);
			$received['sender'] = $sender_data->full_name;
			$received['date'] = $received_fund->date;
			$received['source'] = "Account Balance";

			array_push($received_fund_history, $received);
		}
		foreach ($received_af as $received_fund) {
			$received = array();
			$received['amount'] = abs($received_fund->amount);

			$sender_data = $this->Members->get_member_by_id($received_fund->peer_id);
			$received['sender'] = $sender_data->full_name;
			$received['date'] = $received_fund->date;
			$received['source'] = "USD Wallet";

			array_push($received_fund_history, $received);
		}
		if($sent_sparfunds != null)
		foreach ($recieved_sparfunds as $received_spar) {
			$received = array();
			$received['amount'] = abs($received_spar->amount);

			$sender_data = $this->Members->get_member_by_id($received_spar->sender_id);
			$received['sender'] = $sender_data->full_name;
			$received['date'] = $received_fund->date;
			$received['source'] = "SPAR Fund";

			array_push($received_fund_history, $received);
		}

		$data['received_fund_history'] = $received_fund_history;


		$pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member_data->id);
		$total_withdrawal = $this->WithdrawalModel->get_total_withdrawal_per_member($member_data->id);
		$last_withdrawal = $this->WithdrawalModel->get_latest_withdrawal_amount($member_data->id);
		$total_growth = $this->DepositModel->get_total_growth($member_data->id);
		$last_deposit = $this->DepositModel->get_latest_deposit_amount($member_data->id);
		$total_deposit = $this->DepositModel->get_total_deposit($member_data->id);
		$total_bonus = $this->Referral_bonus_model->get_total_bonus($member_data->id);
		$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member_data->id);
		$total_sent = $this->Fund_transfer_model->get_total_sent($member_data->id);
		$total_received = $this->Fund_transfer_model->get_total_received($member_data->id);
		$active_deposit = $this->DepositModel->get_total_approved_deposit_per_member($member_data->id);
		$total_monthly_bonus = $this->GroupSalesModel->get_total_per_member($member_data->id);

		$fsf_bonus = $this->Fund_bonus_model->total_fund_bonus($member_data->id);

		// $account_balance = ($total_growth + $total_bonus + $total_received + $total_monthly_bonus->bonus) - $total_withdrawal->amount - $total_reinvestment->amount - $total_sent - $pending_withdrawal->total;
		$account_balance = $this->Account_model->get_account_balance($member_data->id);
		$activation_fund = $this->Activation_fund_model->total_fund_per_member($member_data->id);
		$spar_fund_balance = $this->Spar_fund_model->get_member_balance($member_data->id);
		
		$data['spar_fund_balance'] = number_format($spar_fund_balance, 2, '.', ',');

		$data['account_balance'] = number_format($account_balance, 2, '.', ',');
		$data['activation_fund'] = number_format($activation_fund, 2, '.', ',');

		$this->form_validation->set_rules('receiver_code', 'Code', 'required|callback_validate_code');

		if (isset($_POST['transfer_source']))
			if ($_POST['transfer_source'] == 'e_money')
				$this->form_validation->set_rules('transfer_amount', 'Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|less_than_equal_to[' . $account_balance . ']');
			else if($_POST['transfer_source'] == 'act_fund')
				$this->form_validation->set_rules('transfer_amount', 'Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|less_than_equal_to[' . $activation_fund . ']');
			else
				$this->form_validation->set_rules('transfer_amount', 'Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|less_than_equal_to[' . $spar_fund_balance . ']');


		if ($this->form_validation->run() == FALSE) {
			// print_r('akjhfkajsthfklsadf');
			$this->load->view('pages/fund_transfer', $data);
		} else {
			$receiver_data = $this->Members->get_member($_POST['receiver_code']);

			if ($_POST['transfer_source'] == 'act_fund') {
				$sender_data = array(
					'member_id' => $member_data->id,
					'amount' => -1 * abs($_POST['transfer_amount']),
					'date' => date('Y-m-d H:i:s'),
					'status' => 'sent',
					'peer_id' => $receiver_data->id
				);

				$receiver_data = array(
					'member_id' => $receiver_data->id,
					'amount' => $_POST['transfer_amount'],
					'date' => date('Y-m-d H:i:s'),
					'status' => 'received',
					'peer_id' => $member_data->id
				);

				$this->Activation_fund_model->add($sender_data);
				$this->Activation_fund_model->add($receiver_data);
			} else if ($_POST['transfer_source'] == 'e_money') {
				$transfer_data = array(
					'sender_member_id' => $member_data->id
				);

				//   $referral_code_data = $this->Referral_codes->get_by_code($_POST['receiver_code']);
				$transfer_data['receiver_member_id'] = $receiver_data->id;
				$transfer_data['amount'] = $_POST['transfer_amount'];
				$transfer_data['date'] = date('Y-m-d H:i:s');
				$transfer_data['source_of_fund'] = $_POST['transfer_source'];

				$this->Fund_transfer_model->add($transfer_data);
			}else{
				$sparfund_transfer = array(
					'sender_id' => $member_data->id,
					'recipient_id' => $receiver_data->id,
					'amount' => $_POST['transfer_amount'],
					'date' => date('Y-m-d H:i:s')
				);

				$this->Spar_fund_transfer_model->add($sparfund_transfer);
			}


			// print_r($transfer_data);
			$this->session->set_flashdata('transfer_success', "You successfuly transfered $ " . number_format($_POST['transfer_amount'], 2, '.', ',') . " to " . $_POST['receiver_code'] . "!");

			redirect('fund_transfer', 'refresh');
		}
	}

	public function validate_code()
	{
		$is_code_valid = $this->Members->verify_member_code($_POST['receiver_code']);
		// print_r($is_code_valid);

		$receiver_data = $this->Members->get_member($_POST['receiver_code']);

		if ($receiver_data != null)
			if ($receiver_data->id == $this->session->user_id) {
				$this->form_validation->set_message('validate_code', 'You cannot transfer to your own account.');
				return false;
			}

		if ($is_code_valid != null)
			if ($is_code_valid) {
				return true;
			} else {
				$this->form_validation->set_message('validate_code', 'Code entered is invalid.');
				return false;
			}
	}
}