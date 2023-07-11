<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Your_referrals extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('ReferralModel');
    $this->load->model('Referral_bonus_model');
    $this->load->model('Account_model');
  }

  public function index()
  {
    $data['title'] = 'Referrals';

    $data['username'] = $this->session->userdata('username');
    $data['email'] = $this->session->userdata('email');
    $data['fullname'] = $this->session->userdata('fullname');
    $data['date_registered'] = $this->session->userdata('date_registered');
    
		$account_balance = $this->Account_model->get_account_balance($this->session->user_id);

		$data['account_balance'] = number_format($account_balance, 2, '.', ',');

    $member = $this->Members->get_member($this->session->username);
    $level_1_list = $this->Members->get_referees($member->username);
    // print_r($level_1_list);
    $referral_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);

    $total_downline = 0;
    $total_active = 0;

    $referral_list = array();
    $inactive_referral_list = array();

    foreach ($level_1_list as $level_1) {
      $total_downline++;
      if ($this->Members->get_member_by_id($level_1->id) != null) {

        $referral1 = array();

        $level_1_data = $this->Members->get_member_by_id($level_1->id);

        if ($this->DepositModel->has_active_deposit($level_1->id)) {
          $total_active++;

          $total_deposit_1 = $this->DepositModel->get_total_approved_deposit($level_1->id);

          $referral1['username'] = $level_1_data->username;
          $referral1['email'] = $level_1_data->email_address;
          $referral1['total_deposit'] = '$ ' . number_format($total_deposit_1->amount, '2', '.', ',');
          $referral1['level'] = 'Level 1';

          array_push($referral_list, $referral1);
        } else {
          $referral1['username'] = $level_1_data->username;
          $referral1['email'] = $level_1_data->email_address;
          $referral1['level'] = 'Level 1';

          array_push($inactive_referral_list, $referral1);
        }
      }

      if ($this->Members->count_referrals($level_1->username) > 0) {
        $level_2_list = $this->Members->get_referees($level_1->username);
        // print_r($level_2_list);

        foreach ($level_2_list as $level_2) {
          $total_downline++;

          if ($this->Members->get_member_by_id($level_2->id) != null) {

            $referral2 = array();

            $level_2_data = $this->Members->get_member_by_id($level_2->id);

            if ($this->DepositModel->has_active_deposit($level_2->id)) {
              $total_active++;

              $total_deposit_2 = $this->DepositModel->get_total_approved_deposit($level_2->id);

              $referral2['username'] = $level_2_data->username;
              $referral2['email'] = $level_2_data->email_address;
              $referral2['total_deposit'] = '$ ' . number_format($total_deposit_2->amount, '2', '.', ',');
              $referral2['level'] = 'Level 2';

              array_push($referral_list, $referral2);
            } else {
              $referral2['username'] = $level_2_data->username;
              $referral2['email'] = $level_2_data->email_address;
              $referral2['level'] = 'Level 2';

              array_push($inactive_referral_list, $referral2);
            }
          }

          if ($this->Members->count_referrals($level_2->username) > 0) {
            $level_3_list = $this->Members->get_referees($level_2->username);
            // print_r($level_3_list);

            foreach ($level_3_list as $level_3) {
              $total_downline++;

              if ($this->Members->get_member_by_id($level_3->id) != null) {

                $referral3 = array();

                $level_3_data = $this->Members->get_member_by_id($level_3->id);



                if ($this->DepositModel->has_active_deposit($level_3->id)) {
                  $total_active++;

                  $total_deposit_3 = $this->DepositModel->get_total_approved_deposit($level_3->id);

                  $referral3['username'] = $level_3_data->username;
                  $referral3['email'] = $level_3_data->email_address;
                  $referral3['total_deposit'] = '$ ' . number_format($total_deposit_3->amount, '2', '.', ',');
                  $referral3['level'] = 'Level 3';

                  array_push($referral_list, $referral3);
                } else {
                  $referral3['username'] = $level_3_data->username;
                  $referral3['email'] = $level_3_data->email_address;
                  $referral3['level'] = 'Level 3';

                  array_push($inactive_referral_list, $referral3);
                }
              }


              if ($this->Members->count_referrals($level_3->username) > 0) {
                $level_4_list = $this->Members->get_referees($level_3->username);
                // print_r($level_3_list);

                foreach ($level_4_list as $level_4) {
                  $total_downline++;

                  if ($this->Members->get_member_by_id($level_4->id) != null) {

                    $referral4 = array();

                    $level_4_data = $this->Members->get_member_by_id($level_4->id);



                    if ($this->DepositModel->has_active_deposit($level_4->id)) {
                      $total_active++;

                      $total_deposit_4 = $this->DepositModel->get_total_approved_deposit($level_4->id);

                      $referral4['username'] = $level_4_data->username;
                      $referral4['email'] = $level_4_data->email_address;
                      $referral4['total_deposit'] = '$ ' . number_format($total_deposit_4->amount, '2', '.', ',');
                      $referral4['level'] = 'Level 4';

                      array_push($referral_list, $referral4);
                    } else {
                      $referral4['username'] = $level_4_data->username;
                      $referral4['email'] = $level_4_data->email_address;
                      $referral4['level'] = 'Level 4';

                      array_push($inactive_referral_list, $referral4);
                    }
                  }


                  if ($this->Members->count_referrals($level_4->username) > 0) {
                    $level_5_list = $this->Members->get_referees($level_4->username);
                    // print_r($level_3_list);

                    foreach ($level_5_list as $level_5) {
                      $total_downline++;

                      if ($this->Members->get_member_by_id($level_5->id) != null) {

                        $referral5 = array();

                        $level_5_data = $this->Members->get_member_by_id($level_5->id);



                        if ($this->DepositModel->has_active_deposit($level_5->id)) {
                          $total_active++;

                          $total_deposit_5 = $this->DepositModel->get_total_approved_deposit($level_5->id);

                          $referral5['username'] = $level_5_data->username;
                          $referral5['email'] = $level_5_data->email_address;
                          $referral5['total_deposit'] = '$ ' . number_format($total_deposit_5->amount, '2', '.', ',');
                          $referral5['level'] = 'Level 5';

                          array_push($referral_list, $referral5);
                        } else {
                          $referral5['username'] = $level_5_data->username;
                          $referral5['email'] = $level_5_data->email_address;
                          $referral5['level'] = 'Level 5';

                          array_push($inactive_referral_list, $referral5);
                        }
                      }

                      if ($this->Members->count_referrals($level_5->username) > 0) {
                        $level_6_list = $this->Members->get_referees($level_5->username);
                        // print_r($level_3_list);

                        foreach ($level_6_list as $level_6) {
                          $total_downline++;

                          if ($this->Members->get_member_by_id($level_6->id) != null) {

                            $referral6 = array();

                            $level_6_data = $this->Members->get_member_by_id($level_6->id);



                            if ($this->DepositModel->has_active_deposit($level_6->id)) {
                              $total_active++;

                              $total_deposit_6 = $this->DepositModel->get_total_approved_deposit($level_6->id);

                              $referral6['username'] = $level_6_data->username;
                              $referral6['email'] = $level_6_data->email_address;
                              $referral6['total_deposit'] = '$ ' . number_format($total_deposit_6->amount, '2', '.', ',');
                              $referral6['level'] = 'Level 6';

                              array_push($referral_list, $referral6);
                            } else {
                              $referral6['username'] = $level_6_data->username;
                              $referral6['email'] = $level_6_data->email_address;
                              $referral6['level'] = 'Level 6';

                              array_push($inactive_referral_list, $referral6);
                            }
                          }

                          if ($this->Members->count_referrals($level_6->username) > 0) {
                            $level_7_list = $this->Members->get_referees($level_6->username);
                            // print_r($level_3_list);

                            foreach ($level_7_list as $level_7) {
                              $total_downline++;

                              if ($this->Members->get_member_by_id($level_7->id) != null) {

                                $referral7 = array();

                                $level_7_data = $this->Members->get_member_by_id($level_7->id);



                                if ($this->DepositModel->has_active_deposit($level_7->id)) {
                                  $total_active++;

                                  $total_deposit_7 = $this->DepositModel->get_total_approved_deposit($level_7->id);

                                  $referral7['username'] = $level_7_data->username;
                                  $referral7['email'] = $level_7_data->email_address;
                                  $referral7['total_deposit'] = '$ ' . number_format($total_deposit_7->amount, '2', '.', ',');
                                  $referral7['level'] = 'Level 7';

                                  array_push($referral_list, $referral7);
                                } else {
                                  $referral7['username'] = $level_7_data->username;
                                  $referral7['email'] = $level_7_data->email_address;
                                  $referral7['level'] = 'Level 7';

                                  array_push($inactive_referral_list, $referral7);
                                }
                              }

                              if ($this->Members->count_referrals($level_7->username) > 0) {
                                $level_8_list = $this->Members->get_referees($level_7->username);
                                // print_r($level_3_list);

                                foreach ($level_8_list as $level_8) {
                                  $total_downline++;

                                  if ($this->Members->get_member_by_id($level_8->id) != null) {

                                    $referral8 = array();

                                    $level_8_data = $this->Members->get_member_by_id($level_8->id);



                                    if ($this->DepositModel->has_active_deposit($level_8->id)) {
                                      $total_active++;

                                      $total_deposit_8 = $this->DepositModel->get_total_approved_deposit($level_8->id);

                                      $referral8['username'] = $level_8_data->username;
                                      $referral8['email'] = $level_8_data->email_address;
                                      $referral8['total_deposit'] = '$ ' . number_format($total_deposit_8->amount, '2', '.', ',');
                                      $referral8['level'] = 'Level 8';

                                      array_push($referral_list, $referral8);
                                    } else {
                                      $referral8['username'] = $level_8_data->username;
                                      $referral8['email'] = $level_8_data->email_address;
                                      $referral8['level'] = 'Level 8';

                                      array_push($inactive_referral_list, $referral8);
                                    }
                                  }

                                  if ($this->Members->count_referrals($level_8->username) > 0) {
                                    $level_9_list = $this->Members->get_referees($level_8->username);
                                    // print_r($level_3_list);

                                    foreach ($level_9_list as $level_9) {
                                      $total_downline++;

                                      if ($this->Members->get_member_by_id($level_9->id) != null) {

                                        $referral9 = array();

                                        $level_9_data = $this->Members->get_member_by_id($level_9->id);



                                        if ($this->DepositModel->has_active_deposit($level_9->id)) {
                                          $total_active++;

                                          $total_deposit_9 = $this->DepositModel->get_total_approved_deposit($level_9->id);

                                          $referral9['username'] = $level_9_data->username;
                                          $referral9['email'] = $level_9_data->email_address;
                                          $referral9['total_deposit'] = '$ ' . number_format($total_deposit_9->amount, '2', '.', ',');
                                          $referral9['level'] = 'Level 9';

                                          array_push($referral_list, $referral9);
                                        } else {
                                          $referral9['username'] = $level_9_data->username;
                                          $referral9['email'] = $level_9_data->email_address;
                                          $referral9['level'] = 'Level 9';

                                          array_push($inactive_referral_list, $referral9);
                                        }
                                      }

                                      if ($this->Members->count_referrals($level_9->username) > 0) {
                                        $level_10_list = $this->Members->get_referees($level_9->username);
                                        // print_r($level_3_list);

                                        foreach ($level_10_list as $level_10) {
                                          $total_downline++;

                                          if ($this->Members->get_member_by_id($level_10->id) != null) {

                                            $referral10 = array();

                                            $level_10_data = $this->Members->get_member_by_id($level_10->id);



                                            if ($this->DepositModel->has_active_deposit($level_10->id)) {
                                              $total_active++;

                                              $total_deposit_10 = $this->DepositModel->get_total_approved_deposit($level_10->id);

                                              $referral10['username'] = $level_10_data->username;
                                              $referral10['email'] = $level_10_data->email_address;
                                              $referral10['total_deposit'] = '$ ' . number_format($total_deposit_10->amount, '2', '.', ',');
                                              $referral10['level'] = 'Level 10';

                                              array_push($referral_list, $referral10);
                                            } else {
                                              $referral10['username'] = $level_10_data->username;
                                              $referral10['email'] = $level_10_data->email_address;
                                              $referral10['level'] = 'Level 10';

                                              array_push($inactive_referral_list, $referral10);
                                            }
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    

    $data['referral_list'] = $referral_list;

    $data['inactive_referral_list'] = $inactive_referral_list;

    // print_r($referral_list);
    // print_r($inactive_referral_list);

    $data['total_bonus'] = '$' . number_format($referral_bonus, '2', '.', ',');
    $data['total_referrals'] = $total_downline;
    $data['active_referrals'] = $total_active;

    // $this->load->view('templates/header', $data);
    $this->load->view('pages/your_referrals', $data);
    // $this->load->view('templates/footer');
  }

  public function list_referrals($member_id, $level)
  {
    $referees = $this->ReferralModel->get_referees($member_id);

    $list = array();

    foreach ($referees as $referee) {
      $referral = array();

      $referee_data = $this->Members->get_member_by_id($referee->id);
      $total_deposit = $this->DepositModel->get_total_approved_deposit($referee->id);

      $referral['username'] = $referee_data->username;
      $referral['email'] = $referee_data->email_address;
      $referral['total_deposit'] = $total_deposit->amount;
      $referral['level'] = $level;

      array_push($list, $referral);
    }

    return $list;
  }
}