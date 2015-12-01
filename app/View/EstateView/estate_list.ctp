<?php
$this->assign("nav", true);
$this->Html->css("estate_list", array("inline" => false));
$this->Html->script("estate_list", array("inline" => false));
?>

<table>
	<thead>
	<?php echo $this->Html->tableHeaders(
			array(
				$this->Form->button(
					"絞込",
					array(
						"id" => "refine",
						"type" => "button"
					)
				),
				"物件画像",
				"住所",
				"家賃",
				"間取り<br>面積",
				"窓の向き",
				"築年数",
				"不動産業者名",
				"詳細画面"
			)
		) . PHP_EOL ?>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($estates as $estate) {
		$option = array("data-href" => "EstateView" . DS . "detail" . DS . $estate["Estate"]["estate_id"]);
		echo $this->Html->tableCells(
				array(
					$this->Form->input(
						"estate_check" . $i,
						array(
							"type" => "checkbox",
							"class" => "estate_check",
							"label" => false,
							"value" => $estate["Estate"]["estate_id"]
						)
					),
					$this->Html->image(".." . DS . "upload" . DS . "estate_pictures" . DS . $estate["Estate"]["estate_id"] . DS . str_replace(".jpeg", "_thumb.jpeg", $estate["Estate"]["picture_file_name"]), array("alt" => $estate["Estate"]["name"])),
					$estate["Estate"]["address"],
					$estate["Estate"]["rent"] . "円",
					$estate["Estate"]["floor_plan"] . "<br>" . $estate["Estate"]["area"] . "m&sup2;",
					$estate["Estate"]["window_direction"],
					$estate["Estate"]["age"],
					$estate["EstateAgent"]["name"],
					$this->Html->link(
						"詳細画面へ",
						array(
							"action" => "detail",
							$estate["Estate"]["estate_id"]
						)
					)
				),
				$option,
				$option
			) . PHP_EOL;
		$i++;
	}
	?>
	</tbody>
</table>
