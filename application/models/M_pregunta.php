<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_pregunta extends CI_Model{
    private $table = 'pregunta';
    private $table_id = 'iIdPregunta';

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

    public function findApartado($apartado){
        $this->db->select('vApartado');        
        $this->db->from('apartado');
        $this->db->where('iIdApartado', $apartado);
        $query = $this->db->get();
        return $query->result()[0];
    }

    public function findPregunta($apartado){
        $this->db->select('vPregunta');
        $this->db->from("$this->table");
        $this->db->where("iIdApartado", $apartado);
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function save($data){
        $db_debug = $this->db->db_debug; //save setting

        $this->db->db_debug = FALSE;
        $this->db->insert($this->table, $data);
        
        //return $this->db->insert_id();
        return $this->db->affected_rows();
    }
}