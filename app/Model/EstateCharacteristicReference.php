<?php

/**
 * 物件特徴参照モデル
 */
class EstateCharacteristicReference extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array(
		"Estate",
		"EstateCharacteristic"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"estate_characteristic_id" => array(
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
	public $primaryKey = "estate_characteristic_reference_id";
}
