<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_evaluacion extends CI_Controller{

    public function __construct(){
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }

    
    public function display(){
        $this->load->model('M_evaluacion', 'me');
        $this->load->model('M_plantilla', 'mp');
        $this->load->model('M_intervencionpropuesta', 'mi');
        $data['anio'] = $this->mp->get_anio();
        $data['tipo'] = $this->mp->get_tipo();
        $data['eje'] = $this->mi->ejeQuery();
        
        $this->load->view('evaluacion/index', $data);
    }

    public function getCargo(){
        $cargo = null;
        if(isset($_POST['usuario']) && !empty($_POST['usuario'])){
            $key = $_POST['usuario'];
            $this->load->model('M_evaluacion', 'me');
            $query = $this->me->getCargo($key);
            if(isset($query[0])){
                $cargo = $query[0]->vCargo;
            }
        }
        echo $cargo;
    }

    public function updateView($key){
        $this->load->model('M_evaluacion', 'me');
        $_SESSION['colaborador'] = null;
        $_SESSION['delete'] = null;
        $data['key'] = $key;
        $data['option'] = $this->getUsuario();
        $data['eva'] = $this->me->findEvaluacion($key)[0];
        $this->findColaborador($key);
        $this->load->view('evaluacion/viewUpdate', $data);
    }

    public function updateRecord(){
        $this->load->model('M_evaluacion', 'me');
        $data = array();
        $result = 0;
        $response = array();

        $key = $_POST['key'];
        $data['vNombreEvaluacion'] = $_POST['vNombreEvaluacion'];
        $data['dFechaInicio'] = $this->formatDate($_POST['dFechaInicio']);
        $data['dFechaFin'] = $this->formatDate($_POST['dFechaFin']);;
        $data['vObjetivo'] = $_POST['vObjetivo'];
        $data['vObjetivoEspecifico'] = $_POST['vObjetivoEspecifico'];
        $data['iEnvioOficio'] = $_POST['iEnvioOficio'];
        $data['dFechaRecepcionOficio'] = $this->formatDate($_POST['dFechaRecepcionOficio']);
        $data['iInformacionCompleta'] = $_POST['iInformacionCompleta'];
        $data['iIdUsuario'] = $_POST['iIdUsuario'];

        if ($this->validateData($key, $data) == true){
            $result = $this->me->update($data, $key);
            $response['result'] = $result;
        }

        $vdata = $_SESSION['colaborador'];

        if (!empty($vdata)){
            $tmp = $this->saveColaborador($key);

            $response['msg'] = $tmp['msg'];
            $response['usr'] = $tmp['usr'];
        }

        $response['supr'] = $this->delete($key);

        echo json_encode($response);
        //print_r($response);
    }

    private function validateData($key, $data){
        $valido = true;
        
        if(empty($key)){
            $valido = false;
        }
        if(empty($data['vNombreEvaluacion'])){
            $valido = false;
        }
        if(empty($data['dFechaInicio'])){
            $valido = false;
        }
        if(empty($data['dFechaFin'])){
            $valido = false;
        }
        if(empty($data['vObjetivo'])){
            $valido = false;
        }
        if(empty($data['vObjetivoEspecifico'])){
            $valido = false;
        }
        if($data['iEnvioOficio'] == null && $data['iEnvioOficio'] == ''){
            $valido = false;
        }
        if(empty($data['dFechaRecepcionOficio'])){
            $valido = false;
        }
        if($data['iInformacionCompleta'] == null && $data['iInformacionCompleta'] == ''){
            $valido = false;
        }
        if(empty($data['iIdUsuario'])){
            $valido = false;
        }
        return $valido;
    }

    private function formatDate($date){
        $fecha = explode('/', $date);
        $date = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        return $date;
    }

    public function drawTable(){
        $this->load->model('M_evaluacion', 'me');
        $tb = $this->generateTable($this->me->displayjoin());
        echo $tb; 
    }

    public function drawColaborador(){
        echo $this->tableColaborador();
    }

    private function generateTable($data){
        $tb = '';
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Tipo de intervención pública</th>
                    <th>Nombre de la intervención pública</th>
                    <th>Dependencia responsable</th>
                    <th>Origen de la evaluación</th>
                    <th>Tipo de evaluación</th>
                    <th width="120px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                '.$this->generateTableContent($data).'
            </tbody>
        </table>';
        $document = '<script>
            $(document).ready(function() {
                TableManageDefault.init();
            });
        </script>';
        return $tb.$document;   
    }

    public function addColaborador(){
        $data = array();
        //$_SESSION['colaborador'] = $data;
        $key = null;
        if (isset($_SESSION['colaborador']) && !empty($_SESSION['colaborador'])){
            $data = $_SESSION['colaborador'];
        }else{
            $_SESSION['colaborador'] = $data;
        }

        if (isset($_POST['key']) && !empty($_POST['key'])){
            $key = $_POST['key'];
            $this->load->model('M_evaluacion', 'me');
            if($this->findRecord($key) == false){
                $data[] = $this->me->getUsuario($key)[0];
                echo 1;
            }else{
                echo 0;
            }
        }
        $_SESSION['colaborador'] = $data;
    }

    public function removeColaborador(){
        $data = $_SESSION['colaborador'];
        if (isset($_POST['key']) && !empty($_POST['key'])){
            $key = $_POST['key'];
            $c = 0;
            foreach ($data as $r){
                if($r->iIdUsuario == $key){
                    $this->prepareDelete($data[$c]);
                    unset($data[$c]);
                    echo 1;
                    break;
                }
            }
        }
        $_SESSION['colaborador'] = $data;
    }

    private function prepareDelete($tmp){
        $existe = false;
        if(isset($_SESSION['delete']) && !empty($_SESSION['delete'])){
            $data = $_SESSION['delete'];
        }else{
            $data = array();
        }

        foreach ($data as $r){
            if($r->iIdUsuario == $tmp->iIdUsuario){
                $existe = true;
                break;
            }
        }

        if($existe == false){
            $data[] = $tmp;
        }
        
        $_SESSION['delete'] = $data;
    }

    private function delete($key){
        $this->load->model('M_evaluacion', 'me');
        $founded = false;
        $result = array();
        $data = $_SESSION['delete'];
        $vdata = $_SESSION['colaborador'];
        foreach($data as $r){
            foreach ($vdata as $vr){
                if ($r->iIdUsuario == $vr->iIdUsuario){
                    $founded = true;
                    break;
                }
            }
            if($founded == false){
                $response = $this->me->deleteColaborador($r->iIdUsuario, $key);

                if($response > 0){
                    $result[] = array('usuario' => $r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno);
                }

            }else{
                $founded = false;
            }
        }
        return $result;
    }

    private function findRecord($key){
        $data = $_SESSION['colaborador'];
        $existe = false;
        foreach($data as $r){
            if($r->iIdUsuario == $key){
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    private function getUsuario(){
        $this->load->model('M_evaluacion', 'me');
        $data = $this->me->getUsuario();
        $option = null;
        foreach($data as $r){
            $option .= '<option value="'.$r->iIdUsuario.'">'.$r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno.'</option>';
        }
        return $option;
    }
    
    private function generateTableContent($data){
        $tb = '';
        foreach ($data as $r){
            $tb .= '<tr>';
                $tb .= '<td>'.$this->gettipo($r->iTipo).'</td>';
                $tb .= '<td>'.$r->vIntervencion.'</td>';
                $tb .= '<td>'.$r->vOrganismo.'</td>';
                $tb .= '<td>'.$this->getOrigen($r->iOrigenEvaluacion).'</td>';
                $tb .= '<td>'.$r->vTipoEvaluacion.'</td>';
                $tb .= '<td>';
                    $tb .= '<button onclick="cargar(\'ver/evaluacion/'.$r->iIdEvaluacion.'\', \'#contenido\')" class="btn btn-default btn-icon btn-sm"><i class="fas fa-edit fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-default btn-icon btn-sm"><i class="fas fa-file fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-comments fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-copy fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="" class="btn btn-default btn-icon btn-sm"><i class="fas fa-paperclip fa-fw"></i></button>';
                $tb .= '</td>';
            $tb .= '</tr>';
        }
        return $tb;
    }

    private function gettipo($key){
        $origen = null;
        switch ($key) {
            case 1:
                $origen = 'Programa presupuestario';
                break;
            case 2:
                $origen = 'Fondo';
                break;
            case 3:
                $origen = 'Programa de bienes o servicios';
                break;
        }
        return $origen;
    }

    private function getOrigen($key){
        $origen = null;
        switch ($key) {
            case 1:
                $origen = 'Externa';
                break;
            case 2:
                $origen = 'Interna';
                break;
        }
        return $origen;
    }

    private function tableColaborador(){
        $tb = '';
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nombre completo</th>
                    <th>Cargo</th>
                    <th width="120px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                '.$this->generateColaboradorContent().'
            </tbody>
        </table>';
        $document = '<script>
            $(document).ready(function() {
                TableManageDefault.init();
            });
        </script>';
        return $tb.$document;  
    }

    private function findColaborador($key){
        $this->load->model('M_evaluacion', 'me');
        $query = $this->me->findColaborador($key);
        $data = array();
        foreach ($query as $r){
            $tmp = $this->me->getUsuario($r->iIdUsuario);
            if(isset($tmp[0])){
                $data[] = $tmp[0];
            }
        }
        $_SESSION['colaborador'] = $data;
    }

    private function generateColaboradorContent(){
        $tb = '';
        $data = array();
        
        if (isset($_SESSION['colaborador']) && !empty($_SESSION['colaborador'])){
            $data = $_SESSION['colaborador'];
        }
        foreach ($data as $r){
            $tb .= '<tr>';
                $tb .= '<td>'.$r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno.'</td>';
                $tb .= '<td>'.$r->vCargo.'</td>';
                $tb .= '<td>';
                    $tb .= '<button onclick="removeColaborador(\''.$r->iIdUsuario.'\')" class="btn btn-danger btn-icon btn-sm"><i class="fas fa-trash fa-fw"></i></button>';
                $tb .= '</td>';
            $tb .= '</tr>';
        }
        return $tb;
    }

    public function saveColaborador($key){
        $this->load->model('M_evaluacion', 'me');
        $data = $_SESSION['colaborador'];
        $result = array();
        foreach($data as $r){
            $tmp = array('iIdEvaluacion' => $key, 'iIdUsuario' => $r->iIdUsuario);
            $response = $this->me->addColaborador($tmp);
            if($response < 1){
                $result['msg'][] = array('usuario' => $r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno);
            }else{
                $result['usr'][] = array('usuario' => $r->vNombres.' '.$r->vApellidoPaterno.' '.$r->vApellidoMaterno);
            }
        }
        return $result;
        //print_r($result);
    }
}