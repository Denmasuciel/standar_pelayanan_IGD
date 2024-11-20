<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nomor_antrian extends HX_Controller {

   public function __construct()
   {
      parent::__construct();
   }

	public function index()
	{
      $load['_judul'] = 'Display';

    
		//$load['kop'] = $this->mm->get('ref_jenis_koperasi');
		 // $result = $this->mm->get('ref_jenis_koperasi');
		 // foreach ($result as $row) {
		//	$param_kop = array();

			//$param_kop['where'] = array('id_jenis_koperasi'=>$row['id_jenis_koperasi']);
			//$load['jml_koperasi'][$row['id_jenis_koperasi']] = $this->mm->count('koperasi',$param_kop);
			
		//}
		  
		

      $this->view_admin('nomor_antrian', $load);
	}
}