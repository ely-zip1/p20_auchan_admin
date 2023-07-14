<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Withdrawals_admin extends CI_Controller
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
  }

  public function index()
  {
    $data['title'] = 'Withdrawals';

    $pending_withdrawals = $this->WithdrawalModel->get_pending();

    // print_r($pending_withdrawals);
    $withdrawal_data = array();
    foreach($pending_withdrawals as $pending) {
      // print_r();
      if(!$this->Members->is_exist($pending->member_id)) {
        continue;
      }

      $member_data = $this->Members->get_member_by_id($pending->member_id);

      $temp = array();
      $temp['id'] = $pending->id;
      $temp['member_id'] = $member_data->id;
      $temp['client_name'] = ucfirst($member_data->full_name);

      // $taxed_amount = $pending->amount - ($pending->amount * 0.05);
      $taxed_amount = $pending->amount;
      $temp['amount'] = number_format($taxed_amount, 2);

      $temp['email'] = $member_data->email_address;
      $temp['date'] = $pending->date;

      // $mode = $this->Withdrawal_Mode_model->get_by_id($pending->payment_method_id);
      if($pending->payment_method == 'Bank'){
        $bank = $this->Bank_model->get_per_member_id($member_data->id);

        $temp['mode'] = 'Bank';
        $temp['pop_over_title'] = "Bank Account";
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>Bank Name</strong></br>
                                        <label>" . $bank->bank_name . "</label>
                                      </div>
                                      <div class='form-group'>
                                        <strong class='mr-4'>Account Name</strong></br>
                                        <label>" . $bank->account_name . "</label>
                                      </div>
                                      <div class='form-group'>
                                        <strong class='mr-4'>Account Number</strong></br>
                                        <label>" . $bank->account_number . "</label>
                                      </div>
                                  ";
      }else if($pending->payment_method == 'SPAR ATM Debit Card'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                  <strong class='mr-4'>SPAR Bank Name</strong></br>
                                  <label>" . $member_data->spar_bank_name . "</label>
                                </div>
                                <div class='form-group'>
                                  <strong class='mr-4'>SPAR Account Name</strong></br>
                                  <label>" . $member_data->spar_account_name . "</label>
                                </div>
                            ";
      }else if($pending->payment_method == 'Bitcoin'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>".ucfirst($pending->payment_method)." Account</strong></br>
                                        <label>" . $payment_mode->bitcoin . "</label>
                                      </div>
                                  ";
      }else if($pending->payment_method == 'Ethereum'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>".ucfirst($pending->payment_method)." Account</strong></br>
                                        <label>" . $payment_mode->ethereum . "</label>
                                      </div>
                                  ";
      }else if($pending->payment_method == 'Bitcoin Cash'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>".ucfirst($pending->payment_method)." Account</strong></br>
                                        <label>" . $payment_mode->bitcoin_cash . "</label>
                                      </div>
                                  ";
      }else if($pending->payment_method == 'Stellar'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>".ucfirst($pending->payment_method)." Account</strong></br>
                                        <label>" . $payment_mode->stellar . "</label>
                                      </div>
                                  ";
      }else if($pending->payment_method == 'Ripple (XRP)'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>".ucfirst($pending->payment_method)." Account</strong></br>
                                        <label>" . $payment_mode->xrp_account . "</label></br>
                                        <label><strong>Tag: </strong>" . $payment_mode->xrp_tag . "</label>
                                      </div>
                                  ";
      }else if($pending->payment_method == 'Tron (TRX)'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>".ucfirst($pending->payment_method)." Account</strong></br>
                                        <label>" . $payment_mode->trx . "</label>
                                      </div>
                                  ";
      }else if($pending->payment_method == 'Tether (USDT)'){
        $payment_mode = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

        $temp['mode'] = $pending->payment_method;
        $temp['pop_over_title'] = ucfirst($pending->payment_method);
        $temp['pop_over_text'] = "<div class='form-group'>
                                        <strong class='mr-4'>".ucfirst($pending->payment_method)." Account</strong></br>
                                        <label>" . $payment_mode->usdt . "</label>
                                      </div>
                                  ";
      }

      array_push($withdrawal_data, $temp);
    }

    $data['withdrawal_data'] = $withdrawal_data;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/pending_withdrawals', $data);
    $this->load->view('admin/templates/footer');
  }

  public function approve_withdrawal($withdrawal_id)
  {

    $this->WithdrawalModel->Approve_pending($withdrawal_id);

    redirect('withdrawals_admin', 'refresh');
  }

  public function delete_withdrawal($withdrawal_id)
  {

    $this->WithdrawalModel->delete_withdrawal($withdrawal_id);
    redirect('withdrawals_admin', 'refresh');
  }

  public function view_withdrawal($withdrawal_id, $wmode, $member_id)
  {

  }

}