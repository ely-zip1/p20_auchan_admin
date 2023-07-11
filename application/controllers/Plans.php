<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plans extends CI_Controller
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
		$this->load->model('ReferralModel');
		$this->load->model('Account_model');
		$this->load->model('Fund_bonus_model');
		$this->load->model('Lifestyle_bonus_model');
		$this->load->model('Activation_fund_model');
		$this->load->model('Daily_income_model');

		date_default_timezone_set('Asia/Manila');
	}

	public function index()
	{
		$data = array(
			'title' => "Deposit"
		);

		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['date_registered'] = $this->session->userdata('date_registered');

		$data['is_verified'] = $this->Members->is_verified($data['username']);

		// if($_POST != null){
		// 	print_r($_POST);
		// }

		$selected_package_rate = '';
		$selected_package_duration = '';
		$packages = $this->PackageModel->get_packages();

		$data['plan1'] = strtoupper($packages[0]->package_name);
		$data['plan2'] = strtoupper($packages[1]->package_name);
		$data['plan3'] = strtoupper($packages[2]->package_name);
		// $data['plan4'] = strtoupper($packages[3]->package_name);

		$modes_of_payment = $this->Deposit_Options->get_all();

		$data['mode1'] = ucfirst($modes_of_payment[0]->name);
		$data['mode2'] = ucfirst($modes_of_payment[1]->name);
		$data['mode7'] = ucfirst($modes_of_payment[2]->name);
		$data['mode8'] = ucfirst($modes_of_payment[3]->name);
		$data['mode9'] = ucfirst($modes_of_payment[4]->name);
		$data['mode10'] = ucfirst($modes_of_payment[5]->name);
		$data['mode11'] = ucfirst($modes_of_payment[6]->name);


		$data['selected_plan'] = '';
		$data['selected_mode'] = 'mode17';

		$member_data = $this->Members->get_member($this->session->username);

		$account_balance = $this->Account_model->get_account_balance($this->session->user_id);

		$data['account_balance'] = number_format($account_balance, 2, '.', ',');

		$this->form_validation->set_rules('chosen_plan', 'Plan', 'required');
		$this->form_validation->set_rules('plan_payment_mode', 'Payment Mode', 'required');
		//$this->form_validation->set_rules('deposit_amount', 'Deposit Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|callback_valid_deposit|callback_validate_reinvestment|callback_validate_activation_fund');
		$this->form_validation->set_rules('deposit_amount', 'Deposit Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|callback_valid_deposit');

		if ($this->form_validation->run() == FALSE) {
			if (isset($_POST['chosen_plan'])) {
				$data['selected_plan'] = $_POST['chosen_plan'];
				if ($_POST['chosen_plan'] == 'plan1') {
					$data['selected_plan_name'] = $data['plan1'];
				} else if ($_POST['chosen_plan'] == 'plan2') {
					$data['selected_plan_name'] = $data['plan2'];
				} else if ($_POST['chosen_plan'] == 'plan3') {
					$data['selected_plan_name'] = $data['plan3'];
				}
				$data['selected_mode'] = $_POST['plan_payment_mode'];
				$data['deposit_amount'] = $_POST['deposit_amount'];
			}

			$this->load->view('pages/plans', $data);
		} else {
			$deposit_data = array();

			$deposit_data['member_id'] = $member_data->id;
			$deposit_data['date'] = date('Y-m-d H:i:s');
			$deposit_data['amount'] = $_POST['deposit_amount'];

			if ($_POST['chosen_plan'] == 'plan1') {
				$deposit_data['package_id'] = '1';
				$data['deposit_selected_plan'] = strtoupper($packages[0]->package_name);
				$selected_package_duration = $packages[0]->duration_in_days;
				$selected_package_rate = $packages[0]->daily_rate;
			} else if ($_POST['chosen_plan'] == 'plan2') {
				$deposit_data['package_id'] = '2';
				$data['deposit_selected_plan'] = strtoupper($packages[1]->package_name);
				$selected_package_duration = $packages[1]->duration_in_days;
				$selected_package_rate = $packages[1]->daily_rate;
			} else if ($_POST['chosen_plan'] == 'plan3') {
				$deposit_data['package_id'] = '5';
				$data['deposit_selected_plan'] = strtoupper($packages[2]->package_name);
				$selected_package_duration = $packages[2]->duration_in_days;
				$selected_package_rate = $packages[2]->daily_rate;
			}

			if ($_POST['plan_payment_mode'] == 'mode1') {
				$deposit_data['deposit_options_id'] = '1';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[0]->name);
				$data['deposit_address'] = $modes_of_payment[0]->account;
			} else if ($_POST['plan_payment_mode'] == 'mode2') {
				$deposit_data['deposit_options_id'] = '3';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[1]->name);
				$data['deposit_address'] = $modes_of_payment[1]->account;
			} else if ($_POST['plan_payment_mode'] == 'mode7') {
				$deposit_data['deposit_options_id'] = '11';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[2]->name);
				$data['deposit_address'] = $modes_of_payment[2]->account;
			} else if ($_POST['plan_payment_mode'] == 'mode8') {
				$deposit_data['deposit_options_id'] = '12';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[3]->name);
				$data['deposit_address'] = $modes_of_payment[3]->account;
			} else if ($_POST['plan_payment_mode'] == 'mode9') {
				$deposit_data['deposit_options_id'] = '13';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[4]->name);
				$data['deposit_address'] = $modes_of_payment[4]->account;
			} else if ($_POST['plan_payment_mode'] == 'mode10') {
				$deposit_data['deposit_options_id'] = '14';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[5]->name);
				$data['deposit_address'] = $modes_of_payment[5]->account;
			} else if ($_POST['plan_payment_mode'] == 'mode11') {
				$deposit_data['deposit_options_id'] = '16';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[6]->name);
				$data['deposit_address'] = $modes_of_payment[5]->account;
			} else if ($_POST['plan_payment_mode'] == 'mode17') {
				$deposit_data['deposit_options_id'] = '17';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[7]->name);
			}

			if ($_POST['plan_payment_mode'] == 'mode7') {
				$deposit_data['is_pending'] = '0';
				$deposit_data['date_approved'] = date('Y-m-d H:i:s');
			} else if ($_POST['plan_payment_mode'] == 'mode17') {
				$deposit_data['is_pending'] = '0';
				$deposit_data['date_approved'] = date('Y-m-d H:i:s');
			} else {
				$deposit_data['is_pending'] = '1';
			}

			// $deposit_data['is_pending'] = '1';

			if ($_POST['plan_payment_mode'] == 'mode17') {
				$new_deposit = array(
					'member_id' => $member_data->id,
					'amount' => -1 * abs($_POST['deposit_amount']),
					'date' => date('Y-m-d H:i:s')
				);

				$this->Activation_fund_model->add($new_deposit);
				$this->DepositModel->add_deposit($deposit_data);
			} else {
				$this->DepositModel->add_deposit($deposit_data);
			}


			if ($_POST['plan_payment_mode'] == 'mode7') {
				$last_deposit = $this->DepositModel->get_latest_deposit($member_data->id);
				$this->credit_referral_bonus($last_deposit->id);

				$this->Daily_income_model->generate_daily_income($last_deposit, $selected_package_duration, $selected_package_rate);

				// $this->create_daily_event($member_data, $last_deposit);
			}
			if ($_POST['plan_payment_mode'] == 'mode17') {
				$last_deposit = $this->DepositModel->get_latest_deposit($member_data->id);
				$this->credit_referral_bonus($last_deposit->id);

				$this->Daily_income_model->generate_daily_income($last_deposit, $selected_package_duration, $selected_package_rate);

				// $this->create_daily_event($member_data, $last_deposit);
			}

			redirect('deposit_details', 'refresh');
		}
	}

	function create_daily_event($member_data, $deposit_data)
	{
		$package = $this->PackageModel->get_package_by_id($deposit_data->package_id);
		$daily_income = $deposit_data->amount / $package->duration_in_days;
		$event_name = str_replace(' ', '', $member_data->username . "_" . $package->package_name . "_" . time());

		$daily_interest_event = "CREATE EVENT  " . $event_name . "
								ON SCHEDULE 
								EVERY 1 DAy
								STARTS CURRENT_TIMESTAMP + INTERVAL 1 DAY 
								ENDS CURRENT_TIMESTAMP + INTERVAL " . $package->duration_in_days . " DAY 
								ON COMPLETION PRESERVE 
								DO 
								insert into td_daily_income 
								VALUES (null, '" . $daily_income . "', CURRENT_TIMESTAMP, " . $deposit_data->member_id . ", " . $deposit_data->id . ")";

		$this->Daily_income_model->create_event($daily_interest_event);
	}

	function valid_deposit()
	{

		if ($_POST['chosen_plan'] == 'plan1') {
			if ($_POST['deposit_amount'] >= 200 && $_POST['deposit_amount'] <= 1999.99) {
				return true;
			} else {
				$this->form_validation->set_message('valid_deposit', 'Deposit Amount does not match your selected plan.');
				return false;
			}
		} else if ($_POST['chosen_plan'] == 'plan2') {
			if ($_POST['deposit_amount'] >= 2000 && $_POST['deposit_amount'] <= 19999.99) {
				return true;
			} else {
				$this->form_validation->set_message('valid_deposit', 'Deposit Amount does not match your selected plan.');
				return false;
			}
		} else if ($_POST['chosen_plan'] == 'plan3') {
			if ($_POST['deposit_amount'] >= 20000 && $_POST['deposit_amount'] <= 9999999.99) {
				return true;
			} else {
				$this->form_validation->set_message('valid_deposit', 'Deposit Amount does not match your selected plan.');
				return false;
			}
		}
	}

	public function validate_reinvestment()
	{
		if ($_POST['plan_payment_mode'] == 'mode7') {
			$member_data = $this->Members->get_member($this->session->username);

			$total_growth = $this->DepositModel->get_total_growth($member_data->id);
			$total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn($member_data->id);
			$total_bonus = $this->Referral_bonus_model->get_total_bonus($member_data->id);
			$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member_data->id);
			$total_sent = $this->Fund_transfer_model->get_total_sent($member_data->id);
			$total_received = $this->Fund_transfer_model->get_total_received($member_data->id);


			$account_balance = $this->Account_model->get_account_balance($member_data->id);
			// $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent;

			if ($_POST['chosen_plan'] == 'plan1') {
				if ($_POST['deposit_amount'] >= 200 && $_POST['deposit_amount'] <= 999.99) {
					if ($account_balance >= 200 && $account_balance >= $_POST['deposit_amount']) {
						return true;
					} else {
						$this->form_validation->set_message('validate_reinvestment', 'Insufficient Account Balance.');
						return false;
					}
				} else {
					$this->form_validation->set_message('validate_reinvestment', 'Reinvestment Amount does not match your selected package.');
					return false;
				}
			} else if ($_POST['chosen_plan'] == 'plan2') {
				if ($_POST['deposit_amount'] >= 2000 && $_POST['deposit_amount'] <= 19999.99) {
					if ($account_balance >= 2000 && $account_balance >= $_POST['deposit_amount']) {
						return true;
					} else {
						$this->form_validation->set_message('validate_reinvestment', 'Insufficient Account Balance.');
						return false;
					}
				} else {
					$this->form_validation->set_message('validate_reinvestment', 'Reinvestment Amount does not match your selected package.');
					return false;
				}
			} else if ($_POST['chosen_plan'] == 'plan3') {
				if ($_POST['deposit_amount'] >= 20000 && $_POST['deposit_amount'] <= 9999999) {
					if ($account_balance >= 20000 && $account_balance >= $_POST['deposit_amount']) {
						return true;
					} else {
						$this->form_validation->set_message('validate_reinvestment', 'Insufficient Account Balance.');
						return false;
					}
				} else {
					$this->form_validation->set_message('validate_reinvestment', 'Reinvestment Amount does not match your selected package.');
					return false;
				}
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	public function validate_activation_fund()
	{
		if ($_POST['plan_payment_mode'] != 'mode17') {
			return true;
		}

		$member_data = $this->Members->get_member($this->session->username);
		$total_AF = $this->Activation_fund_model->total_fund_per_member($member_data->id);

		if ($_POST['chosen_plan'] == 'plan1') {
			if ($_POST['deposit_amount'] >= 200 && $_POST['deposit_amount'] <= 1999.99) {
				if ($total_AF >= 20 && $total_AF >= $_POST['deposit_amount']) {
					return true;
				} else {
					$this->form_validation->set_message('validate_activation_fund', 'Insufficient Fund.');
					return false;
				}
			} else {
				$this->form_validation->set_message('validate_activation_fund', 'Amount does not match your selected package.');
				return false;
			}
		} else if ($_POST['chosen_plan'] == 'plan2') {
			if ($_POST['deposit_amount'] >= 2000 && $_POST['deposit_amount'] <= 19999.99) {
				if ($total_AF >= 2000 && $total_AF >= $_POST['deposit_amount']) {
					return true;
				} else {
					$this->form_validation->set_message('validate_activation_fund', 'Insufficient Fund.');
					return false;
				}
			} else {
				$this->form_validation->set_message('validate_activation_fund', 'Amount does not match your selected package.');
				return false;
			}
		} else if ($_POST['chosen_plan'] == 'plan3') {
			if ($_POST['deposit_amount'] >= 20000 && $_POST['deposit_amount'] <= 999999.99) {
				if ($total_AF >= 20000 && $total_AF >= $_POST['deposit_amount']) {
					return true;
				} else {
					$this->form_validation->set_message('validate_activation_fund', 'Insufficient Funds.');
					return false;
				}
			} else {
				$this->form_validation->set_message('validate_activation_fund', 'Amount does not match your selected package.');
				return false;
			}
		} else {
			return true;
		}
	}

	public function credit_referral_bonus($deposit_id)
	{

		$root_member = $this->Members->get_root()->username;
		$deposit = $this->DepositModel->get_by_id($deposit_id);
		$member = $this->Members->get_member_by_id($deposit->member_id);

		// if($this->Members->get_referrer($member->id)->referred_by == $root_member){
		// 	return;
		// }

		if ($this->Members->get_referrer($member->id)->username != $root_member) {
			$level_1 = $this->Members->get_referrer($member->id);
			// print_r($level_1);
			$bonus_1 = $deposit->amount * 0.08;
			$bonus_1_data = array(
				'deposit_id' => $deposit->id,
				'referrer_id' => $level_1->id,
				'amount' => $bonus_1
			);
			$bonus1_id = $this->Referral_bonus_model->insert($bonus_1_data);

			// if ($this->Members->get_referrer($level_1->id)->username != $root_member) {
			// 	$level_2 = $this->Members->get_referrer($level_1->id);
			// 	// print_r($level_2);
			// 	$bonus_2 = $deposit->amount * 0.01;
			// 	$bonus_2_data = array(
			// 		'deposit_id' => $deposit->id,
			// 		'referrer_id' => $level_2->id,
			// 		'amount' => $bonus_2
			// 	);
			// 	$bonus2_id = $this->Referral_bonus_model->insert($bonus_2_data);

			// }
		}
	}
}