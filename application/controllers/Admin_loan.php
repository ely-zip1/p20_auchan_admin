<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_loan extends CI_Controller
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
    $this->load->model('Advanced_withdrawals_model');
    $this->load->model('Account_model');
  }

  public function index()
  {
    $data = array(
      'title' => "Advanced Withdrawal"
    );

    $member_list = $this->Members->get_all_members();

    if (isset($_POST['cancel'])) {
      $member_list = $this->Members->get_all_members();
    } else {
      if (isset($_POST['search-term'])) {
        if (strlen($_POST['search-term']) > 0) {
          $member_list = $this->Members->search_members($_POST['search-term']);
        }
      }
    }

    $aw_requests = array();

    $requests = $this->Advanced_withdrawals_model->get_all_pending();
    foreach ($requests as $request) {
      $member = $this->Members->get_member_by_id($request->member_id);
      $deposit = $this->DepositModel->get_by_id($request->deposit_id);

      $temp = array(
        'request_id' => $request->id,
        'name' => $member->full_name,
        'member_id' => $member->id,
        'email' => $member->email_address,
        'deposit' => $deposit->amount,
        'amount_applied' => $request->amount,
        'e_money' => $this->Account_model->get_account_balance($member->id),
        'date' => $request->date
      );

      array_push($aw_requests, $temp);
    }

    $data['aw_requests'] = $aw_requests;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/admin_loan', $data);
    $this->load->view('admin/templates/footer');
  }

  public function search($search_term)
  {
    // if(isset($_POST['search_term'])){
    //   if(strlen($_POST['search_term']) > 0){
    //     $member_list = $this->Members->search_members($_POST['search_term'], $_POST['filter']);
    //   }
    // }
    $member_list = $this->Members->search_members($search_term, "username");

    print_r($member_list);
  }

  public function approve($id)
  {
    $this->Advanced_withdrawals_model->approve_request($id);
    redirect('admin_loan');
  }

  public function delete($id)
  {
    $this->Advanced_withdrawals_model->delete_request($id);
    redirect('admin_loan');
  }
}