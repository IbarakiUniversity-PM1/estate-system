<?php

/**
 * 物件検索・詳細コントローラ
 */
class EstateViewController extends AppController
{
	/**
	 * @var array 扱うモデルのリスト
	 */
	public static $uses = array(
		"Estate",
		"EstateAgent",
		"EstateInternetType",
		"EstateFrankOpinion",
		"EstateMainFacilitiesDistance",
		"EstateTvType",
		"EstateTradingAspect",
		"EstateRoom",
		"EstateType",
		"EstateStructure",
		"EstatePicture",
		"EstateCharacteristic",
		"EstateFrankOpinionType",
		"EstateCharacteristicReference",
		"EstateMainFacilitiesType",
		"EstateWindow",
		"EstateMainFacilities"
	);
}
