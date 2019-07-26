<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asm extends CI_Model{

    private $table = 'asm';
    private $table_id = 'iIdASM';

    public function __construct(){
        parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    public function findAll(){
        $this->db->select('a.iIdASM, a.iAnioEvaluacion, a.vNombreASM, p.vPlantilla, o.vSiglas');
        $this->db->from('asm a'); 
        $this->db->join('evaluacion e', 'e.iIdEvaluacion=a.iIdEvaluacion', 'INNER');
        $this->db->join('plantilla p', 'e.iIdPlantilla=p.iIdPlantilla', 'INNER');
        $this->db->join('intervencion i', 'e.iIdIntervencion=i.iIdIntervencion', 'INNER');
        $this->db->join('organismo o', 'o.iIdOrganismo=i.iIdOrganismo', 'INNER');
        $this->db->where('a.iActivo', 1);

        $query=$this->db->get();
        
        return $query->result();
    }

    function find($id){
        $this->db->select('iIdASM, vNombreASM, iAnioEvaluacion, iPrioridad, iClasificacion, iIdEvaluacion');
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);

        $query=$this->db->get();
        return $query->row();
    }
    
    function update($id, $data){
        $this->db->where($this->table_id, $id); 
        return $this->db->update($this->table, $data);        
    }

    public function delete($id){
        $this->db->where($this->table_id, $id);
        $data =  array('iActivo' => 0 );
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    function get_anio(){
        $this->db->select('iIdASM, iAnioEvaluacion');
        $this->db->from($this->table);
        $this->db->where('iActivo', 1); 
        $query = $this->db->get();
        return $query->result();
    }

    function get_origen(){
        $this->db->distinct();
        $this->db->select('iOrigenEvaluacion');
        $this->db->where('iActivo', 1); 
        $this->db->from('plantilla');
        $query = $this->db->get();
        return $query->result();
    }

    function get_tipo(){
        $this->db->select('iIdTipoEvaluacion, vTipoEvaluacion');
        $this->db->where('iActivo', 1); 
        $this->db->from('tipoevaluacion');
        $query = $this->db->get();
        return $query->result();
    }

    function get_intervencionTipo(){
        $this->db->select('iTipo');
        $this->db->from('intervencion');
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_eje(){
        $this->db->select('*');
        $this->db->from('eje');
        $this->db->where('iActivo', 1); 
        $query = $this->db->get();
        return $query->result();
    }

    function get_intervencion(){
        $this->db->select('iIdOrganismo, vOrganismo');
        $this->db->from('organismo');
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_programa($tipoI = null, $dependencia = null, $eje = null){
        $this->db->select('e.iIdEvaluacion, e.vNombreEvaluacion');
        $this->db->from('evaluacion e');
        $this->db->join('intervencion i', 'e.iIdIntervencion=i.iIdIntervencion', 'INNER');
        $this->db->join('organismo o', 'o.iIdOrganismo=i.iIdOrganismo', 'INNER');
        $this->db->join('eje j', 'o.iIdEje=j.iIdEje', 'INNER');
        $this->db->where('e.iActivo', 1);
        if($tipoI != null){
            $this->db->where('i.iIdIntervencion', $tipoI);
        }
        if($dependencia != null){
            $this->db->where('o.iIdOrganismo', $dependencia);
        }
        if($eje != null){
            $this->db->where('j.iIdEje', $eje);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function get_prioridad(){
        $this->db->distinct();
        $this->db->select('iPrioridad');
        $this->db->where('iActivo', 1); 
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    function get_clasificacion(){
        $this->db->distinct();
        $this->db->select('iClasificacion');
        $this->db->where('iActivo', 1); 
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
}