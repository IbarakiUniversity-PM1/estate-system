<?php

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
            "group" => array(),
            "conditions" => array(),
            //取得件数を10件に設定する
            "limit" => 10
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
                        "EstateMainFacilitiesDistance.estate_main_facilities_id=1"
                    )
            );
            //茨城大学日立キャンパスからの距離の昇順で並べる
            $options["order"][] = "EstateMainFacilitiesDistance.distance";
        } else { //物件検索・絞り込み
                        //タイトルをセットする
                        $this->set("title_for_layout", "物件検索結果");
                        debug($this->request->query);
                        //検索ボタンからの'get'メソッド送信か絞込ボタンからの送信か
                        if(isset($_GET["isSearch"])){
                            $this->search($options);
                        }else{
                            $options["conditions"]["Estate.estate_id"] = $this->request->query;
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
        //部屋情報をJOINする(全ての部屋が契約済みな物件は、表示されないようにする)
        //Estateにバーチャルフィールドを作成する
        $this->Estate->virtualFields = array(
            //築年数(本来の値に上書きする形となっている)
            "age" => "strftime('%Y',datetime(strftime('%s',datetime('now','localtime'))-Estate.age/1000,'unixepoch'))-1970",
            //サムネイル画像
            "picture_file_name" => "EstatePicture.picture_file_name"
        );

        //データを取得し、Viewの$estatesにセットする
        $this->set("estates", $this->Estate->find("all",$options));
    }

    /**
     * 物件詳細
     */
    public function detail()
    {

    }

        private function search(&$options){
            if(!isset($_GET['rent'])
                && !isset($_GET['area'])
                && !isset($_GET['age'])
                && !isset($_GET['common_service_pay'])
                && !isset($_GET['deposit'])
                && !isset($_GET['key_money'])
                && !isset($_GET['window_direction'])
                && !isset($_GET['chara'])
                ){
                    $this->redirect('/');
                            }

                            if(isset($_GET['rent'])){
                                $options["conditions"]["rent <="] = $_GET['rent_num'];
                            }
                            if(isset($_GET['area'])){
                                $options["conditions"]["area <="] = $_GET['area_num'];
                            }
                            if(isset($_GET['age'])){
                                $options["conditions"]["area <="] = $_GET['age_num'];
                            }
                            if(isset($_GET['common_service_pay'])){
                                $options["conditions"]["common_service_pay"] = 0;
                            }
                            if(isset($_GET['deposit'])){
                                $options["conditions"]["deposit"] = 0;
                            }
                            if(isset($_GET['key_money'])){
                                $options["conditions"]["key_money"] = 0;
                            }
                            if(isset($_GET['window_direction'])){
                                $options["conditions"]["window_direction"] = '南';
                            }

                            //filter_input(INPUT_GET, "キー")のラッパー関数経由でアクセス法
//                            if(filter_input(INPUT_GET, "rent")){
//                                $options["conditions"]["rent <="] = filter_input(INPUT_GET, "rent_num");
//                            }

                            if(isset($_GET['chara'])){
                                $chara = $_GET['chara'];
                                for($i = 0; $i < count($chara); $i++){
                                    $options["conditions"][$chara[$i]] = true;
                                }
                            }
        }
}
