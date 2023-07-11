<?php

    class Deposit_Options extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get_all(){
          $this->db->order_by('id', 'asc');
          $query = $this->db->get('td_deposit_options');

          return $query->result();
        }

        public function get_by_id($id){
            $this->db->where('id',$id);
            $query = $this->db->get('td_deposit_options',1);

            return $query->row();

        }
    }


?>
