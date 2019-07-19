<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_plantilla extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        $this->load->library('Class_seguridad');
        $this->load->model('M_plantilla','mp');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function index(){
         if(empty($_REQUEST['anio']) && empty($_REQUEST['origen']) && empty($_REQUEST['tipo']) && empty($_REQUEST['texto_busqueda'])){
            $vdata["plantilla"] = $this->mp->findAll();
        }else{
            $anio = $_REQUEST['anio'];
            $origen = $_REQUEST['origen'];
            $tipo = $_REQUEST['tipo'];
            $nombre = $_REQUEST['texto_busqueda'];
            $vdata["plantilla"] = $this->mp->filtro($anio, $origen, $tipo, $nombre);
        }
        
        $vdata['anio'] = $this->mp->get_anio();
        $vdata['origen'] = $this->mp->get_origen();
        $vdata['tipo'] = $this->mp->get_tipo();
        $vdata["plantilla"] = $this->mp->findAll();
        $this->load->view('plantilla/index', $vdata); 
    }

    public function tabla(){
         if(empty($_REQUEST['anio']) && empty($_REQUEST['origen']) && empty($_REQUEST['tipo']) && empty($_REQUEST['texto_busqueda'])){
            $vdata["plantilla"] = $this->mp->findAll();
        }else{
            $anio = $_REQUEST['anio'];
            $origen = $_REQUEST['origen'];
            $tipo = $_REQUEST['tipo'];
            $nombre = $_REQUEST['texto_busqueda'];
            $vdata["plantilla"] = $this->mp->filtro($anio, $origen, $tipo, $nombre);
        } 
        $this->load->view('plantilla/tabla', $vdata);
    } 

    public function guardar_cuestionario($iIdPlantilla = null, $vista = null){
        $vdata['tipoP'] = $this->mp->get_TipoPregunta();
        $vdata['id_plantilla'] = $iIdPlantilla;
        $this->load->view('plantilla/guardar_cuestionario', $vdata);
        
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
        }
        if($existe == false || $intervencion[$n]['activo'] == 0){
            $query = $this->mp->getRecord($_POST['intervencion']);
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
            echo 1;
        }else{
            echo 0;
        }
    }

    public function tempIntervencionCambio(){
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
        }
        if($existe == false || $intervencion[$n]['activo'] == 0){
            $query = $this->mp->getRecord($_POST['intervencion']);
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
    }

    private function GenerateTHead(){
        $thead = '<thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Clave</th>
                <th scope="col">Año</th>
                <th scope="col">Tipo</th>
                <th scope="col">Intervención Propuesta</th>
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
                    $ids = explode(",", $r['dependencia']);
                    $tcontent .= '<tr>';
                    $tcontent .=  '<td>'.$r['iIdIntervencion'].'</td>';
                    $tcontent .=  '<td>'.$r['vIntervencion'].'</td>';
                    $tcontent .=  '<td>'.$r['vClave'].'</td>';
                    $tcontent .=  '<td>'.$r['iAnio'].'</td>';
                    $tcontent .=  '<td>'.$r['iTipo'].'</td>';
                    $tcontent .=  '<td>'.' <select id="select'.$r['iIdIntervencion'].'" class="multiple-select2 form-control col-md-6" multiple="multiple" onchange="guardarCorresponsable('.$r['iIdIntervencion'].')">
                    <option value="0">Seleccionar</option>'.
                                $this->Select($vdata, $ids) .'
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

    private function Select($data, $ids=''){
        $option = '';
        foreach ($data as $row) {
            $selected = (in_array($row->iIdOrganismo, $ids)) ? 'selected' : '';
            $option .=  '<option '.$selected.' value="'.$row->iIdOrganismo.'">'.$row->vOrganismo.'</option>';
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
                $iIdPlantilla = $this->mp->insert($data);

                if($iIdPlantilla>0){
                    foreach($intervencion as $r){
                        $tmp['iIdPlantilla'] = $iIdPlantilla;
                        $tmp['iIdIntervencion'] = $r['iIdIntervencion'];
                        $tmp['vNombreEvaluacion'] = '';
                        $tmp['vObjetivo'] = '';
                        $tmp['vObjetivoEspecifico'] = ''; 
                        $tmp['vEspecificarOtro'] = '';
                        $tmp['vRutaArchivo'] = '';
                        $tmp['vComentarioGeneral'] = '';
                        $iIdEvaluacion = $this->mp->insertIntercencion($tmp);

                        $corresponsables = explode(",",$r{'dependencia'});

                        for ($i=0; $i < count($corresponsables) ; $i++) {
                            $datos = array('iIdEvaluacion' => $iIdEvaluacion, 'iIdOrganismo' => $corresponsables[$i],'vRutaArchivo' => '');
                            $this->mp->insertCorresponsables($datos);
                        }
                        echo $iIdEvaluacion;
                    }
                }
		}

    public function insertar_apartado(){    
        $data['iIdPlantilla'] = $this->input->post("id_plantilla");
        $data['vApartado'] = $this->input->post("nombre_apartado");
        $iIdPlantilla = $this->mp->insertApartado($data);
        echo $iIdPlantilla;
    }

    public function insertar_pregunta(){
        $data['iIdApartado'] = $this->input->post("id3");
        $data['vPregunta'] = $this->input->post("nombreP");
        $data['iIdTipoPregunta'] = $this->input->post("tipoPR");
        $iIdPlantilla = $this->mp->insertPregunta($data);
        echo $iIdPlantilla;
       // var_dump($iIdPlantilla);
    }
    
    public function borrar_registro($key){
        for ($i=0; $i < count($_SESSION['intervencion']); $i++) { 
            if($_SESSION['intervencion'][$i]['iIdIntervencion'] == $key) $_SESSION['intervencion'][$i]['activo'] = 0;
        }
        echo '1';
    }

    public function borrar_ajax($iIdPlantilla = null){
        echo $this->mp->delete($iIdPlantilla);        
    }

    public function borrar_apartado($iIdApartado = null){
        echo $this->mp->deleteApartado($iIdApartado);        
    }

    public function borrar_pregunta($iIdPregunta = null){
        echo $this->mp->deletePregunta($iIdPregunta);        
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

                $resultado = $this->mp->findEvaluacion($iIdPlantilla/* , $iIdEvaluacion */);
                //$otroresultado = $this->mp->EvaluacionCorresponsable($iIdIntervencion);
                $intervencion = null;
                foreach($resultado as $query){
                    $tmp['iIdIntervencion'] = $query->iIdIntervencion;
                    $tmp['vIntervencion'] = $query->vIntervencion;
                    $tmp['vClave'] = $query->vClave;
                    $tmp['iAnio'] = $query->iAnio;
                    $tmp['iTipo'] = $query->iTipo;
                    $tmp['iIdIntervencionPropuesta'] = $query->iIdIntervencionPropuesta;
                    $tmp['iIdOrganismo'] = $query->iIdOrganismo;
                    $tmp['dependencia'] = $this->devuelveIdsCorresponsables($query->iIdEvaluacion);
                    $tmp['activo'] = 1;
                    $intervencion[] = $tmp;
                }
                
                $_SESSION['intervencion'] = $intervencion;
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

                    $corresponsables = explode(",",$r['dependencia']);
                    
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
                        } else {
                        }
                    }
                }
            }
        }
    }

    function prueba(){
        $array = $this->input->post('corresponsables');
        $iIdIntervencion = $this->input->post('idintervencion');
        $intervencion = $_SESSION['intervencion'];
        $array = explode(',', $array);
        foreach($intervencion as $r){
            $r['dependencia'] = $array;
        }
        var_dump($r);
    }

    function devuelveIdsCorresponsables($iIdEvaluacion){
        $query = $this->mp->organismoCorresponsables($iIdEvaluacion);
        $ids = '';
        if($query){
            $query = $query->result();

            foreach ($query as $dato) {
                if($ids != '') $ids.= ',';
                $ids.= $dato->iIdOrganismo;
            }
        }

        return $ids;
    }

    public function guardarCorresponsable(){
        $idintervencion = $this->input->post('idintervencion');
        $dependencia = $this->input->post('corresponsables');

        for ($i=0; $i < count($_SESSION['intervencion']); $i++) { 
            if($_SESSION['intervencion'][$i]['iIdIntervencion'] == $idintervencion) $_SESSION['intervencion'][$i]['dependencia'] = $dependencia;
        }
    }

    public function GenerarApartado($id){
        //$iIdPlantilla = $data['id_plantilla'];
        $plantilla = $this->mp->find($id);
        $vdata = $this->mp->findApartado($plantilla->iIdPlantilla);
        $apartado = '';

        foreach($vdata as $r){
            $apartado .= '<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" title="Agregar pregunta"  data-toggle="modal" data-target="#myModal3" onclick="modal3('.$r->iIdApartado.')"><i class="fa fa-expand"></i></a>
                    <div id="id'.$r->iIdApartado.'" style="display:none">'.$r->iIdApartado.'</div>
                    <div id="'.$r->iIdApartado.'" style="display:none">'.$r->vApartado.'</div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"  title="Editar apartado"><i class="fa fa-redo" data-toggle="modal" data-target="#myModal2" onclick="modal2('.$r->iIdApartado.')" title="Editar"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"  title="Colapsar"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"  title="Eliminar apartado" onclick="deleteApartado('.$r->iIdApartado.')"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">'.$r->vApartado.'</h4>
            </div>
            <div class="panel-body">
                <div style="background-color:#f7f7f7;">
                    '.$this->GenerarTabla($r->iIdApartado).'
                </div>
            </div>
        </div>';
        }
        echo $apartado;
    }

    public function GenerarTabla($id){
        $table = '<table class="table table-striped table-bordered">'.$this->GenerarCabeza();
        $table .= $this->GenerarCuerpo($id).
        '</table>';
        return $table;
    }

    private function GenerarCabeza(){
        $thead = '<thead>
            <tr>
                <th scope="col">Pregunta</th>
                <th scope="col" WIDTH="200">Acciones</th>
            </tr>
        </thead>';
        return $thead;
    }

    private function GenerarCuerpo($id){
        $tbody = '<tbody>';
        $tbody .= $this->GenerarContenido($id);
        $tbody .= '</tbody>';
        return $tbody;
    }

    private function GenerarContenido($id){
        /* $plantilla = $this->mp->find($id);
        $data = $this->mp->findApartado($plantilla->iIdPlantilla); */
        $vdata = $this->mp->findPreguntas($id);
        $tcontent = '';
        
            foreach($vdata as $r){
                    $tcontent .= '<tr>';
                    $tcontent .=  '<td><div id="id2'.$r->iIdPregunta.'" style="display:none">'.$r->iIdPregunta.'</div> <div id="'.$r->iIdPregunta.'">'.$r->vPregunta.'</div> <div id="tipo'.$r->iIdPregunta.'" style="display:none">'.$r->iIdTipoPregunta.'</div> </td>';
                    $tcontent .=  '<td>'.'<button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#myModal" onclick="modal('.$r->iIdPregunta.')" title="Editar"><i class="fas fa-pencil-alt fa-fw"></i></button>
                    <button type="button" class="btn btn-danger btn-icon btn-sm" onclick="deletePregunta('.$r->iIdPregunta.')" title="Eliminar"><i class="fas fa-trash-alt fa-fw"></i></button></td>'; 
                    $tcontent .= '</tr>';
                }
        return $tcontent;
    }

    public function ActualizarApartado($iIdApartado){
        /*$apartado = $this->mp->findApartado($iIdApartado);
        $apartado = $r->iIdApartado;*/
        $iIdApartado = $this->input->post('id');
        $data["vApartado"] =  $this->input->post("nombre2");
        $aux = $this->mp->updateApartado($iIdApartado, $data);
        echo $aux;
        var_dump($data);
    }

    public function ActualizarPregunta($iIdPregunta){
        /*$apartado = $this->mp->findApartado($iIdApartado);
        $apartado = $r->iIdApartado;*/
        $iIdPregunta = $this->input->post('id2');
        $data["vPregunta"] =  $this->input->post("nombre");
        $data["iIdTipoPregunta"] =  $this->input->post("tipoP");
        $aux = $this->mp->updatePregunta($iIdPregunta, $data);
        echo $aux;
        var_dump($data);
    }
}