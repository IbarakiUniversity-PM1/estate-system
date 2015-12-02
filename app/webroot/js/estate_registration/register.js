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
	}
);
