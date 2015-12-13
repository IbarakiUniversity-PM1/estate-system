<center>
<?php
$this->assign("nav", true);
$this->Html->script("preview_book".DS."book", array("inline" => false));
$this->Html->addCrumb(
	'物件詳細',
	"/EstateView/detail/" . $estate["Estate"]["estate_id"]
);
$this->Html->addCrumb(
	'内見予約',
	"/PreviewBook/book/" . $estate["Estate"]["estate_id"]
); ?>

    <div>

        <h4><?php echo $estate['Estate']['name']; ?>に内見予約のメールを送信します
        </h4>
        <?php
        echo $this->Form->create('PreviewBook', array('url' => array('controller' => 'PreviewBook', 'action' => 'confirm')));
        ?>
        <center>
            <ul style="list-style:none;">

                <li>
                    <div id="vertical_middle">
                        <?php echo $this->Form->input('user_name', array('label' => '氏名','type'=>'text')); ?>
                    </div>
                </li>


                <li>
                    <?php echo $this->Form->input('email_address', array('label' => 'E-Mail','type'=>'text')); ?>
                </li>


                <li>
                    <?php echo $this->Form->input('tel_number', array('label' => '電話番号', 'size' => 11));
                    ?>
                </li>


                <li>
                    <?php echo $this->Form->input(
						"preview_date_1",
						array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第一希望日"
						)
					) ?>
                </li>


                <li>
                    <?php echo $this->Form->input(
						"preview_date_2",
						array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第二希望日"
						)
					) ?>
                </li>


                <li>
                    <?php echo $this->Form->input(
						"preview_date_3",
						array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第三希望日"
						)
					) ?>
                </li>

                <li>
                    <?php echo $this->Form->hidden('PreviewBook.estate_id', array('value' => $estate['Estate']['estate_id']));
                    ?>
                </li>

                <li>
                    <?php echo $this->Form->end('送信確認画面へ');
                    ?>
                </li>
            </ul>
        </center>

    </div>



</center>
