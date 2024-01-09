<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Login extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->members_model->update_where(array('status'=>'0'), array('capability'=>'member', 'member_type'=>'student', 'end_date<'=>date('Y-m-d')));
    }

    public function index()
    {

       $verification = $this->input->get('verification');
       if($verification)
       {
            $this->members_model->primary_key = 'verification_key';
            $verification_status = $this->members_model->ifExist($verification);
            if($verification_status)
            {
                $data['is_verified'] = "You’re good to go. Please enter your username and password to continue.";
            }
            
       }
       
        
        

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            //$this->form_validation->set_rules('user_name', 'Username', $this->config->item('form_base') . '|required|strtolower|min_length[5]|max_length[20]'); //alpha_dash
            // $this->form_validation->set_rules('user_name', 'Username', $this->config->item('form_base') . '|required|strtolower|min_length[5]|max_length[100]'); //alpha_dash
            // $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');

            $this->form_validation->set_rules('user_name', 'Username', $this->config->item('form_base') . '|required|strtolower|max_length[100]'); //alpha_dash
            $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|max_length[32]');
            $user = $this->members_model->check_user(strtolower($this->input->post('user_name')));


            if ($this->form_validation->run() == TRUE) {

                if ($user) { // if login is succesful
                // print_pre($user);
                // exit;
                    if ($user->capability == 'member') {
                        if($user->is_verified){
                            if ($user->status){
                                if (get_salted($user->salt, $this->input->post('pwd')) == $user->pwd) {
                                
                                    //print_pre($user);
                                    //exit;
                                    $date1  =   date_create(current_date());
                                    $date2  =   date_create($user->end_date);
                                    $interval = date_diff($date1, $date2);
                                    
                                    if ($interval->format("%R%a") >= 1){
    
                                        $this->members_model->update_total_login($user->id);
                                        $user_data = array(
                                            'user_id' => $user->id,
                                            'user_name' => $user->user_name,
                                            'user_secret_key' => user_secret_key($this->config->item('encryption_key'), $user->pwd),
                                            'is_user_logged_in' => TRUE
                                        );
                                
                                        $this->session->set_userdata($user_data);
                                        redirect(site_url('dashboard/course_home'));
                                    }else{
                                        //setFlashMessage('flash_error', 'alert alert-danger', 'Sorry. You no longer have access to this course');
                                        setFlashMessage('flash_error', 'alert alert-danger', 'Access Denied.');
                                        redirect(site_url() . 'login');
                                    }
                                } else {
    
                                    setFlashMessage('flash_error', 'alert alert-danger', 'Invalid username or password. Please try again.');
                                    //setFlashMessage('flash_error', 'alert alert-danger', 'Access Denied.');
                                    redirect(site_url() . 'login');
                                }
                            
                            }else {

                                //setFlashMessage('flash_error', 'alert alert-danger', 'Your account has been suspended. Please contact us for more information.');
                                setFlashMessage('flash_error', 'alert alert-danger', 'Access Denied.');
                                redirect(site_url() . 'login');
                            }
                        }else{
                            //setFlashMessage('flash_error', 'alert alert-danger', 'Inactive account. Please check your email for further instructions');
                            setFlashMessage('flash_error', 'alert alert-danger', 'Access Denied.');
                            redirect(site_url() . 'login');
                        }

                    } else {
                        //setFlashMessage('flash_error', 'alert alert-danger', 'Your account has been suspended. Please contact us for more information.');
                        setFlashMessage('flash_error', 'alert alert-danger', 'Access Denied.');
                        redirect(site_url() . 'login');
                    }

                } else {
                    //setFlashMessage('flash_error', 'alert alert-danger', 'Invalid username or password. Please try again.');
                    setFlashMessage('flash_error', 'alert alert-danger', 'Access Denied.');
                    redirect(site_url() . 'login');
                }
            }
        }

        $data['module'] = 'site';
        $data['template'] = 'login';
        $data['web_title'] = 'American Ways Login';

        echo Modules::run('templates/siteLayout', $data);

    }


    /* end */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */