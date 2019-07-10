<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asm extends CI_Model{

    private $table = 'asm';
    private $table_id = 'iIdASM';

    public function __construct(){
        parent::__construct();
		$this->db = $this->load->database('default',TRUE);
    }

    
}