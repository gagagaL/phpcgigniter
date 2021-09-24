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

	public function new_topic()
	{
		$this->load->view('templates/header');
		$this->load->view('config/new_topic');
		$this->load->view('templates/footer');
	}

	public function topic_edit()
	{
		$this->load->view('templates/header');
		$this->load->view('config/new_topic');
		$this->load->view('templates/footer');
	}

	public function create()
	{
		var_dump($this->input->post());
	}
}
