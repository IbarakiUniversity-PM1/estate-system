<?php

/**
 * 距離モデル
 */
class EstateMainFacilitiesDistance extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array(
		"Estate",
		"EstateMainFacilities"
	);
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
		"estate_main_facilities_id" => array(
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
	public $primaryKey = "estate_main_facillities_distance_id";
}
