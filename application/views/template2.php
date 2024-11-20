<?php $uri = $this->uri->segment(1); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title><?= strip_tags(ucwords($_judul)); ?></title>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <meta name="robots" content="noindex, nofollow">

   <link rel="icon" type="image/png" href="<?= base_url('as_back/img/logo-mini.png'); ?>" />

   <!-- load Styles -->
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/normalize.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/bootstrap.min.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/font-awesome.min.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/awesome-bootstrap-checkbox.css'); ?>">
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/datepicker3.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/bootstrap-timepicker.min.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/summernote.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/_front2.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/deny.css'); ?>" />
   <link type="text/css" rel="stylesheet" href="<?= base_url('media/css/dataTables.bootstrap.css'); ?>" />

   <!-- load JavaScript -->
   <script type="text/javascript" src="<?= base_url('as_back/js/jquery-2.1.3.min.js'); ?>"></script>
   <script type="text/javascript" src="<?= base_url('as_back/js/bootstrap.min.js'); ?>"></script>
   <script type="text/javascript" src="<?= base_url('media/js/jquery.dataTables.min.js'); ?>"></script>
   <script type="text/javascript" src="<?= base_url('media/js/dataTables.bootstrap.js'); ?>"></script>
   
   <link type="text/css" rel="stylesheet" href="<?= base_url('as_back/css/style.css'); ?>" />
</head>
<body>

<div class="container" id="container">

   <!-- header -->
   <header>
      <nav class="navbar navbar-inverse hidden-print">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">
               <img src="<?= base_url('as_back/img/logo.png') ?>" class="pull-left">
               <b>RSUD WONOSARI</b><br>
               <small>Sistem Antrian Loket</small>
            </span>
         </div>

      </nav>
   </header>

   <!-- konten/isi -->
   <div class="konten">
      <?= $_konten; ?>
   </div>
   
    <footer>
      
         
   </footer>

</div>

<?= ($_hx_info = $this->session->flashdata('hx_info')) ? $_hx_info : ''; ?>

<!-- Javascript -->
<script type="text/javascript">
   $(document).ready(function(){
      var height = $(window).height();
      $('#container').attr('style','min-height:'+height+'px');
      $(window).resize(function() {
         var height = $(window).height();
         $('#container').attr('style','min-height:'+height+'px');
      });
   });
</script>

</body>
</html>