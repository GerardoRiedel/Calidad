<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charts extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
        $this->load->helper('layout');
	}
	
	function index()
	{
                        
        $data['title']           = "Graficos";
        $data['menu']       = "listar";
        $data['submenu']    = "noConforme";
                        Layout_Helper::cargaVista($this,'charts',$data,'ingresos');  
	}
	
	
}