<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends HX_Controller {

   public $_subj  = 'User Sistem';
   public $_ctrl  = 'user';
   public $_tabel = 'user';
   public $_kunci = 'id_user';

   public function __construct()
   {
      parent::__construct();
   }

   public function meta_data($tipe='auto')
   {
      $level = array('admin'=>'Administrator',
					 'operator'=>'Operator Loket');

      //tabel
      if ($tipe=='tabel') {
         $field['aktif']      = array('label'=>'Aktif',
                                      'tipe'=>'status',
                                      'pilihan'=>array('N'=>array('label'=>'Aktifkan User',
                                                                  'class'=>'btn-default'),
                                                       'Y'=>array('label'=>'Nonaktifkan User',
                                                                  'class'=>'btn-primary')),
                                      'url_status'=>'admin/aksi/ubah_status/'.$this->_ctrl.'/index/'.$this->_tabel.'/'.$this->_kunci);

         $field['foto']       = array('label'=>'Foto',
                                      'tipe'=>'foto',
                                      'path_file'=>'foto',
                                      'lebar'=>'70px',
                                      'upload'=>'admin/'.$this->_ctrl.'/form_upload');

         $field['nama']       = array('label'=>'Nama','tipe'=>'text');
		 $field['id_loket']       = array('label'=>'No Loket','tipe'=>'text');
         $field['level']      = array('label'=>'Level','tipe'=>'array','list'=>$level);
         $field['username']   = array('label'=>'Username','tipe'=>'text');
         $field['tgl_daftar'] = array('label'=>'Terdaftar','tipe'=>'tanggal','format'=>'d M Y H:i');
         $field['login_terakhir'] = array('label'=>'Login Terakhir','tipe'=>'tanggal','format'=>'d M Y H:i');
      }

      //form
      else if ($tipe=='form') {
         $field['nama']     = array('label'=>'Nama','tipe'=>'text','lebar'=>'6','attr'=>'required');
         $field['level']    = array('label'=>'Level','tipe'=>'radio','list'=>$level);
		 $field['id_loket']    = array('label'=>'No Loket','tipe'=>'number','attr'=>'required');
         $field['username'] = array('label'=>'Username','tipe'=>'text','lebar'=>'4');
         $field['password'] = array('label'=>'Password','tipe'=>'password','lebar'=>'4');
         $field['aktif']    = array('label'=>'Aktif','tipe'=>'radio','list'=>array('Y'=>'Ya','N'=>'Tidak'));
      }

      return $field;
   }

	public function index($offset=null)
	{
	   $this->load->library('hx_tabel');

      $get    = $this->input->get();
      $like   = array();
      $get_na = '';

      if (isset($get['nama']) && $get['nama']) {
         $get_na = $get['nama'];
         $like   = array(array('user.nama',$get['nama']));
      }

      $field['nama']   = array('label'=>'Cari Nama atau Username','tipe'=>'text','value'=>$get_na);

      $load['pencarian'] = ($get) ? TRUE : FALSE;
      $load['form_cari'] = $this->hx_tabel->set_pencarian(array('aksi'=>'admin/user/index'),$field,$get);

	   //----------- parameter utk ambil data dr database ----------//
      $param['like']   = $like;
      $param['order']  = 'level ASC, nama ASC';
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
      $aksi['hapus']      = 'admin/aksi/hapus/'.$this->_ctrl.'/index/'.$this->_tabel.'/'.$this->_kunci;

      // generate HTML
      $load['_paging'] = $this->hx_tabel->set_halaman($hal,$this->limit,4);
      $load['_tabel']  = $this->hx_tabel->set_tabel($arr,$this->meta_data('tabel'),$result,$aksi);

      $load['_judul']  = 'Data '.$this->_subj.' (<b class="text-warning">'.$jml_data.'</b>)';

      $this->view_admin('hx_view', $load);
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
      $arr['url_action']   = 'admin/'.$this->_ctrl.'/simpan';

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

   public function simpan()
   {
      $data  = $this->input->post('data');
      $url   = $this->input->post('url');
      $tabel = $this->input->post('tabel');
      $kunci = $this->input->post('kunci');
      $id    = ($this->input->post($kunci)) ? $this->input->post($kunci) : null;

      $simpan = array('nama'=>$data['nama'],
                      'username'=>$data['username'],
                      'aktif'=>$data['aktif'],
                      'level'=>$data['level'],
					  'id_loket'=>$data['id_loket'],
                      'tgl_update'=>date('Y-m-d H:i:s'));

      if ($data['password']) {
         $simpan['password']            = sha1($data['password']);
         $simpan['tgl_update_password'] = date('Y-m-d H:i:s');
      }

      if ($id) {
         $save  = $this->mm->save($tabel,$simpan,array($kunci=>$id));

         if ($save) {
            $pesan = hx_info('success','Perubahan data telah tersimpan');
         }
         else {
            $pesan = hx_info('danger','Perubahan data gagal tersimpan');
         }
      }
      else {
         $save = $this->mm->save($tabel,$simpan);

         if ($save) {
            $pesan = hx_info('success','Data telah tersimpan');
         }
         else {
            $pesan = hx_info('danger','Data gagal tersimpan');
         }
      }

      $this->session->set_flashdata('hx_info',$pesan);
      redirect($url);
   }
}