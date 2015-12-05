jQuery(
	function ($) {
		$('.buttons').find('div').css('width', 100 / $('.buttons').children(':visible').length + '%');
	}
);
