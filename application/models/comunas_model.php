<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 22/06/17
 * Time: 09:22
 */
class Comunas_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database('default');
    }

    public function dameTodo()
    {
        return $this->db->select('comId, comNombre')
                        ->from('comunas')
                        ->order_by('comNombre')
                        ->get()
                        ->result();
    }
    public function dameUno($comuna)
    {
        return $this->db->select('comId, comNombre')
                        ->from('comunas')
                        ->where('id',$comuna)
                        ->get()
                        ->row();
    }

   
    
}