<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config_printer extends HX_Controller {

   public $_subj  = 'Printer';
   public $_ctrl  = 'config_printer';
   public $_tabel = 'printer';
   public $_kunci = 'id_printer';

   public function __construct()
   {
      parent::__construct();
   }

   public function meta_data($tipe='auto')
   {
  

      //tabel
      if ($tipe=='tabel') {
         $field['nama_printer']      = array('label'=>'Nama Printer','tipe'=>'text');
      }

      //form
      else if ($tipe=='form') {
         $field['nama_printer']     = array('label'=>'Nama Printer','tipe'=>'text','lebar'=>'6','attr'=>'required');
         
      }

      return $field;
   }

	public function index($offset=null)
	{
	   $this->load->library('hx_tabel');

     

      $load['pencarian'] = null;
      $load['form_cari'] = null;

	   //----------- parameter utk ambil data dr database ----------//
     
      $param['order']  = 'id_printer DESC';
      $param['limit']  = $this->limit;
      $param['offset'] = $offset;

      $result   = $this->mm->get($this->_tabel,$param);
      $jml_data = $this->mm->count($this->_tabel,$param);
      $jml_a    = ($offset) ? $offset+1 : 1;
      $jml_b    = (($offset+count($result))!=$jml_data) ? $offset+$this->limit : $jml_data;

      $hal['url_halaman'] = 'admin/'.$this->_ctrl.'/index';
      $hal['jml_data']    = $jml_data;
      $hal['jml_a']       = $jml_a;
      $hal['jml_b']       = $jml_b;

      $arr['nomor_hal']   = $jml_a;
      $arr['kunci']       = $this->_kunci;

      $aksi['edit']       = 'admin/'.$this->_ctrl.'/form';
      

      // generate HTML
      $load['_paging'] = $this->hx_tabel->set_halaman($hal,$this->limit,4);
      $load['_tabel']  = $this->hx_tabel->set_tabel($arr,$this->meta_data('tabel'),$result,$aksi);

      $load['_judul']  = 'Data '.$this->_subj.' (<b class="text-warning">'.$jml_data.'</b>)';

      $this->view_admin('hx_view_noadd', $load);
	}

   public function form($id=null)
   {
      $this->load->library('hx_form');

      $arr['kunci']    = $this->_kunci;
      $arr['tabel']    = $this->_tabel;
      $arr['subjek']   = $this->_subj;

      $arr['cs_form']  = 'vertical';
      $arr['cs_modal'] = 'modal-kecil';
      $arr['layout']   = 'single';

      $arr['url_redirect'] = 'admin/'.$this->_ctrl.'/index';
      $arr['url_action']   = 'admin/aksi/simpan';

      //jika edit
      $values = array();
      if ($id) {
         $values = $this->mm->get($this->_tabel,array('where'=>$this->_kunci.'='.$id),'roar');
      }

      echo $this->hx_form->set_template($arr,$this->meta_data('form'),$values);
   }

	public function form_upload($id,$field,$file=null)
	{
      $this->load->library('hx_form');

      if ($file) {
	      $arr_upload['foto'] = $file;
      }

      $arr_upload['ext']   = 'jpg,png';
      $arr_upload['size']  = '2097152';
      $arr_upload['path']  = 'foto';

      $arr_upload['tabel'] = $this->_tabel;
      $arr_upload['kunci'] = $this->_kunci;

      $arr_upload['url_redirect'] = 'admin/'.$this->_ctrl.'/index';
      $arr_upload['url_upload']   = 'admin/aksi/upload_file';

      echo $this->hx_form->set_upload($arr_upload,$id,$field);
	}

   
}