<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_organismo extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        $this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_organismo','mo');
    }


    public function index()
    {
        $this->load->library('Class_options');
        $cls_opts = new Class_options();
        $datos['options_eje'] = $cls_opts->options_tabla('ejes');            
        $datos['tabla_registros'] = $this->listar_organismos();
        
        $this->load->view('organismo/index',$datos);
    }

    function buscar(){
        if(isset($_POST['texto_busqueda']))
        {
            $where = array();
            $like = $this->input->post('texto_busqueda');
            if($this->input->post('iIdEje') > 0) $where['o.iIdEje'] = $this->input->post('iIdEje');
            $pag = $this->input->post('pag');

            echo $this->listar_organismos($where,$like,$pag);
        }
    }

    function listar_organismos($where=array(),$like='',$pag=1)
    {
        $query = $this->mo->buscar_organismo($where,$like);
                
        $tabla = '<p>No se encontraron registros para mostrar.</p>';
        //var_dump($datos);
        if($query->num_rows() > 0)
        {
            $tabla = '<div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabla_registros">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Organismo</th>
                                <th>Siglas</th>
                                <th>Titular</th>
                                <th width="200px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>';

            
            $registros = $query->result();
            foreach ($registros as $registro) {
                $acciones = '<button type="button" class="btn btn-grey btn-icon btn-sm" onclick="capturar('.$registro->iIdOrganismo.')" title="Editar" ><i class="fas fa-pencil-alt fa-fw"></i></button>&nbsp;';
                $acciones.=  '<button type="button" class="btn btn-danger btn-icon btn-sm" onclick="confirmar(\'¿Desea eliminar este registro?\',eliminar,'.$registro->iIdOrganismo.');" title="Eliminar" ><i class="fas fa-trash-alt fa-fw"></i></button>';
                $tabla.= "<tr>
                        <td>{$registro->iIdOrganismo}</td>
                        <td>{$registro->vOrganismo}</td>
                        <td>{$registro->vSiglas}</td>
                        <td>{$registro->vNombreTitular}</td>                        
                        <td>$acciones</td>
                    </tr>";
                    
            } 
            $tabla .= '</tbody>
                    </table>
                </div>';

            $tabla .= '<script>
                page = '.$pag.';
                $(document).ready(function(){
                    table = $(\'#tabla_registros\').DataTable({
                        responsive: true,
                        searching: false,
                        lengthChange: false
                    });

                    table.page(page).draw(\'page\');
                });            
                </script>';

            return $tabla;
        }
        else
        {
            return 'Sin resultados para mostrar.';
        }
    }

    function eliminar()
    {
        if(isset($_POST['id']) && !empty($_POST['id']))
        {
            $this->load->model('M_seguridad');
            $m_seg = new M_seguridad();
            $where['iIdOrganismo'] = $this->input->post('id');

            if($m_seg->desactivar_registro('organismo',$where)) echo '0';
            else echo 'El registro no pudo ser eliminado';
        }else echo '<p>Acceso denegado</p>';
    }

    function capturar()
    {
        if(isset($_POST['id']))
        {
            $id_usuario = $this->input->post('id');
            if($id_usuario > 0)
            {
                $registro = $this->mo->datos_captura($id_usuario);

                foreach ($registro as $campo => $valor)
                {
                    $datos[$campo] = $valor;
                }
            }
            else
            {
                $query = $this->mo->campos_tabla();
                if($query)
                {
                    $query = $query->result();
                    foreach ($query as $registro)
                    {
                        $datos[$registro->Field] = $registro->Default;
                    }
                }   
            }

            $this->load->library('Class_options');
            $cls_opts = new Class_options();
            $datos['options_eje'] = $cls_opts->options_tabla('ejes',$datos['iIdEje']);
            $datos['options_poder'] = $cls_opts->options_tabla('poderes',$datos['iIdPoder']);
            $datos['options_ambito'] = $cls_opts->options_tabla('ambitos',$datos['iIdAmbito']);
            
            $this->load->view('organismo/capturar',$datos);
        }
    }

    public function guardar()
    {
        if($_POST)
        {
            $this->load->model('M_seguridad');
            $mseg = new M_seguridad();
            $iIdOrganismo = $this->input->post('iIdOrganismo');

            $datos['vOrganismo'] = $this->input->post('vOrganismo');
            $datos['vSiglas'] = $this->input->post('vSiglas');
            $datos['vNombreTitular'] = $this->input->post('vNombreTitular');
            $datos['vNombreEnlace'] = $this->input->post('vNombreEnlace');
            $datos['vCorreoContacto'] = $this->input->post('vCorreoContacto');
            $datos['iIdEje'] = $this->input->post('iIdEje');

            if($iIdOrganismo > 0)
            {
                $where['iIdOrganismo'] = $iIdOrganismo;
                $iIdOrganismo = $mseg->actualizar_registro('organismo',$where,$datos);
                echo "0";
            }
            else
            {
                $iIdOrganismo = $mseg->insertar_registro('organismo',$datos);
                echo "0";
            }
        }
    }
}