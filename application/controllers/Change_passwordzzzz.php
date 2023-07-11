<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_passwordzzzz extends CI_Controller {
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

        public function index(){
            
            // $deposit_date = new DateTime('2023-06-08 02:17:57');
            // $current_date = new DateTime('2023-06-23 19:43:32');
            // while($deposit_date <= $current_date){
            //     $deposit_date->modify('+1 day');
            //     // print_r($deposit_date);
            //     $temp = array(
            //         'amount' => '4.5',
            //         'date_added' => $deposit_date->format('Y-m-d H:i:s'),
            //         'member_id' => '180',
            //         'deposit_id' => '508'
            //     );

            //     $this->Daily_income_model->add($temp);
            // }

            $this->form_validation->set_rules('cpass_username', 'Username', 'required');
            $this->form_validation->set_rules('cpass_password', 'Password', 'required|min_length[6]');
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/pages/changepass');
			}
			else {
                $user = $this->Members->get_member($_POST['cpass_username']);
                
                if( $user != null){
                    
                    echo '<pre>';
					print_r($user);
                    echo '</pre>';
                    
                    $this->Members->update_password($user->email_address, $_POST['cpass_password']);
                    
                    $this->session->set_flashdata('success','ok');
                    redirect('change_password');
                }else{
                    $this->session->set_flashdata('success','fail');
                    redirect('change_password');
                }

                // $data['success'] = 'ok';
                // $this->load->view('admin/pages/changepass', $data);
                
            }

        }

    }