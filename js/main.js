$(document).ready(function() {

	//Calcul de la largeur de la page
	function coolResize() { $('.page').css({width: $(window).width() - $('aside').width() +'px'}); }
	$(window).resize(function(){coolResize();}); coolResize();

	//Plugins jQuery
	$('.page').niceScroll({cursorborder :"1px solid #2289A1", cursorcolor: '#2289A1', cursorborderradius: '0px'});
	$('.page h1, #credits article h1').fitText(0.9);

	//=====================================FULLSCREEN=======================================	
	$('a.fullScreen').click(function(e){
		e.preventDefault();
		toggleFullScreen();
	});

	function isFullScreen() {
 		//if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement) {
	}

	function toggleFullScreen() {
		var docElm = document.documentElement;

		//Si FullScreen OFF
 		if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement) {
			if (document.requestFullscreen) {document.requestFullscreen();}
			else if (docElm.mozRequestFullScreen) {docElm.mozRequestFullScreen();}
			else if (docElm.webkitRequestFullScreen) {docElm.webkitRequestFullScreen();}
		 	$('a.fullScreen').css({backgroundPosition: '32px'});

		//Si FullScreen ON
		 } else {
			if (document.exitFullscreen) {document.exitFullscreen();}
			else if (document.mozCancelFullScreen) {document.mozCancelFullScreen();}
			else if (document.webkitCancelFullScreen) {document.webkitCancelFullScreen();}
		 	$('a.fullScreen').css({backgroundPosition: '64px'});
		}
	}

});