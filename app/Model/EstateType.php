<?php

/**
 * 部屋種別モデル
 */
class EstateType extends AppModel
{
        public $primaryKey = "estate_type_id";
	public $hasMany = array("EstateRoom");
}
