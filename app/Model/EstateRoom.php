<?php

/**
 * 部屋モデル
 */
class EstateRoom extends AppModel
{

	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public $belongsTo = array(
		"Estate",
		"EstateType"
	);
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public $hasMany = array("EstateWindow");
	/**
	 * @var array 入力チェックの定義
	 */
	public $validate = array();
	/**
	 * @var string 主キー
	 */
	public $primaryKey = "estate_room_id";

}
