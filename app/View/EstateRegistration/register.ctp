<?php
$this->Html->css("estate_registration/register", array("inline" => false));
$this->Html->script("estate_registration/register", array("inline" => false));
echo $this->Form->create(
	"Estate",
	array(
		"url" => array(
			"controller" => "EstateRegistration",
			"action" => "confirm"
		),
		"enctype" => "multipart/form-data"
	)
);
echo $this->Form->input(
	"Estate.name",
	array("label" => "物件名")
);
echo $this->Form->input(
	"Estate.address",
	array("label" => "住所")
);
echo $this->Form->input(
	"Estate.estate_agent_id",
	array(
		"label" => "不動産業者名",
		"type" => "select",
		"options" => array($estateAgentList)
	)
);
echo $this->Form->input(
	"Estate.rent",
	array("label" => "家賃(円)")
);
echo $this->Form->input(
	"Estate.deposit",
	array("label" => "敷金(円)")
);
echo $this->Form->input(
	"Estate.key_money",
	array("label" => "礼金(円)")
);
echo $this->Form->input(
	"Estate.common_service_pay",
	array("label" => "共益費(円)")
);
echo $this->Form->input(
	"Estate.floor_plan",
	array("label" => "間取り")
);
echo $this->Form->input(
	"Estate.window_direction",
	array("label" => "窓の向き")
);
echo $this->Form->input(
	"Estate.story",
	array("label" => "階建")
);
echo $this->Form->input(
	"Estate.area",
	array("label" => "面積(m&sup2;)")
);
echo $this->Form->input(
	"Estate.contract_period",
	array("label" => "契約期間(年)")
);
echo $this->Form->input(
	"Estate.parking_flag",
	array("label" => "駐車場")
);
echo $this->Form->input(
	"Estate.parking_fee",
	array(
		"label" => "駐車場料金(円)",
		"div" => array("id" => "EstateParkingFeeDiv")
	)
);
echo $this->Form->input(
	"Estate.estate_trading_aspect_id",
	array(
		"label" => "取引態様",
		"type" => "select",
		"options" => array($estateTradingAspectList)
	)
);
echo $this->Form->input(
	"Estate.estate_structure_id",
	array(
		"label" => "物件構造",
		"type" => "select",
		"options" => array($estateStructureList)
	)
);
echo $this->Form->input(
	"Estate.estate_type_id",
	array(
		"label" => "部屋種別",
		"type" => "select",
		"options" => array($estateTypeList)
	)
);
echo $this->Form->input(
	"Estate.estate_internet_type_id",
	array(
		"label" => "インターネット回線",
		"type" => "select",
		"options" => array($estateInternetTypeList)
	)
);
echo $this->Form->input(
	"Estate.estate_tv_type_id",
	array(
		"label" => "テレビ",
		"type" => "select",
		"options" => array($estateTvTypeList)
	)
);
echo $this->Html->div("label", "間取り図(jpeg)");
?>
<table>
	<thead>
	<?php echo $this->Html->tableHeaders(
			array(
				"プレビュー",
				"ファイル名"
			)
		) . PHP_EOL ?>
	</thead>
	<tbody>
	<?php echo $this->Html->tablecells(
			array(
				$this->Html->div(
					"previews",
					"指定なし"
				),
				$this->Form->input(
					"Estate.floor_plan_picture",
					array(
						"type" => "file",
						"label" => false,
						"div" => false
					)
				)
			)
		) . PHP_EOL ?>
	</tbody>
</table>
<?php echo $this->Html->div("label", "物件画像(jpeg)") ?>
<table id="estate_pictures">
	<thead>
	<?php echo $this->Html->tableHeaders(
			array(
				"サムネイル",
				"プレビュー",
				"ファイル名"
			)
		) . PHP_EOL ?>
	</thead>
	<tbody>
	<?php echo $this->Html->tablecells(
			array(
				$this->Form->input(
					"EstatePicture.0.thumbnail_flag",
					array(
						"label" => false,
						"div" => false)
				),
			$this->Html->div(
				"previews",
				"指定なし"
			),
				$this->Form->input(
					"EstatePicture.0.picture",
					array(
						"type" => "file",
						"label" => false,
						"div" => false
					)
			)
			)
		) . PHP_EOL ?>
	</tbody>
</table>
<?php
echo $this->Form->input(
	"frank_opinion_agent",
	array(
		"rows" => 3,
		"label" => "生の声(不動産業者)"
	)
);
echo $this->Form->input(
	"frank_opinion_owner",
	array(
		"rows" => 3,
		"label" => "生の声(大家)"
	)
);
echo $this->Form->input(
	"frank_opinion_resident",
	array(
		"rows" => 3,
		"label" => "生の声(入居者)"
	)
);
echo $this->Form->input(
	"bath_toilet",
	array("label" => "バストイレ別")
);
echo $this->Form->input(
	"gas_stove",
	array("label" => "ガスキッチン有り")
);
echo $this->Form->input(
	"woman_only",
	array("label" => "女性限定")
);
echo $this->Form->input(
	"student_only",
	array("label" => "学生限定")
);
echo $this->Form->input(
	"room_share",
	array("label" => "ルームシェア可")
);
echo $this->Form->input(
	"laundry_area",
	array("label" => "洗濯機置き場(室内)")
);
echo $this->Form->input(
	"air_conditioner",
	array("label" => "エアコン有り")
);
echo $this->Form->input(
	"elevator",
	array("label" => "エレベータ有り")
);
echo $this->Form->input(
	"auto_lock",
	array("label" => "オートロック有り")
);
echo $this->Form->input(
	"interphone",
	array("label" => "インターフォン有り")
);
echo $this->Form->input(
	"pet_breeding",
	array("label" => "ペット飼育可")
);
echo $this->Form->input(
	"playing_an_instrument",
	array("label" => "楽器演奏可")
);
echo $this->Html->div(
	"buttons",
	$this->Form->submit("登録")
);
$this->Form->end();
?>
