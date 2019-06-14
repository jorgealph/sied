<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_plantilla extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_plantilla','mp');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function index(){
        $vdata['anio'] = $this->mp->get_anio();
        $vdata['origen'] = $this->mp->get_origen();
        $vdata['tipo'] = $this->mp->get_tipo();
        $vdata["plantilla"] = $this->mp->findAll();
        $this->load->view('plantilla/index', $vdata);

 /*        if(empty($_REQUEST['eje']) && empty($_REQUEST['organismo']) && empty($_REQUEST['texto_busqueda'])){
            $vdata["personas"] = $this->mp->findAll();
        }else{
            $eje = $_REQUEST['eje'];
            $organismo = $_REQUEST['organismo'];
            $siglas = $_REQUEST['texto_busqueda'];
            $vdata["personas"] = $this->mp->filtro($organismo, $eje, $siglas);
        }
        
        $vdata['eje'] = $this->mp->get_eje();
        $vdata['organismo'] = $this->mp->get_dependencia();
        $this->load->view('plantilla/index', $vdata); */
    }

    public function tabla(){
      /*   if(empty($_REQUEST['eje']) && empty($_REQUEST['organismo']) && empty($_REQUEST['texto_busqueda'])){
            $vdata["personas"] = $this->mp->findAll();
        }else{
            $eje = $_REQUEST['eje'];
            $organismo = $_REQUEST['organismo'];
            $siglas = $_REQUEST['texto_busqueda'];
            $vdata["personas"] = $this->mp->filtro($organismo, $eje, $siglas);
        } */
        $vdata["plantilla"] = $this->mp->findAll();
        $this->load->view('plantilla/tabla', $vdata);
    } 

    public function guardar_plantilla($plantilla_id = null, $vista = null){
        $vdata['anio'] = $this->mp->get_anio();
        $vdata['anio2'] = $this->mp->get_anio_intervencion();
        $vdata['eje'] = $this->mp->get_eje();
        $vdata['origen'] = $this->mp->get_origen();
        $vdata['tipo'] = $this->mp->get_tipo();
        $vdata['intervencion'] = $this->mp->get_intervencion();
        $vdata["plantilla"] = $this->mp->findAll();
        $this->load->view('plantilla/guardar_plantilla', $vdata);
    }

    public function drawIntervencion(){
        $anio = null;
        $organismo = null;
        $tipo = null;

        if(!empty($_POST['anio2']) && $_POST['anio2'] != 'null'){
            $anio = $_POST['anio2'];
        }
        if(!empty($_POST['dependencia']) && $_POST['dependencia'] != 'null'){
            $organismo = $_POST['dependencia'];
        }
        if(!empty($_POST['tipo']) && $_POST['tipo'] != 'null'){
            $tipo = $_POST['tipo'];
        }
        echo $anio.$organismo.$tipo;
        $intervencion = $this->mp->get_intervencion($anio, $organismo, $tipo);
        $option = '<option value="null">Seleccionar</option>';
        foreach($intervencion as $r){
            $option .= "<option value='$r->iIdIntervencion'>$r->vIntervencion</option>";
        }
        echo $option;
    }

    public function dropTable(){
        $_SESSION['intervencion'] = null;
    }

    public function tempIntervencion(){
        $intervencion = $_SESSION['intervencion'];

        $existe = false;

        if($intervencion == null){
            $intervencion = array();
        }else{
            foreach($intervencion as $r){
                if($r->iIdIntervencion == $_POST['intervencion']){
                    $existe = true;
                    break;
                }
            }
        }
        if($_POST['intervencion'] == 'null'){
            $existe = true;
        }
        if($existe == false){
            $intervencion[] = $this->mp->getRecord($_POST['intervencion']);
            $_SESSION['intervencion'] = $intervencion;
            echo 1;
        }else{
            echo 0;
        }
        
    }


    public function GenerateTable(){
        
        $table = '<table class="table table-striped table-bordered">'.$this->GenerateTHead().$this->GenerateTBody().'</table>';
        
        echo $table;
        
        //var_dump($_SESSION['intervencion']);
    }

    private function GenerateTHead(){
        $thead = '<thead>
            <tr>
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dependencia corresponsable</th>
            </tr>
        </thead>';
        return $thead;
    }

    private function GenerateTBody(){
        $tbody = '<tbody>';
        $tbody .= $this->GenerateTContent();
        $tbody .= '</tbody>';
        return $tbody;
    }

    private function GenerateTContent(){
        $tcontent = '';
        $intervencion = $_SESSION['intervencion'];
        if($intervencion != null){
            foreach($intervencion as $r){
                $tcontent .= '<tr>';
                $tcontent .=  '<td>'.$r->iIdIntervencion.'</td>';
                $tcontent .=  '<td>'.$r->vIntervencion.'</td>';
                $tcontent .=  '<td>'.'<select class="simple-select2-sm input-sm w-100" multiple>
                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                </optgroup>
                </select>';
                $tcontent .= '</tr>';
            }
            $tcontent .= ' <script>
                $(document).ready(function() {
                    $(\'.simple-select2\').select2({
                        theme: \'bootstrap4\',
                        placeholder: "Seleccionar",
                        allowClear: true
                    });
    
                    $(\'.simple-select2-sm\').select2({
                        theme: \'bootstrap4\',
                        containerCssClass: \':all:\',
                        placeholder: "Select an option",
                        allowClear: true
                    });
                });
            </script>';
        }
        return $tcontent;
    }

    public function insertar_plantilla(){
         if(isset($_POST['iIdPlantilla']) && !empty($_POST['iIdPlantilla']))
            $data['iIdPlantilla'] = $_POST['iIdPlantilla'];  
        $data["iIdPlantilla"] = 0;
        $iIdPlantilla = $this->input->post("nombre");
        $data['vPlantilla'] = $this->input->post("nombre");
        $data['iAnioEvaluacion'] = $this->input->post("anio");
        $data['iOrigenEvaluacion'] = $this->input->post("origen");
        $data['iIdTipoEvaluacion'] = $this->input->post("tipo");

        //if(isset($_POST['iIdPlantilla']) && !empty($_POST['iIdPlantilla'])){
			//$insert = $this->mp->update($data);
		//}else{
            if($iIdPlantilla > 0){
                echo $insert = $this->mp->update($data);
            }else{
                echo $insert = $this->mp->insert($data);
            }
	//	}
    }
}