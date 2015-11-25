<?php

/**
 * 不動産業者モデル
 */
class EstateAgent extends AppModel
{

        public $primaryKey = 'estate_agent_id'; //追加: 主キー設定
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("Estate");

}
