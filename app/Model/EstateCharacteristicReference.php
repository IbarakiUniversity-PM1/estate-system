<?php

/**
 * 物件特徴参照モデル
 */
class EstateCharacteristicReference extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $hasOne = array(
		"Estate",
		"EstateCharacteristic"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array();
}
