<?php
echo $this->Form->create(
	"Estate",
	array(
		"url" => array("action" => "register"),
		"enctype" => "multipart/form-data"
	)
);
echo $this->Form->input(
	"Estate.name",
	array(
		"label" => "物件名",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.address",
	array(
		"label" => "住所",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.estate_agent_id",
	array(
		"label" => "不動産業者名",
		"type" => "select",
		"options" => array($estateAgentList),
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.rent",
	array(
		"label" => "家賃(円)",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.key_money",
	array(
		"label" => "礼金(円)",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.deposit",
	array(
		"label" => "敷金(円)",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.common_service_pay",
	array(
		"label" => "共益費(円)",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.floor_plan",
	array(
		"label" => "間取り",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.window_direction",
	array(
		"label" => "窓の向き",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.story",
	array(
		"label" => "階建",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.area",
	array(
		"label" => "面積(m&sup2;)",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.contract_period",
	array(
		"label" => "契約期間(年)",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.parking_flag",
	array(
		"label" => "駐車場料金有り",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.parking_fee",
	array(
		"label" => "駐車場料金(円)",
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.estate_trading_aspect_id",
	array(
		"label" => "取引態様",
		"type" => "select",
		"options" => array($estateTradingAspectList),
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.estate_structure_id",
	array(
		"label" => "物件構造",
		"type" => "select",
		"options" => array($estateStructureList),
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.estate_type_id",
	array(
		"label" => "部屋種別",
		"type" => "select",
		"options" => array($estateTypeList),
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.estate_internet_type_id",
	array(
		"label" => "インターネット回線",
		"type" => "select",
		"options" => array($estateInternetTypeList),
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.estate_tv_type_id",
	array(
		"label" => "テレビ",
		"type" => "select",
		"options" => array($estateTvTypeList),
		"div" => false
	)
);
echo $this->Form->input(
	"Estate.floor_plan_picture",
	array(
		"type" => "file",
		"label" => "間取り図(jpeg)",
		"div" => false
	)
);
echo $this->Form->input(
	"EstatePicture.0.picture",
	array(
		"type" => "file",
		"label" => "画像(jpeg)"
	)
);
echo $this->Form->input(
	"EstatePicture.0.thumbnail_flag",
	array("div" => false)
);
echo $this->Form->input(
	"frank_opinion_agent",
	array(
		"rows" => 3,
		"label" => "生の声(不動産業者)",
		"div" => false
	)
);
echo $this->Form->input(
	"frank_opinion_owner",
	array(
		"rows" => 3,
		"label" => "生の声(大家)",
		"div" => false
	)
);
echo $this->Form->input(
	"frank_opinion_resident",
	array(
		"rows" => 3,
		"label" => "生の声(入居者)",
		"div" => false
	)
);
echo $this->Form->input(
	"bath_toilet",
	array(
		"label" => "バストイレ別",
		"div" => false
	)
);
echo $this->Form->input(
	"gas_stove",
	array(
		"label" => "ガスキッチン有り",
		"div" => false
	)
);
echo $this->Form->input(
	"woman_only",
	array(
		"label" => "女性限定",
		"div" => false
	)
);
echo $this->Form->input(
	"student_only",
	array(
		"label" => "学生限定"
	)
);
echo $this->Form->input(
	"room_share",
	array(
		"label" => "ルームシェア可",
		"div" => false
	)
);
echo $this->Form->input(
	"laundry_area",
	array(
		"label" => "洗濯機置き場(室内)",
		"div" => false
	)
);
echo $this->Form->input(
	"air_conditioner",
	array(
		"label" => "エアコン有り",
		"div" => false
	)
);
echo $this->Form->input(
	"elevator",
	array(
		"label" => "エレベータ有り",
		"div" => false
	)
);
echo $this->Form->input(
	"auto_lock",
	array(
		"label" => "オートロック有り",
		"div" => false
	)
);
echo $this->Form->input(
	"interphone",
	array(
		"label" => "インターフォン有り",
		"div" => false
	)
);
echo $this->Form->input(
	"pet_breeding",
	array(
		"label" => "ペット飼育可",
		"div" => false
	)
);
echo $this->Form->input(
	"playing_an_instrument",
	array(
		"label" => "楽器演奏可",
		"div" => false
	)
);
echo $this->Form->end("登録");
?>
