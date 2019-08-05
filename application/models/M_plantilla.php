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

    function findIdEvaluacion($id){
        $this->db->select('*');
        $this->db->from('evaluacion');
        $this->db->where($this->table_id, $id);

        $query=$this->db->get();
        return $query->row();
    }

    public function findAll(){
        $this->db->select('p.iIdPlantilla, p.vPlantilla, p.iAnioEvaluacion, e.vTipoEvaluacion, p.iOrigenEvaluacion');
        $this->db->from('plantilla p'); 
        $this->db->join('tipoevaluacion e', 'p.iIdTipoEvaluacion = e.iIdTipoEvaluacion', 'INNER');
        $this->db->where('p.iActivo', 1);

        $query=$this->db->get();
        
        return $query->result();
    }

    public function EvaluacionCorresponsable($iIdIntervencion){
        $this->db->select('p.iIdEvaluacion, p.iIdOrganismo');
        $this->db->from('evaluacioncorresponsable p'); 
        $this->db->join('evaluacion e', 'p.iIdTipoEvaluacion = e.iIdTipoEvaluacion', 'INNER');
        $this->db->where('p.iIdIntervencion', $iIdIntervencion);
        $this->db->where('p.iEstatusArchivo', 1);

        $query=$this->db->get();
        
        return $query->result();
    }

    public function findEvaluacion($iIdPlantilla/* , $iIdEvaluacion */){
        $this->db->select('i.iIdIntervencion, i.vIntervencion, i.vClave, i.iAnio, i.iTipo, i.iIdIntervencionPropuesta, i.iIdOrganismo, e.iIdEvaluacion');
        $this->db->from('intervencion as i');
        $this->db->join('evaluacion e', 'i.iIdIntervencion = e.iIdIntervencion', 'INNER');
       // $this->db->join('evaluacioncorresponsable p', 'p.iIdEvaluacion = e.iIdEvaluacion', 'INNER');
        $this->db->where('e.iIdPlantilla', $iIdPlantilla);
       // $this->db->where('e.iIdEvaluacion', $iIdEvaluacion);
        $this->db->where('e.iActivo', 1);

        $query = $this->db->get();
        return $query->result();
    }

    public function findPreguntas($id){
        $this->db->select('*');
        $this->db->from('pregunta');
        $this->db->where('iIdApartado', $id);
        $this->db->where('iActivo', 1);

        $query=$this->db->get();
        return $query->result();
    }

    public function findApartado($id){
        $this->db->select('*');
        $this->db->from('apartado');
        $this->db->where('iIdPlantilla', $id);
        $this->db->where('iActivo', 1);

        $query=$this->db->get();
        return $query->result();
    }

    public function ValidaExisteEvaluacion($iIdPlantilla, $iIdIntervencion){
        $this->db->select('iIdEvaluacion');
        $this->db->from('evaluacion');
        $this->db->where('iIdPlantilla', $iIdPlantilla);
        $this->db->where('iIdIntervencion', $iIdIntervencion);
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function insertIntercencion($data){
        $this->db->insert('evaluacion', $data);
        return $this->db->insert_id();
    }

    function insertApartado($data){
        $this->db->insert('apartado', $data);
        return $this->db->insert_id();
    }

    function insertPregunta($data){
        $this->db->insert('pregunta', $data);
        return $this->db->insert_id();
    }
    
    function update($id, $data){
        $this->db->where($this->table_id, $id); 
        return $this->db->update($this->table, $data);        
    }

    function updatePregunta($id, $data){
        $this->db->where('iIdPregunta', $id); 
        return $this->db->update('pregunta', $data);        
    }

    function updateApartado($id, $data){
        $this->db->where('iIdApartado', $id); 
        $this->db->update('apartado', $data);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where($this->table_id, $id);
        $data =  array('iActivo' => 0 );
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function deleteEvaluacion($iIdPlantilla, $iIdIntervencion){
        $this->db->where('iIdPlantilla', $iIdPlantilla);
        $this->db->where('iIdIntervencion', $iIdIntervencion);
        $data =  array('iActivo' => 0 );
        $this->db->update('evaluacion', $data);
        return $this->db->affected_rows();
    }

    public function deletePregunta($iIdPregunta){
        $this->db->where('iIdPregunta', $iIdPregunta);
        $data =  array('iActivo' => 0 );
        $this->db->update('pregunta', $data);
        return $this->db->affected_rows();
    }

    public function deleteApartado($iIdApartado){
        $this->db->where('iIdApartado', $iIdApartado);
        $data =  array('iActivo' => 0 );
        $this->db->update('apartado', $data);
        return $this->db->affected_rows();
    }

    function get_anio(){
        $this->db->distinct();
        $this->db->select('iAnioEvaluacion');
        $this->db->from($this->table);
        $this->db->where('iActivo', 1); 
        $query = $this->db->get();
        return $query->result();
    }

    function get_anio_intervencion(){
        $this->db->distinct();
        $this->db->select('iAnio');
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
        $this->db->distinct();
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

    function get_TipoPregunta(){
        $this->db->select('*');
        $this->db->where('iActivo', 1); 
        $this->db->from('tipopregunta');
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

    public function findOrganismoCarrito(){
        $this->db->distinct();
        $this->db->select('vOrganismo, iIdOrganismo');
        $this->db->from("organismo");
        $this->db->where('iActivo', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function findOrganismoCarritoB($iIdOrganismo, $iIdIntervencion){
/*         $this->db->distinct();
        $this->db->select('i.iIdOrganismo, o.vOrganismo');
        $this->db->from("intervencioncorresponsable i");
        $this->db->join('organismo o','o.iIdOrganismo=.iIdOrganismo','INNER');
        $this->db->join('intervencion iv','iv.iIdIntervencion=i.iIdIntervencion','INNER');
        $this->db->where('i.iIdOrganismo ', $iIdOrganismo);
        $this->db->where('i.iIdIntervencion ', $iIdIntervencion);
        $this->db->where('iActivo', 1); */
        $sql = "select i.iIdOrganismo, o.vOrganismo from intervencioncorresponsable i
        inner join organismo o on o.iIdOrganismo=o.iIdOrganismo
        inner join intervencion iv on iv.iIdIntervencion=i.iIdIntervencion 
        where i.iIdOrganismo = $iIdOrganismo and i.iIdIntervencion=$iIdIntervencion";
        return $this->db->query($sql);
 /*        $query = $this->db->get();
        return $query->result(); */
    }

    public function organismoCorresponsables($idEvaluacion){
        $sql = "SELECT ec.iIdOrganismo 
                FROM evaluacion e
                INNER JOIN evaluacioncorresponsable ec ON ec.iIdEvaluacion = e.iIdEvaluacion AND ec.iIdEvaluacion = $idEvaluacion";
        return $this->db->query($sql);
    }

    public function getIdEvaluacion($iIdPlantilla,$iIdIntervencion){
        $sql = "SELECT e.iIdEvaluacion 
                FROM evaluacion e
                WHERE e.iIdPlantilla = $iIdPlantilla  AND e.iIdIntervencion = $iIdIntervencion";
        return $this->db->query($sql)->row()->iIdEvaluacion;
    }

    function insertCorresponsables($data){
        return $this->db->insert('evaluacioncorresponsable', $data);
    }

    public function filtro($anio, $origen, $tipo, $nombre){
        $this->db->select('p.iIdPlantilla, p.vPlantilla, p.iAnioEvaluacion, t.vTipoEvaluacion, p.iOrigenEvaluacion');
		$this->db->from('plantilla p');
        $this->db->join('tipoevaluacion t','p.iIdTipoEvaluacion = t.iIdTipoEvaluacion AND t.iActivo = 1','INNER');
        $this->db->where('p.iActivo',1);

        if(!empty($anio) && $anio != null){
            $this->db->where('p.iAnioEvaluacion', $anio);
        }
        if(!empty($origen) && $origen != null){
            $this->db->where('p.iOrigenEvaluacion', $origen);
        }
        if(!empty($tipo) && $tipo != null){
            $this->db->where('t.iIdTipoEvaluacion', $tipo);
        }
        if(!empty($nombre) && $nombre != null){
            $this->db->like('p.vPlantilla', $nombre);
        }
        
        $query = $this->db->get();
        return $query->result();
   }
}