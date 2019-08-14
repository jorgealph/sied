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
		$this->db->from('eje');
		$this->db->where('iActivo',1);

		if($where != '') $this->db->where($where);

		return $this->db->get();
	}

	public function roles($where='')
	{
		$this->db->select('iIdRol AS id, vRol AS valor');
		$this->db->from('rol');
		$this->db->where('iActivo',1);

		if($where != '') $this->db->where($where);

		return $this->db->get();
	}
	
	public function organismos($where='')
	{
		$this->db->select('iIdOrganismo AS id, vOrganismo AS valor');
		$this->db->from('organismo');
		$this->db->where('iActivo',1);

		if($where != '') $this->db->where($where);

		return $this->db->get();
	}

	public function poderes($where='')
	{
		$this->db->select('iIdPoder AS id, vPoder AS valor');
		$this->db->from('poder');
		$this->db->where('iActivo',1);

		if($where != '') $this->db->where($where);

		return $this->db->get();
	}

	public function ambitos($where='')
	{
		$this->db->select('iIdAmbito AS id, vAmbito AS valor');
		$this->db->from('ambito');
		$this->db->where('iActivo',1);

		if($where != '') $this->db->where($where);

		return $this->db->get();
	}
}
?>