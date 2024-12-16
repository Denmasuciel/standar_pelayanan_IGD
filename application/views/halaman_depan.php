<style>
	a {
		color: #000;
	}
</style>
<!-- copy sini -->
<div class="panel panel-default" style="padding:20px;background-color:#313538;border-radius: 6px;">
	<!-- <div id="logout" style="position:absolute;float: right;background-color:#1a8e0f;border-radius: 5px;padding:5px;font-size:12pt"><a href="<?= site_url('admin/login_loket/logout') ?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> <b>Logout<b></a></div> -->
	<!-- <div class="text-center" style="color:grey;border-bottom: 1px solid #585757;padding:5px">
		<b style="font-size:15pt">Antrian Loket <?= $gdata; ?></b>
	</div> -->
	<div class="row">
		<!-- <div class="col-xs-4">
			<div class="text-center">
				<b style="font-size:10pt;color:grey">Nomor Antrian yang sedang dipanggil</b>
				<p>
			</div>
			<div class="text-center" style="border: 1.5px solid #6b6666; margin: auto;border-radius: 2px;background-color:#545353">
				<div id="antrian_aktif_a"></div>
			</div>
			<div class="text-center" style="padding-top:10px">
				<?php if (@$status_loket == '1') {
					$sts = "Buka"; ?>
					<button type="button" name="close" id="aclose" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Tutup &nbsp; &nbsp; &nbsp; &nbsp;</button>
				<?php } else {
					$sts = "Tutup"; ?>
					<button type="button" name="close" id="aclose" class="btn btn-success"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Buka &nbsp; &nbsp; &nbsp; &nbsp;</button>
				<?php } ?>
				<button type="button" name="playx" onclick="mulai();" class="btn btn-success"><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span> Panggil &nbsp; &nbsp; &nbsp; &nbsp; </button>
				<a href="<?= base_url() ?>loket/selanjutnya_a" id="selanjutnya" class="btn btn-success"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Selanjutnya</a>
			</div>
			<div style="padding-top:10px;color:grey" class>
				<div class="row">
					<div class="col-md-5">
						Nomor Loket
					</div>
					<div class="col-md-5">
						: <b style="color:yellow"><?php echo @$sess; ?></b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						Status Loket
					</div>
					<div class="col-md-5">
						: <b style="color:yellow"><?php echo $sts; ?></b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						Belum di Panggil
					</div>
					<div class="col-md-5">
						: <b style="color:yellow" id="sisa_a"><?php echo @$jml_blm; ?></b>
					</div>
				</div>
			</div>
		</div> -->

		<div class="col-xs-12 text-center">
			<div class="text-center" style="color:grey">
				<b style="font-size:10pt">DAFTAR PASIEN IGD</b>
			</div>
			<div class="text-center" style="border: 1.5px solid #6b6666;border-radius: 2px;background-color:#545353;padding:5px;margin-top:5px">
				<table id="a" class="table table-bordered" cellspacing="0" width="100%" style="background-color:white">
					<thead>
						<tr>
							<!-- <th>No</th> -->
							<th width="8%">No RM</th>
							<th width="15%">Nama</th>
							<th width="20%">Alamat</th>
							<th width="10%">Tangal Masuk</th>
							<th width="10%">Jam Masuk</th>
							<th width="32%">Diagnosa</th>
							<th width="5%">Waktu</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- smapi sini -->

<script type="text/javascript">
	$(document).ready(function() {
		$(".tombol-hapus").click(function() {
			$("#link-hapus").attr("href", $(this).attr("url"));
		});
		$(".tombol-hapus-file").click(function() {
			$(".link-hapus-file").attr("href", $(this).attr("url"));
		});
	});
</script>
<script>
	var save_method; //for save method string
	var table;

	var myApp = myApp || {};
	$(document).ready(function() {
		// myApp.oTable = $('#a').dataTable({
		// 	"bProcessing": true,
		// 	"bServerSide": true,
		// 	"pageLength": 25,
		// 	"bFilter": false,
		// 	"bLengthChange": false,
		// 	"aoColumnDefs": [{
		// 		"bSortable": false,
		// 		"aTargets": [1, 2],
		// 		"aaSorting": [
		// 			[2, "desc"]
		// 		],
		// 		"targets": [0],
		// 		"visible": false
		// 	}],
		// 	'sPaginationType': 'full_numbers',
		// 	"sAjaxSource": "<?php echo base_url('layar_loket/dataTable_a') ?>"
		// });


		// myApp.polling = setInterval('myApp.oTable.fnDraw(false)', 5000);

		tampildata();
		setInterval(function() {
			reload_table();
		}, 120000);
	});

	function tampildata() {
		// $('#a').dataTable().fnDestroy();
		$('#a').dataTable({
			"bProcessing": true,
			// "scrollY": 350,
			"pageLength": 50,
			"scrollCollapse": true,
			"bServerside": true,
			"bLengthChange": false,
			"bFilter": false,
			"sAjaxSource": "<?php echo base_url('pertama/jsonlistdata') ?>",
			"columns": [{
					"data": "no_rm"
				},
				{
					"data": "pasien_nm"
				},
				{
					"data": "address"
				},
				{
					"data": "tgl_masuk"
				},
				{
					"data": "jam_masuk"
				},
				{
					"data": "aam_diagnosa_primer",
					// className: "text-center"
				},
				{
					"data": "jam",
					// className: "text-center"
				}
			],
			"aoColumnDefs": [{
				"targets": [6],
				"visible": false,
			}],
			"order": [
				[6, "desc"]
			],
			"rowCallback": function(row, data, index) {
				// Assuming the score is in the second column (index 1)
				var score = parseInt(data.jam);

				if (score >= 0 && score <= 5) {
					$(row).addClass('low-score');
				} else if (score >= 6 && score <= 120) {
					$(row).addClass('lowmid-score');
				} else if (score >= 121 && score <= 359) {
					$(row).addClass('medium-score');
				} else {
					$(row).addClass('high-score');
				}
			}
		});
	};

	function reload_table() {
		$('#a').dataTable().fnDestroy();
		tampildata();
	}
</script>