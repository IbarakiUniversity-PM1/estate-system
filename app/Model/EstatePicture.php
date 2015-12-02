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
		"estate_id" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"file_name" => array(
			array(
				"rule" => array("maxLength", 100),
				"message" => "100文字以内です。"
			)
		),
		"thumbnail_flag" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
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
				'styles' => array('thumb' => '85x85') //リサイズしたいサイズを書く
			)
		)
	);
}
