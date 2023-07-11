<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User_details extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('WithdrawalModel');
    $this->load->model('Members');
    $this->load->model('PackageModel');
    $this->load->model('Withdrawal_Mode_model');
    $this->load->model('Bitcoin_model');
    $this->load->model('Bank_model');
    $this->load->model('Gcash_model');
    $this->load->model('Remittance_model');
    $this->load->model('DepositModel');
    $this->load->model('Deposit_Options');
    $this->load->model('ReferralModel');
  }

  public function index()
  {
    //
  }

  public function show($member_id){
    $member = $this->Members->get_member_by_id($member_id);

    $deposits = array();
    $withdrawals = array();
    $btc_acc = array();
    $bank_acc = array();
    $gcash_acc = array();
    $remittance_acc = array();

    $member_data = array(
      'name' => $member->full_name,
      'email' => $member->email_address,
      'date' => $member->date
    );

    $data['member_data'] = $member_data;
// =========================================================================================
// =========================================================================================

    $deposit_data = $this->DepositModel->get_deposit_per_member($member_id);
    $deposits = array();
    foreach($deposit_data as $deposit){
      $deposit_option = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
      $package = $this->PackageModel->get_package_by_id($deposit->package_id);

      $deposit_temp = array();
      $deposit_temp['package'] = $package->package_name;
      $deposit_temp['amount'] = number_format($deposit->amount,2);
      $deposit_temp['mode'] = $deposit_option->name;
      $deposit_temp['pending'] = $deposit->is_pending == '0'?'Fulfilled':'Pending';
      $deposit_temp['expired'] = $deposit->is_expired == '0'?'No':'Yes';

      array_push($deposits,$deposit_temp );
    }

    $data['deposit'] = $deposits;
    // =========================================================================================
    // =========================================================================================
    $data['title'] = 'User';

    $withdrawal_data = $this->WithdrawalModel->get_withdrawal_per_member($member_id);

    $withdrawals = array();
    foreach($withdrawal_data as $withdrawal){

      $withdrawal_temp = array(
        'amount' => number_format($withdrawal->amount,2),
        'request_date' => $withdrawal->date,
        'approve_date' => $withdrawal->date_approved,
        'pending' => $withdrawal->is_pending == '1'?'Pending':'Fulfilled'
      );

      $withdrawal_temp['method'] = ucfirst($withdrawal->payment_method);

      array_push($withdrawals, $withdrawal_temp);
    }

    $data['withdrawals'] = $withdrawals;
    // =========================================================================================
    // =========================================================================================

    $referee_data = $this->ReferralModel->get_referees($member_id);

    $referrals = array();
    foreach($referee_data as $referee){
      $downline_data = $this->Members->get_member_by_id($referee->referee_id);
      $downline = array(
        'name' => $downline_data->full_name,
        'email' => $downline_data->email_address,
        'date' => $downline_data->date
      );
      array_push($referrals, $downline);
    }

    $data['referrals'] = $referrals;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/user_details', $data);
    $this->load->view('admin/templates/footer');

  }

}