<?php

/**
 * FlashComponentを拡張するためのコンポーネント
 */
class MyFlashComponent extends Component
{
	/**
	 * @var array 扱うコンポーネントのリスト
	 */
	public $components = array('Flash');

	/**
	 * バリデーションエラーをFlashにセットする
	 * @param $array array バリデーションエラー
	 */
	public function set_validation_error($array)
	{
		$this->_set_validation_error($array);
	}

	/**
	 * バリデーションエラーをFlashにセットする(処理部)
	 * @param $array array バリデーションエラー
	 * @param array $str Flashにセットする文字列
	 */
	private function _set_validation_error($array, $str=array())
	{
		foreach ($array as $k => $v) {
			if(is_int($k) && !is_array($v)){
				$this->Flash->set(join(".",$str)." : ".$v);
			}else {
				$this->_set_validation_error($v,array_merge($str,array($k)));
			}
		}
	}
}
