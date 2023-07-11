<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Manage_users extends CI_Controller
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
    $this->load->model('ReferralModel');
    $this->load->model('Referral_codes');
  }

  public function index()
  {
    $member_list = $this->Members->get_all_members();

    if(isset($_POST['cancel'])){
      $member_list = $this->Members->get_all_members();
    }else{
      if(isset($_POST['search-term'])){
        if(strlen($_POST['search-term']) > 0){
          $member_list = $this->Members->search_members($_POST['search-term']);
        }
      }
    }

    //   else {
    //     $member_list = $this->Members->get_members();
    //     // code...
    //   }
    // }else {
    //   $member_list = $this->Members->get_members();
    //   // code...
    // }


    $total_members = $this->Members->count_members();
    $total_pages = $total_members /10;

    if(($total_members % 10) > 0){
      $total_pages += 1;
    }

    $data['total_pages'] = $total_pages;
    $data['title'] = 'Manage Users';

    $users_data = array();

    // print_r($member_list);

    foreach($member_list as $member){
      if($member->account_type_id != '2'){
        continue;
      }

      $deposit_data = $this->DepositModel->get_deposit_per_member($member->id);
      $referred_by = $this->Members->get_referrer($member->id);
      $referrer = $this->Members->get_member_by_id($referred_by->id);
      $referral_code = $member->username;

      $total_deposit = 0;
      foreach($deposit_data as $deposit){
        $total_deposit += $deposit->amount;
      }

      // print_r($referrer);

      $temp['id'] = $member->id;
      $temp['full_name'] = $member->full_name;
      $temp['email'] = $member->email_address;
      $temp['date_joined'] = $member->date;
      $temp['total_deposit'] = $total_deposit;
      $temp['referred_by'] = $referrer->full_name;
      $temp['referral_code'] = $referral_code;

      array_push($users_data, $temp);
    }

    $data['users'] = $users_data;


    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/manage_users', $data);
    $this->load->view('admin/templates/footer');

  }

  public function search($search_term){
    // if(isset($_POST['search_term'])){
    //   if(strlen($_POST['search_term']) > 0){
    //     $member_list = $this->Members->search_members($_POST['search_term'], $_POST['filter']);
    //   }
    // }
    $member_list = $this->Members->search_members($search_term, "username");

    print_r($member_list);
  }

}