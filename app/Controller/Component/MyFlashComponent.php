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
	 * @param null $str Flashにセットする内容
	 */
	public function set_validation_error($array, $str=null)
	{
		foreach ($array as $k => $v) {
			if(is_array($v)){
				$this->set_validation_error($v,$str.$k.".");
			}else{
				$this->Flash->set($str.$k." : ".$v);
			}
		}
	}
}
