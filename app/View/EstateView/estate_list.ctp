<?php
$this->assign("nav", true);
echo $this->Form->create("Estate", array("type" => "get"));
?>
<table>
	<thead>
	<?php echo $this->Html->tableHeaders(
			array(
				$this->Form->submit("絞込", array("div" => false)),
				"物件画像",
				"住所",
				"家賃",
				"間取り<br>面積",
				"窓の向き",
				"築年数",
				"不動産業者名"
			)
		) . PHP_EOL ?>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($estates as $e) {
		$cells = array();
		$cells[] =
			$this->Form->input($this->Form->defaultModel . "." . $i . ".estate_id.",
				array(
					"type" => "checkbox",
					"label" => "",
					"value" => $e["Estate"]["estate_id"],
					"div" => false));
		if (isset($e["Estate"]["picture_file_name"])) {
			$cells[] = $this->Html->image("estate" . DS . $e["Estate"]["picture_file_name"], array("alt" => $e["Estate"]["name"]));
		} else {
			$cells[] = null;
		}
		$cells[] = $e["Estate"]["address"];
		$cells[] = $this->Number->currency($e["Estate"]["rent"], "円", array("wholePosition" => "after", "zero" => "無料", "places" => 0));
		$cells[] = $e["Estate"]["floor_plan"] . "<br>" . $this->Number->currency($e["Estate"]["area"], "m", array("wholePosition" => "after", "zero" => 0, "places" => 0)) . "&sup2;";
		$cells[] = $e["Estate"]["window_direction"];
		$cells[] = $this->Number->currency($e["Estate"]["age"], "年", array("wholePosition" => "after", "zero" => "1年未満", "places" => 0));
		$cells[] = $e["EstateAgent"]["name"];
		echo "		" . $this->Html->tableCells($cells) . PHP_EOL;
		$i++;
	} ?>
	</tbody>
</table>
<?php echo $this->Form->end() ?>
