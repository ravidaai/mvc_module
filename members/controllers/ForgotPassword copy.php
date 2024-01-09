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
            $this->form_validation->set_rules('user_name', 'Username', $this->config->item('form_base') . '|required|strtolower|min_length[5]|max_length[50]'); //alpha_dash


            if ($this->form_validation->run() == TRUE) {
                $user = $this->members_model->check_user(strtolower($this->input->post('user_name')));
                if ($user) {

                    if(strcasecmp($user->member_type, 'super')==0 and strcasecmp($user->capability, 'super')==0){
                        echo 1;
                    }

//                     $salt = create_salt();
//                     $random_password = random_password();
//                     $new_pwd = get_salted($salt, $random_password);

//                     $data = array(
//                             'pwd' => $new_pwd,
//                             'salt' => $salt,
//                         );

//                     $this->members_model->primary_key="email";
//                     $update = $this->members_model->update($data, $user->email);

//                     if($update)
//                     {
//                         $to =  $user->email;
//                         $from_name = $this->config->item('email_from_name');
//                         $from_email = $this->config->item('email_from_email');

//                         $this->load->library('email');
//                         $this->email->set_newline("\r\n");
//                         $this->email->from($from_email, $from_name);
//                         $this->email->to($to);
//                         $this->email->reply_to($from_email, $from_name);
//                         $this->email->subject('Password Reset');


//                         $message = <<<EOF
//                         <strong>Hi</strong> {$user->user_name}
//                         <br><br>

//                         <strong>New password:</strong> {$random_password}
//                         <br><br>
// EOF;


//                         $this->email->message($message);

//                         if ($this->email->send()) {
//                             setFlashMessage('flash_success', 'alert alert-success', 'Successfully password reset.');
//                             redirect(site_url('members/ForgotPassword'));
//                         } else {
//                             show_error($this->email->print_debugger());
//                         }

//                     }
//                     else
//                     {
//                         setFlashMessage('flash_error', 'alert alert-error', 'Unable to update password.');
//                         redirect(site_url('members/ForgotPassword'));
//                     }
                } else {

                    $this->session->set_flashdata('flash_error', 'Login failed. Try again.');
                    redirect(site_url('members/ForgotPassword'));
                }
            }
        }

        $data['module'] = 'members';
        $data['template'] = 'forgot';
        $data['web_title'] = 'Forgot Password?';
        echo Modules::run('templates/forgotPasswordLayout', $data);

    }


    // public function send_password_link($id){
        
    //     $memQ = $this->members_model->fromId(intval($id));
    //     if($memQ){

    //         $to =  trim($memQ->email);
    //         $from_name = $this->email_setting_model->get('admin_name'); 
    //         $from_email = $this->email_setting_model->get('out_going_email'); 

    //         $this->load->library('email');
    //         $this->email->set_newline("\r\n");
    //         $this->email->from($from_email, $from_name);
    //         $this->email->to($to);
    //         $this->email->reply_to($from_email, $from_name);
    //         $this->email->subject($this->email_setting_model->get('admin_has_send_password_reset_link_subject'));

    //         $verification_key = md5($memQ->id.$this->config->item('encryption_key').$memQ->id);
    //         $this->members_model->update(array('verification_key'=>$verification_key), $memQ->id);
    //         $verify_url = site_url('verify_pwd/'.$verification_key);

    //         if(strcasecmp($memQ->member_type, 'group')==0){
    //             $full_name = $memQ->group_name;
    //         }else{
    //             $full_name = $memQ->first_name . ' ' . $memQ->last_name;
    //         }

    //         $message = str_replace('[Username]', $full_name, nl2br($this->email_setting_model->get('admin_has_send_password_reset_link_body')));
    //         $message.= "<br><br><a href=\"$verify_url\" style=\"background-color: #1E90FF; border: none; color: white;padding: 15px 32px;text-align: center; text-decoration: none;display: inline-block;font-size: 15px;margin: 4px 2px; cursor: pointer;\">CREATE YOUR PASSWORD</a>";


    //         $this->email->message($message);
    //         if ($this->email->send()) {
    //             setFlashMessage('flash_success', 'alert alert-success', 'Successfully sent password reset link.');
    //         } else {
    //             setFlashMessage('flash_error', 'alert alert-danger', $this->email->print_debugger());
    //         }

    //         redirect($this->input->get('back'));
    //     }
    // }


    /* end */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
