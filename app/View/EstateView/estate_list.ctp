
<?php echo $this -> Html -> script( 'jquery-1.11.3.min', array( 'inline' => false ) ); ?>

<?php
$this->assign("nav", true);
echo $this->Form->create("Estate", array("type" => "get"));
//debug($estates);

?>




<table cellspacing="0" cellpadding="0" >
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
                "不動産業者名",
                "詳細画面"
            )
        ) . PHP_EOL ?>
    </thead>
    <tbody　class ="table_scroll">
    <?php $i=0 ?>
    <?php foreach ($estates as $estate) :?>



        <tr data-href="EstateView/detail/<?php echo $estate["Estate"]["estate_id"]?>">
            <td id="checkbox_td"><input type="hidden" name=<?php echo $i?> id="Estate0EstateId_" value="0"/><input type="checkbox" name=<?php echo $i?> value=<?php echo $estate["Estate"]["estate_id"]?> id="Estate0EstateId"/><label for="Estate0EstateId"></label></td>
            <td><img src="/estate-system/img/../upload/estate_pictures/<?php echo $estate["Estate"]["estate_id"]?>/<?php echo str_replace(".jpeg", "_thumb.jpeg", $estate["Estate"]["picture_file_name"]) ?>" alt="test"/></td>
            <td><?php echo $estate["Estate"]["address"]?></td>
            <td><?php echo $estate["Estate"]["rent"]?>円</td>
            <td><?php echo $estate["Estate"]["floor_plan"]?><br><?php echo $estate["Estate"]["area"]?>m&sup2;</td>
            <td><?php echo $estate["Estate"]["window_direction"]?></td>
            <td><?php echo $estate["Estate"]["age"]?></td>
            <td><?php echo $estate["EstateAgent"]["name"]?></td>
            <td><?php echo $this->Html->link("詳細画面へ", array('action'=>'detail/' . $estate["Estate"]["estate_id"]))?></td>
        </tr>
        <?php $i++ ?>
    <?php endforeach;?>

    </tbody>
</table>


<?php echo $this->Form->end();?>

<?php $this->Html->scriptStart(array('inline' => false)); ?>
//scriptタグは自動でできます。

<?php $this->Html->scriptEnd(); ?>

<style>
    tbody tr:hover {
        background: #dde1e1;
    }
    tbody:hover, label {
        cursor: pointer;
    }
    thead{
        background: black;
        color: #fff;
    }
    tbody.table_scroll {
        overflow-y: scroll;
        height: 150px;
    }
/*
    thead.table_head,tbody.table_scroll{
        display: block;
    }
    thead.table_head {
        background-color: #DCDCDC;
    }

    td,th{
        text-align: left;
        width: 120px;
    }
*/
</style>


<script type="text/javascript">

    jQuery(function($) {
        //data-hrefの属性を持つtrを選択しclassにclickableを付加
        $('tr[data-href]').addClass('clickable')
        //クリックイベント
            .click(function(e) {
            //e.targetはクリックした要素自体、それが#Estate0EstateId要素以外であれば
            if(!$(e.target).is('#Estate0EstateId, #checkbox_td')){
                //その要素の先祖要素で一番近いtrの
                //data-href属性の値に書かれているURLに遷移する
                window.location = $(e.target).closest('tr').data('href');
            };
        });
    });
</script>
