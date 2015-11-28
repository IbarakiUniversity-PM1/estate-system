<h1>UploadPack</h1>
<p>This is UploadPack Test!</p>

<table>
    <tr>
        <th>ID</th><th>TITLE</th><th>IMAGE</th><th>CREATED</th><th>EDIT</th>
    </tr>
    <?php foreach($images as $image):?><tr>
    <td><?php echo $image['Image']['id'];?></td><td><?php echo $image['Image']['title'];?></td><td><?php echo $image['Image']['img_file_name'];?></td><td><?php echo $image['Image']['created'];?></td><td><?php echo $this->Html->link("EDIT", "/edit/".$image['Image']['id']); ?></td></tr>
    <?php endforeach;?>
</table>
