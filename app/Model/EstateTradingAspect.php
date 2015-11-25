<?php

/**
 * 取引態様モデル
 */
class EstateTradingAspect extends AppModel
{

        public $primaryKey = "estate_trading_aspect_id"; //追加: 主キー設定

	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("Estate");

}
