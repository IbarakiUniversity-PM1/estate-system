<?php

/**
 * 検索条件指定・提供不動産業者コントローラ
 */
class NavigationController extends AppController
{
	/**
	 * 検索条件指定・提供不動産業者
	 */
	public function nav()
	{
		//検索条件指定・提供不動産業者用エレメントを呼び出す
		$this->render('../Elements/nav');
	}
}
