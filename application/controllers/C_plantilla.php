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
        $_SESSION['intervencion'] = null;
        $_SESSION['intervencionC'] = null;
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
        //var_dump($_SESSION['intervencion']);

        $intervencion = $_SESSION['intervencion'];
        $iIdIntervencion = $this->input->post('intervencion');
        $n = 0;

        $existe = false;

        if($intervencion == null){
            $intervencion = array();
        }else{
            for ($i=0; $i < count($intervencion); $i++) { 
                if($intervencion[$i]['iIdIntervencion'] == $iIdIntervencion){
                    $existe = true;
                    $intervencion[$i]['activo'] = 1;
                    break;
                }

                $n = $i + 1;
            }
            $_SESSION['intervencion'] = $intervencion;
            
            /*foreach($intervencionC as $r){
                var_dump($r);
                if($r->iIdIntervencion == $_POST['intervencionC']){
                    $existe = true;
                    break;
                }
            }*/
        }
        /*if($_POST['intervencionC'] == 'null'){
            $existe = true;
        }*/
        if($existe == false || $intervencion[$n]['activo'] == 0){
            $query = $this->mp->getRecord($_POST['intervencion']);
            //$intervencionC = array();
            
            $intervencion[$n]['iIdIntervencion'] = $query->iIdIntervencion;
            $intervencion[$n]['vIntervencion'] = $query->vIntervencion;
            $intervencion[$n]['vClave'] = $query->vClave;
            $intervencion[$n]['iAnio'] = $query->iAnio;
            $intervencion[$n]['iTipo'] = $query->iTipo;
            $intervencion[$n]['iIdIntervencionPropuesta'] = $query->iIdIntervencionPropuesta;
            $intervencion[$n]['iIdOrganismo'] = $query->iIdOrganismo;
            $intervencion[$n]['dependencia'] = '';
            $intervencion[$n]['activo'] = 1;
           
            $_SESSION['intervencion'] = $intervencion;
            //var_dump($_SESSION['intervencion']);
            echo 1;
        }else{
            echo 0;
        }
    }

    public function tempIntervencionCambio(){
       // var_dump($_SESSION['intervencion']);

        $intervencion = $_SESSION['intervencion'];
        $iIdIntervencion = $this->input->post('intervencion');
        $n = 0;

        $existe = false;

        if($intervencion == null){
            $intervencion = array();
        }else{
            for ($i=0; $i < count($intervencion); $i++) { 
                if($intervencion[$i]['iIdIntervencion'] == $iIdIntervencion){
                    $existe = true;
                    break;
                }
                $n = $i + 1;
            }
            
            /*foreach($intervencionC as $r){
                var_dump($r);
                if($r->iIdIntervencion == $_POST['intervencionC']){
                    $existe = true;
                    break;
                }
            }*/
        }
        /*if($_POST['intervencionC'] == 'null'){
            $existe = true;
        }*/
        if($existe == false || $intervencion[$n]['activo'] == 0){
            $query = $this->mp->getRecord($_POST['intervencion']);
            //$intervencionC = array();
            
            $intervencion[$n]['iIdIntervencion'] = $query->iIdIntervencion;
            $intervencion[$n]['vIntervencion'] = $query->vIntervencion;
            $intervencion[$n]['vClave'] = $query->vClave;
            $intervencion[$n]['iAnio'] = $query->iAnio;
            $intervencion[$n]['iTipo'] = $query->iTipo;
            $intervencion[$n]['iIdIntervencionPropuesta'] = $query->iIdIntervencionPropuesta;
            $intervencion[$n]['iIdOrganismo'] = $query->iIdOrganismo;
            $intervencion[$n]['dependencia'] = '';
            $intervencion[$n]['activo'] = 1;
           
            $_SESSION['intervencion'] = $intervencion;
            //var_dump($_SESSION['intervencion']);
            echo 1;
        }else{
            echo 0;
        }
    }

    public function AgregarDependencias(){
        $intervencion = $_SESSION['intervencion'];
        foreach ($intervencion as $n) {
            $intervencion[$n]['dependencia'] = $select;
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
                <th scope="col">Clave</th>
                <th scope="col">Año</th>
                <th scope="col">Tipo</th>
                <th scope="col">Intervención Propuesta</th>
                <th scope="col">Dependencia Corresponsable</th>
                <th scope="col">Eliminar</th>
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
        $vdata = $this->mp->findOrganismoCarrito();
        $tcontent = '';
        $intervencion = $_SESSION['intervencion'];
        if($intervencion != null){
            foreach($intervencion as $r){
                if($r['activo'] == 1){
                    $tcontent .= '<tr>';
                $tcontent .=  '<td>'.$r['iIdIntervencion'].'</td>';
                $tcontent .=  '<td>'.$r['vIntervencion'].'</td>';
                $tcontent .=  '<td>'.$r['vClave'].'</td>';
                $tcontent .=  '<td>'.$r['iAnio'].'</td>';
                $tcontent .=  '<td>'.$r['iTipo'].'</td>';
                $tcontent .=  '<td>'.$r['iIdIntervencionPropuesta'].'</td>';
                $tcontent .=  '<td>'.' <select id="select'.$r['iIdIntervencion'].'" class="multiple-select2 form-control" multiple="multiple" onchange="guardarCorresponsable('.$r['iIdIntervencion'].')">
                <option value="0">Seleccionar</option>'.
                            $this->Select($vdata) .'
            </select>'.'</td>';
                $tcontent .=  '<td>'.'<button type="button" class="btn btn-danger btn-icon btn-sm" onclick="deleteRowIntervencion('.$r['iIdIntervencion'].')" title="Eliminar"><i class="fas fa-trash-alt fa-fw"></i></button>'; 
                $tcontent .= '</tr>';
                }
            }
            $tcontent .= ' <script>
                $(document).ready(function() {
                    $(".multiple-select2").select2({placeholder:"Selecciona una opción"})
                });
            </script>';
        }
        return $tcontent;
    }

    private function Select($data){
        $option = '';
        foreach ($data as $row) {
            $option .=  '<option value="'.$row->iIdOrganismo.'">'.$row->vOrganismo.'</option>';
         }
         return $option;
    }

    public function insertar_plantilla(){
         if(isset($_POST['iIdPlantilla']) && !empty($_POST['iIdPlantilla']))
            $data['iIdPlantilla'] = $_POST['iIdPlantilla'];  
        $data["iIdPlantilla"] = 0;
        $iIdPlantilla = $this->input->post("id_plantilla");
        $data['vPlantilla'] = $this->input->post("nombre");
        $data['iAnioEvaluacion'] = $this->input->post("anio");
        $data['iOrigenEvaluacion'] = $this->input->post("origen");
        $data['iIdTipoEvaluacion'] = $this->input->post("tipo");
        $intervencion = $_SESSION['intervencion'];
        //if(isset($_POST['iIdPlantilla']) && !empty($_POST['iIdPlantilla'])){
			//$insert = $this->mp->update($data);
		//}else{
            /* if($iIdPlantilla > 0){
                echo $insert = $this->mp->update($data);
            }else{ */
                $iIdPlantilla = $this->mp->insert($data);

                if($iIdPlantilla>0){
                    foreach($intervencion as $r){
                        $tmp['iIdPlantilla'] = $iIdPlantilla;
                        $tmp['iIdIntervencion'] = $r->iIdIntervencion;
                        $tmp['vNombreEvaluacion'] = '';
                        $tmp['vObjetivo'] = '';
                        $tmp['vObjetivoEspecifico'] = ''; 
                        $tmp['vEspecificarOtro'] = '';
                        $tmp['vRutaArchivo'] = '';
                        $tmp['vComentarioGeneral'] = '';
                        echo $insert = $this->mp->insertIntercencion($tmp);
                    }
                }
            //}
		}
    //}
    
    public function borrar_registro($key){

        //$_SESSION['intervencion'];        
        for ($i=0; $i < count($_SESSION['intervencion']); $i++) { 
            if($_SESSION['intervencion'][$i]['iIdIntervencion'] == $key) $_SESSION['intervencion'][$i]['activo'] = 0;
        }
        
        echo '1';
    }

    public function borrar_ajax($iIdPlantilla = null){
        echo $this->mp->delete($iIdPlantilla);        
    }

    public function modificar_plantilla($iIdPlantilla = null, $vista = null){
        if(isset($iIdPlantilla) && !empty($iIdPlantilla)){
            $plantilla = $this->mp->find($iIdPlantilla);

            if(isset($plantilla)){
                $data['nombre'] = $plantilla->vPlantilla;
                $data['anio'] = $this->mp->get_anio();
                $data['buscar'] = $plantilla->iAnioEvaluacion;
                $data['anio2'] = $this->mp->get_anio_intervencion();
                $data['origen'] = $this->mp->get_origen();
                $data['origen2'] = $plantilla->iOrigenEvaluacion;
                $data['tipo'] = $this->mp->get_tipo();
                $data['tipo2'] = $plantilla->iIdTipoEvaluacion;
                $data['iIdPlantilla'] = $plantilla->iIdPlantilla;
                $data['eje'] = $this->mp->get_eje();

                //$_SESSION['intervencion'] = $this->mp->findEvaluacion();
                $resultado = $this->mp->findEvaluacion($iIdPlantilla);
                $intervencion = null;
                foreach($resultado as $query){
                    $tmp['iIdIntervencion'] = $query->iIdIntervencion;
                    $tmp['vIntervencion'] = $query->vIntervencion;
                    $tmp['vClave'] = $query->vClave;
                    $tmp['iAnio'] = $query->iAnio;
                    $tmp['iTipo'] = $query->iTipo;
                    $tmp['iIdIntervencionPropuesta'] = $query->iIdIntervencionPropuesta;
                    $tmp['iIdOrganismo'] = $query->iIdOrganismo;
                    $tmp['activo'] = 1;
                    $intervencion[] = $tmp;
                }
                
                $_SESSION['intervencion'] = $intervencion;
                //$data['tabla'] = $this->GenerateTable();
                //print_r($intervencion);
                $this->load->view('plantilla/guardar_plantilla', $data);
            }
        }
    }

    public function ActualizarPlantilla($iIdPlantilla){
        $intervencion = $_SESSION['intervencion'];
        //$intervencionC = $_SESSION['intervencionC'];
        $iIdPlantilla = $this->input->post("id_plantilla");
        $data["vPlantilla"] = $this->input->post("nombre");
        $data["iAnioEvaluacion"] = $this->input->post("anio");
        $data["iOrigenEvaluacion"] = $this->input->post("origen");
        $data["iIdTipoEvaluacion"] = $this->input->post("tipo");
        
        if(isset($iIdPlantilla) && !empty($iIdPlantilla)){
            $aux = $this->mp->update($iIdPlantilla, $data);
            if($iIdPlantilla>0){
                foreach($intervencion as $r){
                   // var_dump($r);
                     if(isset($r['iIdIntervencion']) && $r['activo'] == 0){
                        echo $insert = $this->mp->deleteEvaluacion($iIdPlantilla, $r['iIdIntervencion']);
                    }
                    if(isset($r['iIdIntervencion']) && $r['activo'] == 1){

                        if($this->mp->ValidaExisteEvaluacion($iIdPlantilla, $r['iIdIntervencion']) == 0){
                            $tmp['iIdPlantilla'] = $iIdPlantilla;
                            $tmp['iIdIntervencion'] = $r['iIdIntervencion'];
                            $tmp['vNombreEvaluacion'] = '';
                            $tmp['vObjetivo'] = '';
                            $tmp['vObjetivoEspecifico'] = ''; 
                            $tmp['vEspecificarOtro'] = '';
                            $tmp['vRutaArchivo'] = '';
                            $tmp['vComentarioGeneral'] = '';
                            echo $insert = $this->mp->insertIntercencion($tmp);
                        }
                    }
                }
            }
        }
    }

    function prueba(){
        $array = $this->input->post('corresponsables');

        $array = explode(',', $array);
        var_dump($array);
    }
}   