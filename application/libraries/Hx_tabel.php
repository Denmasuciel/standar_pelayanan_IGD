<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Library HX (Komponens)
 *
 * dibuat oleh hendra sabuna (hendra1602@gmail.com)
 * versi 1.0 -> juli 2014
 * versi 2.0 -> mei 2015
 * versi 3.0 -> juni 2015
 * versi 4.0 -> agustus 2015
 * versi 5.0 (dipisah tabel, form, view) -> november 2015
 *
 * PERHATIAN!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * library ini bukan open source
 * jika anda ingin menggunakan, silahkan izin dulu sama yang punya
 * biasakan menghargai karya orang lain
 */

class Hx_tabel {

   private $CI;

   private $tabel_cls = 'table table-bordered table-striped table-hover';
   private $tabel_id  = 'tabel-data';

   public function set_head($aksi=array(),$arr_field)
   {
      $tabel  = '<tr>
                     <th style="width:40px" class="text-center">#</th>';

                     foreach ($arr_field as $index=>$list) {
                        $tabel .= '<th class="text-center">'.$list['label'].'</th>';
                     }

      if ($aksi) {
         $tabel .= ' <th colspan="'.count($aksi).'" class="text-center">Pilihan</th>';
      }

      $tabel .= '</tr>';

      return $tabel;
   }

   public function set_aksi($aksi,$id)
   {
      $tabel = '';

      //---------> aksi tabel
      foreach ($aksi as $index=>$a):

         $tabel .= '<td class="aksi">';

         if ($index=='view') {
            $tabel .= '<a href="'.site_url($a.'/'.$id).'" class="tip" title="Lihat Detail Data">
                         <i class="fa fa-search fa-lg text-primary"></i>
                       </a>';
         }
         else if ($index=='edit') {
            $tabel .= '<a href="'.site_url($a.'/'.$id).'" class="tip btn-aksi" title="Edit Data">
                         <i class="fa fa-pencil fa-lg text-warning"></i>
                       </a>';
         }
         else if ($index=='hapus') {
            $tabel .= '<a href="#modal_konf_hapus" url="'.site_url($a.'/'.$id).'" class="tip tombol-hapus" title="Hapus Data" data-toggle="modal">
                         <i class="fa fa-times fa-lg text-danger"></i>
                       </a>';
         }
         else {
            $tabel .= '<a href="'.site_url($a['url'].'/'.$id).'" class="tip '.$a['class'].'" title="'.$a['judul'].'">
                         <i class="fa fa-'.$a['icon'].' fa-lg text-'.$a['warna'].'"></i>
                       </a>';
         }

         $tabel .= '</td>';

      endforeach;

      return $tabel;
   }

   public function set_tabel($arr,$arr_field,$result,$aksi=array())
   {
      $tabel_class = (isset($arr['tabel_class'])) ? $arr['tabel_class'] : $this->tabel_cls;
      $tabel_id    = (isset($arr['tabel_id']))    ? $arr['tabel_id']    : $this->tabel_id;

      $tabel  = '<table id="'.$tabel_id.'" class="'.$tabel_class.'">';

      //set heading tabel

      if (isset($arr['head_tabel'])) {
         $tabel .= $arr['head_tabel'];
      }
      else {
         $tabel .= $this->set_head($aksi,$arr_field);
      }

      //--------> body tabel
      $tabel .= '  <tbody>';

      //nomor tabel
      $no = ($arr['nomor_hal']) ? $arr['nomor_hal'] : 1;

      //---------> looping data
      foreach ($result as $list):
         $tabel .= '<tr>';
         $tabel .= '  <td class="text-center">'.$no.'.</td>';

         //---------> looping kolom
         foreach ($arr_field as $index=>$k):

            switch ($k['tipe']):

               case 'foto':
                  $tabel .= '<td class="text-center" style="width:'.$k['lebar'].'">';

                  if ($list[$index]) {
                     $tabel .= '<div class="foto-tabel">
                                   <img src="'.base_url($k['path_file'].'/'.$list[$index]).'">
                                   <div class="tombol-foto-tabel">
                                      <a href="'.site_url($k['upload'].'/'.$list[$arr['kunci']].'/'.$index.'/'.$list[$index]).'" class="btn btn-xs btn-default tip btn-aksi" title="Ganti Foto">
                                        <i class="fa fa-pencil fa-lg text-warning"></i>
                                      </a>
                                   </div>
                                </div>';
                  }
                  else {
                     $tabel .= '<a href="'.site_url($k['upload'].'/'.$list[$arr['kunci']].'/'.$index).'" class="tip btn-aksi" title="Tambah File '.ucwords(str_replace('_',' ',$index)).'">
                                  <i class="fa fa-photo fa-lg text-primary"></i>
                                </a>';
                  }

                  $tabel .= '</td>';
               break;

               case 'multi_foto':
                  $tabel .= '<td class="text-center" style="width:'.$k['lebar'].'">';

                  if ($list[$index]) {
                     $tabel .= '<div class="foto-tabel">
                                   <img src="'.base_url($k['path_file'].'/'.$list[$index]).'">
                                   <div class="tombol-foto-tabel">
                                      <a href="'.site_url($k['kelola'].'/'.$list[$arr['kunci']]).'" class="btn btn-xs btn-default tip btn-aksi" title="Kelola Galeri '.ucwords(str_replace('_',' ',$index)).'">
                                        <i class="fa fa-photo fa-lg text-primary"></i>
                                      </a>
                                   </div>
                                </div>';
                  }
                  else {
                     $tabel .= '<a href="'.site_url($k['kelola'].'/'.$list[$arr['kunci']]).'" class="tip btn-aksi" title="Kelola Galeri '.ucwords(str_replace('_',' ',$index)).'">
                                  <i class="fa fa-photo fa-2x text-primary"></i>
                                </a>';
                  }

                  $tabel .= '</td>';
               break;

               case 'file':
                  $tabel .= '<td class="text-center">';

                  if ($list[$index]) {
                     $tipe_file = (substr($list[$index],-3)=='jpg' OR substr($list[$index],-3)=='png') ? 'foto-pop' : '';
                     $tabel .= '<a href="'.base_url($k['path_file'].'/'.$list[$index]).'" class="btn btn-default btn-xs tip '.$tipe_file.'" title="Buka File" target="_blank">
                                  <i class="fa fa-download text-primary"></i>
                                </a>
                                <a href="#modal_konf_file" data-toggle="modal" class="btn btn-danger btn-xs tombol-hapus-file tip" title="Hapus File" url="'.site_url($k['url_del'].'/'.$list[$arr['kunci']].'/'.$index.'/'.$list[$index]).'?path_file='.$k['path_file'].'">
                                  <i class="fa fa-remove"></i>
                                </a>';
                  }
                  else {
                     $tabel .= '<a href="'.site_url($k['upload'].'/'.$list[$arr['kunci']].'/'.$index).'" class="tip btn-aksi" title="Tambah File '.ucwords(str_replace('_',' ',$index)).'">
                                  <i class="fa fa-files-o fa-lg text-primary"></i>
                                </a>';
                  }

                  $tabel .= '</td>';
               break;

               case 'multi_file':
                  $tabel .= '<td class="text-center">';

                  if ($list[$index]!='0') {
                     $tabel .= '<a href="'.site_url($k['kelola'].'/'.$list[$arr['kunci']]).'" class="btn btn-xs btn-default tip btn-aksi" title="Kelola '.$k['label'].'">
                                  <i class="fa fa-paperclip fa-lg"></i> <code>'.$list[$index].' file</code>
                                </a>';
                  }
                  else {
                     $tabel .= '<a href="'.site_url($k['kelola'].'/'.$list[$arr['kunci']]).'" class="btn btn-default btn-xs tip btn-aksi" title="Kelola '.$k['label'].'">
                                  <i class="fa fa-paperclip text-primary"></i>
                                </a>';
                  }

                  $tabel .= '</td>';
               break;

               case 'status':
                  $class = $k['pilihan'][$list[$index]]['class'];
                  $label = $k['pilihan'][$list[$index]]['label'];

                  unset($k['pilihan'][$list[$index]]);

                  $status = key($k['pilihan']);

                  $warna = array('btn-primary'=>'success','btn-default'=>'abu');

                  $tabel .= '<td class="text-center">
                               <a href="'.site_url($k['url_status'].'/'.$list[$arr['kunci']].'/'.$index.'/'.$status).'" class="tip btn-progress" title="'.$label.'">
                                 <i class="fa fa-check-circle fa-lg text-'.$warna[$class].'"></i>
                               </a>
                             </td>';
               break;

               case 'label':
                  $tabel .= '<td class="text-center"><span class="label label-'.$k['warna'][$list[$index]].'" style="font-size:13px;">'.ucwords($list[$index]).'</span></td>';
               break;

               case 'array':
                  $tabel .= '<td>'.$k['list'][$list[$index]].'</td>';
               break;

               case 'checkbox':
                  $tabel .= '<td>'.ucwords(str_replace(',',', ',$list[$index])).'</td>';
               break;

               case 'tanggal':
                  $format = (isset($k['format'])) ? $k['format'] : null;
                  $tabel .= '<td>'.hx_tgl($list[$index],$format).'</td>';
               break;

               case 'umur':
                  $tabel .= '<td>'.hx_umur($list[$k['field']],'hari').'</td>';
               break;

               case 'rupiah':
                  $tabel .= '<td>Rp. '.hx_rupiah($list[$index]).'</td>';
               break;

               case 'ribuan':
                  $tabel .= '<td class="text-center">'.hx_rupiah($list[$index]).'</td>';
               break;

               case 'angka':
                  $prefix = (isset($k['prefix'])) ? ' '.$k['prefix'] : '';
                  $vals   = ($list[$index]=='0') ? '-' : $list[$index].$prefix;
                  $tabel .= '<td class="text-center">'.$vals.'</td>';
               break;

               case 'text':
                  $tabel .= '<td>'.$list[$index].'</td>';
               break;

               case 'html':
                  $pjg  = (isset($k['karakter'])) ? $k['karakter'] : 150;
                  $html = (strlen(strip_tags($list[$index])) >= $pjg) ? substr(strip_tags($list[$index]),0,$pjg).' [...]' : $list[$index];
                  $tabel .= '<td>'.$html.'</td>';
               break;

               default:
                  $tabel .= '<td>'.$list[$index].'</td>';
               break;

            endswitch;

         endforeach;

         // ---------> set aksi tabel
         if ($aksi) {
            $tabel .= $this->set_aksi($aksi,$list[$arr['kunci']]);
         }

         $tabel .= '</tr>';
         $no++;
      endforeach;

      $tabel .= '  </tbody>
                 </table>';

      if (isset($arr['js_hapus'])) :

      $tabel .= '';

      else :

      $tabel .= '<div id="modal_konf_hapus" class="modal">
                     <div class="modal-dialog">
                        <div class="modal-content modal_konf_hapus">
                           <div class="modal-body text-center">
                              <i class="fa fa-warning fa-5x"></i>
                              <h4><b>HAPUS DATA</b></h4>
                              <p>Apakah anda yakin akan menghapus data ini?</p>
                           </div>
                           <div class="modal-footer">
                              <a id="link-hapus" class="btn btn-primary btn-progress"><i class="fa fa-check fa-fw"></i> HAPUS</a>
                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> BATAL</button>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div id="modal_konf_file" class="modal">
                     <div class="modal-dialog">
                        <div class="modal-content modal_konf_hapus">
                           <div class="modal-body text-center">
                              <i class="fa fa-warning fa-5x"></i>
                              <h4><b>HAPUS FILE</b></h4>
                              <p>Apakah anda yakin akan menghapus file ini?</p>
                           </div>
                           <div class="modal-footer">
                              <a class="btn btn-primary link-hapus-file btn-progress"><i class="fa fa-check fa-fw"></i> HAPUS</a>
                              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-remove fa-fw"></i> BATAL</button>
                           </div>
                        </div>
                     </div>
                  </div>

                  <script type="text/javascript">
                  $(document).ready(function(){
                     $(".tombol-hapus").click(function(){
                        $("#link-hapus").attr("href",$(this).attr("url"));
                     });
                     $(".tombol-hapus-file").click(function(){
                        $(".link-hapus-file").attr("href",$(this).attr("url"));
                     });
                  });
                </script>';

      endif;

      return $tabel;
   }

   public function set_halaman($arr,$limit,$segmen=3)
   {
      $this->CI =& get_instance();

      $this->CI->load->library('pagination');

      $config['base_url']        = site_url().$arr['url_halaman'];
      $config['total_rows']      = $arr['jml_data'];
      $config['per_page']        = $limit;
      $config['uri_segment']     = $segmen;
      $config['num_links']       = 2;

      $config['first_link']      = '<i class="fa fa-fast-backward" title="Awal"></i>';
      $config['prev_link']       = '<i class="fa fa-step-backward fa-fw" title="Sebelumnya"></i>';
      $config['next_link']       = '<i class="fa fa-step-forward fa-fw" title="Berikutnya"></i>';
      $config['last_link']       = '<i class="fa fa-fast-forward" title="Akhir"></i>';

      $config['first_tag_open']  = '<li>';
      $config['first_tag_close'] = '</li>';

      $config['last_tag_open']   = '<li>';
      $config['last_tag_close']  = '</li>';

      $config['next_tag_open']   = '<li>';
      $config['next_tag_close']  = '</li>';

      $config['prev_tag_open']   = '<li>';
      $config['prev_tag_close']  = '</li>';

      $config['num_tag_open']    = '<li>';
      $config['num_tag_close']   = '</li>';

      $config['cur_tag_open']    = '<li class="active"><a>';
      $config['cur_tag_close']   = '</a></li>';

      $config['reuse_query_string'] = TRUE;

      $this->CI->pagination->initialize($config);

      $paging = $this->CI->pagination->create_links();
      $info   = ($arr['jml_data'] > 0) ? '<span>Menampilkan <b>'.$arr['jml_a'].'</b> - <b>'.$arr['jml_b'].'</b> dari total <b>'.$arr['jml_data'].'</b> Data</span>' : '<span>Data tidak ditemukan!</span>';

      $return = array('page'=>$paging,
                      'info'=>$info);

      return $return;
   }

   public function set_pencarian($arr,$field,$get=null)
   {
      $method = (isset($arr['method'])) ? $arr['method'] : 'get';

      $form  = '<form action="'.site_url($arr['aksi']).'" method="'.$method.'" class="form-inline">';

      foreach ($field as $index=>$list) {

         $style = ($list['value']) ? 'border-color:#1AB394' : '';
         $attr  = (isset($list['attr'])) ? $list['attr'] : '';

         $form .= '<div class="form-group" style="margin-right:10px">';

            if ($list['tipe']=='select') {
               $form .= '<select name="'.$index.'" class="form-control" '.$attr.' style="'.$style.'">';
               $form .= '   <option value="">- '.$list['label'].' -</option>';

                  foreach ($list['list'] as $_index=>$_item):
                     $_selected = (isset($list['value']) && $list['value']==$_index) ? 'selected' : '';
                     $form .= '<option value="'.$_index.'" '.$_selected.'>'.$_item.'</option>';
                  endforeach;

               $form .= '</select>';
            }
            else {
               $form .= '<input type="text" name="'.$index.'" value="'.$list['value'].'" class="form-control" placeholder="'.$list['label'].'" '.$attr.' style="'.$style.'">';
            }

         $form .= '</div>';
      }

      $reset = '';

      if ($get) {
         $reset = '<a href="'.site_url($arr['aksi']).'" class="btn btn-warning btn-sm tip" title="Reset Pencarian"><i class="fa fa-refresh fa-lg fa-fw"></i> Reset</a>';
      }

      $form .= '  <div class="input-group">
                     <span class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-sm tip" title="Proses Pencarian"><i class="fa fa-search fa-fw fa-lg"></i> Cari</button>
                        '.$reset.'
                     </span>
                  </div>
               </form>';

      return $form;
   }

   /*public function konversi($waktu)
   {
      $this->CI =& get_instance();
      $this->CI->load->helper('date');

      $haris = array("Sunday"=>"Minggu",
                     "Monday"=>"Senin",
                     "Tuesday"=>"Selasa",
                     "Wednesday"=>"Rabu",
                     "Thursday"=>"Kamis",
                     "Friday"=>"Jumat",
                     "Saturday"=>"Sabtu");

      $bulan = array("January"=>"Januari",
                     "February"=>"Februari",
                     "March"=>"Maret",
                     "April"=>"April",
                     "May"=>"Mei",
                     "June"=>"Juni",
                     "July"=>"Juli",
                     "August"=>"Agustus",
                     "September"=>"September",
                     "October"=>"Oktober",
                     "November"=>"November",
                     "December"=>"Desember");

      $timestamp = human_to_unix($waktu);

      if(empty($timestamp) || !is_numeric($timestamp)) {
         return '';
      }

      $hari  = date('l',$timestamp);
      $tgl   = date('d',$timestamp);
      $bln   = date('F',$timestamp);
      $thn   = date('Y',$timestamp);
      $pukul = date('H:i',$timestamp);

      $timespan = strtolower(timespan($timestamp));
      $timespan = str_replace(',','',$timespan);
      $exp = explode(' ',$timespan);
      $k = $exp[1];
      $v = $exp[0];

      if($v > 0)
      {
         if (stristr($k,'year') OR date('Y') > $thn)
         {
            $b = $bulan[$bln];
            return $tgl.' '.$b.' '.$thn;
         }
         elseif (stristr($k,'week') OR stristr($k,'month'))
         {
            $b = $bulan[$bln];
            return $tgl.' '.$b.' pukul '.$pukul;
         }
         elseif (stristr($k,'day') OR stristr($k,'hour') OR stristr($k,'minute') OR stristr($k,'second'))
         {
            if ($v >= 2 AND stristr($k,'day'))
            {
               $h = $haris[$hari];
               return $h.' pukul '.$pukul;
            }
            elseif (date('j') - date('j', $timestamp) == 1)
            {
               return 'Kemarin pukul '.$pukul;
            }
            elseif ((date('D') == date('D', $timestamp)) AND (($v >= 10) AND stristr($k,'hour')))
            {
               return 'Hari ini pukul '.$pukul;
            }
            elseif ((stristr($k,'hour') AND $v < 10) OR stristr($k,'minute') OR stristr($k,'second'))
            {
               if (stristr($k,'second') AND $v <= 10)
               {
                  return 'baru saja';
               }

               if ($k=='seconds') $wkt='detik';
               else if ($k=='minutes' OR $k=='minute') $wkt='menit';
               else if ($k=='hours' OR $k=='hour') $wkt='jam';

               return $v.' '.$wkt.' yang lalu';
            }
            else
            {
               $h = $haris[$hari];
               return $h.' pukul '.$pukul;
            }
         }
      }
      else
      {
         return 'baru saja';
      }
   }*/
}