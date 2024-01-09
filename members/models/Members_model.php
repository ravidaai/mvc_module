<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members_model extends MY_Model {

    var $primary_key = "id";
    var $primary_name = "user_name"; //add this to db
    var $tbl = "members";
    var $email_verification = '';

    function __construct() {
        parent::__construct();
    }



    function is_user_name_exist($user_name) {

        return $this->fromName($user_name, 'id');
    }

    function registration() {
        
        if (!$this->is_user_name_exist($this->input->post('user_name'))) {
            $salt = create_salt();
            $data = array(
                'user_name' => strtolower($this->input->post('user_name')),
                'email' => $this->input->post('email'),
                'pwd' => get_salted($salt, $this->input->post('pwd')),
                'status' => $this->input->post('status'),
                'salt' => $salt,
                'auth_key'=>$this->get_user_secret(),
                'capability' => 'admin',
                'full_name' => $this->input->post('full_name')
            );

            $id = $this->insert($data);
            if ($id) {
                return $id;
            }
        }
        return false;
    }

    function registration_frontend() {

        if (!$this->is_email_exist($this->input->post('email'))) {
            $salt = create_salt();
            $data = array(
                'first_name' => trim($this->input->post('first_name')),
                'last_name' => trim($this->input->post('last_name')),
                'country' => trim($this->input->post('country')),
                'institution' => trim($this->input->post('institution')),
                'user_name' => $this->input->post('email'),
                'start_date' => current_date(),
                'end_date' => add_to_current_date(!empty($this->setting_model->get('course_access_day'))?$this->setting_model->get('course_access_day'):7),
                'email' => $this->input->post('email'),
                'pwd' => get_salted($salt, $this->input->post('pwd')),
                'status' => '0',
                'salt' => $salt,
                'capability' => 'member',
            );

            $id = $this->insert($data);
            if ($id) {
                return $id;
            }
        }
        return false;
    }

    function profile_update($member_id, $access_super=false) {

        if($access_super)
        {
            $data = array(
                'email' => $this->input->post('email'),
                'user_name' => $this->input->post('user_name'),
                'status' => '1',
                'is_verified' => '1',
            );
        }
        else{
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'country' => $this->input->post('country')
            );
        }


        $update = $this->update($data, $member_id);
        if ($update) {

            return $update;
        }
        return false;
    }

    function update_total_login($member_id) {
        $sql = "update members set total_login=total_login+1 where id = ".$member_id;
        $update = $this->db->query($sql);
        if ($update) {
            return $update;
        }
        return false;
    }

    function change_status($member_id, $status) {
        if(strcasecmp($status, "active")==0){
            $data = array('status' => '1');
        }

        if(strcasecmp($status, "block")==0){
            $data = array('status' => '0');
        }

        $update = $this->update($data, $member_id);
        if ($update) {
            return true;
        }
        return false;
    }

    function change_student_status($group_id, $status) {
        if(strcasecmp($status, "active")==0){
            $data = array('status' => '1');
        }

        if(strcasecmp($status, "block")==0){
            $data = array('status' => '0');
        }

        $update = $this->update_where($data, array('group_id'=>$group_id));
        if ($update) {
            return true;
        }
        return false;
    }


    function change_password($member_id) {
        $salt = create_salt();
        $data = array('pwd' => get_salted($salt, $this->input->post('new_password')), 'salt' => $salt);
        $update = $this->update($data, $member_id);
        if ($update) {
            return trim($this->input->post('new_password'));
        }
        return false;
    }


    function check_user($user_name) {
        //full_name
        $query_user = $this->fromName($user_name, 'id,  user_name, email, member_type, first_name, last_name, group_name, status, pwd, salt, capability, verification_key, total_login, is_verified, start_date, end_date');
        if ($query_user) {
            return $query_user;
        } else {
            $this->primary_name = 'email';
            $query_user = $this->fromName($user_name, 'id,  user_name, email, member_type, first_name, last_name, group_name, status, pwd, salt, capability, verification_key, total_login, is_verified, start_date, end_date');
            if ($query_user) {
                return $query_user;
            }
        }

        return false;
    }



    function is_user_exist($user_name) {

        $query_user = $this->fromName($user_name, 'id,  user_name, email,  status, pwd, salt, capability');
        if ($query_user) {
            return $query_user;
        }
        return false;
    }


    function is_email_exist($user_email) {
        //full_name
        $this->primary_name = 'email';
        $query_user = $this->fromName($user_email, 'id,  user_name, email,  status, pwd, salt, capability');
        if ($query_user) {
            return $query_user;
        }
        return false;
    }

    function get_all_members(){
        $query  = $this->get_all_rows('id', 'desc');
        return $query;
    }


    function remove($member_id)
    {
        $query = $this->delete_where(
            array(
                'id' => intval($member_id)
            ));

        return $query;
    }


    private function get_user_secret()
    {
        do
        {
            $salt = sha1(random_string('alnum', config_item('rest_key_length')+ rand(5,10)));

            if ($salt == FALSE)
            {
                $salt = hash('sha256', time() . mt_rand());
            }

            $new_key = substr($salt, 0, config_item('rest_key_length'));
        }
        while ($this->key_exists($new_key));

        return $new_key;
    }


    private function key_exists($key)
    {
        return $this->db
            ->where('auth_key', $key)
            ->count_all_results($this->tbl) > 0;
    }

}