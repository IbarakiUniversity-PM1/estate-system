<?php

/**
 * テレビ種別モデル
 */
class EstateTvType extends AppModel
{

        public $primaryKey = "estate_tv_type_id"; //主キー設定

	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("Estate");

}
