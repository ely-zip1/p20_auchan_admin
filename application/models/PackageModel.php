<?php

    class PackageModel extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get_packages(){
            $query = $this->db->get('td_packages');

            return $query->result();
        }

        public function get_package_by_id($id){
            $this->db->where('id',$id);
            $query = $this->db->get('td_packages',1);

            return $query->row();
        }
    }


?>