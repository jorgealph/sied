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
			$datos['intpro'] = $this->M_IntervencionPropuesta->findAll();
			$datos['msg'] = $msg;
			$this->load->view('IntervencionPropuesta/lista',$datos);

		}else $this->index();
	}

	function mostrar_crud()
	{
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			$this->load->model('M_IntervencionPropuesta');
			$datos['intpro'] = $this->M_IntervencionPropuesta->findAll();
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

	public function temaQuery($id = null){
		
		$option = '<option value="">Seleccionar</option>';
		if($id != null){
			$this->load->model('M_IntervencionPropuesta');
			$tema = $this->M_IntervencionPropuesta->temaQuery($id);
		
			foreach($tema as $r){
				$option .= "<option value='$r->iIdPoliticaPublica'>$r->vPoliticaPublica</option>";
			}
		}
		echo $option;
	}

	public function objetivoQuery($id = null){
		$option = '<option value="">Seleccionar</option>';

		if($id != null){
			$this->load->model('M_IntervencionPropuesta');
			$tema = $this->M_IntervencionPropuesta->objetivoQuery($id);
			foreach($tema as $r){
				$option .= "<option value='$r->iIdObjetivo'>$r->vObjetivo</option>";
			}
		}
		echo $option;
	}

	public function test(){
		$this->load->model('M_IntervencionPropuesta');
		$tema = $this->M_IntervencionPropuesta->GetOrganismo();
		print_r($tema);
	}

	public function dataEntry(){
		
		$data['iIdIntervencionPropuesta'] = $this->input->post("iIdIntervencionPropuesta");
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
		$data['iDiagnostico'] = (isset($_REQUEST['iDiagnostico'])) ? 1 : 0;
		$data['iArbolProblemas'] = (isset($_REQUEST["iArbolProblemas"])) ? 1 : 0;
		$data['iArbolObjetivos'] = (isset($_REQUEST["iArbolObjetivos"])) ? 1 : 0;
		$data['iMIR'] = (isset($_REQUEST["iMIR"])) ? 1 : 0;
		$data['iIdentificacion'] = (isset($_REQUEST["iIdentificacion"])) ? 1 : 0;
		$data['iCalculoCobertura'] = (isset($_REQUEST["iCalculoCobertura"])) ? 1 : 0;
		$data['iCriteriosFocalizacion'] = (isset($_REQUEST["iCriteriosFocalizacion"])) ? 1 : 0;
		$data['iDescripcionIntervencion'] = (isset($_REQUEST["iDescripcionIntervencion"])) ? 1 : 0;
		$data['iInformeEstudio'] = (isset($_REQUEST["iInformeEstudio"])) ? 1 : 0;
		$data['iManualProceso'] = (isset($_REQUEST["iManualProceso"])) ? 1 : 0;
		$data['iReglasOperacion'] = (isset($_REQUEST["iReglasOperacion"])) ? 1 : 0;
		$data['iPadronBeneficiarios'] = (isset($_REQUEST["iPadronBeneficiarios"])) ? 1 : 0;
		//fin de checks

		$data['iPreviamenteEvaluado'] = $this->input->post("iPreviamenteEvaluado");
		$data['iIdTipoEvaluacion'] = $this->input->post("iIdTipoEvaluacion");
		$data['vComentario'] = $this->input->post("vComentario");
		$data['iIdUsuario'] = (int)$_SESSION[PREFIJO.'_idusuario'];
		$data['dFechaCaptura'] = date('Y-m-d H:i:s');
		$data['iActivo'] = 1;
		
		$this->load->model('M_IntervencionPropuesta');
		$insert = $this->M_IntervencionPropuesta->save($data);
		//Falta mensaje de confirmación
		
		if(is_numeric($insert)){
			$this->mostrar_vista('Registro exitoso');
		}
		
	}

	function validate(){
		$v = 1;
		echo (1 == $v) ? 1 : 0;
	}

}