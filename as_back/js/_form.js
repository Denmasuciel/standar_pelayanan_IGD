$(document).ready(function(){

   $('.alph').alpha({allow:".,-' "});
   $('.uspw').alphanumeric({nocaps:true});
   $('.num').numeric({allow:'.'});
   $('.alphnum').alphanumeric({allow:'- '});
   $('.telp').numeric({allow:'-()+'});

   $('.select_two').select2();

   $('.rupiah')
      .autoNumeric('init')
      .on('blur', function(e) {
         $('#form_input').formValidation('revalidateField','total');
   });

   $('.tgl')
      .datepicker({format: 'dd-mm-yyyy', autoclose: true, language: 'id'})
      .on('changeDate', function(e) {
         $('#form_input').formValidation('revalidateField','tanggal');
         $('#form_input').formValidation('revalidateField','tanggal_mulai');
         $('#form_input').formValidation('revalidateField','tanggal_selesai');
   });

   $('.jam').timepicker({defaultTime: false, minuteStep: 5, showInputs: false, showMeridian: false });

   $('.input-files').fileinput({
      showUpload:false,
      showPreview:false,
      previewFileType: "image",
   	browseClass: "btn btn-info btn-sm",
   	browseLabel: "Pilih File",
   	browseIcon: '<i class="fa fa-folder-open fa-fw"></i> ',
   	removeClass: "btn btn-primary btn-sm",
   	removeLabel: "Hapus",
   	removeIcon: '<i class="fa fa-remove fa-fw"></i> ',
   	uploadClass: "btn btn-info btn-sm",
   	uploadLabel: "Upload",
   	uploadIcon: '<i class="fa fa-upload fa-fw"></i> '
   });

   $('.editor-mini').summernote({
      toolbar: [
         ['style', ['']], // no style button
         ['style', ['bold', 'italic', 'underline', '']],
         ['fontsize', ['']],
         ['color', ['']],
         ['para', ['ul', 'ol', '']],
         ['height', ['']],
         ['insert', ['','','','']], // no insert buttons
         ['table', ['','','']], // no table button
         ['help', ['','','','','']] //no help button
      ]
   });

   $('.editor').summernote({
      toolbar: [
         ['style', ['style']], // no style button
         ['style', ['bold', 'italic', 'underline', '']],
         ['fontsize', ['']],
         ['color', ['']],
         ['para', ['ul', 'ol', 'paragraph']],
         ['height', ['']],
         ['insert', ['','','','']], // no insert buttons
         ['table', ['','','']], // no table button
         ['help', ['','','','','']] //no help button
      ]
   });

   $('[data-name="help"]').remove();

   $('.editor-full').summernote();

   $('.btn-aksi').click(function(e) {
      e.preventDefault();
      load_halaman_modal($(this).attr('href'));
   });

   function load_halaman_modal(url) {
      $("#load-animasi").fadeIn(200);

      setTimeout(function(){
         $("#modal-layout").load(url, function(){
            $("#load-animasi").fadeOut(300);
            $("#modal-layout").modal("show");
         });
      },400);
   }

   $('.btn-progress').click(function() {
      $('#load-animasi').fadeIn(200);
   });

   $('.hx_form_upload_file')
        .on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = data.element.data('fv.icon'),
                $label  = $parent.find('label');
            $icon.insertAfter($label);
        })
        .formValidation({
            framework: 'bootstrap',
            icon: {
               valid: 'fa fa-check-circle',
               invalid: 'fa fa-warning',
               validating: 'fa fa-spinner'
            },
            exclude: ':disabled',
            locale: 'id_ID'
        })
        .on('success.form.fv', function(e) {
            $("#load-animasi").fadeIn(200);
        });

   $('#form_input')
        .on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = data.element.data('fv.icon'),
                $label  = $parent.find('label');
            $icon.insertAfter($label);
        })
        .formValidation({
            framework: 'bootstrap',
            icon: {
               valid: 'fa fa-check-circle',
               invalid: 'fa fa-warning',
               validating: 'fa fa-spinner'
            },
            exclude: ':disabled',
            locale: 'id_ID'
        })
        .on('success.form.fv', function(e) {
            $("#load-animasi").fadeIn(200);
        });

   $('[benih="N"]').click(function(){
      $('#panjang').remove();
      $('#div-panjang').append('<input name="panjang" id="panjang" value="" class="form-control" type="text" />');
   });
   $('[benih="Y"]').click(function(){
      $('#panjang').remove();
      $('#div-panjang').append('<select name="panjang" id="panjang" class="form-control" onchange="pilih($(this).val())"><option value=""></option><option value="3-5 cm">3-5 cm</option><option value="5-7 cm">5-7 cm</option><option value="7-9 cm">7-9 cm</option><option value="Lainnya">Lainnya</option></select>');
   });
   $('#kelasgps').click(function(){
      $('#panjang').remove();
      $('#div-panjang').append('<input name="panjang" id="panjang" value="" class="form-control" type="text" />');
   });
   $('#kelasps').click(function(){
      $('#panjang').remove();
      $('#div-panjang').append('<input name="panjang" id="panjang" value="" class="form-control" type="text" />');
   });
   $('#kelasbenih').click(function(){
      $('#panjang').remove();
      $('#div-panjang').append('<select name="panjang" id="panjang" class="form-control" onchange="pilih($(this).val())"><option value=""></option><option value="3-5 cm">3-5 cm</option><option value="5-7 cm">5-7 cm</option><option value="7-9 cm">7-9 cm</option><option value="Lainnya">Lainnya</option></select>');
   });
   
   $("#level").change(function(){
    var id = $("#level").val();
   $.ajax({
       type: "POST",
       url : "../admin/user/pilih_role",
       data: "id="+id,
       success: function(list){
          $("#id_akses").html(list);
       }
    });
  });
  
   $("#tahun").change(function(){
						var tahun = $("#tahun").val();
						var id = $("#id_pelaporan").val();
						$.ajax({
						   type: "POST",
						   url : "../koperasi/get_data_kinerja",
						   data: "id="+id+"&tahun="+tahun,
						   success: function(data){
							   var kodes = JSON.parse(data);
                                       $("#volume_usaha").val(kodes.a);
                                       $("#total_aktiva").val(kodes.b);
                                       $("#modal_sendiri").val(kodes.c);
									   $("#hutang_lancar").val(kodes.d);
                                       $("#hutang_jk_panjang").val(kodes.e);
                                       $("#shu").val(kodes.f);
									   $("#jml_anggota").val(kodes.g);
									   $("#calon_anggota").val(kodes.h);
							
						   }
						});
					  });
					  
	 $("#tahun1").change(function(){
						var tahun = $("#tahun1").val();
						var id = $("#id_koperasi").val();
						$.ajax({
						   type: "POST",
						   url : "../koperasi/get_data_kinerja2",
						   data: "id="+id+"&tahun="+tahun,
						   success: function(data){
							   var kodes = JSON.parse(data);
                                       $("#volume_usaha").val(kodes.a);
                                       $("#total_aktiva").val(kodes.b);
                                       $("#modal_sendiri").val(kodes.c);
									   $("#hutang_lancar").val(kodes.d);
                                       $("#hutang_jk_panjang").val(kodes.e);
                                       $("#shu").val(kodes.f);
									   $("#jml_anggota").val(kodes.g);
									   $("#calon_anggota").val(kodes.h);
									   $("#id_pelaporan").val(kodes.i);
							
							
						   }
						});
					  });
					  
					  
	 $("#id_koperasi").change(function(){
						var tahun = $("#tahun").val();
						var id = $("#id_koperasi").val();
						$.ajax({
						   type: "POST",
						   url : "../admin/koperasi/get_data_kinerja2",
						   data: "id="+id+"&tahun="+tahun,
						   success: function(data){
							   var kodes = JSON.parse(data);
                                       $("#volume_usaha").val(kodes.a);
                                       $("#total_aktiva").val(kodes.b);
                                       $("#modal_sendiri").val(kodes.c);
									   $("#hutang_lancar").val(kodes.d);
                                       $("#hutang_jk_panjang").val(kodes.e);
                                       $("#shu").val(kodes.f);
									   $("#jml_anggota").val(kodes.g);
									   $("#calon_anggota").val(kodes.h);
							
						   }
						});
					  });
});

function pilih(teks)
{
   if (teks == 'Lainnya') {
      $('#panjang').remove();
      $('#div-panjang').append('<input name="panjang" id="panjang" value="" class="form-control" type="text" />');
   }
}

function pilihSize(teks)
{
   if (teks == 'Lainnya') {
      $('#benih_panjang').remove();
      $('#div-panjang').append('<input name="benih_panjang" id="benih_panjang" value="" class="form-control" type="text" />');
   }
}