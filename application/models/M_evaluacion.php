<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_evaluacion extends CI_Model{
    private $table = 'evaluacion';
    private $table_id = 'iIdEvaluacion';

    public function __construct(){
        parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    public function displaydata(){
        $this->db->select();
        $this->db->from("$this->table");
        //$this->db->where();
        $query = $this->db->get();
        return $query->result();
    }

    public function displayjoin(){
        $this->db->select('e.iIdEvaluacion, i.vIntervencion, i.iTipo, i.vIntervencion, p.iOrigenEvaluacion, tp.vTipoEvaluacion, o.vOrganismo');
        $this->db->from("$this->table as e");
        $this->db->join('intervencion as i', 'e.iIdIntervencion = i.iIdIntervencion', 'INNER');
        $this->db->join('plantilla as p', 'p.iIdPlantilla = e.iIdPlantilla', 'INNER');
        $this->db->join('tipoevaluacion as tp', 'p.iIdTipoEvaluacion = tp.iIdTipoEvaluacion', 'INNER');
        $this->db->join('organismo as o', 'i.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $query = $this->db->get();
        return $query->result();
    }

    public function getUsuario($key = null){
        $this->db->select('iIdUsuario, vNombres, vApellidoPaterno, vApellidoMaterno, vCargo');
        $this->db->from('usuario');
        $this->db->where('iActivo', 1);
        if ($key != null && !empty($key)){
            $this->db->where('iIdUsuario', $key);
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function getCargo($key){
        $this->db->select('vCargo');
        $this->db->from('usuario');
        $this->db->where('iIdUsuario', $key);
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }
    public function findEvaluacion($key){
        $this->db->select('vNombreEvaluacion, dFechaInicio, dFechaFin, vObjetivo, vObjetivoEspecifico, iEnvioOficio, dFechaRecepcionOficio, iInformacionCompleta, iIdUsuario');
        $this->db->from("$this->table");
        $this->db->where("$this->table_id", $key);
        $query = $this->db->get();
        return $query->result();
    }

    public function update($data, $key){
        $this->db->where($this->table_id, $key);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function addColaborador($data){
        $db_debug = $this->db->db_debug; //save setting

        $this->db->db_debug = FALSE;
        $this->db->insert('evaluacioncolaborador', $data);
        
        //return $this->db->insert_id();
        return $this->db->affected_rows();
    }

    public function findColaborador($key){
        $this->db->select();
        $this->db->from('evaluacioncolaborador');
        $this->db->where('iIdEvaluacion', $key);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteColaborador($usr, $key){
        $this->db->where('iIdUsuario', $usr);
        $this->db->where('iIdEvaluacion', $key);
        $this->db->delete('evaluacioncolaborador');
        return $this->db->affected_rows();
    }
}