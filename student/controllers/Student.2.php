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

    public function roster(){

        $config = array();
        $config['base_url'] = site_url('student/roster');
        $config['total_rows'] = $this->members_model->getWhereTotal(array('capability'=>'member'));
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

        $data["query"] = $this->members_model->fetch($config["per_page"], $page, '', '*','id');
        $data["links"] = $this->pagination->create_links();
        $data["query"] = $this->members_model->fetch($config["per_page"], $page, array('capability'=>'member'), '*','id');
        $data["links"] = $this->pagination->create_links();
        $data['module']='student';
        $data['template']='list';
        $data['web_title']="Student Roster";
        $data['page_header']='Student Roster';
        echo Modules::run('templates/adminLayout', $data);
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
            $data['page_header']='Student';
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

    function customMail()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
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
                    redirect(site_url('student/roster'));
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
                        $from_name = $this->config->item('email_from_name');
                        $from_email = $this->config->item('email_from_email'); 

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
                redirect(site_url('student/roster'));
            }
                
            }
            
        }

        $data['module']='student';
        $data['template']='send_email';
        $data['web_title']="Manage email";
        $data['page_header']='Send email';
        echo Modules::run('templates/adminLayout', $data);
    }

    function export_csv()
    {
        
        // $usersData = $this->members_model->get_all_rows()->result_array();
        // print_r($usersData);
        // exit;

        //Step 1
        // $result = mysqli_query('SELECT * FROM members'); 
        // if (!$result) die('Couldn\'t fetch records'); 
        // $num_fields = mysqli_num_fields($result); 
        // $headers = array(); 
        // for ($i = 0; $i < $num_fields; $i++) 
        // {     
        //     $headers[] = mysqli_field_name($result , $i); 
        // } 
        // $fp = fopen('php://output', 'w'); 
        // if ($fp && $result) 
        // {     
        //     header('Content-Type: text/csv');
        //     header('Content-Disposition: attachment; filename="export.csv"');
        //     header('Pragma: no-cache');    
        //     header('Expires: 0');
        //     fputcsv($fp, $headers); 
        //     while ($row = mysqli_fetch_row($result)) 
        //     {
        //         fputcsv($fp, array_values($row)); 
        //     }
        // die; 
        // } 

        //Step 2
        // header('Content-Type: text/csv; charset=utf-8');  
        // header('Content-Disposition: attachment; filename=data.csv');  
        // $output = fopen("php://output", "w");  
        // fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Joining Date'));  
        // $query = "SELECT * from employeeinfo ORDER BY emp_id DESC";  
        // $result = mysqli_query($con, $query);  
        // while($row = mysqli_fetch_assoc($result))  
        // {  
        //      fputcsv($output, $row);  
        // }  
        // fclose($output);

        //step 3
        // file name 
        // $usersData = $this->members_model->get_all_rows()->result_array();
        // $usersData=[];
        // $student_result = $this->db->query("SELECT id, total_login,  CONCAT(first_name, ' ', last_name) AS full_name, institution, 
        //     (SELECT country_name FROM apps_countries WHERE apps_countries.id=country) AS country, email, start_date, end_date, IF(STATUS='1', 'Active', 'Inactive') AS status
        //      FROM members");
        // foreach($student_result->result_array() as $row){
        //     $usersData[] = $row;
        // }
        // echo "<pre>";
        // print_r($usersData);
        // echo "</pre>";
        // exit;
            $filename = 'student_'.date('Ymd').'.csv'; 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$filename"); 
            header("Content-Type: application/csv; ");
            
            // get data 
            //$usersData = $this->members_model->get_all_rows()->result_array();
            //$usersData = $this->members_model->get_selected_rows(array('id'));

            $usersData=[];
            $student_result = $this->members_model->query("SELECT id, total_login,  CONCAT(first_name, ' ', last_name) AS full_name, institution, 
            (SELECT country_name FROM apps_countries WHERE apps_countries.id=country) AS country, email, start_date, end_date, IF(STATUS='1', 'Active', 'Inactive') AS status
             FROM members");

            foreach($student_result->result_array() as $row){
                $usersData[] = $row;
            }
            
            // file creation 
            $file = fopen('php://output', 'w');
            
            // $fields = $this->db->list_fields('members');
            // foreach ($fields as $field)
            // {
            //     $header[] = $field;
            // }
            //$header = array("Username","Name","Gender","Email"); 

            $header[] = 'ID';
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
