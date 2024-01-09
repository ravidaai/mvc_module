<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_model extends MY_Model {

    var $primary_key = "id";
    var $primary_name = "id"; //add this to db
    var $tbl = "invoice";

    function __construct() {
        parent::__construct();
    }

}