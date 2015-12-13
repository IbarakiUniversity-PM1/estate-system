<?php
App::uses('Sanitize', 'Utility');

/**
 * 物件検索・詳細コントローラ
 */
class EstateViewController extends AppController
{
    /**
     * @var array 扱うヘルパーのリスト
     */
    public $helpers = array(
        "Html",
        "Form",
        "Flash",
        "UploadPack.Upload"
    );
    /**
     * @var array 扱うモデルのリスト
     */
    public $uses = array(
        "Estate",
        "EstateAgent",
        "EstateInternetType",
        "EstateFrankOpinion",
        "EstateMainFacilitiesDistance",
        "EstateTvType",
        "EstateTradingAspect",
        "EstateRoom",
        "EstateType",
        "EstateStructure",
        "EstatePicture",
        "EstateCharacteristic",
        "EstateFrankOpinionType",
        "EstateCharacteristicReference",
        "EstateMainFacilitiesType",
        "EstateMainFacilities"
    );

    /**
     * 物件検索・絞込・トップ画面
     */
    public function estateList()
    {
        //データ取得の際のオプション
        $options = array(
            "joins" => array(),
            "order" => array(),
			//物件単位でテーブルをまとめる
            "group" => array("Estate.estate_id"),
            "conditions" => array()
        );
        if (empty($this->request->query)) { //トップ画面
            //タイトルをセットする
            $this->set("title_for_layout", "オススメ物件一覧");
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
        } else { //物件検索・絞り込み
            //タイトルをセットする
            $this->set("title_for_layout", "物件検索結果");

            if ($_GET["isKeywordSearch"]) {
                if($_GET['keyword_kind'] == 'estate_name'){
                    $options["conditions"]['Estate.name LIKE'] = '%'. $_GET['search_key'] . '%';
                }else if($_GET['keyword_kind'] == 'estate_address'){
                    $options["conditions"]['Estate.address LIKE'] = '%'. $_GET['search_key'] . '%';
                }else{
                    $tmp_option["conditions"]['EstateAgent.name LIKE'] = '%'. $_GET['search_key'] . '%';
                    $tmp_data = $this->EstateAgent->find("all", $tmp_option);
                    $options["conditions"]['Estate.estate_agent_id'] = $tmp_data[0]['EstateAgent']['estate_agent_id'];
                }
            } else {
                $this->search($options);
            }
        }

        //サムネイル画像をJOINする
        $options["joins"][] = array(
            "type" => "LEFT",
            "table" => "estate_pictures",
            "alias" => "EstatePicture",
            "conditions" => array(
                "Estate.estate_id=EstatePicture.estate_id",
                //サムネイル画像となっている物件画像に限定する
                "EstatePicture.thumbnail_flag=1"
            )
        );
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
     * 検索処理を行う
     * @param $options array 検索条件
     */
    private function search(&$options)
    {
        // サニタイズの応急処置(非推奨)
        $this->request->data = Sanitize::clean($this->request->data);

        if (!isset($_GET['rent'])
            && !isset($_GET['area'])
            && !isset($_GET['age'])
            && !isset($_GET['common_service_pay'])
            && !isset($_GET['deposit'])
            && !isset($_GET['key_money'])
            && !isset($_GET['window_direction'])
            && !isset($_GET['chara'])
        ) {
            $this->redirect('/');
        }

        if (isset($_GET['rent'])) {
            $options["conditions"]["rent <="] = $_GET['rent_num'];
        }
        if (isset($_GET['area'])) {
            $options["conditions"]["area >="] = $_GET['area_num'];
        }
        if (isset($_GET['age'])) {
            $options["conditions"]["area <="] = $_GET['age_num'];
        }
        if (isset($_GET['common_service_pay'])) {
            $options["conditions"]["common_service_pay"] = 0;
        }
        if (isset($_GET['deposit'])) {
            $options["conditions"]["deposit"] = 0;
        }
        if (isset($_GET['key_money'])) {
            $options["conditions"]["key_money"] = 0;
        }
        if (isset($_GET['window_direction'])) {
            $options["conditions"]["window_direction"] = '南';
        }

        //filter_input(INPUT_GET, "キー")のラッパー関数経由でアクセス法
//                            if(filter_input(INPUT_GET, "rent")){
//                                $options["conditions"]["rent <="] = filter_input(INPUT_GET, "rent_num");
//                            }

        if (isset($_GET['chara'])) {
            $chara = $_GET['chara'];
            for ($i = 0; $i < count($chara); $i++) {
                $options["conditions"][$chara[$i]] = true;
            }
        }
    }

    /**
     * 物件詳細画面
     * @param null $estate_id 物件ID
     */
    public function detail($estate_id = null)
    {
//        $this->autoLayout = false;

        $this->set("title_for_layout", "物件詳細画面");
//            if(!$id){
//            throw new NotFoundException(__('Invalid post'));
//            }

        $this->Estate->id = $estate_id;

//            if(!$id) {
//                throw new NotFoundException(__('Invalid post'));
//            }
        $estate = $this->Estate->read();
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
            //$options["conditions"]['EstateMainFacilities.estate_main_facilities_id'] = $emfd['estate_main_facilities_id'];
            //$options["fields"] = array('name', 'name');
            //$tmp = $this->EstateMainFacilities->find('all', $options);
            //$str_emfd .= $tmp[0]['EstateMainFacility']['EstateMainFacility.name'].$emfd['distance']."m".PHP_EOL;

            if(!isset($emfd['estate_main_facilities_id'])) continue;
            if($emfd['estate_main_facilities_id'] == 1){
                $str_emfd .= "茨城大学日立キャンパス"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 2){
                $str_emfd .= "日立駅"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 3){
                $str_emfd .= "大みか駅"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 4){
                $str_emfd .= "常陸多賀駅"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 5){
                $str_emfd .= "筑波大学"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 6){
                $str_emfd .= "711"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
            if($emfd['estate_main_facilities_id'] == 7){
                $str_emfd .= "ファミマ"." : ".$emfd['distance']."m".PHP_EOL; continue;
            }
        }
        $this->set('str_emfd', $str_emfd);

    }
}
