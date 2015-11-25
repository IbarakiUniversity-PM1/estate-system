<?php

/**
 * 内見予約モデル
 */
class PreviewBook extends AppModel
{
	/**
	 * @var bool テーブルを使うかどうか
	 */
	public static $useTable = false;
	/**
	 * @var array 内見予約で扱う情報の定義
	 */
	public static $_schema = array();
	/**
	 * @var array 入力チェックの定義
	 */
	public static $validate = array();
}
