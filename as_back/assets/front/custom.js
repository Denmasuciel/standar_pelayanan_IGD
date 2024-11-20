/* Theme Name:iDea - Clean & Powerful Bootstrap Theme
 * Author:HtmlCoder
 * Author URI:http://www.htmlcoder.me
 * Author e-mail:htmlcoder.me@gmail.com
 * Version: 1.3
 * Created:October 2014
 * License URI:http://support.wrapbootstrap.com/
 * File Description: Place here your custom scripts
 */

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