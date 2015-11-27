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
		"EstateMainFacilities"
	);

	/**
	 * 物件検索・絞込・トップ画面
	 */
	public function estateList()
	{
		//データ取得の際のオプション
		$options = array(
			"joins" => array(),
			"order" => array(),
			"group" => array(),
			"conditions" => array(),
			//取得件数を10件に設定する
			"limit" => 10
		);
		if (empty($this->request->query)) { //トップ画面
			//タイトルをセットする
			$this->set("title_for_layout", "オススメ物件一覧");
			//茨城大学日立キャンパスからの距離をJOINする
			$options["joins"][] = array(
				"type" => "LEFT",
				"table" => "estate_main_facilities_distances",
				"alias" => "EstateMainFacilitiesDistance",
				"conditions" =>
					array(
						"Estate.estate_id = EstateMainFacilitiesDistance.estate_id",
						//茨城大学日立キャンパスからの距離に限定する
						"EstateMainFacilitiesDistance.estate_main_facilities_id=1"
					)
			);
			//茨城大学日立キャンパスからの距離の昇順で並べる
			$options["order"][] = "EstateMainFacilitiesDistance.distance";
		} else { //物件検索・絞り込み
			//タイトルをセットする
			$this->set("title_for_layout", "物件検索結果");
			$options["conditions"]["Estate.estate_id"] = $this->request->query;
		}
		//サムネイル画像をJOINする
		$options["joins"][] = array(
			"type" => "LEFT",
			"table" => "estate_pictures",
			"alias" => "EstatePicture",
			"conditions" => array(
				"Estate.estate_id=EstatePicture.estate_id",
				//サムネイル画像となっている物件画像に限定する
				"EstatePicture.thumbnail_flag=1"
			)
		);
		//部屋情報をJOINする(全ての部屋が契約済みな物件は、表示されないようにする)
		$options["joins"][] = array(
			"type" => "LEFT",
			"table" => "estate_rooms",
			"alias" => "EstateRoom",
			"conditions" => array("Estate.estate_id=EstateRoom.estate_id")
		);
		$options["conditions"][] = "EstateRoom.contracted_flag=0";
		//Estateにバーチャルフィールドを作成する
		$this->Estate->virtualFields = array(
			//築年数(本来の値に上書きする形となっている)
			"age" => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-Estate.age/1000,'unixepoch'))-1970",
			//サムネイル画像
			"picture_file_name" => "EstatePicture.picture_file_name"
		);
		//データを取得し、Viewの$estatesにセットする
		$this->set("estates", $this->Estate->find("all",$options));
	}

	/**
	 * 物件詳細
	 */
	public function detail()
	{

	}
}
