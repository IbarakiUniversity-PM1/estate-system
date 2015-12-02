<?php

/**
 * 主要施設モデル
 */
class EstateMainFacilities extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array("EstateMainFacilitiesType");
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("EstateMainFacilitiesDistance");
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"estate_main_facilities_type_id" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"name" => array(
			array(
				"rule" => array("maxLength", 30),
				"message" => "30文字以内です。"
			)
		)
	);
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_main_facilities_id";
}
