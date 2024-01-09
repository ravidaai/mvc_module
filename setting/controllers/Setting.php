<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Setting extends Super_Controller
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
        $this->setting_model->primary_key='member_id';

        $query = $this->setting_model->fromId($this->logged_in_member_id);

        if (!isset($query->id)) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                //$this->form_validation->set_rules('welcome_text', 'Title', $this->config->item('form_base') . '|required');
                // $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', $this->config->item('form_base') . '|required');
                // $this->form_validation->set_rules('meta_description', 'Meta Description', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('course_rate', 'Course Rate', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('course_access_day', 'Course access day', $this->config->item('form_base') . '|required');

                if ($this->form_validation->run() == TRUE) {
                    $setting_id = $this->setting_model->add($this->logged_in_member_id);
                    if ($setting_id) {
                        setFlashMessage('flash_success', 'alert alert-success', 'Successfully added.');
                        redirect(site_url('setting/manage'));
                    }
                }
            }
        } else {

            if ($this->setting_model->checkPoint($this->logged_in_member_id, $query->id)) {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    //$this->form_validation->set_rules('welcome_text', 'Title', $this->config->item('form_base') . '|required');
                    // $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', $this->config->item('form_base'));
                    // $this->form_validation->set_rules('meta_description', 'Meta Description', $this->config->item('form_base'));
                    $this->form_validation->set_rules('course_rate', 'Course Rate', $this->config->item('form_base') . '|required');
                    $this->form_validation->set_rules('course_access_day', 'Course access day', $this->config->item('form_base') . '|required');

                    if ($this->form_validation->run() == TRUE) {

                        $new_query = $this->setting_model->edit($this->logged_in_member_id);
                        if ($new_query) {

                            setFlashMessage('flash_error', 'alert alert-success', 'Successfully updated.');
                            redirect(site_url('setting/manage'));
                        }

                    }
                }
            }
        }

        $fresh_query = $this->setting_model->fromId($this->logged_in_member_id);
        $data['result']=$fresh_query;
        $data['module'] = 'setting';
        $data['template'] = 'add';
        $data['web_title'] = "Course Settings";
        $data['page_header'] = 'Course Settings';
        echo Modules::run('templates/adminLayout', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
