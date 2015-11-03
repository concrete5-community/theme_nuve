$(document).ready(function() {
// Magnific popup
   	$('.magnific-wrapper').each(function(){
   		var t = $(this);
   		var child = t.data('delegate') ? t.data('delegate') : 'a';
   		var contentType = t.data('type') ? t.data('type') : 'image';
   		t.magnificPopup({
        fixedContentPos:false,
        overflowY:'scroll',
   	  		delegate: child, // child items selector, by clicking on it popup will open
   	  		type: contentType,
   	  		mainClass: 'mfp-effect',
   	  		removalDelay: 500,
   			  gallery:{
   			    enabled:true
   			  }
   		})
   	});
    $(".open-popup-link").magnificPopup({
  		type:'inline',
      fixedContentPos:false,
      overflowY:'scroll',
  		midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  	  		mainClass: 'mfp-effect',
  	  		removalDelay: 500
  	});
    $('.ajax-popup-link').magnificPopup({
      type: 'ajax',
      midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  	  mainClass: 'mfp-effect',
  	  removalDelay: 500
    });
});
