<?php

/**
 * 取引態様モデル
 */
class EstateTradingAspect extends AppModel
{
        public $primaryKey = "estate_trading_aspect_id"; //追加: 主キー設定
	public $hasMany = array("Estate"); //編集: static外す
}
