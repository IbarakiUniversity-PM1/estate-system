<?php

/**
 * 部屋モデル
 */
class EstateRoom extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array(
		"Estate",
		"EstateType"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"estate_id" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"room_number" => array(
			array(
				"rule" => array("maxLength", 10),
				"message" => "10文字以内です。"
			),
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"contracted_flag" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		)
	);
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_room_id";
}
