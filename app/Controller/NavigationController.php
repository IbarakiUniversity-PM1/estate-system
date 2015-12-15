<?php

/**
 * 物件検索条件指定・提供不動産業者コントローラ
 */
class NavigationController extends AppController
{
	/**
	 * @var array 扱うモデルのリスト
	 */
	public $uses = array(
		"EstateAgent",
		"EstateCharacteristic"
	);

	/**
	 * 物件検索条件指定・提供不動産業者を表示
	 */
	public function nav()
	{
		//窓の向きを$estateWindowListにセット
		$this->set(
			"estateWindowList",
			array(
				"東"=>"東",
				"西"=>"西",
				"南"=>"南",
				"北"=>"北"
			)
		);

		//物件特徴テーブルの内容を取得し、$estateCharacteristicListにセット
		$estateCharacteristicList = array();
		foreach ($this->EstateCharacteristic->find("all") as $estateCharacteristic) {
			$estateCharacteristicList[$estateCharacteristic["EstateCharacteristic"]["estate_characteristic_id"]] = $estateCharacteristic["EstateCharacteristic"]["name"];
		}
		$this->set("estateCharacteristicList", $estateCharacteristicList);

		//キーワード検索種別を$estateKeywordTypeListにセット
		$this->set(
			"estateKeywordTypeList",
			array(
				"data[Estate][name]"=>"物件名",
				"data[Estate][address]"=>"住所",
				"data[EstateAgent][name]"=>"不動産業者名"
			)
		);

		//呼び出すテーブルを不動産業者テーブルに限定
		$this->EstateAgent->recursive = -1;

		//不動産業者テーブルの内容を取得し、$estateAgentにセット
		$this->set("estateAgent", $this->EstateAgent->find("all"));

		//物件検索条件指定・提供不動産業者用エレメントを呼び出す
		$this->render(".." . DS . "Elements" . DS . "nav");
	}
}
