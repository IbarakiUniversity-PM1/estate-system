<?php var_dump($estates) ?>
<table>
	<thead>
	<?php echo $this->Html->tableHeaders(array("物件画像", "住所", "家賃", "間取り<br>面積", "窓の向き", "築年数", "不動産業者名")) . PHP_EOL ?>
	</thead>
	<tbody>
	<?php foreach ($estates as $e) {
		$cells = array();
		if (empty($e["EstatePicture"])) {
			$cells[] = null;
		} else {
			$cells[] = $this->Html->image("estate" . DS . $e["EstatePicture"][0]["picture_file_name"], array("alt" => $e["Estate"]["name"]));
		}
		$cells[] = $e["Estate"]["address"];
		$cells[] = $this->Number->currency($e["Estate"]["rent"], '円', array('wholePosition' => 'after', 'zero' => '', 'places' => 0));
		$cells[] = $e["Estate"]["floor_plan"] . "<br>" . $this->Number->currency($e["Estate"]["area"], 'km', array('wholePosition' => 'after', 'zero' => '', 'places' => 0)) . "&sup2;";
		$cells[] = "";
		$cells[] = $this->Number->currency($e["Estate"]["age"], '年', array('wholePosition' => 'after', 'zero' => '', 'places' => 0));
		$cells[] = $e["EstateAgent"]["name"];
		echo "		" . $this->Html->tableCells($cells) . PHP_EOL;
	} ?>
	</tbody>
</table>
