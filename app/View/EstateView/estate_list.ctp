
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
            $cells[] = $this->Html->image('../upload/estate_pictures/' . $e["Estate"]["estate_id"] . '/' . str_replace(".jpeg", "_thumb.jpeg", $e["Estate"]["picture_file_name"])   , array("alt" => $e["Estate"]["name"]));
        } else {
            $cells[] = null;
        }
        $cells[] = $e["Estate"]["address"];
        $cells[] = $this->Number->currency($e["Estate"]["rent"], "円", array("wholePosition" => "after", "zero" => "無料", "places" => 0));
        $cells[] = $e["Estate"]["floor_plan"] . "<br>" . $this->Number->currency($e["Estate"]["area"], "m", array("wholePosition" => "after", "zero" => 0, "places" => 0)) . "&sup2;";
        $cells[] = $e["Estate"]["window_direction"];
        $cells[] = $this->Number->currency($e["Estate"]["age"], "年", array("wholePosition" => "after", "zero" => "1年未満", "places" => 0));
        $cells[] = $e["EstateAgent"]["name"];
        echo "        " . $this->Html->tableCells(
            $cells,
            array('data-href'=>"EstateView/detail/" . $e["Estate"]["estate_id"])) . PHP_EOL;
        $i++;

    } ?>
    </tbody>
</table>
</div>

<div id="refine">
    <table>
        <thead>
            <?php echo $this->Html->tableHeaders(
    array(
        $this->Form->submit("絞込", array("div" => false)),

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

                echo "        " . $this->Html->tableCells(
                    $cells,
                    array('data-href'=>"EstateView/detail/" . $e["Estate"]["estate_id"])) . PHP_EOL;
                $i++;

            } ?>
        </tbody>
    </table>
</div>


<?php echo $this->Form->end();?>




<?php $this->Html->scriptStart(array('inline' => false)); ?>
//scriptタグは自動でできます。

<?php $this->Html->scriptEnd(); ?>

<script type="text/javascript">(function(){window.setting={styling:".preview th{background:#333333;color:#ffffff;padding:5px;}.preview tr{border-bottom:1px solid #ccc;}.preview td{border:dotted #ccc;border-width:0px 1px;padding:5px;}.preview tr:nth-child(even){background:#f6f6ff;}.clickable:hover{cursor:pointer;background:#ffddff;}"};if(setting.styling){var a=document.createElement("style"),b=document.getElementsByTagName("head")[0];a.type="text/css";try{a.appendChild(document.createTextNode(setting.styling))}catch(c){if(a.styleSheet)a.styleSheet.cssText= setting.styling}b.appendChild(a)}})();jQuery(function(a){a("tr[data-href]","#estate-list, refine").addClass("clickable").click(function(b){if(!a(b.target).is("a"))window.location=a(b.target).closest("tr").data("href")});a("tbody tr[data-href]","#estate-list, refine").addClass("clickable").click(function(){window.location=a(this).attr("data-href")}).find("a").hover(function(){a(this).parents("tr").unbind("click")},function(){a(this).parents("tr").click(function(){window.location=a(this).attr("data-href")})})});</script>

