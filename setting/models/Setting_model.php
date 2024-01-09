<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends MY_Model
{

    var $primary_key = "id";
    var $primary_name = "member_id"; //add this to db
    var $tbl = "setting";

    function __construct()
    {
        parent::__construct();
    }


    function add($member_id)
    {

        $query = $this->insert(
            array(
                'member_id' => intval($member_id),
                //'credit_card_registration'=>$this->input->post('credit_card_registration')?'Y':'N',
                'credit_card_registration'=>$this->input->post('credit_card_registration'),
                'course_title' => $this->input->post('course_title'),
                'course_access_day' => $this->input->post('course_access_day'),
                'course_rate' => $this->input->post('course_rate'),
                'course_home_header_text' => $this->input->post('course_home_header_text'),
                'course_evaluation_header_text' => $this->input->post('course_evaluation_header_text'),
                'support_page_header_text' => $this->input->post('support_page_header_text'),
                'about_this_course_body_text' => $this->input->post('about_this_course_body_text'),
                'terms_and_privacy_body_text' => $this->input->post('terms_and_privacy_body_text'),
            )
        );
        
        // $query = $this->insert(
        //     array(
        //         'member_id' => intval($member_id),
        //         'course_access_day' => $this->input->post('course_access_day'),
        //         'course_rate' => $this->input->post('course_rate'),
        //         'facebook_url' => $this->input->post('facebook_url'),
        //         'youtube_url' => $this->input->post('youtube_url'),
        //         'twitter_url' => $this->input->post('twitter_url'),
        //         'skype_url' => $this->input->post('skype_url'),
        //         'pintrest' => $this->input->post('pintrest'),
        //         'google_plus_url' => $this->input->post('google_plus_url'),
        //         'google_map_code' => $this->input->post('google_map_code'),
        //         'google_analytic_code' => $this->input->post('google_analytic_code'),
        //         'google_verification_code' => $this->input->post('google_verification_code'),
        //         'mobile_primary' => $this->input->post('mobile_primary'),
        //         'mobile_two' => $this->input->post('mobile_two'),
        //         'landline_primary' => $this->input->post('landline_primary'),
        //         'landline_two' => $this->input->post('landline_two'),
        //         'email_primary' => $this->input->post('email_primary'),
        //         'email_two' => $this->input->post('email_two'),
        //         'address_one' => $this->input->post('address_one'),
        //         'address_two' => $this->input->post('address_two'),
        //         'welcome_text' => $this->input->post('welcome_text'),
        //         'meta_keyword' => $this->input->post('meta_keyword'),
        //         'meta_description' => $this->input->post('meta_description'),
        //         'course_home_text_one' => $this->input->post('course_home_text_one'),
        //         'course_home_text_two' => $this->input->post('course_home_text_two'),
        //         'fax' => $this->input->post('fax'),
        //         'linkedin' => $this->input->post('linkedin'),
        //         'pobox' => $this->input->post('pobox'),
        //         'company_name' => $this->input->post('company_name'),
        //         'title' => $this->input->post('title'),
        //         'youtube' => $this->input->post('youtube'),

        //     )
        // );

        return $query;
    }


    function edit($member_id)
    {

        $update_arr =    array(
            // 'credit_card_registration'=>$this->input->post('credit_card_registration')?'Y':'N',
            'credit_card_registration'=>$this->input->post('credit_card_registration'),
            'course_title' => $this->input->post('course_title'),
            'course_access_day' => $this->input->post('course_access_day'),
            'course_rate' => $this->input->post('course_rate'),
            'course_home_header_text' => $this->input->post('course_home_header_text'),
            'course_evaluation_header_text' => $this->input->post('course_evaluation_header_text'),
            'support_page_header_text' => $this->input->post('support_page_header_text'),
            'about_this_course_body_text' => $this->input->post('about_this_course_body_text'),
            'terms_and_privacy_body_text' => $this->input->post('terms_and_privacy_body_text'),
        );
        // $update_arr =    array(
        //     'facebook_url' => $this->input->post('facebook_url'),
        //     'course_access_day' => $this->input->post('course_access_day'),
        //     'course_rate' => $this->input->post('course_rate'),
        //     'youtube_url' => $this->input->post('youtube_url'),
        //     'twitter_url' => $this->input->post('twitter_url'),
        //     'skype_url' => $this->input->post('skype_url'),
        //     'pintrest' => $this->input->post('pintrest'),
        //     'google_plus_url' => $this->input->post('google_plus_url'),
        //     'google_map_code' => $this->input->post('google_map_code'),
        //     'google_analytic_code' => $this->input->post('google_analytic_code'),
        //     'google_verification_code' => $this->input->post('google_verification_code'),
        //     'mobile_primary' => $this->input->post('mobile_primary'),
        //     'mobile_two' => $this->input->post('mobile_two'),
        //     'landline_primary' => $this->input->post('landline_primary'),
        //     'landline_two' => $this->input->post('landline_two'),
        //     'email_primary' => $this->input->post('email_primary'),
        //     'email_two' => $this->input->post('email_two'),
        //     'address_one' => $this->input->post('address_one'),
        //     'address_two' => $this->input->post('address_two'),
        //     'welcome_text' => $this->input->post('welcome_text'),
        //     'meta_keyword' => $this->input->post('meta_keyword'),
        //     'course_home_text_one' => $this->input->post('course_home_text_one'),
        //     'course_home_text_two' => $this->input->post('course_home_text_two'),
        //     'meta_description' => $this->input->post('meta_description'),
        //     'fax' => $this->input->post('fax'),
        //     'linkedin' => $this->input->post('linkedin'),
        //     'pobox' => $this->input->post('pobox'),
        //     'company_name' => $this->input->post('company_name'),
        //     'title' => $this->input->post('title'),
        //     'youtube' => $this->input->post('youtube'),
        // );

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
