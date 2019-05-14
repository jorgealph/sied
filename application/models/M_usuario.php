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

    function findAll(){
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
}

?>