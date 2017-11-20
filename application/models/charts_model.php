<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charts_model extends CI_Model
{
     public function __construct()
    {
        $this->load->database('default');
    }

    
    
    public function piePSNC()
    {
      return  $this->db->select('sum(plaProveedor)proveedor,sum(plaCliente)cliente,sum(plaProfesional)profesional,sum(plaUnidadCheck)unidad,sum(plaUnidadDeApoyoCheck)apoyo,sum(plaPaciente)paciente')
                ->from('planillas')
                ->where('plaEstado <',5)        
                ->get()
                ->result();
    }
    public function pieAPOYO()
    {
      return  $this->db->select('count(plaUnidadDeApoyo)cant,plaUnidadDeApoyo')
                ->from('planillas')
                ->where('plaEstado <',5)      
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
                ->where('recEstado <',5)
                ->group_by('ano,mes')
                ->get()
                ->result();
    }
    
    
    
    
    
    
    
    
    
    public function pieSexo()
    {
      return  $this->db->select('count(r.id)cant,p.sexo')
                ->from('ficha_ugh_registro r')
                ->join('ficha_pacientes p','r.paciente = p.id')
                ->where('r.ficha >',1)
                ->group_by('p.sexo')
                ->get()
                ->result();
    }
    
    public function depositos()
    {
      return $this->db->select('depTipo,sum(depSuma)monto,count(r.id)cant,Year(d.depFechaRegistro) as ano,MONTH(d.depFechaRegistro) as mes')
                ->from('ficha_ugh_registro r')
                ->join('depositos d','r.id = d.depFichaElectro')
                //->where('r.ficha >',1)
                ->where('d.depEstado != "5"')
                ->group_by('mes,depTipo')
                ->get()
                ->result();
      //die(var_dump($return));
    }
    
    public function piePisoEnfermeria()
    {
      return  $this->db->select('count(id)cant,piso')
                ->from('ficha_ugh_registro')
                ->where('ficha >',1)   
                ->where('alta','no')
                ->group_by('piso')
                ->get()
                ->result();
    }
    
    public function tec()
    {
      return  $this->db->select('count(tecSesId)cant,tecSesFechaRegistro,Year(tecSesFechaRegistro) as ano,MONTH(tecSesFechaRegistro) as mes')
                ->from('tecs_sessiones')
                //->where('fechaIngreso >=','2017-02-01')
                //->where('tecFicha >',0)
                ->group_by('ano,mes')
                ->get()
                ->result();
    }
    
    
    
    
   

}