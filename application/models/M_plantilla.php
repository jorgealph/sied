<?php
class M_plantilla extends CI_Model {  
    public $table='plantilla';
    public $table_id='iIdPlantilla';  
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    function find($id){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);

        $query=$this->db->get();
        return $query->row();
    }

    public function findAll(){
        $this->db->select();
        $this->db->from($this->table); 
        $this->db->where('iActivo', 1);     

        $query=$this->db->get();
        
        return $query->result();
    }

    function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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
        $this->db->select('iAnioEvaluacion');
        $this->db->from($this->table);
        $this->db->where('iActivo', 1); 
        $query = $this->db->get();
        return $query->result();
    }

    function get_anio_intervencion(){
        $this->db->select('*');
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

    public function GetEje($id){
        $this->db->select('e.iIdEje, i.iIdIntervencion');
        $this->db->from('organismo o');
        $this->db->join('intervencion i', 'i.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $this->db->where("o.iIdOrganismo = $id");
        $query = $this->db->get();

        return $query->result()[0];
    }

    public function GetOrganismo($id){
        $this->db->select('o.iIdOrganismo, i.iIdIntervencion');
        $this->db->from('organismo o');
        $this->db->join('intervencion i', 'i.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->where("o.iIdOrganismo = $id");
        $query = $this->db->get();

        return $query->result()[0];
    }

    function get_intervencion($anio = null, $organismo = null, $tipo = null){
        $this->db->select('*');
        $this->db->from('intervencion');
        $this->db->where('iActivo', 1);
        if($anio != null){
            $this->db->where('iAnio', $anio);
        }
        if($organismo != null){
            $this->db->where('iIdOrganismo', $organismo);
        }
        if($tipo != null){
            $this->db->where('iTipo', $tipo);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getRecord($id){
        $this->db->select('*');
        $this->db->from('intervencion');
        $this->db->where('iActivo', 1);
        $this->db->where('iIdIntervencion', $id);
        $query = $this->db->get();
        return $query->result()[0];
    }

    function get_origen(){
        $this->db->select('iOrigenEvaluacion');
        $this->db->where('iActivo', 1); 
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    function get_tipo(){
        $this->db->select('*');
        $this->db->where('iActivo', 1); 
        $this->db->from('tipoevaluacion');
        $query = $this->db->get();
        return $query->result();
    }

    public function findOrganismo($id = null){
        $this->db->distinct();
        $this->db->select('o.vOrganismo, o.iIdOrganismo');
        $this->db->from("organismo as o");
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $this->db->where('o.iActivo', 1);
        
        if($id != null && !empty($id)){
            $this->db->where('o.iIdEje', $id);
        }

        $query = $this->db->get();
        return $query->result();
    }
}