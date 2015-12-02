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
		"EstatePicture" => array(
			'className' => 'EstatePicture',
			'foreignKey' => 'estate_id',
			'dependent' => true
		),
		"EstateRoom"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"estate_trading_aspect_id" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"estate_agent_id" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"name" => array(
			array(
				"rule" => array("maxLength", 50),
				"message" => "50文字以内です。"
			),
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"address" => array(
			array(
				"rule" => array("maxLength", 100),
				"message" => "100文字以内です。"
			),
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"rent" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"deposit" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"key_money" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"common_service_pay" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"parking_flag" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"area" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"floor_plan" => array(
			array(
				"rule" => "alphaNumeric",
				"message" => "英数字しか使用できません。"
			),
			array(
				"rule" => array("maxLength", 5),
				"message" => "5文字以内です。"
			),
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"story" => array(
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"floor_plan_picture_name" => array(
			array(
				"rule" => array("maxLength", 100),
				"message" => "100文字以内です。"
			),
			array(
				"rule" => "notEmpty",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"window_direction" => array(
			array(
				"rule" => array("maxLength", 5),
				"message" => "5文字以内です。"
			)
		)
	);
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_id";
	/**
	 * @var array 扱うビヘイビアのリスト
	 */
	public $actsAs = array(
		'UploadPack.Upload' => array(
			//ここでは、"_file_name"を除いたカラム名を書く
			'floor_plan_picture' => array(
				'quality' => 75, //画質指定、デフォルトでは75
				'styles' => array('thumb' => '85x85') //リサイズしたいサイズを書く
			)
		)
	);
}
