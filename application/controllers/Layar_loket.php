<?php defined('BASEPATH') or exit('No direct script access allowed');

class Layar_loket extends HX_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function index()

	{

		redirect();
	}

	public function loket_a()
	{
		// $session = $this->session->sess_user;
		$load['_judul'] = 'Standar Pelayanan IGD';
		// $cek = $this->mm->get('status_loket', array('where' => 'loket="1"'), 'roar');
		// $load['status_loket'] = $cek['status'];
		// $get_count = $this->mm->count('antrian', array('where' => 'tanggal="' . date('Y-m-d') . '" AND loket="' . $session['group_loket'] . '" AND status1 = "Belum"'));
		// // $get_count = $this->mm->count('antrian', array('where' => 'tanggal="' . date('Y-m-d') . '" AND loket="A" AND status1 = "Belum"'));
		// if ($get_count != null) {
		// 	$load['jml_blm'] = $get_count;
		// } else {
		// 	$load['jml_blm'] = 'Habis';
		// }
		// $load['sess'] = $session['id_loket'];
		// $load['gloket'] = $session['group_loket'];
		
		// // $load['gdata'] = $this->mm->ambildata();
		// $load['gdata'] = $this->tampildata();

		$this->view_loket('layar_loket_a', $load);
	}

	public function sisa_a()
	{
		$session = $this->session->sess_user;
		// $get_count = $this->mm->count('antrian', array('where' => 'tanggal="' . date('Y-m-d') . '" AND loket="A" AND status1 = "Belum"'));
		$get_count = $this->mm->count('antrian', array('where' => 'tanggal="' . date('Y-m-d') . '" AND loket="'.$session['group_loket'].'" AND status1 = "Belum"'));
		if ($get_count != null) {
			echo $get_count;
		} else {
			echo 'Habis';
		}
	}

	public function dataTable_a()
	{
		$session = $this->session->sess_user;
		$gl = $session['group_loket'];
		$this->datatables->from('antrian');
		$this->datatables->where('tanggal', date('Y-m-d'));
		// $this->datatables->where('loket', 'A');
		$this->datatables->where('loket', $gl);
		$this->datatables->where('status_reset', 't');
		$this->datatables->select('id_antrian,nomor_antrian,jam,tanggal,status1,status2');

		echo $this->datatables->generate();
	}

	function jsonlistdata()
    {
        echo $this->mm->ambildata();
    }
}
