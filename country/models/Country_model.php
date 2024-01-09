<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Country_model extends MY_Model {

    var $primary_key = "id";
    var $primary_name = "country_code";
    var $tbl = "apps_countries";

    function __construct() {
        parent::__construct();
    }

    function get_list()
    {
        $rows = $this->get_selected_rows( array('id','country_name'), 'country_name', 'ASC');

        if($rows)
        {
            $country_arr[''] =  'Country';
            foreach($rows->result() as $row){
                $country_arr[$row->id] =  $row->country_name;
            }
            return $country_arr;
        }
    }


}