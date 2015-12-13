<?php
$this->assign("nav", true);
$this->Html->css("estate_view/estate_list", array("inline" => false));
$this->Html->script("estate_view/estate_list", array("inline" => false));
$this->Html->script("jquery-latest", array("inline" => false));
$this->Html->script("jquery.tablesorter", array("inline" => false));
?>



<script type="text/javascript">
    $(document).ready(function()
                      {
        $("#estate_table").tablesorter( {
            headers: {
                0: { sorter: false },
                1: { sorter: false },
                8: { sorter: false }

			}
        });
    });
</script>



<div id="hit"><h4>
    <?php
        if($title_for_layout === "物件検索結果")
            echo $hit;
    ?>
</h4></div>

<?php if(isset($loginUser)){ ?>
<h4><?php echo $this->Html->link("物件登録", array("controller" => "EstateManagement", "action" => "register")) ?></h4>
<?php } ?>

<table id="estate_table">
    <thead class="scrollHead">
    <?php
	$headers=array(
		$this->Form->button(
			"絞込",
			array(
				"id" => "refine",
				"type" => "button"
			)
		),
		"物件画像",
		"住所",
		"家賃",
		"間取り<br>面積",
		"窓の向き",
		"築年数",
		"不動産業者名",
		"詳細画面"
	);
	for($i=0;isset($loginUser) && $i<2;$i++){
		$headers[]="";
	}
	echo $this->Html->tableHeaders($headers); ?>
    </thead>
    <tbody class="scrollBody">
    <?php
    $i = 0;
    foreach ($estates as $estate) {
        $option = array(
			"data-href" => $this->Html->url(
				array(
					"action" => "detail",
					$estate["Estate"]["estate_id"]
				)
			)
		);
		$cells=array(
			$this->Form->input(
				"estate_check" . $i,
				array(
					"type" => "checkbox",
					"class" => "estate_check",
					"label" => false,
					"value" => $estate["Estate"]["estate_id"]
				)
			),
			$this->Html->image(".." . DS . "upload" . DS . "estate_pictures" . DS . $estate["Estate"]["estate_id"] . DS . "thumb_" . $estate["Estate"]["picture_file_name"], array("alt" => $estate["Estate"]["name"])),
			$estate["Estate"]["address"],
			$this->Number->currency(
				$estate["Estate"]["rent"],
				'円',
				array(
					'wholePosition' => 'after',
					'zero' => "無料",
					'places' => 0)
			),
			$estate["Estate"]["floor_plan"] . "<br>" . $this->Number->currency(
				$estate["Estate"]["area"],
				"m",
				array(
					'wholePosition' => 'after',
					'zero' => 0,
					'places' => 0)
			) . "&sup2;",
			$estate["Estate"]["window_direction"],
			$this->Number->currency(
				$estate["Estate"]["age"],
				'年',
				array(
					'wholePosition' => 'after',
					'zero' => "1年未満",
					'places' => 0)
			),
			$estate["EstateAgent"]["name"],
			$this->Html->link(
				"詳細画面へ",
				array(
					"action" => "detail",
					$estate["Estate"]["estate_id"]
				)
			)
		);
		if(isset($loginUser)){
			$cells[]=$this->Html->link("編集",
				array(
					"controller"=>"EstateManagement",
					"action" => "edit",
					$estate["Estate"]["estate_id"]
				)
			);
			$cells[]=$this->Form->postLink("削除",
				array(
					"controller"=>"EstateManagement",
					"action" => "delete",
					$estate["Estate"]["estate_id"]
				),
				array("confirm" => "この物件を削除しても良いですか？\n※一度削除してしまうと、元に戻すことはできません！")
			);
		}
        echo $this->Html->tableCells(
				$cells,
				$option,
				$option
            );
        $i++;
    }
    ?>
    </tbody>
</table>
