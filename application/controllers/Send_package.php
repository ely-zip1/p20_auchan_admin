<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Send_package extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DepositModel');
        $this->load->model('Members');
        $this->load->model('WithdrawalModel');
        $this->load->model('Referral_bonus_model');
        $this->load->model('ReferralModel');
        $this->load->model('Referral_codes');
        $this->load->model('Indirect_bonus_model');
        $this->load->model('Fund_transfer_model');
        $this->load->model('Daily_income_model');
    }

    public function index($member_id = null)
    {
        $data = array(
            'title' => 'Send a Package'
        );

        $member_list = $this->Members->get_members(100, 0);
        $data['members_list'] = $member_list;

        if (!empty($member_id)) {


            echo '<pre>';
            var_dump($this->input->post());
            echo '</pre>';
            // exit;

            $this->form_validation->set_rules('amount' . $member_id, 'Amount', 'required|callback_check_amount[amount' . $member_id . ']');

            if ($this->form_validation->run() == false) {

                $this->session->set_flashdata('send_error', 'Invalid amount.');

                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/pages/send_package', $data);
                $this->load->view('admin/templates/footer');
            } else {
                echo "success";
            }
        } else {

            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/pages/send_package', $data);
            $this->load->view('admin/templates/footer');
        }


    }

    public function check_amount($member_id)
    {

        echo '<pre>';
        var_dump($member_id);
        echo '</pre>';

        if ($this->input->post('package') == 1) {
            if ($this->input->post('amount') >= 250 && $this->input->post('amount') < 2500) {
                // print_r("package 1 success");
                return true;
            } else {

                // print_r("package 1 fail");
                $this->form_validation->set_message('check_amount', 'Invalid amount.');
                return false;
            }
        } else if ($this->input->post('package') == 2) {
            if ($this->input->post('amount') >= 2500 && $this->input->post('amount') < 20000) {

                // print_r("package 2 success");
                return true;
            } else {
                $this->form_validation->set_message('check_amount', 'Invalid amount.');
                // print_r("package 2 fail");
                return false;
            }
        } else if ($this->input->post('package') == 3) {
            if ($this->input->post('amount') >= 20000 && $this->input->post('amount') < 9999999.99) {

                // print_r("package 3 success");
                return true;
            } else {
                $this->form_validation->set_message('check_amount', 'Invalid amount.');

                // print_r("package 3 fail");
                return false;
            }
        }
    }

}