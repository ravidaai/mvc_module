<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class ForgotPassword extends MX_Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $this->form_validation->set_error_delimiters('<span class="alert alert-error">', '</span>');
            $this->form_validation->set_rules('user_name', 'Username', $this->config->item('form_base') . '|required|strtolower|max_length[50]'); //alpha_dash


            if ($this->form_validation->run() == TRUE) {
                $user = $this->members_model->check_user(strtolower($this->input->post('user_name')));

if($user->status==1){
    if ($user) {

        $to =  $user->email;
            $from_name = $this->email_setting_model->get('admin_name'); //$this->config->item('email_from_name');
            $from_email = $this->email_setting_model->get('out_going_email'); //$this->config->item('email_from_email');
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from($from_email, $from_name);
            $this->email->to($to);
            $this->email->reply_to($from_email, $from_name);
            $this->email->subject($this->email_setting_model->get('reset_pwd_request_subject'));

            $verification_key = md5($user->id.$this->config->item('encryption_key').$user->id);
            $this->members_model->update(array('verification_key'=>$verification_key), $user->id);
            $verify_url = site_url('verify_pwd/'.$verification_key);
            
            if(strcasecmp($user->member_type, 'group')==0){
                $full_name = $user->group_name;
            }else{
                $full_name = $user->first_name . ' ' . $user->last_name;
            }
            
            $message = str_replace('[Full Name]', $full_name, nl2br($this->email_setting_model->get('reset_pwd_request_body_text')));
            $message.= "<br><br><a href=\"$verify_url\" style=\"background-color: #1E90FF; border: none; color: white;padding: 15px 32px;text-align: center; text-decoration: none;display: inline-block;font-size: 15px;margin: 4px 2px; cursor: pointer;\">CREATE YOUR PASSWORD</a>";


            $this->email->message($message);

            if ($this->email->send()) {
                setFlashMessage('flash_success', 'forgot_pwd_success text-center', 'Please check your email.<br>We have sent you a link to reset your password.');
                redirect(site_url('ForgotPassword'));
            } else {
                show_error($this->email->print_debugger());
            }

    } else {

        $this->session->set_flashdata('flash_error', 'Sorry, email ID not recognized. Please try again.');
        redirect(site_url('ForgotPassword'));
    }
}else{
    //$this->session->set_flashdata('flash_error', 'Your account has been blocked. Please contact us for further instructions');
    $this->session->set_flashdata('flash_error', 'Sorry, email ID not recognized. Please try again.');
    redirect(site_url('ForgotPassword'));
}
                
            }
        }

        $data['module'] = 'site';
        $data['template'] = 'forgot';
        $data['web_title'] = 'Forgot Password?';
        echo Modules::run('templates/siteLayout', $data);

    }


    /* end */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
