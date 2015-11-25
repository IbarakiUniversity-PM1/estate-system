<?php

/**
 * 取引態様モデル
 */
class EstateTradingAspect extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("Estate");
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_trading_aspect_id";
}
