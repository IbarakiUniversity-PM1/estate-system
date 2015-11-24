<?php

/**
 * 物件特徴参照モデル
 */
class EstateCharacteristicReference extends AppModel
{
	public static $hasOne = array("Estate", "EstateCharacteristic");
	public static $validate = array();
}
