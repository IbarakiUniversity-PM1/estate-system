<?php

/**
 * 部屋種別モデル
 */
class EstateType extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("EstateRoom");
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_type_id";
}
