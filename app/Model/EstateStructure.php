<?php

/**
 * 物件構造モデル
 */
class EstateStructure extends AppModel
{
        public $primaryKey = "estate_structure_id";
	public $hasMany = array("Estate");
}
