<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_intervencionpropuesta extends CI_Model{
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

}