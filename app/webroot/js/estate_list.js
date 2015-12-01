jQuery(
	function ($) {
		//data-hrefの属性を持つtrを選択しclassにclickableを付加
		$('tr[data-href]').click(
			function (e) {
				//e.targetはクリックした要素自体、それが#Estate0EstateId要素以外であれば
				if (!$(e.target).is('.estate_check') && !$(e.target).is('div')) {
					//その要素の先祖要素で一番近いtrのdata-href属性の値に書かれているURLに遷移する
					window.location = $(e.target).closest('tr').data('href');
				}
			}
		);
		$('#refine').click(
			function () {
				var $tr;
				for (var $i = 0; $i < $('.estate_check').length; $i++) {
					if (!$('.estate_check')[$i].checked) {
						$tr = $('.estate_check')[$i].parentNode.parentNode.parentNode;
						$tr.parentNode.deleteRow($tr.sectionRowIndex);
						$i--;
					}
				}
			}
		);
	}
);
