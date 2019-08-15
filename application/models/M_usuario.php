<?php
class M_usuario extends CI_Model {
    public $table='usuario';
    public $table_id='iIdUsuario';
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

   /*  function delete($id){
        $this->db->where($this->table_id, $id);   
        $this->db->delete($this->table);    
    }  */
    public function delete($id){
        $this->db->where($this->table_id, $id);
        $data =  array('iActivo' => 0 );
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    function get_eje(){
        $this->db->select('*');
        $this->db->from('eje');
        $this->db->where('iActivo', 1); 
        $query = $this->db->get();
        return $query->result();
    }

    function get_dependencia(){
        $this->db->select('*');
        $this->db->where('iActivo', 1); 
        $this->db->from('organismo');
        $this->db->order_by('vOrganismo');
        $query = $this->db->get();
        return $query->result();
    }

    function buscar_drectorio($where,$like)
    {
    	$this->db->select('u.iIdUsuario, u.vUsuario, u.vNombres, u.vApellidoPaterno, u.vCorreo1, u.vCargo, u.vCelular, o.vOrganismo, o.vOrganismo, e.vEje');	
		$this->db->from('usuario u');
        $this->db->join('organismo o','u.iIdOrganismo = o.iIdOrganismo AND o.iActivo = 1','INNER');
        $this->db->join('eje e','e.iIdEje = o.iIdEje AND e.iActivo = 1','INNER');
		$this->db->where('u.iActivo',1);

		if(!empty($where)) $this->db->where($where);
		if(!empty($like))
		{
			$this->db->where("(o.vOrganismo LIKE '%$like%' OR o.vSiglas LIKE '%$like%')");
		}
		return $this->db->get();
    }

    public function filtro($organismo, $eje, $texto){
        $this->db->select('u.iIdUsuario, u.vUsuario, u.vNombres, u.vApellidoPaterno, u.vApellidoMaterno, u.vCorreo1, u.vCargo, u.vCelular, o.vOrganismo, o.vOrganismo, e.vEje, u.vTitulo');	
		$this->db->from('usuario u');
        $this->db->join('organismo o','u.iIdOrganismo = o.iIdOrganismo AND o.iActivo = 1','INNER');
        $this->db->join('eje e','e.iIdEje = o.iIdEje AND e.iActivo = 1','INNER');
        $this->db->where('u.iActivo',1);

        if(!empty($organismo) && $organismo != null){
            $this->db->where('o.iIdOrganismo', $organismo);
        }
        if(!empty($eje) && $eje != null){
            $this->db->where('e.iIdEje', $eje);
        }
        if(!empty($texto) && $texto != null){
            $like = "(u.vUsuario LIKE '%$texto%' OR (CONCAT(u.vNombres,\" \",u.vApellidoPaterno, \" \",u.vApellidoMaterno) LIKE '%$texto%'))";
            $this->db->where($like);
        }
        
        $query = $this->db->get();
        return $query->result();
   }

    public function cambiar_contrasenia($id, $vdata){
        $this->db->where($this->table_id, $id);
        $data =  array('vPassword' => $vdata["vPassword"]);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    function get_rol(){
        $this->db->select('iIdRol');
        $this->db->from($this->table);
        $this->db->where('iActivo', 1); 
        $query = $this->db->get();
        return $query->result();
    }

    function get_organismo(){
        $this->db->select('iIdOrganismo');
        $this->db->from($this->table);
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function nombre_organismo($id){
        $this->db->select('vOrganismo');
        $this->db->from('organismo');
        $this->db->where('iIdOrganismo', $id);

        return $this->db->get()->row()->vOrganismo;
    }

    function nombre_rol($id){
        $this->db->select('vRol');
        $this->db->from('roles');
        $this->db->where('iIdRoles', $id);

        return $this->db->get()->row()->vOrganismo;
    }
}

?>