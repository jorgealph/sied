<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_usuario extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_usuario','mu');
        $this->load->helper('form');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('Class_options');
    }

    public function listado(){

        if(empty($_REQUEST['eje']) && empty($_REQUEST['organismo']) && empty($_REQUEST['texto_busqueda'])){
            $vdata["personas"] = $this->mu->findAll();
        }else{
            $eje = $_REQUEST['eje'];
            $organismo = $_REQUEST['organismo'];
            $siglas = $_REQUEST['texto_busqueda'];
            $vdata["personas"] = $this->mu->filtro($organismo, $eje, $siglas);
        }
        
        $vdata['eje'] = $this->mu->get_eje();
        $vdata['organismo'] = $this->mu->get_dependencia();
        $this->load->view('usuarios/listado_usuario', $vdata);
    }

    public function tabla(){
        if(empty($_REQUEST['eje']) && empty($_REQUEST['organismo']) && empty($_REQUEST['texto_busqueda'])){
            $vdata["personas"] = $this->mu->findAll();
        }else{
            $eje = $_REQUEST['eje'];
            $organismo = $_REQUEST['organismo'];
            $siglas = $_REQUEST['texto_busqueda'];
            $vdata["personas"] = $this->mu->filtro($organismo, $eje, $siglas);
        }
        
        $this->load->view('usuarios/tabla', $vdata);
    }

     public function guardar($persona_id = null, $vista = null)
     {
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|max_length[100]');
       // $this->form_validation->set_rules('contrasenia', 'Contraseña (8 caracteres mínimo)', 'required|min_length[8]');
      //  $this->form_validation->set_rules('confirmar', 'Confirmar contraseña', 'required|matches[contrasenia]');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|max_length[100]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('paterno', 'Apellido paterno', 'required|max_length[100]');
        $this->form_validation->set_rules('materno', 'Apellido materno', 'required|max_length[100]');
        $this->form_validation->set_rules('correo1', 'Correo principal', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('correo2', 'Correo secundario', 'valid_email|max_length[100]');
       // $this->form_validation->set_rules('telefono', 'Telefono', 'required|max_length[100]'); 
        $this->form_validation->set_rules('cargo', 'Cargo', 'required|max_length[100]');
        $this->form_validation->set_rules('celular', 'Celular', 'required|max_length[100]'); 

        $error = $vdata["contrasenia"] = $vdata["usuario"] = $vdata["titulo"] = $vdata["nombre"] =  $vdata["paterno"] =  $vdata["materno"] = $vdata["correo1"] = $vdata["correo2"] = $vdata["telefono"] = $vdata["cargo"] = $vdata["celular"] = "";
        $vdata["id_usuario"] = 0;

        if(isset($persona_id) && !empty($persona_id)){
            
            $persona = $this->mu->find($persona_id);
            //var_dump($persona);
            if(isset($persona)){
                $vdata["id_usuario"] = $persona_id;
                $vdata["usuario"] = $persona->vUsuario;
                $vdata["contrasenia"] = sha1($persona->vPassword);
                $vdata["titulo"] = $persona->vTitulo;
                $vdata["nombre"] = $persona->vNombres;
                $vdata["paterno"] = $persona->vApellidoPaterno;
                $vdata["materno"] = $persona->vApellidoMaterno;
                $vdata["correo1"] = $persona->vCorreo1;
                $vdata["correo2"] = $persona->vCorreo2;
                $vdata["telefono"] = $persona->vTelefono;
                $vdata["cargo"] = $persona->vCargo;
                $vdata["celular"] = $persona->vCelular; // iIdOrganismo  iIdRol
                $vdata['organismo'] = $this->mu->get_organismo();
                $vdata["organismo2"] = $persona->iIdOrganismo;
                $vdata["rol"] = $this->mu->get_rol();
                $vdata["rol2"] = $persona->iIdRol;
            }
        }
      
        //if($this->input->server("REQUEST_METHOD") == "POST"){
        if(isset($_POST['id_usuario'])){
            //echo "POST";
            $persona_id = $this->input->post('id_usuario');
            $data["vUsuario"] = $this->input->post("usuario");
            $data["vTitulo"] = $this->input->post("titulo");
            $data["vNombres"] = $this->input->post("nombre");
            $data["vApellidoPaterno"] = $this->input->post("paterno");
            $data["vApellidoMaterno"] = $this->input->post("materno");
            $data["vCorreo1"] = $this->input->post("correo1");
            $data["vCorreo2"] = $this->input->post("correo2");
            $data["vTelefono"] = $this->input->post("telefono");
            $data["vCargo"] = $this->input->post("cargo");
            $data["vCelular"] = $this->input->post("celular");
            $data["iIdOrganismo"] = $this->input->post("organismo");
            $data["iIdRol"] = $this->input->post("rol");

            if ($this->form_validation->run()) {
                if($persona_id > 0){
                   // $this->load->view('usuarios/editar_usuario', $vdata);
                    $this->mu->update($persona_id, $data);
                }else{
                    $data["vPassword"] = sha1($this->input->post("contrasenia"));
                    // $this->load->view('usuarios/capturar_usuario', $vdata);
                    $persona_id =  $this->mu->insert($data);
                } 
                //$error = $this->do_upload($persona_id);
                if($error === ""){
                    echo 1;
                }           
            } else{
                echo 'NO';
            }
        }else $vdata["rol2"] = 0;
        
        if($vista>0){
            $options = new Class_options();
            $vdata['options_roles'] = $options->options_tabla('roles', $vdata["rol2"]);

            if($persona_id > 0){
                $vdata['organismo'] = $this->mu->get_dependencia();
                $this->load->view('usuarios/editar_usuario', $vdata); 
            }else {
                $vdata["error"] = $error;
                $vdata['eje'] = $this->mu->get_eje();
                $vdata['organismo'] = $this->mu->get_dependencia();
                $this->load->view('usuarios/capturar_usuario', $vdata);
            }
        }
    }

    public function ver($persona_id = null){
        if(!isset($persona_id)){
            show_404();
        }

        $persona = $this->mu->find($persona_id);
        if(!isset($persona)){
            show_404();
        }

        if(isset($persona)){
            $vdata["id_usuario"] = $persona_id;
            $vdata["usuario"] = $persona->vUsuario;
            $vdata["contrasenia"] = $persona->vPassword;
            $vdata["titulo"] = $persona->vTitulo;
            $vdata["nombre"] = $persona->vNombres;
            $vdata["paterno"] = $persona->vApellidoPaterno;
            $vdata["materno"] = $persona->vApellidoMaterno;
            $vdata["correo1"] = $persona->vCorreo1;
            $vdata["correo2"] = $persona->vCorreo2;
            $vdata["telefono"] = $persona->vTelefono;
            $vdata["cargo"] = $persona->vCargo;
            $vdata["celular"] = $persona->vCelular;
            $vdata["organismo"] = $persona->iIdOrganismo;
            $vdata["rol"] = $persona->iIdRol;
        }else{
            $vdata["usuario"] = $vdata["contrasenia"] = $vdata["titulo"] = $vdata["nombre"] =  $vdata["paterno"] =  $vdata["materno"] = $vdata["correo1"] = $vdata["correo2"] = $vdata["telefono"] = $vdata["cargo"] = $vdata["celular"] = "";
        }
/*         if(isset($_POST['id_usuario'])){
            $data["vPassword"] = sha1($this->input->post("contrasenia"));
           // $vdata["contrasenia"] = $persona->vPassword;
            
            if ($this->form_validation->run()) {
                if($persona_id > 0){
                    $this->mu->cambiar_contrasenia($persona_id, $data);
                    $this->load->view('usuarios/listado', $vdata);
                }
            }
        } */
        $this->load->view('usuarios/ver_usuario', $vdata);
    }


    public function borrar($persona_id = null){
        $this->mu->delete($persona_id);
        redirect("/usuarios/listado_usuario");
    }

    public function borrar_ajax($persona_id = null){
        echo $this->mu->delete($persona_id);        
    }
    
    public function cambiar_contra($persona_id = null, $vista = null){
        $this->form_validation->set_rules('contrasenia', 'Contraseña (8 caracteres mínimo)', 'required|min_length[8]');
        $this->form_validation->set_rules('confirmar', 'Confirmar contraseña', 'required|matches[contrasenia]');
        if(isset($_POST['id_usuario'])){
            $persona_id = $this->input->post('id_usuario');
            $data["vPassword"] = sha1($this->input->post("contrasenia"));
           // $vdata["contrasenia"] = $persona->vPassword;
            
            if ($this->form_validation->run()) {
                if($persona_id > 0){
                   // $this->load->view('usuarios/editar_usuario', $vdata);
                    echo $this->mu->cambiar_contrasenia($persona_id, $data);
                }
            }
        }
        //$this->load->view('usuarios/ver_usuario', $vdata);

    }
 
}