<?php

/**
 * 生の声種別モデル
 */
class EstateFrankOpinionType extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("EstateFrankOpinion");
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_frank_opinion_type_id";
}
