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
			$datos['eje'] = $this->M_IntervencionPropuesta->ejeQuery();
			$datos['tipoPP'] = $this->M_IntervencionPropuesta->tipoPPQuery();
			$datos['tipoEvaluacion'] = $this->M_IntervencionPropuesta->tipoEvaluacionQuery();
			$datos['organismo'] = $this->M_IntervencionPropuesta->GetOrganismo()[0];
			$this->load->view('IntervencionPropuesta/crud',$datos);
		}else $this->index();
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


	public function edit($id){
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			$this->load->model('M_IntervencionPropuesta');
			$datos['record'] = $this->M_IntervencionPropuesta->findRecord($id);
			$datos['eje'] = $this->M_IntervencionPropuesta->ejeQuery();
			$datos['tipoPP'] = $this->M_IntervencionPropuesta->tipoPPQuery();
			$datos['tipoEvaluacion'] = $this->M_IntervencionPropuesta->tipoEvaluacionQuery();
			$datos['organismo'] = $this->M_IntervencionPropuesta->GetOrganismoEdit($datos['record']->iIdOrganismo)[0];
			$datos['select'] = $this->M_IntervencionPropuesta->GetEje($datos['record']->iIdObjetivo);
			$this->load->view('IntervencionPropuesta/edit', $datos);
		}else $this->index();
		
	}

	public function dataEntry(){	
		
		$data['vIntervencion'] = $this->input->post("vIntervencion");
		$data['iAnioCreacion'] = $this->input->post("iAnioCreacion");
		$data['iAnioEvaluacion'] = $this->input->post("iAnioEvaluacion");
		$data['iTipo'] = $this->input->post("iTipo");
		$data['iIdTipoPP'] = $this->input->post("iIdTipoPP");
		$data['iEntregaBienServicio'] = $this->input->post("iEntregaBienServicio");
		$data['iIdOrganismo'] = $this->input->post("iIdOrganismo");
		$data['vAreaResponsable'] = $this->input->post("vAreaResponsable");
		$data['vObjetivo'] = $this->input->post("vObjetivo");
		$data['vPoblacionObjetivo'] = $this->input->post("vPoblacionObjetivo");
		$data['iIdObjetivo'] = $this->input->post("iIdObjetivo");
		//$data['iIdObjetivoPMP'] = $this->input->post("iIdObjetivoPMP");
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

		$data['iPreviamenteEvaluado'] = $this->input->post("iPreviamenteEvaluado");
		$data['iIdTipoEvaluacion'] = $this->input->post("iIdTipoEvaluacion");
		$data['vComentario'] = $this->input->post("vComentario");
		$data['iIdUsuario'] = (int)$_SESSION[PREFIJO.'_idusuario'];
		$data['dFechaCaptura'] = date('Y-m-d H:i:s');
		$data['iActivo'] = 1;
		
		$this->load->model('M_IntervencionPropuesta');

		if(isset($_POST['iIdIntervencionPropuesta'])){
			$data['iIdIntervencionPropuesta'] = $_POST['iIdIntervencionPropuesta'];
			$insert = $this->M_IntervencionPropuesta->update($data);
		}else{
			$insert = $this->M_IntervencionPropuesta->save($data);
		}
		
		
		//Falta mensaje de confirmación
		echo $insert;

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
		}
		echo $result;
	}
}