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
        // $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'student', 'end_date<'=>date('Y-m-d')));
        $this->members_model->update_where(array('status'=>'0'), array('capability'=>'member', 'member_type'=>'student', 'end_date<'=>date('Y-m-d')));
    }

    public function index() {

        redirect(site_url('members/dashboard'));
        exit;

    }

    public function session($group_id){

        $config = array();
        $config['base_url'] = site_url('student/roster');
        $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'Student', 'group_id'=>$group_id));
        
        $config["uri_segment"] = 3;
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
        $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability'=>'member', 'member_type'=>'Student', 'group_id'=>$group_id), '*','id');
        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='list_group_student';
        $data['web_title']="Group Students";
        $data['page_header']='Group Students';
        $data['export']='student';
        echo Modules::run('templates/adminLayout', $data);
    }


    function check_email(){
        $this->output->set_content_type('application/json');

        if($this->input->post('email_var')){
            if (!filter_var($this->input->post('email_var'), FILTER_VALIDATE_EMAIL)) {
                $this->output->set_output(json_encode(array('status' => "Enter valid email address")));
            }else{
                $cnt = $this->members_model->getWhereTotal(array('email'=>$this->input->post('email_var')));
                if($cnt==0){
                    $this->output->set_output(json_encode(array('status' => 1)));
                }else{
                    $this->output->set_output(json_encode(array('status' => "Email already exist.")));
                }
            }

        }else{
            $this->output->set_output(json_encode(array('status' => "Enter email address")));
        }
        
    }

    public function group_roster(){

        $config = array();
        $config['base_url'] = site_url('student/group_roster');
        $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'group'));
        $config["uri_segment"] = 3;
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability'=>'member', 'member_type'=>'group'), '*','id');
        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='list_group';
        $data['web_title']="Group Roster";
        $data['page_header']='Group Roster';
        $data['export']='group';
        echo Modules::run('templates/adminLayout', $data);
    }

    public function guest_roster(){

        $config = array();
        $config['base_url'] = site_url('student/guest_roster');
        $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'guest'));
        $config["uri_segment"] = 3;
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability'=>'member', 'member_type'=>'guest'), '*','id');
        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='list';
        $data['web_title']="Guest Roster";
        $data['page_header']='Guest Roster';
        $data['export']='guest';
        echo Modules::run('templates/adminLayout', $data);
    }

    public function alumni(){

        $config = array();
        $config['base_url'] = site_url('student/alumni');
        $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'student', 'end_date<'=>date('Y-m-d')));
        $config["uri_segment"] = 3;
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability'=>'member', 'member_type'=>'student', 'end_date<'=>date('Y-m-d')), '*','id');
        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='list';
        $data['web_title']="Student Alumni Roster";
        $data['page_header']='Student Alumni Roster';
        $data['export']='alumni';
        echo Modules::run('templates/adminLayout', $data);
    }

    public function roster(){

        $config = array();
        $config['base_url'] = site_url('student/roster');
        $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'student', 'end_date>='=>date('Y-m-d')));
        $config["uri_segment"] = 3;
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
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability'=>'member', 'member_type'=>'student', 'end_date>='=>date('Y-m-d')), '*','id');
        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='list';
        $data['web_title']="Student Roster";
        $data['page_header']='Student Roster';
        $data['export']='student';
        echo Modules::run('templates/adminLayout', $data);
    }

    function export_roster_csv($mem_type="student")
    {
        $filename = 'student_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
        
        $usersData=[];

        if($mem_type=="student"){
            $student_result = $this->db->query("SELECT id, total_login,  CONCAT(first_name, ' ', last_name) AS full_name, institution, 
            (SELECT country_name FROM apps_countries WHERE apps_countries.id=country) AS country, email, start_date, end_date, IF(STATUS='1', 'Active', 'Inactive') AS status
                FROM members where members.member_type='Student' and members.end_date>=CURDATE()");
        }

        if($mem_type=="guest"){
            $student_result = $this->db->query("SELECT id, total_login,  CONCAT(first_name, ' ', last_name) AS full_name, institution, 
            (SELECT country_name FROM apps_countries WHERE apps_countries.id=country) AS country, email, start_date, end_date, IF(STATUS='1', 'Active', 'Inactive') AS status
                FROM members where members.member_type='Guest'");
        }

        if($mem_type=="alumni"){
            $student_result = $this->db->query("SELECT id, total_login,  CONCAT(first_name, ' ', last_name) AS full_name, institution, 
            (SELECT country_name FROM apps_countries WHERE apps_countries.id=country) AS country, email, start_date, end_date, IF(STATUS='1', 'Active', 'Inactive') AS status
                FROM members where members.member_type='Student' and members.end_date<CURDATE()");
        }
        
        foreach($student_result->result_array() as $row){
            $usersData[] = $row;
        }
        
        // file creation 
        $file = fopen('php://output', 'w');
        $header[] = 'Student Id';
        $header[] = 'Logins';
        $header[] = 'Name';
        $header[] = 'Institution';
        $header[] = 'Country';
        $header[] = 'Email';
        $header[] = 'Enroll Date';
        $header[] = 'End Date';
        $header[] = 'Status';

        fputcsv($file, $header);
        foreach ($usersData as $key=>$line){ 
            fputcsv($file,$line); 
        }
        fclose($file); 
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

    public function add_group_student($group_id){

            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $groupResult = $this->members_model->fromId($group_id);
                $fname = $this->input->post('fname');
                $lname = $this->input->post('lname');
                $email = $this->input->post('email');
                $country = $this->input->post('country');
                //print_r($this->input->post('fname'));
                
                if(is_array($fname) && is_array($lname) && is_array($email) && is_array($country)){

                    foreach($fname as $key=>$value){

                        $student_fname      =   "";
                        $student_lname      =   "";
                        $student_email      =   "";
                        $student_country    =   "";

                        if (!empty($fname[$key]))
                            $student_fname      =   $fname[$key];
                        
                        if (!empty($lname[$key]))
                            $student_lname      =   $lname[$key];

                        if (!empty($email[$key]))
                            $student_email      =   $email[$key];

                        if (!empty($country[$key]))
                            $student_country    =   $country[$key];

                        $add_student = array(
                            'first_name' => $student_fname,
                            'last_name' => $student_lname,
                            'country' => $student_country,
                            'email' => trim($student_email),
                            'user_name'=>trim($student_email),
                            'group_id'=>trim(intval($group_id)),
                            'start_date'=>$groupResult->start_date,
                            'end_date'=>$groupResult->end_date,
                        );
                    
                        $this->members_model->insert($add_student);
                    }
                }

                setFlashMessage('flash_success', 'alert alert-success','Successfully added.');
                redirect(site_url('student/session/'.$group_id));
            }

            $data['user_name']=$this->user_name;
            $data['countryList'] = $this->country_model->get_list();
            $data['module']='student';
            $data['template']='add_group_student';
            $data['web_title']="Student";
            $data['status']=array('Block', 'Active');
            $data['is_verified']=array('Unverified', 'Verified');
            $data['page_header']='Add Group Students ';
            echo Modules::run('templates/adminLayout', $data);
    }


public function edit_student_group($id, $group_id){

    $flag=false;
    $old_query = $this->members_model->fromId($id);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $groupResult = $this->members_model->fromId($group_id);
        $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
        $this->form_validation->set_rules('first_name', 'First name', $this->config->item('form_base') . '|required');
        $this->form_validation->set_rules('last_name', 'Last Name', $this->config->item('form_base') . '|required');
        $this->form_validation->set_rules('country', 'Country', $this->config->item('form_base') . '|required');
        //$this->form_validation->set_rules('email', 'country', $this->config->item('form_base') . '|required');
        $other_field = array();
        if (strcasecmp($old_query->email, trim($this->input->post('email'))) == 0) {
            $this->form_validation->set_rules('email', 'Email', $this->config->item('form_base') . '|required|valid_email|max_length[50]');
        } else {
            $this->form_validation->set_rules('email', 'Email', $this->config->item('form_base') .  '|required|valid_email|max_length[50]|is_unique[members.email]');
            $other_field['email'] = $this->input->post('email');
        }

        if ($this->form_validation->run() == TRUE) {

            $add_student = array(
                'first_name' => strtolower($this->input->post('first_name')),
                'email' => $this->input->post('email'),
                'user_name' => $this->input->post('email'),
                'last_name' => trim($this->input->post('last_name')),
                'country' => $this->input->post('country'),
                'start_date'=>$groupResult->start_date,
                'end_date'=>$groupResult->end_date,            
            );

            $final_array = array_merge($add_student, $other_field);

            $new_query = $this->members_model->update_where($final_array, array('id'=>intval($id)));
            if($new_query)
            {
                setFlashMessage('flash_success', 'alert alert-success','Successfully updated.');
                redirect(site_url('student/session').'/'.$group_id);
                
            }

        }
    }

    //$data['country'] = $this->post_category_model->get_country();
    $fresh_query = $this->members_model->fromId($id);
    $data['countryList'] = $this->country_model->get_list();
    $data['result']=$fresh_query;
    $data['status']=array('Block', 'Active');
    $data['is_verified']=array('Unverified', 'Verified');
    $data['user_name']=$this->user_name;
    $data['module']='student';
    $data['template']='edit_group_student';
    $data['web_title']="Edit group";
    $data['page_header']='Edit group student ';
    echo Modules::run('templates/adminLayout', $data);
}

    public function add_group($id = NULL){

        if($id === NULL){
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
               // $this->form_validation->set_rules('session_name', 'session name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('group_name', 'Group Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('position_title', 'position title', $this->config->item('form_base') . '|required');
                //$this->form_validation->set_rules('country', 'country', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('telephone', 'telephone', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');
                $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
                $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[pwd]');
                $this->form_validation->set_rules('per_student_rate', 'per student rate', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('payment_due_date', 'payment due date', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('address', 'address', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('institution', 'institution', $this->config->item('form_base') . '|required');

                if ($this->form_validation->run() == TRUE) {
                   
                    $salt = create_salt();
                    $add_student = array(
                        'user_name' => strtolower($this->input->post('email')),
                        'email' => $this->input->post('email'),
                        'institution' => trim($this->input->post('institution')),
                        'status' => $this->input->post('status'),
                        'is_verified' => $this->input->post('is_verified'),
                        'salt' => $salt,
                        'pwd' => get_salted($salt, $this->input->post('pwd')),
                        'capability' => 'member',
                        'member_type' => 'Group',
                        'start_date' => current_date(),
                        'end_date' => $this->input->post('end_date')?$this->input->post('end_date'):add_to_current_date($this->setting_model->get('course_access_day')),
                        //'session_name' => $this->input->post('session_name') . ' ' . $this->input->post('last_name'),
                        'group_name' => $this->input->post('group_name'),
                        'position_title' => $this->input->post('position_title'),
                        'telephone' => $this->input->post('telephone'),
                        //'country' => $this->input->post('country'),
                        'per_student_rate' => $this->input->post('per_student_rate'),
                        'payment_due_date' => $this->input->post('payment_due_date'),
                        'address' => $this->input->post('address')
                    );
                    
                    $insert_id = $this->members_model->insert($add_student);
                    if ($insert_id) {

                        $to =  trim($this->input->post('email'));
                        $from_name = $this->config->item('email_from_name');
                        $from_email = $this->config->item('email_from_email');

                        $this->load->library('email');
                        $this->email->set_newline("\r\n");
                        $this->email->from($from_email, $from_name);
                        $this->email->to($to);
                        $this->email->reply_to($from_email, $from_name);
                        $this->email->subject('Login Credential');

                    $message = <<<EOF
                    <strong>Hi</strong> {$this->input->post('group_name')}
                    <br><br>

                    Your user ID is: {$this->input->post('email')}<br>
                    Your password is: {$this->input->post('pwd')}
EOF;

                    $this->email->message($message);

                        if ($this->email->send()) {
                            setFlashMessage('flash_success', 'alert alert-success','Successfully added.');
                            redirect(site_url('student/add_group/'.$insert_id));
                        }else{
                            setFlashMessage('flash_error','alert alert-danger' ,'Could not send email.');
                            redirect(site_url('student/add_group/'.$insert_id));
                        }
                    }
                    else{
                        setFlashMessage('flash_error', 'alert alert-danger','Unable to add.');
                        redirect(site_url('student/add_group/'));
                    }
                }
            }

            $data['user_name']=$this->user_name;
            $data['countryList'] = $this->country_model->get_list();
            $data['module']='student';
            $data['template']='add_group';
            $data['web_title']="Student";
            $data['status']=array('Block', 'Active');
            $data['is_verified']=array('Unverified', 'Verified');
            $data['page_header']='Add Group';
            echo Modules::run('templates/adminLayout', $data);
        }
        else
        {
            $flag=false;
            $old_query = $this->members_model->fromId($id);
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('session_name', 'session name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('group_name', 'Group Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('position_title', 'position title', $this->config->item('form_base') . '|required');
                //$this->form_validation->set_rules('country', 'country', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('telephone', 'telephone', $this->config->item('form_base') . '|required');
                //$this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');
                //$this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
                //$this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[pwd]');
                $this->form_validation->set_rules('per_student_rate', 'per student rate', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('payment_due_date', 'payment due date', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('address', 'address', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('institution', 'institution', $this->config->item('form_base') . '|required');

                
                $other_field = array();
                if($this->input->post('pwd') and $this->input->post('conf_password'))
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
                        $flag=true;
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
                        'user_name' => strtolower($this->input->post('email')),
                        'email' => $this->input->post('email'),
                        'institution' => trim($this->input->post('institution')),
                        'status' => $this->input->post('status'),
                        'is_verified' => $this->input->post('is_verified'),
                        //'salt' => $salt,
                        //'pwd' => get_salted($salt, $this->input->post('pwd')),
                        //'capability' => 'member',
                        //'member_type' => 'Group',
                        'start_date' => current_date(),
                        'end_date' => $this->input->post('end_date')?$this->input->post('end_date'):add_to_current_date($this->setting_model->get('course_access_day')),
                        'session_name' => $this->input->post('session_name') . ' ' . $this->input->post('last_name'),
                        'group_name' => $this->input->post('group_name'),
                        'position_title' => $this->input->post('position_title'),
                        'telephone' => $this->input->post('telephone'),
                        //'country' => $this->input->post('country'),
                        'per_student_rate' => $this->input->post('per_student_rate'),
                        'payment_due_date' => $this->input->post('payment_due_date'),
                        'address' => $this->input->post('address')
                    );

                    

                    $final_array = array_merge($add_student, $other_field);

                    $new_query = $this->members_model->update_where($final_array, array('id'=>intval($id)));
                    if($new_query)
                    {
                        if($flag)
                        {
                            $to =  trim($this->input->post('email'));
                            $from_name = $this->config->item('email_from_name');
                            $from_email = $this->config->item('email_from_email');

                            $this->load->library('email');
                            $this->email->set_newline("\r\n");
                            $this->email->from($from_email, $from_name);
                            $this->email->to($to);
                            $this->email->reply_to($from_email, $from_name);
                            $this->email->subject('Login Credential');

                            $message = <<<EOF
                            <strong>Hi</strong> {$this->input->post('group_name')}
                            <br><br>

                            Your user ID is: {$this->input->post('email')}<br>
                            Your password is: {$this->input->post('pwd')}
EOF;

                            $this->email->message($message);

                            if ($this->email->send()) {
                                setFlashMessage('flash_success', 'alert alert-success','Successfully updated.');
                                redirect(site_url('student/add_group/').'/'.$id);
                            }else{
                                setFlashMessage('flash_error','alert alert-danger' ,'Could not send email.');
                                redirect(site_url('student/add_group/').'/'.$id);
                            }
                        }
                        else{
                            setFlashMessage('flash_error','alert alert-success','Successfully updated.');
                            redirect(site_url('student/add_group/').'/'.$id);
                        }
                        
                    }

                }
            }

            //$data['country'] = $this->post_category_model->get_country();
            $fresh_query = $this->members_model->fromId($id);
            $data['countryList'] = $this->country_model->get_list();
            $data['result']=$fresh_query;
            $data['status']=array('Block', 'Active');
            $data['is_verified']=array('Unverified', 'Verified');
            $data['user_name']=$this->user_name;
            $data['module']='student';
            $data['template']='add_group';
            $data['web_title']="Edit group";
            $data['page_header']='Edit group';
            echo Modules::run('templates/adminLayout', $data);
        }
    }

    public function add($id = NULL){

        
        if($id === NULL){
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('first_name', 'First Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('last_name', 'Last Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('country', 'country', $this->config->item('form_base') . '|required');
                //$this->form_validation->set_rules('phone', 'phone', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');

                $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
                $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[pwd]');


                if ($this->form_validation->run() == TRUE) {
                   
                    $salt = create_salt();
                    $add_student = array(
                        'user_name' => strtolower($this->input->post('email')),
                        'email' => $this->input->post('email'),
                        'institution' => trim($this->input->post('institution')),
                        'status' => $this->input->post('status'),
                        'is_verified' => $this->input->post('is_verified'),
                        'salt' => $salt,
                        'pwd' => get_salted($salt, $this->input->post('pwd')),
                        'capability' => 'member',
                        'start_date' => current_date(),
                        'end_date' => $this->input->post('end_date')?$this->input->post('end_date'):add_to_current_date($this->setting_model->get('course_access_day')),
                        'full_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'country' => $this->input->post('country')
                    );
                    
                    $insert_id = $this->members_model->insert($add_student);
                    if ($insert_id) {

                        $to =  trim($this->input->post('email'));
                        $from_name = $this->email_setting_model->get('admin_name'); //$this->config->item('email_from_name');
                        $from_email = $this->email_setting_model->get('out_going_email'); //$this->config->item('email_from_email');
                        

                        $this->load->library('email');
                        $this->email->set_newline("\r\n");
                        $this->email->from($from_email, $from_name);
                        $this->email->to($to);
                        $this->email->reply_to($from_email, $from_name);
                        $this->email->subject('Login Credential');

                    $message = <<<EOF
                    <strong>Hi</strong> {$this->input->post('fist_name')}
                    <br><br>

                    Your user ID is: {$this->input->post('email')}<br>
                    Your password is: {$this->input->post('pwd')}
EOF;

                    $this->email->message($message);

                        if ($this->email->send()) {
                            setFlashMessage('flash_success', 'alert alert-success','Successfully added.');
                            redirect(site_url('student/add/'.$insert_id));
                        }else{
                            setFlashMessage('flash_error','alert alert-danger' ,'Could not send email.');
                            redirect(site_url('student/add/'.$insert_id));
                        }
                    }
                    else{
                        setFlashMessage('flash_error', 'alert alert-danger','Unable to add.');
                        redirect(site_url('student/add/'));
                    }
                }
            }

            $data['user_name']=$this->user_name;
            $data['countryList'] = $this->country_model->get_list();
            $data['module']='student';
            $data['template']='add';
            $data['web_title']="Student";
            $data['status']=array('Block', 'Active');
            $data['is_verified']=array('Unverified', 'Verified');
            $data['page_header']='Student Roster';
            echo Modules::run('templates/adminLayout', $data);
        }
        else
        {
            $flag=false;
            $old_query = $this->members_model->fromId($id);
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('first_name', 'First Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('last_name', 'Last Name', $this->config->item('form_base') . '|required');
                $this->form_validation->set_rules('country', 'country', $this->config->item('form_base') . '|required');
                
                $other_field = array();
                if($this->input->post('pwd') and $this->input->post('conf_password'))
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
                        $flag=true;
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
                        'status' => $this->input->post('status'),
                        'is_verified' => $this->input->post('is_verified'),
                        'capability' => 'member',
                        'full_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'country' => $this->input->post('country'),
                        'institution' => trim($this->input->post('institution')),
                        'start_date' => current_date(),
                        'end_date' => $this->input->post('end_date')?$this->input->post('end_date'):add_to_current_date($this->setting_model->get('course_access_day')),
                        
                    );

                    $final_array = array_merge($add_student, $other_field);

                    $new_query = $this->members_model->update_where($final_array, array('id'=>intval($id)));
                    if($new_query)
                    {
                        if($flag)
                        {
                            $to =  trim($this->input->post('email'));
                            $from_name = $this->email_setting_model->get('admin_name'); //$this->config->item('email_from_name');
                            $from_email = $this->email_setting_model->get('out_going_email'); //$this->config->item('email_from_email');

                            $this->load->library('email');
                            $this->email->set_newline("\r\n");
                            $this->email->from($from_email, $from_name);
                            $this->email->to($to);
                            $this->email->reply_to($from_email, $from_name);
                            $this->email->subject($this->email_setting_model->get('admin_has_change_pwd_subject'));

                            $message = str_replace(array('[Full Name]', '[Password]'), array($old_query->first_name . ' ' . $old_query->last_name, $this->input->post('pwd')), nl2br($this->email_setting_model->get('admin_has_change_pwd_body_text')));
                            
//                             $message = <<<EOF
//                             <strong>Hi</strong> {$this->input->post('fist_name')}
//                             <br><br>

//                             Your user ID is: {$this->input->post('email')}<br>
//                             Your password is: {$this->input->post('pwd')}
// EOF;

                            $this->email->message($message);

                            if ($this->email->send()) {
                                setFlashMessage('flash_success', 'alert alert-success','Successfully updated.');
                                redirect(site_url('student/add/').'/'.$id);
                            }else{
                                setFlashMessage('flash_error','alert alert-danger' ,'Could not send email.');
                                redirect(site_url('student/add/').'/'.$id);
                            }
                        }
                        else{
                            setFlashMessage('flash_error','alert alert-success','Successfully updated.');
                            redirect(site_url('student/add/').'/'.$id);
                        }
                        
                    }

                }
            }

            //$data['country'] = $this->post_category_model->get_country();
            $fresh_query = $this->members_model->fromId($id);
            $data['countryList'] = $this->country_model->get_list();
            $data['result']=$fresh_query;
            $data['status']=array('Block', 'Active');
            $data['is_verified']=array('Unverified', 'Verified');
            $data['user_name']=$this->user_name;
            $data['module']='student';
            $data['template']='add';
            $data['web_title']="Edit account";
            $data['page_header']='Edit student roster ';
            echo Modules::run('templates/adminLayout', $data);
        }
    }

public function add_guest($id = NULL){

    if($id === NULL){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('first_name', 'First Name', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('last_name', 'Last Name', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('country', 'country', $this->config->item('form_base') . '|required');
            //$this->form_validation->set_rules('phone', 'phone', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');

            $this->form_validation->set_rules('pwd', 'Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[pwd]');


            if ($this->form_validation->run() == TRUE) {
               
                $salt = create_salt();
                $add_student = array(
                    'user_name' => strtolower($this->input->post('email')),
                    'email' => $this->input->post('email'),
                    'institution' => trim($this->input->post('institution')),
                    'status' => $this->input->post('status'),
                    'is_verified' => $this->input->post('is_verified'),
                    'salt' => $salt,
                    'pwd' => get_salted($salt, $this->input->post('pwd')),
                    'capability' => 'member',
                    'member_type' => 'Guest',
                    'start_date' => current_date(),
                    'end_date' => $this->input->post('end_date')?$this->input->post('end_date'):add_to_current_date($this->setting_model->get('course_access_day')),
                    'full_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'country' => $this->input->post('country')
                );
                
                $insert_id = $this->members_model->insert($add_student);
                if ($insert_id) {

                    $to =  trim($this->input->post('email'));
                    $from_name = $this->config->item('email_from_name');
                    $from_email = $this->config->item('email_from_email');

                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
                    $this->email->from($from_email, $from_name);
                    $this->email->to($to);
                    $this->email->reply_to($from_email, $from_name);
                    $this->email->subject('Login Credential');

                $message = <<<EOF
                <strong>Hi</strong> {$this->input->post('fist_name')}
                <br><br>

                Your user ID is: {$this->input->post('email')}<br>
                Your password is: {$this->input->post('pwd')}
EOF;

                $this->email->message($message);

                    if ($this->email->send()) {
                        setFlashMessage('flash_success', 'alert alert-success','Successfully added.');
                        redirect(site_url('student/add_guest/'.$insert_id));
                    }else{
                        setFlashMessage('flash_error','alert alert-danger' ,'Could not send email.');
                        redirect(site_url('student/add_guest/'.$insert_id));
                    }
                }
                else{
                    setFlashMessage('flash_error', 'alert alert-danger','Unable to add.');
                    redirect(site_url('student/add_guest/'));
                }
            }
        }

        $data['user_name']=$this->user_name;
        $data['countryList'] = $this->country_model->get_list();
        $data['module']='student';
        $data['template']='add';
        $data['web_title']="Student";
        $data['status']=array('Block', 'Active');
        $data['is_verified']=array('Unverified', 'Verified');
        $data['page_header']='Guest student';
        echo Modules::run('templates/adminLayout', $data);
    }
    else
    {
        $flag=false;
        $old_query = $this->members_model->fromId($id);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('first_name', 'First Name', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('last_name', 'Last Name', $this->config->item('form_base') . '|required');
            $this->form_validation->set_rules('country', 'country', $this->config->item('form_base') . '|required');
            
            $other_field = array();
            if($this->input->post('pwd') and $this->input->post('conf_password'))
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
                    $flag=true;
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
                    'status' => $this->input->post('status'),
                    'is_verified' => $this->input->post('is_verified'),
                    'capability' => 'member',
                    'member_type' => 'Guest',
                    'full_name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'country' => $this->input->post('country'),
                    'institution' => trim($this->input->post('institution')),
                    'start_date' => current_date(),
                    'end_date' => $this->input->post('end_date')?$this->input->post('end_date'):add_to_current_date($this->setting_model->get('course_access_day')),
                    
                );

                $final_array = array_merge($add_student, $other_field);

                $new_query = $this->members_model->update_where($final_array, array('id'=>intval($id)));
                if($new_query)
                {
                    if($flag)
                    {
                        $to =  trim($this->input->post('email'));
                        $from_name = $this->config->item('email_from_name');
                        $from_email = $this->config->item('email_from_email');

                        $this->load->library('email');
                        $this->email->set_newline("\r\n");
                        $this->email->from($from_email, $from_name);
                        $this->email->to($to);
                        $this->email->reply_to($from_email, $from_name);
                        $this->email->subject('Login Credential');

                        $message = <<<EOF
                        <strong>Hi</strong> {$this->input->post('fist_name')}
                        <br><br>

                        Your user ID is: {$this->input->post('email')}<br>
                        Your password is: {$this->input->post('pwd')}
EOF;

                        $this->email->message($message);

                        if ($this->email->send()) {
                            setFlashMessage('flash_success', 'alert alert-success','Successfully updated.');
                            redirect(site_url('student/add_guest/').'/'.$id);
                        }else{
                            setFlashMessage('flash_error','alert alert-danger' ,'Could not send email.');
                            redirect(site_url('student/add_guest/').'/'.$id);
                        }
                    }
                    else{
                        setFlashMessage('flash_error','alert alert-success','Successfully updated.');
                        redirect(site_url('student/add_guest/').'/'.$id);
                    }
                    
                }

            }
        }

        //$data['country'] = $this->post_category_model->get_country();
        $fresh_query = $this->members_model->fromId($id);
        $data['countryList'] = $this->country_model->get_list();
        $data['result']=$fresh_query;
        $data['status']=array('Block', 'Active');
        $data['is_verified']=array('Unverified', 'Verified');
        $data['user_name']=$this->user_name;
        $data['module']='student';
        $data['template']='add';
        $data['web_title']="Edit account";
        $data['page_header']='Edit guest student ';
        echo Modules::run('templates/adminLayout', $data);
    }
}


function delete_roster_group($id)
{
    $getQuery = $this->members_model->fromId($id);
    $deleteQuery = $this->members_model->remove($id);
    if($deleteQuery)
    {
        setFlashMessage('flash_error','alert alert-success','Successfully deleted');
        redirect(site_url('student/group_roster'));
    }
}

function delete_group_student($student_id, $group_id)
{
    $deleteQuery = $this->members_model->remove($student_id);
    if($deleteQuery)
    {
        setFlashMessage('flash_error','alert alert-success','Successfully deleted');
        redirect(site_url('student/session/'.$group_id));
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
            redirect(site_url('student/roster'));
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

    function billing($group_id){

        

        $data['module']='student';
        $data['template']='billing';
        $data['web_title']="Billing";
        $data['page_header']='Billing';
        echo Modules::run('templates/adminLayout', $data);
    }

    function customMail()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if($this->input->post('action_invite')){

                $selected_student = $_POST['my_check'];

                if(is_array($selected_student) && count($selected_student)>=1){
                   
                    foreach($selected_student as $key => $student_id){
                        $student_row = $this->members_model->fromId($student_id);
                        if($student_row){

                        // $to = $student_row->email;
                        // $from_name = $this->email_setting_model->get('admin_name'); //$this->config->item('email_from_name');
                        // $from_email = $this->email_setting_model->get('out_going_email'); //$this->config->item('email_from_email');

                        // $this->load->library('email');
                        // $this->email->set_newline("\r\n");
                        // $this->email->from($from_email, $from_name);
                        // $this->email->to($to);
                        // $this->email->reply_to($from_email, $from_name);
                        // $this->email->subject($this->email_setting_model->get('invite_group_subject'));

                        $verification_key = md5($student_row->id.$this->config->item('encryption_key').$student_row->id);
                        $this->members_model->update(array('verification_key'=>$verification_key), $student_row->id);
                        $verify_url = site_url('verify_pwd/'.$verification_key);
                        $to =  trim($student_row->email);
                        $from_name = $this->email_setting_model->get('admin_name'); //$this->config->item('email_from_name');
                        $from_email = $this->email_setting_model->get('out_going_email'); //$this->config->item('email_from_email');

                        $this->load->library('email');
                        $this->email->set_newline("\r\n");
                        $this->email->from($from_email, $from_name);
                        $this->email->to($to);
                        $this->email->reply_to($from_email, $from_name);
                        $this->email->subject($this->email_setting_model->get('invite_group_subject'));

                        $message = str_replace('[Full Name]', $student_row->first_name . ' ' . $student_row->last_name, nl2br($this->email_setting_model->get('invite_group_email_body_text')));
                        $message.= "<br><br><a href=\"$verify_url\">CREATE YOUR PASSWORD</a>";

//                     $message = <<<EOF
//                     <strong>Hi</strong> {$student_row->first_name}
//                     <br><br>

//                     <a href="{$verify_url}">Click here to verify</a>
//                     <br><br>
// EOF;

                        $this->email->message($message);
                        $this->email->send();
                    
                        }
                    }

                    setFlashMessage('flash_error', 'alert alert-success', 'Successfully invited');
                    redirect($this->input->post('back_url'));
                }else{
                    setFlashMessage('flash_error', 'alert alert-error', 'Please select student.');
                    redirect($this->input->post('back_url'));
                }
            }
            
            if($this->input->post('action_mail')){

                $selected_student = $_POST['my_check'];

                if(is_array($selected_student) && count($selected_student)>=1){
                   
                    foreach($selected_student as $key => $student_id){
                        $student_row = $this->members_model->fromId($student_id);
                        if($student_row){
                            $student_email_arr[] =  strtolower(trim($student_row->email));
                        }
                    }

                    if($this->input->post('check_all')){
                        $data['email_to']='All';
                    }else{
                        $data['email_to']=implode(',', $student_email_arr);
                    }

                    $data['send_email_to'] = implode(',', $student_email_arr);
                }else{
                    setFlashMessage('flash_error', 'alert alert-error', 'Please select student.');
                    redirect($this->input->post('back_url'));
                }
            }

            if($this->input->post('emails')){
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('emails', 'Email', $this->config->item('form_base') . '|required|min_length[3]|max_length[1000]');
                $this->form_validation->set_rules('subject', 'Subject', $this->config->item('form_base') . '|required|min_length[5]|max_length[200]');
                $this->form_validation->set_rules('message', 'Message', $this->config->item('form_base') . '|required|min_length[5]|max_length[1000]');

            if ($this->form_validation->run() == TRUE) {

                $student_email_arr = explode(',', $this->input->post('send_email_to'));
                if(is_array($student_email_arr) && count($student_email_arr)>=1){
                    foreach($student_email_arr as $key => $student_email){
                        //you can send to only validated student
                        // $student_row = $this->members_model->fromId($student_id);
                        // if($student_row){
                            
                        // }

                        $to = $student_email;
                        $from_name = $this->email_setting_model->get('admin_name'); //$this->config->item('email_from_name');
                        $from_email = $this->email_setting_model->get('out_going_email'); //$this->config->item('email_from_email');

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
                $this->email->send();
                    }
                }
                setFlashMessage('flash_success', 'alert alert-success', 'Successfully sent email.');
                redirect($this->input->post('back_url'));
            }
                
            }
            
        }

        $data['module']='student';
        $data['template']='send_email';
        $data['web_title']="Manage email";
        $data['page_header']='Send email';
        echo Modules::run('templates/adminLayout', $data);
    }

    

    //toggle
    function payment_status($member_id) {
        
        if ($this->is_user_logged_in == TRUE) {
            $group_model = $this->members_model->fromId($member_id);
            if($group_model->payment_status)
            {
                $this->members_model->update(array('payment_status'=>'0'),$member_id);
            }else{
                $this->members_model->update(array('payment_status'=>'1'),$member_id);
            }
            
            //$this->members_model->update_where(array('status'=>'1'),array('group_id'=>$member_id));
            redirect(site_url('student/billing/'.$member_id));
        }
    }

    function payment_paid_status($member_id) {

        if ($this->is_user_logged_in == TRUE) {
            $this->members_model->update(array('payment_status'=>'1'),$member_id);
            redirect(site_url('student/billing/'.$member_id));
        }
    }

    function payment_unpaid_status($member_id) {

        if ($this->is_user_logged_in == TRUE) {
            $this->members_model->update(array('payment_status'=>'0'),$member_id);
            redirect(site_url('student/billing/'.$member_id));
        }
    }

    function test_upload(){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //https://code.tutsplus.com/tutorials/how-to-upload-files-with-codeigniter-and-ajax--net-21684
            $msg = "";
            $config['upload_path'] = './assets/uploads';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 1024 * 8;
            $config['max_filename'] = '100';
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
            } else {
                $status = 'success';
                $msg = $this->upload->data();
            }
            echo json_encode(array('status' => $status, 'msg' => $msg, "redirect_uri"=>"http://www.gmail.com"));
        }
    }

    public function upload_invoice($group_id) //$group_id
    {
        //$group_id = $this->uri->segment(3);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //https://code.tutsplus.com/tutorials/how-to-upload-files-with-codeigniter-and-ajax--net-21684
            $msg = "";
            $config['upload_path'] = './assets/uploads';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 1024 * 8;
            $config['max_filename'] = '100';
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
            } else {
                $status = 'success';
                $msg = $this->upload->data();
                $mem = $this->members_model->fromId($group_id);
                if(!empty($mem->invoice)){
                    @unlink('./assets/uploads/'.$mem->invoice);
                    $file_id = $this->members_model->update(array('invoice'=>NULL),$group_id);
                }

                $file_id = $this->members_model->update(array('invoice'=>$msg['file_name']),$group_id);
                if($file_id){
                    setFlashMessage('flash_success', 'alert alert-success', 'File successfully uploaded');
                }else{
                    unlink($msg['full_path']);
                    setFlashMessage('flash_error', 'alert alert-error', 'Something went wrong when saving the file, please try again.');
                }

                @unlink($_FILES['userfile']);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg, "redirect_uri"=>site_url('student/billing/'.$group_id)));
        }

        // if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //     //https://code.tutsplus.com/tutorials/how-to-upload-files-with-codeigniter-and-ajax--net-21684
        //     $msg = "";
        //     $config['upload_path'] = './assets/uploads';
        //     $config['allowed_types'] = 'pdf';
        //     $config['max_size'] = 1024 * 8;
        //     $config['max_filename'] = '100';
        //     $config['remove_spaces'] = TRUE;
        //     $config['encrypt_name'] = TRUE;
        //     $this->upload->initialize($config);
        //     if (!$this->upload->do_upload('userfile'))
        //     {
        //         $status = 'error';
        //         $msg = $this->upload->display_errors();
        //     }
        //     else
        //     {
        //         $data = $this->upload->data();
                
        //         $mem = $this->members_model->fromId($group_id);
        //         if(!empty($mem->invoice)){
        //             @unlink('./assets/uploads/'.$mem->invoice);
        //             $file_id = $this->members_model->update(array('invoice'=>NULL),$group_id);
        //         }

        //         $file_id = $this->members_model->update(array('invoice'=>$data['file_name']),$group_id);
        //         if($file_id){
        //             setFlashMessage('flash_success', 'alert alert-success', 'File successfully uploaded');
        //         }else{
        //             unlink($data['full_path']);
        //             setFlashMessage('flash_error', 'alert alert-error', 'Something went wrong when saving the file, please try again.');
        //         }

        //         @unlink($_FILES['userfile']);
        //         redirect(site_url('student/billing/'.$group_id));
                
        //     }
        // }
        
    }

    public function delete_invoice($group_id)
    {
        $mem = $this->members_model->fromId($group_id);
        if(!empty($mem->invoice)){
            @unlink('./assets/uploads/'.$mem->invoice);
            $file_id = $this->members_model->update(array('invoice'=>NULL),$group_id);

            if($file_id){
                setFlashMessage('flash_success', 'alert alert-success', 'File successfully deleted');
            }else{
                setFlashMessage('flash_error', 'alert alert-error', 'Something went wrong when saving the file, please try again.');
            }
        }
        redirect(site_url('student/billing/'.$group_id));

       
        
    }


    public function upload_receipt($group_id)
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //https://code.tutsplus.com/tutorials/how-to-upload-files-with-codeigniter-and-ajax--net-21684
            $msg = "";
            $config['upload_path'] = './assets/uploads';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 1024 * 8;
            $config['max_filename'] = '100';
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
            } else {
                $status = 'success';
                $msg = $this->upload->data();
                $mem = $this->members_model->fromId($group_id);
                if(!empty($mem->invoice)){
                    @unlink('./assets/uploads/'.$mem->receipt);
                    $file_id = $this->members_model->update(array('receipt'=>NULL),$group_id);
                }

                $file_id = $this->members_model->update(array('receipt'=>$msg['file_name']),$group_id);
                if($file_id){
                    setFlashMessage('flash_success', 'alert alert-success', 'File successfully uploaded');
                }else{
                    unlink($msg['full_path']);
                    setFlashMessage('flash_error', 'alert alert-error', 'Something went wrong when saving the file, please try again.');
                }

                @unlink($_FILES['userfile']);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg, "redirect_uri"=>site_url('student/billing/'.$group_id)));
        }
        
//        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//            //https://code.tutsplus.com/tutorials/how-to-upload-files-with-codeigniter-and-ajax--net-21684
//            $msg = "";
//            $config['upload_path'] = './assets/uploads';
//            $config['allowed_types'] = 'pdf';
//            $config['max_size'] = 1024 * 8;
//            $config['max_filename'] = '100';
//            $config['remove_spaces'] = TRUE;
//            $config['encrypt_name'] = TRUE;
//            $this->upload->initialize($config);
//            if (!$this->upload->do_upload('userfile'))
//            {
//                $status = 'error';
//                $msg = $this->upload->display_errors();
//            }
//            else
//            {
//                $data = $this->upload->data();
//
//                $mem = $this->members_model->fromId($group_id);
//                if(!empty($mem->receipt)){
//                    @unlink('./assets/uploads/'.$mem->receipt);
//                    $file_id = $this->members_model->update(array('receipt'=>NULL),$group_id);
//                }
//
//                $file_id = $this->members_model->update(array('receipt'=>$data['file_name']),$group_id);
//                if($file_id){
//                    setFlashMessage('flash_success', 'alert alert-success', 'File successfully uploaded');
//                }else{
//                    unlink($data['full_path']);
//                    setFlashMessage('flash_error', 'alert alert-error', 'Something went wrong when saving the file, please try again.');
//                }
//
//                @unlink($_FILES['userfile']);
//                redirect(site_url('student/billing/'.$group_id));
//
//            }
//        }
        
    }

    public function delete_receipt($group_id)
    {
        $mem = $this->members_model->fromId($group_id);
        if(!empty($mem->receipt)){
            @unlink('./assets/uploads/'.$mem->receipt);
            $file_id = $this->members_model->update(array('receipt'=>NULL),$group_id);

            if($file_id){
                setFlashMessage('flash_success', 'alert alert-success', 'File successfully deleted');
            }else{
                setFlashMessage('flash_error', 'alert alert-error', 'Something went wrong when saving the file, please try again.');
            }
        }
        redirect(site_url('student/billing/'.$group_id));

       
        
    }

    function export_invoice($invoice_id)
    {

        $sql = "select invoice.*, members.id as userid, members.full_name, members.`address_one`, members.`country`, members.`city`, members.`preferred_college`, members.`preferred_country`,members.`email`, members.`state_pro_region`, members.`phone`, members.`zip_code`, UNIX_TIMESTAMP(invoice.created) as start_date from invoice join members on invoice.`user_id`= members.id where invoice.id=$invoice_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            foreach ($query->result() as $row) {

                //$particular = $row->paid_for.'<br>';
                //$particular .= "<strong>Preferred College</strong>";

                $data['user_id'] = $row->userid;
                $data['invoice_id'] = $row->invoice_id;
                $data['amount'] = $row->amount / 100;
                $data['particular'] = $row->paid_for;
                $data['bill_to'] = $row->full_name;
                $data['address'] = $row->address_one;
                $data['email'] = $row->email;
                $data['created'] = $row->created;
            }

            $invoice_content = $this->load->view('invoice_preview', $data, true);

            //pdf
            $dompdf = new Dompdf();
            $option = new Options();
            $dompdf->setOptions($option->set('isRemoteEnabled', true));
            $dompdf->loadHtml($invoice_content);
            $dompdf->setPaper('A4', 'portrait'); //landscape portrait
            $dompdf->render();
            $dompdf->stream($row->invoice_id);
        }
    }

    function export_student($student)
    {

        $sql = "select invoice.*, members.id as userid, members.full_name, members.`address_one`, members.`country`, members.`city`, members.`preferred_college`, members.`preferred_country`,members.`email`, members.`state_pro_region`, members.`phone`, members.`zip_code`, UNIX_TIMESTAMP(invoice.created) as start_date from invoice join members on invoice.`user_id`= members.id where members.id=$student";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            foreach ($query->result() as $row) {

                $preCountryQuery = $this->post_category_model->fromId($row->preferred_country);
                $preCollegeQuery = $this->post_model->fromId($row->preferred_college);
                $countryQuery = $this->post_category_model->fromId($row->country);

                $data['user_id'] = $row->userid;
                $data['full_name'] = $row->full_name;
                $data['country'] = $countryQuery->title;
                $data['city'] = $row->city;
                $data['state'] = $row->state_pro_region;
                $data['pre_college'] = $preCollegeQuery->title;
                $data['pre_country'] = $preCountryQuery->title;
                $data['address'] = $row->address_one;
                $data['email'] = $row->email;
                $data['phone'] = $row->phone;

            }

            $student_content = $this->load->view('student_preview', $data, true);

            //pdf
            $dompdf = new Dompdf();
            $option = new Options();

            $dompdf->setOptions($option->set('isRemoteEnabled', true));
            $dompdf->loadHtml($student_content);
            $dompdf->setPaper('A4', 'portrait'); //landscape portrait
            $dompdf->render();
            $dompdf->stream('student_details_'.$row->userid);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
