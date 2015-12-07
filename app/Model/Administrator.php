<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * 管理者モデル
 */
class Administrator extends AppModel
{
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "administrator_id";
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"name" => array(
			array(
				"rule" => "alphaNumeric",
				"message" => "英数字しか使用できません。"
			),
			array(
				"rule" => array("maxLength", 10),
				"message" => "10文字以内です。"
			),
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"password" => array(
			array(
				"rule" => "alphaNumeric",
				"message" => "英数字しか使用できません。"
			),
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
		"e_mail_address" => array(
			array(
				"rule" => "email",
				"message" => "Eメールアドレスで用いられる文字しか用いることはできません。"
			),
			array(
				"rule" => array("maxLength", 300),
				"message" => "300文字以内です。"
			),
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		)
	);

	public function beforeSave($options = array()) {
		$this->data['Administrator']['password'] = Security::hash($this->data['Administrator']['password']);
		return true;
	}
}
