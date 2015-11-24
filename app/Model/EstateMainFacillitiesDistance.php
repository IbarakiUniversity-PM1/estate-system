<?php

/**
 * 距離モデル
 */
class EstateMainFacillitiesDistance extends AppModel
{
	public static $hasOne = array("Estate", "EstateMainFacillities");
	public static $validate = array();
}
