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
		"EstateCharacteristicReference" => array('dependent' => true),
		"EstateFrankOpinion" => array('dependent' => true),
		"EstateMainFacilitiesDistance" => array('dependent' => true),
		"EstatePicture",
		"EstateRoom" => array('dependent' => true)
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"estate_trading_aspect_id" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"estate_agent_id" => array(
			array(
				"rule" => "notBlank",
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
				"rule" => "notBlank",
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
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"rent" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			),
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("maxLength", 8),
				"message" => "8桁以内です。"
			)
		),
		"deposit" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			),
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("maxLength", 8),
				"message" => "8桁以内です。"
			)
		),
		"key_money" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			),
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("maxLength", 8),
				"message" => "8桁以内です。"
			)
		),
		"common_service_pay" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			),
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("maxLength", 8),
				"message" => "8桁以内です。"
			)
		),
		"parking_flag" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"parking_fee" => array(
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("minLength", 1),
				"message" => "1桁以上です。"
			),
                        array(
				"rule" => array("maxLength", 8),
				"message" => "8桁以内です。"
			)
		),
		"area" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			),
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("maxLength", 2),
				"message" => "2桁以内です。"
			)
		),
		"floor_plan" => array(
			array(
				"rule" => "alphaNumeric",
				"message" => "英数字しか使用できません。"
			),
			array(
				"rule" => "halfLetter",
				"message" => "半角文字しか使用できません。"
			),
			array(
				"rule" => array("maxLength", 5),
				"message" => "5文字以内です。"
			),
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"story" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			),
			array(
				'rule' => array('naturalNumber', false),
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("maxLength", 2),
				"message" => "2桁以内です。"
			)
		),
		"window_direction" => array(
			array(
				"rule" => array("maxLength", 5),
				"message" => "5文字以内です。"
			)
		),
		"contract_period" => array(
			array(
				'rule' => array('naturalNumber', true), // 0(ゼロ)を許可
				'message' => '自然数を入力してください。'
			),
                        array(
				"rule" => array("maxLength", 2),
				"message" => "2桁以内です。"
			)
		),
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
				'styles' => array('thumb' => '85w'), //リサイズしたいサイズを書く
				'path' => ':webroot/upload/:model/:id/:style_:basename.:extension'
			)
		)
	);
}
