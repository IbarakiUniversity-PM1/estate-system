<?php

/**
 * 物件画像モデル
 */
class EstatePicture extends AppModel
{
        public $hasOne = array("Estate");
	public $validate = array();
}
