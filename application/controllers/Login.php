<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __Construct(){
		parent::__Construct ();
		$this->load->library('session');
		$this->load->database(); // load database
		
	   }
	public function index()
	{	
        $this->load->view('login');
    }
}