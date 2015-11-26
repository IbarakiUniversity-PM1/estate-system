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
	 * 物件検索・絞込・トップ画面
	 */
	public function estateList()
	{
		if ($this->request->is("post")) { //物件検索・絞り込み
			$this->set("title_for_layout", "物件検索結果");
			$options=array();
		} else { //トップ画面
			$this->set("title_for_layout", "オススメ物件一覧");
			$options = array(
				"joins" => array(
					array(
						"table" => "estate_main_facilities_distances",
						"alias" => "EstateMainFacilitiesDistance",
						"conditions" => array(
							"Estate.estate_id = EstateMainFacilitiesDistance.estate_id",
							"EstateMainFacilitiesDistance.estate_main_facilities_id=1"
						)
					)
				),
				"order" => array("EstateMainFacilitiesDistance.distance")
			);
		}
		$this->Estate->virtualFields = array("age" => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-Estate.age/1000,'unixepoch'))-1970");
		$this->Estate->hasMany["EstatePicture"]["conditions"] = "EstatePicture.thumbnail_flag=1";
		$this->set("estates", $this->Estate->find("all",$options));
		foreach ($this->Estate->hasMany as $k => $v) {
			$this->Estate->hasMany[$k]["conditions"] = "";
		}
	}

	/**
	 * 物件詳細
	 */
	public function detail()
	{

	}
}
