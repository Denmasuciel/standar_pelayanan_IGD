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
	<b>REKAP ASSET PER<?php echo $per;?></b><p/>
	<b>Tahun <?php echo date('Y');?> </b>
</center>
<hr/>
<?php $level = $this->session->sess_user['level'];
	  $akses = $this->session->sess_user['id_akses'];

	  if($gol == 'w'){ 
		  if ($level == 'operator_w') {
		   echo '<small><b>Keterangan : </b>Rekap Asset hanya untuk Wilayah "'.$this->session->sess_user['nama_akses'].'"</small>';
		  }elseif($level == 'admin'){
		   echo '<small><b>Keterangan : </b>Rekap Asset untuk semua Wilayah</small>';  
		  }
	  };
	  if($gol == 'k'){
		  if ($level == 'operator_w') {
		   echo '<small><b>Keterangan : </b>Rekap Asset hanya untuk Klasis dari wilayah "'.$this->session->sess_user['nama_akses'].'"</small>';
		  }elseif($level == 'operator_k'){
		   echo '<small><b>Keterangan : </b>Rekap Asset hanya untuk Klasis "'.$this->session->sess_user['nama_akses'].'"</small>';  
		  }elseif($level == 'admin'){
		   echo '<small><b>Keterangan : </b>Rekap Asset untuk semua Klasis dari semua wilayah</small>';  
		  }
		
	  };
	  if($gol == 'j'){
		   if ($level == 'operator_w') {
		   echo '<small><b>Keterangan : </b>Rekap Asset hanya untuk Jemaat dari wilayah "'.$this->session->sess_user['nama_akses'].'"</small>';
		  }elseif($level == 'operator_k'){
		   echo '<small><b>Keterangan : </b>Rekap Asset hanya untuk Jemaat dari klasis "'.$this->session->sess_user['nama_akses'].'"</small>';  
		  }elseif($level == 'operator_j'){
		   echo '<small><b>Keterangan : </b>Rekap Asset hanya untuk Jemaat "'.$this->session->sess_user['nama_akses'].'"</small>';  
		  }elseif($level == 'admin'){
		   echo '<small><b>Keterangan : </b>Rekap Asset untuk semua Jemaat dari semua Klasis dan Wilayah</small>';  
		  }

	  };

	  
	 
	  
?>

        <table>
			
				<tr>
                     <th style="width:40px"  class="text-center" rowspan="2">#</th>
					 <th class="text-center" rowspan="2">Nama</th>
					 <th class="text-center" colspan="2">Tanah</th>
					 <th class="text-center" colspan="2">Bangunan</th>
		    </tr>
			<tr>
                     
					 <th class="text-center" width="15%"><?php echo date('Y')-1 ; ?></th>
					 <th class="text-center" width="15%"><?php echo date('Y') ; ?></th>
					 <th class="text-center" width="15%"><?php echo date('Y')-1 ; ?></th>
					 <th class="text-center" width="15%"><?php echo date('Y') ; ?></th>
		    </tr>			 
			
			 
			<?php if(@$_data&&$_data!=null){
					$no=0;
                      foreach($_data as $row){$no++;  
						  if($gol == 'w'){ $id = $row['id_wilayah'];};
						  if($gol == 'k'){ $id = $row['id_klasis'];};
						  if($gol == 'j'){ $id = $row['id_jemaat'];};?>
					  
			<tr>  
				<td class="text-center"><?php echo $no;?></td>
				<td><?php echo $row['nama'];?></td>
				<td><?php echo $asset_tanah_lama[$id];?></td>
				<td><?php echo $asset_tanah_baru[$id];?></td>
				<td><?php echo $asset_gedung_lama[$id];?></td>
				<td><?php echo $asset_gedung_baru[$id];?></td>
			</tr>
			<?php }}else{}?>
			
		
        </table>
		<small>dicetak pada <?php echo date('d-m-Y');?></small>
