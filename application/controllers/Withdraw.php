<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Withdraw extends CI_Controller
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
    $this->load->model('GroupSalesModel');
    $this->load->model('Account_model');

    date_default_timezone_set('Asia/Manila');
  }

  public function index()
  {
    $data['title'] = 'Withdraw';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');

    $member = $this->Members->get_member($this->session->username);



    $withdrawals = $this->WithdrawalModel->get_total_withdrawal_per_member($member->id);
    $withdrawal_modes = $this->Withdrawal_Mode_model->get_per_member($member->id);
    $bank = $this->Bank_model->get_per_member_id($member->id);

    $pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member->id);
    $total_withdrawal = $this->WithdrawalModel->get_total_withdrawal_per_member($member->id);
    $last_withdrawal = $this->WithdrawalModel->get_latest_withdrawal_amount($member->id);
    $total_growth = $this->DepositModel->get_total_growth($member->id);
    $last_deposit = $this->DepositModel->get_latest_deposit_amount($member->id);
    $total_deposit = $this->DepositModel->get_total_deposit($member->id);
    $total_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);
    $total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member->id);
    $total_sent = $this->Fund_transfer_model->get_total_sent($member->id);
    $total_received = $this->Fund_transfer_model->get_total_received($member->id);
    $active_deposit = $this->DepositModel->get_total_approved_deposit_per_member($member->id);
    $total_monthly_bonus = $this->GroupSalesModel->get_total_per_member($member->id);

    $fsf_bonus = $this->Fund_bonus_model->total_fund_bonus($member->id);
    $lifestyle_bonus = $this->Lifestyle_bonus_model->total_fund_bonus($member->id);
    $bonus_withdrawal = $this->WithdrawalModel->get_bonus_withdrawal_per_member($member->id)->amount;

    $lifestyle_bonus_balance = $lifestyle_bonus - $bonus_withdrawal;

    // $account_balance = ($total_growth + $total_bonus + $total_received + $total_monthly_bonus->bonus ) - $total_withdrawal->amount - $total_reinvestment->amount - $total_sent - $pending_withdrawal->total;

    $account_balance = $this->Account_model->get_account_balance($member->id);

    // if($account_balance < 20){
    //   $data['withdrawable'] = 'not withdrawable';
    // }

    $data['account_balance'] = number_format($account_balance, 2, '.', ',');
    $data['pending_withdrawal'] = number_format($pending_withdrawal->total, 2, '.', ',');
    $data['lifestyle_bonus_balance'] = number_format($lifestyle_bonus_balance, 2, '.', ',');

    $data['selected_mode'] = 'mode1';
    $data['selected_source'] = 'account_balance';

    $withdrawal_history = array();
    $all_withdrawals = $this->WithdrawalModel->get_withdrawal_per_member($member->id);
    foreach ($all_withdrawals as $withdrawal) {
      $history = array();
      $history['amount'] = $withdrawal->amount;
      $history['mode'] = $withdrawal->payment_method;
      $history['date'] = $withdrawal->date;
      $history['status'] = ($withdrawal->is_pending == 1) ? 'Pending' : 'Fulfilled';

      array_push($withdrawal_history, $history);
    }
    $data['withdrawal_history'] = $withdrawal_history;

    $this->form_validation->set_rules('plan_payment_mode', 'Payment Mode', 'required');
    $this->form_validation->set_rules('withdraw_amount', 'Withdraw Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|greater_than_equal_to[20]|callback_valid_amount|callback_has_pending');

    if ($this->form_validation->run() == FALSE) {
      if (isset($_POST['plan_payment_mode'])) {
        $data['selected_mode'] = $_POST['plan_payment_mode'];
      }
      // $this->load->view('templates/header', $data);
      $this->load->view('pages/withdraw', $data);
      // $this->load->view('templates/footer');
    } else {
      $withdrawal_data['member_id'] = $member->id;
      $withdrawal_data['date'] = date('Y-m-d H:i:s');
      $withdrawal_data['amount'] = $_POST['withdraw_amount'];

      if ($_POST['plan_payment_mode'] == 'mode1') {
        $withdrawal_data['payment_method'] = 'Bank';
        if (strlen($bank->bank_name) <= 0) {
          $data['update_field'] = 'Bank';
          redirect('account_settings', 'refresh');
        }
      } else if ($_POST['plan_payment_mode'] == 'mode01') {
        $withdrawal_data['payment_method'] = 'SPAR ATM Debit Card';
      }else if ($_POST['plan_payment_mode'] == 'mode2') {
        $withdrawal_data['payment_method'] = 'Bitcoin';
        if (strlen($withdrawal_modes->bitcoin) <= 0) {
          $this->session->set_flashdata('update_field', 'Bitcoin');
          redirect('account_settings', 'refresh');
        }
      } else if ($_POST['plan_payment_mode'] == 'mode3') {
        $withdrawal_data['payment_method'] = 'Ethereum';
        if (strlen($withdrawal_modes->ethereum) <= 0) {
          $this->session->set_flashdata('update_field', 'Ethereum');
          redirect('account_settings', 'refresh');
        }
      } else if ($_POST['plan_payment_mode'] == 'mode4') {
        $withdrawal_data['payment_method'] = 'Ripple (XRP)';
        if (strlen($withdrawal_modes->xrp_account) <= 0) {
          $this->session->set_flashdata('update_field', 'Ripple(XRP)');
          redirect('account_settings', 'refresh');
        }
      } else if ($_POST['plan_payment_mode'] == 'mode5') {
        $withdrawal_data['payment_method'] = 'Tron (TRX)';
        if (strlen($withdrawal_modes->trx) <= 0) {
          $this->session->set_flashdata('update_field', 'Tron(TRX)');
          redirect('account_settings', 'refresh');
        }
      } else if ($_POST['plan_payment_mode'] == 'mode10') {
        $withdrawal_data['payment_method'] = 'Litecoin';
        if (strlen($withdrawal_modes->litecoin) <= 0) {
          $this->session->set_flashdata('update_field', 'Litecoin');
          redirect('account_settings', 'refresh');
        }
      } else if ($_POST['plan_payment_mode'] == 'mode11') {
        $withdrawal_data['payment_method'] = 'Bitcoin Cash';
        if (strlen($withdrawal_modes->bitcoin_cash) <= 0) {
          $this->session->set_flashdata('update_field', 'Bitcoin Cash');
          redirect('account_settings', 'refresh');
        }
      }else if ($_POST['plan_payment_mode'] == 'mode12') {
        $withdrawal_data['payment_method'] = 'USDT';
        if (strlen($withdrawal_modes->usdt) <= 0) {
          $this->session->set_flashdata('update_field', 'USDT');
          redirect('account_settings', 'refresh');
        }
      }
      if ($_POST['withdrawal_source'] == 'account_balance') {
        $withdrawal_data['is_from_bonus'] = 0;
      }
      $withdrawal_data['is_pending'] = 1;

      $this->WithdrawalModel->add_new_withdrawal($withdrawal_data);
      $this->session->set_flashdata('withdrawal-message', 'success');

      redirect('withdraw', 'refresh');
    }
  }

  public function valid_amount()
  {
    $member = $this->Members->get_member($this->session->username);

    $pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member->id);
    $total_growth = $this->DepositModel->get_total_growth($member->id);
    $total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn($member->id);
    $total_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);
    $total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member->id);
    $total_sent = $this->Fund_transfer_model->get_total_sent($member->id);
    $total_received = $this->Fund_transfer_model->get_total_received($member->id);

    $fsf_bonus = $this->Fund_bonus_model->total_fund_bonus($member->id);
    $lifestyle_bonus = $this->Lifestyle_bonus_model->total_fund_bonus($member->id);
    $bonus_withdrawal = $this->WithdrawalModel->get_bonus_withdrawal_per_member($member->id)->amount;

    $lifestyle_bonus_balance = $lifestyle_bonus - $bonus_withdrawal;

    // $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent - $pending_withdrawal->total;

    $account_balance = $this->Account_model->get_account_balance($member->id);

    if ($_POST['withdrawal_source'] == 'account_balance') {
      if ($_POST['withdraw_amount'] > $account_balance) {
        $this->form_validation->set_message('valid_amount', 'Invalid amount.');
        return false;
      } else if ($_POST['withdraw_amount'] < 20) {
        $this->form_validation->set_message('valid_amount', 'Invalid amount.');
        return false;
      } else if ($_POST['withdraw_amount'] > 500) {
        $this->form_validation->set_message('valid_amount', 'Amount must be less than or equal to 500 USD.');
        return false;
      } else {
        return true;
      }
    } else if ($_POST['withdrawal_source'] == 'bonus') {
      if ($_POST['withdraw_amount'] > $lifestyle_bonus_balance) {
        $this->form_validation->set_message('valid_amount', 'Invalid amount.');
        return false;
      } else if ($_POST['withdraw_amount'] < 20) {
        $this->form_validation->set_message('valid_amount', 'Invalid amount.');
        return false;
      } else if ($_POST['withdraw_amount'] > 500) {
        $this->form_validation->set_message('valid_amount', 'Amount must be less than or equal to 500 USD.');
        return false;
      } else {
        return true;
      }
    }
  }

  public function has_pending()
  {
    if (!isset($_POST['withdraw_amount'])) {
      $this->form_validation->set_message('has_pending', 'Invalid amount!');
      return false;
    }

    if (strlen($_POST['withdraw_amount']) == 0) {
      $this->form_validation->set_message('has_pending', 'Invalid amount!');
      return false;
    }

    if (!is_numeric($_POST['withdraw_amount'])) {
      $this->form_validation->set_message('has_pending', 'Invalid amount!');
      return false;
    }

    $member = $this->Members->get_member($this->session->username);

    $pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member->id);
    $total_growth = $this->DepositModel->get_total_growth($member->id);
    $total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn($member->id);
    $total_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);
    $total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member->id);
    $total_sent = $this->Fund_transfer_model->get_total_sent($member->id);
    $total_received = $this->Fund_transfer_model->get_total_received($member->id);

    // $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent;

    $account_balance = $this->Account_model->get_account_balance($member->id);

    if (($pending_withdrawal->total + $_POST['withdraw_amount']) > $account_balance) {
      $this->form_validation->set_message('has_pending', 'Pending withdrawal will be more than account balance.');
      return false;
    } else {
      return true;
    }
  }
}