<?php
$this->Html->css("estate_management".DS."register", array("inline" => false));
$this->Html->scriptStart(array("inline" => false));
if(isset($data)){ ?>
	$isRegister=false;
<?php }else{ ?>
	$isRegister=true;
<?php }
$this->Html->scriptEnd();
$this->Html->script("estate_management".DS."register", array("inline" => false));

echo $this->Form->create(
	"Estate",
	array("enctype" => "multipart/form-data")
);
if(isset($data)){
	echo $this->Form->hidden(
		"Estate.estate_id",
		array("value" => $data["Estate"]["estate_id"])
	);
}
$options=array();
$options["label"]="物件名";
if(isset($data)){
	$options["value"]=$data["Estate"]["name"];
}
echo $this->Form->input(
	"Estate.name",
	$options
);
$options=array();
$options["label"]="住所";
if(isset($data)){
	$options["value"]=$data["Estate"]["address"];
}
echo $this->Form->input(
	"Estate.address",
	$options
);
$options=array();
$options["type"]="select";
$options["label"]="不動産業者名";
$options["options"]=array($estateAgentList);
if(isset($data)){
	$options["value"]=$data["Estate"]["estate_agent_id"];
}
echo $this->Form->input(
	"Estate.estate_agent_id",
	$options
);
$options=array();
$options["label"]="家賃(円)";
if(isset($data)){
	$options["value"]=$data["Estate"]["rent"];
}
echo $this->Form->input(
	"Estate.rent",
	$options
);
$options=array();
$options["label"]="敷金(円)";
if(isset($data)){
	$options["value"]=$data["Estate"]["deposit"];
}
echo $this->Form->input(
	"Estate.deposit",
	$options
);
$options=array();
$options["label"]="礼金(円)";
if(isset($data)){
	$options["value"]=$data["Estate"]["key_money"];
}
echo $this->Form->input(
	"Estate.key_money",
	$options
);
$options=array();
$options["label"]="共益費(円)";
if(isset($data)){
	$options["value"]=$data["Estate"]["common_service_pay"];
}
echo $this->Form->input(
	"Estate.common_service_pay",
	$options
);
$options=array();
$options["label"]="間取り";
if(isset($data)){
	$options["value"]=$data["Estate"]["floor_plan"];
}
echo $this->Form->input(
	"Estate.floor_plan",
	$options
);
$options=array();
$options["label"]="階建";
if(isset($data)){
	$options["value"]=$data["Estate"]["story"];
}
echo $this->Form->input(
	"Estate.story",
	$options
);
$options=array();
$options["label"]="面積(畳)";
if(isset($data)){
	$options["value"]=$data["Estate"]["area"];
}
echo $this->Form->input(
	"Estate.area",
	$options
);
$options=array();
$options["type"]="text";
$options["label"]="築年月";
if(isset($data["Estate"]["age"])){
	$options["value"]=$data["Estate"]["age"];
}
echo $this->Form->input(
	"Estate.age",
	$options
);
$options=array();
$options["label"]="契約期間(年)";
if(isset($data["Estate"]["contract_period"])){
	$options["value"]=$data["Estate"]["contract_period"];
}
echo $this->Form->input(
	"Estate.contract_period",
	$options
);
$options=array();
$options["label"]="駐車場";
if(isset($data) && $data["Estate"]["parking_flag"]){
	$options["checked"]=true;
}
echo $this->Form->input(
	"Estate.parking_flag",
	$options
);
$options=array();
$options["label"]="駐車場料金(円)";
$options["div"]=array("id" => "EstateParkingFeeDiv");
if(isset($data)){
	$options["value"]=$data["Estate"]["parking_fee"];
}
echo $this->Form->input(
	"Estate.parking_fee",
	$options
);
$options=array();
$options["type"]="select";
$options["label"]="窓の向き";
$options["options"]=$estateWindowList;
if(isset($data)){
	$options["value"]=$data["Estate"]["window_direction"];
}
echo $this->Form->input(
	"Estate.window_direction",
	$options
);
$options=array();
$options["type"]="select";
$options["label"]="取引態様";
$options["options"]=array($estateTradingAspectList);
if(isset($data)){
	$options["value"]=$data["Estate"]["estate_trading_aspect_id"];
}
echo $this->Form->input(
	"Estate.estate_trading_aspect_id",
	$options
);
$options=array();
$options["type"]="select";
$options["label"]="物件構造";
$options["options"]=array($estateStructureList);
if(isset($data["Estate"]["estate_structure_id"])){
	$options["value"]=$data["Estate"]["estate_structure_id"];
}
echo $this->Form->input(
	"Estate.estate_structure_id",
	$options
);
$options=array();
$options["type"]="select";
$options["label"]="インターネット回線";
$options["options"]=array($estateInternetTypeList);
if(isset($data["Estate"]["estate_internet_type_id"])){
	$options["value"]=$data["Estate"]["estate_internet_type_id"];
}
echo $this->Form->input(
	"Estate.estate_internet_type_id",
	$options
);
$options=array();
$options["type"]="select";
$options["label"]="テレビ";
$options["options"]=array($estateTvTypeList);
if(isset($data["Estate"]["estate_tv_type_id"])){
	$options["value"]=$data["Estate"]["estate_tv_type_id"];
}
echo $this->Form->input(
	"Estate.estate_tv_type_id",
	$options
);
echo $this->Form->label("Estate.floor_plan_picture", "間取り図(jpeg)");
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
	<?php
	if(isset($data)){
		$html=$this->Upload->uploadImage($data["Estate"],"Estate.floor_plan_picture",array("style"=>"thumb"));
	}else{
		$html="指定なし";
	}
	echo $this->Html->tablecells(
			array(
				$this->Html->div(
					"previews",
					$html
				),
				$this->Form->file(
					"Estate.floor_plan_picture",
					array("label" => false)
				)
			)
		) . PHP_EOL ?>
	</tbody>
</table>
<?php
echo $this->Html->div("label", "物件画像(jpeg)");
for ($i = 0; $i < 2; $i++) { ?>
	<table <?php
	if ($i == 0) {
		echo "class=\"model\" ";
	}
	echo "id=\"estate_pictures";
	if ($i == 0) {
		echo "_model";
	}
	echo "\"";
	?>>
		<?php if ($i == 1) { ?>
			<thead>
			<?php echo $this->Html->tableHeaders(
					array(
						"サムネイル",
						"プレビュー",
						"ファイル名",
						""
					)
				) . PHP_EOL ?>
			</thead>
		<?php } ?>
		<tbody>
		<?php
		$options = array(
			"label" => false,
			"type" => "radio",
			"options" => array(0 => null)
		);
		if ($i == 1) {
			$options["value"] = 0;
		}
		echo $this->Html->tablecells(
				array(
					$this->Form->input(
						"Estate.thumbnail",
						$options
					),
					$this->Html->div(
						"previews",
						"指定なし"
					),
					$this->Form->file(
						"EstatePicture.?.picture",
						array(
							"label" => false,
							"required" => false
						)
					),
					$this->Form->button(
						"削除",
						array("type" => "button")
					)
				)
			) . PHP_EOL ?>
		</tbody>
	</table>
	<?php
}
echo $this->Html->div("label", "生の声");
for ($i = 0; $i < 2; $i++) { ?>
	<table <?php
	if ($i == 0) {
		echo "class=\"model\" ";
	}
	echo "id=\"estate_frank_opinions";
	if ($i == 0) {
		echo "_model";
	}
	echo "\"";
	?>>
		<?php if ($i == 1) { ?>
			<thead>
			<?php echo $this->Html->tableHeaders(
					array(
						"種類",
						"内容",
						""
					)
				) . PHP_EOL ?>
			</thead>
		<?php } ?>
		<tbody>
		<?php
		for ($j = 0; $j < count($estateFrankOpinionType); $j++) {
			$cells = array();
			if ($i == 1 && $estateFrankOpinionType[$j]["EstateFrankOpinionType"]["name"] != "入居者") {
				$cells[] = $estateFrankOpinionType[$j]["EstateFrankOpinionType"]["name"] . PHP_EOL .
					$this->Form->hidden(
						"EstateFrankOpinion.?.estate_frank_opinion_type_id",
						array(
							"value" => $estateFrankOpinionType[$j]["EstateFrankOpinionType"]["estate_frank_opinion_type_id"],
							"class" => "estateFrankOpinionTypeId"
						)
					);
			} else if ($estateFrankOpinionType[$j]["EstateFrankOpinionType"]["name"] == "入居者") {
				$cells[] = "入居者" . PHP_EOL .
					$this->Form->hidden(
						"EstateFrankOpinion.?.estate_frank_opinion_type_id",
						array(
							"value" => $estateFrankOpinionType[$j]["EstateFrankOpinionType"]["estate_frank_opinion_type_id"],
							"class" => "estateFrankOpinionTypeId"
						)
					);
			}
			if ($i == 1 || $estateFrankOpinionType[$j]["EstateFrankOpinionType"]["name"] == "入居者") {
				$cells[] = $this->Form->input(
					"EstateFrankOpinion.?.frank_opinion",
					array(
						"rows" => 3,
						"label" => false
					)
				);
				if ($estateFrankOpinionType[$j]["EstateFrankOpinionType"]["name"] == "入居者") {
					$cells[] = $this->Form->button(
							"追加",
							array(
								"class" => "estate_frank_opinion_add",
								"type" => "button"
							)
						) . PHP_EOL .
						$this->Form->button(
							"削除",
							array(
								"class" => "estate_frank_opinion_delete",
								"type" => "button"
							)
						);
				} else {
					$cells[] = "";
				}
				echo $this->Html->tablecells($cells) . PHP_EOL;
			}
		} ?>
		</tbody>
	</table>
	<?php
}
echo $this->Html->div("label", "主要施設までの距離");
?>
<table id="estate_main_facilities">
	<thead>
	<?php echo $this->Html->tableHeaders(
			array(
				"種別",
				"名称",
				"距離(m)"
			)
		) . PHP_EOL ?>
	</thead>
	<tbody>
	<?php
	for ($j = 0; $j < count($estateMainFacilitiesType); $j++) {
		echo $this->Html->tablecells(
				array(
					$estateMainFacilitiesType[$j]["EstateMainFacilitiesType"]["name"] . PHP_EOL .
					$this->Form->hidden(
						"EstateMainFacilities.?.estate_main_facilities_type_id",
						array(
							"value" => $estateMainFacilitiesType[$j]["EstateMainFacilitiesType"]["estate_main_facilities_type_id"],
							"class" => "estateMainFacilitiesTypeId"
						)
					),
					$this->Form->input(
						"EstateMainFacilitiesDistance.?.estate_main_facilities_id",
						array(
							"type" => "select",
							"options" => $estateMainFacilitiesType[$j]["EstateMainFacilities"],
							"label" => false
						)
					),
					$this->Form->input(
						"EstateMainFacilitiesDistance.?.distance",
						array("label" => false)
					)
				)
			) . PHP_EOL;
	} ?>
	</tbody>
</table>
<?php
echo $this->Html->div("label", "部屋");
for ($i = 0; $i < 2; $i++) { ?>
	<table <?php
	if ($i == 0) {
		echo "class=\"model\" ";
	}
	echo "id=\"estate_room";
	if ($i == 0) {
		echo "_model";
	}
	echo "\"";
	?>>
		<?php if ($i == 1) { ?>
			<thead>
			<?php echo $this->Html->tableHeaders(
					array(
						"種別",
						"部屋番号",
						"入居可能時期",
						"角部屋",
						"契約済みフラグ",
						""
					)
				) . PHP_EOL ?>
			</thead>
		<?php } ?>
		<tbody>
		<?php
		echo $this->Html->tablecells(
				array(
					$this->Form->input(
						"EstateRoom.?.estate_type_id",
						array(
							"class"=>"estate_room_estate_type_id",
							"type" => "select",
							"options" => array($estateTypeList),
							"label" => false
						)
					),
					$this->Form->input(
						"EstateRoom.?.room_number",
						array(
							"class"=>"estate_room_room_number",
							"label" => false
						)
					),
					$this->Form->input(
						"EstateRoom.?.occupancy_date",
						array(
							"class"=>"estate_room_occupancy_date",
							"type" => "text",
							"label" => false
						)
					),
					$this->Form->input(
						"EstateRoom.?.corner_suite_flag",
						array(
							"class"=>"estate_room_corner_suite_flag",
							"label" => false
						)
					),
					$this->Form->input(
						"EstateRoom.?.contracted_flag",
						array(
							"class"=>"estate_room_contracted_flag",
							"label" => false
						)
					),
					$this->Form->button(
						"追加",
						array(
							"class" => "estate_room_add",
							"type" => "button"
						)
					) . PHP_EOL .
					$this->Form->button(
						"削除",
						array(
							"class" => "estate_room_delete",
							"type" => "button"
						)
					)
				)
			) . PHP_EOL;
		?>
		</tbody>
	</table>
	<?php
}
$options=array();
$options["label"]="物件特徴";
$options["div"]=array("id" => "estate_characteristic_reference");
$options["type"]="select";
$options["multiple"]="checkbox";
$options["options"]=array($estateCharacteristicList);
if(isset($data["EstateCharacteristicReference"])){
	$options["value"]=$data["EstateCharacteristicReference"];
}
echo $this->Form->input(
	"EstateCharacteristicReference.estate_characteristic_id",
	$options
) ?>
<h3>上記の内容でよろしいですか？</h3>
<?php
echo $this->Html->div(
	"buttons",
	$this->Html->div(
		"",
		$this->Form->button(
			"",
			array(
				"id" => "register",
				"type" => "button"
			)
		)
	) . PHP_EOL .
	$this->Form->submit(
		"はい"
	) . PHP_EOL .
	$this->Html->div(
		"",
		$this->Form->button(
			"",
			array(
				"id" => "back",
				"type" => "button"
			)
		)
	)
);
$this->Form->end();
?>
