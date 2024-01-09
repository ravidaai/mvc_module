<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_setting_model extends MY_Model
{

    var $primary_key = "id";
    var $primary_name = "member_id"; //add this to db
    var $tbl = "amways_email_setting";

    function __construct()
    {
        parent::__construct();
    }


    function add($member_id)
    {


        $query = $this->insert(
            array(
                'member_id' => intval($member_id),
                'admin_name' => $this->input->post('admin_name'),
                'out_going_email' => $this->input->post('out_going_email'),
                'support_page_subject' => $this->input->post('support_page_subject'),
                'support_page_forward_email_to' => $this->input->post('support_page_forward_email_to'),
                'course_evaluation_subject' => $this->input->post('course_evaluation_subject'),
                'course_evaluation_forward_email_to' => $this->input->post('course_evaluation_forward_email_to'),
                'contact_us_home_subject' => $this->input->post('contact_us_home_subject'),
                'contact_us_home_forward_email_to' => $this->input->post('contact_us_home_forward_email_to'),
                'invite_group_subject' => $this->input->post('invite_group_subject'),
                'invite_group_email_body_text' => $this->input->post('invite_group_email_body_text'),
                'cc_enrollment_successfull_subject' => $this->input->post('cc_enrollment_successfull_subject'),
                'cc_enrollment_body_text' => $this->input->post('cc_enrollment_body_text'),
                'admin_has_change_pwd_subject' => $this->input->post('admin_has_change_pwd_subject'),
                'admin_has_change_pwd_body_text' => $this->input->post('admin_has_change_pwd_body_text'),

                'admin_has_send_password_reset_link_subject' => $this->input->post('admin_has_send_password_reset_link_subject'),
                'admin_has_send_password_reset_link_body' => $this->input->post('admin_has_send_password_reset_link_body'),

                'reset_pwd_request_subject' => $this->input->post('reset_pwd_request_subject'),
                'reset_pwd_request_body_text' => $this->input->post('reset_pwd_request_body_text')

            )
        );

        return $query;
    }


    function edit($member_id)
    {
        $update_arr =    array(
            'member_id' => intval($member_id),
            'admin_name' => $this->input->post('admin_name'),
            'out_going_email' => $this->input->post('out_going_email'),
            'support_page_subject' => $this->input->post('support_page_subject'),
            'support_page_forward_email_to' => $this->input->post('support_page_forward_email_to'),
            'course_evaluation_subject' => $this->input->post('course_evaluation_subject'),
            'course_evaluation_forward_email_to' => $this->input->post('course_evaluation_forward_email_to'),
            'contact_us_home_subject' => $this->input->post('contact_us_home_subject'),
            'contact_us_home_forward_email_to' => $this->input->post('contact_us_home_forward_email_to'),
            'invite_group_subject' => $this->input->post('invite_group_subject'),
            'invite_group_email_body_text' => $this->input->post('invite_group_email_body_text'),
            'cc_enrollment_successfull_subject' => $this->input->post('cc_enrollment_successfull_subject'),
            'cc_enrollment_body_text' => $this->input->post('cc_enrollment_body_text'),
            'admin_has_change_pwd_subject' => $this->input->post('admin_has_change_pwd_subject'),
            'admin_has_change_pwd_body_text' => $this->input->post('admin_has_change_pwd_body_text'),
            'admin_has_send_password_reset_link_subject' => $this->input->post('admin_has_send_password_reset_link_subject'),
            'admin_has_send_password_reset_link_body' => $this->input->post('admin_has_send_password_reset_link_body'),
            'reset_pwd_request_subject' => $this->input->post('reset_pwd_request_subject'),
            'reset_pwd_request_body_text' => $this->input->post('reset_pwd_request_body_text')

        );

        $query = $this->update($update_arr, intval($member_id));
        return $query;
    }

    function get_setting($member_id, $key)
    {
        $query = $this->get_selected_rows_where(array('member_id' => $member_id), array($key));
        //   echo $this->db->last_query();
        if ($query) {
            return $query[0]->$key;
        }
        return false;
    }
    function get($key)
    {
        $query = $this->get_selected_rows_where(array('member_id' => 1), array($key));
        if ($query) {
            return $query[0]->$key;
        }
        return false;
    }
}
