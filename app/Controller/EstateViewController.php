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
		$options = array(
			"joins" => array(),
			"order" => array(),
			"group" => array(),
			//取得件数を10件に設定する
			"limit" => 10
		);
		if ($this->request->is("post")) { //物件検索・絞り込み
			//タイトルをセットする
			$this->set("title_for_layout", "物件検索結果");
		} else { //トップ画面
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
		}
		//物件IDと窓の向きの組み合わせ、及び、その個数をカラムとするテーブルを取得する
		$dbo = $this->Estate->getDataSource();
		$estateRoomWindow =
			$dbo->buildStatement(
				array(
					"fields" =>
						array(
							"EstateRoom.estate_id",
							"EstateWindow.direction",
							"COUNT(*) as n"
						),
					"table" => $dbo->fullTableName($this->EstateRoom),
					"alias" => "EstateRoom",
					"joins" => array(
						array(
							"type" => "LEFT",
							"alias" => "EstateWindow",
							"table" => "estate_windows",
							"conditions" => "EstateRoom.estate_room_id=EstateWindow.estate_room_id"
						)
					),
					"conditions" => array(),
					"group" => "EstateRoom.estate_id,EstateWindow.direction"
				),
				$this->EstateRoom
			);
		//物件IDと窓の向きの組み合わせ、及び、その個数をカラムとするテーブルをJOINする
		$estateRoomWindowConditions =
			array(
				array("Estate.estate_id = EstateRoomWindow0.estate_id"),
				array(
					"EstateRoomWindow0.estate_id = EstateRoomWindow1.estate_id",
					"EstateRoomWindow0.n < EstateRoomWindow1.n"
				)
			);
		for ($i = 0; $i < 2; $i++) {
			$options["joins"][] = array(
				"type" => "LEFT",
				"table" => "({$estateRoomWindow})",
				"alias" => "EstateRoomWindow" . $i,
				"conditions" => $estateRoomWindowConditions[$i]
			);
		}
		//最も多い窓の向きを持つ行に絞り込む
		$options["group"][] = "EstateRoomWindow0.estate_id,EstateRoomWindow0.direction HAVING COUNT(EstateRoomWindow1.estate_id) = 0";
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
		//Estateにバーチャルフィールドを作成する
		$this->Estate->virtualFields = array(
			//築年数(本来の値に上書きする形となっている)
			"age" => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-Estate.age/1000,'unixepoch'))-1970",
			//窓の向き
			"direction" => "EstateRoomWindow0.direction",
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
