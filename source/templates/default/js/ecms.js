$(document).ready(function() {
	$('video').mediaelementplayer({
		alwaysShowControls: false,
		videoVolume: 'horizontal',
		features: ['playpause','progress','volume','fullscreen']
	});
});