<?php

/**
 * 物件特徴モデル
 */
class EstateCharacteristic extends AppModel
{
	public static $hasMany = array("EstateCharacteristicReference");
}
