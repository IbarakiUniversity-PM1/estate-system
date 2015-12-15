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
		"distance" => array(
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			)
		)
	);
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_main_facilities_distance_id";
}
