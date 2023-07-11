<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Forex_model extends CI_Model {

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
    $this->db->insert('td_forex_rate',$data);
  }
  
  public function get_latest(){
    $this->db->from('td_forex_rate');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);

    $query = $this->db->get();

    return $query->row();
  }
}