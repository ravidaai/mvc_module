<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        echo '-__-';
    }

    public function xps()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('user_name', 'Username', $this->config->item('form_base') . '|required|strtolower|min_length[5]|max_length[20]'); //alpha_dash
            $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
            $user = $this->members_model->check_user(strtolower($this->input->post('user_name')));


            if ($this->form_validation->run() == TRUE) {

                if ($user) { // if login is succesful

                    if ($user->capability == 'super' or $user->capability == 'admin') {
                        
                        if ($user->status == '1'){
                            

                            if (get_salted($user->salt, $this->input->post('pwd')) == $user->pwd) {
                                $user_data = array(
                                    'user_id' => $user->id,
                                    'user_name' => $user->user_name,
                                    'user_secret_key' => user_secret_key($this->config->item('encryption_key'), $user->pwd),
                                    'is_user_logged_in' => TRUE
                                );

                                $this->session->set_userdata($user_data);
                                redirect(site_url() . 'members/dashboard');
                                
                            } else {

                                setFlashMessage('flash_error', 'alert alert-danger', 'password mismatched');
                                redirect(site_url('xps'));
                            }
                        }else {

                            setFlashMessage('flash_error', 'alert alert-danger', 'Contact with administrator.');
                            redirect(site_url('xps'));
                        }

                    } else {
                        setFlashMessage('flash_error', 'alert alert-danger', 'You are not authorize to login.');
                        redirect(site_url('xps'));
                    }


                } else {

                    setFlashMessage('flash_error', 'alert alert-danger', 'Login failed. Try again.');
                    redirect(site_url('xps'));
                }
            }
        }

        $data['module'] = 'members';
        $data['template'] = 'login';
        $data['web_title'] = 'American Ways XPS';

        echo Modules::run('templates/loginLayout', $data);

    }


    /* end */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
