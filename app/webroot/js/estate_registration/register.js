jQuery(
	function () {
		//駐車場フラグを変更したときの挙動
		function change_estate_parking_flag() {
			if ($('#EstateParkingFlag').is(':checked')) { //駐車場フラグが立っているとき
				//駐車場料金の入力フォームを表示
				$('#EstateParkingFeeDiv').show();
			} else { //駐車場フラグが降ろされているとき
				//駐車場料金の入力フォームを隠す
				$('#EstateParkingFeeDiv').hide();
			}
			//もし、駐車場料金の入力フォームが空ならば、『0』をセットする
			if ($('#EstateParkingFee').val() === '') {
				$('#EstateParkingFee').val(0);
			}
		}
		//駐車場フラグを変更したときの挙動をセット
		$('#EstateParkingFlag').click(change_estate_parking_flag);

		//駐車場フラグを変更したときの挙動を実行
		change_estate_parking_flag();

		//物件画像のidとnameにナンバリングを行う
		function numbering_estate_pictures() {
			var $i = 0;
			//ひな形と同一のidとnameをセット
			$('#estate_pictures').find('tbody tr').each(function () {
				$(this).find('input').each(function () {
					$(this).attr({
						'id': $('.model').find('input[type=' + $(this).attr('type') + ']').attr('id'),
						'name': $('.model').find('input[type=' + $(this).attr('type') + ']').attr('name')
					});
				});
				$i++;
			});

			//2行以上あるならば、idとnameのナンバリングを行う
			if (1 < $i) {
				$('#estate_pictures').find('tbody tr').each(function (i, e) {
					$(e).find('input').each(function () {
						$(this).attr({
							'id': $(this).attr('id') + i,
							'name': $(this).attr('name') + '[' + i + ']'
						});
					});
				});
			}
		}

		function change_estate_picuture(e) {
			var file = $(e.target).prop('files')[0];

			if (file.type.match('image.*')) { //画像であるとき
				var reader = new FileReader();
				reader.onload = function () {
					$(e.target.parentNode.parentNode).find('.previews').html($('<img>').attr({
						'src': reader.result,
						'width': ($(e.target.parentNode.parentNode.parentNode.parentNode)[0].rows[0].cells.length * 100 / 9) + '%'
					}));
				};
				reader.readAsDataURL(file);
				//対象が物件画像であり、一番下の行であるならば、行を増やし、idとnameのナンバリングを行う
				if ($(e.target.parentNode.parentNode.parentNode.parentNode).is('#estate_pictures') && $(e.target.parentNode.parentNode.parentNode.parentNode).find('tbody tr').length == $(e.target.parentNode.parentNode.parentNode.parentNode).find('tbody tr').index(e.target.parentNode.parentNode) + 1) {
					var s = $('.model tr').clone();
					$(s).change(change_estate_picuture);
					$(e.target.parentNode.parentNode.parentNode).append(s);
					numbering_estate_pictures();
				}
			} else { //画像でないとき
				$(e.target.parentNode.parentNode).find('.previews').html('<div class=\'error-message\'>対応していないファイル形式です</div>');
			}
		}

		// アップロードするファイルを選択したときの挙動をセット
		$('input[type=file]').change(change_estate_picuture);

		//登録ボタンを押下したときの挙動をセット
		$('#confirm').click(function () {
			$('.buttons').innerHTML = '';
			$('.buttons').append($('input', {
				'class': 'submit'
			}));
		});
	}
);
