<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Deposits_admin extends CI_Controller
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
    $this->load->model('Fund_bonus_model');
    $this->load->model('Lifestyle_bonus_model');
    $this->load->model('Daily_income_model');
  }

  public function index()
  {
    $data['title'] = 'Deposits';

    $pending_deposits = $this->DepositModel->get_pending();

    // print_r($pending_deposits);

    $deposit_data = array();
    foreach ($pending_deposits as $pending) {
      // print_r($pending);

      if (isset($pending->member_id)) {

        if (!$this->Members->is_exist($pending->member_id)) {
          continue;
        }

        $member_data = $this->Members->get_member_by_id($pending->member_id);
        $deposit_mode = $this->Deposit_Options->get_by_id($pending->deposit_options_id);
        $package_data = $this->PackageModel->get_package_by_id($pending->package_id);

        $temp = array();
        $temp['id'] = $pending->id;
        $temp['client_name'] = ucfirst($member_data->full_name);
        $temp['email'] = $member_data->email_address;
        $temp['amount'] = number_format($pending->amount, 2);
        $temp['plan'] = $package_data->package_name;
        $temp['date'] = $pending->date;
        $temp['mode'] = $deposit_mode->name;

        array_push($deposit_data, $temp);
      }
    }

    $data['deposit_data'] = $deposit_data;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/pending_deposits', $data);
    $this->load->view('admin/templates/footer');
  }

  public function approve_deposit($deposit_id)
  {

    $root_member = $this->Members->get_root();
    $deposit = $this->DepositModel->get_by_id($deposit_id);
    $member = $this->Members->get_member_by_id($deposit->member_id);
    $package = $this->PackageModel->get_package_by_id($deposit->package_id);

    // $x = $this->ReferralModel->get_referrer($member->id);
    // print_r($x);
    // print_r($member);
    // -----------------------------------------------------------------------------------------------------------------------
    if ($member->referred_by != 'root') {
      $level_1 = $this->Members->get_member($member->referred_by);
      // print_r($level_1);
      $bonus_1 = $deposit->amount * 0.08;
      $bonus_1_data = array(
        'deposit_id' => $deposit->id,
        'referrer_id' => $level_1->id,
        'amount' => $bonus_1
      );
      $bonus1_id = $this->Referral_bonus_model->insert($bonus_1_data);

      // $fs_bonus1 = array(
      //   'member_id' => $level_1->id,
      //   'referral_bonus_id' => $bonus1_id,
      //   'amount' => $bonus_1 * 0.5
      // );

      // $lifestyle_bonus1 = array(
      //   'member_id' => $level_1->id,
      //   'referral_bonus_id' => $bonus1_id,
      //   'amount' => $bonus_1 * 0.01
      // );

      // $this->Fund_bonus_model->add($fs_bonus1);
      // $this->Lifestyle_bonus_model->add($lifestyle_bonus1);

      // -----------------------------------------------------------------------------------------------------------------------
      // if ($level_1->referred_by != 'root') {
      //   $level_2 = $this->Members->get_member($level_1->referred_by);
      //   // print_r($level_2);
      //   $bonus_2 = $deposit->amount * 0.01;
      //   $bonus_2_data = array(
      //     'deposit_id' => $deposit->id,
      //     'referrer_id' => $level_2->id,
      //     'amount' => $bonus_2
      //   );
      //   $bonus2_id = $this->Referral_bonus_model->insert($bonus_2_data);

      // $fs_bonus2 = array(
      //   'member_id' => $level_2->id,
      //   'referral_bonus_id' => $bonus2_id,
      //   'amount' => $bonus_2 * 0.5
      // );

      // $lifestyle_bonus2 = array(
      //   'member_id' => $level_2->id,
      //   'referral_bonus_id' => $bonus2_id,
      //   'amount' => $bonus_2 * 0.01
      // );

      // $this->Fund_bonus_model->add($fs_bonus2);
      // $this->Lifestyle_bonus_model->add($lifestyle_bonus2);

      // -----------------------------------------------------------------------------------------------------------------------
      // if ($level_2->referred_by != 'root') {
      //   $level_3 = $this->Members->get_member($level_2->referred_by);
      //   // print_r($level_3);
      //   $bonus_3 = $deposit->amount * 0.02;
      //   $bonus_3_data = array(
      //     'deposit_id' => $deposit->id,
      //     'referrer_id' => $level_3->id,
      //     'amount' => $bonus_3
      //   );
      // $bonus3_id = $this->Referral_bonus_model->insert($bonus_3_data);

      // $fs_bonus3 = array(
      //   'member_id' => $level_3->id,
      //   'referral_bonus_id' => $bonus3_id,
      //   'amount' => $bonus_3 * 0.5
      // );

      // $lifestyle_bonus3 = array(
      //   'member_id' => $level_3->id,
      //   'referral_bonus_id' => $bonus3_id,
      //   'amount' => $bonus_3 * 0.01
      // );

      // $this->Fund_bonus_model->add($fs_bonus3);
      // $this->Lifestyle_bonus_model->add($lifestyle_bonus3);

      // -----------------------------------------------------------------------------------------------------------------------
      // if ($level_3->referred_by != 'root') {
      //   $level_4 = $this->Members->get_member($level_3->referred_by);
      //   // print_r($level_3);
      //   $bonus_4 = $deposit->amount * 0.005;
      //   $bonus_4_data = array(
      //     'deposit_id' => $deposit->id,
      //     'referrer_id' => $level_4->id,
      //     'amount' => $bonus_4
      //   );
      // $bonus4_id = $this->Referral_bonus_model->insert($bonus_4_data);

      // $fs_bonus4 = array(
      //   'member_id' => $level_4->id,
      //   'referral_bonus_id' => $bonus4_id,
      //   'amount' => $bonus_4 * 0.5
      // );

      // $lifestyle_bonus4 = array(
      //   'member_id' => $level_4->id,
      //   'referral_bonus_id' => $bonus4_id,
      //   'amount' => $bonus_4 * 0.01
      // );

      // $this->Fund_bonus_model->add($fs_bonus4);
      // $this->Lifestyle_bonus_model->add($lifestyle_bonus4);

      // -----------------------------------------------------------------------------------------------------------------------
      // if ($level_4->referred_by != 'root') {
      //   $level_5 = $this->Members->get_member($level_4->referred_by);
      //   // print_r($level_3);
      //   $bonus_5 = $deposit->amount * 0.0025;
      //   $bonus_5_data = array(
      //     'deposit_id' => $deposit->id,
      //     'referrer_id' => $level_5->id,
      //     'amount' => $bonus_5
      //   );
      //   $bonus5_id = $this->Referral_bonus_model->insert($bonus_5_data);

      // $fs_bonus5 = array(
      //   'member_id' => $level_5->id,
      //   'referral_bonus_id' => $bonus5_id,
      //   'amount' => $bonus_5 * 0.5
      // );

      // $lifestyle_bonus5 = array(
      //   'member_id' => $level_5->id,
      //   'referral_bonus_id' => $bonus5_id,
      //   'amount' => $bonus_5 * 0.5
      // );

      // $this->Fund_bonus_model->add($fs_bonus5);
      // $this->Lifestyle_bonus_model->add($lifestyle_bonus5);
      // }
      //   }
      // }
      // }
    }

    $this->DepositModel->Approve_pending($deposit_id);

    $this->Daily_income_model->generate_daily_income($deposit, $package->duration_in_days, $package->daily_rate);

    $package = $this->PackageModel->get_package_by_id($deposit->package_id);
    $daily_income = $deposit->amount / $package->duration_in_days;
    $event_name = str_replace(' ', '', $member->username . "_" . $package->package_name . "_" . time());

    $daily_interest_event = "CREATE EVENT  " . $event_name . "
                              ON SCHEDULE 
                              EVERY 1 DAY
                              STARTS CURRENT_TIMESTAMP + INTERVAL 1 DAY 
                              ENDS CURRENT_TIMESTAMP + INTERVAL " . $package->duration_in_days . " DAY 
                              ON COMPLETION PRESERVE 
                              DO 
                              insert into td_daily_income 
                              VALUES (null, '" . $daily_income . "', CURRENT_TIMESTAMP, " . $deposit->member_id . ", " . $deposit_id . ")";

    // $this->Daily_income_model->create_event($daily_interest_event);


    redirect('deposits_admin', 'refresh');
  }


  public function delete_deposit($deposit_id)
  {

    $this->DepositModel->delete_deposit($deposit_id);

    redirect('deposits_admin', 'refresh');
  }
}