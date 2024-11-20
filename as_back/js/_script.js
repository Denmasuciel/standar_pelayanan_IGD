$(document).ready(function(){

   //khusus notifikasi   
   $("#div-notifikasi").load('http://localhost/_project/benih_ikan/admin/home/notifikasi.html', function(){
      $("#load-notifikasi").fadeOut(300);
   });


   //$('.btn').tooltip({ placement:'top',container:'body' });
   $('.tip').tooltip({ placement:'top',container:'body' });
   $('.tipb').tooltip({ placement:'bottom',container:'body' });
   $('.form-control').tooltip({ placement:'top',container:'body' });
   $('.fa').tooltip({ placement:'top',container:'body' });

   $('#tombol-print').click(function(){
      $('#printarea').printArea();
   });

    // Initialize slimscroll for small chat
   /*$('.modal-body').slimScroll({
      height: '470px',
      railOpacity: 0.4
   });*/

	$('.foto-pop').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		image: {
			verticalFit: true
		}
	});

	$('.galeri-pop').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		image: {
			verticalFit: true
		},
      gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		}
	});

	$('.iframe-pop').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false
	});

   $('.pop').popover({ placement:'right',container:'body',trigger:'hover' });

   setTimeout(function() {
      $('.alert').fadeOut('slow',function() {
         $('.alert').alert('close');
      });
   }, 10000);

   //setTimeout(function() { $('.fadeInDown').removeClass('fadeInDown') }, 2000);

   //utk link scroll ke atas
   $(window).scroll(function(){
      if ($(this).scrollTop() > 100) {
         $('.ke-atas').fadeIn();
      } else {
         $('.ke-atas').fadeOut();
      }
   });

   $('.ke-atas').click(function() {
      $('html, body').animate(
      {
         scrollTop: $($(this).attr('href')).offset().top + 'px'
      },
      {
         duration: 400,
        	easing: 'swing'
      });
      return false;
   });

   //utk menyamakan tinggi kolom
   equalheight = function(container){

   var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;
    $(container).each(function() {

      $el = $(this);
      $($el).height('auto')
      topPostion = $el.position().top;

      if (currentRowStart != topPostion) {
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
          rowDivs[currentDiv].height(currentTallest);
        }
        rowDivs.length = 0; // empty the array
        currentRowStart = topPostion;
        currentTallest = $el.height();
        rowDivs.push($el);
      } else {
        rowDivs.push($el);
        currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
     }
      for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
        rowDivs[currentDiv].height(currentTallest);
      }
    });
   }

   $(window).load(function() {
     equalheight('.tinggi-sama');
   });

   $(window).resize(function(){
     equalheight('.tinggi-sama');
   }); 
});