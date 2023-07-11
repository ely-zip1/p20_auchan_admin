<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activation_fund_model extends CI_Model
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
        $this->db->insert('td_activation_funds', $data);
    }


    public function update($data)
    {
        $this->db->set('member_id', $data['member_id']);
        $this->db->set('amount', $data['af_amount']);
        $this->db->set('date', $data['af_date']);
        $this->db->update('td_activation_funds');
    }


    public function get_per_member_id($member_id)
    {
        $this->db->where('member_id', $member_id);
        $query = $this->db->get('td_activation_funds');

        return $query->result();
    }


    public function get_all()
    {
        return $this->db->get('td_activation_funds')->result();
    }


    public function total_fund_per_member($member_id)
    {
        $this->db->where('member_id', $member_id);
        $query = $this->db->get('td_activation_funds');

        // print_r($query->result());


        $total_activation_fund = 0;
        foreach ($query->result() as $fund) {
            $total_activation_fund += $fund->amount;
        }
        // print_r($total_activation_fund);
        // print_r($this->db->last_query());
        // echo '<br>';

        return $total_activation_fund;
    }

    public function get_sent_funds($member_id)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('status', 'sent');
        $query = $this->db->get('td_activation_funds');

        return $query->result();
    }

    public function get_received_funds($member_id)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('status', 'received');
        $query = $this->db->get('td_activation_funds');

        return $query->result();
    }

    public function get_all_sent_funds()
    {
        $this->db->where('status', 'sent');
        $query = $this->db->get('td_activation_funds');

        return $query->result();
    }

    public function get_receiver($member_id, $amount, $datetime, $sender_id)
    {
        $this->db->where('member_id', $member_id);
        $this->db->where('amount', $amount);
        $this->db->where('date', $datetime);
        $this->db->where('peer_id', $sender_id);
        $this->db->where('status', 'received');
        $query = $this->db->get('td_activation_funds');

        return $query->result();
    }
}