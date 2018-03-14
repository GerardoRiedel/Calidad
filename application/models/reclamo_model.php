<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 22/06/17
 * Time: 09:22
 */
class Reclamo_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database('default');
    }
    
     public function guardar()
    {
        if(isset($this->recId))
            $this->db->update('reclamos', $this, array('recId' => $this->recId));
        else
            $this->db->insert('reclamos', $this);
    }
    public function dameUltimo($rut)
    {
        return $this->db->select('recId')
                        ->from('reclamos')
                        ->where('recRut',$rut)
                        ->order_by('recId','desc')
                        ->get()
                        ->row();
    }
    public function dameUno($id)
    {
        $return[0] = $this->db->select('recId,recFecha,recFechaModificacion,recAutorizado,recNombre,recApePat,recApeMat,recRut,recArea,recDomicilio,recTelefono,recEmail,recEstado,recObservacion,recRespuesta,recApoNombre,recApoApePat,recApoApeMat,recApoVinculo,recApoRut,recApoDomicilio,recApoTelefono,recApoEmail,recApoRespuesta,recHechos,recPeticion,c.comNombre,s.comNombre comApoNombre, recConformidad')
                        ->from('reclamos')
                        ->join('comunas c','c.comId=recComuna')
                        ->join('comunas s','s.comId=recApoComuna','left')
                        ->join('respuestas r','r.resReclamo=recId','left')
                        ->join('estados','recEstado=estId','left')
                        ->where('recEstado !=',5)
                        ->where('recId',$id)
                        ->get()
                        ->row();
        $db = $this->load->database('capacitacion', TRUE);
        $return[1] =  $db->select('u.idunidad id,u.descripcion,d.correo correoDirector, j.correo correoJefe')
                        ->from('unidades u')
                        ->join('colaboradores d','d.idcolaborador=u.director')
                        ->join('colaboradores j','j.idcolaborador=u.jefe')
                        ->where('u.categoria','negocio')
                        ->where('u.estado','A')
                        ->where('u.idunidad',$return[0]->recArea)
                        ->order_by('u.descripcion','asc')
                        ->get()
                        ->result();
         $this->load->database('default',true);
         //die(var_dump($return));
         return $return;
    }
    public function dameTodo()
    {
        return $this->db->select('*')
                        ->from('reclamos')
                        ->join('estados','recEstado=estId','left')
                        ->where('recEstado !=',5)
                        ->get()
                        ->result();
    }
    public function dameTodoJefe($area)
    {//$area=19;
         IF($area === '25')$area = 3;
         IF($area === '5')$area = 30;
        return $this->db->select('*')
                        ->from('reclamos')
                        ->join('estados','recEstado=estId','left')
                        ->where('recEstado !=',5)
                        ->where('recArea',$area)
                        ->get()
                        ->result();
    }
    
    
    public function guardarRespuesta()
    {
        if(isset($this->resId))
            $this->db->update('respuestas', $this, array('resId' => $this->resId));
        else
            $this->db->insert('respuestas', $this);
    }
    public function dameRespuesta($recId)
    {
        return $this->db->select('*')
                        ->from('respuestas')
                        ->where('resReclamo',$recId)
                        ->order_by('resId','desc')
                        ->get()
                        ->row();
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