<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Intervencion extends CI_Model{
    private $table = 'intervencion';
    private $table_id = 'iIdIntervencion';

    public function __construct(){
        parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    public function findAll(){
        $this->db->select('*');
        $this->db->from("$this->table");
        $query = $this->db->get();
        return $query->result();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}