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
		array(
			"value" => $data["Estate"]["estate_id"],
			"class" => "leave_hidden"
		)
	);
}

$options1=array("label"=>"物件名");
if(isset($data)){
	$options1["value"]=$data["Estate"]["name"];
}
echo $this->Form->input(
	"Estate.name",
	$options1
);

$options1=array("label"=>"住所");
if(isset($data)){
	$options1["value"]=$data["Estate"]["address"];
}
echo $this->Form->input(
	"Estate.address",
	$options1
);

$options1=array(
	"type"=>"select",
	"label"=>"不動産業者名",
	"options"=>array($estateAgentList)
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["estate_agent_id"];
}
echo $this->Form->input(
	"Estate.estate_agent_id",
	$options1
);

$options1=array(
	"label"=>"家賃(円)",
	"min"=>1
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["rent"];
}
echo $this->Form->input(
	"Estate.rent",
	$options1
);

$options1=array(
	"label"=>"敷金(円)",
	"min"=>0
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["deposit"];
}
echo $this->Form->input(
	"Estate.deposit",
	$options1
);

$options1=array(
	"label"=>"礼金(円)",
	"min"=>0
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["key_money"];
}
echo $this->Form->input(
	"Estate.key_money",
	$options1
);

$options1=array(
	"label"=>"共益費(円)",
	"min"=>0
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["common_service_pay"];
}
echo $this->Form->input(
	"Estate.common_service_pay",
	$options1
);

$options1=array("label"=>"間取り");
if(isset($data)){
	$options1["value"]=$data["Estate"]["floor_plan"];
}
echo $this->Form->input(
	"Estate.floor_plan",
	$options1
);

$options1=array(
	"label"=>"階建",
	"min"=>1
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["story"];
}
echo $this->Form->input(
	"Estate.story",
	$options1
);

$options1=array(
	"label"=>"面積(畳)",
	"min"=>1
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["area"];
}
echo $this->Form->input(
	"Estate.area",
	$options1
);

$options1=array(
	"type"=>"text",
	"label"=>"築年月",
	"readonly"=>true,
	"div"=>"datepicker"
);
if(isset($data["Estate"]["age"])){
	$options1["value"]=$data["Estate"]["age"];
}
echo $this->Form->input(
	"Estate.age",
	$options1
);

$options1=array(
	"label"=>"契約期間(年)",
	"min"=>0
);
if(isset($data["Estate"]["contract_period"])){
	$options1["value"]=$data["Estate"]["contract_period"];
}
echo $this->Form->input(
	"Estate.contract_period",
	$options1
);

$options1=array("label"=>"駐車場");
if(isset($data) && $data["Estate"]["parking_flag"]){
	$options1["checked"]=true;
}
echo $this->Form->input(
	"Estate.parking_flag",
	$options1
);

$options1=array(
	"label"=>"駐車場料金(円)",
	"div"=>array("id" => "EstateParkingFeeDiv"),
	"min"=>0
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["parking_fee"];
}
echo $this->Form->input(
	"Estate.parking_fee",
	$options1
);

$options1=array("label"=>"非表示");
if(isset($data) && $data["Estate"]["hide_flag"]){
	$options1["checked"]=true;
}
echo $this->Form->input(
	"Estate.hide_flag",
	$options1
);

$options1=array(
	"type"=>"select",
	"label"=>"窓の向き",
	"options"=>$estateWindowList
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["window_direction"];
}
echo $this->Form->input(
	"Estate.window_direction",
	$options1
);

$options1=array(
	"type"=>"select",
	"label"=>"取引態様",
	"options"=>array($estateTradingAspectList)
);
if(isset($data)){
	$options1["value"]=$data["Estate"]["estate_trading_aspect_id"];
}
echo $this->Form->input(
	"Estate.estate_trading_aspect_id",
	$options1
);

$options1=array(
	"type"=>"select",
	"label"=>"物件構造",
	"options"=>array($estateStructureList)
);
if(isset($data["Estate"]["estate_structure_id"])){
	$options1["value"]=$data["Estate"]["estate_structure_id"];
}
echo $this->Form->input(
	"Estate.estate_structure_id",
	$options1
);

$options1=array(
	"type"=>"select",
	"label"=>"インターネット回線",
	"options"=>array($estateInternetTypeList)
);
if(isset($data["Estate"]["estate_internet_type_id"])){
	$options1["value"]=$data["Estate"]["estate_internet_type_id"];
}
echo $this->Form->input(
	"Estate.estate_internet_type_id",
	$options1
);

$options1=array(
	"type"=>"select",
	"label"=>"テレビ",
	"options"=>array($estateTvTypeList)
);
if(isset($data["Estate"]["estate_tv_type_id"])){
	$options1["value"]=$data["Estate"]["estate_tv_type_id"];
}
echo $this->Form->input(
	"Estate.estate_tv_type_id",
	$options1
);

echo $this->Html->div("label required", "間取り図(JPG,PNG,GIF)");
?>
<table>
	<thead>
	<?php echo $this->Html->tableHeaders(
			array(
				"プレビュー",
				"ファイル名"
			)
		) ?>
	</thead>
	<tbody>
	<?php
	$options1=array("label"=>false);
	if(isset($data)){
		$html=$this->Html->image("..".DS."upload".DS."estates".DS.$data["Estate"]["estate_id"].DS."thumb_".$data["Estate"]["floor_plan_picture_file_name"]);
		$options1["required"]=false;
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
					$options1
				)
			)
		) ?>
	</tbody>
</table>
<?php

echo $this->Html->div("label required", "物件画像(JPG,PNG,GIF)");
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
				) ?>
			</thead>
		<?php } ?>
		<tbody>
		<?php
		for($j=0;(($i==0 || !isset($data)) && $j<1) || ($i==1 && isset($data) && $j<count($data["EstatePicture"]));$j++) {
			$options1 = array(
				"label" => false,
				"type" => "radio",
				"class"=>"estate_thumbnail",
				"options" => array(0 => null)
			);
			if ($i == 1 && ((!isset($data) && $j==0) || (isset($data) && $data["EstatePicture"][$j]["thumbnail_flag"]))){
				$options1["checked"] = true;
			}
			if ($i == 1 && isset($data)) {
				$html = $this->Html->image(".." . DS . "upload" . DS . "estate_pictures" . DS . $data["EstatePicture"][$j]["estate_picture_id"] . DS . "thumb_" . $data["EstatePicture"][$j]["picture_file_name"]);
			} else {
				$html = "指定なし";
			}
			$cells=array(
				$this->Form->input(
					"Estate.thumbnail",
					$options1
				),
				$preview=$this->Html->div(
					"previews",
					$html
				)
			);
			if($i==1 && isset($data)){
				$cells[]=null;
			}else{
				$cells[]=$this->Form->file(
					"EstatePicture.?.picture",
					array(
						"label" => false,
						"required" => false
					)
				);
			}
			$cell=$this->Form->button(
					"追加",
					array(
						"type" => "button",
						"class" => "estate_picture_add"
					)
				).
				$this->Form->button(
					"削除",
					array(
						"type" => "button",
						"class" => "estate_picture_delete"
					)
				);
			if(isset($data)){
				$options2=array("class"=>"leave_hidden");
				if($i==1){
					$options2["value"]=$data["EstatePicture"][$j]["estate_picture_id"];
					$cell.= $this->Form->hidden(
						"EstatePicture.".$j.".estate_picture_id",
						$options2
					);
				}else{
					$cell.=$this->Form->hidden(
						"EstatePicture.?.estate_picture_id",
						$options2
					);
				}
			}
			$cells[]=$cell;

			echo $this->Html->tablecells($cells);
		}?>
		</tbody>
	</table>
	<?php
}

echo $this->Html->div("label required", "生の声");
for ($i = 0; $i < 2; $i++) { ?>
	<table <?php
	if ($i == 0) {
		echo "class=\"model\" ";
	}
	echo "id=\"estate_frank_opinion";
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
				) ?>
			</thead>
		<?php } ?>
		<tbody>
		<?php
		for ($j = 0; ((!isset($data) || $i==0) && $j < count($estateFrankOpinionType)) || ($i==1 && isset($data) && $j < count($data["EstateFrankOpinion"])); $j++) {
			$cells = array();
			if ($i == 1 || ($j < count($estateFrankOpinionType) && $estateFrankOpinionType[$j]["EstateFrankOpinionType"]["name"] == "入居者")) {
				if($j<count($estateFrankOpinionType)){
					$value=$estateFrankOpinionType[$j]["EstateFrankOpinionType"];
				}else{
					$value=$estateFrankOpinionType[count($estateFrankOpinionType)-1]["EstateFrankOpinionType"];
				}
				$cells[] = $value["name"] .
					$this->Form->hidden(
						"EstateFrankOpinion.?.estate_frank_opinion_type_id",
						array(
							"value" => $value["estate_frank_opinion_type_id"],
							"class" => "leave_hidden"
						)
					);
				$cell="";
				$options1=array(
					"rows" => 3,
					"label" => false
				);
				if(isset($data)){
					$options2=array("class" => "estate_frank_opinion_id");
					if($i==1){
						$options1["value"]=$data["EstateFrankOpinion"][$j]["frank_opinion"];
						$options2["value"]=$data["EstateFrankOpinion"][$j]["estate_frank_opinion_id"];
					}
					$cell.=$this->Form->hidden(
						"EstateFrankOpinion.?.estate_frank_opinion_id",
						$options2
					);
				}
				$cell.=$this->Form->input(
					"EstateFrankOpinion.?.frank_opinion",
					$options1
				);
				$cells[]=$cell;
				if (count($estateFrankOpinionType)<$j+2) {
					$cells[] = $this->Form->button(
							"追加",
							array(
								"class" => "estate_frank_opinion_add",
								"type" => "button"
							)
						) .
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
				echo $this->Html->tablecells($cells);
			}
		} ?>
		</tbody>
	</table>
	<?php
}

echo $this->Html->div("label required", "主要施設までの距離");
?>
<table id="estate_main_facilities">
	<thead>
	<?php echo $this->Html->tableHeaders(
			array(
				"種別",
				"名称",
				"距離(m)"
			)
		) ?>
	</thead>
	<tbody>
	<?php
	for ($j = 0; $j < count($estateMainFacilitiesType); $j++) {
		$cells=array(
			$estateMainFacilitiesType[$j]["EstateMainFacilitiesType"]["name"] .
			$this->Form->hidden(
				"EstateMainFacilities.?.estate_main_facilities_type_id",
				array(
					"value" => $estateMainFacilitiesType[$j]["EstateMainFacilitiesType"]["estate_main_facilities_type_id"],
					"class" => "estate_main_facilities_type_id"
				)
			)
		);
		$options1=array(
			"type" => "select",
			"options" => $estateMainFacilitiesType[$j]["EstateMainFacilities"],
			"label" => false
		);
		if(isset($data)){
			$options1["value"]=$data["EstateMainFacilitiesDistance"][$j]["estate_main_facilities_id"];
		}
		$cells[]=$this->Form->input(
			"EstateMainFacilitiesDistance.?.estate_main_facilities_id",
			$options1
		);
		$options1=array(
			"label" => false,
			"min"=>1
		);
		if(isset($data)){
			$options1["value"]=$data["EstateMainFacilitiesDistance"][$j]["distance"];
		}
		$cell=$this->Form->input(
			"EstateMainFacilitiesDistance.?.distance",
			$options1
		);
		if(isset($data)){
			$cell.=$this->Form->hidden(
				"EstateMainFacilitiesDistance.?.estate_main_facilities_distance_id",
				array(
					"value" => $data["EstateMainFacilitiesDistance"][$j]["estate_main_facilities_distance_id"],
					"class" => "leave_hidden"
				)
			);
		}
		$cells[]=$cell;
		echo $this->Html->tablecells($cells);
	} ?>
	</tbody>
</table>
<?php

echo $this->Html->div("label required", "部屋");
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
						"階",
						"部屋番号",
						"入居可能時期",
						"角部屋",
						"契約済みフラグ",
						""
					)
				) ?>
			</thead>
		<?php } ?>
		<tbody>
		<?php
		for($j=0;((!isset($data) || $i==0) && $j<1) || ($i==1 && isset($data) && $j<count($data["EstateRoom"]));$j++) {
			$cells=array();

			$options1=array(
				"type" => "select",
				"options" => array($estateTypeList),
				"label" => false
			);
			if($i==1 && isset($data)){
				$options1["value"]=$data["EstateRoom"][$j]["estate_type_id"];
			}
			$cells[]=$this->Form->input(
				"EstateRoom.?.estate_type_id",
				$options1
			);

			$options1=array(
				"label" => false,
				"min"=>1
			);
			if($i==1 && isset($data)){
				$options1["value"]=$data["EstateRoom"][$j]["floor"];
			}
			$cells[]=$this->Form->input(
				"EstateRoom.?.floor",
				$options1
			);

			$options1=array("label" => false);
			if($i==1 && isset($data)){
				$options1["value"]=$data["EstateRoom"][$j]["room_number"];
			}
			$cells[]=$this->Form->input(
				"EstateRoom.?.room_number",
				$options1
			);

			$options1=array(
				"class" => "estate_room_occupancy_date",
				"type" => "text",
				"label" => false,
				"readonly"=>true,
				"div"=>"datepicker"
			);
			if($i==1 && isset($data)){
				$options1["value"]=$data["EstateRoom"][$j]["occupancy_date"];
			}
			$cells[]=$this->Form->input(
				"EstateRoom.?.occupancy_date",
				$options1
			);

			$options1=array("label" => false);
			if($i==1 && isset($data["EstateRoom"]) && $data["EstateRoom"][$j]["corner_suite_flag"]){
				$options1["checked"]=true;
			}
			$cells[]=$this->Form->input(
				"EstateRoom.?.corner_suite_flag",
				$options1
			);

			$options1=array("label" => false);
			if($i==1 && isset($data["EstateRoom"]) && $data["EstateRoom"][$j]["contracted_flag"]){
				$options1["checked"]=true;
			}
			$cells[]=$this->Form->input(
				"EstateRoom.?.contracted_flag",
				$options1
			);

			$cell=$this->Form->button(
					"追加",
					array(
						"class" => "estate_room_add",
						"type" => "button"
					)
				) .
				$this->Form->button(
					"削除",
					array(
						"class" => "estate_room_delete",
						"type" => "button"
					)
				);
			if($i==1 && isset($data["EstateRoom"]) && $j<count($data["EstateRoom"])){
				$cell.=$this->Form->hidden(
					"EstateRoom.?.estate_room_id",
					array(
						"value" => $data["EstateRoom"][$j]["estate_room_id"],
						"class" => "leave_hidden"
					)
				);
			}
			$cells[]=$cell;

			echo $this->Html->tablecells($cells);
		}
		?>
		</tbody>
	</table>
	<?php
}

$options1=array(
	"label"=>"物件特徴",
	"div"=>array("id" => "estate_characteristic_reference"),
	"type"=>"select",
	"multiple"=>"checkbox",
	"options"=>array($estateCharacteristicList)
);
if(isset($data["EstateCharacteristicReference"])){
	$options1["value"]=$data["EstateCharacteristicReference"];
}
echo $this->Form->input(
	"EstateCharacteristicReference.estate_characteristic_id",
	$options1
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
	) .
	$this->Form->submit(
		"はい"
	) .
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
