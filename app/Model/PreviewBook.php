<?php

/**
 * 内見予約モデル
 */
class PreviewBook extends AppModel
{
	/**
	 * @var bool テーブルを使うかどうか
	 */
	public $useTable = false;
	/**
	 * @var array 内見予約で扱う情報の定義
	 */
	public $_schema = array(
		'user_name' => array(
			'type' => 'text',
			'length' => 20
		),
		'email_address' => array(
			'type' => 'text',
			'length' => 256
		),
		'tel_number' => array(
			'type' => 'integer',
			'length' => 11
		),
		'preview_date_1' => array(
			'type' => 'date',
		),
		'preview_date_2' => array(
			'type' => 'date',
		),
		'preview_date_3' => array(
			'type' => 'date',
		),
		'estate_id' => array(
			'type' => 'integer'
		)
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
            'user_name' => array(
			array(
				"rule" => array("maxLength", 20),
				"message" => "20文字以内です。"
			),
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
            'email_address' => array(
			array(
				"rule" => array("maxLength", 256),
				"message" => "256文字以内です。"
			),
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
            'tel_number' => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		)
            
        );
}
