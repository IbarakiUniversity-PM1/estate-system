<?php

/**
 * 物件画像モデル
 */
class EstatePicture extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array("Estate");
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"file_name" => array(
			array(
				"rule" => array("maxLength", 100),
				"message" => "100文字以内です。"
			)
		),
		"thumbnail_flag" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"picture" => array(
			array(
				'rule' => array('uploadError'),
				'message' => array('アップロード中にエラーが発生しました。')
			),
			array(
				'rule' => array(
					'mimeType',
					array(
						'image/jpeg',
						'image/png',
						'image/gif'
					)
				),
				'message' => array('対応していないファイル形式です。')
			)
		)
	);
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_picture_id";
	/**
	 * @var array 扱うビヘイビアのリスト
	 */
	public $actsAs = array(
		'UploadPack.Upload' => array(
			//ここでは、"_file_name"を除いたカラム名を書く
			'picture' => array(
				'quality' => 75, //画質指定、デフォルトでは75
				'styles' => array('thumb' => '85w') //リサイズしたいサイズを書く
			)
		)
	);
}
