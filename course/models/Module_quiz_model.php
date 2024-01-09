<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_quiz_model extends MY_Model {

    var $primary_key = "id";
    var $primary_name = ""; //add this to db
    var $tbl = "amways_module_quiz";
    var $email_verification = '';

    function __construct() {
        parent::__construct();
    }




}