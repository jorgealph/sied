<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_IntervencionPropuesta extends CI_Model{
    private $table = 'intervencionpropuesta';
    private $table_id = 'iIdIntervencionPropuesta';

    public function __construct(){
        parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    public function findAll(){
        $this->db->select('ip.vIntervencion, ip.iAnioCreacion, ip.iAnioEvaluacion, o.vOrganismo, e.vEje, ip.iTipo');
        $this->db->from("$this->table as ip");
        $this->db->join('Organismo o', 'ip.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $query = $this->db->get();
        return $query->result();
    }


    public function ejeQuery(){
        $this->db->select('iIdEje, vEje');
        $this->db->from('eje');
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function tipoPPQuery(){
        $this->db->select('iIdTipoPP, vTipoPP');
        $this->db->from('tipopp');
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }
    

    public function tipoEvaluacionQuery(){
        $this->db->select('iIdTipoEvaluacion, vTipoEvaluacion');
        $this->db->from('tipoevaluacion');
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function temaQuery($id){
        $this->db->select('iIdPoliticaPublica, vPoliticaPublica');
        $this->db->from('politicapublica');
        $this->db->where('iActivo', 1);
        $this->db->where('iIdEje',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function objetivoQuery($id){
        $this->db->select('iIdObjetivo, vObjetivo');
        $this->db->from('objetivo');
        $this->db->where('iActivo', 1);
        $this->db->where('iIdPoliticaPublica',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function GetOrganismo(){
        $this->db->select('u.iIdOrganismo, o.vOrganismo, e.vEje');
        $this->db->from('usuario as u');
        $this->db->join('Organismo o', 'u.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $query = $this->db->get();
        return $query->result();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
}