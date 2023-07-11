<?php

    class Referral_codes extends CI_Model{

        public $id;
        public $code;
        public $is_taken;

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get_all(){
          $query = $this->db->get('td_referral_codes');

          return $query->result();
        }

        public function set_referral_link($referral_link, $id){
          $this->db->set('referral_link', $referral_link);
          $this->db->where('id', $id);
          $this->db->update('td_referral_codes');
        }

        public function get_new_code(){

            $this->db->where('is_taken','0');
            $query = $this->db->get('td_referral_codes',1);

            foreach ($query->result() as $row)
            {
                return $row;
                break;
            }
        }

        public function take_code($ref_data){

            $this->db->where('id', $ref_data->id);
            $this->db->update('td_referral_codes', $ref_data);
        }

        public function is_valid_code($code){
            $tempCode = $code;
            $this->db->where('code',$tempCode);
            $query = $this->db->get('td_referral_codes',1);

            foreach ($query->result() as $row)
            {
                if(isset($row->code)){
                    return true;
                }else{
                    return false;
                }

                break;
            }

        }

        public function get_root_code(){
            $referral_id = '';
            $query = $this->db->query("select * from td_members where account_type_id = '3' limit 1");
            foreach($query->result() as $row){
                $referral_id =  $row->referral_code_id;
                break;
            }

            $this->db->where('id',$referral_id);
            $query = $this->db->get('td_referral_codes');
            foreach($query->result() as $row){
                return  $row->code;
                break;
            }
        }

        public function get_members_code($id){

            $this->db->where('id',$id);
            $query = $this->db->get('td_referral_codes',1);

            return $query->row();
        }

        public function get_by_code($referral_code){
            $this->db->where('code', $referral_code);
            $query = $this->db->get('td_referral_codes');

            return $query->row();
        }

        public function add_code($code){
            $data = array(
                'code' => $code,
                'is_taken' => '0'
            );

            $this->db->insert('td_referral_codes',$data);
        }

        public function verify_member_code($code){
          $this->db->where('code', $code);
          $this->db->where('is_taken', 1);
          $query = $this->db->get('td_referral_codes');

          if(isset($query->row()->code)){
            if(strlen($query->row()->code) > 0){
              return true;
            }else {
              return false;
            }
          }else {
            return false;
          }
        }
    }


?>
