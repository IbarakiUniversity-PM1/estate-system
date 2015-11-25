<?php

/**
 * 物件画像モデル
 */
class EstatePicture extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、多対1の関係になるテーブルを持つモデル
	 */
	public static $hasOne = array("Estate");
	/**
	 * @var array 入力チェックの定義
	 */
	public static $validate = array();
}
