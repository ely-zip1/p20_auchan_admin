<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class GroupSalesModel extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();

    date_default_timezone_set('Asia/Manila');
  }
  
  public function index()
  {
    // 
  }

  public function add($bonus_data){
    $this->db->insert('td_group_sales',$bonus_data);
  }

  public function update($bonus_update){
    $this->db->set('bonus',$bonus_update['bonus']);
    $this->db->where('member_id',$bonus_update['member_id']);
    $this->db->where('month',$bonus_update['month']);
    $this->db->update('td_group_sales');
  }

  public function get_bonus_by_user_by_month($user_id, $month){
    $this->db->where('member_id',$user_id);
    $this->db->where('month',$month);
    $query = $this->db->get('td_group_sales');

    return $query->row();
  }

  public function get_all_per_member($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_group_sales');

    return $query->result();
  }

  public function get_total_per_member($member_id){
    $this->db->select_sum('bonus');
    $this->db->where('member_id',$member_id);
    $query = $this->db->get('td_group_sales');

    return $query->row();
  }

}