jQuery(
	function ($) {
		//駐車場フラグを変更したときの挙動
		var $estate_parking_flag_function = function () {
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
		};

		//駐車場フラグを変更したときの挙動をセット
		$('#EstateParkingFlag').click($estate_parking_flag_function);

		//駐車場フラグを変更したときの挙動を実行
		$estate_parking_flag_function();

		// アップロードするファイルを選択
		$('input[type=file]').change(function (e) {
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
				//対象が物件画像であるとき、行を増やす
				/*if ($(e.target.parentNode.parentNode.parentNode.parentNode).is('#estate_pictures')) {
				 $(e.target.parentNode.parentNode.parentNode).append($(e.target.parentNode.parentNode.parentNode).html());
				 }*/
			} else { //画像でないとき
				$(e.target.parentNode.parentNode).find('.previews').html('<div class=\'error-message\'>対応していないファイル形式です</div>');
			}
		});
	}
);
