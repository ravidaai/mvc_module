<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Email_setting extends Super_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        redirect(site_url('members/dashboard'));
        exit;

    }

    public function manage()
    {
        $this->email_setting_model->primary_key='member_id';

        $query = $this->email_setting_model->fromId($this->logged_in_member_id);

        if (!isset($query->id)) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('admin_name', 'Admin Name', $this->config->item('form_base') . '|required');


                if ($this->form_validation->run() == TRUE) {
                    $setting_id = $this->email_setting_model->add($this->logged_in_member_id);
                    if ($setting_id) {
                        setFlashMessage('flash_success', 'alert alert-success', 'Successfully added.');
                        redirect(site_url('email_setting/manage'));
                    }
                }
            }
        } else {

            if ($this->email_setting_model->checkPoint($this->logged_in_member_id, $query->id)) {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('admin_name', 'Admin Name', $this->config->item('form_base') . '|required');
                   
                    if ($this->form_validation->run() == TRUE) {

                        $new_query = $this->email_setting_model->edit($this->logged_in_member_id);
                        if ($new_query) {

                            setFlashMessage('flash_error', 'alert alert-success', 'Successfully updated.');
                            redirect(site_url('email_setting/manage'));
                        }

                    }
                }
            }
        }

        $fresh_query = $this->email_setting_model->fromId($this->logged_in_member_id);
        $data['result']=$fresh_query;
        $data['module'] = 'email_setting';
        $data['template'] = 'email_setting';
        $data['web_title'] = "Email Settings";
        $data['page_header'] = 'Email Settings';
        echo Modules::run('templates/adminLayout', $data);
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
