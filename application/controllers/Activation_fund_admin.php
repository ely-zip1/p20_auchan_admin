<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activation_fund_admin extends CI_Controller
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
        $this->load->model('Activation_fund_model');
    }

    public function index()
    {
        $member_list = $this->Members->get_all_members();
        $data = array();

        if (isset($_POST['cancel'])) {
            $member_list = $this->Members->get_all_members();
        } else {
            if (isset($_POST['search-term'])) {
                if (strlen($_POST['search-term']) > 0) {
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


        // $total_members = $this->Members->count_members();
        // $total_pages = $total_members / 10;

        // if (($total_members % 10) > 0) {
        //     $total_pages += 1;
        // }

        // $data['total_pages'] = $total_pages;

        $data['title'] = 'Manage Users';

        $users_data = array();

        // print_r($member_list[1]->id);

        // print_r($this->db->last_query());
        // $total_activation_fund = $this->Activation_fund_model->total_fund_per_member($member_list[1]->id);


        foreach ($member_list as $member) {
            if ($member->account_type_id != '2') {
                continue;
            }

            // print_r($member);
            $total_activation_fund = $this->Activation_fund_model->total_fund_per_member($member->id);

            $temp = array();
            $temp['id'] = $member->id;
            $temp['full_name'] = $member->full_name;
            $temp['email'] = $member->email_address;
            $temp['total_fund'] = $total_activation_fund;

            array_push($users_data, $temp);
        }

        $data['users'] = $users_data;

        // print_r($users_data);



        $this->form_validation->set_rules('user_id', 'User ID', 'required');
        $this->form_validation->set_rules('new_amount', 'Amount', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/pages/activation_fund', $data);
            $this->load->view('admin/templates/footer');
        } else {

            $new = array(
                'member_id' => $_POST['user_id'],
                'amount' => $_POST['new_amount'],
                'date' => date('Y-m-d H:i:s')
            );

            $this->Activation_fund_model->add($new);

            redirect('activation_fund_admin');
            // $this->load->view('admin/templates/header', $data);
            // $this->load->view('admin/pages/activation_fund', $data);
            // $this->load->view('admin/templates/footer');
        }
    }

    public function search($search_term)
    {
        // if(isset($_POST['search_term'])){
        //   if(strlen($_POST['search_term']) > 0){
        //     $member_list = $this->Members->search_members($_POST['search_term'], $_POST['filter']);
        //   }
        // }
        $member_list = $this->Members->search_members($search_term, "username");

        // print_r($member_list);
    }
}