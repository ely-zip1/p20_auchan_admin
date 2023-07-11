<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Franchise_app_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  public function add($data){
    $this->db->insert('td_franchise_applications',$data);
  }
}