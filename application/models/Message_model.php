<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message_model extends CI_Model {

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
    $this->db->insert('td_messages',$data);

    return $this->db->insert_id();
  }

  public function get_per_member_id($member_id){
    $this->db->where('member_id', $member_id);
    $query = $this->db->get('td_messages');

    return $query->row();
  }

  public function get_all(){
    $query = $this->db->get('td_messages');

    return $query->result();
  }
}