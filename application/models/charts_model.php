<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charts_model extends CI_Model
{
     public function __construct()
    {
        $this->load->database('default');
    }

    
    
    public function piePSNC()
    {
      return  $this->db->select('sum(plaProveedor)proveedor,sum(plaCliente)cliente,sum(plaProfesional)profesional,sum(plaUnidadCheck)unidad,sum(plaUnidadDeApoyoCheck)apoyo,sum(plaPaciente)paciente,sum(plaNoAplica)otro')
                ->from('planillas')
                ->where('plaEstado !=',5)        
                ->get()
                ->result();
    }
    public function pieAPOYO()
    {
      return  $this->db->select('count(plaUnidadDeApoyo)cant,plaUnidadDeApoyo')
                ->from('planillas')
                ->where('plaEstado !=',5)      
                ->where('plaUnidadDeApoyo !=','Seleccione...')
                ->group_by('plaUnidadDeApoyo')
                ->get()
                ->result();
    }
    public function lineaRECLAMOS()
    {
      //return  $this->db->select('count(id)cant,fechaIngreso,Year(fechaIngreso) as ano,MONTH(fechaIngreso) as mes')
      return  $this->db->select('count(recId)cant,recFecha,Year(recFecha) as ano,MONTH(recFecha) as mes')
                ->from('reclamos')
                //->where('fechaIngreso >=','2017-02-01')
                ->where('recEstado !=',5)
                ->group_by('ano,mes')
                ->get()
                ->result();
    }
     public function pieRECLAMOS()
    {
      return  $this->db->select('count(recArea)cant,recArea')
                ->from('reclamos')
                ->where('recEstado !=',5)      
                //->where('plaUnidadDeApoyo !=','Seleccione...')
                ->group_by('recArea')
                ->get()
                ->result();
    }
    

}