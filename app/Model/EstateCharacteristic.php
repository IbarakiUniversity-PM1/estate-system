<?php

/**
 * 物件特徴モデル
 */
class EstateCharacteristic extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public static $hasMany = array("EstateCharacteristicReference");
}
