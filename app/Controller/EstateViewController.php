<?php
App::uses('Sanitize', 'Utility');

/**
 * 物件検索・詳細コントローラ
 */
class EstateViewController extends AppController
{
    /**
     * @var array 扱うモデルのリスト
     */
    public $uses = array(
        "Estate",
        "EstateCharacteristic",
        "EstateMainFacilities",
        "EstateMainFacilitiesDistance"
    );

    /**
     * 物件検索・絞込・トップ画面
     */
    public function estateList()
    {
        // サニタイズの応急処置(非推奨)
        $this->request->data = Sanitize::clean($this->request->data);
        //データ取得の際のオプション
        $options = array(
            //サムネイル画像をJOINする
            "joins" => array(
                array(
                    "type" => "LEFT",
                    "table" => "estate_pictures",
                    "alias" => "EstatePicture",
                    "conditions" => array(
                        "Estate.estate_id=EstatePicture.estate_id",
                        //サムネイル画像となっている物件画像に限定する
                        "EstatePicture.thumbnail_flag=1"
                    )
                )
            ),
            "order" => array(),
            //物件単位でテーブルをまとめる
            "group" => array("Estate.estate_id"),
            "conditions" => array()
        );

        $isTop=true;

        if(!empty($this->request->query["data"])) { //物件検索・絞り込み
            //タイトルをセットする
            $this->set("title_for_layout", "物件検索結果");

            $options_=$options;
            $isError=false;
            $this->request->query["data"]=Sanitize::clean($this->request->query["data"]);
            foreach($this->request->query["data"] as $k1=>$v1){
                if(!$isError) {
                    if ($k1 == "EstateCharacteristicReference") {
                        $options["joins"][] = array(
                            "type" => "LEFT",
                            "table" => "estate_characteristic_references",
                            "alias" => "EstateCharacteristicReference",
                            "conditions" => array("Estate.estate_id=EstateCharacteristicReference.estate_id")
                        );
                    }
                    foreach ($v1 as $k2 => $v2) {
                        if (!$isError && $v2 != "") {
                            if (($k1 == "Estate" && ($k2 == "name" || $k2 == "address")) || ($k1 == "EstateAgent" && $k2 == "name")) {
                                $options["conditions"][] = $k1 . "." . $k2 . " LIKE '%" . $v2 . "%'";
                            } else if (($k1 == "Estate" && $k2=="window_direction") || preg_match('/^\d+$/', $v2)) {
                                if ($k1 == "Estate" && $k2 == "rent") {
                                    $options["conditions"][] = $k1 . "." . $k2 . "<=" . $v2;
                                } else if ($k1 == "Estate" && ($k2 == "age" || $k2 == "area")) {
                                    if ($k2 == "age") {
                                        $v2 = $this->Date->toTimestampModify("-" . $v2 . " years");
                                    }
                                    $options["conditions"][] = $v2 . "<=" . $k1 . "." . $k2;
                                } else {
                                    $options["conditions"][$k1 . "." . $k2] = $v2;
                                }
                            } else {
                                $isError = true;
                            }
                        }
                    }
                }
            }
            if($isError){
                $options=$options_;
                $this->Flash->set("数値条件は自然数を使って入力してください。");
            }else {
                $isTop = false;
            }
        }

        if ($isTop) { //トップ画面
            //タイトルをセットする
            $this->set("title_for_layout", "物件一覧");

            //茨城大学日立キャンパスからの距離をJOINする
            $options["joins"][] = array(
                "type" => "LEFT",
                "table" => "estate_main_facilities_distances",
                "alias" => "EstateMainFacilitiesDistance",
                "conditions" =>
                    array(
                        "Estate.estate_id = EstateMainFacilitiesDistance.estate_id",
                        //茨城大学日立キャンパスからの距離に限定する
                        "EstateMainFacilitiesDistance.estate_main_facilities_id=0"
                    )
            );

            //茨城大学日立キャンパスからの距離の昇順で並べる
            $options["order"][] = "EstateMainFacilitiesDistance.distance";
        }

        //ログインしていないとき、非表示フラグが立っている、または、全ての部屋が契約済みな物件を表示しないようにする
        $loginUser=$this->Auth->user();
        if(empty($loginUser)){
            $options["joins"][] = array(
                "type" => "LEFT",
                "table" => "estate_rooms",
                "alias" => "EstateRoom",
                "conditions" => array("Estate.estate_id=EstateRoom.estate_id")
            );
            $options["conditions"][] = "EstateRoom.contracted_flag=0";
            $options["conditions"][] = "Estate.hide_flag=0";
        }

        //Estateにバーチャルフィールドを作成する
        $this->Estate->virtualFields = array(
            //築年数(本来の値に上書きする形となっている)
            "age" => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-Estate.age/1000,'unixepoch'))-1970",
            //サムネイル画像
            "picture_file_name" => "EstatePicture.picture_file_name"
        );

        //データを取得し、Viewの$estatesにセットする
        $estates = $this->Estate->find("all", $options);
        $this->set("estates", $estates);
        $this->set("hit", "検索結果: " . count($estates) . "件");
    }

    /**
     * 物件詳細画面
     * @param null $estate_id 物件ID
     */
    public function detail($estate_id = null)
    {
//        $this->autoLayout = false;
        $this->set("title_for_layout", "物件詳細画面");
        $this->Estate->id = $estate_id;

        $estate = $this->Estate->read();

        // 存在しない詳細画面を表示した際の処理
        if(!$estate){
            throw new NotFoundException(__('404 Not Found'));
        }

        //全ての部屋が契約済みな物件について、非表示フラグを立てる
        if(!$estate["Estate"]["hide_flag"]) {
            $isHide = true;
            for ($i = 0; $isHide && $i < count($estate["EstateRoom"]); $i++) {
                if (!$estate["EstateRoom"][$i]["contracted_flag"]) {
                    $isHide = false;
                }
            }
            if ($isHide) {
                $estate["Estate"]["hide_flag"] = 1;
            }
        }

        // 非表示物件の詳細画面を表示した際の処理
        $loginUser=$this->Auth->user();
        if($estate["Estate"]["hide_flag"] && empty($loginUser)) {
            throw new NotFoundException(__('404 Not Found'));
        }

        $this->set('estate', $estate);

        $str_characteristic = "";
        foreach($estate['EstateCharacteristicReference'] as $ect) {
            $option["conditions"]["estate_characteristic_id"] = $ect["estate_characteristic_id"];
            $option["fields"] = array('name', 'name');
            $tmp = $this->EstateCharacteristic->find('all', $option);
            $str_characteristic .= $tmp[0]['EstateCharacteristic']['name'].PHP_EOL;
        }
        $this->set('str_characteristic', $str_characteristic);

        $str_emfd = "";
        foreach($estate['EstateMainFacilitiesDistance'] as $emfd) {
            
            //$opt["conditions"]["estate_main_facilities_id"] = $emfd["estate_main_facilities_id"];
            //$opt["fields"] = array('name', 'name');
            //debug($tmp = $this->EstateMainFacilities->find('all', $opt));
            //$str_emfd .= $tmp[0]['EstateMainFacility']['EstateMainFacility.name'].$emfd['distance']."m".PHP_EOL;

            if(!isset($emfd['estate_main_facilities_id'])) continue;
            if($emfd['estate_main_facilities_id'] == 0){
                $str_emfd .= "茨城大学日立キャンパス"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 1){
                $str_emfd .= "日立駅"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 2){
                $str_emfd .= "大みか駅"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 3){
                $str_emfd .= "常陸多賀駅"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 4){
                $str_emfd .= "茨大前バス停"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 5){
                $str_emfd .= "成沢バス停"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 6){
                $str_emfd .= "諏訪バス停"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 7){
                $str_emfd .= "茨城大学水戸キャンパス"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 8){
                $str_emfd .= "茨城大学阿見キャンパス"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 9){
                $str_emfd .= "茨城キリスト教大学"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 10){
                $str_emfd .= "筑波大学"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 11){
                $str_emfd .= "セブンイレブン日立市民運動公園前店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 12){
                $str_emfd .= "ファミリーマート日立油縄子店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 13){
                $str_emfd .= "ローソン日立鮎川町五丁目店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 14){
                $str_emfd .= "サンクス日立けやき通店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 15){
                $str_emfd .= "ミニストップ日立鮎川店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 16){
                $str_emfd .= "ファミリーマート日立会瀬店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 17){
                $str_emfd .= "ファミリーマート日和サービス日立事業所海上店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 18){
                $str_emfd .= "セブンイレブン日立鮎川町１丁目店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 19){
                $str_emfd .= "ファミリーマート日立総合病院店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 20){
                $str_emfd .= "セブン−イレブン日立助川町５丁目店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 21){
                $str_emfd .= "ココストア日立幸町店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 22){
                $str_emfd .= "ローソン日立国分町店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 23){
                $str_emfd .= "セブンイレブン日立助川町１丁目店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 24){
                $str_emfd .= "ローソン日立駅前店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 25){
                $str_emfd .= "コンビニエンスモンペリいなりや"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 26){
                $str_emfd .= "ファミリーマート日立末広町店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 27){
                $str_emfd .= "セイコーマートおおつか店"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
        }
        $this->set('str_emfd', $str_emfd);

                $efo_agent = "";   //不動産業者の生の声
                $efo_owner = "";   //大家の生の声
                $efo_resident = "";//入居者の生の声
                $resident_num = 1; //入居者の数をカウント

                foreach($estate['EstateFrankOpinion'] as $efo){
                        //不動産業者の生の声
                        if($efo['estate_frank_opinion_type_id'] == 0){
                           $efo_agent = $efo['frank_opinion'];
                        }
                        //大家の生の声
                        if($efo['estate_frank_opinion_type_id'] == 1){
                            $efo_owner = $efo['frank_opinion'];
                        }
                        //入居者の生の声
                        if($efo['estate_frank_opinion_type_id'] == 2){
                            $efo_resident .= "<h2>生の声&nbsp". $resident_num++ ."</h2>";
                            $efo_resident .= "<p>".$efo['frank_opinion']."<br>"."<p>";
                        }
                }

                $this->set('efo_agent', $efo_agent);
                $this->set('efo_owner', $efo_owner);
                $this->set('efo_resident', $efo_resident);

    }
}
