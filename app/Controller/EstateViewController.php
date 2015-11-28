<?php

/**
 * 物件検索・詳細コントローラ
 */
class EstateViewController extends AppController
{
    public $helpers = array("Html", "Form","Flash", "UploadPack.Upload"); //書いてあるといろいろ便利
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
        $this->set('posts', $this->Estate->find('all'));
    }

    /**
     * 物件詳細
     */
    public function detail()
    {

    }
}
