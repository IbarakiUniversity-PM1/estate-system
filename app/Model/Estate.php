<?php

/**
 * 物件モデル
 */
class Estate extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $hasOne = array(
		"EstateTradingAspect",
		"EstateStructure",
		"EstateTvType",
		"EstateAgent",
		"EstateInternetType"
	);
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array(
		"EstateCharacteristicReference",
		"EstateFrankOpinion",
		"MainFacillitiesDistance",
		"EstatePicture",
		"EstateRoom"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array();
}

