<?php

/**
 * 物件構造モデル
 */
class EstateStructure extends AppModel
{
	/**
	 * @var array 自分の持つテーブルと、1対多の関係になるテーブルを持つモデル
	 */
	public static $hasMany = array("Estate");
}
