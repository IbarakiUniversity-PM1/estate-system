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
		//データ取得の際のオプション
		$options = array("joins" => array(), "order" => array(), "group" => array(), "limit" => 10);
		if ($this->request->is("post")) { //物件検索・絞り込み
			//タイトルをセット
			$this->set("title_for_layout", "物件検索結果");
		} else { //トップ画面
			//タイトルをセット
			$this->set("title_for_layout", "オススメ物件一覧");
			//距離をJOIN
			$options["joins"][] = array(
				"type" => "left",
				"table" => "estate_main_facilities_distances",
				"alias" => "EstateMainFacilitiesDistance",
				"conditions" =>
					array(
						"Estate.estate_id = EstateMainFacilitiesDistance.estate_id",
						"EstateMainFacilitiesDistance.estate_main_facilities_id=1"
					)
			);
			$options["order"][] = "EstateMainFacilitiesDistance.distance";
		}
		//窓の向きをJOIN
		$dbo = $this->Estate->getDataSource();
		$estateRoomWindow = array();
		for ($i = 0; $i < 2; $i++) {
			$estateRoomWindow[] = $dbo->buildStatement(
				array(
					'fields' => array("EstateRoom.estate_id", "EstateWindow.direction", "COUNT(*) as n"),
					'table' => $dbo->fullTableName($this->EstateRoom),
					'alias' => 'EstateRoom',
					'limit' => null,
					'offset' => null,
					'joins' => array(
						array(
							"type" => 'LEFT',
							"alias" => 'EstateWindow',
							"table" => "estate_windows",
							"conditions" => 'EstateRoom.estate_room_id=EstateWindow.estate_room_id'
						)
					),
					'conditions' => array(),
					'order' => null,
					'group' => "EstateRoom.estate_id,EstateWindow.direction"
				),
				$this->EstateRoom
			);
		}
		$options["joins"][] = array(
			"type" => "left",
			"table" => "({$estateRoomWindow[0]})",
			"alias" => "EstateRoomWindow0",
			"conditions" => array("Estate.estate_id = EstateRoomWindow0.estate_id")
		);
		$options["joins"][] = array(
			"type" => "left",
			"table" => "({$estateRoomWindow[1]})",
			"alias" => "EstateRoomWindow1",
			"conditions" => array(
				"EstateRoomWindow0.estate_id = EstateRoomWindow1.estate_id",
				"EstateRoomWindow0.n < EstateRoomWindow1.n"
			)
		);
		$options["group"][] = "EstateRoomWindow0.estate_id,EstateRoomWindow0.direction HAVING COUNT(EstateRoomWindow1.estate_id) = 0";
		//サムネイル画像をJOIN
		$options["joins"][] = array(
			"type" => "left",
			"table" => "estate_pictures",
			"alias" => "EstatePicture",
			"conditions" => array(
				"Estate.estate_id=EstatePicture.estate_id",
				"EstatePicture.thumbnail_flag=1"
			)
		);
		//Estateにバーチャルフィールドを作成(築年数,窓の向き,サムネイル画像)
		$this->Estate->virtualFields = array(
			"age" => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-Estate.age/1000,'unixepoch'))-1970",
			"direction" => "EstateRoomWindow0.direction",
			"picture_file_name" => "EstatePicture.picture_file_name"
		);
		//データを取得し、Viewの$estatesにセット
		$this->set("estates", $this->Estate->find("all",$options));
	}

	/**
	 * 物件詳細
	 */
	public function detail()
	{

	}
}
