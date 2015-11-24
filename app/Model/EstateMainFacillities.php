<?php

/**
 * 主要施設モデル
 */
class EstateMainFacillities extends AppModel
{
	public static $hasOne = array("EstateMainFacillitiesType");
	public static $hasMany = array("MainFacillitiesDistance");
	public static $validate = array();
}
