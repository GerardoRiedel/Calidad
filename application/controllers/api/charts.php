<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 01/02/2017
 * Time: 14:00
 */
class Charts extends CI_Controller
{

    function __construct(){
        parent::__construct();
        $this->load->model('charts_model');
    }
    
    public function piePSNC()
    {
        $res = $this->charts_model->piePSNC();
        //die(var_dump($res));
        echo json_encode($res);
    }
    public function pieAPOYO()
    {
        $res = $this->charts_model->pieAPOYO();
        //die(var_dump($res));
        echo json_encode($res);
    }
    public function lineaRECLAMOS()
    {
        $res = $this->charts_model->lineaRECLAMOS();
        //die(var_dump($res));
        echo json_encode($res);
    }
    public function pieRECLAMOS()
    {
        $res = $this->charts_model->pieRECLAMOS();
        //die(var_dump($res));
        echo json_encode($res);
    }
    
    
    
    
    
}