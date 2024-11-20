<style>
table {
    border-collapse: collapse;
	width:100%;
}

table, th, td {
    border: 1px solid black;
	padding : 3px;
}

th {
	background-color:#eee;
}
</style>
<?php
if($gol == 'w'){ $per = 'WILAYAH';};
if($gol == 'k'){ $per = 'KLASIS';};
if($gol == 'j'){ $per = 'JEMAAT';};

?>
<center>
	<b>REKAP PENERIMAAN PER<?php echo $per;?></b><p/>
	<b>Tahun <?php echo date('Y');?> </b>
</center>
<hr/>
<?php $level = $this->session->sess_user['level'];
	  $akses = $this->session->sess_user['id_akses'];

	  if($gol == 'w'){ 
		  if ($level == 'operator_w') {
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan hanya untuk Wilayah "'.$this->session->sess_user['nama_akses'].'"</small>';
		  }elseif($level == 'admin'){
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan untuk semua Wilayah</small>';  
		  }
	  };
	  if($gol == 'k'){
		  if ($level == 'operator_w') {
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan hanya untuk Klasis dari wilayah "'.$this->session->sess_user['nama_akses'].'"</small>';
		  }elseif($level == 'operator_k'){
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan hanya untuk Klasis "'.$this->session->sess_user['nama_akses'].'"</small>';  
		  }elseif($level == 'admin'){
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan untuk semua Klasis dari semua wilayah</small>';  
		  }
		
	  };
	  if($gol == 'j'){
		   if ($level == 'operator_w') {
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan hanya untuk Jemaat dari wilayah "'.$this->session->sess_user['nama_akses'].'"</small>';
		  }elseif($level == 'operator_k'){
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan hanya untuk Jemaat dari klasis "'.$this->session->sess_user['nama_akses'].'"</small>';  
		  }elseif($level == 'operator_j'){
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan hanya untuk Jemaat "'.$this->session->sess_user['nama_akses'].'"</small>';  
		  }elseif($level == 'admin'){
		   echo '<small><b>Keterangan : </b>Rekap Penerimaan untuk semua Jemaat dari semua Klasis dan Wilayah</small>';  
		  }

	  };

	  
	 
	  
?>

        <table>
			
				<tr>
                  <th class="text-center">#</th>
				  <th class="text-center">Nama</th>
				  <th class="text-center">2015</th>
				  <th class="text-center">2016</th>
				</tr>  
			
			 
			  <?php if(@$_data&&$_data!=null){
				  $no=0;
                  foreach($_data as $row){$no++;
				  if($gol == 'w'){ $id = $row['id_wilayah'];};
				  if($gol == 'k'){ $id = $row['id_klasis'];};
				  if($gol == 'j'){ $id = $row['id_jemaat'];};?>
			   <tr>
				  <td class="text-center"><?php echo $no; ?></td>
				  <td class="text-center"><?php echo $row['nama'];?></td>
				  <td class="text-center"><?php echo 'Rp '.hx_rupiah($penerimaan_lalu[$id]); ?><</td>
				  <td class="text-center"><?php echo 'Rp '.hx_rupiah($penerimaan_baru[$id]); ?></td>
			  </tr>
			  <?php }}else{}?>
		
        </table>
		<small>dicetak pada <?php echo date('d-m-Y');?></small>
