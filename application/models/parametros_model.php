<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 23/06/17
 * Time: 14:22
 */
class Parametros_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database('default');
    }
    public function dameUnidades()
    {
        $db = $this->load->database('capacitacion', TRUE);
        $return =  $db->select('idunidad id,descripcion,mail,correoUnidad')
                        ->from('unidades')
                        ->where('categoria','negocio')
                        ->where('estado','A')
                        ->order_by('descripcion','asc')
                        ->get()
                        ->result();
         $this->load->database('default',true);
         return $return;
    }
    public function dameUnidadesApoyo()
    {
        $db = $this->load->database('capacitacion', TRUE);
        $return =  $db->select('idunidad,descripcion')
                        ->from('unidades')
                        ->where('categoria','apoyo')
                        ->where('estado','A')
                        ->order_by('descripcion','asc')
                        ->get()
                        ->result();
         $this->load->database('default',true);
         return $return;
    }
    public function dameColaborador($usuario)
    {
        $db = $this->load->database('capacitacion', TRUE);
        $return =  $db->select('c.idcolaborador id,c.nombre,c.apellidoPaterno,c.apellidoMaterno,c.idunidad,u.descripcion')
                        ->from('colaboradores c')
                        ->join('unidades u','u.idunidad=c.idunidad')
                        ->where('c.estado','A')
                        ->where('c.idcolaborador',$usuario)
                        ->get()
                        ->row();
         $this->load->database('default',true);
         return $return;
    }
    public function dameJefe($usuario)
    {
        $db = $this->load->database('capacitacion', TRUE);
        $return =  $db->select('*')
                        ->from('unidades')
                        ->where('director',$usuario)
                        ->or_where('jefe',$usuario)
                        ->get()
                        ->row();
         $this->load->database('default',true);
         return $return;
    }
    public function dameJefeUnidad($idUnidad)
    {
         IF($idUnidad === '25')$idUnidad = 3;
         IF($idUnidad === '5')$idUnidad = 30;
        $db = $this->load->database('capacitacion', TRUE);
        $return =  $db->select('Nombre,apellidoPaterno,apellidoMaterno')
                        ->from('JefeUnidad')
                        ->where('estado','activo')
                        ->where('idunidad',$idUnidad)
                        ->get()
                        ->row();
         $this->load->database('default',true);
         return $return;
    }
    public function dameDirectorUnidad($idUnidad)
    {
         IF($idUnidad === '25')$idUnidad = 3;
          IF($idUnidad === '5')$idUnidad = 30;
        $db = $this->load->database('capacitacion', TRUE);
        $return =  $db->select('u.director,c.nombre,c.apellidoPaterno,c.apellidoMaterno')
                        ->from('unidades u')
                        ->join('colaboradores c','u.director=c.idcolaborador','left')
                        ->where('u.idunidad',$idUnidad)
                        ->get()
                        ->row();
         $this->load->database('default',true);
         return $return;
    }
    
     public function guardarPlanilla()
    {
        if(isset($this->plaId))
            $this->db->update('planillas', $this, array('plaId' => $this->plaId));
        else
            $this->db->insert('planillas', $this);
    }
    
    public function dameTodo()
    {
        return $this->db->select('*')
                        ->from('planillas')
                        ->where('plaEstado',1)
                        ->get()
                        ->result();
    }
    public function dameTodoUnidad($unidad)
    {
        IF($unidad === '25')$unidad = 3;
        IF($unidad === '5')$unidad = 30;
        
       
        return $this->db->select('*')
                        ->from('planillas')
                        ->where('plaEstado = 1 and plaUnidad = '.$unidad)
                        ->or_where('plaEstado = 1 and plaUnidadDeApoyoId = '.$unidad)
                        ->get()
                        ->result();
    }

    public function dameUno($id)
    {
        return $this->db->select('*')
                        ->from('planillas')
                        ->where('plaId',$id)
                        ->get()
                        ->row();
    }
    public function dameUnidadRevisoras($id)
    {
        return $this->db->select('uspNombre,uspApellidoP,uspUnidad')
                                    ->from('usuarios_panel')
                                    ->where('uspId',$id)
                                    ->get()
                                    ->row();
    }

    
    
    
    
    
}