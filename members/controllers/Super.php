<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controller after login or registration
class Super extends Super_Controller
{


    public function __construct()
    {
        parent::__construct();


    }

    public function index()
    {

        redirect(site_url('members/dashboard'));
        exit;

    }

    function member_list()
    {

        $data['query'] = $this->members_model->get_all_members();

        $data['module'] = 'members';
        $data['template'] = 'super_member_list';
        $data['web_title'] = 'Member list';
        $data['page_header'] = 'Members List' . '<a href="' . site_url('members/registration') . '" class="btn btn-success pull-right" role="button"><i class="fa fa-plus"></i> Create Admin</a>';
        echo Modules::run('templates/adminLayout', $data);
    }


    function change_password($member_id)
    {

        $result = $this->members_model->fromId($member_id);

        if ($result) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $send_verification = false;
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('new_password', 'New Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]');
                $this->form_validation->set_rules('conf_password', 'Confirm Password', $this->config->item('form_base') . '|required|min_length[6]|max_length[32]|matches[new_password]');

                if ($this->form_validation->run() == TRUE) {


                    $new_password = $this->members_model->change_password($member_id);
                    if ($new_password) {
                        setFlashMessage('flash_sucess', 'alert alert-success', 'Successfully changed password. ');
                        redirect(site_url('members/super/change_password') . '/' . $member_id);
                    } else {
                        setFlashMessage('flash_error', 'alert alert-danger', 'Unable to change password. ');
                        redirect(site_url('members/super/change_password') . '/' . $member_id);
                    }
                }
            }
        } else {
            setFlashMessage('flash_error', 'alert alert-danger', 'Unable to find member. ');
            redirect(site_url('members/super/member_list'));
        }


        $data['module'] = 'members';
        $data['template'] = 'super_change_password';
        $data['web_title'] = "Change Password";
        $data['page_header'] = 'Change Password';
        echo Modules::run('templates/adminLayout', $data);
    }


    function edit_profile($member_id)
    {

        $result = $this->members_model->fromId($member_id);

        if ($result) {

            if ($result->id == $this->logged_in_member_id) {
                redirect(site_url('members/edit_profile'));
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $send_verification = false;
                $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
                $this->form_validation->set_rules('full_name', 'Full Name', $this->config->item('form_base') . '|required|alpha_dash_space|max_length[50]');

                if (strcasecmp($result->email, trim($this->input->post('email'))) == 0) {
                    $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]');
                } else {
                    $this->form_validation->set_rules('email', 'email', $this->config->item('form_base') . '|required|valid_email|max_length[50]|is_unique[members.email]');
                }

                if ($this->form_validation->run() == TRUE) {


                    $update = $this->members_model->profile_update($member_id, true);
                    if ($update) {
                        setFlashMessage('flash_success', 'alert alert-success', 'Successfully edited profile. ');
                        redirect(site_url('members/super/edit_profile') . '/' . $member_id);
                    } else {
                        setFlashMessage('flash_error', 'alert alert-danger', 'Unable to edit profile. ');
                        redirect(site_url('members/super/edit_profile') . '/' . $member_id);
                    }
                }
            }
        } else {
            setFlashMessage('flash_error', 'alert alert-danger', 'Unable to find member. ');
            redirect(site_url('members/super/member_list') . '/' . $member_id);
        }

        $data['result'] = $result;
        $data['module'] = 'members';
        $data['status'] = array('Disabled', 'Enabled');
        $data['template'] = 'super_edit_profile';
        $data['web_title'] = "Edit Profile";
        $data['page_header'] = 'Edit Profile of ' . $result->full_name . '<a href="' . site_url('members/super/member_list') . '" class="btn btn-success pull-right" role="button"><i class="fa fa-plus"></i> Admin List</a>';
        echo Modules::run('templates/adminLayout', $data);
    }


    function member_delete($member_id)
    {
        if ($this->members_model->ifExist($member_id)) {

            if ($member_id == $this->logged_in_member_id) {
                setFlashMessage('flash_error', 'alert alert-danger', 'You can not delete your own account.');
                redirect(site_url('members/super/member_list'));
            } else {
                $getQuery = $this->members_model->fromId($member_id);
                $deleteQuery = $this->members_model->remove($member_id);
                if ($deleteQuery) {

                    setFlashMessage('flash_error', 'alert alert-success', 'Successfully deleted account of "' . $getQuery->full_name . '".');
                    redirect(site_url('members/super/member_list'));
                }
            }
        } else {
            setFlashMessage('flash_error', 'alert alert-danger', 'Account with ID "' . $member_id . '" not found.');
            redirect(site_url('members/super/member_list'));
        }


    }


    /* end */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
