<?php

/**
 * 生の声モデル
 */
class EstateFrankOpinion extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $hasOne = array(
		"Estate",
		"EstateFrankOpinionType"
	);
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array();
}
