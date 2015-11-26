<?php

/**
 * 主要施設種別モデル
 */
class EstateMainFacilitiesType extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("EstateMainFacilities");
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_main_facilities_type_id";
}
