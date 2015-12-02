<?php

/**
 * 生の声モデル
 */
class EstateFrankOpinion extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array(
		"Estate",
		"EstateFrankOpinionType"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array(
		"estate_id" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"estate_frank_opinion_type_id" => array(
			array(
				"rule" => "notBlank",
				"required" => "create",
				"message" => "必須項目です。"
			)
		),
		"frank_opinion" => array(
			array(
				"rule" => array("maxLength", 1000),
				"message" => "1000文字以内です。"
			)
		)
	);
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_frank_opinion_id";
}
