<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_quiz_submission_model extends MY_Model {

    var $primary_key = "id";
    var $primary_name = ""; //add this to db
    var $tbl = "anways_quiz_submission";
    var $email_verification = '';

    function __construct() {
        parent::__construct();
    }




}