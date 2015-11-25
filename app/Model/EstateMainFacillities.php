<?php

/**
 * 主要施設モデル
 */
class EstateMainFacillities extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $hasOne = array("EstateMainFacillitiesType");
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("EstateMainFacillitiesDistance");
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array();
}
