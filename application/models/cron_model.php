<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_model extends CI_Model
{
     public function __construct()
    {
        $this->load->database('default');
    }

    
    
    public function reclamos()
    {
      return  $this->db->select('recId,recFecha')
                ->from('reclamos')
                ->where('recEstado',1)    
                ->or_where('recEstado',2)
                ->or_where('recEstado',4)        
                ->get()
                ->result();
    }
    
    
    
    
    
   

}