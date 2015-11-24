<?php

/**
 * 物件画像モデル
 */
class EstatePicture extends AppModel
{
	public static $hasOne = array("Estate");
	public static $validate = array();
}
