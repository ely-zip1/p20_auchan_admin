<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Daily_income extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('DepositModel');
    $this->load->model('WithdrawalModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('Referral_bonus_model');
    $this->load->model('Indirect_bonus_model');
    $this->load->model('ReferralModel');
    $this->load->model('Withdrawal_Mode_model');
    $this->load->model('Bank_model');
    $this->load->model('Fund_transfer_model');
    $this->load->model('Fund_bonus_model');
    $this->load->model('Lifestyle_bonus_model');
    $this->load->model('Daily_income_model');

    date_default_timezone_set('Asia/Manila');
  }

  public function index()
  {

    $data['title'] = 'Income History';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');

    $member = $this->Members->get_member($this->session->username);

    $income_history = array();
    $all_income = $this->Daily_income_model->get_per_member($member->id);


    foreach ($all_income as $daily) {
      $deposit_detail = $this->DepositModel->get_by_id($daily->deposit_id);
      $plan = $this->PackageModel->get_package_by_id($deposit_detail->package_id);

      $history = array();
      $history['amount'] = $daily->amount;
      $history['plan'] = $plan->package_name;
      $history['date'] = $daily->date_added;

      array_push($income_history, $history);
    }

    $data['income_history'] = $income_history;

    $this->load->view('pages/daily_income', $data);
  }
}