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
				$(this).find('textarea').each(function () {
					var model = $('#estate_frank_opinions_model');
					$(this).attr({
						id: model.find('textarea').attr('id'),
						name: model.find('textarea').attr('name')
					});
				});
			});

			//ナンバリングを行う
			$estate_frank_opinions.find('tbody tr').each(function (i, e) {
				$(e).find('textarea').each(function () {
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

		//いいえボタンを押下したときの挙動
		function click_no() {
			var $h2 = $('h2');
			$h2.html('物件登録');
			document.title = $h2.html() + ' - こうがく不動産';
			$('#main').find('form *').removeAttr('disabled');
			$('h3, .submit').hide();
			$('#register').parent().show();
			$('input[type=file], #register, .estate_frank_opinion_add').show();
			$('input[type=hidden]').remove();
			$('#back').html('戻る').unbind('click').click(function () {
				history.back();
			});
			//物件画像のナンバリングを行う
			numbering_estate_pictures();
			//生の声のナンバリングを行う
			numbering_estate_frank_opinions();
		}

		//登録ボタンを押下したときの挙動をセット
		$('#register').click(function () {
			var $h2 = $('h2');
			$h2.html('物件登録確認');
			document.title = $h2.html() + ' - こうがく不動産';
			$('#main').find('form *').attr('disabled', true);
			$('select, input').each(function () {
				if ($(this).find('option:selected').attr('value') !== '-1' && ($(this).is('select') || (!$(this).is('input[type=file]') && (!$(this).is('input[type=radio]') || $(this).is(':checked'))))) {
					var s = $(this).clone();
					$(s).attr('id', $(s).attr('id') + '_');
					$(s).attr('type', 'hidden');
					if ($(this).is('select')) {
						$(s).find('option').remove();
						s = $($(s)[0].outerHTML.replace('select', 'input')).attr('value', $(this).find('option:selected').attr('value'));
					}
					$(this).parent().append(s);
				}
			});
			$('.buttons, .buttons *, input[type=hidden], input[type=file]').removeAttr('disabled');
			$('h3, .submit').show();
			$('#register').parent().hide();
			$('input[type=file], button').hide();
			$('#back').show().html('いいえ').unbind('click').click(click_no);
			// ページトップにスクロール
			$('html, body').animate({scrollTop: 0}, 'slow');
		});

		$('input[type=submit]').click(function () {
			$('.model').remove();
		});

		click_no();
	}
);
