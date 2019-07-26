<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_asm extends CI_Controller{

    public function __construct(){
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_asm','ma');
    }

       
    public function display(){
/*         if(empty($_REQUEST['anio']) && empty($_REQUEST['origen']) && empty($_REQUEST['tipo']) && empty($_REQUEST['texto_busqueda'])){
            $vdata["plantilla"] = $this->mp->findAll();
        }else{
            $anio = $_REQUEST['anio'];
            $origen = $_REQUEST['origen'];
            $tipo = $_REQUEST['tipo'];
            $nombre = $_REQUEST['texto_busqueda'];
            $vdata["plantilla"] = $this->mp->filtro($anio, $origen, $tipo, $nombre);
        }
        */
        $vdata['anio'] = $this->ma->get_anio();
        $vdata['origen'] = $this->ma->get_origen();
        $vdata['tipoE'] = $this->ma->get_tipo(); 
        $vdata['eje'] = $this->ma->get_eje();
        $vdata['dependencia'] = $this->ma->get_intervencion();
        $vdata['tipoI'] = $this->ma->get_intervencionTipo();
        $vdata["asm"] = $this->ma->findAll();
        $this->load->view('asm/lista', $vdata);
    }

    public function tabla(){
/*         if(empty($_REQUEST['anio']) && empty($_REQUEST['origen']) && empty($_REQUEST['tipo']) && empty($_REQUEST['texto_busqueda'])){
           $vdata["plantilla"] = $this->mp->findAll();
       }else{
           $anio = $_REQUEST['anio'];
           $origen = $_REQUEST['origen'];
           $tipo = $_REQUEST['tipo'];
           $nombre = $_REQUEST['texto_busqueda'];
           $vdata["plantilla"] = $this->mp->filtro($anio, $origen, $tipo, $nombre);
       }  */
       $vdata["asm"] = $this->ma->findAll();
       $this->load->view('asm/tabla', $vdata);
   } 

    public function guardar_asm(){
        $vdata['eje'] = $this->ma->get_eje();
        $vdata['tipoI'] = $this->ma->get_intervencionTipo();
        $vdata['dependencia'] = $this->ma->get_intervencion();
        $vdata['programa'] = $this->ma->get_programa();
        $this->load->view('asm/guardar_asm', $vdata);        
    }

    public function drawIntervencion(){
       // $anio = null;
        $tipoI = null;
        $eje = null;
        $dependencia = null;
/* 
        if(!empty($_POST['anio']) && $_POST['anio'] != 'null'){
            $anio = $_POST['anio'];
        } */
        if(!empty($_POST['tipoI']) && $_POST['tipoI'] != '0'){
            $tipoI = $_POST['tipoI'];
        }
        if(!empty($_POST['dependencia']) && $_POST['dependencia'] != '0'){
            $dependencia = $_POST['dependencia'];
        }
        if(!empty($_POST['eje']) && $_POST['eje'] != '0'){
            $eje = $_POST['eje'];
        }
        echo $tipoI.$dependencia.$eje;
        $intervencion = $this->ma->get_programa($tipoI, $dependencia, $eje);
        $option = '<option value="0">Seleccionar</option>';
        foreach($intervencion as $r){
            $option .= "<option value='$r->iIdEvaluacion'>$r->vNombreEvaluacion</option>";
        }
        echo $option;
        //print_r($intervencion);
    }

    public function insertar_asm(){
        $data['vNombreASM'] = $this->input->post("nombre");
        $data['iAnioEvaluacion'] = $this->input->post("anio");
        $data['iPrioridad'] = $this->input->post("prioridad");
        $data['iClasificacion'] = $this->input->post("clasificacion");
        $data['iIdEvaluacion'] = $this->input->post("programa");
        $iIdASM = $this->ma->insert($data);
        echo $iIdASM;
    }

    public function modificar_asm($iIdASM = null){
        if(isset($iIdASM) && !empty($iIdASM)){
            $asm = $this->ma->find($iIdASM);
            
            $data['eje'] = $this->ma->get_eje();
            $data['tipoI'] = $this->ma->get_intervencionTipo();
            $data['dependencia'] = $this->ma->get_intervencion();

            $data['nombre'] = $asm->vNombreASM;
            $data['anio'] = $asm->iAnioEvaluacion;
            $data['prioridad'] = $this->ma->get_prioridad();
            $data['prioridad2'] = $asm->iPrioridad;
            $data['clasificiacion'] = $this->ma->get_clasificacion();
            $data['clasificiacion2'] = $asm->iClasificacion;
            $data['programa'] = $this->ma->get_programa();
            $data['programa2'] = $asm->iIdEvaluacion;
            $data['iIdASM'] = $asm->iIdASM;
            $this->load->view('asm/guardar_asm', $data);
            var_dump($data['programa2']);
        }
    }

    public function actualizar_asm($iIdASM){
        $iIdASM = $this->input->post('iIdASM');
        $data["vNombreASM"] =  $this->input->post("nombre");
        $data["iAnioEvaluacion"] =  $this->input->post("anio");
        $data["iPrioridad"] =  $this->input->post("prioridad");
        $data["iClasificacion"] =  $this->input->post("clasificacion");
        $data["iIdEvaluacion"] =  $this->input->post("programa");
        $aux = $this->ma->update($iIdASM, $data);
        echo $aux;
    }

    public function borrarAsm($iIdASM = null){
        echo $this->ma->delete($iIdASM);        
    }
}