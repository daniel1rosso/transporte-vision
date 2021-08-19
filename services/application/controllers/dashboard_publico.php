<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_publico extends MY_Controller {

    protected $data = array(
        'active' => 'dashboard_public'
    );

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load_view_public('dashboard_public', $this->data);
    }

}
