<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller {
	public function __Construct(){
		parent::__Construct ();
		 $this->load->database(); // load database
		 $this->load->model('SendingModel'); // load model 
	   }
	public function index()
	{
		$this->data['infos'] = $this->SendingModel->getInfo();
		$this->load->view('send', $this->data);
	}
}