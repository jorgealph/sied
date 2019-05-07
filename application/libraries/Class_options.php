<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Class_options {

    function __construct()
    {
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->load->helper('Funciones_helper');        
        $CI->load->model('M_catalogos'); 
    }

    function options_grados_estudio($seleccionado="", $opcion0="")
    { 
        $model = new M_catalogos();
        $select = '';

        $query = $model->datos_grados_estudio();

        if($query != false)
        {            
            if($opcion0 != '')
            {
                if($seleccionado == 0) $select .="<option value=\"0\" selected>$opcion0</option>";
                else $select .="<option value=\"0\">$opcion0</option>";
            }
            
            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdGradoEstudio == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdGradoEstudio.'" '.$selected.'>'.$e->vGradoEstudio.'</option>';
            }
        }

        return $select;
    }

    function options_ocupaciones($seleccionado="", $opcion0="")
    { 
        $model = new M_catalogos();
        $select = '';
                
        $query = $model->datos_ocupaciones();

        if($query != false)
        {            
            if($opcion0 != '')
            {
                if($seleccionado == 0) $select .="<option value=\"0\" selected>$opcion0</option>";
                else $select .="<option value=\"0\">$opcion0</option>";
            }
            
            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdOcupacion == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdOcupacion.'" '.$selected.'>'.$e->vOcupacion.'</option>';
            }
        }

        return $select;
    }

    function options_municipios($seleccionado="", $opcion0="")
    { 
        $model = new M_catalogos();
        $select = '';

        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\">$opcion0</option>";
        }
                
        $query = $model->datos_municipios();

        if($query != false)
        {            
            
            
            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdMunicipio == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdMunicipio.'" '.$selected.'>'.$e->vMunicipio.'</option>';
            }
        }

        return $select;
    }

    function options_localidades($seleccionado="", $opcion0="",$where='')
    { 
        $model = new M_catalogos();
        $select = '';
        
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\">$opcion0</option>";
        }

        $query = $model->datos_localidades($where);

        if($query != false)
        {   
            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdLocalidad == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdLocalidad.'" '.$selected.'>'.$e->vLocalidad.'</option>';
            }
        }

        return $select;
    }

    function options_asentamientos($seleccionado="", $opcion0="",$where='')
    { 
        $model = new M_catalogos();
        $select = '';
        
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }

        $query = $model->datos_asentamientos($where);

        if($query != false)
        {   
            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdAsentamiento == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdAsentamiento.'" '.$selected.' rel="'.$e->iCodigoPostal.'">'.$e->vAsentamiento.'</option>';
            }
        }

        return $select;
    }

    function options_asentamientos_cp($seleccionado="", $opcion0="",$where='')
    { 
        $model = new M_catalogos();
        $select = '';

        $query = $model->datos_asentamientos($where);

        if($query != false)
        {   
            if($query->num_rows() > 1)
            {
                $select .="<option value=\"0\" >Seleccione una colonia</option>";
            }

            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdAsentamiento == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdAsentamiento.'" '.$selected.' rel="'.$e->iCodigoPostal.'">'.$e->vAsentamiento.'</option>';
            }
        }

        return $select;
    }

    function options_dias($seleccionado="", $opcion0="")
    { 
        $select = '';
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }
        for ($i=1; $i < 32 ; $i++)
        { 
            $selected = ($i == $seleccionado) ? 'selected':'';
            $select .= '<option value="'.$i.'" '.$selected.' rel="'.$i.'">'.$i.'</option>';
        }

        return $select;
    }

    function options_meses($seleccionado="", $opcion0="")
    { 
        $select = '';
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }
        for ($i=1; $i < 13 ; $i++)
        { 
            $selected = ($i == $seleccionado) ? 'selected':'';
            $select .= '<option value="'.$i.'" '.$selected.' rel="'.$i.'">'.NombreMes($i).'</option>';
        }

        return $select;
    }
   
    function options_anios($seleccionado="", $opcion0="")
    { 
        $select = '';
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }

        for ($i=2005; $i > 1900 ; $i--)
        { 
            $selected = ($i == $seleccionado) ? 'selected':'';
            $select .= '<option value="'.$i.'" '.$selected.' rel="'.$i.'">'.$i.'</option>';
        }

        return $select;
    }

    // === Añadido en 2018-11-07

    function options_sectores($seleccionado="", $opcion0="",$where='')
    { 
        $model = new M_catalogos();
        $select = '';
        
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }

        $query = $model->datos_sectores($where);

        if($query != false)
        {   
            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdSector == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdSector.'" '.$selected.'>'.$e->vSector.'</option>';
            }
        }

        return $select;
    }

    function options_temas($seleccionado="", $opcion0="",$id=0)
    { 
        $model = new M_catalogos();
        $select = '';

        $query = $model->devuelve_temas_por_sector($id);
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }

        if($query != false)
        {

            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdTema == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdTema.'" '.$selected.' >'.$e->vTema.'</option>';
            }
        }

        return $select;
    }

    function options_estatus_propuestas($seleccionado="",$opcion0=true)
    { 
        $select = '';

        if($opcion0) $select .= '<option value="10" selected>Todas</option>';
        $select .= ($seleccionado == 0) ? '<option value="0" selected>No viables</option>':'<option value="0"  rel="0">No viables</option>';
        $select .= ($seleccionado == 1) ? '<option value="1" selected>Pendientes de revisión</option>':'<option value="1"  rel="0">Pendientes de revisión</option>';
        $select .= ($seleccionado == 2) ? '<option value="2" selected>Integrada</option>': '<option value="2" rel="0" >Integrada</option>';
        $select .= ($seleccionado == 3) ? '<option value="3" selected>Aprobada</option>':'<option value="3" rel="0" >Aprobada</option>';

        return $select;
    }

    function options_roles($seleccionado="", $opcion0="",$where='')
    { 
        $model = new M_catalogos();
        $select = '';
        
        //  Primera opción del selector
        if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }

        $query = $model->datos_roles($where);

        if($query != false)
        {   
            $query = $query->result();
            foreach ($query as $e)
            {
                $selected = ($e->iIdRol == $seleccionado) ? 'selected':'';
                $select .= '<option value="'.$e->iIdRol.'" '.$selected.'>'.$e->vRol.'</option>';
            }
        }

        return $select;
    }

    function options_estatus_usuario($seleccionado="",$opcion0='')
    { 
        $select = '';
         if($opcion0 != '')
        {
            if($seleccionado == 0) $select .="<option value=\"0\" rel=\"0\" selected>$opcion0</option>";
            else $select .="<option value=\"0\" rel=\"0\">$opcion0</option>";
        }
       
        $select .= ($seleccionado == 1) ? '<option value="1" rel="0" selected >Pendiente de validación</option>':'<option value="1" rel="0">Pendiente de validación</option>';
        $select .= ($seleccionado == 2) ? '<option value="2" rel="0" selected >Correo validado</option>': '<option value="2" rel="0">Correo validado</option>';
        $select .= ($seleccionado == 3) ? '<option value="3" rel="0" selected >Correo validado</option>': '<option value="3" rel="0">Bloqueado</option>';

        return $select;
    }
}