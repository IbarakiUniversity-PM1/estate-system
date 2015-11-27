<div id="nav">
	<h3>こうがく不動産</h3>
	<table>
		<thead>
		<?php echo $this->Html->tableHeaders(array("提供不動産業者")) . PHP_EOL ?>
		</thead>
		<tbody>
		<?php foreach ($estate_agents as $e) {
			$e = $e["EstateAgent"];
			echo "		" . $this->Html->tableCells(array($e["name"] . "<br>TEL : " . $e["phone_number"])) . PHP_EOL;
		} ?>
		</tbody>
	</table>
</div>
