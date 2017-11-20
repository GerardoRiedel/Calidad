<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 22/06/17
 * Time: 09:22
 */
class Sugerencia_model extends CI_Model
{

    
    public function __construct()
    {
        $this->load->database('default');
    }
    
     public function guardar()
    {
        if(isset($this->sugId))
            $this->db->update('sugerencias', $this, array('sugId' => $this->sugId));
        else
            $this->db->insert('sugerencias', $this);
    }
    public function dameUltimo($rut)
    {
        return $this->db->select('sugId')
                        ->from('sugerencias')
                        ->where('sugEstado <',5)
                        ->where('sugRut',$rut)
                        ->order_by('sugId','desc')
                        ->get()
                        ->row();
    }
    public function dameUno($id)
    {
        return $this->db->select('*')
                        ->from('sugerencias')
                        ->join('comunas','comId=sugComuna')
                        ->where('sugId',$id)
                        ->get()
                        ->row();
    }
    public function dameTodo()
    {
        return $this->db->select('sugId,sugFecha,sugNombre,sugRut,sugApePat,sugApeMat,sugDomicilio,sugTelefono,sugEmail,sugHechos,c.comNombre')
                        ->from('sugerencias')
                        ->join('comunas c','c.comId=sugComuna')
                        ->where('sugEstado <',5)
                        ->get()
                        ->result();
        //die(var_dump($return));
    }
    public function dameCorreoUnidad($idUnidad)
    {
        $db = $this->load->database('capacitacion', TRUE);
        $return =  $db->select('u.idunidad id,u.descripcion,d.correo correoDirector, j.correo correoJefe')
                        ->from('unidades u')
                        ->join('colaboradores d','d.idcolaborador=u.director')
                        ->join('colaboradores j','j.idcolaborador=u.jefe')
                        ->where('u.categoria','negocio')
                        ->where('u.estado','A')
                        ->where('u.idunidad',$idUnidad)
                        ->order_by('u.descripcion','asc')
                        ->get()
                        ->row();
         $this->load->database('default',true);
         return $return;
    }


    
    
    
    
    
    
    
    
    
    
    
    

    
   

    public function dameValor($parametro)
    {
        $row = $this->db->select('parValor')
                        ->from('parametros')
                        ->where('parNombre',$parametro)
                        ->get()
                        ->row();

        return !empty($row->parValor) ? $row->parValor : 0;
    }

   
    public function eliminar()
    {
        $this->db->where('parId', $this->parId);
        $this->db->delete('parametros');
    }
    
    public function dameTodoRegimen()
    {
        return $this->db->select('regId, regNombre, regDescripcion')
                        ->from('regimenes')
                        ->get()
                        ->result();
    }
    public function dameUnoRegimen($id)
    {
        return $this->db->select('regId, regNombre, regDescripcion')
                        ->from('regimenes')
                        ->where('regId',$id)
                        ->get()
                        ->row();
    }
    public function guardarRegimen()
    {
        if(isset($this->regId))
            $this->db->update('regimenes', $this, array('regId' => $this->regId));
        else
            $this->db->insert('regimenes', $this);
    }
    public function dameDerivacion()
    {
        return $this->db->select('derId, derNombre')
                        ->from('derivaciones')
                        ->get()
                        ->result();
    }
    
    
    
    public function dameTodoFarmaco()
    {
        return $this->db->select('descripcion, idfarmaco, estado, farmValor')
                        ->from('farmacos')
                        ->order_by('descripcion','asc')
                        ->get()
                        ->result();
    }
    public function dameUnoFarmaco($id)
    {
        return $this->db->select('idfarmaco, descripcion, estado, farmValor')
                        ->from('farmacos')
                        ->where('idfarmaco',$id)
                        ->get()
                        ->row();
    }
     public function guardarFarmaco()
    {
        if(isset($this->idfarmaco))
            $this->db->update('farmacos', $this, array('idfarmaco' => $this->idfarmaco));
        else
            $this->db->insert('farmacos', $this);
    }
    
    public function guardarExamen()
    {
        if(isset($this->exaId))
            $this->db->update('examenes', $this, array('exaId' => $this->exaId));
        else
            $this->db->insert('examenes', $this);
    }
    public function dameTodoExamenes()
    {
        return $this->db->select('exaId, exaNombre, exaValor,exaEstado,exaCodigo')
                        ->from('examenes')
                        ->get()
                        ->result();
    }
    public function dameUnoExamenes($id)
    {
        return $this->db->select('exaId, exaNombre, exaValor,exaEstado')
                        ->from('examenes')
                        ->where('exaId',$id)
                        ->get()
                        ->row();
    }
   
    
    
    public function guardarInsumo()
    {
        if(isset($this->insId))
            $this->db->update('insumos', $this, array('insId' => $this->insId));
        else
            $this->db->insert('insumos', $this);
    }
    public function dameTodoInsumos()
    {
        return $this->db->select('insId, insNombre, insValor,insEstado')
                        ->from('insumos')
                        ->get()
                        ->result();
    }
    public function dameUnoInsumos($id)
    {
        return $this->db->select('insId, insNombre, insValor,insEstado')
                        ->from('insumos')
                        ->where('insId',$id)
                        ->get()
                        ->row();
    }
    
    
    ///ULTIMOS PARA CHEQUEAR
    public function dameUltimoInsumo()
    {
        return $this->db->select('insId')
                        ->from('insumos')
                        ->order_by('insId','desc')
                        ->get()
                        ->row();
    }
    public function dameUltimoExamen()
    {
        return $this->db->select('exaId')
                        ->from('examenes')
                        ->order_by('exaId','desc')
                        ->get()
                        ->row();
    }
    public function dameUltimoFarmaco()
    {
        return $this->db->select('idfarmaco')
                        ->from('farmacos')
                        ->order_by('idfarmaco','desc')
                        ->get()
                        ->row();
    }
    
    
    
    ///CHEQUEAR POR NOMBRE
    public function dameNombreInsumo($nombre)
    {
        return $this->db->select('insId')
                        ->from('insumos')
                        ->like('insNombre',$nombre,'after')
                        ->get()
                        ->row();
    }
    public function dameNombreExamen($nombre)
    {
        return $this->db->select('exaId')
                        ->from('examenes')
                        ->like('exaNombre',$nombre,'after')
                        ->get()
                        ->row();
    }
    public function dameNombreFarmaco($nombre)
    {
        return $this->db->select('idfarmaco,descripcion')
                        ->from('farmacos')
                        ->like('descripcion',$nombre,'after')
                        ->get()
                        ->row();
    }
}