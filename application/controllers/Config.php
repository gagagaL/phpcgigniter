<?php
class Config extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
	}

	public function index($page = 'home')
	{
		$this->load->view('templates/header');
		$this->load->view('config/index');
		$this->load->view('templates/footer');
	}

	public function new_topic($page = 'home')
	{
		$this->load->view('templates/header');
		$this->load->view('config/index');
		$this->load->view('templates/footer');
	}
}
