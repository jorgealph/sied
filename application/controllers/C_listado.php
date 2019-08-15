<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_listado extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        $this->load->library('Class_options');
    }

    public function cargar_options()
    {
        if(!empty($_POST['listado']) && !empty($_POST['valor']))
        {
            $opt = new Class_options();
            $listado = $this->input->post('listado');
            if($listado == 'organismos')
            {
                $where['iIdEje'] = $this->input->post('valor');
                echo $opt->options_tabla('organismos',0,$where);
            }
        }
    }
}
?>