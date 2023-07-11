<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bank_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    //
  }

  // ------------------------------------------------------------------------

  public function add($data){
    $this->db->insert('td_banks',$data);
  }

  public function update($data){
    $this->db->set('bank_name', $data['bank_name']);
    $this->db->set('account_name', $data['account_name']);
    $this->db->set('account_number', $data['account_number']);
    $this->db->set('country', $data['country']);
    $this->db->set('swift_code', $data['swift_code']);
    $this->db->set('bank_code', $data['bank_code']);
    $this->db->where('member_id', $data['member_id']);
    $this->db->update('td_banks');
  }

  public function get_per_member_id($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_banks');

    return $query->row();
  }

  public function has_account($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_banks', 1);

    if($query->row() != null){
      return true;
    }else{
      return false;
    }
  }
}

/* End of file Bank_model.php */
/* Location: ./application/models/Bank_model.php */