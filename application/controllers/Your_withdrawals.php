<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Your_Withdrawals extends CI_Controller
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

    date_default_timezone_set('Asia/Manila');
  }

  public function index()
  {

    $data['title'] = 'Withdraw History';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');

    $member = $this->Members->get_member($this->session->username);

    $withdrawal_history = array();
    $all_withdrawals = $this->WithdrawalModel->get_withdrawal_per_member($member->id);
    foreach ($all_withdrawals as $withdrawal) {
      $history = array();
      $history['amount'] = $withdrawal->amount;

      if ($withdrawal->is_from_bonus) {
        $history['source'] = 'Lifestyle Bonus';
      } else {
        $history['source'] = 'Current Balance';
      }

      $history['mode'] = $withdrawal->payment_method;
      $history['date'] = $withdrawal->date;
      $history['status'] = ($withdrawal->is_pending == 1) ? 'Pending' : 'Approved';

      array_push($withdrawal_history, $history);
    }
    $data['withdrawal_history'] = $withdrawal_history;

    $this->load->view('pages/your_withdrawals', $data);
  }
}