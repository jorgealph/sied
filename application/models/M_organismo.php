<?php
class M_organismo extends CI_Model {    
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    function buscar_organismo($where,$like)
    {
    	$this->db->select('o.iIdOrganismo, o.vOrganismo, o.vSiglas, o.vNombreTitular, e.vEje');		
		$this->db->from('Organismo o');
		$this->db->join('Eje e','e.iIdEje = o.iIdEje AND e.iActivo = 1','INNER');
		$this->db->where('o.iActivo',1);

		if(!empty($where)) $this->db->where($where);
		if(!empty($like))
		{
			$this->db->where("(o.vOrganismo LIKE '%$like%' OR o.vSiglas LIKE '%$like%')");
		}

		return $this->db->get();
    }

    function datos_captura($id)
    {
    	$this->db->select('o.iIdOrganismo, o.vOrganismo, o.vSiglas, o.vNombreTitular, o.vNombreEnlace, o.vCorreoContacto, o.iIdEje');
		$this->db->from('Organismo o');
		$this->db->where('o.iActivo',1);
		$this->db->where('iIdOrganismo',$id);

		return $this->db->get()->row();
    }

    function campos_tabla()
	{
		$sql = "SHOW COLUMNS FROM Organismo FROM {$this->db->database};";
		return $this->db->query($sql); 
	}
}