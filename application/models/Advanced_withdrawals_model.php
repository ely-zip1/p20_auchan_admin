<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Advanced_withdrawals_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    //
  }

  public function add($data)
  {
    if (!$this->has_withdrawal($data['member_id'], $data['deposit_id'])) {
      return $this->db->insert('td_advanced_withdrawals', $data);
    }
  }


  public function update($data)
  {
    $this->db->set('member_id', $data['member_id']);
    $this->db->set('amount', $data['aw_amount']);
    $this->db->set('date', $data['aw_date']);
    $this->db->set('capital', $data['aw_capital']);
    $this->db->set('status', $data['aw_status']);
    $this->db->where('id', $data['aw_id']);
    $this->db->update('td_advanced_withdrawals');
  }


  public function approve_request($request_id)
  {
    $this->db->set('status', '1');
    $this->db->set('date_approved', date('Y-m-d H:i:s'));
    $this->db->where('id', $request_id);
    $this->db->update('td_advanced_withdrawals');
  }


  public function delete_request($request_id)
  {
    $this->db->where('id', $request_id);
    $this->db->delete('td_advanced_withdrawals');
  }


  public function get_per_member_id($member_id)
  {
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_advanced_withdrawals');

    return $query->result();
  }


  public function get_all()
  {
    return $this->db->get('td_advanced_withdrawals')->result();
  }


  public function get_all_pending()
  {
    $this->db->where('status', '0');
    return $this->db->get('td_advanced_withdrawals')->result();
  }


  public function has_withdrawal($member_id, $deposit_id)
  {
    $this->db->where('member_id', $member_id);
    $this->db->where('deposit_id', $deposit_id);
    $query = $this->db->get('td_advanced_withdrawals');

    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }


  public function total_withdrawal($member_id)
  {
    $this->db->select_sum('amount', 'total_withdrawal');
    $this->db->where('member_id', $member_id);
    $this->db->where('status', '1');
    $query = $this->db->get('td_advanced_withdrawals');

    return $query->row();
  }
}