<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Remittance_admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Remittance_model');
        $this->load->model('Spar_fund_model');
        $this->load->model('Members');
    }

    public function index()
    {
        $data = array(
            'title' => 'Remittance Requests'
        );

        $remittance_requests = $this->Remittance_model->get_incomplete();

        $request_data = array();

        if($remittance_requests != null)
            foreach($remittance_requests as $request){

                $member = $this->Members->get_member_by_id($request->member_id);
                $temp = array(
                    'member' => $member->full_name,
                    'mode'=> $request->transaction_type,
                    'amount' => $request->amount,
                    'rate' => $request->conversion_rate,
                    'recipient' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
                    'bank_name' => $request->bank_name,
                    'bank_code' => $request->bank_account_number,
                    'phone' => $request->phone_number,
                    'country' => $request->country,
                    'address' => $request->address,
                    'date' => $request->date,
                    'ref_code' => $request->reference
                );

                array_push($request_data, $temp);
            }

        $data['request_data'] = $request_data;

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/pages/remittance_admin', $data);
        $this->load->view('admin/templates/footer');
    }

    public function complete(){
        $reference = $_POST['ref_code'];

        $this->Remittance_model->mark_complete($reference);

        redirect('remittance_admin', 'refresh');
    }
}