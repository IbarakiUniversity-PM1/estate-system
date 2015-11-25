<?php

/**
 * テレビ種別モデル
 */
class EstateTvType extends AppModel
{
        public $primaryKey = "estate_tv_type_id";
	public $hasMany = array("Estate");
}
