$(document).ready(function() {

	var headerWidth = $('header').width();


	$('#clavar').affix({
		offset: {
			//top: 100,
			bottom: function () {
				return (this.bottom = $('.footer').outerHeight(true))
			}
		}
	});

	$('#clavar').css( "width", headerWidth );

	$('body').scrollspy({ target: '#navbar' });


});
