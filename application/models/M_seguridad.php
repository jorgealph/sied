<?php
class M_seguridad extends CI_Model {


	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default',TRUE);
	}

	/*	Funciones para usar transacciones
	======================================
	*/
	public function iniciar_transaccion()
	{
	  $con = $this->load->database('default',TRUE);
	  $con->trans_begin();
	  return  $con;
	}

	public function terminar_transaccion($con)
	{
		if ($con->trans_status() === FALSE)
		{
			$con->trans_rollback();
			return false;
		}
		else 
		{
			$con->trans_commit();
			return true;
		}
	}

	public function insertar_registro($tabla,$datos,$con='')
	{
		if($con == '') $con = $this->db;

		if($con->insert($tabla,$datos)) return $con->insert_id();
		else return false;
	}

	public function insertar_registro_no_pk($tabla,$datos,$con='')
	{
		if($con == '') $con = $this->db;

		if($con->insert($tabla,$datos)) return true;
		else return false;
	}

	public function actualizar_registro($tabla,$where,$datos,$con='')
	{
		if($con == '') $con = $this->db;
		$con->where($where);
		return $con->update($tabla, $datos);
	}

	public function eliminar_registro($tabla,$where,$con)
	{
		return $con->delete($tabla,$where);
	}

	public function desactivar_registro($tabla,$where,$con='')
	{
		if($con == '') $con = $this->db;
		$con->where($where);
		return $con->update($tabla, array('iActivo' => 0));

		return ($con->affected_rows() > 0);
	}

	public function activar_registro($tabla,$where,$con='')
	{
		if($con == '') $con = $this->db;
		$con->where($where);
		$con->update($tabla, array('iActivo' => 1));

		return ($con->affected_rows() > 0);
	}

	/*	Funciones para usar transacciones
	======================================
	*/

	public function consulta_existe_usuario($where='')
	{
		$this->db->select('u.iIdUsuario id_usuario, u.vNombres nombres, u.vApellidoPaterno apellido_paterno, u.vApellidoMaterno  apellido_materno, u.vCorreo1 correo, u.vUsuario usuario');
		$this->db->select('r.iIdRol id_rol, r.vRol rol');
		$this->db->from('usuario u');
		$this->db->join('rol r','r.iIdRol = u.iIdRol','INNER');
		$this->db->where('u.iActivo',1);

		if($where != '') $this->db->where($where);

		$query = $this->db->get();
		$_SESSION['consulta'] = $this->db->last_query();

		return $query;
	}

	public function traer_menu_sistema($id_usuario=0, $id_padre=0)
	{	
		$sql = "SELECT t.iIdPermiso id_permiso, t.vPermiso permiso, t.vIcono icono, t.vURL url, t.iTipoAcceso tipo_acceso, t.iOrden orden
				FROM ((SELECT p.iIdPermiso, p.vPermiso, p.vIcono, up.iTipoAcceso, p.vURL, p.iOrden
						FROM permiso p
						INNER JOIN usuariopermiso up ON up.iIdPermiso = p.iIdPermiso AND up.iIdUsuario = '$id_usuario' AND p.iIdPermisoPadre = '$id_padre' AND p.iTipo = 1)
				UNION
					(SELECT p.iIdPermiso, p.vPermiso, p.vIcono, rp.iTipoAcceso, p.vURL, p.iOrden
						FROM permiso p
						INNER JOIN rolpermiso rp ON rp.iIdPermiso = p.iIdPermiso
						INNER JOIN usuario u ON u.iIdRol = rp.iIdRol
					WHERE u.iIdUsuario = '$id_usuario' AND p.iIdPermisoPadre = '$id_padre' AND p.iTipo = 1)) t
				WHERE t.iTipoAcceso > 0
				ORDER BY t.iOrden ASC";
		return $this->db->query($sql);
	}

	public function consultar_tipo_acceso($id_usuario,$id_permiso)
	{
		$con1 = $this->db;
		$con1->select('up.iTipoAcceso');
		$con1->from('usuariopermiso up');
		$con1->join('permiso p','p.iIdPermiso = up.iIdPermiso AND p.iActivo = 1','INNER');
		$con1->join('usuario u','u.iIdUsuario = up.iIdUsuario AND u.iActivo = 1','INNER');
		$con1->where('up.iIdPermiso',$id_permiso);
		$con1->where('up.iIdUsuario',$id_usuario);

		$query = $con1->get();

		if($query->num_rows() == 0)
		{
			$con2 = $this->db;
			$con2->select('rp.iTipoAcceso');
			$con2->from('usuario u');
			$con2->join('rolpermiso rp','rp.iIdRol = u.iIdRol','INNER');
			$con2->join('permiso p','p.iIdPermiso = rp.iIdPermiso AND p.iActivo = 1','INNER');
			$con2->join('rol r','r.iIdRol = rp.iIdRol AND r.iActivo = 1','INNER');
			$con2->where('rp.iIdPermiso',$id_permiso);
			$con2->where('u.iIdUsuario',$id_usuario);
			$con2->where('u.iActivo',1);

			$query = $con2->get();
		}

		return ($query->num_rows() > 0) ? (int)$query->row()->iTipoAcceso:0;
	}

	public function consulta_valor_parametros($where='')
	{
		$this->db->select('p.vValor, p.vId, p.vDescripcion');
		$this->db->from('parametro p');		
		$this->db->where('p.iActivo',1);	// Se excluyen usuarios eliminados

		$query =  $this->db->get();

		return $query;
	}

	public function buscar_usuarios($where ='',$palabra='')
	{
		$this->db->select('u.iIdUsuario, u.vNombre, u.vApellidoPaterno, u.vApellidoMaterno, u.vCorreo, r.vRol, r.iIdRol, u.iEstatus');
		$this->db->from('usuario u');
		$this->db->join('rol r','r.iIdRol = u.iIdRol','INNER');
		$this->db->where('u.iEstatus >',0);
		if($palabra != '')
		{
			//$this->db->where("CONCACT( u.vNombre,' ',u.vApellidoPaterno,' ',u.vApellidoMaterno) LIKE '%$palabra%'");
			$this->db->like("u.vNombre",$palabra);
		}

		if(!empty($where)) $this->db->where($where);

		
		$this->db->order_by('u.vNombre');
		

		return $this->db->get();
	}

	public function consultar_usuario_por_token($idusuario, $token)
	{
		$this->db->select('u.iIdUsuario, u.vNombre, u.vApellidoPaterno, u.vApellidoMaterno, u.vCorreo, r.vRol, r.iIdRol');
		$this->db->from('usuario u');
		$this->db->join('rol r','r.iIdRol = u.iIdRol','INNER');
		$this->db->where('u.iEstatus >',0);
		$this->db->where('u.iIdUsuario',$idusuario);
		$this->db->where('u.vToken',$token);
		$response = false;

		$query =  $this->db->get();
		if($query)
		{
			if($query->num_rows() == 1) $response = true;
		}

		return $response;
	}

	public function consultar_usuario_por_correo($correo)
	{
		$this->db->select('u.iIdUsuario, u.vNombre, u.vApellidoPaterno, u.vApellidoMaterno');
		$this->db->from('usuario u');
		$this->db->join('rol r','r.iIdRol = u.iIdRol','INNER');
		$this->db->where('u.iEstatus ',2);
		$this->db->where('u.vCorreo',$correo);
		$this->db->limit(1);	//Sólo debe haber un correo registrado
		$response = false;

		$query =  $this->db->get();
		
		return $query;
	}

	public function verificar_existe_correo_usuario($correo,$excepcion=0)
	{
		$this->db->select('u.iIdUsuario');
		$this->db->from('usuario u');
		$this->db->join('rol r','r.iIdRol = u.iIdRol','INNER');
		$this->db->where('u.iEstatus >',0);	// Se excluyen usuarios eliminados
		$this->db->where('u.vCorreo',$correo);
		if($excepcion != 0) $this->db->where('u.iIdUsuario !=',$excepcion);
		$response = false;

		$query =  $this->db->get();

		if($query->num_rows() > 0) $response = true;
		
		return $response;
	}

	

	public function datos_usuarios($where ='')
	{
		$this->db->select('u.iIdUsuario, u.vNombre, u.vApellidoPaterno, u.vApellidoMaterno, u.vCorreo, u.dFechaNacimiento, u.iGenero, u.iIdGradoEstudio, u.iIdOcupacion, u.iIdAsentamiento, u.iIdRol, u.iEstatus');
		$this->db->select('l.iIdLocalidad, l.vLocalidad, m.iIdMunicipio, m.vMunicipio, iCodigoPostal, vToken');
		$this->db->from('usuario u');		
		$this->db->join('asentamiento a','a.iIdAsentamiento = u.iIdAsentamiento','INNER');
		$this->db->join('localidad l','l.iIdLocalidad = a.iIdLocalidad','INNER');
		$this->db->join('municipio m','m.iIdMunicipio = l.iIdMunicipio','INNER');
		//$this->db->where('u.iEstatus >',0);

		if(!empty($where)) $this->db->where($where);

		$this->db->order_by('u.vNombre');

		return $this->db->get();
	}
	
}

?>