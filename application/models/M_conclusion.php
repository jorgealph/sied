<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_conclusion extends CI_Model{

    private $table = 'conclusion';
    private $table_id = 'iIdConclusion';

    public function __construct(){
        parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    public function obtener_apartados($key){
        $this->db->select('a.iIdApartado as id, a.vApartado as value');
        $this->db->from('apartado as a');
        $this->db->join('evaluacion as e', 'e.iIdPlantilla = a.iIdPlantilla', 'INNER');
        $this->db->where('e.iIdEvaluacion', $key);
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_preguntas($key){
        $this->db->select('iIdPregunta as id, vPregunta as value');
        $this->db->from('pregunta');
        $this->db->where('iIdApartado', $key);
        $query = $this->db->get();
        return $query->result();
    }    

    public function obtener_tipo(){
        $this->db->select('iIdTipoConclusion as id, vTipoConclusion as value');
        $this->db->from('tipoconclusion');        
        $query = $this->db->get();
        return $query->result();
    }

    public function displayJoin($key){
        $this->db->select('c.iIdConclusion, a.vApartado, p.vPregunta, c.vConclusion, c.vRecomendacion, t.vTipoConclusion, iASM');
        $this->db->from("$this->table as c");
        $this->db->join('pregunta as p', 'p.iIdPregunta = c.iIdPregunta', 'INNER');
        $this->db->join('apartado as a', 'a.iIdApartado = p.iIdApartado', 'INNER');
        $this->db->join('tipoconclusion as t', 't.iIdTipoConclusion = c.iTipoConclusion', 'INNER');
        $this->db->where('c.iIdEvaluacion', $key);
        $this->db->where('c.iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function select($key = null){
        $this->db->select('c.*, a.iIdApartado');
        $this->db->from("$this->table as c");
        $this->db->join('pregunta as p', 'p.iIdPregunta = c.iIdPregunta', 'INNER');
        $this->db->join('apartado as a', 'a.iIdApartado = p.iIdApartado', 'INNER');
        $this->db->join('tipoconclusion as t', 't.iIdTipoConclusion = c.iTipoConclusion', 'INNER');
        $this->db->where('c.iIdConclusion', $key);
        $this->db->where('c.iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function dataEntry($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function updateRecord($data, $key){
        $this->db->where($this->table_id, $key);
        return $this->db->update($this->table, $data);
    }
}