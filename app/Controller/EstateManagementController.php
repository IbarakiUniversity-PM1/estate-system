<?php

/**
 * 物件管理コントローラ
 */
class EstateManagementController extends AppController
{
	/**
	 * @var array 扱うヘルパーのリスト
	 */
	public $helpers = array("UploadPack.Upload");
	/**
	 * @var array 扱うモデルのリスト
	 */
	public $uses = array(
		"Estate",
		"EstateAgent",
		"EstateCharacteristic",
		"EstateCharacteristicReference",
		"EstateFrankOpinion",
		"EstateFrankOpinionType",
		"EstateInternetType",
		"EstateMainFacilitiesType",
		"EstatePicture",
		"EstateRoom",
		"EstateStructure",
		"EstateTradingAspect",
		"EstateTvType",
		"EstateType"
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
	}

	/**
	 * 物件登録
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

			$this->request->data["Estate"]["age"]=$this->Date->toTimestamp($this->request->data["Estate"]["age"]);

			$this->Estate->create();
			if ($this->Estate->saveAll($this->request->data, array("deep" => true))) {
				$this->redirect(
					array(
						"controller" => "EstateView",
						"action" => "estateList"
					)
				);
			}
			$this->MyFlash->set_validation_error($this->Estate->validationErrors);
		}

		// 不動産業者
		$estateAgentList = array();
		foreach ($this->EstateAgent->find("all") as $estateAgent) {
			$estateAgentList[$estateAgent["EstateAgent"]["estate_agent_id"]] = $estateAgent["EstateAgent"]["name"];
		}
		$this->set("estateAgentList", $estateAgentList);

		// 窓の向き
		$this->set(
			"estateWindowList",
			array(
				"東"=>"東",
				"西"=>"西",
				"南"=>"南",
				"北"=>"北"
			)
		);

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
			//$tmp["-1"]="その他";
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

	/**
	 * 物件編集
	 * @param null $estate_id 物件ID
	 */
	public function edit($estate_id=null){
		if ($this->request->is("post")) {
			$options=array("EstatePicture.estate_id=".$estate_id);
			if(isset($this->request->data["EstatePicture"])) {
				foreach ($this->request->data["EstatePicture"] as $e) {
					if(isset($e["estate_picture_id"])){
						$options[] = "EstatePicture.estate_picture_id!=" . $e["estate_picture_id"];
					}
				}
			}
			$this->EstatePicture->deleteAll($options);

			$options=array("EstateFrankOpinion.estate_id=".$estate_id);
			if(isset($this->request->data["EstateFrankOpinion"])) {
				foreach ($this->request->data["EstateFrankOpinion"] as $e) {
					if(isset($e["estate_frank_opinion_id"])){
						$options[] = "EstateFrankOpinion.estate_frank_opinion_id!=" . $e["estate_frank_opinion_id"];
					}
				}
			}
			$this->EstateFrankOpinion->deleteAll($options);

			$options=array("EstateRoom.estate_id=".$estate_id);
			if(isset($this->request->data["EstateRoom"])) {
				foreach ($this->request->data["EstateRoom"] as $e) {
					if(isset($e["estate_room_id"])){
						$options[] = "EstateRoom.estate_room_id!=" . $e["estate_room_id"];
					}
				}
			}
			$this->EstateRoom->deleteAll($options);

			$options=array("EstateCharacteristicReference.estate_id=".$estate_id);
			if(isset($this->request->data["EstateCharacteristicReference"])) {
				foreach ($this->request->data["EstateCharacteristicReference"] as $e) {
					if(isset($e["estate_characteristic_reference_id"])){
						$options[] = "EstateCharacteristicReference.estate_characteristic_reference_id!=" . $e["estate_characteristic_reference_id"];
					}
				}
			}
			$this->EstateCharacteristicReference->deleteAll($options);
		}
		$this->register();
		$this->Estate->id=$estate_id;
		$data = $this->Estate->read();
		if(isset($data["Estate"]["age"])){
			$data["Estate"]["age"]=$this->Date->toDateString($data["Estate"]["age"]);
		}
		for($i=0;isset($data["EstateRoom"]) && $i<count($data["EstateRoom"]);$i++){
			$data["EstateRoom"][$i]["occupancy_date"]=$this->Date->toDateString($data["EstateRoom"][$i]["occupancy_date"]);
		}
		if(isset($data["EstateCharacteristicReference"])){
			$tmp=array();
			for($i=0;$i<count($data["EstateCharacteristicReference"]);$i++){
				$tmp[]=$data["EstateCharacteristicReference"][$i]["estate_characteristic_id"];
			}
			$data["EstateCharacteristicReference"]=$tmp;
		}
		$this->set("data", $data);
		$this->render("register");
	}

	/**
	 * 物件削除
	 * @param null $estate_id 物件ID
	 */
	public function delete($estate_id = null)
	{
		if ($this->request->is("post") && $estate_id!=null) {
			$isFail=!$this->Estate->delete($estate_id);
			if(!$isFail){
				foreach($this->EstatePicture->find("list",array("fields"=>"EstatePicture.estate_picture_id","conditions"=>"EstatePicture.estate_id=".$estate_id)) as $e){
					if(!$this->EstatePicture->delete($e)){
						$isFail=true;
						break;
					}
				}
			}
			if($isFail){
				$this->Flash->set("正常に物件を削除できませんでした。");
			}
			$this->redirect(
				array(
					"controller" => "EstateView",
					"action" => "estateList"
				)
			);
		}
	}
}
