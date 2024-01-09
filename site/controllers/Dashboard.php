<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Dashboard extends Member_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['module'] = 'site';
        $data['template'] = 'dashboard';
        echo Modules::run('templates/dashboardLayout', $data);
    }

    function logout()
    {
        if ($this->is_user_logged_in == TRUE) {
            if (intval($this->session->userdata('user_id')) >= 1) {
                $this->session->unset_userdata('is_user_logged_in');
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('user_name');
                $this->session->unset_userdata('user_secret_key');
                $this->session->sess_destroy();
            }
        }

        redirect(site_url() . 'login');
        exit;
    }


    public function course_home()
    {
        $data['module'] = 'site';
        $data['template'] = 'course_home';
        echo Modules::run('templates/dashboardLayout', $data);
    }

    public function about_this_ourse()
    {
        $data['module'] = 'site';
        $data['template'] = 'about_this_ourse';
        echo Modules::run('templates/dashboardLayout', $data);
    }
    public function support()
    {
        
        $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
        $this->form_validation->set_rules('support_content', 'Support', $this->config->item('form_base') . '|required|max_length[2500]');

        if ($this->form_validation->run() == TRUE) {
            $to =  trim($this->email_setting_model->get('support_page_forward_email_to')); 
            $memQ = $this->members_model->fromId($this->logged_in_member_id);

            if(strcasecmp($memQ->member_type, 'Group')==0){
                $from_name = $memQ->group_name;
            }else{
                $from_name = $memQ->first_name . ' ' . $memQ->last_name;
            }

            $from_email = $this->email_setting_model->get('out_going_email'); 
            $email_body = nl2br($this->input->post('support_content'));
            
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from($from_email, $from_name);
            $this->email->to($to);
            $this->email->reply_to($memQ->email, $from_name);
            $this->email->subject($this->email_setting_model->get('support_page_subject'));

            $message = <<<EOF
                    <br><br>
                    {$email_body}
                    <br><br>
EOF;

//             $message = <<<EOF
//                     <strong>Sender Name: </strong> {$from_name}
//                     <br>
//                     <strong>Sender Email: </strong> {$memQ->email}
//                     <br><br>

//                     {$email_body}
//                     <br><br>
// EOF;


            $this->email->message($message);

            if ($this->email->send()) {
                setFlashMessage('flash_success', 'alert alert-success', 'Successfully sent question');
                redirect(site_url('dashboard/support'));
            } else {
                setFlashMessage('flash_error', 'alert alert-danger', $this->email->print_debugger());
                redirect(site_url('dashboard/support'));
            }
        }

        $data['module'] = 'site';
        $data['template'] = 'support';
        echo Modules::run('templates/dashboardLayout', $data);
    }
    public function course_evaluation()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('course_evaluation_content', 'Course Evaluation', $this->config->item('form_base') . '|required|max_length[2500]');

            if ($this->form_validation->run() == TRUE) {

                $memQ = $this->members_model->fromId($this->logged_in_member_id);

                $to =  trim($this->email_setting_model->get('course_evaluation_forward_email_to')); //trim($this->setting_model->get('email_primary'));
                $from_email = $this->email_setting_model->get('out_going_email'); //$memQ->email; $this->config->item('email_from_email');
                $email_body = nl2br($this->input->post('course_evaluation_content'));

                if(strcasecmp($memQ->member_type, 'Group')==0){
                    $from_name = $memQ->group_name;
                }else{
                    $from_name = $memQ->first_name . ' ' . $memQ->last_name;
                }

                $this->load->library('email');
                $this->email->set_newline("\r\n");

                $this->email->from($from_email, $from_name);
                $this->email->to($to);
                $this->email->reply_to($memQ->email, $from_name);

                $this->email->subject($this->email_setting_model->get('course_evaluation_subject'));

//                 $message = <<<EOF
//                         <strong>Sender Name: </strong> {$from_name}
//                         <br>
//                         <strong>Sender Email: </strong> {$memQ->email}
//                         <br><br>

//                         {$email_body}
//                         <br><br>
// EOF;

$message = <<<EOF
                        <br><br>
                        {$email_body}
                        <br><br>
EOF;


                $this->email->message($message);
                // $this->email->send();
                // echo $this->email->print_debugger();

                if ($this->email->send()) {
                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully sent Course Evaluation');
                    redirect(site_url('dashboard/course_evaluation'));
                } else {
                    setFlashMessage('flash_error', 'alert alert-danger', $this->email->print_debugger());
                    redirect(site_url('dashboard/course_evaluation'));
                }
            }
        }
        $data['module'] = 'site';
        $data['template'] = 'course_evaluation';
        echo Modules::run('templates/dashboardLayout', $data);
    }



    function change_password()
    {


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $send_verification = false;
            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            //$this->form_validation->set_rules('old_password', 'Old password', $this->config->item('form_base') . '|required|is_old_password_matched[' . $this->logged_in_member_id . ']');
            $this->form_validation->set_rules('new_password', 'New Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[new_password]');

            if ($this->form_validation->run() == TRUE) {
                $new_password = $this->members_model->change_password($this->logged_in_member_id);
                if ($new_password) {
                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully changed password. ');
                    redirect(site_url('dashboard/change_password'));
                } else {
                    setFlashMessage('flash_error', 'alert alert-danger', 'Unable to change password. ');
                    redirect(site_url('dashboard/change_password'));
                }
            }
        }

        $data['module'] = 'site';
        $data['member_id'] = $this->logged_in_member_id;
        $data['template'] = 'change_password';
        $data['web_title'] = "Settings";
        $data['page_header'] = 'Change Password';
        echo Modules::run('templates/dashboardLayout', $data);
    }


    function session()
    {
        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        if (strcasecmp($mem_type->member_type, "group") == 0) {
            $group_id = $this->session->userdata('user_id');
            $config = array();
            $config['base_url'] = site_url('dashboard/student_roster');
            //$config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'Student', 'group_id'=>$group_id));
            $config['total_rows'] = $this->members_model->getWhereTotal(array('capability' => 'member', 'member_type' => 'Session', 'group_id' => $group_id));
            $config["uri_segment"] = 3;
            $config['per_page'] = 5000;//$this->config->item('per_page');
            $config['first_link'] = 'First';
            $config['full_tag_open'] = ' <div class="pagination pagination-centered"><nav><ul class="pagination pull-right">';
            $config['full_tag_close'] = '</ul></nav></div>';
            $config['cur_tag_open'] = '<li class="active page-item"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability' => 'member', 'member_type' => 'Session', 'group_id' => $group_id), '*', 'id');
            $data["links"] = $this->pagination->create_links();
            $data['module'] = 'site';
            $data['template'] = 'session';
            $data['web_title'] = "My Students";
            $data['page_header'] = 'My Students';
            $data['export'] = 'student';
            echo Modules::run('templates/dashboardLayout', $data);
        } else {
            redirect(site_url());
        }
    }

    function student_rosters($group_id)
    {
        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        $sessionQ = $this->members_model->fromId($group_id);
        if (strcasecmp($mem_type->member_type, "Group") == 0 && strcasecmp($mem_type->id, $sessionQ->group_id) == 0) {
            
            //$group_id = $mem_type->id;
            $config = array();
            $config['base_url'] = site_url('dashboard/student_roster');
            $config['total_rows'] = $this->members_model->getWhereTotal(array('capability' => 'member', 'member_type' => 'Student', 'group_id' => $group_id));

            $config["uri_segment"] = 3;
            $config['per_page'] = 5000;//$this->config->item('per_page');
            $config['first_link'] = 'First';
            $config['full_tag_open'] = ' <div class="pagination pagination-centered"><nav><ul class="pagination pull-right">';
            $config['full_tag_close'] = '</ul></nav></div>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability' => 'member', 'member_type' => 'Student', 'group_id' => $group_id), '*', 'last_name',"ASC");
            //echo $this->db->last_query();
            $data["links"] = $this->pagination->create_links();
            $data['module'] = 'site';
            $data['template'] = 'student_rosters';
            $data['web_title'] = "Student Rosters";
            $data['page_header'] = 'Student Rosters';
            $data['group'] = $mem_type;
            $data['group_id']=$group_id;
            $data['sessionQ'] = $sessionQ;
            echo Modules::run('templates/dashboardLayout', $data);
        } else {
            redirect(site_url());
        }
    }

    function session_billing($group_id)
    {
        //echo $this->session->userdata('user_id');
        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        $sessionQ = $this->members_model->fromId($group_id);
        if (strcasecmp($mem_type->member_type, "Group") == 0 && strcasecmp($mem_type->id, $sessionQ->group_id) == 0) {
            $data['module'] = 'site';
            $data['template'] = 'session_billing';
            $data['web_title'] = "Billing Statement";
            $data['page_header'] = 'Session Billing';
            //$this->members_model->primary_key = "group_id";
            $mem_type = $this->members_model->fromId($group_id);
            //$data['group'] = $this->members_model->get_selected_where($this->session->userdata('user_id'));//$mem_type;
            $data['group'] = $mem_type;
            $data['sessionQ'] = $sessionQ;
            echo Modules::run('templates/dashboardLayout', $data);
        } else {
            redirect(site_url());
        }
    }

    function session_payment($group_id)
    {
        $groupQry = $this->members_model->fromId($this->session->userdata('user_id'));
        $mem_type = $this->members_model->fromId($group_id);

        if (strcasecmp($groupQry->member_type, "Group") == 0 && strcasecmp($mem_type->group_id, $this->session->userdata('user_id')) == 0) {

            //if already made payment
            if (strcasecmp($mem_type->payment_status, 1) == 0) {

                setFlashMessage('flash_success', 'alert alert-success', 'You have already made payment.');
                redirect(site_url('dashboard/session_billing/' . $group_id));
            } else { //if payment is not already made
                $paymnet_amount = $mem_type->per_student_rate * $this->members_model->getWhereTotal(array('group_id' => $mem_type->id));

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                    $this->form_validation->set_rules('card-number', 'Card Number', $this->config->item('form_base') . '|required|numeric|min_length[16]|max_length[16]');
                    $this->form_validation->set_rules('card-cvc', 'Card CVC', $this->config->item('form_base') . '|required|numeric|min_length[3]|max_length[4]');
                    $this->form_validation->set_rules('card-expiry-month', 'Card Expiry Month', $this->config->item('form_base') . '|required|numeric|min_length[2]|max_length[2]');
                    $this->form_validation->set_rules('card-expiry-year', 'Card Expiry Year', $this->config->item('form_base') . '|required|numeric|min_length[4]|max_length[4]');
                
                    // $this->form_validation->set_rules('card-number', 'Card Number', $this->config->item('form_base') . '|required');
                    // $this->form_validation->set_rules('card-cvc', 'Card CVC', $this->config->item('form_base') . '|required');
                    // $this->form_validation->set_rules('card-expiry-month', 'Card Expiry Month', $this->config->item('form_base') . '|required');
                    // $this->form_validation->set_rules('card-expiry-year', 'Card Expiry Year', $this->config->item('form_base') . '|required');

                    if ($this->form_validation->run() == TRUE) {
                        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
                        $token  = $_POST['stripeToken'];
                        $customer = \Stripe\Customer::create(array(
                            'email' => $this->input->post('email'),
                            'card'  => $token,
                            'description' => 'Paid for course',
                            "metadata" => array("name" => $mem_type->first_name . ' ' . $mem_type->last_name, 'email' => $mem_type->email)
                        ));

                        $charge = \Stripe\Charge::create(array(
                            'customer' => $customer->id,
                            'amount'   => intval($paymnet_amount) * 100,
                            'currency' => 'usd',
                            'description' => 'Paid for session ' . $mem_type->session_name,
                            "metadata" => array("name" => $mem_type->first_name . ' ' . $mem_type->last_name, 'email' => $mem_type->email)
                        ));

                        if ($charge) {
                            //print_pre($charge);
                            //echo $charge->id;
                            //exit;
                            $this->members_model->update(array('payment_status' => 1, 'stripe_receipt_url' => $charge->receipt_url, 'payment_date' => current_mysql_date()), $mem_type->id);

                            $to =  trim($this->setting_model->get("email_primary"));
                            $from_name = $this->config->item('email_from_name');
                            $from_email = $this->config->item('email_from_email');

                            $this->load->library('email');
                            $this->email->set_newline("\r\n");
                            $this->email->from($from_email, $from_name);
                            $this->email->to($to);
                            $this->email->reply_to($from_email, $from_name);
                            $this->email->subject('Payment from ' . $mem_type->group_name);

                            $message = <<<EOF
                        <strong>Hi </strong> 
                        <br><br>
                        USD {$paymnet_amount} paid for session {$mem_type->session_name} from {$mem_type->group_name} ({$mem_type->email}).
                        <br><br>
EOF;


                            $this->email->message($message);
                            $this->email->send();
                            setFlashMessage('flash_success', 'alert alert-success', 'Your payment has been approved. Your receipt will post to your account within one business day. Please print this page for your records.');
                            redirect(site_url('dashboard/session_billing/' . $group_id));

                            //                            if ($this->email->send()) {
                            //                                setFlashMessage('flash_success','alert alert-success' ,'You have successfully enrolled in this course. Please check your email for login instructions.');
                            //                                redirect(site_url('enroll'));
                            //                            }else{
                            //                                setFlashMessage('flash_error','alert alert-danger' ,'Could not send email.');
                            //                                redirect(site_url('enroll'));
                            //                            }


                        } else {
                            setFlashMessage('flash_error', 'alert alert-danger', 'Unable to process payment.');
                            redirect(site_url('dashboard/session_billing/' . $group_id));
                        }
                    }
                }

                $data['module'] = 'site';
                $data['template'] = 'session_payment';
                $data['web_title'] = "Credit Card Payment";
                $data['page_header'] = 'v';
                $data['group'] = $mem_type;
                $data['payable_amount'] = $paymnet_amount;
                
                echo Modules::run('templates/dashboardLayout', $data);
            }
        } else {
            redirect(site_url());
        }
    }


    function student_rosters_pdf($group_id)
    {
        
        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        $group = $this->members_model->get_selected_rows_where(array('id'=>intval($group_id)));
        // print_pre($mem_type);
        // print_pre($group);
        // echo $mem_type->id."=". $group[0]->group_id;
        // exit;
        if (strcasecmp($mem_type->member_type, "Group") == 0 && strcasecmp($mem_type->id, $group[0]->group_id) == 0) {
            $sql = "select * from members where members.group_id =$group_id order by last_name ASC";
            $query = $this->db->query($sql);
            if ($query->num_rows() >= 1) {
                //                foreach ($query->result() as $row) {
                //
                ////                    $preCountryQuery = $this->post_category_model->fromId($row->preferred_country);
                ////                    $preCollegeQuery = $this->post_model->fromId($row->preferred_college);
                ////                    $countryQuery = $this->post_category_model->fromId($row->country);
                //
                //                    $data['first_name'] = $row->first_name;
                //                    $data['last_name'] = $row->last_name;
                //                    $data['country'] = $row->country;
                //                    $data['email'] = $row->email;
                //                    $data['added_date'] = custom_date_format($row->created);
                //
                //                }
                $data['query'] = $query;



                $student_content = $this->load->view('student_roster_pdf_preview', $data, true);

                //                //pdf
                //                $dompdf = new Dompdf();
                //                $option = new Options();
                //
                //                $dompdf->setOptions($option->set('isRemoteEnabled', true));
                //                $dompdf->loadHtml($student_content);
                //                $dompdf->setPaper('A4', 'portrait'); //landscape portrait
                //                $dompdf->render();
                //                $dompdf->stream('student_details_'.md5(time()));




                $data['student_content'] = $student_content;
                $data['module'] = 'site';
                $data['template'] = 'student_roster_pdf_preview';
                echo Modules::run('templates/printLayout', $data);
            }
        } else {
            redirect(site_url());
        }
    }


    function edit_profile()
    {

        $result = $this->members_model->fromId($this->logged_in_member_id);


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $send_verification = false;
            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('first_name', 'First Name', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('last_name', 'Last Name', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('dob', 'Date of birth', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('gender', 'gender', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('address_one', 'Address one', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('city', 'City', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('state_pro_region', 'state', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('zip_code', 'zip code', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('country', 'country', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('phone', 'phone', $this->config->item('form_base') . '|required');


            if (strcasecmp($result->email, trim($this->input->post('email'))) == 0) {
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]');
            } else {
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');
            }

            if ($this->form_validation->run() == TRUE) {
                $update = $this->members_model->profile_update($this->logged_in_member_id);
                if ($update) {
                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully edited profile. ');
                    redirect(site_url('dashboard/edit_profile'));
                } else {
                    setFlashMessage('flash_error', 'alert alert-danger', 'Unable to edit profile. ');
                    redirect(site_url('dashboard/edit_profile'));
                }
            }
        }

        $data['result'] = $result;
        $data['country'] = $this->post_category_model->get_country();
        $data['module'] = 'site';
        $data['template'] = 'edit_profile';
        echo Modules::run('templates/siteLayout', $data);
    }


    function msg_compose()
    {

        $result = $this->members_model->fromId($this->logged_in_member_id);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('subject', 'Subject', $this->config->item('form_base') . '|required|min_length[5]|max_length[200]');
            $this->form_validation->set_rules('message', 'Message', $this->config->item('form_base') . '|required|min_length[5]|max_length[1000]');

            if ($this->form_validation->run() == TRUE) {

                $to = $this->setting_model->get_setting($this->config->item('active_user'), 'email_primary');
                $from_name = trim($result->first_name . ' ' . $result->last_name);
                $from_email = trim($result->email);

                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->from($from_email, $from_name);
                $this->email->to($to);
                $this->email->reply_to($from_email, $from_name);

                $this->email->subject(ucfirst(trim($this->input->post('subject'))));

                $message = <<<EOF
                    <strong>User Id:</strong> {$result->id}
                        <br><br>

                        <strong>Name:</strong> {$from_name}
                        <br><br>

                         <strong>Email:</strong> {$from_email}
                        <br><br>

                        <strong>Telephone:</strong> {$this->input->post('telephone')}


                        <strong>Subject:</strong> {$this->input->post('subject')}
                        <br><br>

                        <strong>Message:</strong> {$this->input->post('message')}
                        <br><br>
EOF;

                $this->email->message($message);
                if ($this->email->send()) {
                    $this->message_model->insert(array('user_id' => $this->logged_in_member_id, 'subject' => $this->input->post('subject'), 'message' => $this->input->post('message')));
                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully sent email.');

                    redirect(site_url('dashboard/msg_compose'));
                } else {
                    show_error($this->email->print_debugger());
                }
            }
        }


        $data['module'] = 'site';
        $data['template'] = 'msg_compose';
        $data['web_title'] = 'Message Compose';
        echo Modules::run('templates/siteLayout', $data);
    }


    function delete_doc($id)
    {
        $resultMember = $this->members_model->fromId($this->logged_in_member_id);
        $resultDocument = $this->document_model->fromId($id);

        if ($this->logged_in_member_id == $resultDocument->user_id) {

            if (isset($resultDocument->document)) {
                @unlink(FCPATH . '/assets/upload/' . $resultDocument->document);
            }

            $this->document_model->delete($id);

            setFlashMessage('flash_error', 'alert alert-success', 'Successfully deleted');
            redirect(site_url('dashboard/my_document'));
        } else {
            setFlashMessage('flash_error', 'alert alert-danger', 'Searched ID "' . $id . '" not found.');
            redirect(site_url('dashboard/my_document'));
        }
    }


    function my_study_preference()
    {

        $result = $this->members_model->fromId($this->logged_in_member_id);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('preferred_country', 'Country', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('preferred_college', 'College', $this->config->item('form_base') . '|required');
            if ($this->form_validation->run() == TRUE) {
                $update = $this->members_model->my_study_preference_update($this->logged_in_member_id);
                if ($update) {
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                    $config['overwrite'] = false;
                    $config['max_size'] = $this->config->item('image_max_size');
                    $config['max_width'] = 2000; //$this->config->item('image_max_width');
                    $config['max_height'] = 2000;
                    $this->config->item('image_max_height');
                    $config['max_filename'] = '100';
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name'] = TRUE;
                    $config['quality'] = 100;
                    $config['upload_path'] = './assets/upload';
                    $this->upload->initialize($config);
                    $doc_upload_status = false;


                    $doc = array();
                    foreach ($_FILES as $key => $value) {

                        if ($key == 'docs') {
                            $files = $_FILES;
                            $cpt = count($_FILES['docs']['name']);

                            for ($i = 0; $i < $cpt; $i++) {
                                $_FILES['docs']['name'] = $files['docs']['name'][$i];
                                $_FILES['docs']['type'] = $files['docs']['type'][$i];
                                $_FILES['docs']['tmp_name'] = $files['docs']['tmp_name'][$i];
                                $_FILES['docs']['error'] = $files['docs']['error'][$i];
                                $_FILES['docs']['size'] = $files['docs']['size'][$i];

                                if (!$this->upload->do_upload('docs')) {

                                    $doc_upload_status = false;
                                    setFlashMessage('flash_error', 'alert alert-danger', $this->upload->display_errors());
                                    redirect(current_url());
                                    exit;
                                } else {

                                    $doc_upload_status = true;
                                    $file_attr = $this->upload->data();
                                    $doc[] = $file_attr['file_name'];
                                }
                            }
                        }
                    }

                    if ($doc_upload_status) {
                        if (count($doc) >= 1) {
                            foreach ($doc as $dov_key => $doc_value) {
                                $this->document_model->insert(array('user_id' => $this->session->userdata('user_id'), 'document' => $doc_value, 'pre_country_id' => $this->input->post('preferred_country'), 'pre_college_id' => $this->input->post('preferred_college')));
                            }
                        }
                    }

                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully update. ');
                    redirect(site_url('dashboard/my_study_preference'));
                } else {
                    setFlashMessage('flash_error', 'alert alert-danger', 'Unable to add. ');
                    redirect(site_url('dashboard/my_study_preference'));
                }
            }
        }

        $data['preferred_country'] = $this->post_category_model->get_country();
        $data['chain'] = $this->post_category_model->chain_college();
        $data['preferred_college'] = $this->post_model->get_college();

        $data['result'] = $result;
        $data['module'] = 'site';
        $data['template'] = 'my_study_preference';
        echo Modules::run('templates/siteLayout', $data);
    }

    function play_video($module_id)
    {

        $queryVideoModule = $this->module_video_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryVideoModule) {

            $video_arr = [];
            foreach ($queryVideoModule->result() as $rowVideo) {

                $video_arr["video_" . $rowVideo->id] = $rowVideo->_order;
            }
        }

        $querySlideModule = $this->module_slide_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($querySlideModule) {
            $slide_arr = [];
            foreach ($querySlideModule->result() as $rowSlide) {

                $slide_arr["slide_" . $rowSlide->id] = $rowSlide->_order;
            }
        }

        $queryQuizModule = $this->module_quiz_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryQuizModule) {
            $quiz_arr = [];
            foreach ($queryQuizModule->result() as $rowQuiz) {
                $quiz_arr["quiz_" . $rowQuiz->id] = $rowQuiz->_order;
            }
        }


        $dataSets = array_merge($video_arr, $slide_arr, $quiz_arr);
        asort($dataSets);

        if (count($dataSets) >= 1) {
            $unit_string = '';
            $unit = 1;
            foreach ($dataSets as $key => $value) {
                $module_arr = explode("_", $key);
                $moduleType = $module_arr[0];
                $moduleTypeId = $module_arr[1];
                if (strcasecmp($moduleType, 'video') == 0) {
                    //$unit_page = 1;
                    $unit_page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                    $unit_query = $this->module_video_model->fetch(1, $unit_page, array('module_id' => $module_id), '*', '_order', 'ASC');
                    //echo $this->db->last_query();
                    if ($unit_query) {
                        foreach ($unit_query->result() as $unit_row) {
                            if ($moduleTypeId == $unit_row->id) {
                                $unit_string = "Unit" . $unit;
                                break;
                            }
                        }
                    }
                    //$unit_page++;
                }
                $unit++;
            }
        }



        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        $group_id = $mem_type->id;
        $per_page = 1;
        $config = array();
        // $config['prefix'] = '/page/';
        // $config['suffix'] = '/item_per_page/1';
        $config['base_url'] = site_url('dashboard/play_video/' . $module_id);
        $config['total_rows'] = $this->module_video_model->getWhereTotal(array('module_id' => $module_id));
        $config["uri_segment"] = 4;
        $config['per_page'] = $per_page;
        $config['first_link'] = 'First';
        $config['full_tag_open'] = '<nav style="display: inline-block;"><ul class="pagination pagination-sm" style="display: inline-block;">'; //  justify-content-center
        $config['full_tag_close'] = '</ul></nav>';
        $config['cur_tag_open'] = '<li class="active page-item"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item" style="display:none;">';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        //$config['anchor_class'] = 'class="page-link" ';
        $config['attributes'] = array('class' => 'page-link');
        $config['display_pages'] = FALSE;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = 'Next';



        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['module'] = 'site';
        $data["query"] = $this->module_video_model->fetch($per_page, $page, array('module_id' => $module_id), '*', '_order', 'ASC');
        $data["links"] = $this->pagination->create_links();
        $data['template'] = 'play_video';
        $data['module_id'] = $module_id;
        $data['page'] = $page;
        $data['web_title'] = "Video Test";
        $data['page_header'] = 'Video Test';
        $data['group'] = $mem_type;
        $data['unit_string'] = $unit_string;
        echo Modules::run('templates/dashboardLayout', $data);
    }

    function quiz($module_id)
    {
        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        $quiz_query = $this->module_quiz_model->fromId(intval($this->uri->segment(4)));

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $chosen = $this->input->post('question_ans');


            $chosen_ans = [];
            if (count($chosen) >= 1) {
                $question_cnt = 0;
                $empty_answer_cnt = 0;
                $given_ans = 0;
                foreach ($chosen as $question_id => $ans) {

                    if (empty($ans[0])) {
                        $empty_answer_cnt++;
                    } else {
                        $given_ans++;
                    }
                    $question_cnt++;
                }
                if ($question_cnt == $empty_answer_cnt || $question_cnt != $given_ans) {  //if answer is not choosen
                    setFlashMessage('flash_error', 'alert alert-danger', 'Please select answer of all questions');
                    redirect(site_url('dashboard/quiz/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/?_a=' . urlencode(serialize($chosen))));
                    exit;
                } else {

                    $queryQuiz = $this->module_quiz_submission_model->get_selected_where(array('quiz_id' => $quiz_query->id, 'user_id' => $this->session->userdata('user_id')));
                    //echo $this->db->last_query();
                    if ($queryQuiz) { //update - retake
                        $this->module_quiz_submission_model->update_where(
                            array(
                                'ques_ans' => serialize($chosen)
                            ),
                            array('quiz_id' => $quiz_query->id, 'user_id' => $this->session->userdata('user_id'))
                        );
                    } else { //add - take
                        $this->module_quiz_submission_model->insert(array(
                            'user_id' => $this->session->userdata('user_id'),
                            'quiz_id' => $quiz_query->id,
                            'ques_ans' => serialize($chosen)
                        ));
                    }

                    $queryQuiz = $this->module_quiz_submission_model->get_selected_where(array('quiz_id' => $quiz_query->id, 'user_id' => $this->session->userdata('user_id')));
                    redirect(site_url('dashboard/quiz_result/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)));
                    exit;
                }
            }
        }
        $queryVideoModule = $this->module_video_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryVideoModule) {

            $video_arr = [];
            foreach ($queryVideoModule->result() as $rowVideo) {

                $video_arr["video_" . $rowVideo->id] = $rowVideo->_order;
            }
        }

        $querySlideModule = $this->module_slide_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($querySlideModule) {
            $slide_arr = [];
            foreach ($querySlideModule->result() as $rowSlide) {

                $slide_arr["slide_" . $rowSlide->id] = $rowSlide->_order;
            }
        }

        $queryQuizModule = $this->module_quiz_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryQuizModule) {
            $quiz_arr = [];
            foreach ($queryQuizModule->result() as $rowQuiz) {
                $quiz_arr["quiz_" . $rowQuiz->id] = $rowQuiz->_order;
            }
        }


        $dataSets = array_merge($video_arr, $slide_arr, $quiz_arr);
        asort($dataSets);

        if (count($dataSets) >= 1) {
            $unit_string = '';
            $unit = 1;
            foreach ($dataSets as $key => $value) {
                $module_arr = explode("_", $key);
                $moduleType = $module_arr[0];
                $moduleTypeId = $module_arr[1];
                if (strcasecmp($moduleType, 'quiz') == 0) {

                    $unit_query = $this->module_quiz_model->get_selected_where(array('module_id' => $module_id));
                    if ($unit_query) {
                        foreach ($unit_query->result() as $unit_row) {
                            if ($moduleTypeId == $unit_row->id) {
                                $unit_string = "Unit" . $unit;
                                break;
                            }
                        }
                    }
                    //$unit_page++;
                }
                $unit++;
            }
        }

        $group_id = $mem_type->id;
        $data['module'] = 'site';
        //$data['chosen'] = $chosen;
        $data['template'] = 'quiz';
        $data['module_id'] = $module_id;
        $data['web_title'] = "Quiz Test";
        $data['page_header'] = 'Quiz Test';
        $data['quiz_query'] = $quiz_query;
        $data['group'] = $mem_type;
        $data['unit_string'] = $unit_string;
        echo Modules::run('templates/dashboardLayout', $data);
    }


    function quiz_result($module_id)
    {
        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        $quiz_query = $this->module_quiz_model->fromId(intval($this->uri->segment(4)));


        $queryVideoModule = $this->module_video_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryVideoModule) {

            $video_arr = [];
            foreach ($queryVideoModule->result() as $rowVideo) {

                $video_arr["video_" . $rowVideo->id] = $rowVideo->_order;
            }
        }

        $querySlideModule = $this->module_slide_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($querySlideModule) {
            $slide_arr = [];
            foreach ($querySlideModule->result() as $rowSlide) {

                $slide_arr["slide_" . $rowSlide->id] = $rowSlide->_order;
            }
        }

        $queryQuizModule = $this->module_quiz_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryQuizModule) {
            $quiz_arr = [];
            foreach ($queryQuizModule->result() as $rowQuiz) {
                $quiz_arr["quiz_" . $rowQuiz->id] = $rowQuiz->_order;
            }
        }


        $dataSets = array_merge($video_arr, $slide_arr, $quiz_arr);
        asort($dataSets);

        if (count($dataSets) >= 1) {
            $unit_string = '';
            $unit = 1;
            foreach ($dataSets as $key => $value) {
                $module_arr = explode("_", $key);
                $moduleType = $module_arr[0];
                $moduleTypeId = $module_arr[1];
                if (strcasecmp($moduleType, 'quiz') == 0) {

                    $unit_query = $this->module_quiz_model->get_selected_where(array('module_id' => $module_id));
                    if ($unit_query) {
                        foreach ($unit_query->result() as $unit_row) {
                            if ($moduleTypeId == $unit_row->id) {
                                $unit_string = "Unit" . $unit;
                                break;
                            }
                        }
                    }
                    //$unit_page++;
                }
                $unit++;
            }
        }


        $queryQuizSubmitted = $this->module_quiz_submission_model->get_selected_where(array('quiz_id' => $quiz_query->id, 'user_id' => $this->session->userdata('user_id')));
        $submittedAnsArr = [];
        if ($queryQuizSubmitted) {
            $submittedAnsArr = unserialize($queryQuizSubmitted->row()->ques_ans);
        }

        $question_query = $this->quiz_question_model->get_selected_where(array('module_quiz_id' => intval($this->uri->segment(4))));
        if ($question_query) {
            $total_question = 0;
            $total_correct_ans = 0;
            foreach ($question_query->result() as $question_row) {

                if (count($submittedAnsArr) >= 1) {
                    $given_answer = $submittedAnsArr[$question_row->id][0];
                    if (strcasecmp(trim($given_answer), trim($question_row->correct_ans)) == 0) {
                        $total_correct_ans++;
                    }
                }

                $total_question++;
            }
        }

        $quiz_comment_query = $this->quiz_comment_model->get_selected_where(array('quiz_id' => intval($this->uri->segment(4))));
        $quizScoresArr = [];
        $quizCommentArr = [];
        if ($quiz_comment_query) {
            $quizCommentArr = unserialize($quiz_comment_query->row()->comments);
            foreach (unserialize($quiz_comment_query->row()->scores) as $score_key => $score_val) {
                $quizScoresArr[$score_val] = $quizCommentArr[$score_key];
            }
        }



        $group_id = $mem_type->id;
        $data['module'] = 'site';
        $data['quizScoresArr'] = $quizScoresArr;
        $data['total_question'] = $total_question;
        $data['total_correct_ans'] = $total_correct_ans;
        $data['template'] = 'quiz_result';
        $data['module_id'] = $module_id;
        $data['web_title'] = "Quiz Test";
        $data['page_header'] = 'Quiz Test';
        $data['quiz_query'] = $quiz_query;
        $data['group'] = $mem_type;
        $data['unit_string'] = $unit_string;
        echo Modules::run('templates/dashboardLayout', $data);
    }

    function review_quiz($module_id)
    {
        $mem_type = $this->members_model->fromId($this->session->userdata('user_id'));
        $quiz_query = $this->module_quiz_model->fromId(intval($this->uri->segment(4)));

        $queryReviewQuiz = $this->module_quiz_submission_model->get_selected_where(array('quiz_id' => $quiz_query->id, 'user_id' => $this->session->userdata('user_id')));
        //echo $this->db->last_query();
        if ($queryReviewQuiz) {
            $data['queryReviewQuiz'] = $queryReviewQuiz->row();
        } else { // can't review if quiz is not started yet
            //setFlashMessage('flash_error', 'alert alert-danger', 'Please select answer(s)');
            redirect(site_url('dashboard/quiz/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)));
        }




        $queryVideoModule = $this->module_video_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryVideoModule) {

            $video_arr = [];
            foreach ($queryVideoModule->result() as $rowVideo) {

                $video_arr["video_" . $rowVideo->id] = $rowVideo->_order;
            }
        }

        $querySlideModule = $this->module_slide_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($querySlideModule) {
            $slide_arr = [];
            foreach ($querySlideModule->result() as $rowSlide) {

                $slide_arr["slide_" . $rowSlide->id] = $rowSlide->_order;
            }
        }

        $queryQuizModule = $this->module_quiz_model->get_selected_query_where(array('module_id' => $module_id), '*', 'ASC', '_order');
        if ($queryQuizModule) {
            $quiz_arr = [];
            foreach ($queryQuizModule->result() as $rowQuiz) {
                $quiz_arr["quiz_" . $rowQuiz->id] = $rowQuiz->_order;
            }
        }


        $dataSets = array_merge($video_arr, $slide_arr, $quiz_arr);
        asort($dataSets);

        if (count($dataSets) >= 1) {
            $unit_string = '';
            $unit = 1;
            foreach ($dataSets as $key => $value) {
                $module_arr = explode("_", $key);
                $moduleType = $module_arr[0];
                $moduleTypeId = $module_arr[1];
                if (strcasecmp($moduleType, 'quiz') == 0) {

                    $unit_query = $this->module_quiz_model->get_selected_where(array('module_id' => $module_id));
                    if ($unit_query) {
                        foreach ($unit_query->result() as $unit_row) {
                            if ($moduleTypeId == $unit_row->id) {
                                $unit_string = "Unit" . $unit;
                                break;
                            }
                        }
                    }
                    //$unit_page++;
                }
                $unit++;
            }
        }




        $group_id = $mem_type->id;

        $data['module'] = 'site';

        $data['template'] = 'quiz_review';
        $data['module_id'] = $module_id;
        $data['web_title'] = "Quiz Test";
        $data['page_header'] = 'Quiz Test';
        $data['quiz_query'] = $quiz_query;
        $data['group'] = $mem_type;
        $data['unit_string'] = $unit_string;
        echo Modules::run('templates/dashboardLayout', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */