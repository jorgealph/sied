<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_seguridad extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }

    public function index()
	{
		if(!isset($_SESSION[PREFIJO.'_idusuario']) || empty($_SESSION[PREFIJO.'_idusuario']))
		{
			$this->mostrar_login();
		}
		else
		{
			$this->mostrar_inicio();	
		}
	}

	public function mostrar_login()
	{
		$this->load->view('seguridad/login');
	}

	function mostrar_inicio()
	{
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$idrol = (int)$_SESSION[PREFIJO.'_idrol'];
			$idusuario = (int)$_SESSION[PREFIJO.'_idusuario'];
			
			$this->load->library('Class_seguridad');
			$ms = new Class_seguridad();
			$aux = $ms->pintar_menu($idusuario);
			$datos['menu'] = $aux['menu'];
			$datos['modulo_inicial'] = $aux['modulo_inicial'];;
			$this->load->view('seguridad/admin',$datos);

		}else $this->index();
	}

	public function iniciar_sesion()
	{
		if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['password']) && !empty($_POST['password']))
		{
			//	Datos Recaptcha Google
			/*$secret = '6LcFNH0UAAAAANR1lPEs3ezWT_mUor1PiT60wn_P';
	    	$response = $_POST["g-recaptcha-response"];
	    	$remoteip =  $_SERVER['REMOTE_ADDR'];

	    	$url = 'https://www.google.com/recaptcha/api/siteverify';

	    	$captcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
			$json = json_decode($captcha);
			
			if($json->success)
			{*/
				$where['u.vUsuario'] =  $this->input->post('usuario');
                $where['u.vPassword'] = sha1($this->input->post('password'));
				$query = $this->ms->consulta_existe_usuario($where);
				
				if($query)
				{
					if($query->num_rows() > 0)
					{
						$du = $query->row();
                        $_SESSION[PREFIJO.'_idusuario'] = $du->id_usuario;
                        $_SESSION[PREFIJO.'_correo'] = $du->correo;
                        $_SESSION[PREFIJO.'_idrol'] = $du->id_rol;
                        $_SESSION[PREFIJO.'_nombre'] = $du->nombres.' '.$du->apellido_paterno.' '.$du->apellido_materno ;
                        $_SESSION[PREFIJO.'_usuario'] = $du->usuario;

                        echo '0';
					}
					else echo 'Datos incorrectos';
				}else echo 'Ha ocurrido un error. Contacte al administrador.';
			/*
			}
			else
			{
				echo 'Resuelva el captcha para continuar';
			}*/
			
		}else echo 'Datos insuficientes';
	}

	public function cerrar_sesion()
	{
		if(isset($_SESSION) && !empty($_SESSION))
		{
			foreach ($_SESSION as $key => $value)
			{
				session_unset($key);
			}
		}

		$this->index();
	}

	function blank()
	{
		$seg = new Class_seguridad();
		$tipo_acceso = $seg->validar_acceso(1);
		
		if($tipo_acceso > -1)
		{
			if($tipo_acceso > 0) $this->load->view('blank');
			else $this->load->view('errors/acceso_denegado');
		}
		else
		{
			$this->load->view('errors/acceso_denegado');
		}
	}
}
