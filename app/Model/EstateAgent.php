<?php

/**
 * 不動産業者モデル
 */
class EstateAgent extends AppModel
{
        public $primaryKey = 'estate_agent_id'; //追加: 主キー設定
	public $hasMany = array("Estate"); //編集: static外した
}
