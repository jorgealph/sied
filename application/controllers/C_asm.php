<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_asm extends CI_Controller{

    public function __construct(){
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }

       
    public function display(){
        $data['tb'] = $this->generateTable();
        $this->load->view('asm/lista', $data);
    }

    public function drawTable(){

    }

    private function generateTable(){
        $tb = '';
        $tb = '<table id="data-table-default" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Año de evaluación</th>
                    <th>Nombre del ASM</th>
                    <th>Programa evaluado</th>
                    <th>Dependencia responsable</th>
                    <th>% Avance</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>';
        $document = '<script>
        $(document).ready(function() {
            TableManageDefault.init();
        });
    </script>';
        return $tb.$document;   
    }
    
    public function generateTableContent(){
        $tb = '<tr>';
        $data = array();
        foreach ($data as $r){
            $tb .= '<td></td>';
        }

        $tb .= '</tr>';
    }
}