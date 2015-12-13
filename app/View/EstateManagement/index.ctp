<h1>EstateManagementController/index</h1>

<?php echo $this->Html->link("Add Estate", array("controller" => "EstateManagement", "action" => "register")); ?>

<table>

<tr>

<th>Id</th><th>物件名</th><th>住所</th>

</tr>

<?php foreach ($estates as $estate) :?>

<tr>

<td><?php echo $estate["Estate"]["estate_id"]; ?></td>

<td><?php echo $estate["Estate"]["name"]; ?></td>

<td><?php echo $estate["Estate"]["address"]; ?></td>

<td>

<?php echo $this->Form->postLink("削除", array("action" => "delete", $estate["Estate"]["estate_id"]), array("confirm" => "この物件を削除しても良いですか？\n※一度削除してしまうと、元に戻すことはできません！")); ?>

<?php echo $this->Html->link("編集", array("action" => "edit", $estate["Estate"]["estate_id"])); ?>

</td>

</tr>

<?php endforeach;?>

<?php unset($estate); ?>

</table>
