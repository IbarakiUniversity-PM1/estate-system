<h1>EstateRegistrationController/index</h1>

<?php echo $this->Html->link('Add Estate', array('controller' => 'estateregistration', 'action' => 'register')); ?>

<table>

<tr>

<th>Id</th><th>物件名</th><th>住所</th>

</tr>

<?php foreach ($estates as $estate) :?>

<tr>

<td><?php echo $estate['Estate']['estate_id']; ?></td>

<td><?php echo $estate['Estate']['name']; ?></td>

<td><?php echo $estate['Estate']['address']; ?></td>

<td>

<?php echo $this->Form->postLink('削除', array('controller' => 'EstateDelete','action' => 'delete', $estate['Estate']['estate_id']), array('confirm' => '削除しても良いですか？')); ?>

<?php echo $this->Html->link('編集', array('controller' => 'EstateEdit', 'action' => 'edit', $estate['Estate']['estate_id'])); ?>

</td>

</tr>

<?php endforeach;?>

<?php unset($estate); ?>

</table>
