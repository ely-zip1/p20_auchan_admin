<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fund_transfer_admin_actfund  extends CI_Controller
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
            $this->load->model('Activation_fund_model');
						$this->load->model('Referral_codes');

            date_default_timezone_set('Asia/Manila');
        }

	public function index()
	{
    $data = array(
      'title' => 'Transferred Funds'
    );

		$sent_funds = $this->Activation_fund_model->get_all_sent_funds();

    $fund_transfer_history = array();
    foreach ($sent_funds as $_sent) {
      $history = array();
      $history['amount'] = abs($_sent->amount);
      // $_received = $this->Activation_fund_model->get_receiver($_sent->peer_id, $history['amount'], $_sent->date, $_sent->member_id);

      $sender = $this->Members->get_member_by_id($_sent->member_id);
      $history['sender'] = $sender->full_name;

      $receiver = $this->Members->get_member_by_id($_sent->peer_id);
      $history['receiver'] = $receiver->full_name;

      $history['date'] = $_sent->date;

      array_push($fund_transfer_history, $history);
    }

    $data['fund_transfer_history'] = $fund_transfer_history;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/fund_transfer_admin_actfund', $data);
    $this->load->view('admin/templates/footer');
  }
}