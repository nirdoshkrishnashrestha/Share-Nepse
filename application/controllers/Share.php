<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Share extends CI_Controller {

	public function add_share()
	{
		//$this->output->cache(20);
		$this->load->view('add_share');
	}

		public function insert_share1()
	{
		//$this->output->cache(20);
		$this->load->view('add_share');
	}
	
		public function edit_share($id)
	{
		$data["edit"] = $this->main_model->edit_share($id); 
		$this->load->view('edit_share',$data);

	}
	
	public function success()
	{
		$data["share_info"] = $this->main_model->get_share();
	}
	
	public function signout()
	{	//$this->output->delete_cache();
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		$this->load->view('login');
	}

	public function show_portfolio()
	{
		$data["share_info"] = $this->main_model->get_share_info();
		//$this->load->view('login');
		$this->load->view('profit',$data);
	}
	
	public function insert_share()
	{
		$data = array(
		"share_name" => $this->input->post("stock_symbol"),
		"date" => $this->input->post("date"),
		"buy_rate" => $this->input->post("buy_rate"),
		"num" => $this->input->post("num"),
		"username" => $this->session->userdata('username'),
		"type" => $this->input->post("type")
		);
		$this->main_model->insert_share($data);
		redirect(base_url()."index.php/share/show_portfolio");		
	}
	
		public function update_share()
	{
		$data = array(
		"share_name" => $this->input->post("stock_symbol"),
		"date" => $this->input->post("date"),
		"buy_rate" => $this->input->post("buy_rate"),
		"num" => $this->input->post("num"),
		"username" => $this->session->userdata('username')
		);
		$id = $this->input->post("id");
		$this->main_model->update_share($data,$id);
		redirect(base_url()."index.php/share/show_portfolio");		
	}
	
	public function individual($share_name)
	{
		
		$data["values"] = $this->main_model->individual($share_name); 
		$this->load->view('individual',$data);
	}
	
	public function delete($share_id)
	{
		$sql = "DELETE FROM `share_info` WHERE `share_info`.`share_id` = ".$share_id;
		$this->db->query($sql);	
		redirect(base_url()."index.php/share/show_portfolio");
	}
}
