<?php

/**
 * インターネット種別モデル
 */
class EstateInternetType extends AppModel
{
        public $primaryKey = "estate_internet_type_id";
	public $hasMany = array("Estate");
}
