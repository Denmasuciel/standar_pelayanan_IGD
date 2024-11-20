<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_koperasi extends HX_Controller {
 public $_subj  = 'Koperasi';
   public $_ctrl  = 'daftar_koperasi';
   public $_tabel = 'koperasi';
   public $_kunci = 'id_koperasi';

   public function __construct()
   {
      parent::__construct();
   }

	public function index($offset=null)
	{
		 $this->load->library('hx_tabel');
      $load['_judul'] = 'Dashboard';

       $param['join']   = array(array('ref_jenis_koperasi','ref_jenis_koperasi.id_jenis_koperasi=koperasi.id_jenis_koperasi'),
								array('ref_kecamatan','ref_kecamatan.id_kecamatan=koperasi.id_kecamatan'),
								array('ref_kelurahan','ref_kelurahan.id_kelurahan=koperasi.id_kelurahan'));
	  $param['order']  = 'id_koperasi ASC';
	  $param['limit']  = $this->limit;
      $param['offset'] = $offset;
	  
	  
	  
      $result   = $this->mm->get($this->_tabel,$param);
      $jml_data = $this->mm->count($this->_tabel,$param);
      $jml_a    = ($offset) ? $offset+1 : 1;
      $jml_b    = (($offset+count($result))!=$jml_data) ? $offset+$this->limit : $jml_data;

      $hal['url_halaman'] = 'admin/'.$this->_ctrl.'/index';
      $hal['jml_data']    = $jml_data;
      $hal['jml_a']       =  $load['no'] =  $jml_a;
      $hal['jml_b']       = $jml_b;

      $arr['nomor_hal']   = $jml_a;
      $arr['kunci']       = $this->_kunci;

	 
      // generate HTML
      $load['_paging'] = $this->hx_tabel->set_halaman($hal,$this->limit,4);
	  $load['_data'] = $this->mm->get($this->_tabel,$param);

		  
		

      $this->view_admin('daftar_koperasi', $load);
	}
	
  public function lihat($id=null)
	{

      
      
	  
	  $param['where'] = array('id_koperasi'=>$id);
	  $param['join']   = array(array('ref_jenis_koperasi','ref_jenis_koperasi.id_jenis_koperasi=koperasi.id_jenis_koperasi'),
								array('ref_kecamatan','ref_kecamatan.id_kecamatan=koperasi.id_kecamatan'),
								array('ref_kelurahan','ref_kelurahan.id_kelurahan=koperasi.id_kelurahan'));
      $load['koperasi']   = $this->mm->get('koperasi',$param,'roar');
	  
	  $param1['where'] = array('id_koperasi'=>$id,
							  'jabatan'=>'ketua');
      $load['foto_ketua']   = $this->mm->get('foto_pengurus',$param1,'roar');
	  
	  $param2['where'] = array('id_koperasi'=>$id,
							  'jabatan'=>'sekertaris');
      $load['foto_sekertaris']   = $this->mm->get('foto_pengurus',$param2,'roar');
	  
	  $param3['where'] = array('id_koperasi'=>$id,
							  'jabatan'=>'bendahara');
      $load['foto_bendahara']   = $this->mm->get('foto_pengurus',$param3,'roar');
	  
	  $param4['where'] = array('id_koperasi'=>$id);
      $load['pelaporan']   = $this->mm->get('pelaporan',$param4);
      
      // generate HTML

      $load['_judul']  = 'Detail Koperasi';

      $this->view_admin('hx_view_daftar_koperasi', $load);
	}
 public function peta_lokasi_koperasi_detail($id=null)
   {

	 $load['_judul'] = 'Koperasi';
	 if($id != null){
		   $param_map_search['where'] = array('id_koperasi'=>$id);
		   $load['result_serach'] = $this->mm->get('koperasi',$param_map_search,'roar');
		   $param_map_all['where'] = array('id_koperasi !='=>$id);
		   $load['result'] = $this->mm->get('koperasi',$param_map_all);
	  }elseif($id == null){
		 $load['result'] = $this->mm->get('koperasi');  
	  }

      $this->view_admin('peta_koperasi_detail', $load);
   }
	
public function info_window()
   {
      $id = $this->input->get('id');

      $result = $this->mm->get('koperasi',array('select'=>'koperasi.*,ref_jenis_koperasi.jenis_koperasi as jenis,ref_kecamatan.kecamatan as kecamatan,ref_kelurahan.kelurahan as kelurahan',
                                              'join'=>array(array('ref_jenis_koperasi','ref_jenis_koperasi.id_jenis_koperasi=koperasi.id_jenis_koperasi'),
                                                            array('ref_kecamatan','ref_kecamatan.id_kecamatan=koperasi.id_kecamatan'),
															array('ref_kelurahan','ref_kelurahan.id_kelurahan=koperasi.id_kelurahan')),
                                              'where'=>'id_koperasi='.$id),'roar');
											  

      if ($result['foto']) {
         $img = '<img src="'.base_url('foto/'.$result['foto']).'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }
      else {
         $img = '<img src="'.base_url('foto/default-img.jpg').'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }

     
	  $html = '<div id="content">
                  <div id="bodyContent" style="width:320px; max-height:300px; overflow-y:auto">
                    
                  
					 <h4>'.$result['nama_koperasi'].'</h4>
					 <table class="table"> 
										<tbody> 
											<tr> 
												<td rowspan="5" width="100px">'.$img.'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Alamat</b> : '.$result['alamat'].', kel. '.$result['kelurahan'].', kec.'.$result['kelurahan'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>No. Telp</b> : '.$result['telp'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Email</b> : '.$result['email'].'</td> 
											</tr>
											
										</tbody> 
										
									</table>
									<center><a href="'.base_url('admin/daftar_koperasi/lihat/'.$result['id_koperasi'].'').'"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <b>Detail Selengkapnya</b></a></center>
                  </div>
               </div>';
      echo $html;
   }
}