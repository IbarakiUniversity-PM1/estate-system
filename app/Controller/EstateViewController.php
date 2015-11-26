<?php

/**
 * 物件検索・詳細コントローラ
 */
class EstateViewController extends AppController
{
	/**
	 * @var array 扱うモデルのリスト
	 */
	public $uses = array(
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

	/**
	 * 物件検索・絞り込み
	 */
	public function estateList()
	{
		$this->set("title_for_layout", "物件検索");
		$this->Estate->virtualFields = array(
			'age' => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-age/1000,'unixepoch'))-1970"
		);
		$this->set("estates", $this->Estate->find("all"));
	}

	/**
	 * 物件詳細
	 */
	public function detail()
	{

	}
}
