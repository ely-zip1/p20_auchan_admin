<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact_us extends CI_Controller
{
	public function __construct()
        {
            parent::__construct();
            $this->load->model('Members');
            $this->load->model('Account_model');
            $this->load->model('Message_model');
        }

	public function index()
	{
        $data = array(
            'title' => 'Contact Us'
        );

        $data['username'] = $this->session->userdata('username');
        $data['fullname'] = $this->session->userdata('fullname');
        
        $account_balance = $this->Account_model->get_account_balance($this->session->user_id);
        
        $data['account_balance'] = number_format($account_balance, 2, '.', ',');

        $this->load->view('pages/contact_us', $data);

    }

    public function new_message(){

        if(strlen($_POST['message_text']) > 0){

            $message = $_POST['message_text'];

            $new_message['member_id'] = $this->session->userdata('user_id');
            $new_message['message'] = $message;
            $new_message['date'] =  date('Y-m-d H:i:s');

            if($this->Message_model->add($new_message) > 0){
                $this->session->set_flashdata("message_status","sent");
                redirect('contact_us');
            }else{
                redirect('contact_us');
            }
        }else{
            redirect('contact_us');

        }

    }


}