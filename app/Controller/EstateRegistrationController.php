<?php

/**
 * 物件登録コントローラ
 */
class EstateRegistrationController extends AppController
{
	/**
	 * @var array 扱うモデルのリスト
	 */
	public $uses = array(
		"Estate",
		"EstateAgent",
		"EstateTradingAspect",
		"EstateStructure",
		"EstateType",
		"EstateTvType",
		"EstateInternetType",
		"EstatePicture",
		"EstateCharacteristic",
		"EstateCharacteristicReference",
		"EstateFrankOpinionType",
		"EstateMainFacilities",
		"EstateMainFacilitiesType",
		"EstateMainFacilitiesDistance"
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
	}

	/**
	 * 登録画面
	 */
	public function register()
	{
		if ($this->request->is("post")) {
			for ($i = 0; $i < count($this->request->data["EstatePicture"]); $i++) {
				if ($i == $this->request->data["Estate"]["thumbnail"]) {
					$this->request->data["EstatePicture"][$i]["thumbnail_flag"] = 1;
				} else {
					$this->request->data["EstatePicture"][$i]["thumbnail_flag"] = 0;
				}
			}
			unset($this->request->data["Estate"]["thumbnail"]);

			date_default_timezone_set("Asia/Tokyo"); //タイムゾーンを設定
			$dateTime=new DateTime($this->request->data["Estate"]["age"]);
			$this->request->data["Estate"]["age"]=$dateTime->getTimestamp()*1000;
			for($i=0;$i<count($this->request->data["EstateRoom"]);$i++){
				$dateTime=new DateTime($this->request->data["EstateRoom"][$i]["occupancy_date"]);
				$this->request->data["EstateRoom"][$i]["occupancy_date"]=$dateTime->getTimestamp()*1000;
			}

			$this->Estate->create();
			if ($this->Estate->saveAll($this->request->data, array("deep" => true))) {
				$this->redirect(array("action" => "index"));
			}
			foreach ($this->Estate->validationErrors as $k1 => $v1) {
				foreach ($v1 as $k2 => $v2) {
					foreach ($v2 as $v3) {
						$this->Flash->set($k1 . "." . $k2 . " : " . $v3);
					}
				}
			}
			debug($this->request->data);
		}

		// 不動産業者
		$estateAgentList = array();
		foreach ($this->EstateAgent->find("all") as $estateAgent) {
			$estateAgentList[$estateAgent["EstateAgent"]["estate_agent_id"]] = $estateAgent["EstateAgent"]["name"];
		}
		$this->set("estateAgentList", $estateAgentList);

		// 窓の向き
		$this->set("estateWindowList", array("東","西","南","北"));

		// 取引態様
		$estateTradingAspectList = array();
		foreach ($this->EstateTradingAspect->find("all") as $estateTradingAspect) {
			$estateTradingAspectList[$estateTradingAspect["EstateTradingAspect"]["estate_trading_aspect_id"]] = $estateTradingAspect["EstateTradingAspect"]["name"];
		}
		$this->set("estateTradingAspectList", $estateTradingAspectList);

		// 物件構造
		$estateStructureList = array(-1 => "不明");
		foreach ($this->EstateStructure->find("all") as $estateStructure) {
			$estateStructureList[$estateStructure["EstateStructure"]["estate_structure_id"]] = $estateStructure["EstateStructure"]["name"];
		}
		$this->set("estateStructureList", $estateStructureList);

		// 部屋種別
		$estateTypeList = array(-1 => "不明");
		foreach ($this->EstateType->find("all") as $estateType) {
			$estateTypeList[$estateType["EstateType"]["estate_type_id"]] = $estateType["EstateType"]["name"];
		}
		$this->set("estateTypeList", $estateTypeList);

		// インターネット回線
		$estateInternetTypeList = array(-1 => "不明");
		foreach ($this->EstateInternetType->find("all") as $estateInternetType) {
			$estateInternetTypeList[$estateInternetType["EstateInternetType"]["estate_internet_type_id"]] = $estateInternetType["EstateInternetType"]["name"];
		}
		$this->set("estateInternetTypeList", $estateInternetTypeList);

		// テレビ
		$estateTvTypeList = array(-1 => "不明");
		foreach ($this->EstateTvType->find("all") as $estateTvType) {
			$estateTvTypeList[$estateTvType["EstateTvType"]["estate_tv_type_id"]] = $estateTvType["EstateTvType"]["name"];
		}
		$this->set("estateTvTypeList", $estateTvTypeList);

		// 生の声種別
		$this->set("estateFrankOpinionType", $this->EstateFrankOpinionType->find("all"));

		// 主要施設種別
		$estateMainFacilitiesTypeList = array();
		foreach ($this->EstateMainFacilitiesType->find("all") as $estateMainFacilitiesType) {
			$estateMainFacilitiesTypeList[$estateMainFacilitiesType["EstateMainFacilitiesType"]["estate_main_facilities_type_id"]] = $estateMainFacilitiesType["EstateMainFacilitiesType"]["name"];
		}
		$this->set("estateMainFacilitiesTypeList", $estateMainFacilitiesTypeList);

		// 主要施設
		$estateMainFacilitiesType = $this->EstateMainFacilitiesType->find("all");
		for ($i = 0; $i < count($estateMainFacilitiesType); $i++) {
			$tmp = array();
			for ($j = 0; $j < count($estateMainFacilitiesType[$i]["EstateMainFacilities"]); $j++) {
				$tmp[$estateMainFacilitiesType[$i]["EstateMainFacilities"][$j]["estate_main_facilities_id"]] = $estateMainFacilitiesType[$i]["EstateMainFacilities"][$j]["name"];
			}
			//$tmp['-1']='その他';
			$estateMainFacilitiesType[$i]["EstateMainFacilities"] = $tmp;
		}
		$this->set("estateMainFacilitiesType", $estateMainFacilitiesType);

		// 物件特徴
		$estateCharacteristicList = array();
		foreach ($this->EstateCharacteristic->find("all") as $estateCharacteristic) {
			$estateCharacteristicList[$estateCharacteristic["EstateCharacteristic"]["estate_characteristic_id"]] = $estateCharacteristic["EstateCharacteristic"]["name"];
		}
		$this->set("estateCharacteristicList", $estateCharacteristicList);
	}

	public function index()
	{
		$this->set("estates", $this->Estate->find("all"));
	}
}
