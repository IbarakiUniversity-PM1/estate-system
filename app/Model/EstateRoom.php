<?php

/**
 * 部屋モデル
 */
class EstateRoom extends AppModel
{
	public static $hasOne = array("Estate", "EstateType");
	public static $hasMany = array("EstateWindow");
	public static $validate = array();
}
