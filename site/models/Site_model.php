<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_model extends MY_Model {

    var $primary_key = "";
    var $primary_name = ""; //add this to db
    var $tbl = "";

    function __construct() {
        parent::__construct();
    }


}