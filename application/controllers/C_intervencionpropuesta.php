<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_IntervencionPropuesta extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }

    function mostrar_vista($msg = null)
	{
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			$this->load->model('M_IntervencionPropuesta');
			$datos['table'] = $this->generateTable($this->M_IntervencionPropuesta->findAll());
			$datos['eje'] = $this->M_IntervencionPropuesta->ejeQuery();

			$datos['organismo'] = $this->M_IntervencionPropuesta->findOrganismo(null);
			$this->load->view('IntervencionPropuesta/lista',$datos);

		}else $this->index();
	}

	function buscar(){
		$this->load->model('M_IntervencionPropuesta');
		
		if(empty($_POST['iTipo']) && empty($_POST['iIdEje']) && empty($_POST['vIntervencion']) && empty($_POST['iIdOrganismo'])){
			$data = $this->M_IntervencionPropuesta->findAll();
		}else{
			$nombre = $_POST['vIntervencion'];
			$eje = $_POST['iIdEje'];
			$dependencia = $_POST['iIdOrganismo'];
			$tipo = $_POST['iTipo'];
			$data = $this->M_IntervencionPropuesta->filterIntervencion($nombre, $eje, $dependencia, $tipo);
		}
		
		echo $this->generateTable($data);
	}

	private function generateTable($data){
		$table = '<p>No se encontraron registros para mostrar.</p>';
		if($data->num_rows() > 0){
			$table = '<table id="data-table-default" class="table table-hover table-bordered">
                        <thead>
                            <tr>
								<th>Intervención pública</th>
								<th>Año de creación</th>
								<th>Año de evaluación</th>
								<th>Eje</th>
								<th>Dependencia</th>
								<th>Tipo de intervención</th>
								<th width="100px">Acciones</th>
                            </tr>
                        </thead>
						<tbody>';
							
			foreach ($data->result() as $registro) {
				$acciones = '';				
				$acciones .= '<button onclick="cargar(\''.base_url().'C_IntervencionPropuesta/edit/'.$registro->iIdIntervencionPropuesta.'\', \'#contenido\');" class="btn btn-grey btn-icon btn-sm"><i class="fas fa-pencil-alt fa-fw"></i></button>&nbsp;';
		
			    $acciones .= '<button onclick="Aprobar('.$registro->iIdIntervencionPropuesta.')" class="btn btn-success btn-icon btn-sm"><i class="fas fa-lg fa-fw fa-check-circle"></i></button>&nbsp;';
			
			    $acciones .= '<button onclick="confirmar(\'¿Desea eliminar este registro?\', eliminar ,'.$registro->iIdIntervencionPropuesta.');" class="btn btn-danger btn-icon btn-sm"><i class="fas fa-trash-alt fa-fw"></i></button>';
				$table .= " <tr>
								<td>{$registro->vIntervencion}</td>
								<td>{$registro->iAnioCreacion}</td>
								<td>{$registro->iAnioEvaluacion}</td>
								<td>{$registro->vEje}</td>
								<td>{$registro->vOrganismo}</td>
								<td>{$this->GetType($registro->iTipo)}</td>                        
								<td>$acciones</td>
							</tr>";
						} 
				$table .= '</tbody>
						</table>';
				$table .= '<script>
				$(document).ready(function() {
					TableManageDefault.init();
				});
			</script>';
			return $table;
		}else{
			return 'No se encontraron coincidencias';
		}
	}

	private function GetType($iTipo){
		if($iTipo == 1){
			return 'Programa presupuestario';
		}elseif($iTipo == 2){
			return 'Fondo';
		}else{
			return 'Programa de bienes o servicio';
		}
	}

	public function drawTable(){
		$this->load->model('M_IntervencionPropuesta');
		
		if(empty($_POST['iTipo']) && empty($_POST['iIdEje']) && empty($_POST['vIntervencion']) && empty($_POST['iIdOrganismo'])){
			$datos['intpro'] = $this->M_IntervencionPropuesta->filterIntervencion(null, null, null, null);
		}else{
			$nombre = $_POST['vIntervencion'];
			$eje = $_POST['iIdEje'];
			$dependencia = $_POST['iIdOrganismo'];
			$tipo = $_POST['iTipo'];
			$datos['intpro'] = $this->M_IntervencionPropuesta->filterIntervencion($nombre, $eje, $dependencia, $tipo);
		}
		
		$this->load->view('IntervencionPropuesta/table',$datos);
	}

	function mostrar_crud()
	{
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			$this->load->model('M_IntervencionPropuesta');
			$_SESSION['intervencion_corresponsables'] = array();
			$datos['eje'] = $this->M_IntervencionPropuesta->ejeQuery();
			$datos['tipoPP'] = $this->M_IntervencionPropuesta->tipoPPQuery();
			$datos['tipoFondo'] = $this->M_IntervencionPropuesta->tipoFondoQuery();
			$datos['tipoEvaluacion'] = $this->M_IntervencionPropuesta->tipoEvaluacionQuery();
			$datos['organismo'] = $this->M_IntervencionPropuesta->GetOrganismo()[0];
			$datos['dependencias'] = $this->cargar_select($this->M_IntervencionPropuesta->cargar_dependencias());
			$this->load->view('IntervencionPropuesta/edit',$datos);
		}else $this->index();
	}

	

	public function edit($key){
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			$this->load->model('M_IntervencionPropuesta');
			$_SESSION['intervencion_corresponsables'] = array();
			$datos['record'] = $this->M_IntervencionPropuesta->findRecord($key);
			$datos['eje'] = $this->M_IntervencionPropuesta->ejeQuery();
			$datos['tipoPP'] = $this->M_IntervencionPropuesta->tipoPPQuery();
			$datos['tipoFondo'] = $this->M_IntervencionPropuesta->tipoFondoQuery();
			$datos['tipoEvaluacion'] = $this->M_IntervencionPropuesta->tipoEvaluacionQuery();
			$datos['organismo'] = $this->M_IntervencionPropuesta->GetOrganismoEdit($datos['record']->iIdOrganismo)[0];
			$datos['select'] = $this->M_IntervencionPropuesta->GetEje($datos['record']->iIdObjetivo);
			$datos['dependencias'] = $this->cargar_select($this->M_IntervencionPropuesta->cargar_dependencias());
			$this->load_corresponsables($this->M_IntervencionPropuesta->cargarCorresponsable($key));
			$this->load->view('IntervencionPropuesta/edit', $datos);
		}else $this->index();
	}

	private function load_corresponsables($vdata){
		$data = $_SESSION['intervencion_corresponsables'];
		$this->load->model('M_IntervencionPropuesta', 'mi');
		foreach ($vdata as $r){
			$tmp = $this->mi->GetOrganismoEdit($r->iIdOrganismo);
			if (isset($tmp[0])){
				$tmp = $tmp[0];
				$tmp->iActivo = 1;
				$data[] = $tmp;
			}
		}
		$_SESSION['intervencion_corresponsables'] = $data;
	}

	public function addCorresponsable(){
		$result = 0;
		if (isset($_POST['iIdOrganismo'])){
			$data = $_SESSION['intervencion_corresponsables'];
			$existe = false;
			$key = $_POST['iIdOrganismo'];
			foreach ($data as $r){
				if ($r->iIdOrganismo == $key){
					$existe = true;
					if ($r->iActivo == 0){
						$r->iActivo = 1;
						$result = 1;
					}
					break;
				}
			}
			$this->load->model('M_IntervencionPropuesta', 'mi');
			if($existe == false){
				$tmp = $this->mi->GetOrganismoEdit($key);
				if (isset($tmp[0])){
					$tmp = $tmp[0];
					$tmp->iActivo = 1;
					$data[] = $tmp;
				}
				$result = 1;
			}
			$_SESSION['intervencion_corresponsables'] = $data;
		}
		echo $result;
	}

	public function removeCorresponsable(){
		$result = 0;
		if (isset($_POST['iIdOrganismo'])){
			$data = $_SESSION['intervencion_corresponsables'];
			$key = $_POST['iIdOrganismo'];
			foreach ($data as $r){
				if($r->iIdOrganismo == $key){
					$r->iActivo = 0;
					$result = 1;
				}
			}
		}
		echo $result;
	}

	public function tabla_corresponsables(){
		$tb = '';
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nombre de la dependencia</th>
                    <th width="120px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                '.$this->contenido_corresponsables().'
            </tbody>
        </table>';
        echo $tb;
	}

	private function contenido_corresponsables(){
		$tb = '';
		$data = array();
		$empty = true;
        if (isset($_SESSION['intervencion_corresponsables']) && !empty($_SESSION['intervencion_corresponsables'])){
            $data = $_SESSION['intervencion_corresponsables'];
            foreach ($data as $r){
                if($r->iActivo == 1){
					$tb .= '<tr>';
						$tb .= '<td>'.$r->vOrganismo.'</td>';
						$tb .= '<td>';
							$tb .= '<button onclick="removeCorresponsable('.$r->iIdOrganismo.')" class="btn btn-danger btn-icon btn-sm" type="button"><i class="fas fa-trash fa-fw"></i></button>';
						$tb .= '</td>';
					$tb .= '</tr>';
					$empty = false;
				}
            }
		}
		if ($empty == true){
			$tb .= "<tr><td valign='top' colspan='6' class='dataTables_empty'>No se encontron registros</td></tr>";
		}
        return $tb;
	}

	private function cargar_select($data){
		$option = '<option value="">-Seleccione una opción-</option>';
		foreach($data as $r){
			$option .= '<option value="'.$r->id.'">'.$r->value.'</option>';
		}
		return $option;
	}
	
	private function menu(){
		$idrol = (int)$_SESSION[PREFIJO.'_idrol'];
		$idusuario = (int)$_SESSION[PREFIJO.'_idusuario'];
		$this->load->library('Class_seguridad');
		$ms = new Class_seguridad();
		$aux = $ms->pintar_menu($idusuario);
		$datos['menu'] = $aux['menu'];
		$datos['modulo_inicial'] = $aux['modulo_inicial'];

		return $datos;
	}

	public function temaQuery($id = null, $find = ''){
		
		$option = '<option value="null">-Seleccione una opción-</option>';
		if($id != null){
			$this->load->model('M_IntervencionPropuesta');
			$tema = $this->M_IntervencionPropuesta->temaQuery($id);
		
			foreach($tema as $r){
				$option .= "<option value='$r->iIdPoliticaPublica'>$r->vPoliticaPublica</option>";
				if($find == $r->iIdPoliticaPublica){
					$option .= "<script>$('#tema').val($find).change();</script>";
				}
			}
		}
		echo $option;
	}

	public function objetivoQuery($id = null, $objetivo = ''){
		$option = '<option value="null">-Seleccione una opción-</option>';

		if($id != null){
			$this->load->model('M_IntervencionPropuesta');
			$organismo = $this->M_IntervencionPropuesta->objetivoQuery($id);
			foreach($organismo as $r){
				
				if($objetivo == $r->iIdObjetivo){
					$option .= "<option value='$r->iIdObjetivo' selected>$r->vObjetivo</option>";
				}else{
					$option .= "<option value='$r->iIdObjetivo'>$r->vObjetivo</option>";
				}
			}
		}
		echo "<script>focusObjetivo($objetivo)</script>";
		echo $option;
		
	}

	public function dependenciaQuery($id = null){
		$this->load->model('M_IntervencionPropuesta');
		$data = $this->M_IntervencionPropuesta->findOrganismo($id);
		$option = '<option value="">-Todos-</option>';
		foreach($data as $r){
			$option .= "<option value='$r->iIdOrganismo'>$r->vOrganismo</option>";
		}
		echo $option;
	}
	

	public function dataEntry(){	
		
		$data['vIntervencion'] = $this->input->post("vIntervencion");
		$data['iAnioCreacion'] = $this->input->post("iAnioCreacion");
		$data['iAnioEvaluacion'] = $this->input->post("iAnioEvaluacion");
		$data['iTipo'] = $this->input->post("iTipo");
		$data['iEntregaBienServicio'] = $this->input->post("iEntregaBienServicio");
		$data['iIdOrganismo'] = $this->input->post("iIdOrganismo");
		$data['vAreaResponsable'] = $this->input->post("vAreaResponsable");
		$data['vObjetivo'] = $this->input->post("vObjetivo");
		$data['vPoblacionObjetivo'] = $this->input->post("vPoblacionObjetivo");
		$data['iIdObjetivo'] = $this->input->post("iIdObjetivo");
		//Captura de PMP
		$data['vPMP'] = $this->input->post("vPMP");
		$data['vObjetivoPMP'] = $this->input->post("vObjetivoPMP");
		//
		$data['iIdObjetivoPMP'] = -1;
		$data['nPresupuestoEjercido'] = $this->input->post("nPresupuestoEjercido");
		$data['nPresupuestoEjercidoAnterior'] = $this->input->post("nPresupuestoEjercidoAnterior");
		$data['nPresupuestoAprobado'] = $this->input->post("nPresupuestoAprobado");
		$data['iEjerceRecursoRamo33'] = $this->input->post("iEjerceRecursoRamo33");
		$data['iEjerceRecursoRamo23'] = $this->input->post("iEjerceRecursoRamo23");
		$data['iEjerceRecursoConvenioSubsidio'] = $this->input->post("iEjerceRecursoConvenioSubsidio");
		$data['vEspecificar'] = $this->input->post("vEspecificar");
		
		//inicio de checks
		$data['iDiagnostico'] = (isset($_POST['iDiagnostico'])) ? 1 : 0;
		$data['iArbolProblemas'] = (isset($_POST["iArbolProblemas"])) ? 1 : 0;
		$data['iArbolObjetivos'] = (isset($_POST["iArbolObjetivos"])) ? 1 : 0;
		$data['iMIR'] = (isset($_POST["iMIR"])) ? 1 : 0;
		$data['iIdentificacion'] = (isset($_POST["iIdentificacion"])) ? 1 : 0;
		$data['iCalculoCobertura'] = (isset($_POST["iCalculoCobertura"])) ? 1 : 0;
		$data['iCriteriosFocalizacion'] = (isset($_POST["iCriteriosFocalizacion"])) ? 1 : 0;
		$data['iDescripcionIntervencion'] = (isset($_POST["iDescripcionIntervencion"])) ? 1 : 0;
		$data['iInformeEstudio'] = (isset($_POST["iInformeEstudio"])) ? 1 : 0;
		$data['iManualProceso'] = (isset($_POST["iManualProceso"])) ? 1 : 0;
		$data['iReglasOperacion'] = (isset($_POST["iReglasOperacion"])) ? 1 : 0;
		$data['iPadronBeneficiarios'] = (isset($_POST["iPadronBeneficiarios"])) ? 1 : 0;
		//fin de checks

		if(isset($_POST['iIdTipoEvaluacion'])){
			$data['iIdTipoEvaluacion'] = $this->input->post("iIdTipoEvaluacion");
		}else{
			$data['iIdTipoEvaluacion'] = 0;
		}


		if(isset($_POST['iIdTipoPP'])){
			$data['iIdTipoPP'] = $this->input->post("iIdTipoPP");
		}else{
			$data['iIdTipoPP'] = 0;
		}
		
		if(isset($_POST['iIdTipoFondo'])){
			$data['iIdTipoFondo'] = $this->input->post("iIdTipoFondo");
		}else{
			$data['iIdTipoFondo'] = 0;
		}

		$data['iPreviamenteEvaluado'] = $this->input->post("iPreviamenteEvaluado");
		$data['vComentario'] = $this->input->post("vComentario");
		$data['iIdUsuario'] = (int)$_SESSION[PREFIJO.'_idusuario'];
		
		$this->load->model('M_IntervencionPropuesta');

		if(isset($_POST['iIdIntervencionPropuesta'])){
			$data['iIdIntervencionPropuesta'] = $_POST['iIdIntervencionPropuesta'];
			if($this->M_IntervencionPropuesta->update($data) == true){
				$insert = 1;
			}else{
				$insert = 0;
			}
			$this->guardarCorresponsables($_POST['iIdIntervencionPropuesta']);
		}else{
			$data['dFechaCaptura'] = date('Y-m-d H:i:s');
			$insert = $this->M_IntervencionPropuesta->save($data);
			$this->guardarCorresponsables($insert);
		}
		//Falta mensaje de confirmación
		echo $insert;
	}

	private function guardarCorresponsables($key){
		$this->load->model('M_IntervencionPropuesta', 'mi');
		$data = $_SESSION['intervencion_corresponsables'];
		foreach($data as $r){
			$tmp = array();
			if($r->iActivo == 1){
				$tmp['iIdIntervencionPropuesta'] = $key;
				$tmp['iIdOrganismo'] = $r->iIdOrganismo;
				$this->mi->guardarCorresponsables($tmp);
			}else{
				$this->mi->deleteCorresponsable($key, $r->iIdOrganismo);
			}
		}
	}

	public function delete(){
		if(isset($_POST['id']) && !empty($_POST['id'])){
			$this->load->model('M_IntervencionPropuesta');
			echo $delete = $this->M_IntervencionPropuesta->delete($_POST['id']);
		}else{
			echo '0';
		}
	}

	public function AprobarIntervencion(){
		$this->load->model('M_IntervencionPropuesta');
		$r = $this->M_IntervencionPropuesta->GetRecord($_POST['id']);

		$data['vIntervencion'] = $r->vIntervencion;
		$data['vClave'] = $_POST['clave'];
		$data['iAnio'] = (int)date('Y');
		$data['iTipo'] = $r->iTipo;
		$data['iIdIntervencionPropuesta'] = $r->iIdIntervencionPropuesta;
		$data['iIdOrganismo'] = $r->iIdOrganismo;
		$this->load->model('M_Intervencion');
		$result = $this->M_Intervencion->save($data);
		if($result > 0){
			$delete = $this->M_IntervencionPropuesta->delete($_POST['id']);
			$vdata = $this->M_IntervencionPropuesta->cargarCorresponsable($r->iIdIntervencionPropuesta);
			foreach($vdata as $r){
				$tmp = array();
				$tmp['iIdIntervencion'] = $result;
				$tmp['iIdOrganismo'] = $r->iIdOrganismo;
				$this->M_IntervencionPropuesta->guardarIntervencionCorresponsable($tmp);
			}
		}
		echo $result;
	}
}