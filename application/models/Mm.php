<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mm extends CI_Model
{

   function __construct()
   {
      parent::__construct();
      $this->db3 = $this->load->database('db_rsudw', TRUE);
   }

   function get($table, $data = array(), $returnformat = 'rear')
   {
      $this->db->from($table);

      if (isset($data['select'])) $this->db->select($data['select'], FALSE);

      if (isset($data['join'])) {
         foreach ($data['join'] as $list) {
            $list[2] = isset($list[2]) ? $list[2] : '';
            $this->db->join($list[0], $list[1], $list[2]);
         }
      }

      if (isset($data['where'])) $this->db->where($data['where']);

      if (isset($data['or_where'])) {
         foreach ($data['or_where'] as $key => $val) {
            $this->db->or_where($key, $val);
         }
      }

      if (isset($data['like'])) {
         foreach ($data['like'] as $list) {
            $list[2] = isset($list[2]) ? $list[2] : '';
            $this->db->like($list[0], $list[1], $list[2]);
         }
      }

      if (isset($data['or_like'])) {
         foreach ($data['or_like'] as $list) {
            $list[2] = isset($list[2]) ? $list[2] : '';
            $this->db->or_like($list[0], $list[1], $list[2]);
         }
      }

      if (isset($data['limit'])) {
         $offset = (isset($data['offset'])) ? $data['offset'] : null;
         $this->db->limit($data['limit'], $offset);
      }

      if (isset($data['order'])) {
         $this->db->order_by($data['order']);
      }

      if (isset($data['group'])) {
         $this->db->group_by($data['group']);
      }

      if (isset($data['having'])) {
         $this->db->having($data['having']);
      }

      $query = $this->db->get();

      switch ($returnformat) {
         case 'rear':
            return $query->result_array();
            break;
         case 'roar':
            return $query->row_array();
            break;
      }
   }

   function count($table, $data = array())
   {
      $this->db->from($table);

      if (isset($data['join'])) {
         foreach ($data['join'] as $list) {
            $list[2] = isset($list[2]) ? $list[2] : '';
            $this->db->join($list[0], $list[1], $list[2]);
         }
      }

      if (isset($data['where'])) $this->db->where($data['where']);

      if (isset($data['or_where'])) {
         foreach ($data['or_where'] as $key => $val) {
            $this->db->or_where($key, $val);
         }
      }

      if (isset($data['like'])) {
         foreach ($data['like'] as $list) {
            $list[2] = isset($list[2]) ? $list[2] : '';
            $this->db->like($list[0], $list[1], $list[2]);
         }
      }

      if (isset($data['or_like'])) {
         foreach ($data['or_like'] as $list) {
            $list[2] = isset($list[2]) ? $list[2] : '';
            $this->db->or_like($list[0], $list[1], $list[2]);
         }
      }

      if (isset($data['group_by'])) {
         $this->db->group_by($data['group_by']);
      }

      return $this->db->count_all_results();
   }

   function save($tabel, $data, $where = null)
   {
      if ($where) {
         $this->db->where($where);

         if ($this->db->update($tabel, $data)) {
            return TRUE;
         } else {
            return FALSE;
         }
      } else {
         if ($this->db->insert($tabel, $data)) {
            return $this->db->insert_id();
         } else {
            return FALSE;
         }
      }
   }

   function save_batch($tabel, $data, $where = array())
   {
      if ($where) {
         $this->db->where($where);
         if ($this->db->delete($tabel)) {
            if ($this->db->insert_batch($tabel, $data)) {
               return TRUE;
            } else {
               return FALSE;
            }
         } else {
            return FALSE;
         }
      } else {
         if ($this->db->insert_batch($tabel, $data)) {
            return TRUE;
         } else {
            return FALSE;
         }
      }
   }

   function delete($tabel, $where = null)
   {
      if ($where) $this->db->where($where);

      if ($this->db->delete($tabel)) {
         return TRUE;
      } else {
         return FALSE;
      }
   }

   function query($sql, $returnformat = null)
   {
      $query = $this->db->query($sql);

      if ($returnformat) {
         switch ($returnformat) {
            case 'rear':
               return $query->result_array();
               break;
            case 'roar':
               return $query->row_array();
               break;
         }
      }
   }

   function tahun($a = null, $b = null)
   {
      $a = ($a) ? $a : (date('Y') - 5);
      $b = ($b) ? $b : date('Y');

      for ($i = $a; $i <= $b; $i++) {
         $tahun[$i] = $i;
      }

      return $tahun;
   }

   function bulan()
   {
      $bulan['01'] = 'Januari';
      $bulan['02'] = 'Februari';
      $bulan['03'] = 'Maret';
      $bulan['04'] = 'April';
      $bulan['05'] = 'Mei';
      $bulan['06'] = 'Juni';
      $bulan['07'] = 'Juli';
      $bulan['08'] = 'Agustus';
      $bulan['09'] = 'September';
      $bulan['10'] = 'Oktober';
      $bulan['11'] = 'November';
      $bulan['12'] = 'Desember';

      return $bulan;
   }


   function generate_a()
   {
      $date = date('Y-m-d');
      $q = $this->db->query("select MAX(only_nomor_antrian) as struk from antrian where tanggal = '$date' and loket= 'A' AND status_reset='t'");
      $kd = "";
      if ($q->num_rows() > 0) {
         foreach ($q->result() as $k) {
            $tmp = ((int)$k->struk) + 1;
            $kd = $tmp;
         }
      } else {
         $kd = "1";
      }
      return $kd;
   }

   function generate_b()
   {
      $date = date('Y-m-d');
      $q = $this->db->query("select MAX(only_nomor_antrian) as struk from antrian where tanggal = '$date' and loket= 'B' AND status_reset='t'");
      $kd = "";
      if ($q->num_rows() > 0) {
         foreach ($q->result() as $k) {
            $tmp = ((int)$k->struk) + 1;
            $kd = $tmp;
         }
      } else {
         $kd = "1";
      }
      return "B." . $kd;
   }

   function querySQLSRV($sql, $returnformat = null)
   {
      $query = $this->db3->query($sql);

      if ($returnformat) {
         switch ($returnformat) {
            case 'rear':
               return $query->result_array();
               break;
            case 'roar':
               return $query->row_array();
               break;
         }
      }
   }

   function ambildata()
   {
      $result = array();
      $row = array();
      $sqlquery = "select A.*,b.aam_diagnosa_primer,format(GETDATE(),'dd-MM-yyyy HH:mm:ss') as sekarang,DATEDIFF(MINUTE, a.datetime_in, GETDATE()) as jam
      from
      (SELECT px.no_rm,px.pasien_nm,px.address,a.medical_cd,a.datetime_in,format(a.datetime_in,'dd-MM-yyyy') as tgl_masuk,FORMAT(a.datetime_in, 'HH:mm:ss') as jam_masuk
      from trx_medical a
      join trx_pasien px on a.pasien_cd=px.pasien_cd
      where a.medical_trx_st='MEDICAL_TRX_ST_0' and a.medunit_cd='POLIUGD' and 
      CONVERT(DATE,a.datetime_in) >= DATEADD(DAY, -1, convert(date,GETDATE())) and CONVERT(DATE,a.datetime_in)  <= convert(date,GETDATE())) A
      left JOIN OPENQUERY(" . "ubuntu7" . ",'SELECT a.medical_cd ,b.aam_diagnosa_primer
      from tx_transaction a
      LEFT JOIN tx_pengkajian_awalmedis b on a.id_transaction=b.kam_id_trx
      where a.medunit_cd= ''POLIUGD'' and date(a.datetime_trx) >= DATE_SUB(date(now()),INTERVAL 1 DAY) and date(a.datetime_trx)<= date(now())') B on a.medical_cd=b.medical_cd
      order by A.datetime_in";
      $criteria =$this->db3->query($sqlquery)->result_array();
      $no = 1;
      foreach ($criteria as $data) {
         //  $btn = "<a href='#' class='btn btn-warning btn-xs fa fa-edit (alias)' onclick='edit_kantor(" . $data['medical_cd'] . ")' title='Edit'></a>&nbsp;
         //     <a href='#' class='btn btn-danger btn-xs fa fa-cut (alias)' onclick='delete_kantor(" . $data['medical_cd'] . ")' title='Hapus'></a>
         //     ";

          $row[] = array(
              'no' => $no++,
              'no_rm' => $data['no_rm'],
              'pasien_nm' => $data['pasien_nm'],
              'address' => $data['address'],
              'medical_cd' => $data['medical_cd'],
              'datetime_in' => $data['datetime_in'],
              'tgl_masuk' => $data['tgl_masuk'],
              'jam_masuk' => $data['jam_masuk'],
              'aam_diagnosa_primer' => $data['aam_diagnosa_primer'],
              'sekarang' => $data['sekarang'],
              'jam' => $data['jam']
          );
      }
      $result = array('aaData' => $row);
      echo  json_encode($result);

   }
}
