<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Gcash_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  // ------------------------------------------------------------------------

  public function add($data){
    $this->db->insert('td_gcash',$data);
  }

  public function update($data){
    $this->db->set('phone_number', $data['phone_number']);
    $this->db->where('member_id', $data['member_id']);
    $this->db->update('td_gcash');
  }

  public function get_per_member_id($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_gcash', 1);

    return $query->row();
  }

  public function has_account($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_gcash', 1);

    if($query->row() != null){
      return true;
    }else{
      return false;
    }
  }
}