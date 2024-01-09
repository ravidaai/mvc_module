<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Members extends Super_Controller{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function index() {

        redirect(site_url('members/dashboard'));
        exit;

    }

    public function dashboard()
    {
        $roster=false;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $send_verification = false;
            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email');

            if ($this->form_validation->run() == TRUE) {
                $rosterQ = $this->members_model->get_selected_where(array('email'=>$this->input->post('email')));
                if($rosterQ){
                    $roster = $rosterQ->result() ;
                }
            }
        }

        $data['roster']=$roster;
        $data['module']='members';
        $data['template']='dashboard';
        $data['web_title']='User Stats';
        $data['page_header']='My Dashboard';
        echo Modules::run('templates/adminLayout', $data);
    }

    function logout() {
        if ($this->is_user_logged_in == TRUE) {
            if (intval($this->session->userdata('user_id')) >= 1) {
                $this->session->unset_userdata('is_user_logged_in');
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('user_name');
                $this->session->unset_userdata('user_secret_key');
                $this->session->sess_destroy();
            }
        }

        redirect(site_url() . 'xps/?action=logout&cache=' . sha1(microtime()));
        exit;
    }

    function active($member_id, $back_url) {
        if ($this->is_user_logged_in == TRUE) {
            if(strcasecmp($back_url,'group_roster')==0){
                $this->members_model->update_where(array('group_status' => '1'), array('group_id'=>$member_id));
                $this->members_model->change_status($member_id, 'active');
                $groupRoster = $this->members_model->get_selected_where(array('group_id'=>$member_id));
                if($groupRoster){
                    if($groupRoster->num_rows()>=1){
                        $groupRosterResult = $groupRoster->result();
                        $this->members_model->update_where(array('group_status' => '1', 'status' => '1'), array('group_id'=>$groupRosterResult[0]->id));
                    }
                }
                
            }
            else{
                $this->members_model->change_status($member_id, 'active');
            }
            redirect(site_url('student/'.$back_url));
        }
    }

    function block($member_id, $back_url) {
        if ($this->is_user_logged_in == TRUE) {
            if(strcasecmp($back_url,'group_roster')==0){
                $this->members_model->update_where(array('group_status' => '0'), array('group_id'=>$member_id));
                $this->members_model->change_status($member_id, 'block');
                $groupRoster = $this->members_model->get_selected_where(array('group_id'=>$member_id));
                if($groupRoster){
                    if($groupRoster->num_rows()>=1){
                        $groupRosterResult = $groupRoster->result();
                        $this->members_model->update_where(array('group_status' => '0', 'status' => '0'), array('group_id'=>$groupRosterResult[0]->id));
                    }
                }
            }
            else{
                $this->members_model->change_status($member_id, 'block');
            }
            redirect(site_url('student/'.$back_url));
        }
    }

    function active_student($group_id, $back_url) {
        if ($this->is_user_logged_in == TRUE) {
            $this->members_model->change_student_status($group_id, 'active');
            redirect(site_url('student/'.$back_url));
        }
    }

    function block_student($group_id, $back_url) {
        if ($this->is_user_logged_in == TRUE) {
            $this->members_model->change_student_status($group_id, 'block');
            redirect(site_url('student/'.$back_url));
        }
    }


    function active_group_student($member_id, $group_id) {
        if ($this->is_user_logged_in == TRUE) {
            $this->members_model->change_status($member_id, 'active');
            redirect(site_url('student/session_roster/'.$group_id));
        }
    }

    function block_group_student($member_id, $group_id) {
        if ($this->is_user_logged_in == TRUE) {
            $this->members_model->change_status($member_id, 'block');
            redirect(site_url('student/session_roster/'.$group_id));
        }
    }

    function active_group_roster_student($member_id) {
        if ($this->is_user_logged_in == TRUE) {
            $mem = $this->members_model->fromId($member_id);
            $this->members_model->update(array('group_status'=>'1'),$member_id);
            $this->members_model->update_where(array('status'=>'1'),array('group_id'=>$member_id));
            redirect(site_url('student/session/'.$mem->group_id));
        }
    }

    function block_group_roster_student($member_id) {
        if ($this->is_user_logged_in == TRUE) {
            $mem = $this->members_model->fromId($member_id);
            $this->members_model->update(array('group_status'=>'0'),$member_id);
            $this->members_model->update_where(array('status'=>'0'),array('group_id'=>$member_id));
            redirect(site_url('student/session/'.$mem->group_id));
        }
    }

    function change_password() {


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $send_verification = false;
            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            $this->form_validation->set_rules('old_password', 'Old password', $this->config->item('form_base') . '|required|is_old_password_matched[' . $this->logged_in_member_id . ']');
            $this->form_validation->set_rules('new_password', 'New Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[new_password]');

            if ($this->form_validation->run() == TRUE) {
                $new_password = $this->members_model->change_password($this->logged_in_member_id);
                if ($new_password) {
                    setFlashMessage('flash_sucess','alert alert-success' ,'Successfully changed password. ');
                    redirect(site_url('members/login'));
                } else {
                    setFlashMessage('flash_error','alert alert-danger' ,'Unable to change password. ');
                    redirect(site_url('members/login'));
                }
            }
        }

        $data['module']='members';
        $data['template']='change_password';
        $data['web_title']="Change Password";
        $data['page_header']='Change Password';
        echo Modules::run('templates/adminLayout', $data);
    }




    function edit_profile() {

        $result = $this->members_model->fromId($this->logged_in_member_id);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $flag = false;
            $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
            
            if (strcasecmp($result->user_name, trim($this->input->post('user_name'))) == 0) {
                $this->form_validation->set_rules('user_name', 'User ID', $this->config->item('form_base') . '|required|min_length[6]|max_length[50]|username_format');
            } else {
                $this->form_validation->set_rules('user_name', 'User ID', $this->config->item('form_base') . '|required|min_length[6]|max_length[50]|is_unique[members.user_name]|username_format');
            }

            if (strcasecmp($result->email, trim($this->input->post('email'))) == 0) {
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]');
            } else {
                $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');
            }

            if($this->input->post('new_password') && $this->input->post('conf_password')){
                $flag = true;
                //$this->form_validation->set_rules('old_password', 'Old password', $this->config->item('form_base') . '|required|is_old_password_matched[' . $this->logged_in_member_id . ']');
                $this->form_validation->set_rules('new_password', 'New Password', $this->config->item('form_base') . '|required|min_length[8]|max_length[32]|valid_password');
                $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[8]|max_length[32]|matches[new_password]|valid_password');
            }

        
            if ($this->form_validation->run() == TRUE) {
                if($flag)
                {
                    $this->members_model->change_password($this->logged_in_member_id);
                }
                
                $update = $this->members_model->profile_update($this->logged_in_member_id, true);
                if ($update) {
                    setFlashMessage('flash_success','alert alert-success' ,'Successfully edited profile. ');
                    redirect(site_url('members/edit_profile'));
                }
                else{
                    setFlashMessage('flash_error','alert alert-danger' ,'Unable to edit profile. ');
                    redirect(site_url('members/edit_profile'));
                }
            }
        }
        $data['result']= $result;
        $data['module']='members';
        $data['template']='edit_profile';
        $data['web_title']="Admin Settings";
        $data['page_header']='Admin Settings';
        echo Modules::run('templates/adminLayout', $data);
    }

    /* end */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
