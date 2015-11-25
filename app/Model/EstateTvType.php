<?php

/**
 * テレビ種別モデル
 */
class EstateTvType extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("Estate");
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_tv_type_id";
}
