<?php

/**
 * 物件モデル
 */
class Estate extends AppModel
{
        //public $primaryKey = 'estate_id'; //追加: 主キー設定
	public $hasOne = array("EstateTradingAspect", "EstateStructure", "EstateTvType", "EstateAgent", "EstateInternetType"); //編集: static外した
	public $hasMany = array("EstateCharacteristicReference", "EstateFrankOpinion", "MainFacillitiesDistance", "EstatePicture", "EstateRoom"); //編集: static外した
	public $validate = array(); //編集: static外した
} 
