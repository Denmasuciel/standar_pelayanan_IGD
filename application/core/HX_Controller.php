<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class HX_Controller extends CI_Controller {

   public $us;
   public $limit = 10;

   public function __construct()
   {
      parent::__construct();

      $this->us = $this->session->sess_user;
   }

   public function view_admin($view,$load)
   {
      // if (empty($this->us)) {
      //    $pesan = hx_info('warning','Silahkan Login terlebih dahulu');
      //    $this->session->set_flashdata('hx_info', $pesan);

		//    redirect('admin/login');
      // }

      // $load['_konten'] = $this->load->view('admin/'.$view,$load,TRUE);

      // $this->load->view('admin/template',$load);
   }
   
   public function view_loket($view,$load)
   {
	//   if (empty($this->us)) {
   //       $pesan = hx_info('warning','Silahkan Login terlebih dahulu');
   //       $this->session->set_flashdata('hx_info', $pesan);

	// 	   redirect('admin/login_loket');
   //    }
      $load['_konten'] = $this->load->view($view,$load,TRUE);

      $this->load->view('template',$load);
   }

   public function view_publik($view,$load)
   {
      $load['_konten'] = $this->load->view($view,$load,TRUE);

      $this->load->view('template',$load);
   }
   
   public function view_publik2($view,$load)
   {
      $load['_konten'] = $this->load->view($view,$load,TRUE);

      $this->load->view('template2',$load);
   }
   
   public function view_publik3($view,$load)
   {
      $load['_konten'] = $this->load->view($view,$load,TRUE);

      $this->load->view('template3',$load);
   }
   
   public function view_publik_lcd($view,$load)
   {
      $load['_konten'] = $this->load->view($view,$load,TRUE);

      $this->load->view('template_lcd',$load);
   }
   
    public function view_publik_printer($view,$load)
   {
      $load['_konten'] = $this->load->view($view,$load,TRUE);

      $this->load->view('template_printer',$load);
   }
}