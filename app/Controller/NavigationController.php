<?php

/**
 * 物件検索条件指定・提供不動産業者コントローラ
 */
class NavigationController extends AppController
{
	/**
	 * @var array 扱うモデルのリスト
	 */
	public $uses = array("EstateAgent");

	/**
	 * 物件検索条件指定・提供不動産業者を表示
	 */
	public function nav()
	{
		//呼び出すテーブルを不動産業者テーブルに限定
		$this->EstateAgent->recursive = -1;
		//不動産業者テーブルの内容を取得し、$estate_agentsにセット
		$this->set("estate_agents", $this->EstateAgent->find("all"));
		//物件検索条件指定・提供不動産業者用エレメントを呼び出す
		$this->render(".." . DS . "Elements" . DS . "nav");
	}
}
