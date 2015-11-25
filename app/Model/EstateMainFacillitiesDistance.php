<?php

/**
 * 距離モデル
 */
class EstateMainFacillitiesDistance extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $hasOne = array(
		"Estate",
		"EstateMainFacillities"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array();
}
