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
		"EstateCharacteristicReference"
	);

	/**
	 * 登録画面
	 */
	public function register()
	{
		// タイトルをセットする
		$this->set("title_for_layout", "物件登録");

		// 不動産業者
		$estateAgentList = array();
		foreach ($this->EstateAgent->find("all") as $estateAgent) {
			$estateAgentList[$estateAgent["EstateAgent"]["estate_agent_id"]] = $estateAgent["EstateAgent"]["name"];
		}
		$this->set("estateAgentList", $estateAgentList);

		// 取引態様
		$estateTradingAspectList = array();
		foreach ($this->EstateTradingAspect->find("all") as $estateTradingAspect) {
			$estateTradingAspectList[$estateTradingAspect["EstateTradingAspect"]["estate_trading_aspect_id"]] = $estateTradingAspect["EstateTradingAspect"]["name"];
		}
		$this->set("estateTradingAspectList", $estateTradingAspectList);

		// 構造
		$estateStructureList = array();
		foreach ($this->EstateStructure->find("all") as $estateStructure) {
			$estateStructureList[$estateStructure["EstateStructure"]["estate_structure_id"]] = $estateStructure["EstateStructure"]["name"];
		}
		$this->set("estateStructureList", $estateStructureList);

		// 部屋種別
		$estateTypeList = array();
		foreach ($this->EstateType->find("all") as $estateType) {
			$estateTypeList[$estateType["EstateType"]["estate_type_id"]] = $estateType["EstateType"]["name"];
		}
		$this->set("estateTypeList", $estateTypeList);

		// インターネット回線
		$estateInternetTypeList = array();
		foreach ($this->EstateInternetType->find("all") as $estateInternetType) {
			$estateInternetTypeList[$estateInternetType["EstateInternetType"]["estate_internet_type_id"]] = $estateInternetType["EstateInternetType"]["name"];
		}
		$this->set("estateInternetTypeList", $estateInternetTypeList);

		// テレビ
		$estateTvTypeList = array();
		foreach ($this->EstateTvType->find("all") as $estateTvType) {
			$estateTvTypeList[$estateTvType["EstateTvType"]["estate_tv_type_id"]] = $estateTvType["EstateTvType"]["name"];
		}
		$this->set("estateTvTypeList", $estateTvTypeList);

		// 物件特徴
		$this->set("estateCharacteristic", $test = $this->EstateCharacteristic->find("all"));
	}

	/**
	 * 登録確認画面
	 */
	public function confirm()
	{
		// タイトルをセットする
		$this->set("title_for_layout", "物件登録確認");

		if ($this->request->is('post')) {
			$this->set("data", $this->request->data);
		}
	}

	/**
	 * 登録完了
	 */
	public function complete()
	{
		if ($this->request->is('post')) {
			$this->Estate->create();
			if ($this->Estate->saveAssociated($this->request->data, array('deep' => true))) {
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function index()
	{
		$this->set('estates', $this->Estate->find('all'));
	}
}

