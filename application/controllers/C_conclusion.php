<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_conclusion extends CI_Controller{

    public function __construct(){
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }

    public function capturar_conclusiones($key){
        $this->load->model('M_conclusion', 'mc');
        $data['key'] = $key;
        $data['apartado'] = $this->crear_select($this->mc->obtener_apartados($key), '-SELECCIONE UN APARTADO-');
        $data['tipo'] = $this->crear_select($this->mc->obtener_tipo(), '-SELECCIONE UN TIPO-');
        $data['tb'] = $this->generateTable($key);
        $this->load->view('conclusion/vista_conclusion', $data);
    }

    public function addConclusion(){
        if(!empty($_POST)){
            $this->load->model('M_conclusion', 'mc');
            $data['iIdEvaluacion'] = $_POST['key'];
            $data['iIdPregunta'] = $_POST['iIdPregunta'];
            $data['vConclusion'] = $_POST['vConclusion'];
            $data['vRecomendacion'] = $_POST['vRecomendacion'];
            $data['vObservacion'] = '';
            $data['vFuenteInformacion'] = '';
            $data['iTipoConclusion'] = $_POST['iIdTipoConclusion'];
            $data['iASM'] = '';
            $data['vJustificacionASM'] = '';
            echo $this->mc->dataEntry($data);
        }else{
            echo 0;
        }
    }

    public function crear_select($data, $default){
        $option = '<option value="">'.$default.'</option>';
        foreach($data as $r){
            $option .= '<option value="'.$r->id.'">'.$r->value.'</option>';
        }
        return $option;
    }

    public function obtener_preguntas(){
        $this->load->model('M_conclusion', 'mc');
        $key = $_POST['key'];
        $default = '-SELECCIONE UNA PREGUNTA-';
        $data = $this->crear_select($this->mc->obtener_preguntas($key), $default);
        echo $data;
        print_r($_POST);
    }

    public function generateTable($key = null, $print = null){
        $data = array();
        if(!is_null($key)){
            $this->load->model('M_conclusion', 'mc');
        }
        $data = $this->mc->displayJoin($key);
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Apartado</th>
                    <th>Pregunta</th>
                    <th>Conclusión</th>
                    <th>Recomendación</th>
                    <th>Tipo</th>
                    <th>ASM</th>
                    <th width="100x">Acciones</th>
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
        if(is_null($print)){
            return $tb.$document;
        }else{
            echo $tb.$document;
        }
    }

    private function generateTableContent($data){
        $tb = '';
        foreach($data as $r){
            $tb .= '<tr>';
                $tb .= '<td>'.$r->vApartado.'</td>';
                $tb .= '<td>'.$r->vPregunta.'</td>';
                $tb .= '<td>'.$r->vConclusion.'</td>';
                $tb .= '<td>'.$r->vRecomendacion.'</td>';
                $tb .= '<td>'.$r->vTipoConclusion.'</td>';
                $tb .= '<td>
                            <div class="checkbox checkbox-css">
                                <input type="checkbox" id="chk'.$r->iIdConclusion.'" onchange="doSomething(this, '.$r->iIdConclusion.')" '.$this->checked($r->iASM).'/>
                                <label for="chk'.$r->iIdConclusion.'"></label>
                            </div>
                        </td>';
                $tb .= '<td>';
                    $tb .= '<button onclick="selectRecord('.$r->iIdConclusion.')" type="button" class="btn btn-success btn-icon btn-sm"><i class="fas fa-edit fa-fw"></i></button>&nbsp;';
                    $tb .= '<button onclick="deleteRecord('.$r->iIdConclusion.')" type="button" class="btn btn-danger btn-icon btn-sm"><i class="fas fa-trash fa-fw"></i></button>';
                $tb .= '</td>';
            $tb .= '</tr>';
        }
        return $tb;
    }

    private function checked($var){
        if($var == 0){
            return '';
        }else{
            return 'checked';
        }
    }

    public function findRecord(){
        $this->load->model('M_conclusion', 'mc');
        if(!empty($_POST)){
            $key = $_POST['key'];
            $data = $this->mc->select($key);
            if(isset($data[0])){
                echo json_encode($data[0]);
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }

    public function actualizar_asm(){
        if(!empty($_POST)){
            $this->load->model('M_conclusion', 'mc');
            $data['iASM'] = $_POST['iASM'];
            $key = $_POST['key'];
            echo $this->mc->updateRecord($data, $key);
        }else{
            echo 0;
        }
    }

    public function updateConclusion(){
        if(!empty($_POST)){
            $this->load->model('M_conclusion', 'mc');
            $key = $_POST['key'];
            $data['iIdPregunta'] = $_POST['iIdPregunta'];
            $data['vConclusion'] = $_POST['vConclusion'];
            $data['vRecomendacion'] = $_POST['vRecomendacion'];
            $data['iTipoConclusion'] = $_POST['iIdTipoConclusion'];
            echo $this->mc->updateRecord($data, $key);
        }else{
            echo 0;
        }
    }

    public function deleteRecord(){
        if(!empty($_POST)){
            $this->load->model('M_conclusion', 'mc');
            $data['iActivo'] = 0;
            $key = $_POST['key'];
            echo $this->mc->updateRecord($data, $key);
        }else{
            echo 0;
        }
    }
}