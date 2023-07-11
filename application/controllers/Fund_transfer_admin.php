<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fund_transfer_admin  extends CI_Controller
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

            date_default_timezone_set('Asia/Manila');
        }

	public function index()
	{
    $data = array(
      'title' => 'Transferred Funds'
    );

		$fund_transfers = $this->Fund_transfer_model->get_all();

    $fund_transfer_history = array();
    foreach ($fund_transfers as $fund_transfer) {
      $history = array();
      $history['amount'] = $fund_transfer->amount;

      $sender = $this->Members->get_member_by_id($fund_transfer->sender_member_id);
      $history['sender'] = $sender->full_name;

      $receiver = $this->Members->get_member_by_id($fund_transfer->receiver_member_id);
      $history['receiver'] = $receiver->full_name;

      $history['date'] = $fund_transfer->date;
      
      // if($fund_transfer->source_of_fund == "e_money"){
      //   $history['source'] = "Account balance";
      // }else{
      //   $history['source'] = "Activation fund";
      // }

      array_push($fund_transfer_history, $history);
    }

    $data['fund_transfer_history'] = $fund_transfer_history;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/fund_transfer_admin', $data);
    $this->load->view('admin/templates/footer');
  }
}