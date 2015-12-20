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
        echo $this->Form->create('PreviewBook', array('url' => array('controller' => 'PreviewBook', 'action' => 'book')));
        ?>
        <center>
            <ul style="list-style:none;">
                <?php if($isDefault) { ?>
                <li><?php echo $this->Form->input('user_name', array('label' => '氏名')); ?></li>
                <li><?php echo $this->Form->input('email_address', array('label' => 'E-Mail')); ?></li>
                <li><?php echo $this->Form->input('tel_number', array('label' => '電話番号', 'size' => 13));?></li>
                <li><?php echo $this->Form->input("preview_date_1",array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第一希望日",
							"readonly"=>true,
							"div"=>"datepicker"
						)) ?></li>
                <li><?php echo $this->Form->input("preview_date_2",array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第二希望日",
							"readonly"=>true,
							"div"=>"datepicker"
						)) ?></li>
                <li><?php echo $this->Form->input("preview_date_3",array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第三希望日",
							"readonly"=>true,
							"div"=>"datepicker"
						)) ?></li>
                <?php } else { ?>
                <li><?php echo $this->Form->input('user_name', array('label' => '氏名', 'default' => $user_name_meta)); ?></li>
                <li><?php echo $this->Form->input('email_address', array('label' => 'E-Mail' , 'default' => $data_return['PreviewBook']['email_address'])); ?></li>
                <li><?php echo $this->Form->input('tel_number', array('label' => '電話番号','default' => $data_return['PreviewBook']['tel_number'], 'size' => 13));?></li>
                <li><?php echo $this->Form->input("preview_date_1",array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第一希望日",
							"readonly"=>true,
							"div"=>"datepicker",
                                                        'default' => $preview_dates[0]
						)) ?></li>
                <li><?php echo $this->Form->input("preview_date_2",array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第二希望日",
							"readonly"=>true,
							"div"=>"datepicker",
                                                        'default' => $preview_dates[1]
						)) ?></li>
                <li><?php echo $this->Form->input("preview_date_3",array(
							"class"=>"preview_date",
							"type"=>"text",
							"label"=>"第三希望日",
							"readonly"=>true,
							"div"=>"datepicker",
                                                        'default' => $preview_dates[2]
						)) ?></li>
                <?php } ?>
                <li><?php echo $this->Form->hidden('PreviewBook.estate_id', array('value' => $estate['Estate']['estate_id']));?></li>
                <li><?php
                    echo $this->Form->submit('送信確認画面へ', array('name' => 'submit', 'label' => false));
                    echo $this->Form->submit('戻る', array('name' => 'cancel', 'label' => false));
                    echo $this->Form->end(); ?></li>
                </ul>
        </center>
    </div>
</center>
