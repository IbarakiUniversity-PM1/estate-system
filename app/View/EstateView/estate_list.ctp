
<?php echo $this -> Html -> script( 'jquery-1.11.3.min', array( 'inline' => false ) ); ?>

<?php
$this->assign("nav", true);
echo $this->Form->create("Estate", array("type" => "get"));
//debug($estates);
?>



<div id="estate-list" class="preview">
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
    <?php $i=0 ?>
    <?php foreach ($estates as $estate) :?>
        <tr data-href="EstateView/detail/<?php echo $estate["Estate"]["estate_id"]?>">
            <td><input type="hidden" name=<?php echo $i?> id="Estate0EstateId_" value="0"/><input type="checkbox" name=<?php echo $i?> value=<?php echo $estate["Estate"]["estate_id"]?> id="Estate0EstateId"/><label for="Estate0EstateId"></label></td>
            <td><img src="/estate-system/img/../upload/estate_pictures/<?php echo $estate["Estate"]["estate_id"]?>/<?php echo str_replace(".jpeg", "_thumb.jpeg", $estate["Estate"]["picture_file_name"]) ?>" alt="test"/></td>
            <td><?php echo $estate["Estate"]["address"]?></td>
            <td><?php echo $estate["Estate"]["rent"]?>円</td>
            <td><?php echo $estate["Estate"]["floor_plan"]?><br><?php echo $estate["Estate"]["area"]?>m&sup2;</td>
            <td><?php echo $estate["Estate"]["window_direction"]?></td>
            <td><?php echo $estate["Estate"]["age"]?></td>
            <td><?php echo $estate["EstateAgent"]["name"]?></td>
        </tr>
        <?php $i++ ?>
    <?php endforeach;?>

    </tbody>
</table>
</div>

<?php echo $this->Form->end();?>

<?php $this->Html->scriptStart(array('inline' => false)); ?>
//scriptタグは自動でできます。

<?php $this->Html->scriptEnd(); ?>

<script type="text/javascript">(function(){window.setting={styling:".preview th{background:#333333;color:#ffffff;padding:5px;}.preview tr{border-bottom:1px solid #ccc;}.preview td{border:dotted #ccc;border-width:0px 1px;padding:5px;}.preview tr:nth-child(even){background:#f6f6ff;}.clickable:hover{cursor:pointer;background:#ffddff;}"};if(setting.styling){var a=document.createElement("style"),b=document.getElementsByTagName("head")[0];a.type="text/css";try{a.appendChild(document.createTextNode(setting.styling))}catch(c){if(a.styleSheet)a.styleSheet.cssText= setting.styling}b.appendChild(a)}})();
    jQuery(function(a){a("tr[data-href]","#estate-list, refine").addClass("clickable").click(function(b){if(!a(b.target).is("a"))window.location=a(b.target).closest("tr").data("href")});a("tbody tr[data-href]","#estate-list, refine").addClass("clickable").click(function(){window.location=a(this).attr("data-href")}).find("a").hover(function(){a(this).parents("tr").unbind("click")},function(){a(this).parents("tr").click(function(){window.location=a(this).attr("data-href")})})});</script>

