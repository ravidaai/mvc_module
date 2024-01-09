<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;



class Site extends MX_Controller
{
    private $stripeApiKey;
    private $stripeService;


    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        echo '-__-';
    }

    public function enroll()
    {

        echo $message;
        if (strcasecmp($this->setting_model->get('credit_card_registration'), 'Y') == 0) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('first_name', 'First Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('last_name', 'Last Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('country', 'Country', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('institution', 'Institution', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');
                $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[8]|max_length[32]|valid_password');
                $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[8]|max_length[32]|matches[pwd]|valid_password');
                $this->form_validation->set_rules('card-number', 'Card Number', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('card-cvc', 'Card CVC', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('card-expiry-month', 'Card Expiry Month', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('card-expiry-year', 'Card Expiry Year', $this->config->item('form_base') . '|required');

                if ($this->form_validation->run() == TRUE) {

                    \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
                    $token  = $_POST['stripeToken'];
                    $customer = \Stripe\Customer::create(array(
                        'email' => $this->input->post('email'),
                        'card'  => $token,
                        'description' => 'Paid for course',
                        "metadata" => array("name" => $this->input->post('first_name') . ' ' . $this->input->post('last_name'), 'email' => $this->input->post('email'))
                    ));

                    $charge = \Stripe\Charge::create(array(
                        'customer' => $customer->id,
                        'amount'   => intval(!empty($this->setting_model->get('course_rate')) ? $this->setting_model->get('course_rate') : 9) * 100,
                        'currency' => 'usd',
                        'description' => 'Paid for course',
                        "metadata" => array("name" => $this->input->post('first_name') . ' ' . $this->input->post('last_name'), 'email' => $this->input->post('email'))
                    ));

                    if ($charge) {
                        $member_id = $this->members_model->registration_frontend();
                        if ($member_id) {

                            $mem_detail = $this->members_model->fromId($member_id);
                            $verification_key = md5($member_id . $this->config->item('encryption_key') . $member_id);
                            $this->members_model->update(array('verification_key' => $verification_key), $member_id);
                            $verify_url = site_url('verify/' . $verification_key);
                            $to =  trim($this->input->post('email'));
                            $from_name = $this->email_setting_model->get('admin_name'); //$this->config->item('email_from_name');
                            $from_email = $this->email_setting_model->get('out_going_email'); //$this->config->item('email_from_email');


                            $this->load->library('email');
                            $this->email->set_newline("\r\n");
                            $this->email->from($from_email, $from_name);
                            $this->email->to($to);
                            $this->email->reply_to($from_email, $from_name);
                            $this->email->subject($this->email_setting_model->get('cc_enrollment_successfull_subject'));


                            $message = str_replace('[Full Name]', $mem_detail->first_name . ' ' . $mem_detail->last_name, nl2br($this->email_setting_model->get('cc_enrollment_body_text')));
                            $message.= "<br><br><a href=\"$verify_url\">ACTIVATE ACCOUNT</a>";
//                             $message = <<<EOF
//                         <strong>Hi</strong> {$this->input->post('fist_name')}
//                         <br><br>

//                         <a href="{$verify_url}">Click here to verify</a>
//                         <br><br>
// EOF;
                            
$this->email->message($message);

                            if ($this->email->send()) {
                                setFlashMessage('flash_success', 'alert alert-success', 'You have successfully enrolled in this course. Please check your email for login instructions.');
                                redirect(site_url('enroll'));
                            } else {
                                setFlashMessage('flash_error', 'alert alert-danger', 'Could not send email.');
                                redirect(site_url('enroll'));
                            }
                        }
                    } else {
                        setFlashMessage('flash_error', 'alert alert-danger', 'Unable to process payment.');
                        redirect(site_url('enroll'));
                    }
                }
            }
        }


        $data['module'] = 'site';
        $data['template'] = 'home';
        //$data['query'] = $this->banner_model->get_selected_rows(array('picture', 'title'));
        $data['countryList'] = $this->country_model->get_list();
        $data['web_title'] = "American Ways Enroll";
        echo Modules::run('templates/siteLayout', $data);
    }

    public function verify($key)
    {
        $this->members_model->primary_key = "verification_key";
        $data = array('status' => '1', 'is_verified' => '1', 'verified_date_time' => current_mysql_date());
        $update = $this->members_model->update($data, $key);
        if ($update) {
            redirect(site_url('login/?verification=' . $key));
        }
    }

    public function verify_pwd($key)
    {
        $this->members_model->primary_key = "verification_key";
        $data = array('status' => '1', 'is_verified' => '1', 'verified_date_time' => current_mysql_date());
        $result = $this->members_model->fromId_field('*',$key);
       
        $update = $this->members_model->update($data, $key);
        if ($update) {
            redirect(site_url('create_pwd/' . $key . '_' . $result->id));
        }
    }


    public function create_pwd($identifier)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');

            $this->form_validation->set_rules('new_password', 'Password', $this->config->item('form_base') . '|required|min_length[8]|max_length[32]|valid_password');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[8]|max_length[32]|matches[new_password]|valid_password');


            if ($this->form_validation->run() == TRUE) {

                $split_identifier = explode('_', $identifier);
                $v_key = trim($split_identifier[0]);
                $std_id = trim($split_identifier[1]);

                $this->members_model->primary_key = "verification_key";
                $get_std_info = $this->members_model->fromId_field('*',$v_key);
                
                if ($get_std_info) {
                    if ($get_std_info->id == intval($std_id)) {
                        
                        $this->members_model->primary_key = "id";
                        $new_password = $this->members_model->change_password($std_id);
                        // echo $this->db->last_query();
                        // exit;
                        if ($new_password) {

                            $user = $this->members_model->check_user(strtolower($get_std_info->email));
                            if ($user->capability == 'member') {

                                if ($user->status == '1') {
                         
                                       // if (get_salted($user->salt, $this->input->post('new_password')) == $user->pwd) {

                                        // $date1  =   date_create(current_date());
                                        // $date2  =   date_create($user->end_date);
                                        // $interval = date_diff($date1, $date2);

                                        $this->members_model->update_total_login($user->id);
                                        // $user_data = array(
                                        //     'user_id' => $user->id,
                                        //     'user_name' => $user->user_name,
                                        //     'user_secret_key' => user_secret_key($this->config->item('encryption_key'), trim($this->input->post('new_password'))),
                                        //     'is_user_logged_in' => TRUE
                                        // );
                                        // $this->session->set_userdata($user_data);
                                        redirect(site_url() . 'dashboard');

                                        // if ($interval->format("%R%a") >= 1){

                                        //     $this->members_model->update_total_login($user->id);
                                        //     $user_data = array(
                                        //         'user_id' => $user->id,
                                        //         'user_name' => $user->user_name,
                                        //         'user_secret_key' => user_secret_key($this->config->item('encryption_key'), $user->pwd),
                                        //         'is_user_logged_in' => TRUE
                                        //     );

                                        //     $this->session->set_userdata($user_data);
                                        //     redirect(site_url() . 'dashboard');
                                        // }else{
                                        //     setFlashMessage('flash_error', 'alert alert-danger', 'Your account has been suspended. Please contact us for more information.');
                                        //     redirect(site_url() . 'login');
                                        // }


                                    // } else {

                                    //     setFlashMessage('flash_error', 'alert alert-danger', 'Invalid username or password. Please try again.');
                                    //     redirect(current_url());
                                    // }
                                } else {

                                    setFlashMessage('flash_error', 'alert alert-danger', 'Your account has been suspended. Please contact us for more information.');
                                    redirect(current_url());
                                }
                            } else {
                                setFlashMessage('flash_error', 'alert alert-danger', 'Your account has been suspended. Please contact us for more information.');
                                redirect(current_url());
                            }
                        }
                    }
                }
            }
        }


        $data['module'] = 'site';
        $data['template'] = 'email_verification_create_password';
        $data['web_title'] = "Create Password";
        echo Modules::run('templates/siteLayout', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
