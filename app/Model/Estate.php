<?php

/**
 * 物件モデル
 */
class Estate extends AppModel
{
	public static $hasOne = array("EstateTradingAspect", "EstateStructure", "EstateTvType", "EstateAgent", "EstateInternetType");
	public static $hasMany = array("EstateCharacteristicReference", "EstateFrankOpinion", "MainFacillitiesDistance", "EstatePicture", "EstateRoom");
	public static $validate = array();
}
