<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Registration extends Super_Controller{



    public function __construct()
    {
        parent::__construct();

    }

    public function index() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('full_name', 'First Name', $this->config->item('form_base') . '|required|alpha_dash_space|max_length[50]');

            $this->form_validation->set_rules('user_name', 'Username', $this->config->item('form_base') . '|required|alpha_dash|strtolower|min_length[5]|max_length[20]|is_unique[members.user_name]');
            $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');

            $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[pwd]');



            if ($this->form_validation->run() == TRUE) {
                $new_members_id = $this->members_model->registration();
                if ($new_members_id) {

                    setFlashMessage('flash_success', 'alert alert-success' ,'You are successfully registered.');
                    redirect(site_url('members/Registration'));
                }
            }
        }



        $data['module']='members';
        $data['template']='registration';
        $data['web_title']='Registration';
        $data['status']=array('Disabled', 'Enabled');
        $data['page_header']='User Registration'.'<a href="'.site_url('members/super/member_list').'" class="btn btn-success pull-right" role="button"><i class="fa fa-plus"></i> Admin List</a>';
        echo Modules::run('templates/adminLayout', $data);


    }





    /* end */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
