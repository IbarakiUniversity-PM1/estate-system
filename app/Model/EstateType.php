<?php

/**
 * 部屋種別モデル
 */
class EstateType extends AppModel
{
	public static $hasMany = array("EstateRoom");
}
