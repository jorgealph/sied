<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_intervencionpropuesta extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }

    function mostrar_vista()
	{
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			$this->load->model('M_intervencionpropuesta');
			$datos['intpro'] = $this->M_intervencionpropuesta->findAll();
			$this->load->view('intervensionpropuesta/lista',$datos);

		}else $this->index();
	}

	function mostrar_crud()
	{
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			$this->load->model('M_intervencionpropuesta');
			$datos['intpro'] = $this->M_intervencionpropuesta->findAll();
			$datos['eje'] = $this->M_intervencionpropuesta->ejeQuery();
			$this->load->view('intervensionpropuesta/crud',$datos);
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
			$this->load->model('M_intervencionpropuesta');
			$tema = $this->M_intervencionpropuesta->temaQuery($id);
		
			foreach($tema as $r){
				$option .= "<option value='$r->iIdPoliticaPublica'>$r->vPoliticaPublica</option>";
			}
		}
		echo $option;
	}

	public function objetivoQuery($id = null){
		$option = '<option value="">Seleccionar</option>';

		if($id != null){
			$this->load->model('M_intervencionpropuesta');
			$tema = $this->M_intervencionpropuesta->objetivoQuery($id);
			foreach($tema as $r){
				$option .= "<option value='$r->iIdObjetivo'>$r->vObjetivo</option>";
			}
		}
		echo $option;
		
	}
	
}