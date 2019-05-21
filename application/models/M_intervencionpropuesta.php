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
        $this->db->select('ip.iIdIntervencionPropuesta, ip.vIntervencion, ip.iAnioCreacion, ip.iAnioEvaluacion, o.vOrganismo, o.iIdOrganismo, e.iIdEje, e.vEje, ip.iTipo');
        $this->db->from("$this->table as ip");
        $this->db->join('Organismo o', 'ip.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $this->db->where('ip.iActivo', 1);
        return $query = $this->db->get();
        //return $query->result();
    }

    public function findRecord($id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);
        $query = $this->db->get();
        return $query->result()[0];
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

    public function GetOrganismoEdit($id){
        $this->db->select('o.iIdOrganismo, o.vOrganismo, e.vEje');
        $this->db->from('Organismo o');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $this->db->where("o.iIdOrganismo = $id");
        $query = $this->db->get();
        return $query->result();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data){
        $this->db->where($this->table_id, $data['iIdIntervencionPropuesta']);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where($this->table_id, $id);
        $data =  array('iActivo' => 0 );
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function GetEje($id){
        $this->db->select('e.iIdEje, pp.iIdPoliticaPublica');
        $this->db->from('Objetivo o');
        $this->db->join('politicapublica pp', 'pp.iIdPoliticaPublica = o.iIdPoliticaPublica', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = pp.iIdEje', 'INNER');
        $this->db->where("o.iIdObjetivo = $id");
        $query = $this->db->get();

        return $query->result()[0];
    }
    
    public function GetRecord($id){
        $this->db->select('iIdIntervencionPropuesta, iIdOrganismo, iTipo, iAnioEvaluacion, vIntervencion');
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);
        $query = $this->db->get();
        return $query->result()[0];
    }

    public function filterIntervencion($nombre, $eje, $dependencia, $tipo){
        $this->db->select('ip.iIdIntervencionPropuesta, ip.vIntervencion, ip.iAnioCreacion, ip.iAnioEvaluacion, o.vOrganismo, o.iIdOrganismo, e.iIdEje, e.vEje, ip.iTipo');
        $this->db->from("$this->table as ip");
        $this->db->join('Organismo o', 'ip.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $this->db->where('ip.iActivo', 1);
        
        if(!empty($nombre) && $nombre != null){
            $this->db->like('ip.vIntervencion', $nombre);
        }
        
        if(!empty($eje) && $eje != null){
            $this->db->where('e.iIdEje', $eje);
        }
        
        if(!empty($dependencia) && $dependencia != null){
            $this->db->where('o.iIdOrganismo', $dependencia);
        }
        
        if(!empty($tipo) && $tipo != null){
            $this->db->where('ip.iTipo', $tipo);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function findDistinctOrganismo(){
        $this->db->distinct();
        $this->db->select('o.vOrganismo, o.iIdOrganismo');
        $this->db->from("$this->table as ip");
        $this->db->join('Organismo o', 'ip.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $this->db->where('ip.iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function findDistinctEje(){
        $this->db->distinct();
        $this->db->select('e.vEje, o.iIdEje');
        $this->db->from("$this->table as ip");
        $this->db->join('Organismo o', 'ip.iIdOrganismo = o.iIdOrganismo', 'INNER');
        $this->db->join('Eje e', 'e.iIdEje = o.iIdEje', 'INNER');
        $this->db->where('ip.iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

}