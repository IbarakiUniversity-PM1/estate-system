<?php echo $user_name ?>様

以下のように内見予約を承りました。

【物件名】
<?php echo $estate_name ?>


<?php
$kanji=array("一","二","三");
for($i=0;$i<3;$i++){ ?>
【第<?php echo $kanji[$i] ?>希望日】
<?php echo $preview_date[$i] ?>


<?php } ?>

後日、不動産業者の担当者から、内見の日程についてのメールが届きますので、それまでお待ちください。

こうがく不動産
