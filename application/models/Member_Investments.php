<?php

    class Member_Investments extends CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function has_investment($member_id){
            $this->db->where('member_id',$member_id);
            $query = $this->db->get('td_member_investments',1);

            $mi = $query->row();
            if(isset($mi->member_id) == false){
                return false;
            }else{
                return true;
            }
        }

        public function get_investments($member_id){
            $this->db->where('member_id',$member_id);
            $query = $this->db->get('td_member_investments');

            return $query->result();

        }
    }


?>