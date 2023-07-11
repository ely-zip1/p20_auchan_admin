<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Your_deposits extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('Referral_bonus_model');
    $this->load->model('Indirect_bonus_model');
    $this->load->model('ReferralModel');
    $this->load->model('Account_model');
  }

  public function index()
  {
    $data['title'] = 'Deposits';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');

    $account_balance = $this->Account_model->get_account_balance($this->session->user_id);

    $data['account_balance'] = number_format($account_balance, 2, '.', ',');

    $member = $this->Members->get_member($this->session->username);
    $deposits = $this->DepositModel->get_deposit_per_member($member->id);
    $packages = $this->PackageModel->get_packages();

    $total_deposit = 0;
    $plan1_deposit_data = array();
    $plan2_deposit_data = array();
    $plan3_deposit_data = array();
    $plan4_deposit_data = array();

    $plan1_days = $packages[0]->duration_in_days;
    $plan2_days = $packages[1]->duration_in_days;
    $plan3_days = $packages[2]->duration_in_days;

    foreach ($deposits as $deposit) {

      if ($deposit->is_shown == 0) {
        continue;
      }
      
      if ($deposit->is_pending == 0) {
        $total_deposit += $deposit->amount;
      }

      if ($deposit->package_id == 1) {
        $plan1 = array();
        $plan1['amount'] = number_format($deposit->amount, 2, '.', ',');

        $payment_mode = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
        $plan1['mode'] = $payment_mode->name;

        if ($payment_mode->name == 'XRP') {
          $plan1['send_to'] = $payment_mode->tag . ' / ' . $payment_mode->account;
        } else {
          $plan1['send_to'] = $payment_mode->account;
        }

        $plan1['date'] = $deposit->date;
        $plan1['date_approved'] = $deposit->date_approved;

        if ($deposit->deposit_options_id == 7) {
          $plan1['status'] = 'Processed';
        } else {
          $plan1['status'] = ($deposit->is_pending == 1) ? 'Processing' : 'Processed';
        }

        if ($deposit->is_pending == 1) {
          $plan1['days_remaining'] = 'n/a';
        } else {
          $plan1['days_remaining'] = $this->calculate_remaining_days($plan1_days, $deposit->date_approved);
        }

        array_push($plan1_deposit_data, $plan1);
      } else if ($deposit->package_id == 2) {
        $plan2 = array();
        $plan2['amount'] = number_format($deposit->amount, 2, '.', ',');

        $payment_mode = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
        $plan2['mode'] = $payment_mode->name;

        if ($payment_mode->name == 'XRP') {
          $plan2['send_to'] = $payment_mode->tag . ' / ' . $payment_mode->account;
        } else {
          $plan2['send_to'] = $payment_mode->account;
        }

        $plan2['date'] = $deposit->date;
        $plan2['date_approved'] = $deposit->date_approved;

        if ($deposit->deposit_options_id == 7) {
          $plan2['status'] = 'Processed';
        } else {
          $plan2['status'] = ($deposit->is_pending == 1) ? 'Processing' : 'Processed';
        }

        if ($deposit->is_pending == 1) {
          $plan2['days_remaining'] = 'n/a';
        } else {
          $plan2['days_remaining'] = $this->calculate_remaining_days($plan2_days, $deposit->date_approved);
        }

        array_push($plan2_deposit_data, $plan2);
      } else if ($deposit->package_id == 5) {
        $plan3 = array();
        $plan3['amount'] = number_format($deposit->amount, 2, '.', ',');

        $payment_mode = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
        $plan3['mode'] = $payment_mode->name;

        if ($payment_mode->name == 'XRP') {
          $plan3['send_to'] = $payment_mode->tag . ' / ' . $payment_mode->account;
        } else {
          $plan3['send_to'] = $payment_mode->account;
        }

        $plan3['date'] = $deposit->date;
        $plan3['date_approved'] = $deposit->date_approved;

        if ($deposit->deposit_options_id == 7) {
          $plan3['status'] = 'Processed';
        } else {
          $plan3['status'] = ($deposit->is_pending == 1) ? 'Processing' : 'Processed';
        }

        if ($deposit->is_pending == 1) {
          $plan3['days_remaining'] = 'n/a';
        } else {
          $plan3['days_remaining'] = $this->calculate_remaining_days($plan3_days, $deposit->date_approved);
        }

        array_push($plan3_deposit_data, $plan3);
      }
      // else if ($deposit->package_id == 7) {
      //   $plan4 = array();
      //   $plan4['amount'] = number_format($deposit->amount, 2, '.', ',');

      //   $payment_mode = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
      //   $plan4['mode'] = $payment_mode->name;

      //   if ($payment_mode->name == 'XRP') {
      //     $plan4['send_to'] = $payment_mode->tag . ' / ' . $payment_mode->account;
      //   } else {
      //     $plan4['send_to'] = $payment_mode->account;
      //   }

      //   $plan4['date'] = $deposit->date;
      //   $plan4['date_approved'] = $deposit->date_approved;

      //   if ($deposit->deposit_options_id == 7) {
      //     $plan4['status'] = 'Processed';
      //   } else {
      //     $plan4['status'] = ($deposit->is_pending == 1) ? 'Processing' : 'Processed';
      //   }

      //   if ($deposit->is_pending == 1) {
      //     $plan4['days_remaining'] = 'n/a';
      //   } else {
      //     $plan4['days_remaining'] = $this->calculate_remaining_days($plan4_days, $deposit->date_approved);
      //   }

      //   array_push($plan4_deposit_data, $plan4);
      // }
    }

    $data['plan1_deposit_data'] = $plan1_deposit_data;
    $data['plan2_deposit_data'] = $plan2_deposit_data;
    $data['plan3_deposit_data'] = $plan3_deposit_data;
    $data['plan4_deposit_data'] = $plan4_deposit_data;
    $data['total_details'] = number_format($total_deposit, 2, '.', ',');

    // $this->load->view('templates/header', $data);
    $this->load->view('pages/your_deposits', $data);
    // $this->load->view('templates/footer');
  }

  public function calculate_remaining_days($contract_days, $date_approved)
  {
    $start_date = new DateTime($date_approved);
    $end_date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

    // print_r($start_date);
    // print_r($end_date);


    $days  = $end_date->diff($start_date)->format('%a');

    // print_r($days);

    // $difference = $start_date->diff($end_date);
    $remaining_days = $contract_days - $days;

    return abs($remaining_days);
  }
}