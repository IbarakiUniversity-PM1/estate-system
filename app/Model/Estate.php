<?php

/**
 * 物件モデル
 */
class Estate extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array(
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
		"EstateMainFacilitiesDistance",
		"EstatePicture",
		"EstateRoom"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array();
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_id";

	public $actsAs = array(
		'UploadPack.Upload' => array(
			'floor_plan_picture' => array(     //ここでは、"_file_name"を除いたカラム名を書く
				'quality' => 95,  //画質指定、デフォルトでは75
				'styles' => array(
					'thumb' => '85x85' //リサイズしたいサイズを書く
				)
			)
		)
	);
}

