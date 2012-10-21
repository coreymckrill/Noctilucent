
jQuery(document).ready(function($){
	
	// Fix vertical rhythm for editor-inserted images
	// Uses baseline.js script in plugins.js
	$('img.alignleft, img.alignright, img.aligncenter, img.alignnone, .aligncenter img, .gallery-item img')
		.baseline(24)
		.removeAttr('height')
		.removeAttr('width')
	;
	
	// Open external links in a new window
	$('.external-link').attr('target','_blank');
	
});
