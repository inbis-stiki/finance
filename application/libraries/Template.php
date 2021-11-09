<?php

class Template
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
    }

    public function login($content, $data)
    {
        $this->_ci->load->view('_components/Header', $data); 
        $this->_ci->load->view($content, $data); // Content
        $this->_ci->load->view('_components/Footer', $data); 
    }

    public function index($content, $data)
    {
        $this->_ci->load->view('_components/Header', $data); 
        $this->_ci->load->view('_components/sideNavigation', $data); 
        $this->_ci->load->view($content, $data); // Content
        $this->_ci->load->view('_components/Footer', $data); 
    }
}
