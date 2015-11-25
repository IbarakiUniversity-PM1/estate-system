<?php

/**
 * 主要施設種別モデル
 */
class EstateMainFacillitiesType extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("EstateMainFacillities");
}
