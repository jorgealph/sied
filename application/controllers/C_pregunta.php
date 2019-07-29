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
			$result = array();
			if(isset($_POST['iIdPlantilla']) && !empty($_POST['iIdPlantilla'])){
				$key = $_POST['iIdPlantilla'];
				$apartado = null;
				$csvData = $this->csvreader->parse_file($_FILES['file']['tmp_name']);
				$intent = 1;
				$result['msg'] = 0;
				$result['falla'] = 0;
				foreach($csvData as $r){
					if(isset($r['apartado']) && isset($r['pregunta']) && isset($r['tipo_pregunta'])){
						if(is_null($apartado) && !isset($apartado->idApartado)){
							$apartado = $this->mp->buscar_apartado($key, $this->cleanText($r['apartado']));
							if (!isset($apartado[0])){
								$vdata['iIdPlantilla'] = $key;
								$vdata['vApartado'] = $this->cleanText($r['apartado']);
								$var = $this->mp->addApartado($vdata);
								if ($var > 0){
									$apartado = $this->mp->buscar_apartado($key, $this->cleanText($r['apartado']))[0];
								}
							}else{
								$apartado = $apartado[0];
							}
						}else{
							if($apartado->vApartado != $this->cleanText($r['apartado'])){
								$apartado = $this->mp->buscar_apartado($key, $this->cleanText($r['apartado']));
								if (!isset($apartado[0])){
									$vdata['iIdPlantilla'] = $key;
									$vdata['vApartado'] = $this->cleanText($r['apartado']);
									$var = $this->mp->addApartado($vdata);
									if ($var > 0){
										$apartado = $this->mp->buscar_apartado($key, $this->cleanText($r['apartado']))[0];
									}
								}else{
									$apartado = $apartado[0];
								}
							}
						}			
						$tmp = array("iIdApartado" => $apartado->iIdApartado, "vPregunta" => $this->cleanText($r['pregunta']), "iIdTipoPregunta" => $this->GetType($this->cleanText($r['tipo_pregunta'])));
						$exito = $this->mp->save($tmp);
						if($exito < 1 || empty($exito)){
							$row = $intent;
							$result['error'][] = $row;
						}else{
							$result['msg'] += 1;
						}
						$intent += 1;
					}else{
						$result['falla'] = 1;
						break;
					}
				} 
			}
			
			echo json_encode($result);
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

	public function Word($key = ''){
		$this->load->library('word');
		$this->load->model('M_pregunta','mp');

		$header = $this->mp->findApartado($key);
		// Creating the new document...
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		
		/* Note: any element you append to a document must reside inside of a Section. */

		// Adding an empty Section to the document...
		$section = $phpWord->addSection();
		
		// Adding Text element with font customized using explicitly created font style object...
		$fontStyle = new \PhpOffice\PhpWord\Style\Font();
		$fontStyle->setBold(true);
		$fontStyle->setName('Arial');
		$fontStyle->setSize(16);
		$paragraphStyle = new \PhpOffice\PhpWord\Style\Paragraph();
		$paragraphStyle->setAlign('both');
		$paragraphStyle->setlineHeight(1.5);
		$paragraphStyle->setSpaceAfter(300);

		// Adding Text element with font customized using named font style...
		$fontStyleName = 'fontStyle';
		$phpWord->addFontStyle(
    		$fontStyleName,
    		array('name' => 'Arial', 'size' => 12, 'color' => '1B2232', 'bold' => true)
		);
		// Adding Paragraph element
		$paragraphStyleName = 'paragraphStyle';
		$phpWord->addParagraphStyle(
			$paragraphStyleName,
			array('align' => 'both', 'lineHeight' => 1.5, "spaceAfter" => 300)
		);

		foreach($header as $r){
			$myTextElement = $section->addText($r->vApartado);
			$myTextElement->setFontStyle($fontStyle);
			$myTextElement->setParagraphStyle($paragraphStyle);
			$pregunta = $this->mp->findPregunta($r->iIdApartado);
			foreach($pregunta as $row){
				$section->addText(
					$row->vPregunta, 
					$fontStyleName, 
					$paragraphStyleName
				);
			}
		}

		// Saving the document as OOXML file...
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$filename = "Plantilla base del cuestionario.docx";
		$objWriter->save($filename);

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		flush();
		readfile($filename);
		unlink($filename);
	}
	
}