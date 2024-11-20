<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends HX_Controller {

   public function __construct()
   {
      parent::__construct();
   }

   public function index()
   {
      $load['_judul'] = 'Home';

      $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');

      $this->view_publik('home', $load);
   }
   
    public function informasi_wilayah($offset=null)
   {
      $load['_judul'] = 'Informasi Wilayah';
	  $this->load->library('hx_tabel');

	   //----------- parameter utk ambil data dr database ----------//
      $param['order']  = 'id_wilayah ASC';
      $param['limit']  = $this->limit;
      $param['offset'] = $offset;

      $result   = $this->mm->get('wilayah',$param);
      $jml_data = $this->mm->count('wilayah',$param);
      $jml_a    = ($offset) ? $offset+1 : 1;
      $jml_b    = (($offset+count($result))!=$jml_data) ? $offset+$this->limit : $jml_data;

      $hal['url_halaman'] = 'web/Informasi_wilayah';
      $hal['jml_data']    = $jml_data;
      $hal['jml_a']       = $jml_a;
      $hal['jml_b']       = $jml_b;

      $arr['nomor_hal']   = $jml_a;
      $arr['kunci']       = 'id_wilayah';
	  $load['_paging'] = $this->hx_tabel->set_halaman($hal,$this->limit,3);
	  $load['result'] = $this->mm->get('wilayah',$param);
	  $result = $this->mm->get('wilayah',$param);
	  foreach ($result as $row) {
			$param_klasis = array();

			$param_klasis['where'] = array('id_wilayah'=>$row['id_wilayah']);
			$load['jml_klasis'][$row['id_wilayah']] = $this->mm->count('klasis',$param_klasis);
		
			
			$load['jml_jemaat'][$row['id_wilayah']] = $this->mm->count('jemaat',array('join'=>array(array('klasis','jemaat.id_klasis=klasis.id_klasis'),
																									array('wilayah','klasis.id_wilayah=wilayah.id_wilayah')),
																										  'where'=>'wilayah.id_wilayah='.$row['id_wilayah']));
			
			$kk = $this->mm->get('jemaat',array('select'=>'sum(jemaat.jumlah_kk) as jml_kk,
														   sum(jemaat.jumlah_jiwa) as jml_jiwa,
														   Sum(jemaat.jumlah_pendeta) as jml_pendeta,
														   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
														   Sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
														   Sum(jemaat.jumlah_penginjil) as jml_penginjil,',
																				'join'=>array(array('klasis','jemaat.id_klasis=klasis.id_klasis'),
																							  array('wilayah','klasis.id_wilayah=wilayah.id_wilayah')),
																				'where'=>'wilayah.id_wilayah='.$row['id_wilayah']),'roar');
			$load['jml_kk'][$row['id_wilayah']] = $kk['jml_kk'];
			$load['jml_jiwa'][$row['id_wilayah']] = $kk['jml_jiwa'];
			$load['jml_pegawai'][$row['id_wilayah']] = $kk['jml_pendeta']+$kk['jml_guru_jemaat']+$kk['jml_penginjil'];
			
			
		}
		
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	  $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
	
	
		

      $this->view_publik('Informasi_wilayah', $load);
   }
   
    public function detail_wilayah($id_wilayah=null,$offset=null)
   {
	   $this->session->set_userdata('id_wilayah',$id_wilayah);
      $load['_judul'] = 'Detal Wilayah';
	  $this->load->library('hx_tabel');


	  
	  $param_wilayah['where'] = array('id_wilayah'=>$id_wilayah);
	  $load['d_wilayah'] = $this->mm->get('wilayah',$param_wilayah,'roar');
	  
	  $foto = $this->mm->get('wilayah',$param_wilayah,'roar');
	  if($foto['foto_ketua']!=null)
	  {$load['foto_ketua'] = 'foto_wilayah/'.$foto['foto_ketua']; }else{$load['foto_ketua'] = 'foto_wilayah/no-image.png';}
		
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
      $this->view_publik('detail_wilayah', $load);
   }
   
      public function detail_klasis($id_klasis=null,$offset=null)
   {
	  
	  $this->session->set_userdata('id_klasis',$id_klasis);
      $load['_judul'] = 'Detal Wilayah';
	  $this->load->library('hx_tabel');


	  
	  $param_klasis['where'] = array('id_klasis'=>$id_klasis);
	  $load['d_klasis'] = $this->mm->get('klasis',$param_klasis,'roar');
	  
	  $param_foto1['where'] = array('id_klasis'=>$id_klasis,'jabatan'=>'ketua');
	  $foto = $this->mm->get('foto_pengurus',$param_foto1,'roar');
	  if($foto['nama_foto']!=null){$load['foto_ketua'] = 'foto_pengurus/'.$foto['nama_foto']; }else{$load['foto_wakil_ketua'] =  'icon/people-a.png'; }
	  
	  $param_foto2['where'] = array('id_klasis'=>$id_klasis,'jabatan'=>'wakil_ketua');
	  $foto2 = $this->mm->get('foto_pengurus',$param_foto2,'roar');
	  if($foto2['nama_foto']!=null){$load['foto_wakil_ketua'] = 'foto_pengurus/'.$foto2['nama_foto']; }else{$load['foto_wakil_ketua'] =  'icon/people-a.png';}
		
	  $param_foto3['where'] = array('id_klasis'=>$id_klasis,'jabatan'=>'sekertaris');
	  $foto3 = $this->mm->get('foto_pengurus',$param_foto3,'roar');
	  if($foto3['nama_foto']!=null){$load['foto_sekertaris'] = 'foto_pengurus/'.$foto3['nama_foto']; }else{$load['foto_sekertaris'] =  'icon/people-a.png';}
	  
	  $param_foto4['where'] = array('id_klasis'=>$id_klasis,'jabatan'=>'wakil_sekertaris');
	  $foto4 = $this->mm->get('foto_pengurus',$param_foto4,'roar');
	  if($foto4['nama_foto']!=null){$load['foto_wakil_sekertaris'] = 'foto_pengurus/'.$foto4['nama_foto']; }else{$load['foto_wakil_sekertaris'] =  'icon/people-a.png';}
		
	  $param_foto5['where'] = array('id_klasis'=>$id_klasis,'jabatan'=>'bendahara');
	  $foto5 = $this->mm->get('foto_pengurus',$param_foto5,'roar');
	  if($foto5['nama_foto']!=null){$load['foto_bendahara'] = 'foto_pengurus/'.$foto5['nama_foto']; }else{$load['foto_bendahara'] =  'icon/people-a.png';}
		
	  
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
      $this->view_publik('detail_klasis', $load);
   }
   
   
        public function detail_jemaat($id_jemaat=null,$offset=null)
   {
	  
	  $this->session->set_userdata('id_jemaat',$id_jemaat);
      $load['_judul'] = 'Detal Wilayah';
	  $this->load->library('hx_tabel');


	  
	  $param_jemaat['where'] = array('id_jemaat'=>$id_jemaat);
	  $load['d_jemaat'] = $this->mm->get('jemaat',$param_jemaat,'roar');
	  
	    $foto = $this->mm->get('jemaat',$param_jemaat,'roar');
	  if($foto['foto_ketua']!=null)
	  {$load['foto_ketua'] = 'foto_jemaat/'.$foto['foto_ketua']; }else{$load['foto_ketua'] = 'foto_jemaat/no-image.png';}
	  
	  
	  $param_tjemaat['where'] = array('id_jemaat'=>$id_jemaat);
	  $param_tjemaat['select'] = 'sum(jumlah_kk) as jml_kk,sum(jumlah_jiwa) as jml_jiwa,jemaat.*';
	  $load['t_jemaat'] = $this->mm->get('jemaat', $param_tjemaat,'roar');
		
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
      $this->view_publik('detail_jemaat', $load);
   }
   
   public function datatables_klasis()
    {
		
   $this->datatables->from('klasis');
   $this->datatables->where('klasis.id_wilayah',$this->session->userdata('id_wilayah'));
   $this->datatables->select('klasis.id_klasis,klasis.nama,klasis.pusat,klasis.ketua,klasis.alamat,klasis.no_telp,klasis.email,klasis.url_website');
   //print_r($this->datatables->generate());exit();
   echo $this->datatables->generate();
   
   
   
    }
	
 public function datatables_jemaat()
    {
		
   $this->datatables->from('jemaat');
   $this->datatables->join('klasis','klasis.id_klasis = jemaat.id_klasis');
   $this->datatables->where('klasis.id_wilayah',$this->session->userdata('id_wilayah'));
   $this->datatables->select('jemaat.id_jemaat,jemaat.nama,jemaat.ketua,jemaat.alamat,jemaat.no_telp,jemaat.email');
   //print_r($this->datatables->generate());exit();
   echo $this->datatables->generate();
   
   
   
    }
	
 public function datatables_jemaat_fklasis()
    {
		
   $this->datatables->from('jemaat');
   $this->datatables->join('klasis','klasis.id_klasis = jemaat.id_klasis');
   $this->datatables->where('klasis.id_klasis',$this->session->userdata('id_klasis'));
   $this->datatables->select('jemaat.id_jemaat,jemaat.nama,jemaat.ketua,jemaat.alamat,jemaat.no_telp,jemaat.email');
   //print_r($this->datatables->generate());exit();
   echo $this->datatables->generate();
   
   
   
    }
   
   
      public function informasi_klasis($offset=null)
   {
      $load['_judul'] = 'Informasi Klasis';
	  $this->load->library('hx_tabel');

	   //----------- parameter utk ambil data dr database ----------//
      $param['order']  = 'id_klasis ASC';
      $param['limit']  = $this->limit;
      $param['offset'] = $offset;

      $result   = $this->mm->get('klasis',$param);
      $jml_data = $this->mm->count('klasis',$param);
      $jml_a    = ($offset) ? $offset+1 : 1;
      $jml_b    = (($offset+count($result))!=$jml_data) ? $offset+$this->limit : $jml_data;

      $hal['url_halaman'] = 'web/Informasi_klasis';
      $hal['jml_data']    = $jml_data;
      $hal['jml_a']       = $jml_a;
      $hal['jml_b']       = $jml_b;

      $arr['nomor_hal']   = $jml_a;
      $arr['kunci']       = 'id_klasis';
	  $load['_paging'] = $this->hx_tabel->set_halaman($hal,$this->limit,3);
	  $load['result'] = $this->mm->get('klasis',$param);
	  $result = $this->mm->get('klasis',$param);
	  foreach ($result as $row) {
			$param_klasis = array();

			$param_klasis['where'] = array('id_klasis'=>$row['id_klasis']);
		
			
			$load['jml_jemaat'][$row['id_klasis']] = $this->mm->count('jemaat',array('where'=>'jemaat.id_klasis='.$row['id_klasis']));
			
			$kk = $this->mm->get('jemaat',array('select'=>'sum(jemaat.jumlah_kk) as jml_kk,
														   sum(jemaat.jumlah_jiwa) as jml_jiwa,
														   sum(jemaat.jumlah_pendeta) as jml_pendeta,
														   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
														   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
														   sum(jemaat.jumlah_penginjil) as jml_penginjil',
												'join'=>array(array('klasis','jemaat.id_klasis=klasis.id_klasis')),
												'where'=>'jemaat.id_klasis='.$row['id_klasis']),'roar');
			$load['jml_kk'][$row['id_klasis']] = $kk['jml_kk'];
			$load['jml_jiwa'][$row['id_klasis']] = $kk['jml_jiwa'];
			$load['jml_pegawai'][$row['id_klasis']] = $kk['jml_pendeta']+$kk['jml_guru_jemaat']+$kk['jml_penginjil'];
			
			
		}
		
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
	
	
		

      $this->view_publik('Informasi_klasis', $load);
   }
   
    public function informasi_jemaat($offset=null)
   {
      $load['_judul'] = 'Informasi Jemaat';
	  $this->load->library('hx_tabel');

	   //----------- parameter utk ambil data dr database ----------//
      $param['order']  = 'id_jemaat ASC';
      $param['limit']  = $this->limit;
      $param['offset'] = $offset;

      $result   = $this->mm->get('jemaat',$param);
      $jml_data = $this->mm->count('jemaat',$param);
      $jml_a    = ($offset) ? $offset+1 : 1;
      $jml_b    = (($offset+count($result))!=$jml_data) ? $offset+$this->limit : $jml_data;

      $hal['url_halaman'] = 'web/Informasi_jemaat';
      $hal['jml_data']    = $jml_data;
      $hal['jml_a']       = $jml_a;
      $hal['jml_b']       = $jml_b;

      $arr['nomor_hal']   = $jml_a;
      $arr['kunci']       = 'id_jemaat';
	  $load['_paging'] = $this->hx_tabel->set_halaman($hal,$this->limit,3);
	  $load['result'] = $this->mm->get('jemaat',$param);
	  $result = $this->mm->get('jemaat',$param);
	  foreach ($result as $row) {
			$param_klasis = array();

		
			
			//$load['jml_jemaat'][$row['id_jemaat']] = $this->mm->count('jemaat',array('where'=>'jemaat.id_jemaat='.$row['id_jemaat']));
			
			$kk = $this->mm->get('jemaat',array('select'=>'sum(jemaat.jumlah_kk) as jml_kk,
														   sum(jemaat.jumlah_penatua) as jml_penatua,
														   sum(jemaat.jumlah_syamas) as jml_syamas,
														   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
														   sum(jemaat.jumlah_wek) as jml_wek,
														   sum(jemaat.jumlah_ksp) as jml_ksp,
														   sum(jemaat.jumlah_pendeta) as jml_pendeta,
														   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
														   sum(jemaat.jumlah_penginjil) as jml_penginjil,
														   sum(jemaat.jumlah_tenaga_adm) as jumlah_tenaga_adm,
														   sum(jemaat.jumlah_jiwa) as jml_jiwa',
														   'where'=>'jemaat.id_jemaat='.$row['id_jemaat']),'roar');
			$load['jml_kk'][$row['id_jemaat']] = $kk['jml_kk'];
			$load['jml_jiwa'][$row['id_jemaat']] = $kk['jml_jiwa'];
			$load['jml_penatua'][$row['id_jemaat']] = $kk['jml_penatua'];
			$load['jml_syamas'][$row['id_jemaat']] = $kk['jml_syamas'];
			$load['jml_wek'][$row['id_jemaat']] = $kk['jml_wek'];
			$load['jml_ksp'][$row['id_jemaat']] = $kk['jml_ksp'];
			$load['jml_pendeta'][$row['id_jemaat']] = $kk['jml_pendeta'];
			$load['jml_guru_jemaat'][$row['id_jemaat']] = $kk['jml_guru_jemaat'];
			$load['jml_penginjil'][$row['id_jemaat']] = $kk['jml_penginjil'];
			$load['jumlah_tenaga_adm'][$row['id_jemaat']] = $kk['jumlah_tenaga_adm'];
			
			
		}
		
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
	
	
		

      $this->view_publik('Informasi_jemaat', $load);
   }
   
       public function peta_wilayah($id=null)
   {
	  $load['_judul'] = 'Peta Wilayah';
	  if($id != null){
		   $param_map_search['where'] = array('id_wilayah'=>$id);
		   $load['result_serach'] = $this->mm->get('wilayah',$param_map_search,'roar');
		   $param_map_all['where'] = array('id_wilayah !='=>$id);
		   $load['result'] = $this->mm->get('wilayah',$param_map_all);
	  }elseif($id == null){
		 $load['result'] = $this->mm->get('wilayah');  
	  }
     
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
      $this->view_publik('peta_wilayah', $load);
   }
   
        public function peta_klasis($id=null)
   {

	 $load['_judul'] = 'Peta Klasis';
	  if($id != null){
		   $param_map_search['where'] = array('id_klasis'=>$id);
		   $load['result_serach'] = $this->mm->get('klasis',$param_map_search,'roar');
		   $param_map_all['where'] = array('id_klasis !='=>$id);
		   $load['result'] = $this->mm->get('klasis',$param_map_all);
	  }elseif($id == null){
		 $load['result'] = $this->mm->get('klasis');  
	  }
	 
     
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
      $this->view_publik('peta_klasis', $load);
   }
   
         public function peta_jemaat($id=null)
   {

	 $load['_judul'] = 'Peta Jemaat';
	 if($id != null){
		   $param_map_search['where'] = array('id_jemaat'=>$id);
		   $load['result_serach'] = $this->mm->get('jemaat',$param_map_search,'roar');
		   $param_map_all['where'] = array('id_jemaat !='=>$id);
		   $load['result'] = $this->mm->get('jemaat',$param_map_all);
	  }elseif($id == null){
		 $load['result'] = $this->mm->get('jemaat');  
	  }
    
	  $load['wilayah'] = $this->mm->count('wilayah');
      $load['klasis']  = $this->mm->count('klasis');
      $load['jemaat']  = $this->mm->count('jemaat');
	   $load['total'] = $this->mm->get('jemaat',array('select'=>'   sum(jemaat.jumlah_kk) as jml_kk,
																   sum(jemaat.jumlah_pendeta) as jml_pendeta,
																   sum(jemaat.jumlah_jemaat_kategorial) as jml_jemaat_kategorial,
																   sum(jemaat.jumlah_guru_jemaat) as jml_guru_jemaat,
																   sum(jemaat.jumlah_penginjil) as jml_penginjil,
																   sum(jemaat.jumlah_jiwa) as jml_jiwa'
																,'roar'));
      $this->view_publik('peta_jemaat', $load);
   }

   public function wilayah()
   {
      $load['_judul'] = 'Wilayah Pelayanan';
      $load['result'] = $this->mm->get('wilayah');

      $this->view_publik('wilayah', $load);
   }

   public function info_wilayah()
   {
      $id = $this->input->get('id');

      $result = $this->mm->get('wilayah',array('where'=>'id_wilayah='.$id),'roar');
      $klasis = $this->mm->count('klasis',array('where'=>'id_wilayah='.$id));
      $jemaat = $this->mm->count('jemaat',array('where'=>'id_klasis IN (SELECT id_klasis from klasis WHERE id_wilayah='.$id.')'));

      $jiwa = $this->mm->get('jemaat',array('select'=>'SUM(jumlah_kk) as kk,SUM(jumlah_jiwa) as jemaat','where'=>'id_klasis IN (SELECT id_klasis from klasis WHERE id_wilayah='.$id.')'),'roar');

      $kk = (isset($jiwa['kk'])) ? $jiwa['kk'] : 0;
      $je = (isset($jiwa['jemaat'])) ? $jiwa['jemaat'] : 0;

      if ($result['foto']) {
         $img = '<img src="'.base_url('foto/'.$result['foto']).'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }
      else {
         $img = '<img src="'.base_url('foto/klasis_default.jpg').'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }

      $html = '<div id="iw-container">
			   <div class="iw-title">'.$result['nama'].'</div>
                <div class="iw-content">
<div class="iw-subTitle">Data</div>				
                  
					 <h4>'.$result['nama'].'</h4>
					 <table class="table"> 
										<tbody> 
											<tr> 
												<td rowspan="6" width="100px">'.$img.'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Ketua</b> : '.$result['ketua'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Pusat</b> : '.$result['pusat'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>No. Telp</b> : '.$result['no_telp'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Email</b> : '.$result['email'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Alamat</b> : '.$result['alamat'].'</td> 
											</tr>
											<tr> 
												<td colspan="2">
												<table border="1" style="width:100%">
													<tr>
													   <td>Klasis</td>
													   <td>Jemaat</td>
													   <td>KK</td>
													   <td>Jiwa</td>
													</tr>
													<tr>
													   <td><b>'.$klasis.'</b></td>
													   <td><b>'.$jemaat.'</b></td>
													   <td><b>'.$kk.'</b></td>
													   <td><b>'.$je.'</b></td>
													</tr>
												 </table>
												 </td> 
											</tr>
										</tbody> 
										
									</table>
									<center><a href="'.base_url('web/detail_wilayah/'.$result['id_wilayah'].'').'"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <b>Detail Selengkapnya</b></a></center>
                  </div>
				  <div class="iw-bottom-gradient"></div>
                  </div>';

      echo $html;
   }

   public function klasis()
   {
      $load['_judul'] = 'Klasis';
      $load['result'] = $this->mm->get('klasis');

      $this->view_publik('klasis', $load);
   }

   public function info_klasis()
   {
      $id = $this->input->get('id');

      $result = $this->mm->get('klasis',array('select'=>'klasis.*,wilayah.nama as wilayah',
                                              'join'=>array(array('wilayah','klasis.id_wilayah=wilayah.id_wilayah')),
                                              'where'=>'id_klasis='.$id),'roar');

      $jemaat = $this->mm->count('jemaat',array('where'=>'id_klasis='.$id));

      $jiwa = $this->mm->get('jemaat',array('select'=>'SUM(jumlah_kk) as kk,SUM(jumlah_jiwa) as jemaat',
                                              'where'=>'id_klasis='.$id),'roar');

      $kk = (isset($jiwa['kk'])) ? $jiwa['kk'] : 0;
      $je = (isset($jiwa['jemaat'])) ? $jiwa['jemaat'] : 0;

      if ($result['foto']) {
         $img = '<img src="'.base_url('foto/'.$result['foto']).'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }
      else {
         $img = '<img src="'.base_url('foto/klasis_default.jpg').'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }

       $html = '<div id="content">
                  <div id="bodyContent" style="width:320px; max-height:300px; overflow-y:auto">
                    
                  
					 <h4>'.$result['nama'].'</h4>
					 <table class="table"> 
										<tbody> 
											<tr> 
												<td rowspan="7" width="100px">'.$img.'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Ketua</b> : '.$result['ketua'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Pusat</b> : '.$result['pusat'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>No. Telp</b> : '.$result['no_telp'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Email</b> : '.$result['email'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Alamat</b> : '.$result['alamat'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Website</b> : '.$result['url_website'].'</td> 
											</tr>
											<tr> 
												<td colspan="2">
												<table border="1" style="width:100%">
													<tr>
													   <td>Jemaat</td>
													   <td>KK</td>
													   <td>Jiwa</td>
													</tr>
													<tr>
													   <td><b>'.$jemaat.'</b></td>
													   <td><b>'.$kk.'</b></td>
													   <td><b>'.$je.'</b></td>
													</tr>
												 </table>
												 </td> 
											</tr>
										</tbody> 
										
									</table>
									<center><a href="'.base_url('web/detail_klasis/'.$result['id_klasis'].'').'"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <b>Detail Selengkapnya</b></a></center>
                  </div>
               </div>';

      echo $html;
   }

   public function jemaat()
   {
      $load['_judul'] = 'jemaat';
      $load['result'] = $this->mm->get('jemaat');

      $this->view_publik('jemaat', $load);
   }

   public function info_jemaat()
   {
      $id = $this->input->get('id');

      $result = $this->mm->get('jemaat',array('select'=>'jemaat.*,klasis.nama as klasis,wilayah.nama as wilayah',
                                              'join'=>array(array('klasis','jemaat.id_klasis=klasis.id_klasis'),
                                                            array('wilayah','klasis.id_wilayah=wilayah.id_wilayah')),
                                              'where'=>'id_jemaat='.$id),'roar');

      if ($result['foto']) {
         $img = '<img src="'.base_url('foto/'.$result['foto']).'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }
      else {
         $img = '<img src="'.base_url('foto/jemaat_default.jpg').'" style="width:100px;height:100px;float:left;margin:4px 15px 0 0">';
      }

     
	  $html = '<div id="content">
                  <div id="bodyContent" style="width:320px; max-height:300px; overflow-y:auto">
                    
                  
					 <h4>'.$result['nama'].'</h4>
					 <table class="table"> 
										<tbody> 
											<tr> 
												<td rowspan="5" width="100px">'.$img.'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Ketua</b> : '.$result['ketua'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>No. Telp</b> : '.$result['no_telp'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Email</b> : '.$result['email'].'</td> 
											</tr>
											<tr> 
												<td style="font-size: 9pt;text-align:left"> <b>Alamat</b> : '.$result['alamat'].'</td> 
											</tr>
											<tr> 
												<td colspan="2">
												<table border="1" style="width:100%">
													<tr>
													   <td>KK</td>
													   <td>Jiwa</td>
													</tr>
													<tr>
													   <td><b>'.$result['jumlah_kk'].'</b></td>
													   <td><b>'.$result['jumlah_jiwa'].'</b></td>
													</tr>
												 </table>
												 </td> 
											</tr>
										</tbody> 
										
									</table>
									<center><a href="'.base_url('web/detail_jemaat/'.$result['id_jemaat'].'').'"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <b>Detail Selengkapnya</b></a></center>
                  </div>
               </div>';
      echo $html;
   }
}