<?php
class M_catalogo extends CI_Model {


	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	public function ejes($where='')
	{
		$this->db->select('iIdEje AS id, vEje AS valor ');
		$this->db->from('Eje');
		$this->db->where('iActivo',1);

		if($where != '') $this->db->where($where);

		return $this->db->get();
	}

	public function roles($where='')
	{
		$this->db->select('iIdRol AS id, vRol AS valor');
		$this->db->from('Rol');
		$this->db->where('iActivo',1);

		if($where != '') $this->db->where($where);

		return $this->db->get();
	}
}
?>