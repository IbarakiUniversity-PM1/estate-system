<?php

/**
 * ヘッダーコントローラ
 */
class HeaderController extends AppController
{
	/**
	 * ヘッダー
	 */
	public function head()
	{
		$this->set("loginUser",$this->Auth->user());
		//ヘッダー用エレメントを呼び出す
		$this->render(".." . DS . "Elements" . DS . "header");
	}
}
