<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

//controller after login or registration
class Student extends Super_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {

        redirect(site_url('members/dashboard'));
        exit;

    }

    public function manage(){

        $config = array();
        $config['base_url'] = site_url('student/manage');
        $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member'));
        $config["uri_segment"] = 3;
        $config['per_page'] = 1500;//$this->config->item('per_page');
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["query"] = $this->members_model->fetch($config["per_page"], $page, '', '*','id');
        $data["links"] = $this->pagination->create_links();
        $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability'=>'member'), '*','id');
        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='list';
        $data['web_title']="Manage Student";
        $data['page_header']='Manage Student';
        echo Modules::run('templates/adminLayout', $data);
    }

    public function add($id = NULL){

        if($id === NULL){
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

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
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');

                $this->form_validation->set_rules('highest_edu_qualification', 'High Education qualification', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('are_you_current_study', 'Are you crrent studying', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('name_college_university', 'Name of college', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('name_of_qualification_to_achieve', 'Name of qualification achieve', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('emp_status', 'employee satus', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('preferred_country', 'Preferred country', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('preferred_college', 'Preferred college', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('budget_for_study', 'budget for study', $this->config->item('form_base') . '|required');

                $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
                $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[pwd]');


                if ($this->form_validation->run() == TRUE) {

                    $salt = create_salt();

                    $add_student = array(
                        'user_name' => strtolower($this->input->post('email')),
                        'email' => $this->input->post('email'),

                        'status' => '1',
                        'salt' => $salt,
                        'pwd' => get_salted($salt, $this->input->post('pwd')),
                        'capability' => 'member',
                        'full_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),

                        'gender' => $this->input->post('gender'),
                        'dob' => $this->input->post('dob'),
                        'address_one' => $this->input->post('address_one'),
                        'address_two' => $this->input->post('address_two'),
                        'city' => $this->input->post('city'),
                        'state_pro_region' => $this->input->post('state_pro_region'),
                        'zip_code' => $this->input->post('zip_code'),
                        'country' => $this->input->post('country'),
                        'phone' => $this->input->post('phone'),
                        'are_you_on_viber' => $this->input->post('are_you_on_viber'),
                        'are_you_on_whatapps' => $this->input->post('are_you_on_whatapps'),
                        'fb_name' => $this->input->post('fb_name'),
                        'linkedin' => $this->input->post('linkedin'),
                        'highest_edu_qualification' => $this->input->post('highest_edu_qualification'),
                        'are_you_current_study' => $this->input->post('are_you_current_study'),
                        'name_college_university' => $this->input->post('name_college_university'),
                        'name_of_qualification_to_achieve' => $this->input->post('name_of_qualification_to_achieve'),
                        'emp_status' => $this->input->post('emp_status'),
                        'others_value' => $this->input->post('others_value'),
                        'preferred_country' => $this->input->post('preferred_country'),
                        'preferred_college' => $this->input->post('preferred_college'),
                        'budget_for_study' => $this->input->post('budget_for_study'),
                        'newsletter_subscription' => $this->input->post('newsletter_subscription'),
                        'is_registration_completed' => '1',
                    );

                    $insert_id = $this->members_model->insert($add_student);
                    if ($insert_id) {
                        setFlashMessage('flash_success', 'alert alert-success','Successfully added.');
                        redirect(site_url('student/add/'.$insert_id));
                    }
                    else{
                        setFlashMessage('flash_error', 'alert alert-danger','Unable to add.');
                        redirect(site_url('student/add/'));
                    }
                }
            }

            $data['user_name']=$this->user_name;
            $data['country'] = $this->post_category_model->get_country();
            $data['preferred_country'] = $this->post_category_model->get_country();
            $data['chain'] = $this->post_category_model->chain_college();
            $data['preferred_college'] = $this->post_model->get_college();

            $data['module']='student';
            $data['template']='add';
            $data['web_title']="Student";
            $data['page_header']='Student';
            echo Modules::run('templates/adminLayout', $data);
        }
        else
        {

            $old_query = $this->members_model->fromId($id);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {


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
                //$this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');

                $this->form_validation->set_rules('highest_edu_qualification', 'High Education qualification', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('are_you_current_study', 'Are you crrent studying', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('name_college_university', 'Name of college', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('name_of_qualification_to_achieve', 'Name of qualification achieve', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('emp_status', 'employee satus', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('preferred_country', 'Preferred country', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('preferred_college', 'Preferred college', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('budget_for_study', 'budget for study', $this->config->item('form_base') . '|required');

                $other_field = array();
                if(!empty($this->input->post('pwd')) and !empty($this->input->post('conf_password')))
                {

                    if (strcasecmp($this->input->post('pwd'), trim($this->input->post('conf_password'))) != 0) {

                        $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
                        $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[pwd]');

                    }
                    else
                    {
                        $salt = create_salt();
                        $other_field['salt'] = $salt;
                        $other_field['pwd'] = get_salted($salt, $this->input->post('pwd'));
                    }
                }


                if (strcasecmp($old_query->email, trim($this->input->post('email'))) == 0) {


                    $this->form_validation->set_rules('email', 'Email', $this->config->item('form_base') . '|required|valid_email|max_length[50]');
                } else {
                    $this->form_validation->set_rules('email', 'Email', $this->config->item('form_base') .  '|required|valid_email|max_length[50]|is_unique[members.email]');

                    $other_field['email'] = $this->input->post('email');

                }

                if ($this->form_validation->run() == TRUE) {

                    $add_student = array(
                        'status' => '1',

                        'capability' => 'member',
                        'full_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),

                        'gender' => $this->input->post('gender'),
                        'dob' => $this->input->post('dob'),
                        'address_one' => $this->input->post('address_one'),
                        'address_two' => $this->input->post('address_two'),
                        'city' => $this->input->post('city'),
                        'state_pro_region' => $this->input->post('state_pro_region'),
                        'zip_code' => $this->input->post('zip_code'),
                        'country' => $this->input->post('country'),
                        'phone' => $this->input->post('phone'),
                        'are_you_on_viber' => $this->input->post('are_you_on_viber'),
                        'are_you_on_whatapps' => $this->input->post('are_you_on_whatapps'),
                        'fb_name' => $this->input->post('fb_name'),
                        'linkedin' => $this->input->post('linkedin'),
                        'highest_edu_qualification' => $this->input->post('highest_edu_qualification'),
                        'are_you_current_study' => $this->input->post('are_you_current_study'),
                        'name_college_university' => $this->input->post('name_college_university'),
                        'name_of_qualification_to_achieve' => $this->input->post('name_of_qualification_to_achieve'),
                        'emp_status' => $this->input->post('emp_status'),
                        'others_value' => $this->input->post('others_value'),
                        'preferred_country' => $this->input->post('preferred_country'),
                        'preferred_college' => $this->input->post('preferred_college'),
                        'budget_for_study' => $this->input->post('budget_for_study'),
                        'newsletter_subscription' => $this->input->post('newsletter_subscription'),
                        'is_registration_completed' => '1',
                    );

                    $final_array = array_merge($add_student, $other_field);

                    $new_query = $this->members_model->update_where($final_array, array('id'=>intval($id)));
                    if($new_query)
                    {
                        setFlashMessage('flash_error','alert alert-success','Successfully updated.');
                        redirect(site_url('student/add/').'/'.$id);
                    }

                }
            }

            $data['country'] = $this->post_category_model->get_country();
            $data['preferred_country'] = $this->post_category_model->get_country();
            $data['chain'] = $this->post_category_model->chain_college();
            $data['preferred_college'] = $this->post_model->get_college();

            $fresh_query = $this->members_model->fromId($id);
            $data['result']=$fresh_query;

            $data['user_name']=$this->user_name;
            $data['module']='student';
            $data['template']='add';
            $data['web_title']="Edit account";
            $data['page_header']='Edit account ';
            echo Modules::run('templates/adminLayout', $data);

        }

    }


    function delete($id)
    {
        $getQuery = $this->members_model->fromId($id);
        if(isset($getQuery->profile_pic))
        {
            @unlink('assets/upload/'.$getQuery->profile_pic);

            $doc = $this->document_model->get_rows_where(array('user_id'=>$id));
            if($doc->num_rows())
            {
                foreach($doc->result() as $rowDoc)
                {
                    @unlink('assets/upload/'.$rowDoc->document);
                }
            }


        }

        $deleteQuery = $this->members_model->remove($id);
        if($deleteQuery)
        {
            setFlashMessage('flash_error','alert alert-success','Successfully deleted');
            redirect(site_url('student/manage'));
        }
    }

    public function outbox($student_id){

        $mem=$this->members_model->fromId($student_id);
        $config = array();
        $config['base_url'] = site_url('student/outbox/'.$student_id);
        $config['total_rows'] = $this->outbox_model->getWhereTotal(array('user_id'=>$student_id));
        $config["uri_segment"] = 4;
        $config['per_page'] = $this->config->item('per_page');
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

        $data["query"] = $this->outbox_model->fetch($config["per_page"], $page, array('user_id'=>$student_id), '*','id');

        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='outbox_list';
        $data['web_title']="Manage Outbox";
        $data['page_header']='Manage Outbox of '.$mem->full_name;
        echo Modules::run('templates/adminLayout', $data);
    }

    public function document_of($student_id){

        $mem=$this->members_model->fromId($student_id);
        $config = array();
        $config['base_url'] = site_url('student/document_of/'.$student_id);
        $config['total_rows'] = $this->document_model->getWhereTotal(array('user_id'=>$student_id));
        $config["uri_segment"] = 4;
        $config['per_page'] = $this->config->item('per_page');
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

        $data["query"] = $this->document_model->fetch($config["per_page"], $page, array('user_id'=>$student_id), '*','id');

        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='document_list';
        $data['web_title']="Manage Document";
        $data['page_header']='Manage Document of '.$mem->full_name;
        echo Modules::run('templates/adminLayout', $data);
    }

    public function payment_history_of($student_id){

        $mem=$this->members_model->fromId($student_id);
        $config = array();
        $config['base_url'] = site_url('student/payment_history_of/'.$student_id);
        $config['total_rows'] = $this->invoice_model->getWhereTotal(array('user_id'=>$student_id));
        $config["uri_segment"] = 4;
        $config['per_page'] = $this->config->item('per_page');
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

        $data["query"] = $this->invoice_model->fetch($config["per_page"], $page, array('user_id'=>$student_id), '*','id');

        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='invoice_list';
        $data['web_title']="Manage Invoice";
        $data['page_header']='Manage Invoice of '.$mem->full_name;
        echo Modules::run('templates/adminLayout', $data);
    }

    function outbox_compose($student_id, $msg_id=NULL)
    {

        $mem=$this->members_model->fromId($student_id);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('subject', 'Subject', $this->config->item('form_base') . '|required|min_length[5]|max_length[200]');
            $this->form_validation->set_rules('message', 'Message', $this->config->item('form_base') . '|required|min_length[5]|max_length[1000]');

            if ($this->form_validation->run() == TRUE) {

                $to = trim($mem->email);
                //trim($mem->first_name.' '.$mem->last_name);
                $from_name = 'Globcons';
                $from_email = $this->setting_model->get_setting($this->config->item('active_user'), 'email_primary');

                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->from($from_email, $from_name);
                $this->email->to($to);
                $this->email->reply_to($from_email, $from_name);

                $this->email->subject(ucfirst(trim($this->input->post('subject'))));

                $message = <<<EOF
                        <strong>Subject:</strong> {$this->input->post('subject')}
                        <br><br>

                        <strong>Message:</strong> {$this->input->post('message')}
                        <br><br>
EOF;

                $this->email->message($message);
                if ($this->email->send()) {

                    if($msg_id>=1)
                    {
                        $this->outbox_model->update(array('subject'=>$this->input->post('subject'), 'message'=>$this->input->post('message')), $msg_id);
                    }
                    else{
                        $this->outbox_model->insert(array('user_id'=>$mem->id, 'subject'=>$this->input->post('subject'), 'message'=>$this->input->post('message')));
                    }


                    setFlashMessage('flash_success', 'alert alert-success', 'Successfully sent email.');

                    redirect(site_url('student/outbox_compose').'/'.$student_id.'/'.$msg_id);
                } else {
                    show_error($this->email->print_debugger());
                }
            }
        }

        if($msg_id>=1)
        {
            $data['result']= $this->outbox_model->fromId($msg_id);
        }

        $data['mem']= $mem;
        $data['module']='student';
        $data['template']='send_email';
        $data['web_title']="Manage email";
        $data['page_header']='Send email to '.$mem->full_name;
        echo Modules::run('templates/adminLayout', $data);
    }


    function export_invoice($student)
    {

//        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//
//
//            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
//            $this->form_validation->set_rules('student', 'Subject', $this->config->item('form_base') . '|required');
//            $this->form_validation->set_rules('start_date', 'Start date', $this->config->item('form_base') . '|required');
//            $this->form_validation->set_rules('end_date', 'End date', $this->config->item('form_base') . '|required');
//
//            if ($this->form_validation->run() == TRUE) {
//
//
//                $student = trim($this->input->post('student'));
//                $start_date = trim($this->input->post('start_date'));
//                $end_date = trim($this->input->post('end_date'));
//
//
//                if($student)
//                {
//                    if(is_numeric($student))
//                    {
//                        $value_type='user_id';
//                        $value = intval($student);
//                    }
//                    else{
//                        if(is_string($this->input->post('student')))
//                        {
//                            if (filter_var($student, FILTER_VALIDATE_EMAIL)) {
//                                $value_type='email';
//                                $value = $student;
//
//                            }elseif(preg_match("/^[a-zA-Z ]*$/",$student))
//                            {
//                                $value_type = 'full_name';
//                                $value = $student;
//
//                            }else{
//                                $value_type = 1;
//                                $value = 1;
//                            }
//                        }
//                    }
//
//                }
//
//                $sql = "select invoice.*, members.id as userid, members.full_name, members.`address_one`, members.`country`, members.`city`, members.`preferred_college`, members.`preferred_country`,members.`email`, members.`state_pro_region`, members.`phone`, members.`zip_code`, UNIX_TIMESTAMP(invoice.created) as start_date from invoice join members on invoice.`user_id`= members.id where $value_type=$value having start_date between UNIX_TIMESTAMP(\"$start_date\") and UNIX_TIMESTAMP(\"$end_date\")";
//                $query = $this->db->query($sql);
//                if($query->num_rows()>=1)
//                {
//                    echo $query->num_rows();
//                    if($_POST['submit_pdf'])
//                    {
//                        $invoice_content= $this->load->view('invoice_preview', $data, true);
//
//                        //pdf
//                        $dompdf = new Dompdf();
//                        $option = new Options();
//                        $dompdf->setOptions($option->set('isRemoteEnabled', true));
//                        $dompdf->loadHtml($invoice_content);
//                        $dompdf->setPaper('A4', 'landscape'); //landscape portrait
//                        $dompdf->render();
//                        $output = $dompdf->output();
//                        $invoice_file_pdf = FCPATH.'customTemp/'.'invoice_'.session_id().'.pdf';
//                        @file_put_contents($invoice_file_pdf, $output);
//                    }
//
//                    if($_POST['submit_cvs'])
//                    {
//
//                    }
//                }
//                else{
//                    setFlashMessage('flash_error', 'alert alert-success', 'No records found');
//                    redirect(site_url('student/export_invoice'));
//                }
//            }
//        }

        $sql = "select invoice.*, members.id as userid, members.full_name, members.`address_one`, members.`country`, members.`city`, members.`preferred_college`, members.`preferred_country`,members.`email`, members.`state_pro_region`, members.`phone`, members.`zip_code`, UNIX_TIMESTAMP(invoice.created) as start_date from invoice join members on invoice.`user_id`= members.id where invoice.user_id=$student";
        $query = $this->db->query($sql);
        if($query->num_rows()>=1)
        {
            foreach($query->result() as $row)
            {
                $data['user_id'] = $row->userid;
                $data['invoice_id'] = $row->invoice_id;
                $data['amount'] = $row->amount/100;
                $data['particular'] = $row->paid_for;
                $data['bill_to'] = $row->full_name;
                $data['address'] = $row->address_one;
                $data['email'] = $row->email;
                $data['created'] = $row->created;
            }

            $invoice_content= $this->load->view('invoice_preview', $data, true);

            //pdf
            $dompdf = new Dompdf();
            $option = new Options();
            $dompdf->setOptions($option->set('isRemoteEnabled', true));
            $dompdf->loadHtml($invoice_content);
            $dompdf->setPaper('A4', 'portrait'); //landscape portrait
            $dompdf->render();
            //$output = $dompdf->output();
            //$invoice_file_pdf = FCPATH.'customTemp/'.'invoice_'.session_id().'.pdf';
            //@file_put_contents($invoice_file_pdf, $output);
            $dompdf->stream($row->invoice_id);
        }
//        $data['module']='student';
//        $data['template']='export_invoice';
//        $data['web_title']="Export Invoice";
//        $data['page_header']='Export Invoice';
//        echo Modules::run('templates/adminLayout', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
