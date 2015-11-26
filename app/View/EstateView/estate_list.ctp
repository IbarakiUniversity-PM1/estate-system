<table>
	<thead>
	<tr>
		<th>物件画像</th>
		<th>住所</th>
		<th>家賃</th>
		<th>間取り<br>面積</th>
		<th>窓の向き</th>
		<th>築年数</th>
		<th>不動産業者名</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($estates as $e) { ?>
		<tr>
			<td><?php ?></td>
			<td><?php echo $e["Estate"]["address"] ?></td>
			<td><?php echo $this->Number->currency($e["Estate"]["rent"], '円', array('wholePosition' => 'after', 'zero' => '', 'places' => 0)) ?></td>
			<td><?php echo $e["Estate"]["floor_plan"] ?>
				<br><?php echo $this->Number->currency($e["Estate"]["area"], 'km', array('wholePosition' => 'after', 'zero' => '', 'places' => 0)) ?>&sup2;
			</td>
			<td><?php ?></td>
			<td><?php echo $this->Number->currency($e["Estate"]["age"], '年', array('wholePosition' => 'after', 'zero' => '', 'places' => 0)) ?></td>
			<td><?php echo $e["EstateAgent"]["name"] ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
