(function($) {
  "use strict"; // Start of use strict
  
  // Vide - Video Background Settings
  var url = window.location.href.split("/");

  if(array_contain(url,"home")){
  	$('body').vide({
			mp4: base+"/files/home/img/bg.mp4",
			poster: base+"/files/home/img/bg-fallback.jpg"
		},{
			posterType: 'jpg'
		}
	);
  }else{
 //  	$('body').vide({
	// 		poster: base+"/files/home/img/bg3.png"
	// 	},{
	// 		posterType: 'png'
	// 	}
	// );
  }
  
})(jQuery); // End of use strict

function array_contain(arr, value){
	if(arr.indexOf(value) >= 0){
		return true;
	}else{
		return false;
	}
}