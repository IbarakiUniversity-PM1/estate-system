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

		//物件画像のナンバリングを行う
		function numbering_estate_pictures() {
			//物件画像を変更したときの挙動をセット
			$('input[type=file]').change(change_estate_picuture);

			//物件画像を削除するときの挙動をセット
			$('#estate_pictures').find('button').click(function (e) {
				$(e.target).parent().parent().remove();
				numbering_estate_pictures();
			});

			$('#estate_pictures').find('tbody tr').each(function (i, e) {
				// 末尾の行以外の削除ボタンを表示
				if (i + 1 < $('#estate_pictures').find('tbody tr').length) {
					$(e).find('button').show();
				}
				// 末尾の行以外のラジオボタンを表示(ただし、1行しかないときは、その行のラジオボタンを表示する)
				if (i == 0 || i + 1 < $('#estate_pictures').find('tbody tr').length) {
					$(e).find('input').show();
				}
			});

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

			//ナンバリングを行う
			$('#estate_pictures').find('tbody tr').each(function (i, e) {
				$(e).find('input').each(function () {
					$(this).attr('id', $(this).attr('id') + i);
					if ($(this).attr('type') === 'radio') {
						$(this).attr('value', i);
					} else {
						$(this).attr('name', $(this).attr('name') + '[' + i + ']');
					}
				});
			});
		}

		//物件画像を変更したときの挙動
		function change_estate_picuture(e) {
			var file = $(e.target).prop('files')[0];

			if (file.type.match('image.*')) { //画像であるとき
				var reader = new FileReader();
				reader.onload = function () {
					$(e.target).parent().parent().find('.previews').html($('<img>').attr({
						'src': reader.result,
						'width': ($(e.target).parent().parent().parent().parent()[0].rows[0].cells.length * 100 / 9) + '%'
					}));
				};
				reader.readAsDataURL(file);
				//対象が物件画像であり、一番下の行であるならば、行を増やし、idとnameのナンバリングを行う
				if ($(e.target).parent().parent().parent().parent().is('#estate_pictures') && $(e.target).parent().parent().parent().parent().find('tbody tr').length == $(e.target).parent().parent().parent().parent().find('tbody tr').index($(e.target).parent().parent()) + 1) {
					var s = $('.model tr').clone();
					$(s).find('button').hide();
					$(s).find('input[type=radio]').hide();
					$(e.target).parent().parent().parent().append($(s));
					numbering_estate_pictures();
				}
			} else { //画像でないとき
				$(e.target).parent().parent().find('.previews').html('<div class=\'error-message\'>対応していないファイル形式です</div>');
			}
		}

		//物件画像のナンバリングを行う
		numbering_estate_pictures();

		//登録ボタンを押下したときの挙動をセット
		$('#confirm').click(function () {
			$('.buttons').innerHTML = '';
			$('.buttons').append($('input', {
				'class': 'submit'
			}));
		});
	}
);
