<?php

/**
 * 生の声モデル
 */
class EstateFrankOpinion extends AppModel
{
	public static $hasOne = array("Estate", "EstateFrankOpinionType");
	public static $validate = array();
}
