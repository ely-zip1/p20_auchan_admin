<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Marketing_plan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('DepositModel');
        $this->load->model('Members');
        $this->load->model('Deposit_Options');
        $this->load->model('PackageModel');
    }

    public function index()
    {
        $data['title'] = 'Compensation Plan';

        $this->load->view('pages/marketing_plan', $data);
    }
}