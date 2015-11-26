<table>
	<thead>
	<?php echo $this->Html->tableHeaders(array("物件画像", "住所", "家賃", "間取り<br>面積", "窓の向き", "築年数", "不動産業者名")) ?>

	</thead>
	<tbody>
	<?php foreach ($estates as $e) { ?>
		<?php echo $this->Html->tableCells(array($this->Html->image("estate" . DS . $e["EstatePicture"][0]["file_name"], array("alt" => $e["Estate"]["name"])), $e["Estate"]["address"], $this->Number->currency($e["Estate"]["rent"], '円', array('wholePosition' => 'after', 'zero' => '', 'places' => 0)), $e["Estate"]["floor_plan"] . "<br>" . $this->Number->currency($e["Estate"]["area"], 'km', array('wholePosition' => 'after', 'zero' => '', 'places' => 0)) . "&sup2;", "", $this->Number->currency($e["Estate"]["age"], '年', array('wholePosition' => 'after', 'zero' => '', 'places' => 0)), $e["EstateAgent"]["name"])); ?>
	<?php } ?>

	</tbody>
</table>
