<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pregunta extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        //$this->load->helper('Funciones');
        $this->load->library('Class_seguridad');
        $this->load->model('M_seguridad','ms');
    }
		
    public function csvtodb(){
			$this->load->library('CSVReader');
			$this->load->model('M_pregunta','mp');
			$error = null;
			$result = null;
			if(isset($_POST['iIdApartado']) && !empty($_POST['iIdApartado'])){
				$apartado = $_POST['iIdApartado'];
				$csvData = $this->csvreader->parse_file($_FILES['file']['tmp_name']);
				$intent = 1;
				$msg = 0;
				foreach($csvData as $r){
					if(isset($r['pregunta']) && isset($r['tipo_pregunta'])){
						$tmp = array("iIdApartado" => $apartado, "vPregunta" => $this->cleanText($r['pregunta']), "iIdTipoPregunta" => $this->GetType($this->cleanText($r['tipo_pregunta'])));
						//$data[] = $tmp;
						$result = $this->mp->save($tmp);
						if($result < 1 || empty($result)){
							$row = array('Fila' => $intent);
							$error[] = $row;
						}else{
							$msg = $result;
						}
						$intent += 1;
						/*if($apartado == 3){
							$apartado = 1;
						}else{
							$apartado += 1;
						}*/
					}else{
						break;
					}
				}
				if($result>0){
					echo "exito.";
				}else{
					echo 'error.';
				}
				if ($error != null){
					foreach($error as $e){
						echo $e['Fila'].",";
					}
				}
			}
			
		}

		private function GetType($pregunta){
			$tipoPregunta = null;
			switch ($pregunta) {
				case 'Pregunta abierta':
					$tipoPregunta = 1;
					break;
				case 'Pregunta dicotómica':
					$tipoPregunta = 2;
					break;
				case 'Pregunta dicotómica con niveles de respuesta':
					$tipoPregunta = 3;
					break;
			}
			return $tipoPregunta;
		}
		
		private function cleanText($text){
			$text = utf8_encode($text);
			$sustituye = array(chr(13).chr(10), "\r\n", "\n\r", "\n", "\r");
			$content = str_replace($sustituye, "", $text);
			$content = preg_replace("/\s+/", " ", $content);
			return $content;
		}

		public function text(){
			$cadena = "    asdasdasd 
			

			asd

			asdasda \nsdasd     ";
			$sustituye = array(chr(13).chr(10), "\r\n", "\n\r", "\n", "\r");
			$content = str_replace($sustituye, "", $cadena);
			$content = preg_replace("/\s+/", " ", $content);
			return trim($content);
		}

    public function pregunta(){
		if(isset($_SESSION[PREFIJO.'_idrol']) && !empty($_SESSION[PREFIJO.'_idrol']))
		{
			$datos = $this->menu();
			
			//$datos['organismo'] = $this->M_IntervencionPropuesta->findDistinctOrganismo();
			$this->load->view('pregunta/index',$datos);
			//echo "<textarea cols='30' rows='10'>".$this->text()."</textarea>";
			
		}else $this->index();
    }
    
    private function menu(){
		$idrol = (int)$_SESSION[PREFIJO.'_idrol'];
		$idusuario = (int)$_SESSION[PREFIJO.'_idusuario'];
		$this->load->library('Class_seguridad');
		$ms = new Class_seguridad();
		$aux = $ms->pintar_menu($idusuario);
		$datos['menu'] = $aux['menu'];
		$datos['modulo_inicial'] = $aux['modulo_inicial'];

		return $datos;
	}
}