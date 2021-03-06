<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	var $folder = 'users/';
	var $layout = 'users/layout';
	var $table	= 'transaksi';
	var $section = 'Home';

	function __construct(){
		parent::__construct();
		$this->load->model(['model', 'validation']);
		$this->load->library(['form_validation']);
		$this->load->library('encryption');
	}

	public function index()
	{
		
		$data = ['content'=> $this->folder.('home'),'section'=>$this->section];
		$this->load->view($this->layout, $data);
	}

	public function listHarga(){
		$data = [
			'content'	=> $this->folder.('tarif'),
			'data'		=> $this->model->get_all('tarif')->result(),
			'section' => 'Daftar Harga'
		];
		$this->load->view($this->layout, $data);
	}

	public function lacak($id=null){
		$id = $this->input->get('idOrder');
		if(!$id){
			$data = [
				'content'	=> $this->folder.('lacak'),
				'tampil' 	=> null,
				'id'		=> '',
			'section' => 'Lacak Status Laundry'
			];
		}else{
			$cek = $this->model->get_by('transaksi_status', 'id_transaksi_s', $id)->result_array();
			$jum =count($cek);

			if($jum<1){
				$data = [
					'content'	=> $this->folder.('lacak'),
					'tampil'	=> 'noData',
					'id'		=> $id
				];
			}else{
				$data = [
					'content'	=> $this->folder.('lacak'),
					'tampil' 	=> 1,
					'data'		=> $cek,
					'id'		=> $id
				];
			}
		}
		$this->load->view($this->layout, $data);
	}
	public function kontak(){
		$data = ['content'=> $this->folder.('contact'),
			'section' => 'Kontak'];
		$this->load->view($this->layout, $data);
	}

}

/* End of file UserController.php */
/* Location: ./application/controllers/UserController.php */