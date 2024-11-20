<?php
error_reporting(E_ALL & ~E_NOTICE);
defined('BASEPATH') or exit('No direct script access allowed');

class Login_loket extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
   }

   public function index()
   {
      $id = $this->session->sess_user['op_loket'];

      if ($id) {

         $pesan = hx_info('info', 'Sesi anda masih aktif');
         $this->session->set_flashdata('hx_info', $pesan);
         redirect('layar_loket/loket_a');
      } else {
         $this->load->view('admin/login_loket');
      }
   }

   public function validasi()
   {
      $p = $this->input->post();

      if (empty($p)) {
         redirect('login_loket');
      }

      $user = $this->mm->get('user', array('where' => 'username="' . $p['us'] . '"'), 'roar');

      if ($user) {
         if (sha1($p['pw']) === $user['password']) {
            if ($user['aktif'] === 'Y') {
               $ceksts = $this->mm->get('status_loket');
               foreach ($ceksts as $rowcek) {
                  if ($rowcek['tanggal'] != date('Y-m-d')) {
                     $data = array(
                        'status' => '1',
                        'tanggal' => date('Y-m-d')
                     );
                     $updatecek = $this->mm->save('status_loket', $data, array('loket' => $rowcek['loket']));
                  } else {
                  }
               }
               $tgl_login = hx_tgl(substr($user['login_terakhir'], 0, 10), 'd-m-Y') . ' ' . substr($user['login_terakhir'], 11, 5);
               $foto      = ($user['foto']) ? $user['foto'] : 'unknown.jpg';

               $sess = array(
                  'op_loket' => $user['id_user'],
                  'nama' => $user['nama'],
                  'level' => $user['level'],
                  'id_loket' => $user['id_loket'],
                  'foto' => $foto,
                  'tgl_login' => $tgl_login,
                  'group_loket' => $user['group_loket']
               );

               $this->session->set_userdata('sess_user', $sess);

               $string = 'Select max(only_nomor_antrian) as maks From antrian 
					 where tanggal = "' . date('Y-m-d') . '" 
					 and 
					 aktif = "y"
					 and 
					 id_loket = ' . $user['id_loket'] . '
					 and
					 status_reset ="t"
                and loket="' . $user['group_loket'] . '"';

               $cek  = $this->mm->query($string, 'roar');
               if ($cek['maks'] != "") {

                  $this->session->set_userdata('loket_a_aktif', $cek['maks']);
               } else {

                  $this->session->set_userdata('loket_a_aktif', '0');
               }

               //update waktu login
               $up = array('login_terakhir' => date('Y-m-d H:i:s'));
               $this->mm->save('user', $up, array('id_user' => $user['id_user']));

               $pesan = hx_info('info', 'Anda berhasil masuk ke sistem');
               $this->session->set_flashdata('hx_info', $pesan);
               if ($this->session->sess_user['level'] == 'operator') {
                  redirect('layar_loket/loket_a');
               } else {
                  redirect('admin/login_loket');
               }
            } else {
               $pesan = hx_info('danger', 'Akun anda diblokir. Silahkan mengubungi Administrator');
               $this->session->set_flashdata('hx_info', $pesan);

               redirect('admin/login_loket');
            }
         } else {
            $pesan = hx_info('danger', 'Password yang anda masukan salah');
            $this->session->set_flashdata('hx_info', $pesan);

            redirect('admin/login_loket');
         }
      } else {
         $pesan = hx_info('danger', 'Anda belum terdaftar. Silahkan mengubungi Administrator');
         $this->session->set_flashdata('hx_info', $pesan);

         redirect('admin/login_loket');
      }
   }

   public function form()
   {
      $this->load->library('hx_form');

      $arr['kunci']    = 'id_user';
      $arr['tabel']    = 'user';
      $arr['subjek']   = 'Profil User';

      $arr['cs_form']  = 'vertical';
      $arr['cs_modal'] = 'modal-kecil';
      $arr['layout']   = 'single';
      $arr['attr']     = 'enctype="multipart/form-data"';

      $arr['url_redirect'] = 'admin/home/index';
      $arr['url_action']   = 'admin/login/simpan';

      $id  = $this->session->sess_user['id_user'];
      $val = $this->mm->get('user', array('where' => 'id_user=' . $id), 'roar');

      // array field
      $field['nama']     = array('label' => 'Nama Lengkap', 'tipe' => 'text', 'attr' => 'required');
      $field['username'] = array('label' => 'username', 'tipe' => 'text');
      $field['password'] = array('label' => 'Password', 'tipe' => 'password');
      $field['foto']     = array('label' => 'Foto Profil', 'tipe' => 'file');

      echo $this->hx_form->set_template($arr, $field, $val);
   }

   public function simpan()
   {
      $data  = $this->input->post('data');
      $url   = $this->input->post('url');
      $tabel = $this->input->post('tabel');
      $kunci = $this->input->post('kunci');
      $id    = ($this->input->post($kunci)) ? $this->input->post($kunci) : null;

      $update = array(
         'nama' => $data['nama'],
         'username' => $data['username'],
         'tgl_update' => date('Y-m-d H:i:s')
      );

      if ($data['password']) {
         $update['password']            = sha1($data['password']);
         $update['tgl_update_password'] = date('Y-m-d H:i:s');
      }

      if ($_FILES) {
         $rand = rand(111111111, 999999999);
         $nama = $tabel . '-' . $id . '-foto-' . $rand;

         $config['upload_path']   = './foto';
         $config['allowed_types'] = 'jpg|png';
         $config['file_name']     = $nama;

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('foto')) {
            $file = $this->upload->data();

            $update['foto'] = $file['file_name'];
         }
      }

      $save = $this->mm->save($tabel, $update, array($kunci => $id));

      if ($save) {
         $pesan = hx_info('success', 'Perubahan data telah tersimpan');
      } else {
         $pesan = hx_info('danger', 'Perubahan data gagal tersimpan');
      }

      $this->session->set_flashdata('hx_info', $pesan);
      redirect($url);
   }

   public function logout()
   {
      $this->session->sess_destroy('op_loket');

      $pesan = hx_info('info', 'Anda berhasil keluar dari sistem');
      $this->session->set_flashdata('hx_info', $pesan);

      redirect('admin/login_loket');
   }
}
