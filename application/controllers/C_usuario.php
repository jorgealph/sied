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
    }
  /*   public function directorio()
	{
        $usuario=$this->mu->find();
		$this->load->view('usuarios/capturar_usuario');
    } */
    public function index(){
        redirect("/usuarios/listado_usuario");
    }

    public function listado(){
        $vdata["personas"] = $this->mu->findAll();
        $this->load->view('usuarios/listado_usuario', $vdata);
    }

     public function guardar($persona_id = null, $vista = null)
     {
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|max_length[100]');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required|max_length[100]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[100]');
        $this->form_validation->set_rules('paterno', 'Paterno', 'required|max_length[100]');
        $this->form_validation->set_rules('materno', 'Materno', 'required|max_length[100]');
        $this->form_validation->set_rules('correo1', 'Correo1', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('correo2', 'Correo2', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|max_length[100]'); 
        $this->form_validation->set_rules('cargo', 'Cargo', 'required|max_length[100]');
        $this->form_validation->set_rules('celular', 'Celular', 'required|max_length[100]'); 

        $error = $vdata["usuario"] = $vdata["titulo"] = $vdata["nombre"] =  $vdata["paterno"] =  $vdata["materno"] = $vdata["correo1"] = $vdata["correo2"] = $vdata["telefono"] = $vdata["cargo"] = $vdata["celular"] = "";
        $vdata["id_usuario"] = 0;

        if(isset($persona_id) && !empty($persona_id)){
            
            
            $persona = $this->mu->find($persona_id);
            //var_dump($persona);
            if(isset($persona)){
                $vdata["id_usuario"] = $persona_id;
                $vdata["usuario"] = $persona->vUsuario;
                $vdata["titulo"] = $persona->vTitulo;
                $vdata["nombre"] = $persona->vNombres;
                $vdata["paterno"] = $persona->vApellidoPaterno;
                $vdata["materno"] = $persona->vApellidoMaterno;
                $vdata["correo1"] = $persona->vCorreo1;
                $vdata["correo2"] = $persona->vCorreo2;
                $vdata["telefono"] = $persona->vTelefono;
                $vdata["cargo"] = $persona->vCargo;
                $vdata["celular"] = $persona->vCelular; // iIdOrganismo  iIdRol
                $vdata["organismo"] = $persona->iIdOrganismo;
                $vdata["rol"] = $persona->iIdRol;
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

/*             $vdata["usuario"] = $this->input->post("usuario");
            $vdata["titulo"] = $this->input->post("titulo");
            $vdata["nombre"] = $this->input->post("nombre");
            $vdata["paterno"] = $this->input->post("paterno");
            $vdata["materno"] = $this->input->post("materno");
            $vdata["correo1"] = $this->input->post("correo1");
            $vdata["correo2"] = $this->input->post("correo2");
            $vdata["telefono"] = $this->input->post("telefono");
            $vdata["cargo"] = $this->input->post("cargo");
            $vdata["celular"] = $this->input->post("celular");
            $vdata["iIdOrganismo"] = $this->input->post("organismo");
            $vdata["iIdRol"] = $this->input->post("rol");  */

            if ($this->form_validation->run()) {
                if($persona_id > 0){

                    $this->mu->update($persona_id, $data);
                }else $persona_id =  $this->mu->insert($data);

                //var_dump($data);
                //$error = $this->do_upload($persona_id);
                if($error === ""){
                    echo 1;
                }           
            }else{
                echo 'NO';
            }
        }
        
        if($vista>0){
            $vdata["error"] = $error;
            $this->load->view('usuarios/capturar_usuario', $vdata);
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
            $vdata["usuario"] = $persona->vUsuario;
            $vdata["Titulo"] = $persona->vTitulo;
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
            $vdata["usuario"] = $vdata["titulo"] = $vdata["nombre"] =  $vdata["paterno"] =  $vdata["materno"] = $vdata["correo1"] = $vdata["correo2"] = $vdata["telefono"] = $vdata["cargo"] = $vdata["celular"] = "";
        }
        $this->load->view('usuarios/ver_usuario', $vdata);
    }


    public function borrar($persona_id = null){
        $this->mu->delete($persona_id);
        redirect("/usuarios/listado_usuario");
    }

    public function borrar_ajax($persona_id = null){
        $this->mu->delete($persona_id);
    }


}
