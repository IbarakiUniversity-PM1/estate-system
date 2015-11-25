<?php

/**
 * 部屋モデル
 */
class EstateRoom extends AppModel
{
        
	public $hasOne = array("Estate", "EstateType");
	public $hasMany = array("EstateWindow");
	//public static $validate = array();
}
