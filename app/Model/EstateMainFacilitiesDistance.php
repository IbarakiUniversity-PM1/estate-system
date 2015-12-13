<?php

/**
 * 距離モデル
 */
class EstateMainFacilitiesDistance extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array(
		"Estate",
		"EstateMainFacilities"
	);
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_main_facilities_distance_id";
}
