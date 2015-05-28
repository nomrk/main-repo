function showPageById(pageToShow, menuButton){		
		$("#mAbout").removeClass("active");
		$("#about").addClass("hidden");
		$("#mContact").removeClass("active");
		$("#contact").addClass("hidden");
		$("#mLogin").removeClass("active");
		$("#login").addClass("hidden");
		$("#gallery").addClass("hidden");
		$("#mGallery").removeClass("active");
		
	    $(pageToShow).removeClass("hidden");
		$(menuButton).addClass("active");
}

$(document).ready(function(){
	$("#mGallery").click(function(){
		showPageById("#gallery", "#mGallery");
	});
	
	$("#mAbout").click(function(){
		showPageById("#about", "#mAbout");
	});
	$("#mContact").click(function(){
		showPageById("#contact", "#mContact");
	});
	$("#mLogin").click(function(){
		showPageById("#login", "#mLogin");
	});
});
