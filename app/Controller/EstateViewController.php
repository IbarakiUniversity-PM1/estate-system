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
		if($this->request->is("post")){
			$this->set("title_for_layout", "物件検索結果");
			$options=array();
		}else {
			$this->set("title_for_layout", "オススメ物件一覧");
			$options=array(/*"order"=>array("EstateMainFacillitiesDistance.distance")*/);
		}
		$this->Estate->virtualFields = array('age' => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-age/1000,'unixepoch'))-1970");
		$this->Estate->hasMany['EstatePicture']['conditions'] = 'EstatePicture.thumbnail_flag=1';
		$this->set("estates", $this->Estate->find("all",$options));
		$this->Estate->hasMany['EstatePicture']['conditions'] = null;
	}

	/**
	 * 物件詳細
	 */
	public function detail()
	{

	}
}
