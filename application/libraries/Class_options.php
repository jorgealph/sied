<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Class_options {

    function __construct()
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->load->helper('Funciones_helper');        
        $CI->load->model('M_catalogo'); 
    }

    function options_tabla($tabla, $seleccionado="")
    { 
        $model = new M_catalogo();
        $select = '';

        $query = $model->{$tabla}();

        if($query != false)
        {            
                       
            $result = $query->result();
            foreach ($result as $row)
            {
                $selected = ($row->id == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$row->id.'" '.$selected.'>'.$row->valor.'</option>';
            }
        }

        return $select;
    }
}