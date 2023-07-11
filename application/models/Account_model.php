<?php
class Account_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();

    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('WithdrawalModel');
    $this->load->model('Referral_bonus_model');
    $this->load->model('Fund_transfer_model');
    $this->load->model('ReferralModel');
    $this->load->model('GroupSalesModel');
    $this->load->model('Advanced_withdrawals_model');

    date_default_timezone_set('Asia/Manila');
  }

  public function get_account_balance($user_id)
  {

    $member_data = $this->Members->get_member_by_id($user_id);

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
    $total_advanced_withdrawal = $this->Advanced_withdrawals_model->total_withdrawal($member_data->id);

    $account_balance = ($total_growth + $total_bonus + $total_received + $total_monthly_bonus->bonus) - ($total_withdrawal->amount + $total_reinvestment->amount + $total_sent + $pending_withdrawal->total + $total_advanced_withdrawal->total_withdrawal);

    // print_r($account_balance);

    return $account_balance;
  }
}