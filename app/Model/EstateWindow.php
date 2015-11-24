<?php

/**
 * 窓モデル
 */
class EstateWindow extends AppModel
{
	public static $hasOne = array("EstateRoom");
	public static $validate = array();
}
