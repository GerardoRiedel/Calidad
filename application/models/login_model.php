<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function loginUsuario($username,$password,$passwordSin)
	{    
            
                        $db = $this->load->database('capacitacion', TRUE);
                        $return =  $db->select('idcolaborador uspId')
                                        ->from('colaboradores')
                                        ->where('usuario',$username)
                                        ->where('password',$passwordSin)
                                        ->where('estado','A')
                                        ->get()
                                        ->row();
                         
                         IF(!empty($return)){
                             $jefe =  $db->select('idunidad')
                                        ->from('unidades')
                                        ->where('director',$return->uspId)
                                        ->or_where('jefe',$return->uspId)
                                        ->where('estado','A')
                                        ->get()
                                        ->row();
                             IF(!empty($jefe)){$jefes['uspJefe'] = 1; $jefes['uspId'] = $return->uspId; }ELSE {$jefes['uspJefe'] = 0; $jefes['uspId'] = $return->uspId; }
                             $return = $jefes;
                                $this->load->database('default',true);
                                return $return;}
                         ELSE {
                            $this->load->database('default',true);
                            $this->load->database('default');
                            $return = $this->db  ->select('*')
                                                                ->from('usuarios_panel')
                                                                ->where('uspUsuario',$username)
                                                                ->where('uspPassword',$password)
                                                                ->where('uspEstado',1)
                                                                ->get()
                                                                ->row();
                            IF(!empty($return)){$query['uspJefe'] = $return->uspJefe; $query['uspId'] = $return->uspId; }

                            if(!empty($return))
                            {
                                                    return $query;
                            }else{ 
                                                    return false;
                            }
                    }
	}
	
	
	
	
	public function verificaPassword($username,$password)
	{
		$this->db->where('uspEmail',$username);
		$this->db->where('uspPassword',$password);
		$query = $this->db->get('usuarios_panel');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('password incorrecta','La contraseña es incorrecta');
			
		}
	}
	
	
        public function enviarEmail($mail)
        {
            return $this->db->select('uspId,uspEmail,uspUsuario,uspPassword')
                            ->from('usuarios_panel')
                            ->where('uspEmail',$mail)
                            ->where('uspEstado',1)
                            ->or_where('uspEstado = 0 and uspEmail = "'.$mail.'"')
                            ->get()
                            ->row();
        }
        public function guardar()
        {
        if(isset($this->uspId)){
        $this->db->update('usuarios_panel', $this, array('uspId' => $this->uspId));}
        
        
        
        
        }
	
}

?>