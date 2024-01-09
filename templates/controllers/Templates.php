<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends Auth_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    private $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->data['login_id'] = $this->logged_in_member_id;
        $this->data['user_name'] = $this->user_name;
        $this->data['capability'] = $this->capability;
        $this->data['is_super'] = $this->is_super;
        $this->data['is_admin'] = $this->is_admin;
        $this->data['is_member'] = $this->is_member;


    }

    public function adminLayout($data)
    {
        $this->data['navigation']='Incl/navigation';
        $data = array_merge($this->data, $data);
        $this->load->view('adminLayout', $data);
    }

    public function dashboardLayout($data)
    {
        $this->data['navigation']='Incl/navigation';
        $data = array_merge($this->data, $data);
        $this->load->view('DashboardLayout', $data);
    }

    public function printLayout($data)
    {
        $this->data['navigation']='Incl/navigation';
        $data = array_merge($this->data, $data);
        $this->load->view('printLayout', $data);
    }

    public function siteLayout($data)
    {
        $data = array_merge($this->data, $data);
        $this->load->view('siteLayout', $data);
    }

    public function contactLayout($data)
    {
        $data = array_merge($this->data, $data);
        $this->load->view('contactLayout', $data);
    }

    public function testimonialLayout($data)
    {
        $data = array_merge($this->data, $data);
        $this->load->view('testimonialLayout', $data);
    }

    public function feedbackLayout($data)
    {
        $data = array_merge($this->data, $data);
        $this->load->view('feedbackLayout', $data);
    }

    public function loginLayout($data)
    {
        $this->load->view('loginLayout', $data);
    }


    public function forgotPasswordLayout($data)
    {
        $this->load->view('loginLayout', $data);
    }

}