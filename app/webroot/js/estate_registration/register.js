$(
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
		}

		//駐車場フラグを変更したときの挙動をセット
		$('#EstateParkingFlag').click(change_estate_parking_flag);

		//駐車場フラグを変更したときの挙動を実行
		change_estate_parking_flag();

		//物件画像のナンバリングを行う
		function numbering_estate_pictures() {
			//物件画像を変更したときの挙動をセット
			$('input[type=file]').change(change_estate_picture);

			var $estate_pictures = $('#estate_pictures');

			//物件画像を削除するときの挙動をセット
			$estate_pictures.find('button').unbind('click').click(function (e) {
				$(e.target).parent().parent().remove();
				numbering_estate_pictures();
			});

			$estate_pictures.find('tbody tr').each(function (i, e) {
				//末尾の行以外の削除ボタンを表示
				if (i + 1 < $estate_pictures.find('tbody tr').length) {
					$(e).find('button').show();
				}
				//末尾の行以外のラジオボタンを表示(ただし、1行しかないときは、その行のラジオボタンを表示する)
				if (i == 0 || i + 1 < $estate_pictures.find('tbody tr').length) {
					$(e).find('input').show().attr('required', true);
				}
			});

			//ひな形と同一のidとnameをセット
			$estate_pictures.find('tbody tr').each(function () {
				$(this).find('input').each(function () {
					var model = $('#estate_pictures_model');
					$(this).attr({
						id: model.find('input[type=' + $(this).attr('type') + ']').attr('id'),
						name: model.find('input[type=' + $(this).attr('type') + ']').attr('name')
					});
				});
			});

			//ナンバリングを行う
			$estate_pictures.find('tbody tr').each(function (i, e) {
				$(e).find('input').each(function () {
					if ($(this).attr('type') === 'radio') {
						$(this).attr('value', i);
					} else {
						$(this).attr('id', $(this).attr('id').replace('?', i));
						$(this).attr('name', $(this).attr('name').replace('?', i));
					}
				});
			});
		}

		//物件画像を変更したときの挙動
		function change_estate_picture(e) {
			var file = $(e.target).prop('files')[0];

			if (file.type.match('image.[(jpeg)|(png)|(gif)]')) { //表示できる画像であるとき
				var reader = new FileReader();

				//画像を読み込んだときの挙動をセット
				reader.onload = function () {
					//プレビュー欄に画像を表示(サイズはサムネイル画像と同じサイズになるようにしている)
					$(e.target).parent().parent().find('.previews')
						.empty()
						.append($('<img>', {src: reader.result}));
				};

				//画像を読み込む
				reader.readAsDataURL(file);

				//対象が物件画像であり、一番下の行であるならば、行を増やし、idとnameのナンバリングを行う
				if ($(e.target).parent().parent().parent().parent().is('#estate_pictures') && $(e.target).parent().parent().parent().parent().find('tbody tr').length == $(e.target).parent().parent().parent().parent().find('tbody tr').index($(e.target).parent().parent()) + 1) {
					var s = $('#estate_pictures_model').find('tr').clone();
					$(s).find('button').hide();
					$(s).find('input[type=radio]').hide();
					$(s).find('input').removeAttr('required');
					$(e.target).parent().parent().parent().append($(s));
					numbering_estate_pictures();
				}
			} else { //画像でないとき
				//ファイル情報をリセット
				$(e.target).val('');
				$(e.target).parent().parent().find('.previews')
					.empty() //プレビュー欄を空にする
					.append($('<div>', {'class': 'error-message'}).append('対応していないファイル形式です。')); //プレビュー欄にエラーメッセージを表示
			}
		}

		//生の声のナンバリングを行う
		function numbering_estate_frank_opinions() {
			//追加ボタンを押下した時の挙動をセット
			$('.estate_frank_opinion_add').unbind('click').click(add_frank_opinions);

			var $estate_frank_opinions = $('#estate_frank_opinions');

			//生の声を削除するときの挙動をセット
			$('.estate_frank_opinion_delete').unbind('click').click(function (e) {
				$(e.target).parent().parent().remove();
				numbering_estate_frank_opinions();
			});

			$estate_frank_opinions.find('tbody tr').each(function (i, e) {
				//末尾の行以外の追加ボタンは隠し、削除ボタンは表示
				if (i + 1 < $estate_frank_opinions.find('tbody tr').length) {
					$(e).find('.estate_frank_opinion_add').hide();
					$(e).find('.estate_frank_opinion_delete').show();
				}
			});

			//ひな形と同一のidとnameをセット
			$estate_frank_opinions.find('tbody tr').each(function () {
				$(this).find('select').each(function () {
					var model = $('#estate_frank_opinions_model');
					$(this).attr({
							id: model.find('select').attr('id'),
							name: model.find('select').attr('name')
						});
					});
					$(this).find('input[type=hidden]').each(function () {
						var model = $('#estate_frank_opinions_model');
						$(this).attr({
							id: model.find('input[type=hidden]').attr('id'),
							name: model.find('input[type=hidden]').attr('name')
						});
					});
			});

			//ナンバリングを行う
			$estate_frank_opinions.find('tbody tr').each(function (i, e) {
				$(e).find('textarea, input[type=hidden]').each(function () {
					$(this).attr('id', $(this).attr('id').replace('?', i));
					$(this).attr('name', $(this).attr('name').replace('?', i));
				});
			});
		}

		//生の声の追加ボタンを押下したときの挙動
		function add_frank_opinions(e) {
			var s = $('#estate_frank_opinions_model').find('tr').clone();
			$(s).find('estate_frank_opinion_delete').hide();
			$(s).find('textarea').removeAttr('required');
			$(e.target).parent().parent().parent().append($(s));
			numbering_estate_frank_opinions();
		}

		//部屋のナンバリングを行う
		function numbering_estate_room() {
			//追加ボタンを押下した時の挙動をセット
			$('.estate_room_add').unbind('click').click(add_room);

			var $estate_room = $('#estate_room');

			//部屋を削除するときの挙動をセット
			$('.estate_room_delete').unbind('click').click(function (e) {
				$(e.target).parent().parent().remove();
				numbering_estate_room();
			});

			$estate_room.find('tbody tr').each(function (i, e) {
				//末尾の行以外の追加ボタンは隠し、削除ボタンは表示
				if (i + 1 < $estate_room.find('tbody tr').length) {
					$(e).find('.estate_room_add').hide();
					$(e).find('.estate_room_delete').show();
				}
			});

			//ひな形と同一のidとnameをセット
			$estate_room.find('tbody tr').each(function () {
				$(this).find('select, input').each(function () {
					var model = $('#estate_room_model');
					$(this).attr({
						id: model.find($(this).attr('class')).attr('id'),
						name: model.find($(this).attr('class')).attr('name')
					});
				});
			});

			//ナンバリングを行う
			$estate_room.find('tbody tr').each(function (i, e) {
				$(e).find('select, input').each(function () {
					$(this).attr('id', $(this).attr('id').replace('?', i));
					$(this).attr('name', $(this).attr('name').replace('?', i));
					if($(this).is('.estate_room_occupancy_date')){
						$(this).datepicker();
					}
				});
			});
		}

		//部屋の追加ボタンを押下したときの挙動
		function add_room(e) {
			var s = $('#estate_room_model').find('tr').clone();
			$(s).find('.estate_room_delete').hide();
			$(e.target).parent().parent().parent().append($(s));
			numbering_estate_room();
		}

		//いいえボタンを押下したときの挙動
		function click_no() {
			var $h2 = $('h2');
			$h2.html('物件登録');
			document.title = $h2.html() + ' - こうがく不動産';
			$('#main').find('form *').removeAttr('disabled');
			$('#estate_main_facilities').find("select").each(function (){
				if(-1<$(this).val()){
					$(this).parent().parent().find('input:hidden').attr('disabled',true);
				}
			});
			$('h3, .submit').hide();
			$('#register').parent().show();
			$('input[type=file], #register, .estate_frank_opinion_add, .estate_room_add').show();
			$('input[type=hidden]').each(function () {
				if (!$(this).is('.estateFrankOpinionTypeId') && !$(this).is('.estateMainFacilitiesTypeId')) {
					$(this).remove();
				}
			});
			$('#back').html('戻る').unbind('click').click(function () {
				history.back();
			});
			//物件画像のナンバリングを行う
			numbering_estate_pictures();
			//生の声のナンバリングを行う
			numbering_estate_frank_opinions();
			//部屋のナンバリングを行う
			numbering_estate_room();
		}

		//登録ボタンを押下したときの挙動をセット
		$('#register').click(function () {
			var $h2 = $('h2');
			$h2.html('物件登録確認');
			document.title = $h2.html() + ' - こうがく不動産';
			$('select, input, textarea').each(function () {
				if (
					!$(this).is(':disabled')
					&& !$(this).is('#estate_main_facilities select[value=-1]')
					&& $(this).find('option:selected').attr('value') !== '-1'
					&& (
						!$(this).is('input')
						|| (
							!$(this).is('input[type=file]')
							&& !$(this).is('input[type=hidden]')
							&& (
								(
									!$(this).is('input[type=radio]')
									&& !$(this).is('#estate_characteristic_reference input[type=checkbox]')
								)
								|| $(this).is(':checked')
							)
						)
					)
				) {
					var s = $(this).clone();
					if($(s).attr('id')!==undefined){
						$(s).attr('id', $(s).attr('id') + '_');
					}
					$(s).attr('type', 'hidden');
					if ($(this).is('select')) {
						$(s).find('option').remove();
						s = $($(s)[0].outerHTML.replace('select', 'input')).attr('value', $(this).find('option:selected').attr('value'));
					} else if ($(this).is('textarea')) {
						s = $($(s)[0].outerHTML.replace('textarea', 'input')).attr('value', $(this).val());
					} else if($(this).is('#estate_characteristic_reference input[type=checkbox]')) {
						$(s).attr('name',$(s).attr('name').replace('[]','').replace('][','][]['));
					} else if($(this).is('#estate_room input[type=checkbox]') && !$(this).is(':checked')){
						$(s).val(0);
					}
					$(this).parent().append(s);
				}
			});
			$('#main').find('form *').attr('disabled', true);
			$('.buttons, .buttons *, input[type=hidden], input[type=file]').removeAttr('disabled');
			$('.estateMainFacilitiesTypeId').each(function (){
				if(-1<$(this).parent().parent().find('option:selected').val()){
					$(this).attr('disabled', true);
				}
			});
			$('h3, .submit').show();
			$('#register').parent().hide();
			$('input[type=file], button').hide();
			$('#back').show().html('いいえ').unbind('click').click(click_no);
			// ページの上部に移動
			$('html, body').prop('scrollTop', 0);
		});

		$('input[type=submit]').click(function () {
			$('.model').remove();
		});

		var $estate_main_facilities=$('#estate_main_facilities');

		//主要施設のナンバリングを行う
		$estate_main_facilities.find('tbody tr').each(function (i, e) {
			$(e).find('input, select').each(function () {
				$(this).attr('id', $(this).attr('id').replace('?', i));
				$(this).attr('name', $(this).attr('name').replace('?', i));
			});
		});

		$estate_main_facilities.find('select').change(function (e){
			if($(e.target).find(':selected').val()==-1){
				$(e.target).parent().parent().find('input').removeAttr('disabled');
				if($(e.target).parent().find('input').length==1){
					$(e.target).parent().find('input').show();
				}else {
					var $i = $('<input>');
					$i.attr('name', $(e.target).attr('name').replace('Distance', '').replace('estate_main_facilities_id', 'name'));
					$i.width($(e.target).width());
					$(e.target).parent().append($i);
				}
			}else if($(e.target).parent().find('input').length==1){
				$(e.target).parent().find('input').attr('disabled', true).hide();
				$(e.target).parent().parent().find('.estateMainFacilitiesTypeId').attr('disabled', true);
			}
		});

		click_no();

		$('#EstateAge').datepicker();
	}
);
