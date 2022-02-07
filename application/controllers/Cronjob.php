<?php

class Cronjob extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MReport');
    }
    public function JobReport(){
            
    }
}